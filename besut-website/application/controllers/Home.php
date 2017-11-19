<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Handler_Core {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('data_report');
		$this->data['notif'] = $this->data_report->getNotif($this->session->userdata('regUserID'));
		$this->load->view('header', $this->data);
	}

	public function index()
	{
		$timeline['posts'] = $this->data_report->getReports('', 1);
		$timeline["links"] = $this->data_report->getPageIndex('');
		$timeline['now'] = 0;

		$this->load->view('home', $timeline);
		$this->load->view('footer');
	}

	function page()
	{
		$pageIndex = $this->uri->segment(3);
		// echo $pageIndex;
		if (!is_numeric($pageIndex))
			redirect(base_url());
		$timeline['posts'] = $this->data_report->getReports('', $pageIndex);
		$timeline["links"] = $this->data_report->getPageIndex('');
		$timeline['now'] = $pageIndex;
		// print_r($timeline);
		$this->load->view('home', $timeline);
		$this->load->view('footer');
	}

}
