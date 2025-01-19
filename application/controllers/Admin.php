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
			if ($_FILES['image']['name']) {
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
		if ($_FILES['image']['name']) {
			$file_name = $user_id . '.jpg'; // File name set to staff ID
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
}
