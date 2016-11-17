    <link href="jquery.contextMenu.css" rel="stylesheet" type="text/css" />

<!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
    <script src="jquery.contextMenu.js" type="text/javascript"></script>




<?php

 $DATAScommentsFolder = "../../".DATASstoreFolderName.$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds."comments".$ds.$data5['timestamp_id_creator'].$ds;


//echo $DATAScommentsFolder;


echo "<div style='height:40px;background-color:#aaaaaa;width:100%;'>";



		echo "<div style='float: left;display:inline;padding-left:15px;'>";
			echo "<span style='font-weight: bold;font-size:16px'>- ".$data6['login']." | ".$data5['modified']."&nbsp;&nbsp;&nbsp;</span>";
		echo "</div>";

$comment_id = $data5['id'];
//echo $data5['id'];  

		echo "<div style='position:relative;right:0px;float: right;'>";


          //echo "<input type='hidden2' id='id_asset' name='id_asset' value='".$_GET['id']."'/>";
          //echo "<input type='hidden2' id='id_comment' name='id_comment' value='".$data5['id']."'/>";
          //echo "<input type='hidden2' id='DATAScommentsFolder' name='DATAScommentsFolder' value='".$DATAScommentsFolder."'/>";

					echo "<div style=' display: inline-block;vertical-align:top;horizontal-align:right;'>";
					echo "<div id='div_modify_comment_".$data5['id']."' style='display:none;'>

          <input type='button' class='modify_comment' id='modify_comment' name='modify_comment' id_comment='".$data5['id']."' value='modify | cancel' /></div>"; 
					echo "</div >";  
					if($_SESSION['status']=='2' or $_SESSION['id'] == $data6['id']){					
    					echo "<div style=' display: inline-block;vertical-align:top;horizontal-align:right;background-color:blue;'>";

    					     echo "<input type='submit' class='delete_comment' id='".$data5['id']."' name='".$data5['id']."' DATAScommentsFolder='".$DATAScommentsFolder."' value='X' style='border:none;'/>";

    					echo "</div >";  
					}
		
          //echo $data5['id'];  
		echo "</div>";


echo "</div>";





$class_edit_comment = " class='edit_comment' ";
if($_SESSION['is_root']==true){ $class_edit_comment = ""; }
echo "<div ".$class_edit_comment." valign='top' style='width:60%' timestamp_id_creator='".$data5['timestamp_id_creator']."' id='".$data5['id']."' name='".$data5['id']."' style='float: left;display:inline;padding-left:15px;'>";
$comments = $data5['comments'];
$comments = preg_replace("/<br\W*?\/>/", "\n", $comments);
$comments = str_replace("< />", "", $comments);
echo nl2br($comments);
echo " </div>";







echo "<div>";
/*
 echo $data5['timestamp_id_creator'];


      $path_vignette = "../".$_SESSION['$DATASstoreFolder'].'/'.$ids_projects.'_'.$name_project.'/assets/'.$folder_name.'/vignette.jpg';

*/

 $DATAScommentsFolder = "..".$ds."..".$ds.DATASstoreFolderName.$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds."comments".$ds.$data5['timestamp_id_creator'].$ds;

// echo $DATAScommentsFolder;

/*      $directory = "";*/
      $folder = glob( $DATAScommentsFolder . "*"); 

       echo "<table width=100%><tr><td width=70%>";    
      echo "<div id='img-container' class='row' style='padding-top:3px;padding-bottom:3px;display:inline;'>";
      $number = 0;
      foreach($folder as $vignette)
          { $number = $number+1;
              $info = new SplFileInfo($vignette);
              $file = basename($vignette);
              $ext = $info->getExtension();

              $vignette_path = str_replace('\\', '/', $vignette); // for javascript antislash

              if($ext=='jpg' or $ext=='jpeg' or $ext=='png' or $ext=='gif'){






                  echo "<div style='display:inline; width:'".W_THUMB_COM.".px' ; height:'".H_THUMB_COM."px;'>";
                  echo "<a href='#' title='Image $number' number='$number'>";
                  echo "<img id2='".$data5['id']."' class='thumbnail_comments' src='$vignette' path='$vignette' ext='$ext'  width='".W_THUMB_COM.".px' height='".H_THUMB_COM."px'/>&nbsp;"; 
                  echo "</a>"; 
                  //echo "<span id='delete_file_comment' style='display:none;'><input type='submit' file='".$vignette."' value='X'/></span>";


/*echo "<menu id='html5polyfill_".$data5['id']."' class='context_menu' type='context' style='display:none'><command label='delete file' onclick=\"alert('".$vignette."')\"></menu>";*/

if($_SESSION['status']=='2' or $_SESSION['id'] == $data6['id']){  
    echo "<menu id='html5polyfill_".$data5['id']."' class='context_menu' type='context' style='display:none'><command label='delete file' onclick=\"delete_file('".$vignette_path."','".$file."','".$datas['id']."')\"></menu>";
    echo "<span class='context-menu-one btn btn-neutral' contextmenu='html5polyfill_".$data5['id']."' path='$vignette'>delete</span>";
}


                  //echo $vignette;




                  echo "</div>";     
              }

              if($ext=='mp4' or $ext=='webm'  or $ext=='ogv'){
                  echo "<div style='display:inline; width:'".W_THUMB_COM.".px' ; height:'".H_THUMB_COM."px;'>";
                  echo "<a href='#' title='Image $number' number='$number'>";
                  echo "<img class='thumbnail_comments' src='movie.png' path='$vignette'  ext='$ext' width='".W_THUMB_COM.".px' height='".H_THUMB_COM."px'/>&nbsp;"; 
                  echo "</a>"; 
                  echo "<span class='delete_file_comment' style='display:none;'><input type='submit' file='".$vignette."' value='X'/></span>"; 


if($_SESSION['status']=='2' or $_SESSION['id'] == $data6['id']){  
    echo "<menu id='html5polyfill_".$data5['id']."' class='context_menu' type='context' style='display:none'><command label='delete file' onclick=\"delete_file('".$vignette_path."','".$file."','".$datas['id']."')\"></menu>";
    echo "<span class='context-menu-one btn btn-neutral' contextmenu='html5polyfill_".$data5['id']."' path='$vignette'>delete</span>";
}


                  echo "</div>";  
              }
              if($ext=='pdf'){
                  echo "<div style='display:inline; width:'".W_THUMB_COM.".px' ; height:'".H_THUMB_COM."px;border:1px;'>";
                  echo "<a href='#'>";
                  echo "<span  class='thumbnail_comments' class='glyphicon glyphicon-file'>$file</span>&nbsp;"; 
                  echo "</a>"; 
                  echo "<span class='thumbnail_comments' path='$vignette' style='display:none;'><input type='submit' file='".$vignette."' value='X'/></span>";

if($_SESSION['status']=='2' or $_SESSION['id'] == $data6['id']){  
    echo "<menu id='html5polyfill_".$data5['id']."' class='context_menu' type='context' style='display:none'><command label='delete file' onclick=\"delete_file('".$vignette_path."','".$file."','".$datas['id']."')\"></menu>";
    echo "<span class='context-menu-one btn btn-neutral' contextmenu='html5polyfill_".$data5['id']."' path='$vignette'>delete</span>";
}

                  echo "</div>"; 
              }
              if($ext=='tiff' or $ext=='tif' ){
                  echo "<div style='display:inline; width:'".W_THUMB_COM.".px' ; height:'".H_THUMB_COM."px;border:1px;'>";
                  echo "<a href='$vignette'  class='thumbnail_comments' path='$vignette' >";
                  echo "<span  class='glyphicon glyphicon-file'>$file</span>&nbsp;"; 
                  echo "</a>"; 
                  echo "<span class='delete_file_comment' style='display:none;'><input type='submit' file='".$vignette."' value='X'/></span>";

if($_SESSION['status']=='2' or $_SESSION['id'] == $data6['id']){  
    echo "<menu id='html5polyfill_".$data5['id']."' class='context_menu' type='context' style='display:none'><command label='delete file' onclick=\"delete_file('".$vignette_path."','".$file."','".$datas['id']."')\"></menu>";
    echo "<span class='context-menu-one btn btn-neutral' contextmenu='html5polyfill_".$data5['id']."' path='$vignette'>delete</span>";
}

                  echo "</div>"; 
              }
          }
      echo "</div>";


       echo "</td><td>"; 
      
           echo "<div id='update_upload_".$data5['id']."' class='update_upload' style='display:inline;background-color: gray;display:none;height:100px'>upload new files"; 


//include('new_upload.php');


?>










<?php


  echo "</div>";




      echo "<div style='clear: left;'></div>";


       echo "</td></tr></table>";







echo " </div>";












?>







<script>
$(function(){
    $.contextMenu('html5');
});



  
function delete_file(path,file,id_asset){
    // alert(path);
    var action_type = 'delete_file';
    var path = path;
    var file = file;
    var id_asset = id_asset;

    if (confirm("Are you sure you want to delete this file [ "+ file +" ] ?")) {

              $.ajax({  
                        url:"comments_action.php",  
                        method:"POST",  
                        data:({
                            action_type:action_type,
                            path:path,
                            id_asset:id_asset
                        }), 
                       dataType:"text",  

                       //success : function(code_html, statut){
                           //$(code_html).appendTo("#commentaires"); // On passe code_html à jQuery() qui va nous créer l'arbre DOM !
                       // },
                       success:function(response){
                            //alert('success ?');
                            // console.log(response);
                            //$('#div_comment_'+id_comment).hide();
                            window.location.href = "assets_edit.php?id="+id_asset;
                            // .fadeOut(1000);
                            
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

}




</script>