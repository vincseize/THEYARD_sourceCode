<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$db = new DB();
$tblName = 'comments';


if(isset($_POST['comments']) && !empty($_POST['comments'])){


/*		$get = nl2br($_POST["comments"]);

		$comments = htmlentities($get, ENT_QUOTES);*/
		$comments = preg_replace("/<br\W*?\/>/", "\n", $_POST['comments']);


      $data = array('comments' => $comments);
      $condition = array('id' => $_POST['id']);
      $update = $db->update($tblName,$data,$condition);
/*      sleep(2);
      header("Location:assets_edit.php?id=".$_GET['id']."");*/
}
?>