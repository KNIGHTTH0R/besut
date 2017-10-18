<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Handler_Core {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('data_report');
	}

	public function index()
	{
		$timeline['posts'] = $this->data_report->getReports(1);
		$timeline["links"] = $this->data_report->getPageIndex();
		$timeline['now'] = 0;

		$this->load->view('header', $this->data);
		$this->load->view('home', $timeline);
		$this->load->view('footer');
	}

	function page()
	{
		$pageIndex = $this->uri->segment(3);
		if (!is_numeric($pageIndex))
			redirect(base_url());
		$timeline = $this->data_report->getReports($pageIndex);
		$timeline['now'] = $pageIndex;
		// print_r($data_report);
		$this->load->view('header', $this->data);
		$this->load->view('home', $timeline);
		$this->load->view('footer');
	}

}
