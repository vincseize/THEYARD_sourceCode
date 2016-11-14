<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$db = new DB();
$tblName = 'steps';

$editval = str_replace("<br>", "", $_POST["editval"]);
$data = array(
                $_POST["column"] => $editval
            );
$condition = array('id' => $_POST['id']);
$update = $db->update($tblName,$data,$condition);




?>