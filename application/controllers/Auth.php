<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('crud_model');
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function login()
	{
		if ($this->session->userdata('admin_login') === TRUE) {
			redirect(base_url('admin/dashboard'));
		}

		$data['page_title'] = 'Admin Login';
		$this->load->view('Components/AuthHeader', $data);
		$this->load->view('Admin/Login');
		$this->load->view('Components/AuthFooter');
	}

	public function page_not_found()
	{
		$this->load->view('Auth/not_found');
	}

	public function confirm_login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		if (empty($email) || empty($password)) {
			$this->session->set_flashdata('error', 'Please enter both email and password');
			redirect('auth/login');
			return;
		}

		$result = $this->crud_model->validate($email, $password);

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
