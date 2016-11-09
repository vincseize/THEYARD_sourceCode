

<script type="text/javascript" src="select2.min.js"></script>
  <link rel="stylesheet" href="select2.css">
  <link rel="stylesheet" href="select2-bootstrap.css">


<style>
/*.select2-choice { background-color: #262626 !important; }
 .select2-results { background-color: #262626 !important;  }
  .select2-container { background-color: #262626 !important;  }




.select2-container,
.select2-drop,
.select2-search,
.select2-search input { background-color: #cccccc !important; }





select option[val="1"]{
    background: rgba(100,100,100,0.3);



    
}





.select2-container--default .select2-selection--single{
    padding:6px;
    height: 37px;
    width: 148px; 
    font-size: 1.2em;  
    position: relative;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    background-image: -khtml-gradient(linear, left top, left bottom, from(#424242), to(#030303));
    background-image: -moz-linear-gradient(top, #424242, #030303);
    background-image: -ms-linear-gradient(top, #424242, #030303);
    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #424242), color-stop(100%, #030303));
    background-image: -webkit-linear-gradient(top, #424242, #030303);
    background-image: -o-linear-gradient(top, #424242, #030303);
    background-image: linear-gradient(#424242, #030303);
    width: 40px;
    color: #fff;
    font-size: 1.3em;
    padding: 4px 12px;
    height: 27px;
    position: absolute;
    top: 0px;
    right: 0px;
    width: 20px;
}



*/



.select2-search { background-color: #00f; }
.select2-search input { background-color: #ccc; }
.select2-results { background-color: #ccc; }
.select2-choice { background-color: #00f !important; }

.active2 {
    background: #000 !important;
}


</style>


<div style="background-color: #303030;width:100%;color:#A9A9A9;">








<div id="tags_title" style="width: 100%;border-width:1px;border-color:#262626;border-style:solid;background-color: #262626;">

Tags
</div>
<br>





<div class="select2-wrapper" style='vertical-align:top;padding:0px;width:100%;background-color:#262626;'>
<!-- <div  style='vertical-align:top;background-color: red;padding:0px;'> -->

    <div style='display:inline-block;background-color:#262626;width:100%;'>
        <!-- .select2-container-multi .select2-choices .select2-search-field input.select2-active -->
        <select class="form-control input-md select2 myTags" multiple id="e1" style="width:100%;padding:0px;background-color: #262626;">
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


/*echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";

*/
/*print_r($NEW_ar_tags_steps2);

*/


$result = '';

$datas_getasset  = $db->getRows('assets',array('where'=>array('id'=>$_GET['id']),'return_type'=>'single'));
$datas_getasset_id_steps = $datas_getasset['ids_tags_steps'];
$tmp = explode("-", $datas_getasset_id_steps);
          // get id MODELING
          // get id LOOKDEV
foreach ($tmp as $key => $val) {
                  // include
                if (strpos($val, '[') !== false) {
                  $id = explode("[", $val);
                   //echo $val;
                  if ($id[0] == '9'){$id_step_getMODELING = substr($id[1], 0, -1);} // id MODELING == val
                  if ($id[0] == '10'){$id_step_getLOOKDEV = substr($id[1], 0, -1);} // id LOOKDEV == val
                }
}

/* echo $id_step_getMODELING;
 echo "<br>";
  echo $id_step_getMODELING;



*/





foreach ($NEW_ar_tags_steps2 as $key => $val) {




          $datas_getTags  = $db->getRows('tags',array('where'=>array('id'=>$val[0]),'return_type'=>'single'));






          $result = $result."{id:".$val[0].",text:'".$datas_getTags['tag']." ";
/*                    if (isset($val[1]) and sizeof($val[1])>0) {


                                  foreach ($val[1] as $key1 => $val1) {
                                                  $datas_getSteps  = $db->getRows('steps',array('where'=>array('id'=>$val1),'return_type'=>'single'));
                                                  $result = $result."<option>".$datas_getTags['id']."[".$datas_getSteps['id']."] ".$datas_getSteps['step']." ".$datas_getSteps['color']."</option>";
                                  }



                    }else{
                        $result = $result."<option></option><option>steps defaults ,2,3 ...</option>";
                    }*/




  if($datas_getTags['tag']=='MODELING' or $datas_getTags['tag']=='LOOKDEV'){
    
    //$sel = substr($datas_getTags['id'], 2,1);
      $datas_ts  = $db->getRows('assets',array('where'=>array('id'=>$_GET['id']),'return_type'=>'single'));
      $ts = $datas_ts['ids_tags_steps'];
    
      if($datas_getTags['tag']=='MODELING'){
                $result = $result."<select>";
                foreach ($steps_pos_asc as $keyS => $step) {
                    $selected_step = "";
                    if($step['id']== $id_step_getMODELING){$selected_step = ' selected';}
                    // if($step['id']== '6'){$selected_step = ' selected';}
                    $result = $result."<option ".$selected_step.">".$datas_getTags['id']."[".$step['id']."] ".$step['step']." ".$step['color']."</option>";
                }
                $result = $result."</select>";
      }


      if($datas_getTags['tag']=='LOOKDEV'){

                $result = $result."<select>";
                foreach ($steps_pos_asc as $keyS => $step) {
                    $selected_step = "";
                    if($step['id']== $id_step_getLOOKDEV){$selected_step = ' selected';}
                    // if($step['id']== '6'){$selected_step = ' selected';}
                    $result = $result."<option ".$selected_step.">".$datas_getTags['id']."[".$step['id']."] ".$step['step']." ".$step['color']."</option>";
                }
                $result = $result."</select>";
      }


}






          $result = $result."'},";

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


///////////////////////////////////////////

   $('b[role="presentation"]').hide();
$('.select2-selection__arrow').append('<i class="fa fa-angle-down"></i>');


});








// update_tags
$(function() {

/*        function log(text) {
          $('#logs').append(text + '<br>');
        }*/

        $("select").each(function(){
                $(this).change(function(e) {
 var n = ($(this).val()).includes("[");
 if(n==false){



                    var ids_tags_ar = $(this).val();
                    

                       
ids_tagsT = '';
for(var st in ids_tags_ar){
    ids_tagsT = ids_tagsT + ',' + ids_tags_ar[st];
}
ids_tagsT = ids_tagsT.slice(1);

id_asset = <?php echo $_GET['id'];?>;
console.log(id_asset);
console.log(ids_tagsT);

                      var type_edit = 'update_tags';
                              $.ajax({  
                                   url:"save_tags.php",  
                                   method:"POST",  
                                   data:{ids_tags:ids_tagsT, id:id_asset, type_edit:type_edit},  
                                   dataType:"text",  
                                   success:function(data)  
                                   {  
                                        console.log(type_edit+' ok');
                                   }  
                              }); 



}





                });



            });



    });








// update_selects
$(function() {
    $("select").each(function(){
                    var ids_tags = '';

                    $(this).change(function(e) {
                                $("select").each(function(){
                                    var n = ($(this).val()).includes("[");
                                    if(n==false){
                                      ids_tags = $(this).val();
                                      }
                                });

                                var tmp = ($(this).val()).split(" ");
                                var ids_mod = tmp[0];
                                var result = ids_tags + ',' + ids_mod;

                                //log($(this).val());
                                //log(result);
                                var tmp = (result).split(",");

                                var ids_ref = '';


                                for(var t in tmp){
                                      var n = tmp[t].includes("]");
                                      if(n==true){
                                        var res = (tmp[t]).split("[");
                                        ids_ref=res[0];
                                      }
                                      




                                }

                                //log(ids_ref);

                                ids_tags_steps2 = '';
                                for(var t in tmp){
                                      if(tmp[t]!=ids_ref){
                                          ids_tags_steps2 = tmp[t] + '-' + ids_tags_steps2;
                                      }

                                }

                                ids_tags_steps2 = ids_tags_steps2.slice(0, -1);

                                // ids_tags_steps2 = ids_tags_steps2+$(this).val();


                                ids_tags_string = '';
                                for(var t in ids_tags){
                                      ids_tags_string = ids_tags[t] + ',' + ids_tags_string;
                                }

                                ids_tags_string = ids_tags_string.slice(0, -1);
                                id_asset = <?php echo $_GET['id'];?>;

                                var type_edit = 'update_selects';

/*                                log(id_asset);
                                log(ids_tags_string);
                                log(ids_tags_steps2);
                                log(type_edit);*/
                                console.log(id_asset);
                                console.log(ids_tags_string);
                                console.log(ids_tags_steps2);



                                $.ajax({  
                                     url:"save_tags_select.php",  
                                     method:"POST",  
                                     data:{ids_tags:ids_tags_string, ids_tags_steps:ids_tags_steps2, id:id_asset, type_edit:type_edit},  
                                     dataType:"text",  
                                     success:function(data)  
                                     {  
                                        console.log(type_edit+' ok');
                                     }  
                                });


                        });



    });




/*


.on("select2-selecting", function(e) {
          log("selecting val=" + e.val + " choice=" + e.object.text);
})

*/










function parse_tags(text) {
                    var tmp = ($(this).val()).split(" ");
                    var ids_mod = tmp[0];
                    var result = ids_tags + ',' + ids_mod;

                    //log($(this).val());
                    //log(result);
                    var tmp = (result).split(",");

                    var ids_ref = '';


                    for(var t in tmp){
                          var n = tmp[t].includes("]");
                          if(n==true){
                            var res = (tmp[t]).split("[");
                            ids_ref=res[0];
                          }
                          
                    }

                    //log(ids_ref);

                    ids_tags_steps = '';
                    for(var t in tmp){
                          if(tmp[t]!=ids_ref){
                              ids_tags_steps = tmp[t] + '-' + ids_tags_steps;
                          }

                    }

                    ids_tags_steps = ids_tags_steps.slice(0, -1);




                    ids_tags_string = '';
                    for(var t in ids_tags){
                          ids_tags_string = ids_tags[t] + ',' + ids_tags_string;
                    }
                    ids_tags_string = ids_tags_string.slice(0, -1);



                    id_asset = <?php echo $_GET['id'];?>;

                    log(id_asset);
                    log(ids_tags_string);
                    log(ids_tags_steps);
}


function parse_steps(text) {
    $('#logs').append(text + '<br>');
}



function log(text) {
    $('#logs').append(text + '<br>');
}








});


































/*




.on("change", function(e) {
          // mostly used event, fired to the original element when the value changes
          log("change val=" + e.val);
        })
        .on("select2-opening", function() {
          log("opening");
        })
        .on("select2-open", function() {
          // fired to the original element when the dropdown opens
          log("open");
        })
        .on("select2-close", function() {
          // fired to the original element when the dropdown closes
          log("close");
        })
        .on("select2-highlight", function(e) {
          log("highlighted val=" + e.val + " choice=" + e.choice.text);
        })
        .on("select2-selecting", function(e) {
          log("selecting val=" + e.val + " choice=" + e.object.text);
        })
        .on("select2-removed", function(e) {
          log("removed val=" + e.val + " choice=" + e.choice.text);
        })
        .on("select2-loaded", function(e) {
          log("loaded (data property omitted for brevitiy)");
        })
        .on("select2-focus", function(e) {
          log("focus");
        });
















*/









</script>





<!-- <div class="well" id="logs"></div> -->