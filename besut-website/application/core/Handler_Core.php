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
			$this->load->library('session');
			$isLogin = $this->isLoggedValid();
			$this->data['photo'] = $this->input->cookie('reg_photo',true);
			$this->data['position'] = $this->router->fetch_class();
			$this->data['baseurl'] = base_url();

			if ($this->router->fetch_class() != 'search')
				$this->session->unset_userdata('search');

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
		$userid = $this->data_user->checkKeySession($user);
		if ($userid) {
			$this->session->set_userdata('regUserID', $userid);
			return TRUE;
		}
		return false;
  }

	function cleanString($param)
	{
		$dirtyDoc = str_replace('*', "", $param);
		$dirtyDoc = str_replace('\r\n', " ", $dirtyDoc);
		$dirtyDoc = preg_replace('/[^A-Za-z]+/', ' ', $dirtyDoc);
		// echo $dirtyDoc . '<hr>';
		//panggil python
		$output = '';
		if (strlen($dirtyDoc) > 8153)
			$dirtyDoc = substr($dirtyDoc, 0, 8153);
		exec("python assets\\stemmer.py " . $dirtyDoc, $output);

		// var_dump($output);
		// echo "<br>";
		return $output[0];
	}
}
