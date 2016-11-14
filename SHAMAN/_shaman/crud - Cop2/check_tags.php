

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

<!--         <input type="checkbox" id="checkbox" >Select All | -->

<br>
         <input type="button" id="button" value="valid">


<!-- 
<hr>
<input type="text" id="add_tag" > Add Tag wip -->


<!-- </div>
 -->


<script type="text/javascript">

$(document).ready(function() {




          $("#e1").select2();

var PRESELECTED_TAGS = [
/*    { id: 'f1', text: 'Apple' },
    { id: 'f2', text: 'Mango' },
    { id: 'f3', text: 'Orange' },*/

<?php


foreach($datas_assets as $data3){ 
        if($data3['ids_projects']=="1"){ 

//echo $datas['ids_tags'];


                  $tags = ' ';
                  $ar_tags = explode(",", $datas['ids_tags']);
                  foreach($ar_tags as $t){ 
                            foreach($datas_tags as $data4){ 
                                if($t==$data4['id'] and $data4['active']==1){

                                  $tags = $tags . ' ' . $data4['tag'] ;
                                  echo "{ id: '".$data4['id']."', text: '".$data4['tag']."' },";

                                }
                                }
                  }





        }
}












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