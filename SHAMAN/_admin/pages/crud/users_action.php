<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../../../index.php");exit;}
require '../../../inc/crud.php';
$db = new DB();
$tblName = $_POST['tblName'];


if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){
    if($_REQUEST['action_type'] == 'add'){
        $data = array(
            'name' => $_POST['name'],
            'pseudo' => $_POST['pseudo'],
            'login' => $_POST['login'],
            'password' => $_POST['password'],
            'mail' => $_POST['mail'],
            'id_status_users' => $_POST['id_status_usersValue'],
            'active' => $_POST['activeValue'],
            'archived' => $_POST['archivedValue'],
            'id_creator' => $_POST['id_creator'],
            'modified_by' => $_POST['modified_by'],
            'ids_projects' => $_POST['ids_projectsValue']
            
        );
        $insert = $db->insert($tblName,$data);
        $statusMsg = $insert?'User data has been inserted successfully.':'Some problem occurred, please try again.';
        $_SESSION['statusMsg'] = $statusMsg;
        header("Location:../users.php");
    }elseif($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $data = array(
                'name' => $_POST['name'],
                'pseudo' => $_POST['pseudo'],
                'login' => $_POST['login'],
                'password' => $_POST['password'],
                'mail' => $_POST['mail'],
                'id_status_users' => $_POST['id_status_usersValue'],
                'active' => $_POST['activeValue'],
                'archived' => $_POST['archivedValue'],
                'modified_by' => $_POST['modified_by'],
                'ids_projects' => $_POST['ids_projectsValue']
            );
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$data,$condition);
            //$update = $db->update({$data}); 
            $statusMsg = $update?'User data has been updated successfully.':'Some problem occurred, please try again.';
            $_SESSION['statusMsg'] = $statusMsg;
            header("Location:../users.php");
        }
    }

/*    elseif($_REQUEST['action_type'] == 'delete'){
        if(!empty($_GET['id'])){
            $condition = array('id' => $_GET['id']);
            $delete = $db->delete($tblName,$condition);
            $statusMsg = $delete?'User data has been deleted successfully.':'Some problem occurred, please try again.';
            $_SESSION['statusMsg'] = $statusMsg;
            header("Location:../users.php");
        }
    }*/
}




?>