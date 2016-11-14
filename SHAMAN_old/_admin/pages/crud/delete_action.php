<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../../../index.php");exit;}
require '../../../inc/crud.php';
$db = new DB();
if($_REQUEST['action_type'] == 'delete'){
        $tblName = $_GET['tblName'];
        $tbl = strtolower(substr($tblName,0,-1));
        if(!empty($_GET['id'])){
            $condition = array('id' => $_GET['id']);
            $delete = $db->delete($tblName,$condition);
            //$projectMsg = $delete?'$tbl data has been deleted successfully.':'Some problem occurred, please try again.';
            //$_SESSION['projectMsg'] = $projectMsg;
            header("Location:../".$tblName.".php");
        }
}
?>