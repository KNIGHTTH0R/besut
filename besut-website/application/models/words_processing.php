<?php

class Words_processing extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

  function getValueOfWords($params)
  {
    $query = $this->db->select('dword, positive, negative')
							->from('dictionary')
							->where_in('dword', $params)
							->get();
    return $query->result();
  }

  function getDocs($closed, $finished, $idreport)
  {
    $strQuery = "SELECT
          IDREPORT,
          WEBCONTENT,
          HOAXVAL
          FROM `post_reports`
          WHERE CLOSED = $closed AND INDICTIONARY = $finished";
    if ($idreport != null) $strQuery .= " AND IDREPORT = $idreport";
    $query = $this->db->query($strQuery);
    return $query->result();
  }

  function getBasicDictionaryVariables()
  {
    $query = $this->db->query("SELECT
          COUNT(dword) as vocabulary,
          SUM(positive) as positive,
          SUM(negative) as negative
          FROM `dictionary`");
    return $query->row();
  }

  function getTotalDocs()
  {
    $query = $this->db->query("SELECT
          COUNT(INDICTIONARY) as totalDocs
          FROM `POST_REPORTS`
          WHERE INDICTIONARY = true");
    return $query->row()->totalDocs;
  }

  function getSumClassDictionary()
  {
    $query = $this->db->query("SELECT
          SUM(positive) as nPositve,
          SUM(negative) as nNegative
          FROM `dictionary`");
    return $query->row();
  }

  function getPositiveHoaxDocs()
  {
    $query = $this->db->query("SELECT
          COUNT(INDICTIONARY) as totalDocs
          FROM `POST_REPORTS`
          WHERE INDICTIONARY = true AND HOAXVAL = true");
    return $query->row()->totalDocs;
  }

  function getNegativeHoaxDocs()
  {
    $query = $this->db->query("SELECT
          COUNT(INDICTIONARY) as totalDocs
          FROM `POST_REPORTS`
          WHERE INDICTIONARY = true AND HOAXVAL = false");
    return $query->row()->totalDocs;
  }

  function setInDictionary($index)
  {
    $this->db->query("UPDATE `POST_REPORTS` SET `INDICTIONARY` = true WHERE IDREPORT = $index");
    if ($this->db->affected_rows() > 0) return 'update INDICTIONARY success';
  }

  // function addDictionary($word, $positive, $negative, $docs, $ctrdoc)
  // {
  //   $query = $this->db->query("SELECT dword FROM `dictionary` WHERE word = '$word'");
  //   if ($this->db->affected_rows() > 0) {
  //     $index = $query->row()->idword;
  //     $this->db->query("UPDATE `dictionary` SET `$column` = `$column` + 1 WHERE idword = $index");
  //     if ($this->db->affected_rows() > 0) return 'update dictionary success';
  //   }
  //   else {
  //     $this->db->query("INSERT INTO `dictionary` (`word`, `$column`) VALUES ('$word', 1)");
  //     if ($this->db->affected_rows() > 0) return 'insert dictionary success';
  //   }
  // }

	function newDictionary($word, $positive, $negative, $docs, $ctrdoc)
	{
		$this->db->query("INSERT INTO `dictionary` (`dword`, `positive`, `negative`, `docs`, `ctrdoc`) VALUES ('$word', $positive, $negative, '$docs', '$ctrdoc')");
	}

	function setBotEstimation($indexReport, $estimation)
	{
		$estimation = $estimation=='HOAX'?'true':'false';
		$this->db->query("UPDATE `post_reports` SET `BOT_ESTIMATION` = $estimation WHERE idword = $index");
		if ($this->db->affected_rows() > 0) return true;
		return false;
	}

}
