<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Handler_Core {

	public function __construct()
	{
	    parent::__construct();
			$this->load->library('form_validation');
	}

	public function index()
	{
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$image = $this->input->post('image');
		$email = $this->input->post('email');
		$position = $this->input->post('position');

		$this->form_validation->set_rules('id', 'ID', 'trim|required|numeric');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('image', 'Image', 'trim|required');
		$this->form_validation->set_rules('position', 'Position', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == FALSE)
			echo "failed form validation";
		else
		{
			$status = $this->data_user->checkUserLogin($email, $id);
			if ($status == "blocked user")
				echo "blocked";
			else if ($status == false)
			{
				$filename = md5($name . rand()) . ".jpg";
				if(!@copy($image, "data/pictures/profile/" . $filename))
					echo "failed get photo";
				else
				{
					$token = $this->data_user->setNewUser($name, $email, $id, $filename, $position);
					if ($token != false)
					{
						$cookie = array(
							'name' => 'reg_userKeys',
							'value' => $token,
							'expire' => '3600'
						);
						$this->input->set_cookie($cookie);
					}
					else
						echo "failed creating new user";
				}
			}
			else {
				$cookie = array(
					'name' => 'reg_userKeys',
					'value' => $status,
					'expire' => '36000'
				);
				$this->input->set_cookie($cookie);

				$filename = $this->data_user->getFoto($status);
				if ($filename) {
					$cookie = array(
						'name' => 'reg_photo',
						'value' => $filename,
						'expire' => '36000'
					);
					$this->input->set_cookie($cookie);
				}
			}
		}
	}

	function logout()
	{
		echo "Delete";
		delete_cookie('reg_userKeys');
		$this->session->unset_userdata('regUserID');
	}
}
