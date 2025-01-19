<?php
class Crud_model extends CI_Model
{

	////////LOGIN VALIDATION//////////
	function validate($email = '', $password = '')
	{
		$admin_credential = array('admin_email' => $email, 'admin_password' => MD5($password));
		$user_credential = array('email' => $email, 'password' => MD5($password));


		// Checking login credential for Admin
		$query = $this->db->get_where('admin', $admin_credential);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$this->session->set_userdata('admin_login', TRUE);
			$this->session->set_userdata('admin_id', $row->admin_id);
			$this->session->set_userdata('admin_name', $row->admin_name);
			$this->session->set_userdata('admin_encrypted_id', $row->encrypted_id);
			$this->session->set_userdata('email', $row->admin_email);
			$this->session->set_userdata('logged_in', TRUE);
			return 'admin';
		}
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
		if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
			$image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
		else
			$image_url = base_url() . 'uploads/user.png';

		return $image_url;
	}

	////////IMAGE URL//////////
	function get_user_profile_image($type = '', $id = '')
	{
		if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
			$image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
		else
			$image_url = base_url() . 'uploads/user.png';

		return $image_url;
	}

	// Get current settings
	public function get_settings()
	{
		$query = $this->db->get('settings'); 
		return $query->row_array();
	}

	// Update settings
	public function update_settings($data)
	{
		// Check if settings exist for ID 1
		$query = $this->db->get_where('settings', ['id' => 1]);

		if ($query->num_rows() > 0) {
			// Update settings if exists
			return $this->db->update('settings', $data, ['id' => 1]);
		} else {
			// Insert new settings if not exists
			$data['id'] = 1;  // Ensure the ID is set to 1
			return $this->db->insert('settings', $data);
		}
	}


	// Create a new unit
	public function create_unit($unit_data)
	{
		$this->db->insert('units', $unit_data);
		return $this->db->insert_id();  // Return the ID of the newly inserted unit
	}

	// Read unit settings
	public function get_unit_settings()
	{
		$this->db->select('*');
		$this->db->from('units');
		$query = $this->db->get();
		return $query->result_array();  // Return all units
	}

	// Update unit settings
	public function update_unit_settings($unit_data)
	{
		$this->db->where('encrypted_id', $unit_data['encrypted_id']);  
		return $this->db->update('units', $unit_data);
	}

	// Delete unit
	public function delete_unit($unit_id)
	{
		$this->db->where('encrypted_id', $unit_id);
		return $this->db->delete('units');  
	}

	// Retrieve a single unit by ID
	public function get_unit_by_id($unit_id)
	{
		$this->db->select('*');
		$this->db->from('units');
		$this->db->where('encrypted_id', $unit_id);
		$query = $this->db->get();
		return $query->row_array(); 
	}

	// CRUD Method for retrieving user details by ID
	public function get_user_by_id($admin_id)
	{
		return $this->db->get_where('admin', ['admin_id' => $admin_id])->row_array();
	}

	// CRUD Method for updating user profile
	public function update_user_profile($update_data)
	{
		$admin_id = $this->session->userdata('admin_id');
		$this->db->where('admin_id', $admin_id);
		return $this->db->update('admin', $update_data);
	}


	// Add staff
	public function add_staff($staff_data)
	{
		$this->db->insert('users', $staff_data);
		return $this->db->insert_id(); // Return the ID of the inserted staff
	}

	// Update staff
	public function update_staff($id, $staff_data)
	{
		$this->db->where('encrypted_id', $id);
		return $this->db->update('users', $staff_data); // Returns true if update is successful
	}

	// Delete staff
	public function delete_staff($id)
	{
		$this->db->where('encrypted_id', $id);
		return $this->db->delete('users'); // Returns true if deletion is successful
	}

	// Get staff by ID
	public function get_staff($id)
	{
		$this->db->where('encrypted_id', $id);
		$query = $this->db->get('users');
		return $query->row(); // Return a single staff object
	}

	// Get all staff
	public function get_all_staff()
	{
		$query = $this->db->get('users');
		return $query->result(); // Return an array of all staff objects
	}

	
}
