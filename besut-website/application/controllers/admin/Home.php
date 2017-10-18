<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Handler_Admin {

	public function __construct()
	{
		parent::__construct();
	}

  function index()
  {
    $this->load->view('admin/header', $this->data);
		$this->load->view('admin/home');
		$this->load->view('admin/footer');
  }
}
