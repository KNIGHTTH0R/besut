<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requests extends CI_Controller {

  public function __construct()
	{
	    parent::__construct();
      $this->load->model('requesting');
	}

  public function blockedsites()
  {
      $this->output->set_output(json_encode($this->requesting->getBlockedWebsites()));
  }
}
