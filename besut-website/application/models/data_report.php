<?php

class Data_report extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function markNotif($id) {
		$this->db->query("UPDATE `notif_target` SET `READED` = TRUE WHERE `IDNOTIF` = $id");
	}

	function getNotif($userid) {
		$query = $this->db->query("SELECT n.`IDREPORT`, CONCAT(u.`UNAME`, ' menulis sesuatu pada laporan \"', r.`TITLE`, '\"') as NOTIF, n.`IDCOMMENT`, n.`DATE_TIME`, t.`IDNOTIF`
		FROM `users` u, `post_reports` r, `notifications` n, `notif_target` t
		WHERE t.`IDUSER` = $userid AND t.`IDNOTIF` = n.`IDNOTIF` AND n.`IDUSER` = u.`IDUSER` AND r.`IDREPORT` = n.`IDREPORT` AND t.`READED` = false");
    return $query->result();
	}

	function makeNotif($indexReport, $userid, $comment) {
		$this->db->query("INSERT INTO notifications (IDREPORT, IDUSER, KODECOMMENT, DATE_TIME) VALUES ($indexReport, $userid, $comment, NOW())");
		$idnotif = $this->db->insert_id();
		$targets = "INSERT INTO `notif_target` (`IDUSER`, `IDNOTIF`, `READED`)
		SELECT `IDUSER`, $idnotif, 0 FROM post_reports WHERE `IDREPORT` = $indexReport AND `IDUSER` != $userid
		UNION
		SELECT `IDUSER`, $idnotif, 0 FROM post_comments WHERE `IDREPORT` = $indexReport AND `IDUSER` != $userid";
		$query = $this->db->query($targets);
	}

  function newReport($iduser, $title, $link, $web, $desc, $pictures) {
    // $title = $this->db->escape($title);
    // $link = $this->db->escape($link);
    // $web = $this->db->escape($web);
    // $desc = $this->db->escape($desc);

    $date = date("Y-m-d H:i:s");
    $data = ['IDUSER' => $iduser,
    'TITLE' => $title,
    'LINK' => $link,
    'WEBCONTENT' => $web,
    'RDESC' => $desc,
    'RPICTURES' => $pictures,
    'PDATE_TIME' => $date,
    'BOT_ESTIMATION' => 0,
		`VIEWABLE` => true];
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
					R.`WEBCONTENT` as WEBCONTENT,
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

  function getReports($search, $limit)
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
          WHERE R.`IDUSER` = U.`IDUSER` AND `VIEWABLE` = true AND R.`TITLE` like '%$search%'
					ORDER BY `PDATE_TIME` DESC LIMIT $limit, 10");
    return $query->result();
  }

  function getPageIndex($search)
  {
		$query = $this->db->query("SELECT CEIL(COUNT(*)/10) AS PAGES FROM `post_reports` where `VIEWABLE` = true AND `TITLE` LIKE '%$search%'");
		return $query->row()->PAGES;
	}

  function setVote($index, $column, $userid)
  {
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

  function makeComment($report, $parent, $reply, $userid)
  {
    // $reply = $this->db->escape($reply);
    $date = date("Y-m-d H:i:s");
    $data = ['IDUSER' => $userid,
    'IDREPORT' => $report,
    'PARENT_COMMENT' => $parent,
    'CCONTENT' => $reply,
    'CDATE_TIME' => $date];
		$this->db->insert('post_comments', $data);
    if ($this->db->affected_rows() > 0) {
      $query = $this->db->query("UPDATE POST_REPORTS SET `COMMENTCOUNTER` = `COMMENTCOUNTER` + 1 WHERE IDREPORT = $report");

			$this->makeNotif($report, $userid, $parent);
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

  function setCommentVote($index, $column, $userid)
  {
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
