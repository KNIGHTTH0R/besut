<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends Handler_Core {

	protected $search = '';

	public function __construct()
	{
		parent::__construct();

		if ($this->input->post('search'))
			$this->session->set_userdata('search', $this->input->post('search'));
		else if ($this->session->userdata('search') == '')
			redirect('home');
		$this->search = $this->session->userdata('search');

		$this->load->model('data_report');
		$this->data['notif'] = $this->data_report->getNotif($this->session->userdata('regUserID'));
		$this->data['search'] = $this->search;
		$this->load->view('header', $this->data);
	}

	public function index()
	{
		$timeline['posts'] = $this->data_report->getReports($this->search, 1);
		$timeline["links"] = $this->data_report->getPageIndex($this->search);
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
		$timeline['posts'] = $this->data_report->getReports($this->search, $pageIndex);
		$timeline["links"] = $this->data_report->getPageIndex($this->search);
		$timeline['now'] = $pageIndex;
		// print_r($timeline);
		$this->load->view('home', $timeline);
		$this->load->view('footer');
	}
}
