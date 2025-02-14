<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin  extends CI_Controller
{

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

		$data['page_title']	=	"Dashboard";

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/dashboard');
		$this->load->view('Admin/footer');
	}

	public function suppliers()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title']	=	"Suppliers";
		$data['suppliers'] =	$this->crud_model->get_all_suppliers();

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/Suppliers/suppliers');
		$this->load->view('Admin/footer');
	}

	public function livestock()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title']	=	"Livestock";
		$data['livestocks'] =	$this->crud_model->get_all_livestocks();

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/Livestock/livestock');
		$this->load->view('Admin/footer');
	}

	public function purchase()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title']	=	"Purchase";
		$data['livestocks'] =	$this->crud_model->get_all_livestocks();

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/Purchase/purchase');
		$this->load->view('Admin/footer');
	}

	public function livestock_variants($id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		if (!$id) {
			redirect(base_url('admin/livestock'), 'refresh');
		}

		$data['page_title']		=	"Livestock Variants";
		$data['variants']	 	=	$this->crud_model->get_variants_by_livestock($id);
		$data['livestock'] 		=	$this->crud_model->get_livestock_by_id($id);

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/Livestock/variants');
		$this->load->view('Admin/footer');
	}

	public function settings()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title']	=	"Settings";
		$data['settings'] = $this->crud_model->get_settings();

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/Settings/settings');
		$this->load->view('Admin/footer');
	}
	public function profile()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title']	=	"Profile";
		$data['profile'] = $this->crud_model->get_user_by_id($this->session->userdata('admin_id'));

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/Profile/profile');
		$this->load->view('Admin/footer');
	}

	public function staff()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title']	=	"Staff List";
		$data['staff_list'] = 	$this->crud_model->get_all_staff();

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/Staff/staff_list');
		$this->load->view('Admin/footer');
	}

	public function clients()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title'] = "Client List";
		$data['client_list'] = $this->crud_model->get_all_clients();

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/Client/client_list');
		$this->load->view('Admin/footer');
	}

	public function staff_payments($id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		if (!$id) {
			redirect(base_url('admin/staff'), 'refresh');
		}

		// Get Staff Details
		$data['staff_details'] = $this->crud_model->get_staff_by_id($id);

		// Get Total Payment Amount
		$data['total_payment_amount'] = $this->crud_model->get_total_payment_amount($id);

		// Get Total Payment Count
		$data['total_payment_count'] = $this->crud_model->get_total_payment_count($id);

		// Get List of Payments
		$data['payments'] = $this->crud_model->get_payments_by_staff($id);

		// Set Page Title
		$data['page_title'] = "Staff Payment";

		// Load Views
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/Staff/payment');
		$this->load->view('Admin/footer');
	}

	public function client_ledgers($id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		if (!$id) {
			redirect(base_url('admin/clients'), 'refresh');
		}

		// Get Client Details
		$data['client_details'] = $this->crud_model->get_client($id);

		// Get Total Receivable Amount
		$data['total_receivable_amount'] = $this->crud_model->get_total_receivable_amount($id);

		// Get Total Received Amount
		$data['total_received_amount'] = $this->crud_model->get_total_received_amount($id);

		// Get List of Client Payments
		$data['client_payments'] = $this->crud_model->get_client_payments($id);

		// Set Page Title
		$data['page_title'] = "Client Ledger";

		// Load Views
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/Client/ledgers');
		$this->load->view('Admin/footer');
	}

	public function supplier_ledgers($id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		if (!$id) {
			redirect(base_url('admin/suppliers'), 'refresh');
		}

		// // Get Client Details
		$data['supplier_details'] = $this->crud_model->get_supplier($id);

		// // Get Total Receivable Amount
		// $data['total_receivable_amount'] = $this->crud_model->get_total_receivable_amount($id);

		// // Get Total Received Amount
		// $data['total_received_amount'] = $this->crud_model->get_total_received_amount($id);

		// // Get List of Client Payments
		// $data['client_payments'] = $this->crud_model->get_client_payments($id);

		// Set Page Title
		$data['page_title'] = "Suppliers Ledger";

		// Load Views
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/Suppliers/ledgers');
		$this->load->view('Admin/footer');
	}

	public function unit_setup()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data['page_title']	=	"Settings - Unit Setup";
		$data['units'] = $this->crud_model->get_unit_settings();

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/Settings/unitsetup');
		$this->load->view('Admin/footer');
	}

	public function update_settings()
	{
		// Get form data
		$settings_data = [
			'name' => $this->input->post('name'),
			'title' => $this->input->post('title'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'currency' => $this->input->post('currency'),
			'unit' => $this->input->post('unit'),
			'date_format' => $this->input->post('date_format'),
			'login_title' => $this->input->post('login_title'),
		];

		// Check for optional fields and validate them if provided
		if ($settings_data['email'] && !filter_var($settings_data['email'], FILTER_VALIDATE_EMAIL)) {
			$this->session->set_flashdata('error', 'Invalid email format.');
			redirect('admin/settings');
		}

		// Handle file upload for image if provided
		if ($_FILES['img_url']['name']) {
			move_uploaded_file($_FILES['img_url']['tmp_name'], 'uploads/settings/' . 'logo.jpg');
		}

		// Save the settings to the database
		if ($this->crud_model->update_settings($settings_data)) {
			$this->session->set_flashdata('success', 'Settings updated successfully.');
			redirect('admin/settings');
		} else {
			$this->session->set_flashdata('error', 'Failed to update settings.');
			redirect('admin/settings');
		}
	}

	public function add_staff()
	{
		// Get form data
		$staff_data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'description' => $this->input->post('description'),
			'password' => md5($this->input->post('password')),
			'encrypted_id' => random_string('alnum', 100)
		];

		// Save the staff data to the database and get the inserted staff ID
		$insert_id = $this->crud_model->add_staff($staff_data);

		if ($insert_id) {
			// Handle file upload for image if provided
			if ($_FILES['staff_image']['name']) {
				$file_name = $insert_id . '.jpg';
				move_uploaded_file($_FILES['staff_image']['tmp_name'], 'uploads/staff/' . $file_name);

				// Update staff record with the image file name
				$this->crud_model->update_staff($insert_id, ['image' => $file_name]);
			}

			$this->session->set_flashdata('success', 'Staff added successfully.');
			redirect('admin/staff');
		} else {
			$this->session->set_flashdata('error', 'Failed to add staff.');
			redirect('admin/staff');
		}
	}



	public function delete_staff($id)
	{
		// Delete the staff from the database
		if ($this->crud_model->delete_staff($id)) {
			$this->session->set_flashdata('success', 'Staff deleted successfully.');
			redirect('admin/staff');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete staff.');
			redirect('admin/staff');
		}
	}


	public function update_staff($id)
	{
		// Get form data
		$staff_data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'description' => $this->input->post('description'),
		];

		// Update password if provided
		if ($this->input->post('password')) {
			$staff_data['password'] = md5($this->input->post('password'));
		}

		$user_id  = $this->db->get_where('users', array('encrypted_id' => $id))->row()->id;

		// Handle file upload for image if provided
		if ($_FILES['staff_image']['name']) {
			$file_name = $user_id . '.jpg';
			move_uploaded_file($_FILES['staff_image']['tmp_name'], 'uploads/staff/' . $file_name);
			$staff_data['image'] = $file_name;
		}

		// Update the staff data in the database
		if ($this->crud_model->update_staff($id, $staff_data)) {
			$this->session->set_flashdata('success', 'Staff updated successfully.');
			redirect('admin/staff');
		} else {
			$this->session->set_flashdata('error', 'Failed to update staff.');
			redirect('admin/staff');
		}
	}


	public function create_unit_settings()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		// Get form data
		$unit_data = [
			'unit_name' => $this->input->post('un_name'),
			'unit_description' => $this->input->post('un_description'),
			'encrypted_id' => random_string('alnum', 100)
		];

		// Validate required fields
		if (empty($unit_data['unit_name'])) {
			$this->session->set_flashdata('error', 'Unit name is required.');
			redirect('admin/unit_setup');
		}

		if ($this->crud_model->create_unit($unit_data)) {
			$this->session->set_flashdata('success', 'Unit settings created successfully.');
			redirect('admin/unit_setup');
		} else {
			$this->session->set_flashdata('error', 'Failed to create unit settings.');
			redirect('admin/unit_setup');
		}
	}

	public function update_unit_settings($encryption_id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		// Get form data
		$unit_data = [
			'unit_name' => $this->input->post('un_name'),
			'unit_description' => $this->input->post('un_description'),
			'encrypted_id' => $encryption_id
		];

		// Validate required fields
		if (empty($unit_data['unit_name'])) {
			$this->session->set_flashdata('error', 'Unit name is required.');
			redirect('admin/unit_setup');
		}

		if ($this->crud_model->update_unit_settings($unit_data)) {
			$this->session->set_flashdata('success', 'Unit settings updated successfully.');
			redirect('admin/unit_setup');
		} else {
			$this->session->set_flashdata('error', 'Failed to update unit settings.');
			redirect('admin/unit_setup');
		}
	}

	public function delete_unit()
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			redirect(base_url(), 'refresh');
		}

		$unit_id = $this->input->get('unit_id');

		if ($unit_id) {
			// Check if unit exists
			$unit = $this->crud_model->get_unit_by_id($unit_id);

			if ($unit) {
				// Proceed to delete the unit
				$this->crud_model->delete_unit($unit_id);
				$this->session->set_flashdata('success', 'Unit deleted successfully.');
			} else {
				$this->session->set_flashdata('error', 'Unit not found.');
			}
		} else {
			$this->session->set_flashdata('error', 'Invalid unit ID.');
		}

		redirect(base_url('admin/unit_setup'));
	}

	public function update_profile()
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			redirect(base_url(), 'refresh');
		}

		// Get form data
		$name = $this->input->post('name');
		$password = $this->input->post('password');
		$confirm_password = $this->input->post('confirm_password');

		// Validate and update the user profile
		if ($password && $password === $confirm_password) {
			// Hash new password
			$hashed_password = md5($password);

			// Update user details
			$update_data = [
				'admin_name' => $name,
				'admin_password' => $hashed_password
			];
		} else {
			// Only update name if password is not changed
			$update_data = [
				'admin_name' => $name
			];
		}

		// Update user profile in database
		if ($this->crud_model->update_user_profile($update_data)) {
			// Update the session with the new admin name
			$this->session->set_userdata('admin_name', $name);

			$this->session->set_flashdata('success', 'Profile updated successfully.');
		} else {
			$this->session->set_flashdata('error', 'Failed to update profile.');
		}

		redirect(base_url('admin/profile'));
	}


	public function add_staff_payment($staff_id)
	{
		// Get form data
		$payment_data = [
			'sfp_sf_id' => $staff_id,
			'sfp_payment_amount' => $this->input->post('payment_amount'),
			'sfp_paid_by' => $this->input->post('paid_by'),
			'sfp_reference' => $this->input->post('reference_number'),
			'sfp_date' => $this->input->post('payment_date'),
			'sfp_description' => $this->input->post('description'),
			'sfp_created_by' => $this->session->userdata('admin_encrypted_id'),
			'sfp_created_at' => date('Y-m-d H:i:s')
		];

		// Insert payment data
		$insert_id = $this->crud_model->add_payment($payment_data);

		if ($insert_id) {
			$this->session->set_flashdata('success', 'Payment added successfully.');
			redirect('/admin/staff_payments/' . $staff_id);
		} else {
			$this->session->set_flashdata('error', 'Failed to add payment.');
			redirect('/admin/staff_payments/' . $staff_id);
		}
	}

	public function delete_staff_payment($payment_id)
	{
		// Delete payment by ID
		$deleted = $this->crud_model->delete_payment($payment_id);

		if ($deleted) {
			$this->session->set_flashdata('success', 'Payment deleted successfully.');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete payment.');
		}

		redirect($_SERVER['HTTP_REFERER']);
	}



	public function add_client()
	{
		// Get form data
		$client_data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'description' => $this->input->post('description'),
			'encrypted_id' => random_string('alnum', 100)
		];

		// Save the client data to the database and get the inserted client ID
		$insert_id = $this->crud_model->add_client($client_data);

		if ($insert_id) {
			// Handle file upload for image if provided
			if ($_FILES['client_image']['name']) {
				$file_name = $insert_id . '.jpg';
				move_uploaded_file($_FILES['client_image']['tmp_name'], 'uploads/clients/' . $file_name);

				// Update client record with the image file name
				$this->crud_model->update_client($insert_id, ['image' => $file_name]);
			}

			$this->session->set_flashdata('success', 'Client added successfully.');
			redirect('admin/clients');
		} else {
			$this->session->set_flashdata('error', 'Failed to add client.');
			redirect('admin/clients');
		}
	}

	public function delete_client($id)
	{
		// Delete the client from the database
		if ($this->crud_model->delete_client($id)) {
			$this->session->set_flashdata('success', 'Client deleted successfully.');
			redirect('admin/clients');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete client.');
			redirect('admin/clients');
		}
	}

	public function update_client($id)
	{
		// Get form data
		$client_data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'description' => $this->input->post('description'),
		];

		$client_id  = $this->db->get_where('clients', array('encrypted_id' => $id))->row()->id;

		// Handle file upload for image if provided
		if ($_FILES['client_image']['name']) {
			$file_name = $client_id . '.jpg';
			move_uploaded_file($_FILES['client_image']['tmp_name'], 'uploads/clients/' . $file_name);
			$client_data['image'] = $file_name;
		}

		// Update the client data in the database
		if ($this->crud_model->update_client($id, $client_data)) {
			$this->session->set_flashdata('success', 'Client updated successfully.');
			redirect('admin/clients');
		} else {
			$this->session->set_flashdata('error', 'Failed to update client.');
			redirect('admin/clients');
		}
	}


	public function add_livestock()
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			redirect(base_url(), 'refresh');
		}

		// Get the current admin ID from session
		$created_by = $this->session->userdata('admin_id');

		// Prepare data for insertion
		$data = array(
			'ls_lst_type_id' => 1, // assuming a default livestock type, modify as necessary
			'ls_name' => $this->input->post('name'),
			'ls_description' => $this->input->post('description'),
			'ls_status' => 1,
			'ls_created_by' => $created_by,
			'ls_created_at' => date('Y-m-d H:i:s'),
			'ls_updated_by' => $created_by,
			'ls_updated_at' => date('Y-m-d H:i:s'),
			'encrypted_id' => random_string('alnum', 100)
		);

		// Call the model method to insert the data into the database
		$insert_id = $this->crud_model->insert_livestock($data);

		if ($insert_id) {
			$this->session->set_flashdata('success', 'Livestock added successfully.');
			redirect(base_url('admin/livestock'), 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Failed to add livestock.');
			redirect(base_url('admin/livestock'), 'refresh');
		}
	}

	public function update_livestock($id)
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			redirect(base_url(), 'refresh');
		}

		// Get the current admin ID from session
		$updated_by = $this->session->userdata('admin_id');

		// Prepare data for update
		$data = array(
			'ls_name' => $this->input->post('name'),
			'ls_description' => $this->input->post('description'),
			'ls_updated_by' => $updated_by,
			'ls_updated_at' => date('Y-m-d H:i:s')
		);

		// Call the model method to update the livestock data
		$update_status = $this->crud_model->update_livestock($id, $data);

		if ($update_status) {
			$this->session->set_flashdata('success', 'Livestock updated successfully.');
			redirect(base_url('admin/livestock'), 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Failed to update livestock.');
			redirect(base_url('admin/livestock'), 'refresh');
		}
	}

	public function delete_livestock($id)
	{
		if ($this->session->userdata('admin_login') != TRUE) {
			redirect(base_url(), 'refresh');
		}

		// Call the model method to delete the livestock record
		$delete_status = $this->crud_model->delete_livestock($id);

		if ($delete_status) {
			$this->session->set_flashdata('success', 'Livestock deleted successfully.');
			redirect(base_url('admin/livestock'), 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete livestock.');
			redirect(base_url('admin/livestock'), 'refresh');
		}
	}


	public function add_livestock_variant()
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$data = array(
			'lst_ls_id' => $this->input->post('livestock_id'),
			'encrypted_id' => random_string('alnum', 100),
			'lst_title' => $this->input->post('variant_title'),
			'lst_description' => $this->input->post('variant_description'),
			'lst_status' => 1,
			'lst_created_by' => $this->session->userdata('admin_id'),
			'lst_created_at' => date('Y-m-d H:i:s'),
			'lst_updated_by' => $this->session->userdata('admin_id'),
			'lst_updated_at' => date('Y-m-d H:i:s'),
		);

		// Call the model method to insert the data into the database
		$insert_id = $this->crud_model->insert_variant($data);

		if ($insert_id) {
			$this->session->set_flashdata('success', 'Livestock variant added  successfully.');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->session->set_flashdata('error', 'Failed to add livestock variant.');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	public function delete_variant($variant_id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		$this->crud_model->delete_variant($variant_id);
		$this->session->set_flashdata('success', 'Livestock variant deleted successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}


	public function update_livestock_variant($encrypted_id)
	{
		if ($this->session->userdata('admin_login') != TRUE)
			redirect(base_url(), 'refresh');

		// Get the existing variant data
		$variant = $this->crud_model->get_variant_by_id($encrypted_id);

		if ($variant) {
			$data = array(
				'lst_title' => $this->input->post('title'),
				'lst_description' => $this->input->post('description'),
				'lst_updated_by' => $this->session->userdata('admin_id'),
				'lst_updated_at' => date('Y-m-d H:i:s'),
			);

			// Call the model method to update the variant
			$updated = $this->crud_model->update_variant($encrypted_id, $data);

			if ($updated) {
				$this->session->set_flashdata('success', 'Livestock variant updated successfully.');
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$this->session->set_flashdata('error', 'Failed to update livestock variant.');
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			$this->session->set_flashdata('error', 'Livestock variant not found.');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	public function add_supplier()
	{
		// Get form data
		$supplier_data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'description' => $this->input->post('description'),
			'encrypted_id' => random_string('alnum', 100)
		];

		// Save the supplier data to the database and get the inserted supplier ID
		$insert_id = $this->crud_model->add_supplier($supplier_data);

		if ($insert_id) {
			// Handle file upload for image if provided
			if ($_FILES['supplier_image']['name']) {
				$file_name = $insert_id . '.jpg';
				move_uploaded_file($_FILES['supplier_image']['tmp_name'], 'uploads/suppliers/' . $file_name);
			}

			$this->session->set_flashdata('success', 'Supplier added successfully.');
			redirect('admin/suppliers');
		} else {
			$this->session->set_flashdata('error', 'Failed to add supplier.');
			redirect('admin/suppliers');
		}
	}

	public function delete_supplier($id)
	{
		// Delete the supplier from the database
		if ($this->crud_model->delete_supplier($id)) {
			$this->session->set_flashdata('success', 'Supplier deleted successfully.');
			redirect('admin/suppliers');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete supplier.');
			redirect('admin/suppliers');
		}
	}

	public function update_supplier($id)
	{
		// Get form data
		$supplier_data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'description' => $this->input->post('description'),
		];

		$supplier_id = $this->db->get_where('suppliers', array('encrypted_id' => $id))->row()->id;

		// Handle file upload for image if provided
		if ($_FILES['supplier_image']['name']) {
			$file_name = $supplier_id . '.jpg';
			move_uploaded_file($_FILES['supplier_image']['tmp_name'], 'uploads/suppliers/' . $file_name);
		}

		// Update the supplier data in the database
		if ($this->crud_model->update_supplier($id, $supplier_data)) {
			$this->session->set_flashdata('success', 'Supplier updated successfully.');
			redirect('admin/suppliers');
		} else {
			$this->session->set_flashdata('error', 'Failed to update supplier.');
			redirect('admin/suppliers');
		}
	}

}
