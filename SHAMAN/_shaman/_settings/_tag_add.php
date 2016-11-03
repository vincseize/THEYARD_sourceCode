<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$db = new DB();
$tblName = 'tags';

$now = date("Y-m-d H:i:s");

$editval = str_replace("<br>", "", $_POST["editval"]);
        $data = array(

            'tag' => $editval,
            'id_creator' => $_SESSION['id'],
            'created' => $now,
            'modified' => $now,
            'active' => 1,
            'modified_by' => $_SESSION['id']

        );


$insert = $db->insert($tblName,$data);




?>