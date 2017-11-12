<?php

class Data_user extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function setNewUser($uname, $uemail, $upassword, $photo, $ulocation) {
		// $userkey = md5(lpad(conv(floor(rand()*pow(36,8)), 10, 36), 8, 0));
		$userkey = md5($upassword);
    $passcode = hash('sha256', $upassword);
		$date = date("Y-m-d H:i:s");

    $data = ['USERKEY' => $userkey,
    'IDROLE' => 1,
    'UNAME' => $uname,
    'PROFILE_PIC' => $photo,
    'UEMAIL' => $uemail,
    'UPASSCODE' => $passcode,
    'ULOCATION' => $ulocation,
    'URATE' => 0,
    'REGISTRATION_DATE' => $date,
    'ACTIVE_STATUS' => true,
		`NOTIFICATION` => true];
		$this->db->insert('users', $data);
    if ($this->db->affected_rows() > 0)
      return $userkey;
    return FALSE;
  }

  //check user when login button clicked
  //if return false or there is no user in database or
  function checkUserLogin($uemail, $upassword) {
    $passcode = hash('sha256', $upassword);
		$query = $this->db->query("SELECT USERKEY, ACTIVE_STATUS FROM USERS WHERE UEMAIL = '$uemail' AND UPASSCODE = '$passcode'");

		if ($this->db->affected_rows() > 0) {
      if ($query->row()->ACTIVE_STATUS == false) // when user blocked by admin
        return "blocked user";

			return $query->row()->USERKEY;
    }
		return FALSE;
  }

  //checking user for key saved in cookies
  function checkKeySession($userkey) {
		$query = $this->db->query("SELECT `IDUSER` FROM USERS WHERE USERKEY = '$userkey' AND ACTIVE_STATUS = true");

		if ($this->db->affected_rows() > 0)
			return $query->row()->IDUSER;

		return false;
  }

	function getFoto($userkey) {
		$query = $this->db->query("SELECT PROFILE_PIC FROM USERS WHERE USERKEY = '$userkey'");

		if ($this->db->affected_rows() > 0)
			return $query->row()->PROFILE_PIC;

		return false;
  }

  function getDataUser($userkey) {
    $query = $this->db->select('IDROLE, UNAME, PROFILE_PIC, UEMAIL, URATE, REGISTRATION_DATE')->from('users')->get();
		return $query->result();
  }
}
