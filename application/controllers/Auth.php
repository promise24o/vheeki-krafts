<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{


	public function login()
	{

		if ($this->session->userdata('admin_login') === TRUE) {
			redirect(base_url('admin/dashboard'));
		}

		$this->load->view('Auth/header');
		$this->load->view('Auth/login');
		$this->load->view('Auth/footer');
	}

	public function confirm_login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('login')['password'];

		// Check if the email and password are valid
		$this->load->model('Crud_model');
		$result = $this->Crud_model->validate($email, $password);

		if ($result === 'admin') {
			redirect('admin/dashboard');   
		} else {
			$this->session->set_flashdata('error', 'Invalid email or password');
			redirect('auth/login');
		}
	}



	function logout()
	{
		$this->session->sess_destroy();
		$this->session->unset_userdata('logged_in');
		redirect(base_url(), 'refresh');
	}
}
