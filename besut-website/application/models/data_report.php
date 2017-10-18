<?php

class Data_report extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

  function newReport($iduser, $title, $link, $web, $desc, $pictures) {
    $title = $this->db->escape($title);
    $link = $this->db->escape($link);
    $web = $this->db->escape($web);
    $desc = $this->db->escape($desc);

    $date = date("Y-m-d H:i:s");
    $data = ['IDUSER' => $iduser,
    'TITLE' => $title,
    'LINK' => $link,
    'WEBCONTENT' => $web,
    'RDESC' => $desc,
    'RPICTURES' => $pictures,
    'PDATE_TIME' => $date,
    'BOT_ESTIMATION' => 0];
		$this->db->insert('post_reports', $data);
    if ($this->db->affected_rows() > 0) {
      return $this->db->insert_id();
    }
    return FALSE;
  }

  function getDataReport($index)
  {
    $query = $this->db->query("SELECT
          U.`USERKEY` as ukey,
          U.`UNAME` as name,
          U.`PROFILE_PIC` as profile,
          R.`TITLE` as title,
          R.`LINK` as link,
          R.`RDESC` as content,
          R.`RPICTURES` as pics,
          R.`PDATE_TIME` as dtm,
          R.`BOT_ESTIMATION` as estimation,
          R.`VOTESHOAX` as vhoax,
          R.`VOTESNOT` as vnot,
          R.`CLOSED` as closed,
          R.`CLOSEDBY` as closedby
          FROM `post_reports` R, `users` U
          WHERE R.`IDUSER` = U.`IDUSER` and IDREPORT = $index");
    return $query->row();
  }

  function getReports($limit)
  {
    $limit = ($limit - 1) * 10;
    $query = $this->db->query("SELECT
          R.`IDREPORT` as idreport,
          U.`UNAME` as name,
          U.`PROFILE_PIC` as profile,
          R.`TITLE` as title,
          R.`RDESC` as content,
          R.`BOT_ESTIMATION` as estimation,
          R.`VOTESHOAX` as vhoax,
          R.`VOTESNOT` as vnot,
          R.`COMMENTCOUNTER` as ctr,
          R.`CLOSED` as closed
          FROM `post_reports` R, `users` U
          WHERE R.`IDUSER` = U.`IDUSER` LIMIT $limit, 10");
    return $query->result();
  }

  function getPageIndex()
  {
		$query = $this->db->query("SELECT Floor(COUNT(*)/10)+1 AS PAGES FROM `post_reports`");
		return $query->row()->PAGES;
	}

  function setVote($index, $column, $user)
  {
    $query = $this->db->query("SELECT IDUSER FROM USERS WHERE USERKEY = '$user'");
    $userid = $query->row()->IDUSER;
    $query = $this->db->query("SELECT IDUSER FROM POST_REPORTS WHERE IDUSER = '$userid'");
    if ($this->db->affected_rows() > 0)
      return 'poster';

    $query = $this->db->query("SELECT IDUSER FROM VOTES_REPORT WHERE IDUSER = $userid AND IDREPORT = $index");
    if ($this->db->affected_rows() > 0)
      return false;
    else {
      $query = $this->db->query("INSERT INTO VOTES_REPORT VALUES($index, $userid)");
      if ($this->db->affected_rows() > 0)
        $query = $this->db->query("UPDATE POST_REPORTS SET `$column` = `$column` + 1 WHERE IDREPORT = $index");
    }

    $query = $this->db->query("SELECT `$column` AS Counter FROM `post_reports` WHERE IDREPORT = $index");
		return $query->row()->Counter;
  }

  function makeComment($report, $parent, $reply, $user)
  {
    $reply = $this->db->escape($reply);
    $query = $this->db->query("SELECT IDUSER FROM USERS WHERE USERKEY = '$user'");
    $userid = $query->row()->IDUSER;
    $date = date("Y-m-d H:i:s");
    $data = ['IDUSER' => $userid,
    'IDREPORT' => $report,
    'PARENT_COMMENT' => $parent,
    'CCONTENT' => $reply,
    'CDATE_TIME' => $date];
		$this->db->insert('post_comments', $data);
    if ($this->db->affected_rows() > 0) {
      $query = $this->db->query("UPDATE POST_REPORTS SET `COMMENTCOUNTER` = `COMMENTCOUNTER` + 1 WHERE IDREPORT = $report");
      return true;
    }
    return FALSE;
  }

  function getComments($report)
  {
    $query = $this->db->query("SELECT
      C.`IDCOMMENT` as idcomment,
      U.`UNAME` as name,
      U.`PROFILE_PIC` as profile,
      C.`idreport` as idreport,
      C.`PARENT_COMMENT` as cparent,
      C.`CCONTENT` as ccontent,
      C.`VOTEUP` as vup,
      C.`votedown` as vdown,
      C.`CDATE_TIME` as dtm,
      C.`PRIORITY` as prior
      FROM `post_comments` C, `users` U
      WHERE C.`IDUSER` = U.`IDUSER` AND C.`IDREPORT` = $report
      ORDER BY `PRIORITY` DESC, `PARENT_COMMENT` ASC, `VOTEUP` DESC, `VOTEDOWN` ASC");
    return $query->result();
  }

  function setCommentVote($index, $column, $user)
  {
    $query = $this->db->query("SELECT IDUSER FROM USERS WHERE USERKEY = '$user'");
    $userid = $query->row()->IDUSER;
    $query = $this->db->query("SELECT IDUSER FROM POST_COMMENTS WHERE IDUSER = '$userid'");
    if ($this->db->affected_rows() > 0)
      return 'poster';

    $query = $this->db->query("SELECT IDUSER FROM VOTES_COMMENT WHERE IDUSER = $userid AND IDCOMMENT = $index");
    if ($this->db->affected_rows() > 0)
      return false;
    else {
      $query = $this->db->query("INSERT INTO VOTES_COMMENT VALUES($index, $userid)");
      if ($this->db->affected_rows() > 0)
        $query = $this->db->query("UPDATE POST_COMMENTS SET `$column` = `$column` + 1 WHERE IDCOMMENT = $index");
    }

    $query = $this->db->query("SELECT `$column` AS Counter FROM `POST_COMMENTS` WHERE IDCOMMENT = $index");
		return $query->row()->Counter;
  }
}
