
<div id="steps_title" style="width: 100%;border-width:1px;border-color:#d3dded;border-style:solid;background-color: #d3dded;">

Types
</div>

<?php
      foreach($datas_assets as $data3){ 
        if($data3['ids_projects']=="1"){ 

//echo $datas['ids_steps'];


                  $steps = ' ';
                  $ar_steps = explode(",", $datas['ids_steps']);
                  foreach($ar_steps as $t){ 
                            foreach($datas_steps as $data4){ 
                                if($t==$data4['id']){$steps = $steps . ' ' . $data4['step'] ;}
                                }
                  }





        }
}
echo $steps;
?>
<hr>


Choose types<!-- <div id="#toggle_steps">+</div> -->



<form name="monform_step" method="post">
                            
                    <?php
                          if(!empty($datas_steps)){ 
                              foreach($datas_steps as $data3){ 
                                  //echo "<option value='".$data3['id']."'>".$data3['step']."</option>";
                                  echo "<input type='checkbox' name='choix[]'' value='".$data3['id']."'/>".$data3['step']."<br />";
                              }
                          }
                      ?>



<!-- 
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
-->

  <script src="jquery.multiselect_AssetEdit.js"></script>
  <link rel="stylesheet" href="jquery.multiselect_AssetEdit.css">



   <select name="langOpt_step[]" multiple id="langOpt_step">
                    <?php
                          if(!empty($datas_steps)){ 
                              foreach($datas_steps as $data3){ 
                                  //echo "<option value='".$data3['id']."'>".$data3['step']."</option>";
                                  echo "<option value='".$data3['id']."'>".$data3['step']."<br />";
                              }
                          }
                      ?>
<!--         <option value="php">PHP</option> -->

    </select>






<script type="text/javascript">
    $(document).ready(function() {
        
        $('#langOpt_step').multiselect({
            columns: 1,
            placeholder: 'Select Steps',
            search: true,
            selectAll: true
        });




$('#langOpt_step').click(function() {
    var checked = $(this).is(':checked');

alert(checked);

/*
    $.ajax({
        type: "POST",
        url: myUrl,
        data: { checked : checked },
        success: function(data) {
            alert('it worked');
        },
        error: function() {
            alert('it broke');
        },
        complete: function() {
            alert('it completed');
        }
    });*/
});







    });
</script>









<input type="submit" name="steps" value="valid"/>
</form>