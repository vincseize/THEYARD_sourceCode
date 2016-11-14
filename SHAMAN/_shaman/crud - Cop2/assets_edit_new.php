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
  width:150px;
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
  padding-top: 20px;
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


        <?php 

        include('bandeau_vignette.php'); 

        ?>
        <br><br>
        <!-- Comments Row -->
        <div class="container-responsive"  style="margin:0px;padding-left:10px;padding-right:10px;padding-top:0px;height:100%;background-color:gray;">

 

            <div class="row" id="comments_title" style="margin:0px;padding:0px;height:25px;width: 100%;border-color:#d3dded;background-color: #d3dded;text-align:left;">
              
                    <button id='btn_addComment' style='height:25px;' href="#collapse1" class="nav-toggle">add comment [ + ]</button>
               
            </div>




        <?php 

        include('collapse_edit.php'); 

        ?>























<?php


    $datas_getComments  = $db->getRows('comments',array('where'=>array('id_asset'=>$datas['id']),'return_type'=>'single'));
    $style_comments = " style='display:none;'";
   if(count($datas_getComments)>1){
        $style_comments = " ";
        
   }

/*print_r($datas_getComments);
echo count($datas_getComments);*/
?>

<div class="FixedHeightContainer" style="width:100%;height:55%;background-color: red;overflow-x:auto;overflow-x:hidden;" <?php echo $style_comments;?>>
<!-- <table style="width:100%;height:100%;"><tbody> -->
                            


<?php
           

                  $i = 0;
                  foreach($datas_comments as $data5){ 
                      if($data5['id_asset']==$datas['id']){
                                foreach($datas_users as $data6){ 
                                    if($data6['id']==$data5['id_creator']){
                                        $i++;
                                        $bg_color = $i % 2 === 0 ? "#cccccc" : "#eeeeee";



echo " <div style='background-color: ". $bg_color .";'>";

include('comment.php'); 

echo " </div>";
//echo " a";



                                    }
                                }

                      }
                  }  
?>

                           
<!-- </tbody></table> -->
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




    $('.thumbnail_comments').click(function(){
        $('.modal-body').empty();
        var title = $(this).parent('a').attr("title");
        var src = $(this).attr("src");
        var number = $(this).parent('a').attr("number");

        $('.modal-title').html(title);
        //$($(this).parents('div').html()).appendTo('.modal-body');
        $('<div><a href="#" title="Image '+number+'"><img src="'+src+'"  width="1280" height="720"></a></div>').appendTo('.modal-body');
        $('#myModal').modal({show:true});
       
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





});





</script>


   



   





</body>


</html>




