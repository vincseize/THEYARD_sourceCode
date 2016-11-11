<?php

foreach($datas_assets as $data){ 
        if($data['ids_projects']=="1"){ 


                  $datas_projects     = $db->getRows('projects',array('where'=>array('id'=>$data['ids_projects']),'return_type'=>'single'));


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
                  foreach($datas_comments_asc as $data_com){ 
                          if($data_com['id_asset']==$data['id']){
                                $comment = $data_com['comments'];
                                $modified = $data_com['modified'];

                                // echo $comment.$data['name'];

                                  foreach($datas_users as $data_mByUser){ 
                                      if($data_mByUser['id']==$data_com['modified_by']){
                                          $modified_byUser = $data_mByUser['login'];
                                      }
                                  }





                        }
                  }


/*                  $path_vignette = $_SESSION['$DATASstoreFolder']."/M2/assets/".$data['ids_projects']."/vignette.jpg";
                  $vignette = "<img src='".$path_vignette."' style='width:320px;height:120px;' alt=''>";
                  //echo strlen($data['vignette']);
                  if (strlen($data['vignette'])==0){
                    $vignette = "<img src='images/vignette_default.jpg' style='width:320px;height:120px;' alt=''>";
                  }

*/
      $path_vignette = "../".$_SESSION['$DATASstoreFolder'].'/'.$data['ids_projects'].'_'.$datas_projects['project'].'/assets/'.$data['folder_name'].'/vignette_thumbnail.jpg';

      // ../_DATAS_LOCALHOST/1_M2/assets/1_55_MIMI/vignette.jpg
      $vignette = "<img src='".$path_vignette."' style='width:320px;height:120px;' alt=''>";
     //echo strlen($datas['vignette']);
     if (!file_exists($path_vignette)) {
            $vignette = "<img src='images/vignette_default.jpg' style='width:500px;height:300px;' alt=''>";
             //echo  'NO';
      }

      //echo  $path_vignette;

                  
echo "<div style='background-color:#444444  ;margin:0px;'>";
                  echo "<li class='mix ".$tags." mix_all' data-name='".$data['id']."' style='display: inline-block;  opacity: 1;margin:0px;'>";


/*                        echo "<a href='crud/assets_edit.php?id=".$data['id']."' rel='modal:open' data-id='".$data['id']."' class='thumbnail' id='".$data['id']."' style='background-color:#444444  ;color:gray;margin:0px;border:1px;text-decoration: none;'>";*/


                        echo "<a href='crud/assets_edit.php?id=".$data['id']."' class='thumbnail' id='".$data['id']."' style='background-color:#444444  ;color:gray;margin:0px;border:1px;text-decoration: none;'>";


                        echo "<h4 style='background-color:black;color:#CACACA;margin:0px;text-decoration: none;'>".$data['name']."</h4>";              
                        //echo "<img src='".array_pop($images)."' style='width:320px;height:120px;' alt=''>";
                        echo $vignette;
      /*                  echo "<p>&nbsp;</p>";*/
                        echo "</a>";
                        echo "<div style='background-color:gray;color:black;width:100%;height:60px;max-height:60px;display: block;margin:0px;border: none;font-size:0.8em;overflow:hidden;text-overflow: ellipsis;'/>".$comment."</div>";

                        echo "<p style='background-color:#444444;color:#CACACA;font-size:0.8em;margin:0px;'>".$modified_byUser." | ".$modified."</p>";

                  echo "</li>";
echo "</div>";


          }
      }

?>