<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../../../index.php");exit;}
require '../../inc/DB.php';

$db = new DB();
$tblName = 'status_users';
if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){
    if($_REQUEST['action_type'] == 'add'){
        $data = array(
            'status' => $_POST['status'],
            'color' => $_POST['color'],
            'rules' => $_POST['rules'],
            'description' => $_POST['description'],
            'active' => $_POST['activeValue']
        );
        $insert = $db->insert($tblName,$data);
        $statusMsg = $insert?'Status data has been inserted successfully.':'Some problem occurred, please try again.';
        $_SESSION['statusMsg'] = $statusMsg;
        header("Location:status_users.php");
    }elseif($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $data = array(
                'status' => $_POST['status'],
                'color' => $_POST['color'],
                'rules' => $_POST['rules'],
                'description' => $_POST['description'],
                'active' => $_POST['activeValue']
            );
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$data,$condition);
            //$update = $db->update({$data}); 
            $statusMsg = $update?'Status data has been updated successfully.':'Some problem occurred, please try again.';
            $_SESSION['statusMsg'] = $statusMsg;
            header("Location:status_users.php");
        }
    }

/*    elseif($_REQUEST['action_type'] == 'delete'){
        if(!empty($_GET['id'])){
            $condition = array('id' => $_GET['id']);
            $delete = $db->delete($tblName,$condition);
            $statusMsg = $delete?'Status data has been deleted successfully.':'Some problem occurred, please try again.';
            $_SESSION['statusMsg'] = $statusMsg;
            header("Location:status_users.php");
        }
    }*/

}