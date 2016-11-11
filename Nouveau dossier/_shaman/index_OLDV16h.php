<?php
session_start();
if(!isset($_SESSION['user_session'])){header("Location: logout.php");}
//include_once '../inc/dbconfig.php';
require '../inc/crud.php';
$tbl = strtolower(substr($tblName,0,-1));

$datas_projets      =$projects;
$datas_tags         =$tags;
$datas_assets       =$assets;
$datas_users        =$users;
$datas_comments     =$comments;
$datas_comments_asc =$comments_asc;

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
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title>SHAMAN</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">

    <!-- Custom CSS -->
    <link href="css/4-col-portfolio.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Custom styles for context menu -->
    <link href="css/jquery-ui.css" type="text/css" rel="stylesheet">


<link href="jquery.multiselect.css" rel="stylesheet" type="text/css">

<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="js/jquery-ui.min.js" type="text/javascript"></script>
<script src="js/jquery.ui-contextmenu.min.js" type="text/javascript"></script>
<script src="js/BootstrapMenu.min.js"></script>

 

<script src="js/dropzone.js"></script>
<link rel="stylesheet" href="css/dropzone.css">
<!-- <link rel="stylesheet" href="jquery.modal.css" type="text/css" media="screen" /> -->


<link rel="stylesheet" href="shaman.css" type="text/css" media="screen" />

</head>

<body>


<?php
include('menu_top.php');
?>
<?php
                        $D = '_medias/';
                        $images=array() ; //Initialize once at top of script
                        if(count($images)==0){
                          $images = glob($D. '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                          shuffle($images);
                          }
                        $randomImage=array_pop($images);
?>


<div class="container-fluid" id="container-fluid">

        <script>
        var menu = new BootstrapMenu('#container-fluid', {
          actions: [

          {
            name: 'Add Asset',
            onClick: function() {
              alert("Add asset wip!");
            }
          }

          ]
        });
        </script>


























































        <div class='pattern' id="recipes">
        <ul class="g" >
        <?php
        include('asset_add_ui.php');
        if(!empty($datas_assets)){ 
            include('assets_ui.php');
          }

        ?>
        <ul>
        </div>












































        <?php
            include('modal_newAsset.php');
            include('modal_editAsset.php');
        ?>

        <div class="dropdown bootstrapMenu" style="z-index: 10000; position: absolute; display: none; height: 69px; width: 158px; top: 169.004px; left: 985px;">
        <ul class="dropdown-menu" style="position:static;display:block;font-size:0.9em;">


</div>
<!-- /.container -->



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
<script src="js/bootstrap.min.js"></script>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="bootstrap-checkbox.min.js"></script>
<script src="jquery.multiselect.js"></script>
<script src="jquery.modal.js" type="text/javascript" charset="utf-8"></script>

<!-- <script src="Bootstrap%203%20Portfolio%20Mixitup_fichiers/jquery_002.js"></script> -->
<script src="Bootstrap%203%20Portfolio%20Mixitup_fichiers/jquery.js"></script>
<script>
  $(function(){     
    $('#recipes').mixitup();     
});
  </script>







<script type="text/javascript">
$(document).ready(function(){

    $(function () {


        // add
        $('#trigger_todo').click(function(e){
             e.preventDefault();
            $("#container-fluid").load("todo.php");
          });
      // edit
/*       $('#myModalEdit2').on('show.bs.modal', function (e) {


   
                     var myDropzone = new Dropzone("#myDropzone", { url: 'file_upload_route'});
                  


                    var ID='2';
                    $.ajax({url:"crud/assets_edit.php.php?ID="+ID,
                      cache:false,
                      success:function(result){
                        $(".modal-content2").html(result);
                    }});
           });*/

        var select_id_project = document.getElementById("select_projects").value;
        //alert(select_id_project);
        $('#ids_projects').val(select_id_project);

        $('#select_projects').change( function() {
            $('#ids_projects').val($(this).val());
        });

        $('#ids_tags').multiselect({
            columns: 1,
            placeholder: 'Select Tag(s)',
            search: true,
            selectAll: false
        });

        //$("#ids_tags option:selected").removeAttr("selected");
        $("#ids_tags-rec option:selected").prop("selected", false);




    });
});

</script>




</body>


</html>