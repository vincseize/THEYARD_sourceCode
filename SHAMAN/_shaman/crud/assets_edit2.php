<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$db = new DB();
$tblName = 'assets';
$datas              = $db->getRows($tblName,array('where'=>array('id'=>$_GET['id']),'return_type'=>'single'));
$datas_projects     = $db->getRows('projects',array('where'=>array('id'=>$datas['ids_projects']),'return_type'=>'single'));
$datas_projets      = $projects;
$datas_tags         = $tags;
$datas_steps        = $steps;
$datas_flags        = $flags;
$datas_assets       = $assets;
$datas_users        = $users;
$datas_comments     = $comments;
$datas_comments_asc = $comments_asc;


$title_user = "Hi' ".$_SESSION['login']." [ ".$_SESSION['status']." ]";

$timestamp_id_creator = date("Ymd_his")."_".$_SESSION['id'];

$ds = DIRECTORY_SEPARATOR;

?>


<?php

if(isset($_POST['tags']) && !empty($_POST['choix']) && !isset($_POST['description'])){
  $choix ='';
    for ($i=0;$i<count($_POST['choix']);$i++){$choix .= $_POST['choix'][$i].',';}
      $data = array('ids_tags' => $choix);
      $condition = array('id' => $_GET['id']);
      $update = $db->update($tblName,$data,$condition);
      header("Location:assets_edit.php?id=".$_GET['id']."");
}

if(isset($_POST['steps']) && !empty($_POST['choix']) && !isset($_POST['description'])){
  $choix ='';
    for ($i=0;$i<count($_POST['choix']);$i++){$choix .= $_POST['choix'][$i].',';}
      $data = array('ids_steps' => $choix);
      $condition = array('id' => $_GET['id']);
      $update = $db->update($tblName,$data,$condition);
      header("Location:assets_edit.php?id=".$_GET['id']."");
}

/*if(isset($_POST['description']) && !empty($_POST['description'])){
      $data = array('description' => $_POST['description']);
      $condition = array('id' => $_GET['id']);
      $update = $db->update('assets',$data,$condition);
      sleep(2);
      header("Location:assets_edit.php?id=".$_GET['id']."");
}*/


?>



<?php


$disabled_description = " disabled";
if ($_SESSION['id_status_user']==2){
    $disabled_description = " ";
}




$ids_projects   = $datas['ids_projects'];
$name_project   = $datas_projects['project'];
$folder_name    = $datas['folder_name'];






/*echo $datas['vignette'];
echo strlen($datas['vignette']);*/


      // echo $vignette;






?>


<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title>SHAMAN</title>



    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <script src="../js/BootstrapMenu.min.js"></script>


    <!-- Custom CSS -->
    <link href="../css/4-col-portfolio.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Custom styles for context menu -->
    <link href="../css/jquery-ui.css" type="text/css" rel="stylesheet">

    <script src="../js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="../js/jquery.ui-contextmenu.min.js" type="text/javascript"></script>
<!--     <script src="../js/BootstrapMenu.min.js"></script> -->













<link rel="stylesheet" href="asset_edit.css">






<body>







<div class="w3-container w3-orange">
			  <?php include('menu_top_edit.php');?>
</div>



<div class="w3-row-padding" style="position:absolute;top:65px;width:100%;">
		<div style="background-color:blue;width:<?php echo W_V_EDIT;?>px;height:<?php echo H_V_EDIT;?>px;" class="w3-third">
			<p>
		  		<?php include('_vignette.php'); ?>
			</p>
		</div>


		<div style="background-color:red;height:250px;" class="w3-third">
			<p>
			  	<?php include('_description.php'); ?>
			</p>
		</div>


		<div style="background-color:green;height:250px;" class="w3-third">
		  	<p>
			  		<?php include('_tags.php'); ?>

































			  	</p>
		</div>






<div style="background-color:gray;position:absolute;width:100%;top:280px;">
	<p>

























	  <?php include('_comments.php'); ?>
	</p> 
</div>









</div>





<div class="w3-row-padding" style="position:absolute;top:315px;width:100%;">
            <div class="row" id="comments_title" style="margin:0px;padding:0px;height:25px;width: 100%;border-color:#d3dded;background-color: #d3dded;text-align:left;">
              
                    <button id='btn_addComment' style='height:25px;' href="#collapse1" class="nav-toggle">add comment [ + ]</button>
               
            </div>




        <?php 

        include('collapse_edit.php'); 

        ?>


</div>
















</body>












</html>


















</html>