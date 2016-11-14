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

//$saltz =  uniqid(mt_rand(), true);


foreach($assets_modified as $data){ 
        if($data['active']=="1"){ 





                  $tags = ' ';
                  $tags = $tags . ' ' . $data['name'] ;
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
                           
                              $comment = html_entity_decode($data_com['comments']);






                              $modified = $data_com['modified'];
                              
                              foreach($datas_users as $data_mByUser){ 
                                  if($data_mByUser['id']==$data_com['modified_by']){
                                      $modified_byUser = $data_mByUser['login'];
                                  }
                              }

                          }
                      }
                  }




      
      $path_vignette = PATH_THUMB_HOME_A7.'/'.$data['ids_projects'].'_'.$datas_projects['project'].'/assets/'.$data['folder_name'].'/vignette_home.jpg';

      $vignette = "<img class='item-vignette data-vignette' src='".$path_vignette."' style='width:".W_THUMB_HOME."px;height:".H_THUMB_HOME."px; alt=''>";

     if (!file_exists($path_vignette)) {
            $vignette = "<img class='item-vignette data-vignette' src='images/vignette_default.jpg' style='width:".W_THUMB_HOME."px;height:".H_THUMB_HOME."px;' alt=''>";
        
      }



echo "<div class='mix ".$tags." mix_all' data-name='".$data['id']."'  class='item-spacer' style='margin: 0px 8px;' id='".$data['id']."'>";




echo "<div id='box_shadow' class='item box_shadow'>";


    echo "<div class='data-name' style='font-size:0.7em;padding-top:2px;'>".$data['name']."</div>";

/*echo "<a href='crud/assets_edit.php?id=".$data['id']."'>";*/
echo "<a href='#' class='a_editA7' a_id_asset='".$data['id']."' a_name_asset='".$data['name']."'>";
        echo $vignette;
echo "</a>";
        echo "<div class='tags-tasks'>";
            echo "<div style='position:relative; width:100%;' class='item-tag-holder'>";

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

