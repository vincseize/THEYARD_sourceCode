<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}


?>





<?php include('head.php'); ?>

<style>

tr:hover{
        background-color:#555;
    }


<style>
    [contenteditable="true"].single-line {
        white-space: nowrap;
        width:200px;
        overflow: hidden;
    } 
    [contenteditable="true"].single-line br {
        display:none;

    }
    [contenteditable="true"].single-line * {
        display:inline;
        white-space:nowrap;
    }
</style>

</style>


<!-- <script src="http://code.jquery.com/jquery-1.10.2.js"></script> -->
    <script>
    function showEdit(editableObj) {
      $(editableObj).css("background","#555");
      $(editableObj).css("table-layout","fixed");
    } 
    
    function saveToDatabaseTag(editableObj,column,id) {$(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
      $.ajax({
        url: "_tag_edit.php",
        type: "POST",
        data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
        success: function(data){
          $(editableObj).css("background","#555");
        }        
       });
    }

    function saveToDatabaseTag_color(color,id) {
      $.ajax({
        url: "_tag_edit.php",
        type: "POST",
        data:'column=color&editval='+color+'&id='+id,
        success: function(data){

        }        
       });
    }

    function addToDatabaseTag(editableObj) {
      $(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
      $.ajax({
        url: "_tag_add.php",
        type: "POST",
        data:'column=tag&editval='+editableObj.innerHTML,
        success: function(data){
            $(editableObj).css("background","#555");
        }        
       });
    }





    function saveToDatabaseStep(editableObj,column,id) {$(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
      $.ajax({
        url: "_step_edit.php",
        type: "POST",
        data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
        success: function(data){
          $(editableObj).css("background","#555");
        }        
       });
    }

    function saveToDatabaseStep_color(color,id) {
      $.ajax({
        url: "_step_edit.php",
        type: "POST",
        data:'column=color&editval='+color+'&id='+id,
        success: function(data){

        }        
       });
    }

    function addToDatabaseStep(editableObj) {
      $(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
      $.ajax({
        url: "_step_add.php",
        type: "POST",
        data:'column=step&editval='+editableObj.innerHTML,
        success: function(data){
            $(editableObj).css("background","#555");
        }        
       });
    }














    </script>
<script src="../js/jscolor.js"></script>

<body>





<div class="header">
<?php 

include('menu_top_settings.php'); 


?>
</div>







<div id="content-item" class="content-item after-box"  style="padding-top:70px;">


 <?php 

include('back_ui.php'); 


?>

<!--     <div class='item add-item box_shadow box'>
            <div class='data-name'>add Check relation wip</div>
            <div style='position:absolute; top:110px; left:90px; text-align:center; color:white;'>
            <a href='index.php'  id='index' name='index'>
              <span class='glyphicon glyphicon-cog'></span> 
              </a>
            </div>
    </div>   


 -->


    <div class='item add-item box_shadow box' style='width:850px;height:800px;padding-left:15px;padding-right:15px;'>

            <table class="tbl-qa" style="table-layout:fixed;width:100%;">
              <thead>
                <tr  class='data-name'>
                <th class="table-header" width="10%">Pos.</th>
                <th class="table-header" width="70%">Tag</th>
                <th class="table-header" width="50px">Color</th>
                </tr>
              </thead>
              <tbody>
              <tr class="table-row"><td>&nbsp;</td><td></td><td></td></tr>
              <?php
              foreach($tags as $k=>$v) { if($tags[$k]["active"]==1){

              ?>
                <tr class="table-row" style='width:10px;min-width:10px;'>
                <td>
                <?php 
                //echo $k+1; 
                ?>
                </td>
                <td style='color:white;' class="single-line" contenteditable="true" onBlur="saveToDatabaseTag(this,'tag','<?php echo $tags[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $tags[$k]["tag"]; ?></td>

                <td style='width:10px;min-width:10px;' >
<input onChange="saveToDatabaseTag_color(this.value,'<?php echo $tags[$k]["id"]; ?>')" class="jscolor" value="<?php echo $tags[$k]["color"]; ?>" style='width:65px;border:none;'> 
                </td>




                </tr>
            <?php
            }}
            ?>



<tr class="table-row" style='width:10px;min-width:10px;'>
                <td>new</td>
                <td style='color:white;' class="single-line" contenteditable="true" onBlur="addToDatabaseTag(this)" onClick="showEdit(this);"></td>

 <td style='width:10px;min-width:10px;' >
<input value="" style='width:65px;border:none;'> 
                </td>





                </tr>







              </tbody>
            </table>     

    </div>   














    <div class='item add-item box_shadow box' style='width:550px;height:800px;padding-left:15px;padding-right:15px;'>

            <table class="tbl-qa" style="table-layout:fixed;width:100%;">
              <thead>
                <tr  class='data-name'>
                <th class="table-header" width="10%">Pos.</th>
                <th class="table-header" width="70%">Step</th>
                <th class="table-header" width="50px">Color</th>
                </tr>
              </thead>
              <tbody>
              <tr class="table-row"><td>&nbsp;</td><td></td><td></td></tr>
              <?php
              foreach($steps_pos_asc as $k=>$v) { if($steps_pos_asc[$k]["active"]==1){

              ?>
                <tr class="table-row" style='width:10px;min-width:10px;'>
                <td>
                <?php 
                //echo $k+1; 
                ?>
                </td>
                <td style='color:white;' class="single-line" contenteditable="true" onBlur="saveToDatabaseStep(this,'step','<?php echo $steps_pos_asc[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $steps_pos_asc[$k]["step"]; ?></td>

                <td style='width:10px;min-width:10px;' >
<input onChange="saveToDatabaseStep_color(this.value,'<?php echo $steps_pos_asc[$k]["id"]; ?>')" class="jscolor" value="<?php echo $steps_pos_asc[$k]["color"]; ?>" style='width:65px;border:none;'> 
                </td>




                </tr>
            <?php
            }}
            ?>



<tr class="table-row" style='width:10px;min-width:10px;'>
                <td>new</td>
                <td style='color:white;' class="single-line" contenteditable="true" onBlur="addToDatabaseStep(this)" onClick="showEdit(this);"></td>

 <td style='width:10px;min-width:10px;' >
<input value="" style='width:65px;border:none;'> 
                </td>





                </tr>







              </tbody>
            </table>     

    </div>   































</div>




  <script>
  function setTextColor(picker) {
    document.getElementsByTagName('body')[0].style.color = '#' + picker.toString()
  }
  </script>






</body>