<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$db = new DB();
$tblName = 'assets';
$datas              = $db->getRows($tblName,array('where'=>array('id'=>$_GET['id']),'return_type'=>'single'));
$datas_projects     = $db->getRows('projects',array('where'=>array('id'=>$datas['ids_projects']),'return_type'=>'single'));
$datas_projets      =$projects;
$datas_tags         =$tags;
$datas_assets       =$assets;
$datas_users        =$users;
$datas_comments     =$comments;
$datas_comments_asc =$comments_asc;


$title_user = "Hi' ".$_SESSION['login']." [ ".$_SESSION['status']." ]";

$timestamp_id_creator = date("Ymd_his")."_".$_SESSION['id'];

//$ID=$_GET['ID'];


$ds = DIRECTORY_SEPARATOR;

?>


<?php
if(isset($_POST['tags']) && !empty($_POST['choix'])){
  $choix ='';
    for ($i=0;$i<count($_POST['choix']);$i++)
      {
      //on concatène
      $choix .= $_POST['choix'][$i].',';
      }
      //echo $choix;

$data = array(
            'ids_tags' => $choix
        );
        $condition = array('id' => $_GET['id']);
        $update = $db->update($tblName,$data,$condition);
        



}

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


<link rel="stylesheet" href="../jquery.modal.css" type="text/css" media="screen" />


<link rel="stylesheet" href="../shaman.css" type="text/css" media="screen" />


<link href="jquery.multiselect_AssetEdit.css" rel="stylesheet" type="text/css">

<style type="text/css">
    

body { 
/*width: 600px;*/
}

.container_generalDes { 

height: 400px;
}


.tg  {border-collapse:collapse;border-spacing:0;width:100%;height:100%;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}

.tg .tg-left{vertical-align:middle; background-color: black; color: white;}

.tg .tg-center{vertical-align:top;  background-color: gray; width:95%;}


.tg .tg-right{vertical-align:middle; background-color: black; color: white;}

</style>

















<body >

<!-- 
<div id='container_general' class='container_general'> -->











<table class="tg" style='width:100%;height:100%;'>
  <tr>
    <th class="tg-left"><</th>





    <th class="tg-center" style='width:100%;height:100%;'>
       


<div id='central'>






<h1>

<?php
echo $datas['name'];
?>
</h1>




<hr>










<style type="text/css">
.tgC  {}
.tgC td{}
.tgC th{}
.tgC .tgC-central{vertical-align:top}
</style>

<div class='table_top' >




























<table class="tgC" style='width:100%;height:100%;'>
  <tr>
    <th class="tgC-central" style='width:1%;'>






<?php


$disabled_description = " disabled";
if ($_SESSION['id_status_user']==2){
    $disabled_description = " ";
}




$ids_projects   = $datas['ids_projects'];
$folder_name    = $datas['folder_name'];

$name_project   = $datas_projects['project'];




      $path_vignette = "../../".$_SESSION['$DATASstoreFolder'].'/'.$ids_projects.'_'.$name_project.'/assets/'.$folder_name.'/vignette.jpg';
      // echo $path_vignette;
      // ../_DATAS_LOCALHOST/1_M2/assets/1_55_MIMI/vignette.jpg
      $vignette = "<img src='".$path_vignette."' style='width:320px;height:120px;' alt=''>";
      // $vignette_bg = 
     //echo strlen($datas['vignette']);
     if (!file_exists($path_vignette)) {
            $vignette = "<img src='../images/vignette_default.jpg' style='width:500px;height:300px;' alt=''>";
            $path_vignette = '../images/vignette_default.jpg';
      }

/*echo $datas['vignette'];
echo strlen($datas['vignette']);*/


      echo $vignette;






?>

       <!--  <img src='../images/add_a7.png' alt='' style='width:500px;height:300px;'> -->


                          <form 



                          action="upload_vignette.php?ids_projects=<?php echo $datas['ids_projects'];?>&name_project=<?php echo $datas_projects['project'];?>&id_asset=<?php echo $_GET['id'];?>&folder_name=<?php echo $datas['folder_name'];?>" id="dropzoneFiles" class="dropzone" style="background-image: <?php echo $path_vignette;?>">



                          </form>








    </th>
    <th class="tgC-central">
        
        <div id="description_title" style="width: 100%;border-width:1px;border-color:#d3dded;border-style:solid;background-color: #d3dded;">
        Description
</div>

Frames : <?php echo $datas['duree']; ?>
<br>
Description :<br> 

<textarea name="textarea" rows="10" cols="50" <?php echo $disabled_description; ?>><?php echo $datas['description'];?></textarea>

<br>

Path : 
<br>

Mail ? : 
<br>










    </th>
    <th class="tgC-central">
        <div id="tags_title" style="width: 100%;border-width:1px;border-color:#d3dded;border-style:solid;background-color: #d3dded;">

Tags
</div>

<?php
      foreach($datas_assets as $data3){ 
        if($data3['ids_projects']=="1"){ 

//echo $datas['ids_tags'];


                  $tags = ' ';
                  $ar_tags = explode(",", $datas['ids_tags']);
                  foreach($ar_tags as $t){ 
                            foreach($datas_tags as $data4){ 
                                if($t==$data4['id']){$tags = $tags . ' ' . $data4['tag'] ;}
                                }
                  }





        }
}
echo $tags;
?>
<hr>

add tag : <!-- <div id="#toggle_tags">+</div> -->



                           
<form name="monform" method="post">
                            
                    <?php
                          if(!empty($datas_tags)){ 
                              foreach($datas_tags as $data3){ 
                                  //echo "<option value='".$data3['id']."'>".$data3['tag']."</option>";
                                  echo "<input type='checkbox' name='choix[]'' value='".$data3['id']."'>".$data3['tag']."<br />";
                              }
                          }
                      ?>

<input type="submit" name="tags" value="valid">
</form>

    </th>
  </tr>
</table>
</div>


















<div id="comments_title" style="width: 100%;border-width:1px;border-color:#d3dded;border-style:solid;background-color: #d3dded;">
Commentaires
</div>






<div>
        <button href="#collapse1" class="nav-toggle">add comment : +</button>
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
                                 
<!--                           drag files
<?php echo $datas['ids_projects'];?>
<br>
<?php echo $datas_projects['project'];?>
<br>
<?php echo $_GET['id'];?>
<br>
<?php echo $datas['folder_name'];?>
<br>
<?php echo $timestamp_id_creator;?>
<br> 
 -->

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




<style>
.FixedHeightContainer
{

  width:100%; 
  padding:2px; 

}
.ContentCommentsTable
{
  width:100%; 
    height: 400px;
   overflow:auto;
    background:#fff;
}
</style>



<body>


<?php
include('menu_top_edit.php');
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

<div class="FixedHeightContainer" <?php echo $style_comments;?>>

    <div class="ContentCommentsTable">
<table style="width:100%"><tbody>
    

<?php
           

                  $i = 0;
                  foreach($datas_comments as $data5){ 
                    if($data5['id_asset']==$datas['id']){
                              foreach($datas_users as $data6){ 
                                  if($data6['id']==$data5['id_creator']){
                                                $i++;
                                                $bg_color = $i % 2 === 0 ? "#cccccc" : "#eeeeee";
                                                echo "<tr style='background-color: ". $bg_color .";'>";
                                                echo "<td>";
                                                echo "from ".$data6['login']."> ".$data5['comments']." | ".$data5['modified']."<br>";
                                                echo " </td>";








                                                echo "<td>";




/*
 echo $data5['timestamp_id_creator'];


      $path_vignette = "../".$_SESSION['$DATASstoreFolder'].'/'.$ids_projects.'_'.$name_project.'/assets/'.$folder_name.'/vignette.jpg';

*/

 $DATAScommentsFolder = "../../".$_SESSION['$DATASstoreFolder'].$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds."comments".$ds.$data5['timestamp_id_creator'].$ds;



/*      $directory = "";*/
      $local = glob( $DATAScommentsFolder . "*"); 
      echo "<ul>";
      foreach($local as $item)
      {
      echo "<li>$item</li>";
      }
      echo "</ul>";











                                                echo " </td>";







                          echo "<td>";
                          if($data5['id_creator']==$_SESSION['id']){echo " modify | delete";}
                          
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
























    </th>






    <th class="tg-right">></th>
  </tr>
</table>




<!-- // div container_general -->
<!-- </div> -->





    <script>
        $(document).ready(function() {
          $('.nav-toggle').click(function(){
            //get collapse content selector
            var collapse_content_selector = $(this).attr('href');

            //make the collapse content to be shown or hide
            var toggle_switch = $(this);
            $(collapse_content_selector).toggle(function(){
              if($(this).css('display')=='none'){
                //$('.table_top').show();                                
                toggle_switch.html('add comment : +');

              }else{
                //$('.table_top').hide();
                toggle_switch.html('Cancel');

              }
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





          });

        });
        </script>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->



<script src="../js/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>


<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script src="jquery.multiselect_AssetEdit.js"></script>





</body>


</html>




