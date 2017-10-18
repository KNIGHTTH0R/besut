<?php

class Data_admin extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

  function checkAdmin($user, $password) {
    $passcode = hash('sha256', $password);
    $query = $this->db->query("SELECT IDADMIN, IDROLE FROM `admins` where (USERNAME = '$user' OR AEMAIL = '$user') AND APASSCODE = '$passcode'");
    if ($this->db->affected_rows() > 0)
		  return $query->row();
    return FALSE;
  }
}
