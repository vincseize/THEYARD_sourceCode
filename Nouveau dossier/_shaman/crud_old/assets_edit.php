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




      $path_vignette = "../../".$_SESSION['$DATASstoreFolder'].'/'.$ids_projects.'_'.$name_project.'/assets/'.$folder_name.'/vignette.jpg';
      // echo $path_vignette;
      // ../_DATAS_LOCALHOST/1_M2/assets/1_55_MIMI/vignette.jpg
      $vignette = "<img src='".$path_vignette."' style='width:320px;height:120px;' alt=''>";
      // $vignette_bg = 
     //echo strlen($datas['vignette']);
     if (!file_exists($path_vignette)) {
            $path_vignette = '../images/vignette_default.jpg';
            $vignette = "<img src='".$path_vignette."' style='width:500px;height:300px;' alt=''>";
            
      }

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

    <!-- Custom CSS -->
    <link href="../css/4-col-portfolio.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Custom styles for context menu -->
    <link href="../css/jquery-ui.css" type="text/css" rel="stylesheet">

    <script src="../js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="../js/jquery.ui-contextmenu.min.js" type="text/javascript"></script>
    <script src="../js/BootstrapMenu.min.js"></script>


<!-- 
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

-->


<!--   <script src="jquery.multiselect_AssetEdit.js"></script>
  <link rel="stylesheet" href="jquery.multiselect_AssetEdit.css">

 -->


<script src="dropzone.js"></script>
<script src="dropzone_vignette.js"></script>

<link rel="stylesheet" href="dropzone.css">
<link rel="stylesheet" href="dropzone_vignette.css">



<script type="text/javascript" src="html5lightbox/jquery.js"></script>
<script type="text/javascript" src="html5lightbox/html5lightbox.js"></script>




<style type="text/css">

#btn_addComment {
  background: #3498db;
  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
  background-image: -o-linear-gradient(top, #3498db, #2980b9);
  background-image: linear-gradient(to bottom, #3498db, #2980b9);
  -webkit-border-radius: 8;
  -moz-border-radius: 8;
  border-radius: 10px;
  font-family: Arial;
  color: #ffffff;
  font-size: 12px;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
}

#btn_addComment:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}


/* unvisited link */
a:link {
    text-decoration: none;
}

/* visited link */
a:visited {
    text-decoration: none;
}

/* mouse over link */
a:hover {
    text-decoration: none;
}

/* selected link */
a:active {
    text-decoration: none;
}


textarea {
  width : 100 %;
  outline: none;
  /*resize: none;*/
  border: 1px solid #888; 
}



.lightboxcontainer {
  width:100%;
  text-align:left;
}
.lightboxleft {
  width: 40%;
  float:left;
}
.lightboxright {
  width: 60%;
  float:left;
}
.lightboxright iframe {
  min-height: 390px;
}
.divtext {
  margin: 36px;
}
@media (max-width: 800px) {
  .lightboxleft {
    width: 100%;
  }
  .lightboxright {
    width: 100%;
  }
  .divtext {
    margin: 12px;
  }
}


  body,html
{
  padding-top: 16px;
  padding-bottom: 0px;
  margin-bottom: 0px;
    overflow-x:hidden;
    overflow-y:hidden;
    /*background:gray;*/
    height:100%;
    min-height: 300px;   
}
  .ContentCommentsTable
{
  width:100%; 
    height: 490px;
   overflow:auto;
    background:#fff;
}

.modal-dialog {
position: relative;
    display: table; //This is important 
    overflow-y: auto;    
    overflow-x: auto;
    width: auto;
    min-width: 300px;   
}



.tg  {border-collapse:collapse;border-spacing:0;width:100%;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-yw4l{vertical-align:top}
</style>
<head>


<body>
<?php
include('menu_top_edit.php');
?>



<div class="container-responsive"  style="padding-left:10px;padding-right:10px;top:0px;">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <?php echo $datas['name'];?>
                </h1>
            </div>
        </div>




<!-- .row vignette-->
<?php 
    $vignette = "../../".DATASstoreFolderName."/".$ids_projects."_".$name_project."/assets/".$folder_name."/vignette.jpg";
    $vignette_comp = "../../".DATASstoreFolderName."/".$ids_projects."_".$name_project."/assets/".$folder_name."/vignette_comp.jpg";
    if (!file_exists($vignette_comp)) {$vignette_comp = '';$vignette = '';;}
    //echo $vignette_comp;

?>
        <div class="row">
            <div id='a7_vignette' name='a7_vignette' class="col-md-4 portfolio-item">



                <!-- 

                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->

                    <form id="uploadimage" action="" method="post" enctype="multipart/form-data">

                          <div id="image_preview" style=" border: 1px solid black;width:<?php echo W_V_EDIT;?>px;height:<?php echo H_V_EDIT;?>px;background-image: url(<?php echo $vignette_comp;?>);background-size: contain">

                                  <div id="selectImage">
                                    <input type="file" name="file" id="file" required style="opacity:0;
                                    overflow: hidden;width:<?php echo W_V_EDIT;?>px;height:<?php echo H_V_EDIT;?>px;background-size:contain;)"/> 
                                    <input type="hidden" name="ids_projects" id="ids_projects" value='<?php echo $ids_projects;?>'> 
                                    <input type="hidden" name="name_project" id="name_project" value='<?php echo $name_project;?>'>  
                                    <input type="hidden" name="folder_name" id="folder_name" value='<?php echo $folder_name;?>'>              
                                  </div>
                          </div>   
                    </form>

<a href='#' title='Image $number' number='$number'>
                  <img class='thumbnail_comments' src='<?php echo $vignette;?>' width='10px' height='10px'/>
                  </a>




            </div>
             <!-- /.row vignette-->

             <!-- .row description-->
            <div class="col-md-4 portfolio-item">

        
                <div id="description_title" style="width: 100%;border-width:1px;border-color:#d3dded;border-style:solid;background-color: #d3dded;">
                Description
                </div>

                Frames : <?php echo $datas['duree']; ?>
                <br>
                Description :<br> 

<!-- <form name="form_description" method='post'> -->


                <textarea id="description" name="description" rows="5" cols="50" <?php echo $disabled_description; ?>><?php echo $datas['description'];?></textarea><br>
                <input type="hidden" name="post_id_description" id="post_id_description" value="<?php echo $_GET['id']; ?>"/>
              <!--   <input type='submit' id='update_description' name='update_description' value='update'/> -->
<!-- </form> -->







                Path : 
                <br>

                Mail ? : 
   











            </div>
            <!-- /.row description-->


            <!-- .row tags steps-->
            <div class="col-md-4 portfolio-item">






<table class="tg">
  <tr>
    <th class="tg-031e">
<!-- .row tags-->

<?php include('check_tags.php'); ?>
<hr>
<?php include('check_tags2.php'); ?>

    </th>
    <th class="tg-yw4l">
     <!-- .row steps--> 
 <?php
include('check_steps.php');
?>
     
    </th>
  </tr>
</table>














 




</div>
 <!-- /.row tags steps-->


















            </div>















        </div>
        <!-- /.row steps tags-->






        <!-- Comments Row -->
        <div class="container-responsive"  style="padding-left:20px;padding-right:20px;padding-top:0px;height:100%;">

        <div class="row">










<div id="comments_title" style="height:25px;display: inline-block;width: 100%;border-width:1px;border-color:#d3dded;border-style:solid;background-color: #d3dded;">



<div style='display: inline-block;'>
        <button id='btn_addComment' style='height:25px;' href="#collapse1" class="nav-toggle">add comment [ + ]</button>
    </div>




</div>









    <div id="collapse1" style="display:none">
       
 <table style="width: 100%;"> 
        <tr>
            <th style="width: 1px;"> 

                    <form action="comments_action.php?action_type=add" method="post">
                    <textarea id='comments' name="comments" rows="10" cols="100"></textarea>
                    <br>
                    <!-- <input type="submit"/> -->

                    <input type="hidden" id="id_asset" name="id_asset" value='<?php echo $datas['id'];?>'/>
                    <input type="hidden" id="id_creator" name="id_creator" value='<?php echo $_SESSION['id'];?>'/>
                    <input type="hidden" id="modified_by" name="modified_by" value='<?php echo $_SESSION['id'];?>'/>
                    <input type="hidden" id="timestamp_id_creator" name="timestamp_id_creator" value='<?php echo $timestamp_id_creator;?>'/>
                    
                    <input type="submit" id="add_comment" name="add_comment" value='add'/>
                    </form>

          </th>        

          <th> 
                  <div  style="height: 100%;background-color: yellow;">
                                 


<?php 
$ds = DIRECTORY_SEPARATOR;


$DATASstoreFolder = "../../".$_SESSION['$DATASstoreFolder'].$ds.$datas['ids_projects']."_".$datas_projects['project'].$ds."assets".$ds.$datas['folder_name'].$ds."comments".$ds.$timestamp_id_creator;

// echo $DATASstoreFolder;
?>

                          <form action="upload_files.php?ids_projects=<?php echo $datas['ids_projects'];?>&name_project=<?php echo $datas_projects['project'];?>&id_asset=<?php echo $_GET['id'];?>&folder_name=<?php echo $datas['folder_name'];?>&timestamp_id_creator=<?php echo $timestamp_id_creator;?>" id="dropzoneFiles" class="dropzone"></form>

                  </div>
          </th>        
          <tr>

    </table>


    </div>




























<?php


    $datas_getComments  = $db->getRows('comments',array('where'=>array('id_asset'=>$datas['id']),'return_type'=>'single'));
    $style_comments = " style='display:none;'";
   if(count($datas_getComments)>1){
        $style_comments = " ";
        
   }

/*print_r($datas_getComments);
echo count($datas_getComments);*/
?>

<div class="FixedHeightContainer" style="width:100%;" <?php echo $style_comments;?>>

    <div class="ContentCommentsTable" style="width:100%;">
<table style="width:100%;height:100%;"><tbody>
    

<?php
           

                  $i = 0;
                  foreach($datas_comments as $data5){ 
                    if($data5['id_asset']==$datas['id']){
                              foreach($datas_users as $data6){ 
                                  if($data6['id']==$data5['id_creator']){
                                      $i++;
                                      $bg_color = $i % 2 === 0 ? "#cccccc" : "#eeeeee";
//


echo " <tr style='background-color: ". $bg_color .";'>";
echo " <td>";
echo "<span style='font-weight: bold;'>from ".$data6['login']." | ".$data5['modified']."</span>";
echo " </td><td></td>";

echo " <td>";








echo "<form action='comments_action.php?action_type=delete' method='post' onsubmit=\"return confirm('Delete comment and files ?');\">";






echo "<div style=' display: inline-block;vertical-align:top;horizontal-align:right;background-color:blue;'>";
                            echo "<div id='div_modify_comment_".$data5['id']."' style='display:none;'><input type='button' class='modify_comment' id='modify_comment' name='modify_comment' id_comment='".$data5['id']."' value='modify | cancel' /></div>"; 
echo "</div >";  
echo "<div style=' display: inline-block;vertical-align:top;horizontal-align:right;background-color:blue;'>";                                       
                            echo "<input type='submit' class='delete_comment' id='delete_comment_".$data5['id']."' name='delete_comment_".$data5['id']."' value='X'/>";
echo "</div >"; 



echo "<form>";








echo " </td>";


echo " </tr>";                                 
                                      echo "<tr style='background-color: ". $bg_color .";'>";
/*                                      echo "<input type='submit' id='".$data5['id']."' name='".$data5['id']."' value='save'/>";*/                                     
 /*                                     echo "<td valign='top' style='width:60%'>";
                                      echo "from ".$data6['login']." | ".$data5['modified']." ><br>";
                                      echo "<textarea class='textarea_".$data5['id']."' id='textarea_".$data5['id']."' name='textarea_".$data5['id']."' cols='100' disabled>";
                                      echo $data5['comments'];
                                      echo "</textarea>";
                                      echo " </td>";
                                                                            echo " </tr>";
                                                                            echo " <tr>";*/
                                      




                                      echo "<td class='edit_comment' valign='top' style='width:60%' id='".$data5['id']."' name='".$data5['id']."' >";
                           /*           echo "from ".$data6['login']." | ".$data5['modified']." ><br>";*/
                                      $comments = $data5['comments'];
                                      $comments = preg_replace("/<br\W*?\/>/", "\n", $comments);
                                      // $text = preg_replace("/<br\n\W*\/>/", "\n", $text);
                                      $comments = str_replace("br", "", $comments);
                                      $comments = str_replace("< />", "", $comments);
                                      echo nl2br($comments);

                                      echo " </td>";




echo "<td>";
/*
 echo $data5['timestamp_id_creator'];


      $path_vignette = "../".$_SESSION['$DATASstoreFolder'].'/'.$ids_projects.'_'.$name_project.'/assets/'.$folder_name.'/vignette.jpg';

*/

 $DATAScommentsFolder = "../../".DATASstoreFolderName.$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds."comments".$ds.$data5['timestamp_id_creator'].$ds;

// echo $DATAScommentsFolder;

/*      $directory = "";*/
      $folder = glob( $DATAScommentsFolder . "*"); 
      echo "<div id='img-container' class='row' style='padding-top:3px;padding-bottom:3px;'>";
      $number = 0;
      foreach($folder as $vignette)
          { $number = $number+1;
              $info = new SplFileInfo($vignette);
              $file = basename($vignette);
              $ext = $info->getExtension();
             
              if($ext=='jpg' or $ext=='jpeg' or $ext=='png' or $ext=='gif'){
/*                  echo "<a href='#' data-image-id='' data-toggle='modal' data-title='' data-caption='' data-image='$vignette' data-target='#image-gallery'>";*/
                  echo "<div style='display:inline; width:'".W_THUMB_COM.".px' ; height:'".H_THUMB_COM."px;'>";
                  echo "<a href='#' title='Image $number' number='$number'>";
                  echo "<img class='thumbnail_comments' src='$vignette' width='".W_THUMB_COM.".px' height='".H_THUMB_COM."px'/>&nbsp;"; 
                  echo "</a>"; 
                  echo "</div>";              
              }
              if($ext=='mp4' or $ext=='webm'  or $ext=='ogv'){
                  echo "<div style='display:inline; width:'".W_THUMB_COM.".px' ; height:'".H_THUMB_COM."px;border:1px;'>";
                  echo "<video id='video-container' style='display:inline;' controls preload='auto' width='".W_THUMB_COM.".px' height='".H_THUMB_COM."px'>";
                  echo "<source src='$vignette' type='video/mp4'>&nbsp;";
                  echo "<source src='$vignette' type='video/webm'>&nbsp;";
                  echo "<source src='$vignette' type='video/ogv'>"&nbsp;;
                  echo "<p>";
                  echo "Your browser doesn\'t support HTML5 video.";
                  echo "<a href='$vignette'>Download</a> the video instead.";
                  echo "</p>";
                  echo "</video>&nbsp;";
                  echo "</div>"; 


              }
              if($ext=='pdf'){
                  echo "<div style='display:inline; width:'".W_THUMB_COM.".px' ; height:'".H_THUMB_COM."px;border:1px;'>";
                  echo "<a href='#'>";
                  echo "<span class='glyphicon glyphicon-file'>$file</span>&nbsp;"; 
                  echo "</a>"; 
                  echo "</div>"; 
              }
              if($ext=='tiff' or $ext=='tif' ){
                  echo "<div style='display:inline; width:'".W_THUMB_COM.".px' ; height:'".H_THUMB_COM."px;border:1px;'>";
                  echo "<a href='$file'>";
                  echo "<span class='glyphicon glyphicon-file'>$file</span>&nbsp;"; 
                  echo "</a>"; 
                  echo "</div>"; 
              }
          }
      echo "</div>";
      echo "<div style='clear: left;'></div>";










                                                echo " </td>";







                          echo "<td style='width:10px;vertical-align:top;horizontal-align:right;>";
                          if($data5['id_creator']==$_SESSION['id'] or $_SESSION['id_status_user']==2){

                            

echo "<form action='comments_action.php?action_type=delete' method='post' onsubmit=\"return confirm('Delete comment and files ?');\">";                         
                            echo "<input type='hidden' id='id_asset' name='id_asset' value='".$_GET['id']."'/>";
                            echo "<input type='hidden' id='id_comment' name='id_comment' value='".$data5['id']."'/>";
                            echo "<input type='hidden' id='folder_comment' name='folder_comment' value='".$DATAScommentsFolder."'/>";
/*echo "<div style=' display: inline-block;vertical-align:top;horizontal-align:right;background-color:blue;'>";
                            echo "<div id='div_modify_comment_".$data5['id']."' style='display:none;'><input type='button' class='modify_comment' id='modify_comment' name='modify_comment' id_comment='".$data5['id']."' value='modify' /></div>"; 
echo "</div >";  
echo "<div style=' display: inline-block;vertical-align:top;horizontal-align:right;background-color:blue;'>";                                       
                            echo "<input type='submit' class='delete_comment' id='delete_comment_".$data5['id']."' name='delete_comment_".$data5['id']."' value='X'/>";
echo "</div >"; */
                            echo "</form>";

                          }
                          
                          echo " </td>";













                                                echo "</tr>";
                                  }
                            }

                    }
                  }  


  


?>


   
  </tbody></table>

  </div>
            


        </div>    
    </div>
    <!-- /.row comments-->








<!-- div container global -->
</div>











<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
  <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3 class="modal-title">Heading</h3>
  </div>
  <div class="modal-body">
    
  </div>
  <div class="modal-footer">
<!--         <button id="prev-btn" class="btn btn-warning">Prev</button>
        <button id="next-btn" class="btn btn-primary">Next</button> -->
        <button class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
   </div>
  </div>
</div>













<script type="text/javascript">
  
$(document).ready(function (e) {





          $('.nav-toggle').click(function(e){
            //get collapse content selector
            var collapse_content_selector = $(this).attr('href');
            var toggle_switch = $(this);
            $(collapse_content_selector).toggle(function(e){
              if($(this).css('display')=='none'){
                //$('.table_top').show();                                
                toggle_switch.html('add comment : +');
              }else{
                //$('.table_top').hide();
                toggle_switch.html('Cancel');
              }
            });
          });



        $('#ids_tags').multiselect({
            columns: 1,
            placeholder: 'Select Tag(s)',
            search: true,
            selectAll: false
        });

        //$("#ids_tags option:selected").removeAttr("selected");
        $("#ids_tags-rec option:selected").prop("selected", false);

        $( "#toggle_tags" ).click(function() {
        /*  $( "#form_ids_tags" ).toggle( "fast", function() {
          });*/
          //$( "#form_ids_tags" ).toggle( display );

                //$("#form_ids_tags").show();
        });























    $("#uploadimage").on('submit',(function(e) {
      e.preventDefault();
        $.ajax({
            url: "upload_vignette_asset_edit.php", 
            type: "POST",             
            data: new FormData(this), 
            contentType: false,       
            cache: false,             
            processData:false,        
            success: function(data)   
            {
              console.log(data)
            }
        });
    }));

    $(function() {
          $("#file").change(function() {
              $("#message").empty(); // To remove the previous error message
              var file = this.files[0];
              var imagefile = file.type;
              var match= ["image/jpeg","image/png","image/jpg"];
              if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
              {
                alert("jpeg, jpg and png type allowed");
                return false;
              }
              else
              {
              var reader = new FileReader();
              reader.onload = imageIsLoaded;
              reader.readAsDataURL(this.files[0]);
              }
          });
    });

    function imageIsLoaded(e) {
            $('form#uploadimage').submit();
            $('#image_preview').css('background-image', 'url('+e.target.result+')');
            //$("#a7_vignette").load();
            //$('#a7_vignette').load(location.href+ '#a7_vignette');
            $('#a7_vignette').html(retour)
    };



    window.onkeyup = function(e) {
        var event = e.which || e.keyCode || 0; // .which with fallback

        if (event == 27) { // ESC Key
            window.location.href = '../index.php'; // Navigate to URL
        }
    }



    $('.modify_comment').click(function(){
        var id_comment = $(this).attr("id_comment");
        var comments = $('#textarea_comment_'+id_comment).val();
        /*alert(comments);*/
        $('.div_modify_comment_'+id_comment).hide();
        //$('#delete_comment_'+id_comment).show();
        //$('#textarea_'+id_comment).removeAttr('cellEditing');
        //$('#textarea_'+id_comment).prop('disabled', true);
/*        $('#textarea_'+id_comment).removeAttr('disabled');*/




                $.ajax({  
                     url:"save_comments.php",  
                     method:"POST",  
                     data:{comments:comments, id:id_comment},  
                     dataType:"text",  
                     success:function(data)  
                     {  
/*                          if(data != '')  
                          {  
                               $('#description').val(description);  
                          }  
                          setInterval(function(){  
                          }, 2000);  */
                     }  
                });  

                setTimeout(function(){ 
                         window.location.href = self.location;
                    }, 1000);  

    





    });

      $(".edit_comment").dblclick(function () {
        
        var id_comment = $(this).attr("id");
        // alert(id_comment);
        $('.delete_comment').hide();
        var OriginalContent = $(this).text();
        $(this).addClass("cellEditing");
        
        //$('.modify_comment').attr('visibility', 'visible');
        $('#div_modify_comment_'+id_comment).show();
        //$(this).html("<input type='text' value='" + OriginalContent + "' />");
        $(this).html("<textarea cols=100 rows=5 id='textarea_comment_"+id_comment+"'>" + OriginalContent + "</textarea>");
                $(this).children().first().focus();
                $(this).children().first().keypress(function (e) {
/*                    if (e.which == 13) {
                        var newContent = $(this).val();
                        $(this).parent().text(newContent);
                        $(this).parent().removeClass("cellEditing");
                    }*/
        });
    });



    $('.thumbnail_comments').click(function(){
        $('.modal-body').empty();
        var title = $(this).parent('a').attr("title");
        var src = $(this).attr("src");
        var number = $(this).parent('a').attr("number");

        $('.modal-title').html(title);
        //$($(this).parents('div').html()).appendTo('.modal-body');
        $('<div><a href="#" title="Image '+number+'"><img src="'+src+'"></a></div>').appendTo('.modal-body');
        $('#myModal').modal({show:true});
    });

    $('#next-btn').click(function() {
     var link = $('.modal-body a');
      var number = parseInt(link.attr('title').match(/\S+$/));
      number++;
      if(number === 13) {
      number = 1;
      }
      $('.modal-body').html($('#img-container').find('a[title="Image ' + number + '"]').parent('div').html());
      $('.modal-title').text('Image ' + number);
    });
    $('#prev-btn').click(function() {
     var link = $('.modal-body a');
      var number = parseInt(link.attr('title').match(/\S+$/));
      number--;
      if(number === 0) {
      number = 12;
      }
      $('.modal-body').html($('#img-container').find('a[title="Image ' + number + '"]').parent('div').html());
      $('.modal-title').text('Image ' + number);
    });




      function autoSave(e)  
      {  
           var description = $('#description').val();  
           var id = $('#post_id_description').val();  
           if(description != '')  
           {  
                $.ajax({  
                     url:"save_description.php",  
                     method:"POST",  
                     data:{description:description, id:id},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                          if(data != '')  
                          {  
                               $('#description').val(description);  
                          }  
                          setInterval(function(){  
                          }, 2000);  
                     }  
                });  
           }            
      }  
      setInterval(function(){   
           autoSave();   
           }, 2000);  

/*

      function autoSave_comments(e)  
      {  
           var description = $('#comments').val();  
           var id = $('#post_id_description').val();  
           if(description != '')  
           {  
                $.ajax({  
                     url:"save_description.php",  
                     method:"POST",  
                     data:{description:description, id:id},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                          if(data != '')  
                          {  
                               $('#description').val(description);  
                          }  
                          setInterval(function(){  
                          }, 2000);  
                     }  
                });  
           }            
      }  
      setInterval(function(){   
           autoSave_comments();   
           }, 2000);  


*/










});





</script>


   





</body>


</html>




