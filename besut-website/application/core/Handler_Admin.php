<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Handler_Admin extends CI_Controller {

	public $data = array();

	public function __construct()
	{
	    parent::__construct();
      $this->load->library('session');
      $this->load->helper('url');
      $this->load->helper('form');
      $this->data['baseurl'] = base_url();
      if ($this->session->has_userdata('reg_admin') && $this->router->fetch_class() == 'login')
        redirect(base_url() . 'admin/home');
      else if (!$this->session->has_userdata('reg_admin') && $this->router->fetch_class() != 'login')
        redirect(base_url() . 'admin/login');
	}

	public function isLoggedValid()
  {

  }
}
