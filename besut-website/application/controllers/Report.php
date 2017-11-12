<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends Handler_Core {

	public function __construct()
	{
		parent::__construct();
    $this->load->library('upload');
		$this->load->helper('file');
    $this->load->model('data_report');
		$this->data['notif'] = $this->data_report->getNotif($this->session->userdata('regUserID'));
		$this->load->view('header', $this->data);
	}

	public function index()
	{
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
			$data_report->focuson = '';
			if ($this->uri->segment(4))
				$data_report->focuson = $this->uri->segment(4);
      // print_r($data_comments);
  		$this->load->view('view', $data_report);
      $this->load->view('comments', $data_comments);
  		$this->load->view('footer');
  }

	function markNotif() {
		if ($this->input->post('id'))
      $this->data_report->markNotif($this->input->post('id'));
    else
    	echo false;
	}

  function vote()
  {
    if ($this->input->post('indexReport')) {
      $index = $this->input->post('indexReport');
      $vote = $this->input->post('vote');
      echo $this->data_report->setVote($index, $vote, $this->session->userdata('regUserID'));
    }
    echo false;
  }

  function voteComment()
  {
    if ($this->input->post('vote')) {
      $index = $this->input->post('comment');
      $vote = $this->input->post('vote');
      echo $this->data_report->setCommentVote($index, $vote, $this->session->userdata('regUserID'));
    }
    echo false;
  }

  function reply()
  {
    if ($this->input->post('reply')) {
      $report = $this->input->post('report');
      $parent = $this->input->post('parent');
      $reply = $this->input->post('reply');
      if ($this->data_report->makeComment($report, $parent, $reply, $this->session->userdata('regUserID'))) {
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
      $user = $this->session->userdata('regUserID');;
      $title = $this->input->post('title');
      $link = $this->input->post('link');
      $web = $this->input->post('web');
      $desc = $this->input->post('desc');
      $facebook = $this->input->post('share_facebook');
      $twitter = $this->input->post('share_twitter');
      $google = $this->input->post('share_google');

      $filesCount = count($_FILES['photos']['name']);
			echo $_FILES['photos']['size'][0];
			$uploadData = "";
			if ($_FILES['photos']['name'][0] != "") {
	      $folder = rand();
	      $path = "data/pictures/reports/" . $folder;
	      mkdir($path, 0777,true);
	      for($i = 0; $i < $filesCount; $i++) {
	        $_FILES['photo']['name'] = $_FILES['photos']['name'][$i];
	        $_FILES['photo']['type'] = $_FILES['photos']['type'][$i];
	        $_FILES['photo']['tmp_name'] = $_FILES['photos']['tmp_name'][$i];
	        $_FILES['photo']['error'] = $_FILES['photos']['error'][$i];
	        $_FILES['photo']['size'] = $_FILES['photos']['size'][$i];

	        $config['upload_path'] = $path;
	        $config['allowed_types'] = 'gif|jpg|png|mp4';
					$config['max_size'] = '102400';
					$config['remove_spaces'] = TRUE;

	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);
	        if($this->upload->do_upload('photo')){
	          $fileData = $this->upload->data();
	          $uploadData = $uploadData . $folder . "/" . $fileData['file_name'] . "~";
	        }
				}
      }

      if(!empty($uploadData) || $_FILES['photos']['name'][0] == "") {
        $status = $this->data_report->newReport($user, $title, $link, $web, $desc, $uploadData);
        echo $status;
        if ($status && $this->estimating($status)) {
          redirect(base_url() . 'report/view/' . $status);
        }
        else
          echo "<script>alert('something is wrong');</sciprt>";
      }
    }
  }

	function calculating()
	{

		$this->load->model('words_processing');

		// NAIVE BAYES
		$variables = $this->words_processing->getBasicDictionaryVariables();

		$totalDocs = $this->words_processing->getTotalDocs();
		$positiveDocs = $this->words_processing->getPositiveHoaxDocs();
		$negativeDocs = $this->words_processing->getNegativeHoaxDocs();

		$pPositive = $positiveDocs/$totalDocs;
		$pNegative = $negativeDocs/$totalDocs;

		$doc = $this->data_report->getDataReport(96);
		$content = $this->cleanString($doc->WEBCONTENT);
		$words = explode(' ',$content);
		$existedWords = $this->words_processing->getValueOfWords($words);

		$vPositive = $pPositive * 1000000;
		$vNegative = $pNegative * 1000000;

		$counts = array_count_values($words);

		$nPlusVocabPositive = $variables->positive + $variables->vocabulary;
		$nPlusVocabNegative = $variables->negative + $variables->vocabulary;

		foreach ($existedWords as $word) {
			$pWord = pow((($word->positive + 1) / $nPlusVocabPositive), $counts[$word->dword]) * 1000000;
			$nWord = pow((($word->negative + 1) / $nPlusVocabNegative), $counts[$word->dword]) * 1000000;
			echo $word->dword . ' positive = ' . $pWord . ' negative = ' . $nWord . "<br>";
			$vPositive = $vPositive * $pWord;
			$vNegative = $vNegative * $nWord;
			echo "vPositive: " . $vPositive . " vNegative: " . $vNegative . "<br><br>";
		}

		// END OF NAIVE BAYES
		echo "<hr>Positive: " . $vPositive . " Negative: " . $vNegative;
		$estimation = $vPositive > $vNegative? "HOAX" : " BUKAN HOAX";
		echo $estimation;

		// return $this->words_processing->setBotEstimation($indexReport, $estimation);
	}

	function estimating($index)
	{

		$this->load->model('words_processing');

		// NAIVE BAYES
		$variables = $this->words_processing->getBasicDictionaryVariables();

		$totalDocs = $this->words_processing->getTotalDocs();
		$positiveDocs = $this->words_processing->getPositiveHoaxDocs();
		$negativeDocs = $this->words_processing->getNegativeHoaxDocs();

		$pPositive = $positiveDocs/$totalDocs;
		$pNegative = $negativeDocs/$totalDocs;

		$doc = $this->data_report->getDataReport($index);
		$content = $this->cleanString($doc->WEBCONTENT);
		$words = explode(' ',$content);
		$existedWords = $this->words_processing->getValueOfWords($words);

		$vPositive = $pPositive * 1000000;
		$vNegative = $pNegative * 1000000;

		$counts = array_count_values($words);

		$nPlusVocabPositive = $variables->positive + $variables->vocabulary;
		$nPlusVocabNegative = $variables->negative + $variables->vocabulary;

		foreach ($existedWords as $word) {
			$pWord = pow((($word->positive + 1) / $nPlusVocabPositive), $counts[$word->dword]) * 1000000;
			$nWord = pow((($word->negative + 1) / $nPlusVocabNegative), $counts[$word->dword]) * 1000000;
			//echo $word->dword . ' positive = ' . $pWord . ' negative = ' . $nWord . "<br>";
			$vPositive = $vPositive * $pWord;
			$vNegative = $vNegative * $nWord;
			//echo "vPositive: " . $vPositive . " vNegative: " . $vNegative . "<br><br>";
		}

		// END OF NAIVE BAYES
		//echo "<hr>Positive: " . $vPositive . " Negative: " . $vNegative;
		$estimation = $vPositive > $vNegative? "HOAX" : " BUKAN HOAX";
		//echo $estimation;

		return $this->words_processing->setBotEstimation($indexReport, $estimation);
	}




}
