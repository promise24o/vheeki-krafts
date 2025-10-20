<?php
class Crud_model extends CI_Model
{

	////////LOGIN VALIDATION//////////
	function validate($email = '', $password = '')
	{
		$admin_credential = array('admin_email' => $email, 'admin_password' => MD5($password));

		// Checking login credential for Admin
		$query = $this->db->get_where('admins', $admin_credential);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$this->session->set_userdata('admin_login', TRUE);
			$this->session->set_userdata('admin_id', $row->admin_id);
			$this->session->set_userdata('admin_name', $row->admin_name);
			$this->session->set_userdata('admin_encrypted_id', $row->encrypted_id);
		return TRUE;
		} else {
			return FALSE;
		}
	}

	// CATEGORIES
	public function get_all_categories()
	{
		$this->db->where('is_active', 1);
		$this->db->order_by('category_name', 'ASC');
		return $this->db->get('categories')->result_array();
	}

	public function get_all_categories_with_count()
	{
		$this->db->select('c.*, COUNT(p.product_id) as products_count');
		$this->db->from('categories c');
		$this->db->join('products p', 'c.category_id = p.category_id', 'left');
		$this->db->group_by('c.category_id');
		$this->db->order_by('c.created_at', 'DESC');
		return $this->db->get()->result_array();
	}

	public function get_category_by_id($id)
	{
		return $this->db->get_where('categories', ['category_id' => $id])->row_array();
	}

	public function add_category($data)
	{
		return $this->db->insert('categories', $data);
	}

	public function update_category($id, $data)
	{
		$this->db->where('category_id', $id);
		return $this->db->update('categories', $data);
	}

	public function delete_category($id)
	{
		$this->db->where('category_id', $id);
		return $this->db->delete('categories');
	}

	public function category_slug_exists($slug, $exclude_id = null)
	{
		$this->db->where('category_slug', $slug);
		if ($exclude_id) {
			$this->db->where('category_id !=', $exclude_id);
		}
		return $this->db->get('categories')->num_rows() > 0;
	}

	public function get_products_count_by_category($category_id)
	{
		$this->db->where('category_id', $category_id);
		return $this->db->count_all_results('products');
	}

	////////PRODUCTS//////////
	function get_all_products($limit = null, $offset = null, $filters = array())
	{
		// Check if reviews table exists
		$reviews_exists = $this->db->table_exists('reviews');
		
		if ($reviews_exists) {
			$this->db->select('p.*, c.category_name, 
				COALESCE(AVG(r.rating), 0) as rating_average, 
				COUNT(DISTINCT r.review_id) as review_count');
		} else {
			$this->db->select('p.*, c.category_name, 
				0 as rating_average, 
				0 as review_count');
		}
		
		$this->db->from('products p');
		$this->db->join('categories c', 'p.category_id = c.category_id', 'left');
		
		if ($reviews_exists) {
			$this->db->join('reviews r', 'p.product_id = r.product_id AND r.is_approved = 1', 'left');
		}
		
		if (!empty($filters['category_id'])) {
			$this->db->where('p.category_id', $filters['category_id']);
		}
		
		if (!empty($filters['is_active'])) {
			$this->db->where('p.is_active', $filters['is_active']);
		}
		
		// Highlight filters
		if (!empty($filters['is_best_seller'])) {
			$this->db->where('p.is_best_seller', 1);
		}
		if (!empty($filters['is_new_arrival'])) {
			$this->db->where('p.is_new_arrival', 1);
		}
		if (!empty($filters['is_on_sale'])) {
			$this->db->where('p.is_on_sale', 1);
		}
		if (!empty($filters['is_hot_item'])) {
			$this->db->where('p.is_hot_item', 1);
		}
		
		// Price range filter
		if (!empty($filters['price_min'])) {
			$this->db->where('COALESCE(p.discount_price, p.price) >=', $filters['price_min']);
		}
		if (!empty($filters['price_max'])) {
			$this->db->where('COALESCE(p.discount_price, p.price) <=', $filters['price_max']);
		}
		
		if (!empty($filters['search'])) {
			$this->db->group_start();
			$this->db->like('p.product_name', $filters['search']);
			$this->db->or_like('p.description', $filters['search']);
			$this->db->or_like('p.tags', $filters['search']);
			$this->db->group_end();
		}
		
		$this->db->group_by('p.product_id');
		$this->db->order_by('p.created_at', 'DESC');
		
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		
		return $this->db->get()->result_array();
	}

	function get_product_by_id($id)
	{
		$this->db->select('p.*, c.category_name');
		$this->db->from('products p');
		$this->db->join('categories c', 'p.category_id = c.category_id', 'left');
		$this->db->where('p.product_id', $id);
		return $this->db->get()->row_array();
	}

	function get_product_by_encrypted_id($encrypted_id)
	{
		$this->db->select('p.*, c.category_name');
		$this->db->from('products p');
		$this->db->join('categories c', 'p.category_id = c.category_id', 'left');
		$this->db->where('p.encrypted_id', $encrypted_id);
		return $this->db->get()->row_array();
	}

	function get_product_by_slug($slug)
	{
		$this->db->select('p.*, c.category_name');
		$this->db->from('products p');
		$this->db->join('categories c', 'p.category_id = c.category_id', 'left');
		$this->db->where('p.product_slug', $slug);
		return $this->db->get()->row_array();
	}

	function get_product_by_slug_or_encrypted_id($identifier)
	{
		// Try encrypted_id first (starts with VK-)
		if (strpos($identifier, 'VK-') === 0) {
			return $this->get_product_by_encrypted_id($identifier);
		}
		// Otherwise try slug
		return $this->get_product_by_slug($identifier);
	}

	function add_product($data)
	{
		$this->db->insert('products', $data);
		return $this->db->insert_id();
	}

	function update_product($id, $data)
	{
		$this->db->where('product_id', $id);
		return $this->db->update('products', $data);
	}

	function delete_product($id)
	{
		$this->db->where('product_id', $id);
		return $this->db->delete('products');
	}

	function get_product_images($product_id)
	{
		$this->db->where('product_id', $product_id);
		$this->db->order_by('is_primary DESC, sort_order ASC');
		return $this->db->get('product_images')->result_array();
	}

	function add_product_image($data)
	{
		return $this->db->insert('product_images', $data);
	}

	function delete_product_image($image_id)
	{
		$this->db->where('image_id', $image_id);
		return $this->db->delete('product_images');
	}

	////////SITE SETTINGS//////////
	function get_setting($key)
	{
		$result = $this->db->get_where('site_settings', array('setting_key' => $key))->row_array();
		return $result ? $result['setting_value'] : null;
	}

	function get_all_settings()
	{
		$settings = array();
		$result = $this->db->get('site_settings')->result_array();
		foreach ($result as $row) {
			$settings[$row['setting_key']] = $row['setting_value'];
		}
		return $settings;
	}

	function update_setting($key, $value)
	{
		$this->db->where('setting_key', $key);
		$existing = $this->db->get('site_settings')->num_rows();
		
		if ($existing > 0) {
			$this->db->where('setting_key', $key);
			return $this->db->update('site_settings', array('setting_value' => $value));
		} else {
			return $this->db->insert('site_settings', array('setting_key' => $key, 'setting_value' => $value));
		}
	}

	////////TESTIMONIALS//////////
	function get_all_testimonials($active_only = false)
	{
		if ($active_only) {
			$this->db->where('is_active', 1);
		}
		$this->db->order_by('sort_order', 'ASC');
		return $this->db->get('testimonials')->result_array();
	}

	function add_testimonial($data)
	{
		return $this->db->insert('testimonials', $data);
	}

	function update_testimonial($id, $data)
	{
		$this->db->where('testimonial_id', $id);
		return $this->db->update('testimonials', $data);
	}

	function delete_testimonial($id)
	{
		$this->db->where('testimonial_id', $id);
		return $this->db->delete('testimonials');
	}

	////////REVIEWS//////////
	// Get all reviews (simple method for dashboard)
	function get_all_reviews($approved_only = true)
	{
		if ($approved_only !== false) {
			$this->db->where('is_approved', $approved_only);
		}
		return $this->db->get('product_reviews')->result_array();
	}

	// Admin: Get all reviews with filters
	function get_all_reviews_admin($status = null, $rating = null, $search = null)
	{
		$this->db->select('pr.*, p.product_name, p.product_slug');
		$this->db->from('product_reviews pr');
		$this->db->join('products p', 'pr.product_id = p.product_id', 'left');
		
		if ($status !== null && $status !== '') {
			$this->db->where('pr.is_approved', $status);
		}
		
		if ($rating !== null && $rating !== '') {
			$this->db->where('pr.rating', $rating);
		}
		
		if ($search !== null && $search !== '') {
			$this->db->group_start();
			$this->db->like('pr.customer_name', $search);
			$this->db->or_like('pr.review_text', $search);
			$this->db->or_like('p.product_name', $search);
			$this->db->group_end();
		}
		
		$this->db->order_by('pr.created_at', 'DESC');
		return $this->db->get()->result_array();
	}

	// Admin: Get single review details
	function get_review_by_id($review_id)
	{
		$this->db->select('pr.*, p.product_name, p.product_slug');
		$this->db->from('product_reviews pr');
		$this->db->join('products p', 'pr.product_id = p.product_id', 'left');
		$this->db->where('pr.review_id', $review_id);
		return $this->db->get()->row_array();
	}

	// Admin: Count reviews by status
	function get_reviews_count_by_status($status = null)
	{
		if ($status !== null) {
			$this->db->where('is_approved', $status);
		}
		return $this->db->count_all_results('product_reviews');
	}

	// Admin: Update review status
	function update_review_status($review_id, $status)
	{
		$this->db->where('review_id', $review_id);
		return $this->db->update('product_reviews', ['is_approved' => $status]);
	}

	// Admin: Delete single review
	function delete_review($review_id)
	{
		$this->db->where('review_id', $review_id);
		return $this->db->delete('product_reviews');
	}

	// Admin: Bulk approve/reject reviews
	function bulk_update_review_status($review_ids, $status)
	{
		$this->db->where_in('review_id', $review_ids);
		return $this->db->update('product_reviews', ['is_approved' => $status]);
	}

	// Admin: Bulk delete reviews
	function bulk_delete_reviews($review_ids)
	{
		$this->db->where_in('review_id', $review_ids);
		return $this->db->delete('product_reviews');
	}

	// Frontend: Get reviews for a product
	function get_product_reviews($product_id, $approved_only = true)
	{
		$this->db->where('product_id', $product_id);
		if ($approved_only) {
			$this->db->where('is_approved', 1);
		}
		$this->db->order_by('created_at', 'DESC');
		return $this->db->get('product_reviews')->result_array();
	}

	// Frontend: Add new review
	function add_review($data)
	{
		return $this->db->insert('product_reviews', $data);
	}

	////////PAYMENT SETTINGS//////////
	function get_payment_settings()
	{
		return $this->db->get('payment_settings')->row_array();
	}

	function update_payment_settings($data)
	{
		if ($this->db->get('payment_settings')->num_rows() > 0) {
			return $this->db->update('payment_settings', $data);
		} else {
			return $this->db->insert('payment_settings', $data);
		}
	}

	////////HOMEPAGE BANNERS//////////
	function get_all_banners($active_only = false)
	{
		if ($active_only) {
			$this->db->where('is_active', 1);
		}
		$this->db->order_by('sort_order', 'ASC');
		return $this->db->get('homepage_banners')->result_array();
	}

	function get_banner_by_id($banner_id)
	{
		$this->db->where('banner_id', $banner_id);
		return $this->db->get('homepage_banners')->row_array();
	}

	function add_banner($data)
	{
		return $this->db->insert('homepage_banners', $data);
	}

	function update_banner($banner_id, $data)
	{
		$this->db->where('banner_id', $banner_id);
		return $this->db->update('homepage_banners', $data);
	}

	function delete_banner($banner_id)
	{
		$this->db->where('banner_id', $banner_id);
		return $this->db->delete('homepage_banners');
	}

	function update_banner_status($banner_id, $status)
	{
		$this->db->where('banner_id', $banner_id);
		return $this->db->update('homepage_banners', ['is_active' => $status]);
	}

	////////HOMEPAGE CATEGORIES//////////
	function get_random_categories_for_homepage($limit = 4)
	{
		$this->db->select('c.category_id, c.category_name, c.category_slug, c.category_image, COUNT(p.product_id) as product_count');
		$this->db->from('categories c');
		$this->db->join('products p', 'c.category_id = p.category_id', 'left');
		$this->db->where('c.is_active', 1);
		$this->db->group_by('c.category_id');
		$this->db->having('product_count <', 1); // Only categories with products
		$this->db->order_by('RAND()');
		$this->db->limit($limit);
		return $this->db->get()->result_array();
	}

	////////CACHE CONTROL//////////
	function clear_cache()
	{
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
	}

	////////IMAGE URL//////////
	function get_image_url($type = '', $id = '')
	{
		if (file_exists('uploads/' . $type.'/'.$id . '.jpg'))
			$image_url = base_url() . 'uploads/'.$type.'/'.$id.'.jpg';
		else
			$image_url = base_url() . 'uploads/user.png';

		return $image_url;
	}

	////////UTILITY FUNCTIONS//////////
	function generate_slug($string)
	{
		$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
		return rtrim($slug, '-');
	}

	function generate_sku($product_name)
	{
		$prefix = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $product_name), 0, 3));
		$suffix = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
		return $prefix . $suffix;
	}

	// CONTACT MESSAGES
	public function add_contact_message($data)
	{
		return $this->db->insert('contact_messages', $data);
	}

	public function get_all_contact_messages($limit = null, $offset = 0)
	{
		$this->db->order_by('created_at', 'DESC');
		if ($limit !== null) {
			$this->db->limit($limit, $offset);
		}
		return $this->db->get('contact_messages')->result_array();
	}

	public function get_contact_message_by_id($id)
	{
		return $this->db->get_where('contact_messages', ['id' => $id])->row_array();
	}

	public function mark_message_as_read($id)
	{
		$data = [
			'is_read' => 1,
			'read_at' => date('Y-m-d H:i:s')
		];
		$this->db->where('id', $id);
		return $this->db->update('contact_messages', $data);
	}

	public function delete_contact_message($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('contact_messages');
	}

	public function get_unread_messages_count()
	{
		$this->db->where('is_read', 0);
		return $this->db->count_all_results('contact_messages');
	}

	// CART MANAGEMENT
	public function add_to_cart($data)
	{
		// Check if product already in cart for this session
		$this->db->where('session_id', $data['session_id']);
		$this->db->where('product_id', $data['product_id']);
		$existing = $this->db->get('cart_items')->row_array();

		if ($existing) {
			// Update quantity
			$new_quantity = $existing['quantity'] + $data['quantity'];
			$this->db->where('cart_id', $existing['cart_id']);
			return $this->db->update('cart_items', ['quantity' => $new_quantity]);
		} else {
			// Add new item
			return $this->db->insert('cart_items', $data);
		}
	}

	public function get_cart_items($session_id)
	{
		$this->db->select('c.*, p.product_name, p.product_slug, p.sku, p.price, p.discount_price, p.stock_quantity');
		$this->db->from('cart_items c');
		$this->db->join('products p', 'c.product_id = p.product_id');
		$this->db->where('c.session_id', $session_id);
		$items = $this->db->get()->result_array();

		// Get primary image for each product
		foreach ($items as &$item) {
			$this->db->where('product_id', $item['product_id']);
			$this->db->where('is_primary', 1);
			$this->db->order_by('sort_order', 'ASC');
			$this->db->limit(1);
			$image = $this->db->get('product_images')->row_array();
			$item['image'] = $image ? $image['image_path'] : null;
			
			// Calculate subtotal
			$price = $item['discount_price'] ? $item['discount_price'] : $item['price'];
			$item['subtotal'] = $price * $item['quantity'];
		}

		return $items;
	}

	public function update_cart_item($cart_id, $quantity)
	{
		$this->db->where('cart_id', $cart_id);
		return $this->db->update('cart_items', ['quantity' => $quantity]);
	}

	public function remove_cart_item($cart_id)
	{
		$this->db->where('cart_id', $cart_id);
		return $this->db->delete('cart_items');
	}

	public function clear_cart($session_id)
	{
		$this->db->where('session_id', $session_id);
		return $this->db->delete('cart_items');
	}

	public function get_cart_count($session_id)
	{
		$this->db->where('session_id', $session_id);
		$this->db->select_sum('quantity');
		$result = $this->db->get('cart_items')->row_array();
		return $result['quantity'] ? $result['quantity'] : 0;
	}

	// ORDER MANAGEMENT
	public function create_order($data)
	{
		$this->db->insert('orders', $data);
		return $this->db->insert_id();
	}

	public function add_order_items($items)
	{
		return $this->db->insert_batch('order_items', $items);
	}

	public function get_order_by_id($order_id)
	{
		$this->db->where('order_id', $order_id);
		return $this->db->get('orders')->row_array();
	}

	public function get_order_by_number($order_number)
	{
		$this->db->where('order_number', $order_number);
		$order = $this->db->get('orders')->row_array();

		if ($order) {
			// Get order items
			$this->db->select('oi.*, p.product_name, p.product_slug');
			$this->db->from('order_items oi');
			$this->db->join('products p', 'oi.product_id = p.product_id');
			$this->db->where('oi.order_id', $order['order_id']);
			$order['items'] = $this->db->get()->result_array();

			// Get images for each item
			foreach ($order['items'] as &$item) {
				$this->db->where('product_id', $item['product_id']);
				$this->db->where('is_primary', 1);
				$this->db->limit(1);
				$image = $this->db->get('product_images')->row_array();
				$item['image'] = $image ? $image['image_path'] : null;
			}
		}

		return $order;
	}

	public function get_orders_by_email($email)
	{
		$this->db->where('customer_email', $email);
		$this->db->order_by('created_at', 'DESC');
		$orders = $this->db->get('orders')->result_array();

		foreach ($orders as &$order) {
			// Get order items
			$this->db->select('oi.*, p.product_name');
			$this->db->from('order_items oi');
			$this->db->join('products p', 'oi.product_id = p.product_id');
			$this->db->where('oi.order_id', $order['order_id']);
			$order['items'] = $this->db->get()->result_array();

			// Get images
			foreach ($order['items'] as &$item) {
				$this->db->where('product_id', $item['product_id']);
				$this->db->where('is_primary', 1);
				$this->db->limit(1);
				$image = $this->db->get('product_images')->row_array();
				$item['image'] = $image ? $image['image_path'] : null;
			}
		}

		return $orders;
	}

	public function update_order_status($order_id, $status)
	{
		$this->db->where('order_id', $order_id);
		return $this->db->update('orders', ['order_status' => $status]);
	}

	public function update_payment_status($order_id, $status, $reference = null)
	{
		$data = ['payment_status' => $status];
		if ($reference) {
			$data['payment_reference'] = $reference;
		}
		$this->db->where('order_id', $order_id);
		return $this->db->update('orders', $data);
	}

	// ADMIN ORDER MANAGEMENT
	public function get_all_orders()
	{
		$this->db->select('o.*, COUNT(oi.item_id) as items_count');
		$this->db->from('orders o');
		$this->db->join('order_items oi', 'o.order_id = oi.order_id', 'left');
		$this->db->group_by('o.order_id');
		$this->db->order_by('o.created_at', 'DESC');
		return $this->db->get()->result_array();
	}

	public function get_pending_orders_count()
	{
		$this->db->where('order_status', 'pending');
		return $this->db->count_all_results('orders');
	}

	public function get_orders_count_by_status($status)
	{
		$this->db->where('order_status', $status);
		return $this->db->count_all_results('orders');
	}

	public function get_total_revenue()
	{
		$this->db->select_sum('total_amount');
		$this->db->where('payment_status', 'paid');
		$result = $this->db->get('orders')->row_array();
		return $result['total_amount'] ?: 0;
	}

	public function get_order_items_by_order_id($order_id)
	{
		$this->db->select('oi.*, oi.product_name, oi.product_sku as sku, oi.unit_price as price, oi.total_price as subtotal');
		$this->db->from('order_items oi');
		$this->db->where('oi.order_id', $order_id);
		$items = $this->db->get()->result_array();

		// Get images for each item
		foreach ($items as &$item) {
			$this->db->where('product_id', $item['product_id']);
			$this->db->where('is_primary', 1);
			$this->db->limit(1);
			$image = $this->db->get('product_images')->row_array();
			$item['image'] = $image ? base_url($image['image_path']) : null;
		}

		return $items;
	}

	public function update_order($order_id, $data)
	{
		$this->db->where('order_id', $order_id);
		return $this->db->update('orders', $data);
	}

	public function delete_order($order_id)
	{
		// Delete order items first (due to foreign key)
		$this->db->where('order_id', $order_id);
		$this->db->delete('order_items');

		// Delete order
		$this->db->where('order_id', $order_id);
		return $this->db->delete('orders');
	}

	// ORDER TRACKING
	public function generate_tracking_number()
	{
		// Generate unique tracking number: VK-TRACK-YYYYMMDD-XXXX
		$prefix = 'VK-TRACK-' . date('Ymd') . '-';
		$random = str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);
		$tracking_number = $prefix . $random;

		// Check if exists, regenerate if needed
		$this->db->where('tracking_number', $tracking_number);
		if ($this->db->count_all_results('orders') > 0) {
			return $this->generate_tracking_number(); // Recursive call if duplicate
		}

		return $tracking_number;
	}

	public function update_order_tracking_number($order_id, $tracking_number)
	{
		$this->db->where('order_id', $order_id);
		return $this->db->update('orders', ['tracking_number' => $tracking_number]);
	}

	public function add_tracking_log($order_id, $status, $message, $created_by = 'System')
	{
		$data = [
			'order_id' => $order_id,
			'status' => $status,
			'message' => $message,
			'created_by' => $created_by
		];
		return $this->db->insert('order_tracking_logs', $data);
	}

	public function get_tracking_logs($order_id)
	{
		$this->db->where('order_id', $order_id);
		$this->db->order_by('created_at', 'DESC');
		return $this->db->get('order_tracking_logs')->result_array();
	}

	public function get_order_by_tracking_number($tracking_number)
	{
		$this->db->where('tracking_number', $tracking_number);
		$order = $this->db->get('orders')->row_array();

		if ($order) {
			// Get tracking logs
			$order['tracking_logs'] = $this->get_tracking_logs($order['order_id']);

			// Get order items
			$order['items'] = $this->get_order_items_by_order_id($order['order_id']);
		}

		return $order;
	}

	public function get_order_by_number_or_tracking($identifier)
	{
		// Try order number first
		$this->db->where('order_number', $identifier);
		$order = $this->db->get('orders')->row_array();

		// If not found, try tracking number
		if (!$order) {
			$this->db->where('tracking_number', $identifier);
			$order = $this->db->get('orders')->row_array();
		}

		if ($order) {
			// Get tracking logs
			$order['tracking_logs'] = $this->get_tracking_logs($order['order_id']);

			// Get order items
			$order['items'] = $this->get_order_items_by_order_id($order['order_id']);
		}

		return $order;
	}

	// Get order by payment reference (for webhook)
	public function get_order_by_reference($reference)
	{
		$this->db->where('transaction_id', $reference);
		return $this->db->get('orders')->row_array();
	}
}
