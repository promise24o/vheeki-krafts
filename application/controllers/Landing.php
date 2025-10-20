<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
    }
    
    private function get_base_data() {
        return ['settings' => $this->crud_model->get_all_settings()];
    }
    
    public function index() {
        $data = $this->get_base_data();
        $data['title'] = 'Home';
        $data['description'] = 'Explore unique drawings and paintings crafted with passion at Vheeki Krafts.';
        $data['banners'] = $this->crud_model->get_all_banners(true);
        $data['categories'] = $this->crud_model->get_random_categories_for_homepage(4);
        
        $this->load->view('Components/LandingHeader', $data);
        $this->load->view('Landing/Home', $data);
        $this->load->view('Components/LandingFooter', $data);
    }
    
    public function shop() {
        $data = $this->get_base_data();
        $data['title'] = 'Shop';
        $data['description'] = 'Discover our collection of artistic masterpieces at Vheeki Krafts.';
        
        // Get filters
        $filters = [];
        if ($this->input->get('category')) {
            $filters['category_id'] = $this->input->get('category');
        }
        if ($this->input->get('highlight')) {
            $highlight = $this->input->get('highlight');
            $filters['is_' . $highlight] = 1;
        }
        if ($this->input->get('price')) {
            $price_range = explode('-', $this->input->get('price'));
            if (count($price_range) == 2) {
                $filters['price_min'] = $price_range[0];
                $filters['price_max'] = $price_range[1];
            }
        }
        
        // Get products with filters
        $data['products'] = $this->crud_model->get_all_products(null, null, $filters);
        
        // Get product images
        foreach ($data['products'] as &$product) {
            $product['images'] = $this->crud_model->get_product_images($product['product_id']);
        }
        
        $data['categories'] = $this->crud_model->get_all_categories();
        
        $this->load->view('Components/LandingHeader', $data);
        $this->load->view('Landing/Shop', $data);
        $this->load->view('Components/LandingFooter', $data);
    }
    
    // CART METHODS
    public function cart() {
        $data = $this->get_base_data();
        $data['title'] = 'Shopping Cart';
        $data['description'] = 'Review your shopping cart and proceed to checkout at Vheeki Krafts.';
        
        $session_id = $this->session->userdata('session_id') ?: session_id();
        $this->session->set_userdata('session_id', $session_id);
        
        $data['cart_items'] = $this->crud_model->get_cart_items($session_id);
        $data['cart_total'] = array_sum(array_column($data['cart_items'], 'subtotal'));
        
        $this->load->view('Components/LandingHeader', $data);
        $this->load->view('Landing/Cart', $data);
        $this->load->view('Components/LandingFooter', $data);
    }
    
    public function cart_add() {
        $this->output->set_content_type('application/json');
        
        $product_id = $this->input->post('product_id');
        $quantity = $this->input->post('quantity') ?: 1;
        
        if (!$product_id) {
            echo json_encode(['success' => false, 'message' => 'Product ID required']);
            return;
        }
        
        $session_id = $this->session->userdata('session_id') ?: session_id();
        $this->session->set_userdata('session_id', $session_id);
        
        $cart_data = [
            'session_id' => $session_id,
            'product_id' => $product_id,
            'quantity' => $quantity
        ];
        
        if ($this->crud_model->add_to_cart($cart_data)) {
            $cart_count = $this->crud_model->get_cart_count($session_id);
            echo json_encode(['success' => true, 'cart_count' => $cart_count]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add to cart']);
        }
    }
    
    public function cart_update() {
        $this->output->set_content_type('application/json');
        
        $cart_id = $this->input->post('cart_id');
        $quantity = $this->input->post('quantity');
        
        if ($this->crud_model->update_cart_item($cart_id, $quantity)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update cart']);
        }
    }
    
    public function cart_remove() {
        $this->output->set_content_type('application/json');
        
        $cart_id = $this->input->post('cart_id');
        
        if ($this->crud_model->remove_cart_item($cart_id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to remove item']);
        }
    }
    
    public function cart_clear() {
        $session_id = $this->session->userdata('session_id');
        if ($session_id) {
            $this->crud_model->clear_cart($session_id);
        }
        redirect('cart');
    }
    
    public function cart_get_count() {
        $this->output->set_content_type('application/json');
        
        $session_id = $this->session->userdata('session_id') ?: session_id();
        $count = $this->crud_model->get_cart_count($session_id);
        
        echo json_encode(['success' => true, 'count' => $count]);
    }
    
    // CHECKOUT
    public function checkout() {
        $data = $this->get_base_data();
        $data['title'] = 'Checkout';
        $data['description'] = 'Complete your purchase securely at Vheeki Krafts.';
        
        $session_id = $this->session->userdata('session_id') ?: session_id();
        $data['cart_items'] = $this->crud_model->get_cart_items($session_id);
        $data['cart_total'] = array_sum(array_column($data['cart_items'], 'subtotal'));
        
        // Get Paystack public key from settings
        $data['paystack_public_key'] = $this->crud_model->get_setting('paystack_public_key') ?: 'pk_test_xxxxx';
        
        $this->load->view('Components/LandingHeader', $data);
        $this->load->view('Landing/Checkout', $data);
        $this->load->view('Components/LandingFooter', $data);
    }
    
    public function checkout_process() {
        $this->output->set_content_type('application/json');
        
        $session_id = $this->session->userdata('session_id');
        $cart_items = $this->crud_model->get_cart_items($session_id);
        
        if (empty($cart_items)) {
            echo json_encode(['success' => false, 'message' => 'Cart is empty']);
            return;
        }
        
        $total = array_sum(array_column($cart_items, 'subtotal'));
        
        // Generate order number
        $order_number = 'VK-' . time() . '-' . rand(1000, 9999);
        
        // Create order
        $order_data = [
            'order_number' => $order_number,
            'customer_name' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
            'customer_email' => $this->input->post('email'),
            'customer_phone' => $this->input->post('phone'),
            'shipping_address' => $this->input->post('address') . ($this->input->post('address_2') ? ', ' . $this->input->post('address_2') : ''),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'postal_code' => $this->input->post('postal_code'),
            'order_notes' => $this->input->post('order_notes'),
            'total_amount' => $total,
            'payment_method' => 'paystack',
            'payment_status' => $this->input->post('payment_status') ?: 'pending',
            'payment_reference' => $this->input->post('payment_reference'),
            'order_status' => 'pending'
        ];
        
        $order_id = $this->crud_model->create_order($order_data);
        
        if ($order_id) {
            // Add order items
            $order_items = [];
            foreach ($cart_items as $item) {
                $order_items[] = [
                    'order_id' => $order_id,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['product_name'],
                    'product_sku' => $item['sku'],
                    'size' => $item['size'] ?? null,
                    'color' => $item['color'] ?? null,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['discount_price'] ?: $item['price'],
                    'total_price' => $item['subtotal']
                ];
            }
            
            $this->crud_model->add_order_items($order_items);
            
            // Add initial tracking log
            $this->crud_model->add_tracking_log(
                $order_id,
                'pending',
                'Order placed successfully. Awaiting confirmation.',
                'System'
            );
            
            // Clear cart
            $this->crud_model->clear_cart($session_id);
            
            echo json_encode(['success' => true, 'order_id' => $order_id]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create order']);
        }
    }
    
    // ORDERS
    public function orders() {
        $data = $this->get_base_data();
        $data['title'] = 'My Orders';
        $data['description'] = 'View your order history and track your purchases from Vheeki Krafts.';
        
        // For demo, get orders by email from session or show empty
        $email = $this->session->userdata('customer_email');
        $data['orders'] = $email ? $this->crud_model->get_orders_by_email($email) : [];
        
        $this->load->view('Components/LandingHeader', $data);
        $this->load->view('Landing/Orders', $data);
        $this->load->view('Components/LandingFooter', $data);
    }
    
    public function order_track() {
        $data = $this->get_base_data();
        $data['title'] = 'Track Order';
        $data['description'] = 'Track your order status and delivery progress at Vheeki Krafts.';
        
        $tracking_number = $this->input->get('number');
        
        if ($tracking_number) {
            $order = $this->crud_model->get_order_by_number_or_tracking($tracking_number);
            if ($order) {
                $data['order'] = $order;
            } else {
                $data['error'] = 'Order not found. Please check your order number or tracking number and try again.';
            }
        }
        
        $this->load->view('Components/LandingHeader', $data);
        $this->load->view('Landing/TrackOrder', $data);
        $this->load->view('Components/LandingFooter', $data);
    }
    
    public function order_success($order_id) {
        $data = $this->get_base_data();
        $data['title'] = 'Order Success';
        $data['description'] = 'Thank you for your order at Vheeki Krafts!';
        
        $order = $this->crud_model->get_order_by_id($order_id);
        if (!$order) {
            redirect('shop');
            return;
        }
        
        // Get order items
        $this->db->select('oi.*, p.product_name, p.product_slug');
        $this->db->from('order_items oi');
        $this->db->join('products p', 'oi.product_id = p.product_id');
        $this->db->where('oi.order_id', $order_id);
        $order['items'] = $this->db->get()->result_array();
        
        // Get images
        foreach ($order['items'] as &$item) {
            $this->db->where('product_id', $item['product_id']);
            $this->db->where('is_primary', 1);
            $this->db->limit(1);
            $image = $this->db->get('product_images')->row_array();
            $item['image'] = $image ? $image['image_path'] : null;
        }
        
        $data['order'] = $order;
        
        // Store email in session for future orders view
        $this->session->set_userdata('customer_email', $order['customer_email']);
        
        $this->load->view('Components/LandingHeader', $data);
        $this->load->view('Landing/OrderSuccess', $data);
        $this->load->view('Components/LandingFooter', $data);
    }
    
    public function contact() {
        $data = $this->get_base_data();
        $data['title'] = 'Contact Us';
        $data['description'] = 'Get in touch with Vheeki Krafts. We\'d love to hear from you and answer any questions about our artwork.';
        
        // Handle form submission
        if ($this->input->post()) {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[255]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[255]');
            $this->form_validation->set_rules('subject', 'Subject', 'trim|max_length[500]');
            $this->form_validation->set_rules('message', 'Message', 'required|trim');
            
            if ($this->form_validation->run() == TRUE) {
                $contact_data = [
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'subject' => $this->input->post('subject') ?: 'General Inquiry',
                    'message' => $this->input->post('message')
                ];
                
                if ($this->crud_model->add_contact_message($contact_data)) {
                    $this->session->set_flashdata('success', 'Thank you for contacting us! We will get back to you soon.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to send message. Please try again.');
                }
                redirect('contact');
            } else {
                $data['error'] = validation_errors();
            }
        }
        
        $this->load->view('Components/LandingHeader', $data);
        $this->load->view('Landing/Contact', $data);
        $this->load->view('Components/LandingFooter', $data);
    }
    
    public function about() {
        $data = $this->get_base_data();
        $data['title'] = 'About Us';
        $data['description'] = 'Learn about Vheeki Krafts, our passion for creating unique handmade artworks, and our mission to inspire creativity.';
        $this->load->view('Components/LandingHeader', $data);
        $this->load->view('Landing/About', $data);
        $this->load->view('Components/LandingFooter', $data);
    }
    
    public function reviews() {
        $data = $this->get_base_data();
        $data['title'] = 'Customer Reviews';
        $data['description'] = 'Read genuine testimonials from art lovers who have transformed their spaces with Vheeki Krafts unique handcrafted pieces.';
        $this->load->view('Components/LandingHeader', $data);
        $this->load->view('Landing/Reviews', $data);
        $this->load->view('Components/LandingFooter', $data);
    }
    
    public function product_detail($identifier = null) {
        if (!$identifier) {
            redirect('shop');
            return;
        }

        $data = $this->get_base_data();
        
        // Get product details by slug or encrypted ID
        $product = $this->crud_model->get_product_by_slug_or_encrypted_id($identifier);
        
        if (!$product) {
            show_404();
            return;
        }
        
        $data['product'] = $product;
        $data['product_images'] = $this->crud_model->get_product_images($product['product_id']);
        $data['title'] = $product['product_name'] . ' - Vheeki Krafts';
        $data['description'] = substr($product['description'], 0, 160);
        
        $this->load->view('Components/LandingHeader', $data);
        $this->load->view('Landing/ProductDetail', $data);
        $this->load->view('Components/LandingFooter', $data);
    }
}