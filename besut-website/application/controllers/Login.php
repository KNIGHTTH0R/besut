<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Handler_Core {

	public function index()
	{
		$this->load->view('login');
	}

	public function logged()
	{

	}
}
