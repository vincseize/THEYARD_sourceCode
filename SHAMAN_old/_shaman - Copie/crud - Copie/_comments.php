<?php

$datas_getComments  = $db->getRows('comments',array('where'=>array('id_asset'=>$datas['id']),'return_type'=>'single'));
$style_comments = " style='display:none;'";
if(count($datas_getComments)>1){
    $style_comments = " ";
    
}


     







                  $i = 0;
                  foreach($datas_comments as $data5){ 
                      if($data5['id_asset']==$datas['id']){
                                foreach($datas_users as $data6){ 
                                    if($data6['id']==$data5['id_creator']){
                                        $i++;
                                        // $bg_color = $i % 2 === 0 ? "#cccccc" : "#eeeeee";
                                        $bg_color = $i % 2 === 0 ? "#9E9E9E" : "#9E9E9E";


echo " <div id='div_comment_".$data5['id']."'' style='background-color: ". $bg_color .";padding-left:0px;'>";
    include('_comment.php');   
    //echo "<br>";
echo " </div>";


                                    }
                                }
                      }
                  }  

?>




