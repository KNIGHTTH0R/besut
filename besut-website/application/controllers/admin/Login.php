<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Handler_Admin {

	public function index()
	{
		$this->load->view('admin/login', $this->data);
	}

	public function loggingin()
	{
		$this->load->model('data_admin');
		if ($this->input->post('btnLogin')) {
			$user = $this->input->post('email');
      $pass = $this->input->post('password');

			$admin = $this->data_admin->checkAdmin($user, $pass);
			if ($admin) {
				$newdata = array(
		        'reg_admin'  => $admin->IDADMIN,
		        'role'     => $admin->IDROLE
				);
				$this->session->set_userdata($newdata);
				redirect($this->data->baseurl . 'admin/home');
			}
		}
		redirect($this->data->baseurl . 'admin/login');
	}
}
