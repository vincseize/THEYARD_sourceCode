<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$db = new DB();
$tblName = 'users';




if(!empty($_POST['id'])){
    $data = array(
        'name' => $_POST['name'],
        'pseudo' => $_POST['pseudo'],
        'password' => $_POST['password'],
        'mail' => $_POST['mail'],
        'modified_by' => $_POST['modified_by']
    );
    // print_r($data);
    $condition = array('id' => $_POST['id']);
    $update = $db->update($tblName,$data,$condition);
    //$update = $db->update({$data}); 
    $statusMsg = $update?'User data has been updated successfully.':'Some problem occurred, please try again.';
    $_SESSION['statusMsg'] = $statusMsg;
    header("Location:index.php");
}





?>