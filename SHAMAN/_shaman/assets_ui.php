<style>
.clickable {
  height: 100%;
  width: 100%;
  left: 0;
  top: 0;
  position: absolute;     
  z-index: 1;
}

#box_shadow:hover {
    outline: 1px solid #337AB2;
}

</style>







<?php

$id_project = '1';
$datas_projects     = $db->getRows('projects',array('where'=>array('id'=>$id_project),'return_type'=>'single'));


foreach($datas_assets as $data){ 
        if($data['active']=="1"){ 





                  $tags = ' ';
                  $ar_tags = explode(",", $data['ids_tags']);
                  foreach($ar_tags as $t){ 
                            foreach($datas_tags as $data4){ 
                                if($t==$data4['id']){$tags = $tags . ' ' . $data4['tag'] ;}
                                }
                  }






                  $comment = '&nbsp;';
                  $modified_byUser = '&nbsp;';
                  $modified = $data['modified'];
                  if(!empty($datas_comments_asc)){ 
                      foreach($datas_comments_asc as $data_com){ 

                          if($data_com['id_asset']==$data['id']){
                           
                              $comment = $data_com['comments'];
/*                              $comment = preg_replace("/<br\W*?\/>/", "\n", $comment);
                              $comment = str_replace("br", "", $comment);
                              $comment = str_replace("< />", "", $comment);
                              echo nl2br($comment);*/





                              $modified = $data_com['modified'];
                              
                              foreach($datas_users as $data_mByUser){ 
                                  if($data_mByUser['id']==$data_com['modified_by']){
                                      $modified_byUser = $data_mByUser['login'];
                                  }
                              }

                          }
                      }
                  }



      //$path_vignette = $_SESSION['$DATASstoreFolder'].'/'.$data['ids_projects'].'_'.$datas_projects['project'].'/assets/'.$data['folder_name'].'/vignette_thumbnail.jpg';
      //
      $path_vignette = PATH_THUMB_HOME_A7.'/'.$data['ids_projects'].'_'.$datas_projects['project'].'/assets/'.$data['folder_name'].'/vignette_home.jpg';
/*echo $path_vignette;*/
      // D:\wamp\www\THEYARD\SHAMAN\_shamanDATAS_localhost\1_M2\assets\1_1_AVANT-DERNIER-TEST\

      // ../_DATAS_LOCALHOST/1_M2/assets/1_55_MIMI/vignette.jpg
      /*<img class='item-vignette data-vignette' src='ShotTracker_fichiers/drax.jpg' alt=''>*/
      $vignette = "<img class='item-vignette data-vignette' src='".$path_vignette."' style='width:192px;height:102px; alt=''>";
     //echo strlen($datas['vignette']);
     if (!file_exists($path_vignette)) {
            $vignette = "<img class='item-vignette data-vignette' src='images/vignette_default.jpg' style='width:192px;height:102px;' alt=''>";
             //echo  'NO';
      }


echo "<div class='mix ".$tags." mix_all' data-name='".$data['id']."'  class='item-spacer' style='margin: 0px 8px;' id='".$data['id']."'>";


/*echo "<a href='crud/assets_edit.php?id=".$data['id']."'><span class='clickable2'></span></a>";*/

echo "<div id='box_shadow' class='item box_shadow'>";


    echo "<div class='data-name'>".$data['name']."</div>";
echo "<a href='crud/assets_edit.php?id=".$data['id']."'>";
        echo $vignette;
echo "</a>";
        echo "<div class='tags-tasks'>";
            echo "<div style='position:relative; width:100%;' class='item-tag-holder'>";
            // Tags overlay
               /* echo "<div class='tagicon' data-tag='WARNING:HIGH' data-tagid='".$data['id']."' style='background-color:rgba(255,0,0,0.75);top:-105;'><i class='fa fa-exclamation-triangle'></i></div>";*/
            echo "</div>";

            echo "<div style='clear:both;'></div>";
            echo "<div class='data-commenttxt2' style='font-family: Arial;color:#222;background-color:#444444;width:100%;height:120px;max-height:120px;overflow:hidden;text-overflow: ellipsis;padding-left:3px;padding-right:3px;'/>".$comment."</div>";
            echo "<div class='item-lastupdate'>";
                echo "<div style='float:left; text-align:left;'>&nbsp;<span class='data-creationdate'>".$modified."</span></div>";
                echo "<div style='float:right; text-align:right;'><span class='data-comment_user'>".$modified_byUser."</span>&nbsp;</div>";  
            echo "</div>";

            echo "<div style='clear:both;'></div>";

        echo "<div>";


    echo "</div>";

    echo "</div>"; //?

echo "</div>";       
echo "</div>";


    }
}





?>

