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
		if (file_exists('uploads/' . $type.'/'.$id . '.jpg'))
			$image_url = base_url() . 'uploads/'.$type.'/'.$id.'.jpg';
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

	
	public function add_payment($payment_data)
	{
		// Insert payment data into the database
		$this->db->insert('staff_payments', $payment_data);

		// Return the inserted payment ID
		return $this->db->insert_id();
	}


	// Get Staff Details by ID
	public function get_staff_by_id($id)
	{
		$this->db->where('encrypted_id', $id);
		$query = $this->db->get('users');
		return $query->row();
	}

	// Get Total Payment Amount for a Staff
	public function get_total_payment_amount($id)
	{
		$this->db->select_sum('sfp_payment_amount');
		$this->db->where('sfp_sf_id', $id);
		$query = $this->db->get('staff_payments');
		return $query->row()->sfp_payment_amount;
	}

	// Get Total Payment Count for a Staff
	public function get_total_payment_count($id)
	{
		$this->db->where('sfp_sf_id', $id);
		$query = $this->db->get('staff_payments');
		return $query->num_rows();
	}

	// Get List of Payments for a Staff
	public function get_payments_by_staff($id)
	{
		$this->db->select('staff_payments.*, admin.admin_name AS created_by_name');
		$this->db->from('staff_payments');
		$this->db->join('admin', 'staff_payments.sfp_created_by = admin.encrypted_id', 'left');
		$this->db->where('sfp_sf_id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function delete_payment($payment_id)
	{
		$this->db->where('sfp_id', $payment_id);
		return $this->db->delete('staff_payments');
	}


	// Add a new client
	public function add_client($client_data)
	{
		$this->db->insert('clients', $client_data);
		return $this->db->insert_id();  // return inserted client ID
	}

	// Delete a client
	public function delete_client($id)
	{
		return $this->db->delete('clients', ['encrypted_id' => $id]);
	}

	// Update client data
	public function update_client($id, $client_data)
	{
		return $this->db->update('clients', $client_data, ['encrypted_id' => $id]);
	}

	// Get client by encrypted ID (optional, in case you need to fetch details before update)
	public function get_client($id)
	{
		return $this->db->get_where('clients', ['encrypted_id' => $id])->row();
	}

	public function get_all_clients()
	{
		$this->db->select('*');
		$this->db->from('clients');
		$query = $this->db->get();
		return $query->result();
	}

	public function insert_livestock($data)
	{
		$this->db->insert('livestock',
			$data
		);
		return $this->db->insert_id();
	}

	public function update_livestock($id, $data)
	{
		$this->db->where('encrypted_id', $id);
		return $this->db->update('livestock', $data);
	}

	public function delete_livestock($id)
	{
		$this->db->where('encrypted_id', $id);
		return $this->db->delete('livestock');
	}

	public function get_livestock_by_id($id)
	{
		$this->db->where('encrypted_id', $id);
		return $this->db->get('livestock')->row();
	}

	public function get_all_livestocks()
	{
		$this->db->select('livestock.*, COUNT(livestock_variants.lst_id) AS variant_count');
		$this->db->from('livestock');
		$this->db->join('livestock_variants', 'livestock.ls_id = livestock_variants.lst_ls_id', 'left');
		$this->db->group_by('livestock.ls_id');
		$query = $this->db->get();
		return $query->result();
	}


	public function insert_variant($data)
	{
		$this->db->insert('livestock_variants', $data);
		return $this->db->insert_id();
	}

	public function get_variant_by_id($variant_id)
	{
		if (is_numeric($variant_id)) {
			$this->db->where('lst_id', $variant_id);
		} else {
			$this->db->where('encrypted_id', $variant_id);
		}

		$query = $this->db->get('livestock_variants');
		return $query->row();
	}


	public function update_variant($variant_id, $data)
	{
		$this->db->where('encrypted_id', $variant_id);
		$this->db->update('livestock_variants', $data);
	}

	public function delete_variant($variant_id)
	{
		$this->db->where('encrypted_id', $variant_id);
		$this->db->delete('livestock_variants');
	}
	
	public function get_variants_by_livestock($encrypted_id)
	{
		// Get the ls_id using the encrypted_id
		$this->db->select('ls_id');
		$this->db->where('encrypted_id', $encrypted_id);
		$query = $this->db->get('livestock');
		$livestock = $query->row();

		if ($livestock) {
			$livestock_id = $livestock->ls_id;

			// Now get the variants based on ls_id
			$this->db->where('lst_ls_id', $livestock_id);
			$query = $this->db->get('livestock_variants');
			return $query->result();
		}

		return []; // Return empty array if no livestock found
	}


	// Add a new supplier
	public function add_supplier($supplier_data)
	{
		$this->db->insert('suppliers', $supplier_data);
		return $this->db->insert_id();  // return inserted supplier ID
	}

	// Delete a supplier
	public function delete_supplier($id)
	{
		return $this->db->delete('suppliers', ['encrypted_id' => $id]);
	}

	// Update supplier data
	public function update_supplier($id, $supplier_data)
	{
		return $this->db->update('suppliers', $supplier_data, ['encrypted_id' => $id]);
	}

	// Get supplier by encrypted ID
	public function get_supplier($id)
	{
		return $this->db->get_where('suppliers', ['encrypted_id' => $id])->row();
	}

	// Get all suppliers
	public function get_all_suppliers()
	{
		$this->db->select('*');
		$this->db->from('suppliers');
		$query = $this->db->get();
		return $query->result();
	}

}
