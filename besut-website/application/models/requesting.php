<?php

class Requesting extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function getBlockedWebsites() {
    $query = $this->db->select('DOMAIN, REPORTED, WEBDESC, WEBACTIVE')
							->from('websites')
							->get();
		return $query->result();
  }
}
