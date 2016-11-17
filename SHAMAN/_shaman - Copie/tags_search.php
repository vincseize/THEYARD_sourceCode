
<div style="width:90%;padding:0px;border:none;">



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
<select id="e1" class="form-control input-md select2 myTags" multiple id="e1" style="width:90%;padding:0px;border:none;color:black;">
 <?php
                                  // tags
                                  if(!empty($tags_asc)){ 
                                      foreach($tags_asc as $data){ 
                                          if($data['active']=='1'){ 
                                              echo "<option value='tag_".$data['id']."'/>".$data['tag']."</option>";
                                              // <li class='filter' data-filter='".$data2['tag']."'>
                                           } 

                                      }
                                  }

                                  // assets
                                  if(!empty($assets_asc)){ 
                                      foreach($assets_asc as $data){ 
                                          if($data['active']=='1'){ 
                                              echo "<option value='asset_".$data['id']."'/>".$data['name']."</option>";
                                              // <li class='filter' data-filter='".$data2['tag']."'>
                                           } 

                                      }
                                  }

                                  // steps
                                  if(!empty($steps_pos_asc)){ 
                                      foreach($steps_pos_asc as $data){ 
                                          if($data['active']=='1'){ 
                                              echo "<option value='asset_".$data['id']."'/>".$data['step']."</option>";
                                              // <li class='filter' data-filter='".$data2['tag']."'>
                                           } 

                                      }
                                  }

?>
</select>
</div>

<style>

.select2-drop {
    /*display: none !important;*/
/*    opacity: 0.3;
    background: none;*/
    /*background-color: #555;*/
}

/*.select2-no-results {
    display: none !important;
}*/

</style>


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



var PRESELECTED_TAGS = [];
$('#e1').select2({}).select2('data', PRESELECTED_TAGS); // PRE REMPLISSAGE





//var data = $('#e1').select2('data');


//$("#e1").select2().trigger("change");
//$('#e1').select2().trigger('change.select2');
/*$('#e1').select2({
    data: function() { return {PRESELECTED_TAGS}; }
});*/
console.log(PRESELECTED_TAGS);
console.log(PRESELECTED_TAGS.length);
if(PRESELECTED_TAGS.length>0){
/*A(PRESELECTED_TAGS);*/

//$('.preselect').css("display", "none");

var class_tag = '';
              for(var t in PRESELECTED_TAGS){
                
                      var class_tag = '.'+PRESELECTED_TAGS[t]['text'];
                      console.log(class_tag);
                    }

        $(class_tag).css("border", "2px solid white");
}









$("#e1").select2().on("change", function(e) {






       
        var data = $('#e1').select2('data');

clearMix(data);


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





function clearMix(v) {
   //$('.mix').hide();
   $('.mix').css( "display", "none" );
    console.log('f a ok'+v);

    return;
}







</script>




<style>


.select2-search-choice {
    background-color: #56a600;
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f4f4f4', endColorstr='#eeeeee', GradientType=0 );
    background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, color-stop(20%, #f4f4f4), color-stop(50%, #f0f0f0), color-stop(52%, #e8e8e8), color-stop(100%, #eeeeee));
    background-image: -webkit-linear-gradient(top, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
    background-image: -moz-linear-gradient(top, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
    background-image: -o-linear-gradient(top, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
    background-image: -ms-linear-gradient(top, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
    background-image: linear-gradient(top, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
    -webkit-box-shadow: 0 0 2px #ffffff inset, 0 1px 0 rgba(0,0,0,0.05);
    -moz-box-shadow: 0 0 2px #ffffff inset, 0 1px 0 rgba(0,0,0,0.05);
    box-shadow: 0 0 2px #ffffff inset, 0 1px 0 rgba(0,0,0,0.05);
    color: #333;
    border: 1px solid #aaaaaa;
}



.select2 {
    background-color: #56a600;
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f4f4f4', endColorstr='#eeeeee', GradientType=0 );
    background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, color-stop(20%, #f4f4f4), color-stop(50%, #f0f0f0), color-stop(52%, #e8e8e8), color-stop(100%, #eeeeee));
    background-image: -webkit-linear-gradient(top, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
    background-image: -moz-linear-gradient(top, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
    background-image: -o-linear-gradient(top, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
    background-image: -ms-linear-gradient(top, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
    background-image: linear-gradient(top, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
    -webkit-box-shadow: 0 0 2px #ffffff inset, 0 1px 0 rgba(0,0,0,0.05);
    -moz-box-shadow: 0 0 2px #ffffff inset, 0 1px 0 rgba(0,0,0,0.05);
    box-shadow: 0 0 2px #ffffff inset, 0 1px 0 rgba(0,0,0,0.05);
    color: #333;
    border: 1px solid #aaaaaa;
}


</style>