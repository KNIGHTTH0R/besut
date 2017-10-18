<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Handler_Core {

	public function __construct()
	{
	    parent::__construct();
	}

	public function index()
	{
			$this->load->view('welcome');
	}
}
