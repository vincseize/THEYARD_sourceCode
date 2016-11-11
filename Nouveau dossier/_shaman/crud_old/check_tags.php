
<div id="tags_title" style="width: 100%;border-width:1px;border-color:#d3dded;border-style:solid;background-color: #d3dded;">

Tags
</div>

<?php
      foreach($datas_assets as $data3){ 
        if($data3['ids_projects']=="1"){ 

//echo $datas['ids_tags'];


                  $tags = ' ';
                  $ar_tags = explode(",", $datas['ids_tags']);
                  foreach($ar_tags as $t){ 
                            foreach($datas_tags as $data4){ 
                                if($t==$data4['id']){$tags = $tags . ' ' . $data4['tag'] ;}
                                }
                  }





        }
}
echo $tags;
?>
<hr>


Choose tag | Add tag <!-- <div id="#toggle_tags">+</div> -->



                           
<form name="monform" method="post">
                            
                    <?php
                          if(!empty($datas_tags)){ 
                              foreach($datas_tags as $data3){ 
                                  //echo "<option value='".$data3['id']."'>".$data3['tag']."</option>";
                                  echo "<input type='checkbox' name='choix[]'' value='".$data3['id']."'/>".$data3['tag']."<br />";
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



   <select name="langOpt[]" multiple id="langOpt">
                    <?php
                          if(!empty($datas_tags)){ 
                              foreach($datas_tags as $data3){ 
                                  //echo "<option value='".$data3['id']."'>".$data3['tag']."</option>";
                                  echo "<option value='".$data3['id']."'>".$data3['tag']."<br />";
                              }
                          }
                      ?>
<!--         <option value="php">PHP</option> -->

    </select>






<script type="text/javascript">
    $(document).ready(function() {
        
        $('#langOpt').multiselect({
            columns: 1,
            placeholder: 'Select Tags',
            search: true,
            selectAll: true
        });




$('#langOpt').click(function() {
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









<input type="submit" name="tags" value="valid"/>
</form>