<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../../../index.php");exit;}
require '../../../inc/crud.php';
$db = new DB();
if($_REQUEST['action_type'] == 'archive'){
        $tblName = $_GET['tblName'];
        $tbl = strtolower(substr($tblName,0,-1));
        if(!empty($_GET['id'])){

 			$data = array(
                'archived' => 1,
                'active' => 0,
                /*'archived' => 1,*/
            );

            $condition = array('id' => $_GET['id']);
            $archive = $db->update($tblName,$data,$condition);
            //$projectMsg = $delete?'$tbl data has been deleted successfully.':'Some problem occurred, please try again.';
            //$_SESSION['projectMsg'] = $projectMsg;
            header("Location:../".$tblName.".php");

        }
}
