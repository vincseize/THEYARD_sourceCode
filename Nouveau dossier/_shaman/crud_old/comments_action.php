<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$db = new DB();
$tblName = 'comments';

function delete_directory($dir)
{
if ($handle = opendir($dir))
{
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
 
            if(is_dir($dir.$file))
            {
                if(!@rmdir($dir.$file)) // Empty directory? Remove it
                {
                delete_directory($dir.$file.'/'); // Not empty? Delete the files inside it
                }
            }
            else
            {
               @unlink($dir.$file);
            }
        }
    }
    closedir($handle);
 
    @rmdir($dir);
}
 
}



if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){


/*        if (!file_exists($DATASstoreFolder)) {

            mkdir($_SESSION[$DATASstoreFolder], 0777, true);
        }*/




    if($_REQUEST['action_type'] == 'add'){

        


        $data = array(

            'id_asset' => $_POST['id_asset'],
            'id_creator' => $_POST['id_creator'],
            'comments' => $_POST['comments'],
            'timestamp_id_creator' => $_POST['timestamp_id_creator'],
            'modified_by' => $_POST['modified_by']

        );
        $insert = $db->insert($tblName,$data);
        $Msg = $insert?'Asset data has been inserted successfully.':'Some problem occurred, please try again.';
        $_SESSION['projectMsg'] = $Msg;
        header("Location:assets_edit.php?id=".$_POST['id_asset']."");


    }elseif($_REQUEST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
/*            $archived=1;
            if($_POST['activeValue']==1){$archived=0;}*/
            $data = array(
                'project' => $_POST['project'],
                'description' => $_POST['description'],
                'active' => $_POST['activeValue'],
                'archived' => $_POST['archivedValue'],
                'modified_by' => $_POST['modified_by']
            );
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$data,$condition);
            //$update = $db->update({$data}); 
            $projectMsg = $update?'Project data has been updated successfully.':'Some problem occurred, please try again.';
            $_SESSION['projectMsg'] = $projectMsg;
            header("Location:assets_edit.php?id=".$_POST['id_asset']."");
        }
    }elseif($_REQUEST['action_type'] == 'delete'){
        if(!empty($_POST['id_comment'])){
            $condition = array('id' => $_POST['id_comment']);
            $delete = $db->delete($tblName,$condition);
            $dirname = $_POST['folder_comment'];
            $dir = $dirname.'/'; // IMPORTANT: with '/' at the end
            $remove_directory = delete_directory($dir);
            header("Location:assets_edit.php?id=".$_POST['id_asset']."");
        }
}


}