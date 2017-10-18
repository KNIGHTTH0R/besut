<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Handler_Core extends CI_Controller {

	public $data = array();

	public function __construct()
	{
	    parent::__construct();
			$this->load->helper('cookie');
			$this->load->model('data_user');
			$this->load->helper('form');
      $this->load->helper('url');
			$isLogin = $this->isLoggedValid();
			$this->data['photo'] = $this->input->cookie('reg_photo',true);
			$this->data['position'] = $this->router->fetch_class();
			$this->data['baseurl'] = base_url();

			if (!$this->input->post('id'))
			{
				if ($isLogin && $this->router->fetch_class() == 'welcome')
					redirect('home');
				else if (!$isLogin && $this->router->fetch_class() != 'welcome')
					redirect('welcome');
			}
	}

	public function isLoggedValid()
  {
    $user = $this->input->cookie('reg_userKeys',true);
		if ($this->data_user->checkKeySession($user))
    	return isset($user);
		return false;
  }
}
