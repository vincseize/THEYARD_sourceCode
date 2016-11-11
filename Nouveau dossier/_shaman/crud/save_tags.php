<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$db = new DB();
$tblName = 'assets';



$datas_assets  		= $db->getRows('assets',array('where'=>array('id'=>$_POST['id']),'return_type'=>'single'));
$datas_tags_steps   = $datas_assets['ids_tags_steps'];


$ids_tags_steps = "";



$old_steps = explode("-",$datas_tags_steps);



$st9 = '9[3]';
$st10 = '10[5]';

foreach($old_steps as $st){
	if(explode("[",$st)[0]=='9'){$st9 = $st;}
	if(explode("[",$st)[0]=='10'){$st10 = $st;}
}

$ids_tags_tmp = explode(",",$_POST['ids_tags']);
$ids_tags_steps = "";
foreach($ids_tags_tmp as $st){
	if($st=='9'){$ids_tags_steps = $st9."-".$ids_tags_steps;}
	if($st=='10'){$ids_tags_steps = $st10."-".$ids_tags_steps;}
	if($st!='9' and $st!='10'){$ids_tags_steps = $st."-".$ids_tags_steps;}
}





if(substr ( $ids_tags_steps , -2 )=='--'){$ids_tags_steps = substr ( $ids_tags_steps , 0, -2);}
if(substr ( $ids_tags_steps , -1)=='-'){$ids_tags_steps = substr ( $ids_tags_steps , 0, -1);}


if(isset($_POST['id'])){
      //$data = array('ids_tags' => $_POST['ids_tags']);
      $data = array('ids_tags' => $_POST['ids_tags'],'ids_tags_steps' => $ids_tags_steps);
      $condition = array('id' => $_POST['id']);
      $update = $db->update($tblName,$data,$condition);


}

?>