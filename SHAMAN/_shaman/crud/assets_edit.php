
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




$disabled_description = " disabled";
if ($_SESSION['id_status_user']==2){
    $disabled_description = " ";
}


$ids_projects   = $datas['ids_projects'];
$name_project   = $datas_projects['project'];
$folder_name    = $datas['folder_name'];








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


body { background: #ccc; padding:1.8em 0;overflow-x:hidden; }

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




























<body>



<!-- <div class="section group">
header

</div> -->

<div class="header">
<?php include('menu_top_edit.php'); ?>
</div>


<div class="section group" style="background-color:#262626;">
	<div class="col span_1_of_3 " style=" border: 1px solid black;width:<?php echo W_V_EDIT;?>px;height:<?php echo H_V_EDIT;?>px;);background-size: cover;">

	<?php include('_vignette.php'); ?>
	</div>
	<div class="col span_1_of_3 " style="height:<?php echo H_V_EDIT;?>px;);background-color:#303030;">
	<?php include('_description.php'); ?>
	</div>
	<div class="col span_1_of_3 "  style="height:<?php echo H_V_EDIT;?>px;);background-color:#303030;">
	<?php include('_tags.php'); ?>
	</div>

</div>


<div class="section group" style="background: #d3dded;">
	
                    <button id='btn_addComment' style='height:25px;' href="#collapse1" class="nav-toggle">add comment [ + ]</button>
	
</div>
<div id='#resultats_ajax' class="section group" style="background: red;">

</div>
<div class="section group">
	
	<?php include('_collapse_edit.php'); ?>
	
</div>


<div class="section group">
<?php include('_comments.php'); ?>

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




<!--   <div id="delete_file_comment">
toto
</div>
 -->






<div class="dropdown bootstrapMenu" style="z-index: 10000; position: absolute; display: none; height: 69px; width: 158px; top: 169.004px; left: 985px;">
<ul class="dropdown-menu" style="position:static;display:block;font-size:0.9em;">
</div>



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>







<script type="text/javascript">
  
/*function delete_file(path){
alert(path);
}*/


$(document).ready(function (e) {








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
                toggle_switch.html('add comment : +');
              }else{
                //$('.table_top').hide();
                toggle_switch.html('Cancel');
              }
            });
          });
















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

      	$( '#update_upload_'+id_comment).load( "new_upload.php?id=<?php echo $_GET['id'];?>&timestamp_id_creator=" + timestamp_id_creator + "" );

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