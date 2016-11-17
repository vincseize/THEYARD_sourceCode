


<!-- <script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery-ui.min.js"></script> -->
<script type="text/javascript" src="select2.min.js"></script>
<!-- <script type="text/javascript" src="placeholders.js"></script>
  <link rel="stylesheet" href="bootstrap.min.css"> -->
  <link rel="stylesheet" href="select2.css">
  <link rel="stylesheet" href="select2-bootstrap.css">


<div id="tags_title" style="width: 100%;border-width:1px;border-color:#d3dded;border-style:solid;background-color: #d3dded;">
Add Tag wip
</div>
<hr>
<div class="select2-wrapper" style='vertical-align:top;padding:0px;'>
<!-- <div  style='vertical-align:top;background-color: red;padding:0px;'> -->

    <div style='display:inline-block;'>
        <!-- .select2-container-multi .select2-choices .select2-search-field input.select2-active -->
        <select class="form-control input-md select2" multiple id="e1" style="width:300px;padding:0px;">
        <!--         <option value="AL">Alabama</option>
                <option value="Am">Amalapuram</option>
                <option value="An">Anakapalli</option>
                <option value="Ak">Akkayapalem</option>
                <option value="WY">Wyoming</option> -->
                            <?php
                                  if(!empty($datas_tags)){ 
                                      foreach($datas_tags as $data3){ 
                                          //echo "<option value='".$data3['id']."'>".$data3['tag']."</option>";
                                          echo "<option value='".$data3['id']."'/>".$data3['tag']."</option>";
                                      }
                                  }
                              ?>
            </select>
        </div>  
        <div style='display:inline-block;'>
            <input type="button" id="button" value="valid">
            <input type="hidden" name="id_asset" id="id_asset" value='<?php echo $_GET['id'];?>'>    
        </div>
    </div>

        <input type="checkbox" id="checkbox" >Select All



<!-- </div>
 -->


<script type="text/javascript">

$(document).ready(function() {




          $("#e1").select2();
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
                array_tags.forEach( function(s) { 
                  ids_tags = ids_tags + s + ',';
                     //alert(s);
                } );
                // alert(ids_tags);
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