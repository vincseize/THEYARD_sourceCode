<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../../../index.php");exit;}
require '../../../inc/crud.php';
$db = new DB();
$tblName = $_POST['tblName'];

if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){
    if($_REQUEST['action_type'] == 'add'){
        $data = array(
            'step' => $_POST['step'],
            'description' => $_POST['description'],
            'pic' => $_POST['pic'],
            'color' => $_POST['color'],
            'active' => $_POST['activeValue'],
            'archived' => $_POST['archivedValue'],
            'id_creator' => $_POST['id_creator'],
            'modified_by' => $_POST['modified_by']
        );
        $insert = $db->insert($tblName,$data);
        header("Location:../steps.php");
    }elseif($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
/*            $archived=1;
            if($_POST['activeValue']==1){$archived=0;}*/
            $data = array(
                'step' => $_POST['step'],
                'description' => $_POST['description'],
                'color' => $_POST['color'],
                'pic' => $_POST['pic'],
                'active' => $_POST['activeValue'],
                'archived' => $_POST['archivedValue'],
                'modified_by' => $_POST['modified_by']
            );
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$data,$condition);
            header("Location:../steps.php");
        }
    }

/*    elseif($_REQUEST['action_type'] == 'delete'){
        if(!empty($_GET['id'])){
            $condition = array('id' => $_GET['id']);
            $delete = $db->delete($tblName,$condition);
            $stepMsg = $delete?'Step data has been deleted successfully.':'Some problem occurred, please try again.';
            $_SESSION['stepMsg'] = $stepMsg;
            header("Location:../steps.php");
        }
    }*/
}

?>