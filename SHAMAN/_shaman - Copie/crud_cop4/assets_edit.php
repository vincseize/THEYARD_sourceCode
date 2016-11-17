
<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$db = new DB();
require '../../classes/__classes_fcts.php';
$fcts = new FCTS();


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




$disabled_description = " disabled";
if ($_SESSION['id_status_user']==2){
    $disabled_description = " ";
}


$ids_projects   = $datas['ids_projects'];
$name_project   = $datas_projects['project'];
$folder_name    = $datas['folder_name'];








?>







<?php
//require '../../inc/crud.php';

$db = new DB();
$tblName = 'assets';
//$datas_id_asset              = $db->getRows($tblName,array('where'=>array('id'=>$_GET['id']),'return_type'=>'single'));
$datas_id_asset              = $db->getRows($tblName,array('where'=>array('id'=>$_GET['id']),'return_type'=>'single'));
$modified    = $datas_id_asset['modified'];
$name    = $datas_id_asset['name'];

$previous_id = '';
$previous_name = '';
$next_id = '';
$next_name = '';

$arr_tags = array();



foreach ($_SESSION['prefs_user'] as $t) {
    $tmp = explode("text:",$t);
    $tag = substr($tmp[1],2,-2);
     // $tag = 'AEROPORT';


    //$stmt = $db_con->prepare("SELECT id,name FROM tags WHERE tag LIKE '".$tag['tag']."' ");
    $datas_id_tag              = $db->getRows('tags',array('where'=>array('tag'=>$tag),'return_type'=>'single'));
    array_push($arr_tags, $datas_id_tag['id']);
}






if ( $_SERVER["SERVER_ADDR"] == "82.223.10.101" ) {
  $db_host = "82.223.10.101";
  $db_name = "minuscule2";
  $db_user = "Mimi";
  $db_pass = "Coccinelle2016";
}else{ // dev server


  $db_host = "db651115066.db.1and1.com";
  $db_name = "db651115066";
  $db_user = "dbo651115066";
  $db_pass = "shaman2016";


}
try {
  $db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
  $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $ex) {
    echo "An Error occured!"; //user friendly message
}


//echo sizeof($arr_tags);


//////////////////////////////////////////////////// no filters selected
if(sizeof($arr_tags) == 0){

      // $stmt = $db_con->prepare("SELECT id,modified,name FROM assets WHERE modified LIKE '2016-11-13 23:11:38'");
      $stmt = $db_con->prepare("SELECT id,name,modified FROM assets WHERE modified >= '".$modified."' AND name NOT LIKE '".$name."'  ORDER BY modified ASC LIMIT 1");
      $stmt->execute();
      //$row = $stmt->fetch(PDO::FETCH_ASSOC);
      $row = $stmt->fetchAll();
      //$count = $stmt->rowCount();
      $previous_id = $row[0]['id'];
      $previous_name = $row[0]['name'];

      $stmt = $db_con->prepare("SELECT id,name,modified FROM assets WHERE modified <= '".$modified."' AND name NOT LIKE '".$name."'  ORDER BY modified DESC LIMIT 1");
      $stmt->execute();
      //$row = $stmt->fetch(PDO::FETCH_ASSOC);
      $row = $stmt->fetchAll();
      //$count = $stmt->rowCount();
      $next_id = $row[0]['id'];
      $next_name = $row[0]['name'];
}



///////////////////////////////////////////////////// filters selected
if(sizeof($arr_tags) > 0){

          $array_ids_tags_check = array() ;
          $st_tags = '';
          foreach ($arr_tags as $st) {
              $st_tags = $st.','.$st_tags;
          }

          foreach ($datas_assets as $d) {
              if (strpos($d['ids_tags'], $st_tags) !== false) {
                  $array = array();
                  $array['modified'] = $d['modified'];
                  $array['id'] = $d['id'];
                  $array['name'] = $d['name'];
                  array_push($array_ids_tags_check, $array);
              }
          }

    function searchForId($key_search, $id, $array, $fcts) {
        //$fcts->consoleLog('$key_search',$key_search);
       foreach ($array as $key => $val) {
           if ($val[$key_search] === $id) {
                $ar = array();
                array_push($ar, $key);
                array_push($ar, $val[$key_search]);
                array_push($ar, $val['id']);
                array_push($ar, $val['name']);
                array_push($ar, $val['modified']);
               return $ar;
           }
       }
       return null;
    }

    function searchForKeyVal($key_search, $array, $fcts) {
        //$fcts->consoleLog('$key_search',$key_search);
       foreach ($array as $key => $val) {
          if ($key === $key_search) {
              return $val['id'];
            }
       }
       return null;
    }

    function consoleLog( $title, $data ) {
        if ( is_array( $data ) )
            $output = "<script>console.log( 'Debug Objects ".$title.": " . implode( ',', $data) . "' );</script>";
        else
            $output = "<script>console.log( 'Debug Objects ".$title.": " . $data . "' );</script>";
            echo $output;
    }


    sort($array_ids_tags_check);

/*    foreach ($array_ids_tags_check as $key => $value) {
        $fcts->consoleLog('date ',$value['modified'] . ' | ' . $value['id']);
    }*/

    //$fcts->consoleLog('$array_ids_tags_checkKLASS',$array_ids_tags_check);

    $res = searchForId('id',$_GET['id'], $array_ids_tags_check,$fcts);
    $key = $res[0];
    $id = $res[1];
    $id_ar = $res[2];
    $name_ar = $res[3];
    $modified_ar = $res[4];
    //$fcts->consoleLog('$id',$id);
    //$fcts->consoleLog('$id_ar',$id_ar);
    //$fcts->consoleLog('$name_ar',$name_ar);
    //$fcts->consoleLog('$modified_ar',$modified_ar);

    //$fcts->consoleLog('$key',$key);
    //$fcts->consoleLog('$id',$id);

    $key_next = $key-1;
    //$fcts->consoleLog('$key_next',$key_next);
    $next_id = searchForKeyVal($key_next, $array_ids_tags_check,$fcts);
    //$fcts->consoleLog('$searchForKeyVal Next ID',$next_id);
    $res = searchForId('id',$next_id, $array_ids_tags_check,$fcts);
    $next_name  = $res[3];
    //$fcts->consoleLog('$next_name',$next_name);

    $key_before = $key+1;
    //$fcts->consoleLog('$key_next',$key_before);
    $previous_id = searchForKeyVal($key_before, $array_ids_tags_check,$fcts);
    //$fcts->consoleLog('$searchForKeyVal Previous ID',$previous_id);
    $res = searchForId('id',$previous_id, $array_ids_tags_check,$fcts);
    $previous_name  = $res[3];
    //$fcts->consoleLog('$previous_name',$previous_name);


}




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

?>



<?php


?>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


    <script src="../js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="../js/jquery.ui-contextmenu.min.js" type="text/javascript"></script>
<!--     <script src="../js/BootstrapMenu.min.js"></script> -->




<!-- <link rel="stylesheet" href="html5reset.css2" media="all"> -->
<link rel="stylesheet" href="col.css" media="all">
<link rel="stylesheet" href="3cols.css" media="all">



    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <script src="../js/BootstrapMenu.min.js"></script>



    <link href="../css/jquery-ui.css" type="text/css" rel="stylesheet">

    <script src="../js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="../js/jquery.ui-contextmenu.min.js" type="text/javascript"></script>








<script type="text/javascript" src="html5lightbox/jquery.js"></script>
<script type="text/javascript" src="html5lightbox/html5lightbox.js"></script>



<script src="dropzone.js"></script>
<script src="dropzone_vignette.js"></script>

<link rel="stylesheet" href="dropzone.css">
<link rel="stylesheet" href="dropzone_vignette.css">



<style type="text/css">


/*body { background: #ccc; padding:1.8em 0;overflow-x:hidden; }*/
body { background: #ccc; padding-top:1.8em; padding-bottom:1.8em; padding-left:0; padding-right:0;margin:0;overflow-x:hidden; }

.header { padding:0; }
.col { background: #ccc; padding:1em 0; text-align:center;}



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




a:link { text-decoration: none; } 
a:visited { text-decoration: none; } 
a:hover { text-decoration: none; } 
a:active { text-decoration: none; }


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


<style type="text/css">
    .bs-example{
      margin: 20px;
    }
    .modal-content iframe{
        margin: 0 auto;
        display: block;
    }
</style>




























<body style="background-color:#262626;">





<?php 
if(!empty($previous_id)){ 
    echo "<span class='assetEdit_nextprevious assetEdit_previous' style='font-size:38px;font-weight:bold;color:#ddd;position:absolute;top:150px;left:10px;opacity:0.2;'>";
    echo "<a href='assets_edit.php?id=".$previous_id."' id='assetEdit_previous'  target='_self'>";
    echo "<";
    echo "</a>";
    echo "</span>";
}
?>

<?php 
if(!empty($next_id)){ 
    echo "<span  class='assetEdit_nextprevious assetEdit_next' style='font-size:38px;font-weight:bold;color:#ddd;position:absolute;top:150px;left:390px;opacity:0.2;'>";
    echo "<a href='assets_edit.php?id=".$next_id."' id='assetEdit_next' target='_self'>";
    echo ">";
    echo "</a>";
    echo "</span>";   
}
?>




<div class="section group" style="background-color:#262626;padding-right:0px;margin-right:0px;right:0px;width:100%;">
	<div class="col span_1_of_3 " style=" border: 1px solid black;padding-right:0px;width:<?php echo W_V_EDIT;?>px;height:<?php echo H_V_EDIT;?>px;);background-size: cover;">
	<?php include('_vignette.php'); ?>
	</div>
	<div class="col span_1_of_3 " style="height:<?php echo H_V_EDIT;?>px;);width:<?php echo (W_V_EDIT-100);?>px;background-color:#303030;margin-top:25px;">
	<?php include('_description.php'); ?>
	</div>
	<div class="col span_1_of_3 "  style="height:<?php echo H_V_EDIT;?>px;);width:50%;background-color:#303030;padding-right:0px;margin-right:0px;margin-top:25px;">
	<?php include('_tags.php'); ?>
	</div>

</div>


<div class="section group" style="background: #555;">
	<span style="color: #bbb;float:left;left:15px;"><h1>Comments</h1></span>
<!--   <span><button id='btn_addComment' style='height:25px;' href="#collapse1" class="nav-toggle">add comment [ + ]</button></span>
	
 -->



  <span style="color: #bbb;float:right;right:15px;">
<a  href="#collapse1"  title="add comment [ + ]" class="nav-toggle" style="text-decoration:none;font-size:32px;color:#eee;">
  

<span class="glyphicon glyphicon-plus-sign">

            </span>
</a>
</span>







</div>
<div id='#resultats_ajax' class="section group" style="background: red;">

</div>
<div class="section group">
	
	<?php include('_collapse_edit.php'); ?>
	
</div>


<div class="section group" style="background:#262626;">
<?php include('_comments.php'); ?>

</div>









<style>
.modal {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  overflow: hidden;
  margin: 0;
  width: 100%;
  height: 100%;
  padding: 0;
   border: 0;
}

.modal-dialog {
  position: fixed;
  margin: 0;
  width: 100%;
  height: 100%;
  padding: 0;
  overflow: hidden;
   border: 0;
}

.modal-content {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  border: 0;
  border-radius: 0;
  box-shadow: none;
  margin: 0;
  width: 100%;
  height: 100%;
  padding: 0;
  overflow: hidden;
}

.modal-header {

  top: 0;
  right: 0;
  left: 0;
  height: 50px;
/*  padding-top: 0px;*/
  background: #555;
  border: 0;
}

.modal-title {
  position: relative;
  font-weight: 200;
  font-size: 1em;
  color: #fff;
  /*line-height: 30px;*/
   border: 0;
}

.modal-body {
  position: absolute;
  top: 0px;
  bottom: 0px;
  width: 100%;
  font-weight: 300;
  overflow: hidden;
   border: 0;
}

.modal-footer {
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  height: 60px;
  padding: 0px;
  background: #555;
   border: 0;
}
</style>



<div id="myModal_des" class="modal" tabindex="-1" role="dialog" style="width:100%;height:95%;background-color: #555;">
  <div class="modal-dialog" style="width:100%;height:100%;background-color: #555;">
  <div class="modal-content" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3 class="modal-title">Heading</h3>
  </div>
  <div class="modal-body" style="width:100%;height:100%;background-color: #555;">
    
  </div>
  <div class="modal-footer">
<!--         <button id="prev-btn" class="btn btn-warning">Prev</button>
        <button id="next-btn" class="btn btn-primary">Next</button> -->
        <button class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
   </div>
  </div>
</div>




<!--   <div id="delete_file_comment">
toto
</div>
 -->










<button class="btn btn-primary btn-modal"
        data-toggle="modal"
        data-target="#myModal">
  View Fullscreen Modal
</button>


<!-- modal -->
<div id="myModal"
     class="modal animated bounceIn"
     tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true"  style="width:100%;height:95%;background-color: #555;overflow:hidden;margin-top:0px;margin:0;opacity:0.9; border: 0;">

  <!-- dialog -->
  <div class="modal-dialog" style="width:100%;height:100%;background-color: #555;overflow:hidden; border: 0;">

    <!-- content -->
    <div class="modal-content" style="width:100%;height:100%;background-color: #555;overflow:hidden; border: 0;">

      <!-- header -->
      <div class="modal-header2" style="width:100%;background-color: red;overflow:hidden; height:60px;border: 0;color:white;">
<!--         <h1 id="myModalLabel"
            class="modal-title" style="width:100%;background-color: #555;overflow:hidden; height:60px;border: 0;color:#222;"> -->
          <span id="myModalLabel">Modal title</span>
     <!--    </h1> -->
      </div>
      <!-- header -->
      
      <!-- body -->
      <div class="modal-body" style="width:100%;background-color: #555;overflow:hidden;border: 0;">
        




      </div>
      <!-- body -->

      <!-- footer -->
      <div class="modal-footer" style="width:100%;background-color: #555;height:60px;overflow:hidden;border: 0;margin-bottom:60px;">
        <button class="btn btn-secondary"
                data-dismiss="modal" style=";">
          close
        </button>
        
      </div>
      <!-- footer -->

    </div>
    <!-- content -->

  </div>
  <!-- dialog -->

</div>
<!-- modal -->














































<div class="dropdown bootstrapMenu" style="z-index: 10000; position: absolute; display: none; height: 69px; width: 158px; top: 169.004px; left: 985px;">
<ul class="dropdown-menu" style="position:static;display:block;font-size:0.9em;">
</div>



<!-- Bootstrap core JavaScript FOR MODAL
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->


<!-- 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">



<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


 -->



<link rel="stylesheet" href="../css/bootstrap.min.css" ><!--  // 337 -->
<link rel="stylesheet" href="../css/bootstrap-theme.min.css"> <!-- // 337 -->
<script src="../js/bootstrap.min.js"></script>



<script type="text/javascript">
  
/*function delete_file(path){
alert(path);
}*/


$(document).ready(function (e) {





    function image_next() {
             $('#assetEdit_name', window.parent.document).text('<?php echo $next_name;?>');
    };

    function image_previous() {
            $('#assetEdit_name', window.parent.document).text('<?php echo $previous_name;?>');
    };





    $("#assetEdit_next").click(function() {
        //$('#assetEdit_name', window.parent.document).text('<?php echo $next_name;?>');
        image_next();
    });
    $("#assetEdit_previous").click(function() {
        //$('#assetEdit_name', window.parent.document).text('<?php echo $previous_name;?>');
        image_previous();
    });


/*   window.onkeyup = function(e) {
        var event = e.which || e.keyCode || 0; // .which with fallback
        if (event == 39) { // > Key
            alert('image_next');
            $('#assetEdit_name', window.parent.document).text('<?php echo $next_name;?>');
        }
        if (event == 37) { // < Key
            alert('image_previous');
            $('#assetEdit_name', window.parent.document).text('<?php echo $previous_name;?>');
        }
    }
*/
















        $("#assetEdit_next").click(function() {
            //console.log('next')
            $('#assetEdit_name', window.parent.document).text('<?php echo $next_name;?>');
/*            $('#assetEdit_name', window.parent.document).animate({opacity:0},function(){
                $(this).text("new text").animate({opacity:1});  
                })
            });*/


        });



        $("#assetEdit_previous").click(function() {
            //console.log('previous')
            $('#assetEdit_name', window.parent.document).text('<?php echo $previous_name;?>').fadeIn();
        });





var menu = new BootstrapMenu('.thumbnail_commentsX', 







  {
   










          actions: [

          {

            name: 'Delete File ',
            onClick: function(self) {
              // alert("Add asset wip!");
/*              $('#content-item').hide();
              $('#content-asset-crud').show();
              $('#content-asset-crud').load("modal_newAsset.php");*/
              //window.location.href = "new_asset.php?";


   path = $('.thumbnail_comments').attr('id2');
console.log(path);






var path0 = $('.thumbnail_comments').attr('id2');


              var path = $('.thumbnail_comments').attr("path");  
              console.log(path0);

/*
              window.location.href = "new_asset.php?id_project="+select_id_project;*/
            }
          }

          ]
        });



});

















$('.thumbnail').click(function(){
    $('.modal-body').empty();
    var title = $(this).parent('a').attr("title");
    $('.modal-title').html(title);  
      //get the source of thumb image
        var image = $(this).attr("src");
        //remove thumb directory from image 
        var image = image.replace("thumb/","");

        // create html for modal body
        var html ='<img src="'+image+'" />';
        // add to the modal body.
        $('.modal-body').html(html);
    $('#myModal').modal({show:true});
});


    $('.thumbnail_comments').click(function(){
        $('.modal-body').empty();
        var title = $(this).parent('a').attr("title");
        //var src = $(this).attr("src");
        var src = $(this).attr("path");
        var ext = $(this).attr("ext");
        //alert(ext);
        var number = $(this).parent('a').attr("number");

        //$('.modal-title').html(title);
        //$($(this).parents('div').html()).appendTo('.modal-body');


if(ext!='mp4'){
    $('<div><a href="#" title="Image '+number+'"><img src="'+src+'"  width="1280" height="720"></a></div>').appendTo('.modal-body');
}      





if(ext=='mp4'){
$('<div><a href="#" title="Image '+number+'"><video controls preload="auto"><source src="'+src+'" type="video/mp4"><source src="'+src+'" type="video/webm"><source src="'+src+'" type="video/ogv"></video>').appendTo('.modal-body');
}



        $('#myModal').modal({show:true});






    });

    



    $(function() {
          $("#file").change(function() {
              $("#message").empty(); // To remove the previous error message
              var file = this.files[0];
              var imagefile = file.type;
              /*var match= ["image/jpeg","image/png","image/jpg"];
              if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
              {
                alert("jpeg, jpg and png type allowed");
                return false;
              }
              else
              {*/
              var reader = new FileReader();
              reader.onload = imageIsLoaded;
              reader.readAsDataURL(this.files[0]);
             /* }*/
          });
    });

    function imageIsLoaded(e) {
            $('form#uploadimage').submit();
            $('#image_preview').css('background-image', 'url('+e.target.result+')');
            //$("#a7_vignette").load();
            //$('#a7_vignette').load(location.href+ '#a7_vignette');
            $('#a7_vignette').html(retour)
    };














          $('.nav-toggle').click(function(e){
            //get collapse content selector
            var collapse_content_selector = $(this).attr('href');
            var toggle_switch = $(this);
            $(collapse_content_selector).toggle(function(e){
              if($(this).css('display')=='none'){
                //$('.table_top').show();                                
                //toggle_switch.html('add comment : +');
              }else{
                //$('.table_top').hide();
                //toggle_switch.html('Cancel');
              }
            });
          });
















 /*   window.onkeyup = function(e) {

        var event = e.which || e.keyCode || 0; // .which with fallback

        if (event == 27) { // ESC Key
            window.location.href = '../index.php'; // Navigate to URL
        }
    }*/



    $('.modify_comment').click(function(){
        var id_comment = $(this).attr("id_comment");
        var comments = $('#textarea_comment_'+id_comment).val();
        /*alert(comments);*/
        $('.div_modify_comment_'+id_comment).hide();
        $('#delete_file_comment').css({'display':'block'});
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

                      console.log('ok');
/*                          if(data != '')  
                          {  
                               $('#description').val(description);  
                          }  
                          setInterval(function(){  
                          }, 2000);  */

                          /*window.location.href = self.location;*/
                          location.reload();

                     }  
                });  

/*                setTimeout(function(){ 
                         window.location.href = self.location;
                    }, 1000);  */

    





    });








      $(".delete_comment").click(function () {
        

        var id_comment = $(this).attr("id");
        var DATAScommentsFolder = $(this).attr("DATAScommentsFolder");
        var action_type = 'delete';
        //alert(id_comment+DATAScommentsFolder+action_type);
    if (confirm("Are you sure you want to delete this comment ?")) {
                $.ajax({  
                    url:"comments_action.php",  
                    method:"POST",  
                    data:({
                        action_type:action_type,
                        DATAScommentsFolder:DATAScommentsFolder,
                        id_comment:id_comment
                    }), 
                   dataType:"text",  

                   //success : function(code_html, statut){
                       //$(code_html).appendTo("#commentaires"); // On passe code_html à jQuery() qui va nous créer l'arbre DOM !
                   // },
                   success:function(response){
                        //alert('success ?');
                        console.log(response);
                        $('#div_comment_'+id_comment).fadeOut(1000);
                        
                   },

                   error : function(){
                      alert(data);
                      alert('Error occured');
                      console.log(response);
                       $("#resultats_ajax").html("<p>Erreur lors de la connexion...</p>");
                   },

                   complete : function(resultat, statut){

                   }

                });  

}

    });







      $(".edit_comment").dblclick(function () {
        
        var id_comment = $(this).attr("id");
		    var timestamp_id_creator = $(this).attr("timestamp_id_creator");
        //alert(id_comment);
        $('.delete_comment').hide();
        $('.update_upload').show();
/*        $('#update_upload').load('new_upload.php');*/
// alert(timestamp_id_creator);

      	$( '#update_upload_'+id_comment).load( "_new_upload.php?id=<?php echo $_GET['id'];?>&timestamp_id_creator=" + timestamp_id_creator + "" );

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





/*      function autoSave(e)  
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
           }, 2000);  */




</script>

















</body>