<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$db = new DB();
$tblName = 'assets';
$datas_projects     = $db->getRows('projects',array('where'=>array('id'=>$_POST['ids_projects']),'return_type'=>'single'));

if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){
    if($_REQUEST['action_type'] == 'add'){





        //$vignette_blob = mysql_real_escape_string(file_get_contents("../images/vignette_default.jpg"));

        $tmp = explode(",",$_POST['ids_tagsValue']);
        $ids_tags_steps = '';
        foreach( $tmp as $data){
            if($data == '9' or $data == '10'){$data=$data.'[]';}
        $ids_tags_steps = $ids_tags_steps."-".$data;
        }
        $ids_tags_steps = substr ( $ids_tags_steps , 1);


        //check unique name !!!!!! 
        $name_project   = $datas_projects['project'];
        $asset = $_POST['name'];
        $asset = preg_replace('{/@|\./}','',$asset);
        //$asset = iconv('utf-8', 'us-ascii//TRANSLIT', $asset);

        $ids_tagsValue = $_POST['ids_tagsValue'];
        if (strlen($_POST['ids_tagsValue']) === 0){
            $ids_tagsValue = '0';
            $ids_tags_steps = '0' ;
        }


        $data = array(
            'ids_projects' => $_POST['ids_projects'],
            'ids_tags' => $ids_tagsValue,
            'ids_tags_steps' => $ids_tags_steps,
            'name' => $asset,
            //'vignette' => $vignette_blob,
            'duree' => $_POST['duree'],
            'description' => $_POST['description'],
            'archived' => $_POST['archivedValue'],
            'active' => $_POST['activeValue'],
            'id_creator' => $_POST['id_creator'],
            'modified_by' => $_POST['modified_by']
        );
        $insert = $db->insert($tblName,$data);
        $Msg = $insert?'Asset data has been inserted successfully.':'Some problem occurred, please try again.';
        $_SESSION['projectMsg'] = $Msg;








sleep(1);
$datas_assets = $db->getRows('assets',array('order_by'=>'id DESC'));
foreach($datas_assets as $data){
    if($data['name'] == $asset){ $id_asset = $data['id']; }
}





        $ds = DIRECTORY_SEPARATOR;
        //$id_project = $_POST['id_project'];  
/*        $id_project = '1';  
        $project = 'M2';  
        $asset = $_POST['name'];
        $asset = preg_replace('{/@|\./}','',$asset);
        $asset = str_replace(' ', '_', $asset);
        $asset = mb_strtoupper($asset); // check name*/
        //$id_asset = '1500';


        $asset = preg_replace('{"\'#$[/@|\./;,]}','',$asset);
        $asset = str_replace(' ', '-', $asset);
        $asset = str_replace("'", '-', $asset);



$pattern = array("'é'", "'è'", "'ë'", "'ê'", "'É'", "'È'", "'Ë'", "'Ê'", "'á'", "'à'", "'ä'", "'â'", "'å'", "'Á'", "'À'", "'Ä'", "'Â'", "'Å'", "'ó'", "'ò'", "'ö'", "'ô'", "'Ó'", "'Ò'", "'Ö'", "'Ô'", "'í'", "'ì'", "'ï'", "'î'", "'Í'", "'Ì'", "'Ï'", "'Î'", "'ú'", "'ù'", "'ü'", "'û'", "'Ú'", "'Ù'", "'Ü'", "'Û'", "'ý'", "'ÿ'", "'Ý'", "'ø'", "'Ø'", "'œ'", "'Œ'", "'Æ'", "'ç'", "'Ç'");

$replace = array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E', 'a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'A', 'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 'i', 'i', 'i', 'I', 'I', 'I', 'I', 'I', 'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U', 'y', 'y', 'Y', 'o', 'O', 'a', 'A', 'A', 'c', 'C'); 



        $asset = preg_replace($pattern, $replace, $asset);


        $asset_upper = mb_strtoupper($asset); // check name


        $folder_name = $_POST['ids_projects'].'_'.$id_asset.'_'.$asset_upper;
        $DATASstoreFolder = '../../'. DATASstoreFolderName . $ds . $_POST['ids_projects'] ."_". $name_project . $ds .'assets' . $ds . $folder_name;
        $DATASstoreFolderComments = $DATASstoreFolder. $ds . 'comments';

        if (!file_exists($DATASstoreFolder)) {
            mkdir($DATASstoreFolder, 0777, true);
            mkdir($DATASstoreFolderComments, 0777, true);
        }
         

/*echo $DATASstoreFolder;
echo $DATASstoreFolderComments;*/

        $data = array(
            'folder_name' => $folder_name
        );
        $condition = array('id' => $id_asset);
        $update = $db->update($tblName,$data,$condition);
        $Msg = $insert?'Asset data has been updated successfully.':'Some problem occurred, please try again.';
        $_SESSION['projectMsg'] = $Msg;










       header("Location:../index.php");
















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
            header("Location:../index.php");
        }
    }


}