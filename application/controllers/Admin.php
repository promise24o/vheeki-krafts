<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin  extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('crud_model');
		$this->load->library('upload');
		$this->load->helper('url');
		$this->load->helper('form');
	}

	public function index()
	{
		if ($this->session->userdata('admin_login') === TRUE) {
			redirect(base_url('admin/dashboard'));
		}

		redirect(base_url());
	}

	public function dashboard()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title'] = "Dashboard";
		$data['total_products'] = count($this->crud_model->get_all_products());
		$data['total_categories'] = count($this->crud_model->get_all_categories());
		$data['pending_reviews'] = count($this->crud_model->get_all_reviews(false));
		$data['unread_messages'] = $this->crud_model->get_unread_messages_count();
		$data['recent_products'] = $this->crud_model->get_all_products(5, 0);
		
		// Order statistics
		$data['total_orders'] = count($this->crud_model->get_all_orders());
		$data['pending_orders'] = $this->crud_model->get_pending_orders_count();
		$data['total_revenue'] = $this->crud_model->get_total_revenue();
		$data['recent_orders'] = array_slice($this->crud_model->get_all_orders(), 0, 5);

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/Dashboard', $data);
		$this->load->view('Components/AdminFooter');
	}

	// PRODUCT MANAGEMENT
	public function products()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title'] = "Products";
		$data['products'] = $this->crud_model->get_all_products();

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/Products/Products', $data);
		$this->load->view('Components/AdminFooter');
	}

	public function add_product()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		if ($this->input->post()) {
			$product_name = $this->input->post('product_name');
			$product_slug = $this->crud_model->generate_slug($product_name);
			$sku = $this->crud_model->generate_sku($product_name);
			
			// Generate unique encrypted ID (long unique identifier)
			$encrypted_id = $this->generate_encrypted_id();

			$data = array(
				'product_name' => $product_name,
				'product_slug' => $product_slug,
				'sku' => $sku,
				'encrypted_id' => $encrypted_id,
				'category_id' => $this->input->post('category_id'),
				'price' => $this->input->post('price'),
				'discount_price' => $this->input->post('discount_price') ?: null,
				'description' => $this->input->post('description'),
				'care_instructions' => $this->input->post('care_instructions'),
				'materials' => $this->input->post('materials'),
				'story' => $this->input->post('story'),
				'sizes' => json_encode($this->input->post('sizes') ?: []),
				'colors' => json_encode($this->input->post('colors') ?: []),
				'tags' => json_encode($this->input->post('tags') ?: []),
				'stock_quantity' => $this->input->post('stock_quantity'),
				'is_best_seller' => $this->input->post('is_best_seller') ? 1 : 0,
				'is_new_arrival' => $this->input->post('is_new_arrival') ? 1 : 0,
				'is_on_sale' => $this->input->post('is_on_sale') ? 1 : 0,
				'is_hot_item' => $this->input->post('is_hot_item') ? 1 : 0,
				'is_active' => 1
			);

			$product_id = $this->crud_model->add_product($data);
			
			if ($product_id) {
				// Generate QR code for the product
				$this->load->library('qr_code');
				$product_url = base_url('product/' . $encrypted_id);
				$qr_filename = 'product_' . $encrypted_id;
				$qr_code_path = $this->qr_code->generate($product_url, $qr_filename, 400);
				
				if ($qr_code_path) {
					// Update product with QR code path
					$this->crud_model->update_product($product_id, ['qr_code' => $qr_code_path]);
				}
				
				$this->session->set_flashdata('success', 'Product added successfully with QR code!');
			} else {
				$this->session->set_flashdata('error', 'Failed to add product.');
			}
			redirect('admin/products');
		}

		$data['page_title'] = "Add Product";
		$data['categories'] = $this->crud_model->get_all_categories();

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/Products/AddProduct', $data);
		$this->load->view('Components/AdminFooter');
	}

	public function edit_product($encrypted_id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$product = $this->crud_model->get_product_by_encrypted_id($encrypted_id);
		if (!$product) {
			redirect('admin/products');
		}

		if ($this->input->post()) {
			$product_name = $this->input->post('product_name');
			$product_slug = $this->crud_model->generate_slug($product_name);

			$data = array(
				'product_name' => $product_name,
				'product_slug' => $product_slug,
				'category_id' => $this->input->post('category_id'),
				'price' => $this->input->post('price'),
				'discount_price' => $this->input->post('discount_price') ?: null,
				'description' => $this->input->post('description'),
				'care_instructions' => $this->input->post('care_instructions'),
				'materials' => $this->input->post('materials'),
				'story' => $this->input->post('story'),
				'sizes' => json_encode($this->input->post('sizes') ?: []),
				'colors' => json_encode($this->input->post('colors') ?: []),
				'tags' => json_encode($this->input->post('tags') ?: []),
				'stock_quantity' => $this->input->post('stock_quantity'),
				'is_best_seller' => $this->input->post('is_best_seller') ? 1 : 0,
				'is_new_arrival' => $this->input->post('is_new_arrival') ? 1 : 0,
				'is_on_sale' => $this->input->post('is_on_sale') ? 1 : 0,
				'is_hot_item' => $this->input->post('is_hot_item') ? 1 : 0
			);

			if ($this->crud_model->update_product($product['product_id'], $data)) {
				$this->session->set_flashdata('success', 'Product updated successfully!');
			} else {
				$this->session->set_flashdata('error', 'Failed to update product.');
			}
			redirect('admin/products');
		}

		$data['page_title'] = "Edit Product";
		$data['product'] = $product;
		$data['categories'] = $this->crud_model->get_all_categories();
		$data['product_images'] = $this->crud_model->get_product_images($product['product_id']);

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/Products/EditProduct', $data);
		$this->load->view('Components/AdminFooter');
	}

	public function delete_product($encrypted_id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$product = $this->crud_model->get_product_by_encrypted_id($encrypted_id);
		if (!$product) {
			$this->session->set_flashdata('error', 'Product not found.');
			redirect('admin/products');
		}

		if ($this->crud_model->delete_product($product['product_id'])) {
			$this->session->set_flashdata('success', 'Product deleted successfully!');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete product.');
		}
		redirect('admin/products');
	}

	public function delete_product_image($image_id)
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			echo json_encode(['success' => false, 'message' => 'Unauthorized']);
			return;
		}

		$result = $this->crud_model->delete_product_image($image_id);
		echo json_encode(['success' => $result]);
	}

	/**
	 * Generate unique encrypted ID for products
	 * Format: VK-{timestamp}-{random}-{hash}
	 */
	private function generate_encrypted_id()
	{
		$timestamp = time();
		$random = bin2hex(random_bytes(8)); // 16 character random string
		$hash = substr(md5(uniqid($timestamp . $random, true)), 0, 12);
		return 'VK-' . $timestamp . '-' . $random . '-' . $hash;
	}

	/**
	 * View product QR code
	 */
	public function view_qr_code($encrypted_id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$product = $this->crud_model->get_product_by_encrypted_id($encrypted_id);
		if (!$product || empty($product['qr_code'])) {
			show_404();
		}

		$data['page_title'] = "QR Code - " . $product['product_name'];
		$data['product'] = $product;

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/Products/ViewQRCode', $data);
		$this->load->view('Components/AdminFooter');
	}

	/**
	 * Download product QR code
	 */
	public function download_qr_code($product_id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$product = $this->crud_model->get_product_by_id($product_id);
		if (!$product || empty($product['qr_code'])) {
			show_404();
		}

		$qr_path = './uploads/qrcodes/' . $product['qr_code'];
		if (!file_exists($qr_path)) {
			show_404();
		}

		$this->load->helper('download');
		force_download($qr_path, NULL);
	}

	/**
	 * Regenerate QR code for existing product
	 */
	public function regenerate_qr_code($product_id)
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			echo json_encode(['success' => false, 'message' => 'Unauthorized']);
			return;
		}

		$product = $this->crud_model->get_product_by_id($product_id);
		if (!$product) {
			echo json_encode(['success' => false, 'message' => 'Product not found']);
			return;
		}

		// Generate encrypted ID if not exists
		if (empty($product['encrypted_id'])) {
			$encrypted_id = $this->generate_encrypted_id();
			$this->crud_model->update_product($product_id, ['encrypted_id' => $encrypted_id]);
		} else {
			$encrypted_id = $product['encrypted_id'];
		}

		// Delete old QR code if exists
		if (!empty($product['qr_code'])) {
			$this->load->library('qr_code');
			$this->qr_code->delete($product['qr_code']);
		}

		// Generate new QR code
		$this->load->library('qr_code');
		$product_url = base_url('product/' . $encrypted_id);
		$qr_filename = 'product_' . $encrypted_id;
		$qr_code_path = $this->qr_code->generate($product_url, $qr_filename, 400);

		if ($qr_code_path) {
			$this->crud_model->update_product($product_id, ['qr_code' => $qr_code_path]);
			echo json_encode(['success' => true, 'message' => 'QR code regenerated successfully']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to generate QR code']);
		}
	}

	// CATEGORY MANAGEMENT
	public function categories()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title'] = "Categories";
		$data['categories'] = $this->crud_model->get_all_categories_with_count();

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/Categories', $data);
		$this->load->view('Components/AdminFooter');
	}

	public function add_category()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('admin/categories');
		}

		$category_name = $this->input->post('category_name');
		$category_slug = $this->input->post('category_slug');
		
		// Auto-generate slug if not provided
		if (empty($category_slug)) {
			$category_slug = url_title($category_name, 'dash', TRUE);
		}

		// Check if slug already exists
		if ($this->crud_model->category_slug_exists($category_slug)) {
			$category_slug = $category_slug . '-' . time();
		}

		$category_data = [
			'category_name' => $category_name,
			'category_slug' => $category_slug,
			'category_description' => $this->input->post('category_description'),
			'is_active' => $this->input->post('is_active') ? 1 : 0
		];

		// Handle image upload
		if (!empty($_FILES['category_image']['name'])) {
			$config['upload_path'] = './uploads/categories/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
			$config['max_size'] = 2048; // 2MB
			$config['encrypt_name'] = TRUE;

			// Create directory if it doesn't exist
			if (!is_dir($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, true);
			}

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('category_image')) {
				$upload_data = $this->upload->data();
				$category_data['category_image'] = $upload_data['file_name'];
			} else {
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect('admin/categories');
			}
		}

		if ($this->crud_model->add_category($category_data)) {
			$this->session->set_flashdata('success', 'Category added successfully!');
		} else {
			$this->session->set_flashdata('error', 'Failed to add category.');
		}
		redirect('admin/categories');
	}

	public function edit_category($id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('admin/categories');
		}

		$category_name = $this->input->post('category_name');
		$category_slug = $this->input->post('category_slug');
		
		// Auto-generate slug if not provided
		if (empty($category_slug)) {
			$category_slug = url_title($category_name, 'dash', TRUE);
		}

		// Check if slug already exists (excluding current category)
		if ($this->crud_model->category_slug_exists($category_slug, $id)) {
			$category_slug = $category_slug . '-' . time();
		}

		$category_data = [
			'category_name' => $category_name,
			'category_slug' => $category_slug,
			'category_description' => $this->input->post('category_description'),
			'is_active' => $this->input->post('is_active') ? 1 : 0
		];

		// Handle image upload
		if (!empty($_FILES['category_image']['name'])) {
			$config['upload_path'] = './uploads/categories/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
			$config['max_size'] = 2048; // 2MB
			$config['encrypt_name'] = TRUE;

			// Create directory if it doesn't exist
			if (!is_dir($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, true);
			}

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('category_image')) {
				$upload_data = $this->upload->data();
				
				// Delete old image
				$old_category = $this->crud_model->get_category_by_id($id);
				if (!empty($old_category['category_image']) && file_exists('./uploads/categories/' . $old_category['category_image'])) {
					unlink('./uploads/categories/' . $old_category['category_image']);
				}
				
				$category_data['category_image'] = $upload_data['file_name'];
			} else {
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect('admin/categories');
			}
		}

		if ($this->crud_model->update_category($id, $category_data)) {
			$this->session->set_flashdata('success', 'Category updated successfully!');
		} else {
			$this->session->set_flashdata('error', 'Failed to update category.');
		}
		redirect('admin/categories');
	}

	public function delete_category($id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		// Check if category has products
		$products_count = $this->crud_model->get_products_count_by_category($id);
		if ($products_count > 0) {
			$this->session->set_flashdata('error', 'Cannot delete category. It has ' . $products_count . ' products assigned to it.');
			redirect('admin/categories');
		}

		// Get category to delete image
		$category = $this->crud_model->get_category_by_id($id);
		
		if ($this->crud_model->delete_category($id)) {
			// Delete category image
			if (!empty($category['category_image']) && file_exists('./uploads/categories/' . $category['category_image'])) {
				unlink('./uploads/categories/' . $category['category_image']);
			}
			
			$this->session->set_flashdata('success', 'Category deleted successfully!');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete category.');
		}
		redirect('admin/categories');
	}

	public function toggle_category_status()
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			echo json_encode(['success' => false, 'message' => 'Unauthorized']);
			return;
		}

		$input = json_decode(file_get_contents('php://input'), true);
		$category_id = $input['category_id'];
		$status = $input['status'];

		$result = $this->crud_model->update_category($category_id, ['is_active' => $status]);
		echo json_encode(['success' => $result]);
	}
 
	// SITE SETTINGS
	public function site_settings()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		if ($this->input->post()) {
			$updated_count = 0;
			$errors = [];

			// Get all posted settings
			$settings = $this->input->post('settings');
			
			if (!empty($settings)) {
				foreach ($settings as $key => $value) {
					if ($this->crud_model->update_setting($key, $value)) {
						$updated_count++;
					} else {
						$errors[] = $key;
					}
				}
			}

			if (empty($errors)) {
				$this->session->set_flashdata('success', $updated_count . ' settings updated successfully!');
			} else {
				$this->session->set_flashdata('error', 'Some settings failed to update: ' . implode(', ', $errors));
			}
			redirect('admin/site_settings');
		}

		$data['page_title'] = "Site Settings";
		$data['settings'] = $this->crud_model->get_all_settings();

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/SiteSettings', $data);
		$this->load->view('Components/AdminFooter');
	}

	private function upload_site_image($field_name, $setting_key)
	{
		$config['upload_path'] = './uploads/site/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|webp|ico|svg';
		$config['max_size'] = 2048; // 2MB
		$config['encrypt_name'] = TRUE;

		// Create directory if it doesn't exist
		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, true);
		}

		$this->load->library('upload', $config);

		if ($this->upload->do_upload($field_name)) {
			$upload_data = $this->upload->data();
			
			// Delete old image if exists
			$old_image = $this->crud_model->get_setting($setting_key);
			if ($old_image && file_exists('./uploads/site/' . $old_image)) {
				unlink('./uploads/site/' . $old_image);
			}
			
			return ['success' => true, 'file_name' => $upload_data['file_name']];
		} else {
			return ['success' => false, 'error' => $this->upload->display_errors('', '')];
		}
	}

	private function upload_promo_image($field_name, $setting_key)
	{
		$config['upload_path'] = './uploads/promo/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
		$config['max_size'] = 3072; // 3MB
		$config['encrypt_name'] = TRUE;

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, true);
		}

		$this->load->library('upload', $config);

		if ($this->upload->do_upload($field_name)) {
			$upload_data = $this->upload->data();
			
			// Delete old image if exists
			$old_image = $this->crud_model->get_setting($setting_key);
			if ($old_image && file_exists('./uploads/promo/' . $old_image)) {
				unlink('./uploads/promo/' . $old_image);
			}
			
			return ['success' => true, 'file_name' => $upload_data['file_name']];
		} else {
			return ['success' => false, 'error' => $this->upload->display_errors('', '')];
		}
	}

	// PAYMENT SETTINGS
	public function payment_settings()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title'] = "Payment Settings";
		
		// Get current settings
		$data['settings'] = [];
		$all_settings = $this->crud_model->get_all_settings();
		foreach ($all_settings as $key => $value) {
			$data['settings'][$key] = $value;
		}

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/PaymentSettings', $data);
		$this->load->view('Components/AdminFooter');
	}

	public function save_payment_settings()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		// Get form data
		$public_key = $this->input->post('paystack_public_key');
		$secret_key = $this->input->post('paystack_secret_key');
		$test_mode = $this->input->post('paystack_test_mode') ? '1' : '0';
		$currency = $this->input->post('paystack_currency');
		$channels = $this->input->post('paystack_channels');

		// Save settings
		$settings = [
			'paystack_public_key' => $public_key,
			'paystack_secret_key' => $secret_key,
			'paystack_test_mode' => $test_mode,
			'paystack_currency' => $currency,
			'paystack_channels' => $channels ? implode(',', $channels) : 'card,bank,ussd'
		];

		$success = true;
		foreach ($settings as $key => $value) {
			if (!$this->crud_model->update_setting($key, $value)) {
				$success = false;
				break;
			}
		}

		if ($success) {
			$this->session->set_flashdata('success', 'Payment settings saved successfully!');
		} else {
			$this->session->set_flashdata('error', 'Failed to save payment settings.');
		}

		redirect('admin/payment_settings');
	}

	public function test_paystack_connection()
	{
		$this->output->set_content_type('application/json');

		$secret_key = $this->input->post('secret_key');

		if (empty($secret_key)) {
			echo json_encode(['success' => false, 'message' => 'Secret key is required']);
			return;
		}

		// Test API call to Paystack
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.paystack.co/transaction/verify/invalid_reference");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Authorization: Bearer " . $secret_key,
			"Cache-Control: no-cache",
		]);

		$response = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if ($http_code == 404) {
			// 404 means the API is reachable and key is valid (just reference not found)
			echo json_encode([
				'success' => true, 
				'message' => 'Connection successful! Your Paystack API key is valid.'
			]);
		} elseif ($http_code == 401) {
			echo json_encode([
				'success' => false, 
				'message' => 'Invalid API key. Please check your secret key.'
			]);
		} else {
			echo json_encode([
				'success' => false, 
				'message' => 'Unable to connect to Paystack. Please check your internet connection.'
			]);
		}
	}

	// BULK UPLOAD
	public function bulk_upload()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		if ($this->input->post()) {
			$config['upload_path'] = './uploads/csv/';
			$config['allowed_types'] = 'csv';
			$config['max_size'] = 2048; // 2MB

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('csv_file')) {
				$file_data = $this->upload->data();
				$file_path = $file_data['full_path'];

				$result = $this->crud_model->import_products_from_csv($file_path);

				if ($result['success']) {
					$this->session->set_flashdata('success', $result['message']);
				} else {
					$this->session->set_flashdata('error', $result['message']);
				}
			} else {
				$this->session->set_flashdata('error', $this->upload->display_errors());
			}
			redirect('admin/bulk_upload');
		}

		$data['page_title'] = "Bulk Upload";

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/BulkUpload', $data);
		$this->load->view('Components/AdminFooter');
	}

	// HOMEPAGE BANNERS MANAGEMENT
	public function banners()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title'] = "Homepage Banners";
		$data['banners'] = $this->crud_model->get_all_banners();

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/Banners', $data);
		$this->load->view('Components/AdminFooter');
	}

	public function add_banner()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		if ($this->input->post()) {
			$data = [
				'subtitle' => $this->input->post('subtitle'),
				'title' => $this->input->post('title'),
				'button_text' => $this->input->post('button_text'),
				'button_link' => $this->input->post('button_link'),
				'sort_order' => $this->input->post('sort_order'),
				'is_active' => $this->input->post('is_active') ? 1 : 0
			];

			// Handle background image upload
			if (!empty($_FILES['background_image']['name'])) {
				$upload_result = $this->upload_banner_image('background_image');
				if ($upload_result['success']) {
					$data['background_image'] = $upload_result['file_name'];
				} else {
					$this->session->set_flashdata('error', 'Image upload failed: ' . $upload_result['error']);
					redirect('admin/banners');
				}
			} else {
				$this->session->set_flashdata('error', 'Background image is required.');
				redirect('admin/banners');
			}

			if ($this->crud_model->add_banner($data)) {
				$this->session->set_flashdata('success', 'Banner added successfully!');
			} else {
				$this->session->set_flashdata('error', 'Failed to add banner.');
			}
			redirect('admin/banners');
		}

		redirect('admin/banners');
	}

	public function edit_banner($banner_id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		if ($this->input->post()) {
			$data = [
				'subtitle' => $this->input->post('subtitle'),
				'title' => $this->input->post('title'),
				'button_text' => $this->input->post('button_text'),
				'button_link' => $this->input->post('button_link'),
				'sort_order' => $this->input->post('sort_order'),
				'is_active' => $this->input->post('is_active') ? 1 : 0
			];

			// Handle background image upload
			if (!empty($_FILES['background_image']['name'])) {
				$upload_result = $this->upload_banner_image('background_image');
				if ($upload_result['success']) {
					// Delete old image
					$banner = $this->crud_model->get_banner_by_id($banner_id);
					if ($banner && !empty($banner['background_image'])) {
						$old_path = './uploads/banners/' . $banner['background_image'];
						if (file_exists($old_path)) {
							unlink($old_path);
						}
					}
					$data['background_image'] = $upload_result['file_name'];
				}
			}

			if ($this->crud_model->update_banner($banner_id, $data)) {
				$this->session->set_flashdata('success', 'Banner updated successfully!');
			} else {
				$this->session->set_flashdata('error', 'Failed to update banner.');
			}
			redirect('admin/banners');
		}

		redirect('admin/banners');
	}

	public function delete_banner($banner_id)
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			echo json_encode(['success' => false, 'message' => 'Unauthorized']);
			return;
		}

		// Get banner to delete image
		$banner = $this->crud_model->get_banner_by_id($banner_id);
		if ($banner && !empty($banner['background_image'])) {
			$image_path = './uploads/banners/' . $banner['background_image'];
			if (file_exists($image_path)) {
				unlink($image_path);
			}
		}

		if ($this->crud_model->delete_banner($banner_id)) {
			echo json_encode(['success' => true, 'message' => 'Banner deleted successfully']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to delete banner']);
		}
	}

	public function toggle_banner_status($banner_id)
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			echo json_encode(['success' => false]);
			return;
		}

		$banner = $this->crud_model->get_banner_by_id($banner_id);
		$new_status = $banner['is_active'] ? 0 : 1;
		
		$result = $this->crud_model->update_banner_status($banner_id, $new_status);
		echo json_encode(['success' => $result]);
	}

	private function upload_banner_image($field_name)
	{
		$config['upload_path'] = './uploads/banners/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
		$config['max_size'] = 5120; // 5MB
		$config['encrypt_name'] = TRUE;

		// Create directory if it doesn't exist
		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, true);
		}

		$this->load->library('upload', $config);

		if ($this->upload->do_upload($field_name)) {
			$upload_data = $this->upload->data();
			return ['success' => true, 'file_name' => $upload_data['file_name']];
		} else {
			return ['success' => false, 'error' => $this->upload->display_errors('', '')];
		}
	}

	// FEATURED CATEGORIES MANAGEMENT
	public function featured_categories()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title'] = "Featured Categories";
		$data['categories'] = $this->crud_model->get_all_featured_categories();

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/FeaturedCategories', $data);
		$this->load->view('Components/AdminFooter');
	}

	public function add_featured_category()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		if ($this->input->post()) {
			$data = [
				'category_name' => $this->input->post('category_name'),
				'category_link' => $this->input->post('category_link'),
				'item_count' => $this->input->post('item_count'),
				'sort_order' => $this->input->post('sort_order'),
				'is_active' => $this->input->post('is_active') ? 1 : 0
			];

			// Handle light image upload
			if (!empty($_FILES['image_light']['name'])) {
				$upload_result = $this->upload_category_image('image_light');
				if ($upload_result['success']) {
					$data['image_light'] = $upload_result['file_name'];
				} else {
					$this->session->set_flashdata('error', 'Light image upload failed: ' . $upload_result['error']);
					redirect('admin/featured_categories');
				}
			}

			// Handle dark image upload
			if (!empty($_FILES['image_dark']['name'])) {
				$upload_result = $this->upload_category_image('image_dark');
				if ($upload_result['success']) {
					$data['image_dark'] = $upload_result['file_name'];
				} else {
					$this->session->set_flashdata('error', 'Dark image upload failed: ' . $upload_result['error']);
					redirect('admin/featured_categories');
				}
			}

			if ($this->crud_model->add_featured_category($data)) {
				$this->session->set_flashdata('success', 'Category added successfully!');
			} else {
				$this->session->set_flashdata('error', 'Failed to add category.');
			}
			redirect('admin/featured_categories');
		}

		redirect('admin/featured_categories');
	}

	public function edit_featured_category($featured_id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		if ($this->input->post()) {
			$data = [
				'category_name' => $this->input->post('category_name'),
				'category_link' => $this->input->post('category_link'),
				'item_count' => $this->input->post('item_count'),
				'sort_order' => $this->input->post('sort_order'),
				'is_active' => $this->input->post('is_active') ? 1 : 0
			];

			$category = $this->crud_model->get_featured_category_by_id($featured_id);

			// Handle light image upload
			if (!empty($_FILES['image_light']['name'])) {
				$upload_result = $this->upload_category_image('image_light');
				if ($upload_result['success']) {
					if ($category && !empty($category['image_light'])) {
						@unlink('./uploads/categories/' . $category['image_light']);
					}
					$data['image_light'] = $upload_result['file_name'];
				}
			}

			// Handle dark image upload
			if (!empty($_FILES['image_dark']['name'])) {
				$upload_result = $this->upload_category_image('image_dark');
				if ($upload_result['success']) {
					if ($category && !empty($category['image_dark'])) {
						@unlink('./uploads/categories/' . $category['image_dark']);
					}
					$data['image_dark'] = $upload_result['file_name'];
				}
			}

			if ($this->crud_model->update_featured_category($featured_id, $data)) {
				$this->session->set_flashdata('success', 'Category updated successfully!');
			} else {
				$this->session->set_flashdata('error', 'Failed to update category.');
			}
			redirect('admin/featured_categories');
		}

		redirect('admin/featured_categories');
	}

	public function delete_featured_category($featured_id)
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			echo json_encode(['success' => false, 'message' => 'Unauthorized']);
			return;
		}

		$category = $this->crud_model->get_featured_category_by_id($featured_id);
		if ($category) {
			if (!empty($category['image_light'])) {
				@unlink('./uploads/categories/' . $category['image_light']);
			}
			if (!empty($category['image_dark'])) {
				@unlink('./uploads/categories/' . $category['image_dark']);
			}
		}

		if ($this->crud_model->delete_featured_category($featured_id)) {
			echo json_encode(['success' => true, 'message' => 'Category deleted successfully']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to delete category']);
		}
	}

	public function toggle_featured_category_status($featured_id)
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			echo json_encode(['success' => false]);
			return;
		}

		$category = $this->crud_model->get_featured_category_by_id($featured_id);
		$new_status = $category['is_active'] ? 0 : 1;
		
		$result = $this->crud_model->update_featured_category_status($featured_id, $new_status);
		echo json_encode(['success' => $result]);
	}

	private function upload_category_image($field_name)
	{
		$config['upload_path'] = './uploads/categories/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
		$config['max_size'] = 3072; // 3MB
		$config['encrypt_name'] = TRUE;

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, true);
		}

		$this->load->library('upload', $config);

		if ($this->upload->do_upload($field_name)) {
			$upload_data = $this->upload->data();
			return ['success' => true, 'file_name' => $upload_data['file_name']];
		} else {
			return ['success' => false, 'error' => $this->upload->display_errors('', '')];
		}
	}

	// PROMO SECTION MANAGEMENT
	public function promo_section()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		if ($this->input->post()) {
			$promo_id = $this->input->post('promo_id');
			$data = [
				'subtitle' => $this->input->post('subtitle'),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'button_text' => $this->input->post('button_text'),
				'button_link' => $this->input->post('button_link'),
				'is_active' => $this->input->post('is_active') ? 1 : 0
			];

			$promo = $this->crud_model->get_promo_by_id($promo_id);

			// Handle light image upload
			if (!empty($_FILES['image_light']['name'])) {
				$upload_result = $this->upload_promo_image('image_light');
				if ($upload_result['success']) {
					if ($promo && !empty($promo['image_light'])) {
						@unlink('./uploads/promo/' . $promo['image_light']);
					}
					$data['image_light'] = $upload_result['file_name'];
				}
			}

			// Handle dark image upload
			if (!empty($_FILES['image_dark']['name'])) {
				$upload_result = $this->upload_promo_image('image_dark');
				if ($upload_result['success']) {
					if ($promo && !empty($promo['image_dark'])) {
						@unlink('./uploads/promo/' . $promo['image_dark']);
					}
					$data['image_dark'] = $upload_result['file_name'];
				}
			}

			if ($this->crud_model->update_promo($promo_id, $data)) {
				$this->session->set_flashdata('success', 'Promo section updated successfully!');
			} else {
				$this->session->set_flashdata('error', 'Failed to update promo section.');
			}
			redirect('admin/promo_section');
		}

		$data['page_title'] = "Promo Section";
		$data['promo'] = $this->crud_model->get_promo_by_id(1); // Get first promo

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/PromoSection', $data);
		$this->load->view('Components/AdminFooter');
	}

	// private function upload_promo_image($field_name)
	// {
	// 	$config['upload_path'] = './uploads/promo/';
	// 	$config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
	// 	$config['max_size'] = 3072; // 3MB
	// 	$config['encrypt_name'] = TRUE;

	// 	if (!is_dir($config['upload_path'])) {
	// 		mkdir($config['upload_path'], 0777, true);
	// 	}

	// 	$this->load->library('upload', $config);

	// 	if ($this->upload->do_upload($field_name)) {
	// 		$upload_data = $this->upload->data();
	// 		return ['success' => true, 'file_name' => $upload_data['file_name']];
	// 	} else {
	// 		return ['success' => false, 'error' => $this->upload->display_errors('', '')];
	// 	}
	// }

	// REVIEWS MANAGEMENT
	public function reviews()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title'] = "Product Reviews";
		
		// Get filter parameters
		$status = $this->input->get('status');
		$rating = $this->input->get('rating');
		$search = $this->input->get('search');
		
		$data['reviews'] = $this->crud_model->get_all_reviews_admin($status, $rating, $search);
		$data['pending_count'] = $this->crud_model->get_reviews_count_by_status(0);
		$data['approved_count'] = $this->crud_model->get_reviews_count_by_status(1);
		$data['total_count'] = $this->crud_model->get_reviews_count_by_status(null);

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/Reviews', $data);
		$this->load->view('Components/AdminFooter');
	}

	public function view_review($review_id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$review = $this->crud_model->get_review_by_id($review_id);
		if (!$review) {
			$this->session->set_flashdata('error', 'Review not found.');
			redirect('admin/reviews');
		}

		$data['page_title'] = "Review Details";
		$data['review'] = $review;

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/ViewReview', $data);
		$this->load->view('Components/AdminFooter');
	}

	public function approve_review($review_id)
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			echo json_encode(['success' => false, 'message' => 'Unauthorized']);
			return;
		}

		$result = $this->crud_model->update_review_status($review_id, 1);
		
		if ($result) {
			echo json_encode(['success' => true, 'message' => 'Review approved successfully']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to approve review']);
		}
	}

	public function reject_review($review_id)
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			echo json_encode(['success' => false, 'message' => 'Unauthorized']);
			return;
		}

		$result = $this->crud_model->update_review_status($review_id, 0);
		
		if ($result) {
			echo json_encode(['success' => true, 'message' => 'Review rejected successfully']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to reject review']);
		}
	}

	public function delete_review($review_id)
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			echo json_encode(['success' => false, 'message' => 'Unauthorized']);
			return;
		}

		$result = $this->crud_model->delete_review($review_id);
		
		if ($result) {
			echo json_encode(['success' => true, 'message' => 'Review deleted successfully']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to delete review']);
		}
	}

	public function bulk_approve_reviews()
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			echo json_encode(['success' => false, 'message' => 'Unauthorized']);
			return;
		}

		$review_ids = $this->input->post('review_ids');
		
		if (empty($review_ids)) {
			echo json_encode(['success' => false, 'message' => 'No reviews selected']);
			return;
		}

		$result = $this->crud_model->bulk_update_review_status($review_ids, 1);
		
		if ($result) {
			echo json_encode(['success' => true, 'message' => count($review_ids) . ' reviews approved successfully']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to approve reviews']);
		}
	}

	public function bulk_delete_reviews()
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			echo json_encode(['success' => false, 'message' => 'Unauthorized']);
			return;
		}

		$review_ids = $this->input->post('review_ids');
		
		if (empty($review_ids)) {
			echo json_encode(['success' => false, 'message' => 'No reviews selected']);
			return;
		}

		$result = $this->crud_model->bulk_delete_reviews($review_ids);
		
		if ($result) {
			echo json_encode(['success' => true, 'message' => count($review_ids) . ' reviews deleted successfully']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to delete reviews']);
		}
	}

	// CONTACT MESSAGES
	public function contact_messages()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title'] = "Contact Messages";
		$data['messages'] = $this->crud_model->get_all_contact_messages();
		$data['unread_count'] = $this->crud_model->get_unread_messages_count();

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/ContactMessages', $data);
		$this->load->view('Components/AdminFooter');
	}

	public function view_contact_message($id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title'] = "View Message";
		$data['message'] = $this->crud_model->get_contact_message_by_id($id);

		// Mark as read when viewed
		if ($data['message'] && $data['message']['is_read'] == 0) {
			$this->crud_model->mark_message_as_read($id);
		}

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/ViewContactMessage', $data);
		$this->load->view('Components/AdminFooter');
	}

	public function delete_contact_message($id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		if ($this->crud_model->delete_contact_message($id)) {
			$this->session->set_flashdata('success', 'Message deleted successfully!');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete message.');
		}
		redirect('admin/contact_messages');
	}

	// ORDER MANAGEMENT
	public function orders()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title'] = "Orders";
		$data['orders'] = $this->crud_model->get_all_orders();
		$data['total_orders'] = count($data['orders']);
		$data['pending_orders'] = $this->crud_model->get_orders_count_by_status('pending');
		$data['completed_orders'] = $this->crud_model->get_orders_count_by_status('delivered');
		$data['total_revenue'] = $this->crud_model->get_total_revenue();

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/Orders', $data);
		$this->load->view('Components/AdminFooter');
	}

	public function view_order($order_id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title'] = "Order Details";
		$data['order'] = $this->crud_model->get_order_by_id($order_id);
		
		if (!$data['order']) {
			$this->session->set_flashdata('error', 'Order not found.');
			redirect('admin/orders');
			return;
		}

		$data['order_items'] = $this->crud_model->get_order_items_by_order_id($order_id);

		$this->load->view('Components/AdminHeader', $data);
		$this->load->view('Admin/ViewOrder', $data);
		$this->load->view('Components/AdminFooter');
	}

	public function update_order_status()
	{
		$this->output->set_content_type('application/json');

		$order_id = $this->input->post('order_id');
		$status = $this->input->post('status');

		if ($this->crud_model->update_order_status($order_id, $status)) {
			// Add tracking log
			$status_messages = [
				'pending' => 'Order is pending confirmation',
				'processing' => 'Order is being processed',
				'shipped' => 'Order has been shipped',
				'delivered' => 'Order has been delivered',
				'cancelled' => 'Order has been cancelled'
			];
			$message = $status_messages[$status] ?? 'Order status updated to ' . $status;
			$this->crud_model->add_tracking_log($order_id, $status, $message, 'Admin');

			echo json_encode(['success' => true, 'message' => 'Order status updated successfully']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to update order status']);
		}
	}

	public function update_order()
	{
		$this->output->set_content_type('application/json');

		$order_id = $this->input->post('order_id');
		$order_status = $this->input->post('order_status');
		$payment_status = $this->input->post('payment_status');

		$data = [
			'order_status' => $order_status,
			'payment_status' => $payment_status
		];

		if ($this->crud_model->update_order($order_id, $data)) {
			// Add tracking log for status change
			$status_messages = [
				'pending' => 'Order is pending confirmation',
				'processing' => 'Order is being processed',
				'shipped' => 'Order has been shipped',
				'delivered' => 'Order has been delivered',
				'cancelled' => 'Order has been cancelled'
			];
			$message = $status_messages[$order_status] ?? 'Order status updated to ' . $order_status;
			$this->crud_model->add_tracking_log($order_id, $order_status, $message, 'Admin');

			echo json_encode(['success' => true, 'message' => 'Order updated successfully']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to update order']);
		}
	}

	public function delete_order()
	{
		$this->output->set_content_type('application/json');

		$order_id = $this->input->post('order_id');

		if ($this->crud_model->delete_order($order_id)) {
			echo json_encode(['success' => true, 'message' => 'Order deleted successfully']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to delete order']);
		}
	}

	public function print_invoice($order_id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title'] = "Invoice";
		$data['order'] = $this->crud_model->get_order_by_id($order_id);
		
		if (!$data['order']) {
			$this->session->set_flashdata('error', 'Order not found.');
			redirect('admin/orders');
			return;
		}

		$data['order_items'] = $this->crud_model->get_order_items_by_order_id($order_id);
		$data['settings'] = $this->crud_model->get_all_settings();

		$this->load->view('Admin/PrintInvoice', $data);
	}

	public function add_tracking_log()
	{
		$this->output->set_content_type('application/json');

		$order_id = $this->input->post('order_id');
		$message = $this->input->post('message');
		$status = $this->input->post('status');

		if (empty($message)) {
			echo json_encode(['success' => false, 'message' => 'Message is required']);
			return;
		}

		if ($this->crud_model->add_tracking_log($order_id, $status, $message, 'Admin')) {
			echo json_encode(['success' => true, 'message' => 'Tracking log added successfully']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to add tracking log']);
		}
	}

	public function generate_tracking_number()
	{
		$this->output->set_content_type('application/json');

		$order_id = $this->input->post('order_id');

		// Generate tracking number
		$tracking_number = $this->crud_model->generate_tracking_number();

		// Update order
		if ($this->crud_model->update_order_tracking_number($order_id, $tracking_number)) {
			// Add tracking log
			$this->crud_model->add_tracking_log(
				$order_id, 
				'processing', 
				'Tracking number generated: ' . $tracking_number, 
				'Admin'
			);

			echo json_encode([
				'success' => true, 
				'tracking_number' => $tracking_number,
				'message' => 'Tracking number generated successfully'
			]);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to generate tracking number']);
		}
	}
}
