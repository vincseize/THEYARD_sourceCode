

<script type="text/javascript" src="select2.min.js"></script>
  <link rel="stylesheet" href="select2.css">
  <link rel="stylesheet" href="select2-bootstrap.css">

<div id="tags_title" style="width: 100%;border-width:1px;border-color:#d3dded;border-style:solid;background-color: #d3dded;">

Tags
</div>
<br>





<div class="select2-wrapper" style='vertical-align:top;padding:0px;width:100%;'>
<!-- <div  style='vertical-align:top;background-color: red;padding:0px;'> -->

    <div style='display:inline-block;'>
        <!-- .select2-container-multi .select2-choices .select2-search-field input.select2-active -->
        <select class="form-control input-md select2 myTags" multiple id="e1" style="min-width:400px;padding:0px;">
                            <?php
                                  if(!empty($datas_tags)){ 
                                      foreach($datas_tags as $data3){ 
                                          if($data3['active']=='1'){ 
                                              echo "<option value='".$data3['id']."'/>".$data3['tag']."</option>";
                                              






                                           } 
                                      }
                                  }
                              ?>
            </select>
















        </div>  
        <div style='display:inline-block;'>
            
            <input type="hidden" name="id_asset" id="id_asset" value='<?php echo $_GET['id'];?>'>    
        </div>
    </div>


<!-- s -->




<?php


$ar_tags_steps = $datas['ids_tags_steps'];
$ar_tags_steps = explode("-", $ar_tags_steps);
$NEW_ar_tags_steps=array();

foreach($ar_tags_steps as $tags){ 
  $NEW_ar_tags_steps[] = $tags;
  }


$NEW_ar_tags_steps2=array();
foreach($NEW_ar_tags_steps as $tags){ 
  $ar_tag=array();
  $ar_steps=array();
  $id_tags = explode("[", $tags);
  $ar_tag[] = $id_tags[0]; 


  if(isset($id_tags[1])){  

    $tmp_steps = substr($id_tags[1], 0, -1);
    $tmp = explode(",", $tmp_steps);
    foreach($tmp as $step){ 

        $ar_steps[] = $step;
    }



  }



  $ar_tag[] = $ar_steps;
  $NEW_ar_tags_steps2[] = $ar_tag;
  }





$result = '';


foreach ($NEW_ar_tags_steps2 as $key => $val) {




$datas_getTags  = $db->getRows('tags',array('where'=>array('id'=>$val[0]),'return_type'=>'single'));




            $result = $result."{id:".$val[0].",text:'".$datas_getTags['tag']." <select>";
           if (isset($val[1]) and sizeof($val[1])>0) {


                        foreach ($val[1] as $key1 => $val1) {
$datas_getSteps  = $db->getRows('steps',array('where'=>array('id'=>$val1),'return_type'=>'single'));
                                       $result = $result."<option>".$datas_getSteps['step']." ".$datas_getSteps['color']."</option>";
                        }



           }else{
            $result = $result."<option></option><option>steps defaults ,2,3 ...</option>";
           }


            $result = $result."</select>'},";

   }

?>


















<script type="text/javascript">

$(document).ready(function() {




          $("#e1").select2();

var PRESELECTED_TAGS = [


<?php



echo $result;



?>



];

$('#e1').select2({}).select2('data', PRESELECTED_TAGS);






          $("#checkbox").click(function(){
              if($("#checkbox").is(':checked') ){
                  $("#e1 > option").prop("selected","selected");
                  $("#e1").trigger("change");
              }else{
                  $("#e1 > option").removeAttr("selected");
                   $("#e1").trigger("change");
               }
          });

          $("#button").click(function(){
                //alert($("#e1").val());
                // alert($("#e1").val())[0];
                var id_asset = $('#id_asset').val();
                var array_tags = $("#e1").val(); 
                var ids_tags = '';
                //alert(array_tags);
                if (array_tags != null) {  
                    array_tags.forEach( function(s) { 
                      ids_tags = ids_tags + s + ',';
                         //alert(s);
                    } );
                }
                
                $.ajax({  
                     url:"save_tags.php",  
                     method:"POST",  
                     data:{ids_tags:ids_tags, id:id_asset},  
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









          });





    });
</script>