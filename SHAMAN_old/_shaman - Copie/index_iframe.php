<?php
session_start();
if(!isset($_SESSION['user_session'])){header("Location: logout.php");}
//include_once '../inc/dbconfig.php';
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

<div id='top' style='height: 65px;padding-bottom:20px;background-color: #333333;'>
      <div id='menu_top' style='height: 65px;'>
      <?php include('menu_top.php');?>
      </div>  
      <div id='menu_top_edit' style='height: 65px;display:none;'>
      <?php 
      include('crud/menu_top_edit.php');
      ?>
      </div>  
</div>  
  




    <font color=white>
<?php 
/*     echo $_SERVER['DOCUMENT_ROOT'];
     echo '<br>';
          echo $_SERVER["DOCUMENT_ROOT"];
     echo '<br>';
     echo $vignette;*/
/*     echo 'http://'.$_SERVER['SERVER_NAME'];
     echo '<br>';
     echo ROOT_SHAMAN;*/


     // /homepages/31/d390773776/htdocs/VINCSEIZE/theyard/SHAMAN
?>  

</font>

<!-- 
<a href="_crud/asset_editOR.php" class="test" >comment #3</a><br>
<div id="somediv" title="this is a dialog" style="display:none;">
    <iframe id="thedialog" width="100%" height="100%"></iframe>
</div>
<script>
$(document).ready(function () {
    $(".test").click(function () {
        $("#thedialog").attr('src', $(this).attr("href"));
        $("#somediv").dialog({
            width: 800,
            height: 600,
            modal: true,
            close: function () {
                $("#thedialog").attr('src', "about:blank");
            }
        });
        return false;
    });
});
</script>



<style>
.Modal {
  height: 100%;
  width: 100%;
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
  background: #8e44ad;
  z-index: 9999;
}

.Modal .Close {
  position: absolute;
  top: 25px;
  right: 65px;
  z-index: 999;
  cursor: pointer;
}

</style>


<a class="Ghost-Blue" href="#" url='_crud/asset_editOR.php'>Open Modal</a>
  
 <div class="Modal">
   <div class="Close"><img src="Elements/Close/Close.svg" height="60px" width="60px;" /></div>
    <h1>Minimalist Fullscreen Modal Window Demo</h1>
 </div>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<script>


$(document).ready(function(){
  $(".Modal").hide();
    $(".Ghost-Blue").click(function(){




      $(".Modal").fadeToggle();
      $(".Modal").attr('src', '_crud/asset_editOR.php');

    });
    $(".Close").click(function(){
      $(".Modal").fadeOut();
    });
});

$(document).keydown(function(e) {
if(e.keyCode == 27) {
    $(".Modal").hide(300);
}
});

</script>




 -->


<!-- Button to trigger modal -->
<a href="_crud/asset_editOR.php" data-target="#myModal" data-toggle="modal">Launch demo modal</a>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal Test Header</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Save changes</button>
  </div>
</div>​



<style type="text/css">
 
#name{
    display: none;
}
#name:target{
    display: block;
}
 
</style>
 
<script>
 
</script>
 
</head>
<body>
 
<iframe id="name" name="ma-iframe" src="_crud/asset_editOR.php?id=113" width="100%" height="600" scrolling="auto" align="top" frameborder="0"></iframe>
 
<a href="#name">cliquez ici pour pouvoir voir le contenu</a>
 
</body>
</html>
















<div id="content-edit-asset" style="display: none;">
e
</div>


<div id="content-item" class="content-item">





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

        $('#content-asset-crud').hide();

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



        $(".a_editA7").click(function(e) {
            var name_asset = $(this).attr('a_name_asset');
            var id_asset = $(this).attr('a_id_asset');
            console.log(id_asset);
            console.log(name_asset);
            $('#menu_top').hide();
            $('#content-item').hide();
            $('#menu_top_edit').show();
            $('#content-edit-asset').show();
            $("#name_asset_edit").html(name_asset);
            
            $("#content-edit-asset").load("_crud/assets_edit.php?id="+id_asset+"");
            
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


    });


});

</script>










































</body>


</html>