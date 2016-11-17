<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$db = new DB();
$tblName = 'assets';


if(isset($_POST['description']) && !empty($_POST['description'])){
      $data = array('description' => $_POST['description']);
      $condition = array('id' => $_POST['id']);
      $update = $db->update($tblName,$data,$condition);
/*      sleep(2);
      header("Location:assets_edit.php?id=".$_GET['id']."");*/
}
?>