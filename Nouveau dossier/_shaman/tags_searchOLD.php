
<div style="width:90%;padding:0px;color:white;">



<?php
//echo $_SESSION['prefs_user'];


$PRESELECTED_TAGS = '';


foreach($_SESSION['prefs_user'] as $data){ 

  //$id = 'tag_34'


  //echo $data;
  $PRESELECTED_TAGS = $PRESELECTED_TAGS.$data.',';

} 

$PRESELECTED_TAGS = substr($PRESELECTED_TAGS, 0, -1);
  //echo $PRESELECTED_TAGS;

//$PRESELECTED_TAGS = "{id: 'tag_34', text: 'CREVASSE_CHEMINEE'} , {id: 'tag_29', text: 'CREVASSE_TOILE_ARAIGNEE_POILUE'}";


?>
<select id="e1" class="form-control input-md select2 myTags" multiple id="e1">
 <?php
                                  if(!empty($tags_asc)){ 
                                      foreach($tags_asc as $data){ 
                                          if($data['active']=='1'){ 
                                              echo "<option value='tag_".$data['id']."'/>".$data['tag']."</option>";
                                              // <li class='filter' data-filter='".$data2['tag']."'>
                                           } 

                                      }
                                  }


                                  if(!empty($assets_asc)){ 
                                      foreach($assets_asc as $data){ 
                                          if($data['active']=='1'){ 
                                              echo "<option value='asset_".$data['id']."'/>".$data['name']."</option>";
                                              // <li class='filter' data-filter='".$data2['tag']."'>
                                           } 

                                      }
                                  }

?>
</select>
</div>




<script>
$(document).ready(function() { 

      
      //$container = $('#filter');
      //$container.mixItUp({});

      // $("#e1").select2({placeholder: "Tags"});

$("#e1").select2();
 var PRESELECTED_TAGS = [
              <?php
              echo $PRESELECTED_TAGS;
              ?>
];

$('#e1').select2({}).select2('data', PRESELECTED_TAGS);
var data = $('#e1').select2('data');


$("#e1").select2().on(function(e) {
          console.log("loaded (data property omitted for brevitiy)");
})







$("#e1").select2().on("change", function(e) {

        $('.mix').hide();
        var data = $('#e1').select2('data');
        if(data.length>0){

              var tags = [];
              var classes = '';
              for(var t in data){
                      var class_tag = '.'+data[t]['text'];
                      //$(data[t]['text']).show();
                      

                      // $(class_tag).show();


                      //var myVar = $("#start").find('.myClass').val();
                      var classes = classes+class_tag;


                      var chain = "{id: '"+data[t]['id']+"', text: '"+data[t]['text']+"'}";
                      tags.push(chain);
                      //console.log(chain);
              }

/*$('.MERCANTOUR.LOOKDEV').css( "border", "1px solid red" );*/
console.log(classes);
$(classes).css( "display", "block" );

                console.log(tags);

                $.ajax({  
                     url:"sessions.php",  
                     method:"POST",  
                     data:{ tags:tags},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                          console.log('sessions ok');
                     }  
                });  

        }
        else{


                $.ajax({  
                     url:"sessions.php",  
                     method:"POST",  
                     data:{ tags:''},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                          console.log('clear sessions ok');
                     }  
                });  

          $('.mix').show();

        }

 



        

      });

});
</script>


