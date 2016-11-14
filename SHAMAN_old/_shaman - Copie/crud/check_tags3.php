


<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery-ui.min.js"></script>
<script type="text/javascript" src="select2.min.js"></script>
<script type="text/javascript" src="placeholders.js"></script>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="select2.css">
  <link rel="stylesheet" href="select2-bootstrap.css">



    <div class="select2-wrapper">

<!-- .select2-container-multi .select2-choices .select2-search-field input.select2-active -->
<select class="form-control input-md select2" multiple id="e1" style="width:300px">
        <option value="AL">Alabama</option>
        <option value="Am">Amalapuram</option>
        <option value="An">Anakapalli</option>
        <option value="Ak">Akkayapalem</option>
        <option value="WY">Wyoming</option>
    </select>
<input type="checkbox" id="checkbox" >Select All

<input type="button" id="button" value="check Selected">

</div>



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
                 alert($("#e1").val());
          });





    });
</script>