<?php
session_start();
if(!isset($_SESSION['user_session'])){header("Location: logout.php");}
// require '../inc/dbconfig.php';
require '../inc/crud.php';
$tbl = strtolower(substr($tblName,0,-1));

$datas_projects      = $projects;
$datas_tags          = $tags;
$datas_assets        = $assets;
$datas_users         = $users;
$datas_comments      = $comments;
$datas_comments_asc  = $comments_asc;

/*require '../inc/DB.php';
$db = new DB();*/
//$users        = $db->getRows('users',array('where'=>'id=:uid'));


/*$stmt = $db_con->prepare("SELECT * FROM users WHERE id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

*/
$title_user = "Hi' ".$_SESSION['login']." [ ".$_SESSION['status']." ]";

//echo $_SESSION['is_root'];

?>

<!DOCTYPE html>
<html lang="fr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta http-equiv="Expires" content="0"/>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="author" content="The Yard - Vincseize">
  <meta name="description" content="Shaman">
  <meta name="keywords" content="Shaman">
  <meta name="viewport" content="width=device-width, initial-scale=0.7">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-transparent">
  <title>SHAMAN</title>






<?php include('libs.php');?>


<link rel="stylesheet" href="select2.css">
  <link rel="stylesheet" href="select2-bootstrap.css"> 



<style type="text/css">
  body
{
/*margin-left: 80px;*/

}


/* unvisited link */
a:link {
    text-decoration: none;
}

/* visited link */
a:visited {
    text-decoration: none;
}

/* mouse over link */
a:hover {
    text-decoration: none;
}

/* selected link */
a:active {
    text-decoration: none;
}





</style>








</head>

<body>

<div id="top">
<?php 
include('menu_top.php');
?>
</div>	
<div id="top_edit" style="display:none;">
<?php 
include('crud/menu_top_edit.php');









?>
</div>  


<br>
  
<iframe  name="iframe_editA7" id="iframe_editA7" style="padding-top:0px;width:100%;height:100%;border:0px;position: fixed;display:none;">

</iframe >

<!-- 
<font color=white>


<a href="crud/asset_edit.php?id=113" target="iframe_editA7" class='editA7'>Link iframe2</a> 






</font>


 -->















<div id="content-item" class="content-item"  style="padding-top:50px;">





















               <div class='pattern' id="recipes">
                  <ul class="g" >
                  <font color=white>

                  <?php
                      if(!empty($datas_assets)){ 
                          include('assets_ui.php');
                     }
                      if($_SESSION['id_status_user']=='2'){
                          include('asset_add_ui.php');
                      }
                  ?>


                  </font>

                  </ul>
              </div>








              <div class="dropdown bootstrapMenu" style="z-index: 10000; position: absolute; display: none; height: 69px; width: 158px; top: 169.004px; left: 985px;">
              <ul class="dropdown-menu" style="position:static;display:block;font-size:0.9em;">
              </div>

</div>









</div>
















<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
<script src="js/bootstrap.min.js"></script>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="bootstrap-checkbox.min.js"></script>
<script src="jquery.multiselect.js"></script>
<script src="jquery.modal.js" type="text/javascript" charset="utf-8"></script>

<!-- <script src="Bootstrap%203%20Portfolio%20Mixitup_fichiers/jquery_002.js"></script> -->
<script src="Bootstrap%203%20Portfolio%20Mixitup_fichiers/jquery.js"></script>





<script type="text/javascript" src="crud/select2.min.js"></script>







<!-- <li class='filter' data-filter='".$data2['tag']."'><a href='#''>".$data2['tag']."</a></li> -->







<script type="text/javascript">
$(document).ready(function(){

    $(function () {

        $('#iframe_editA7').hide();
        $('#top_edit').hide();

       // Filters
        $('#recipes').mixitup();     

        // add
        $('#trigger_todo').click(function(e){
             e.preventDefault();
            $("#container-fluid").load("todo.php");
          });

        //var select_id_project = document.getElementById("select_projects").value;
        //alert(select_id_project);
        $('#ids_projects').val(<?php echo ID_PROJECT;?>);

        $('#select_projects').change( function() {
            $('#ids_projects').val(<?php echo ID_PROJECT;?>);
        });


        $("#addA7").click(function(e) {
/*            var select_id_project = document.getElementById("select_projects").value;
            window.location.href = "new_asset.php?id_project="+select_id_project;
            var select_id_project = document.getElementById("select_projects").value;*/
            window.location.href = "new_asset.php?id_project=<?php echo ID_PROJECT;?>";
        });

        var menu = new BootstrapMenu('#content-item', {
          actions: [

          {
            name: 'Add Asset',
            onClick: function() {
              // alert("Add asset wip!");
/*              $('#content-item').hide();
              $('#content-asset-crud').show();
              $('#content-asset-crud').load("modal_newAsset.php");*/
              //window.location.href = "new_asset.php?";

/*              var select_id_project = document.getElementById("select_projects").value;
              window.location.href = "new_asset.php?id_project="+select_id_project;*/
              window.location.href = "new_asset.php?id_project=<?php echo ID_PROJECT;?>";
            }
          }

          ]
        });



        $(".editA7").click(function(e) {
            $('#top').hide();
            $('#content-item').hide();
            $('#top_edit').show();
            $('#iframe_editA7').show();
            $("#assetEdit_name").text($(this).attr("name"));
            
        });

        $("#closeA7edit").click(function(e) {
            $('#top_edit').hide();
            $('#iframe_editA7').hide();
            $('#top').show();
            $('#content-item').show();
        });




   window.onkeyup = function(e) {

        var event = e.which || e.keyCode || 0; // .which with fallback

        if (event == 27) { // ESC Key
            $('#top_edit').hide();
            $('#iframe_editA7').hide();
            $('#top').show();
            $('#content-item').show();
        }
    }



    });


});

</script>










































</body>


</html>