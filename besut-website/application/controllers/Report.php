<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends Handler_Core {

	public function __construct()
	{
		parent::__construct();
    $this->load->library('upload');
		$this->load->helper('file');
    $this->load->model('data_report');
	}

	public function index()
	{
		$this->load->view('header', $this->data);
		$this->load->view('report');
		$this->load->view('footer');
	}

  function view()
  {
      $reportIndex = $this->uri->segment(3);
      if (!is_numeric($reportIndex))
        redirect(base_url());
      $data_report = $this->data_report->getDataReport($reportIndex);
      $data_report->idreport = $reportIndex;
      $data_comments['comments'] = $this->data_report->getComments($reportIndex);
      // print_r($data_comments);
      $this->load->view('header', $this->data);
  		$this->load->view('view', $data_report);
      $this->load->view('comments', $data_comments);
  		$this->load->view('footer');
  }

  function vote()
  {
    if ($this->input->post('indexReport')) {
      $index = $this->input->post('indexReport');
      $vote = $this->input->post('vote');
      echo $this->data_report->setVote($index, $vote, $this->input->cookie('reg_userKeys',true));
    }
    echo false;
  }

  function voteComment()
  {
    if ($this->input->post('vote')) {
      $index = $this->input->post('comment');
      $vote = $this->input->post('vote');
      echo $this->data_report->setCommentVote($index, $vote, $this->input->cookie('reg_userKeys',true));
    }
    echo false;
  }

  function reply()
  {
    if ($this->input->post('reply')) {
      $report = $this->input->post('report');
      $parent = $this->input->post('parent');
      $reply = $this->input->post('reply');
      if ($this->data_report->makeComment($report, $parent, $reply, $this->input->cookie('reg_userKeys',true))) {
        $params = $this->data;
        $params['comments'] = $this->data_report->getComments($report);
        $this->load->view('comments', $params);
      }
    }
    echo false;
  }

  function submiting()
  {
    echo "submit";
    if (!empty($_POST))
    {
      echo "submit";
      $user = $this->data_user->getIndexUser($this->input->cookie('reg_userKeys',true));
      $title = $this->input->post('title');
      $link = $this->input->post('link');
      $web = $this->input->post('web');
      $desc = $this->input->post('desc');
      $facebook = $this->input->post('share_facebook');
      $twitter = $this->input->post('share_twitter');
      $google = $this->input->post('share_google');

      $filesCount = count($_FILES['photos']['name']);
      $folder = rand();
      $uploadData = "";
      $path = "data/pictures/reports/" . $folder;
      mkdir($path, 0777,true);
      for($i = 0; $i < $filesCount; $i++) {
        $_FILES['photo']['name'] = $_FILES['photos']['name'][$i];
        $_FILES['photo']['type'] = $_FILES['photos']['type'][$i];
        $_FILES['photo']['tmp_name'] = $_FILES['photos']['tmp_name'][$i];
        $_FILES['photo']['error'] = $_FILES['photos']['error'][$i];
        $_FILES['photo']['size'] = $_FILES['photos']['size'][$i];

        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if($this->upload->do_upload('photo')){
          $fileData = $this->upload->data();
          $uploadData = $uploadData . $folder . "/" . $fileData['file_name'] . "~";
        }
      }

      if(!empty($uploadData)) {
        $status = $this->data_report->newReport($user, $title, $link, $web, $desc, $uploadData);
        echo $status;
        if ($status) {
          redirect(base_url() . 'report/view/' . $status);
        }
        else
          echo "<script>alert('something is wrong');</sciprt>";
      }
    }
  }

}
