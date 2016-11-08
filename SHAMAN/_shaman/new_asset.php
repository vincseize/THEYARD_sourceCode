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

<style>
body, html {
overflow-x: hidden;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>


	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="author" content="The Yard - Vincseize">
	<meta name="description" content="Shaman">
	<meta name="keywords" content="Shaman">
	<meta name="viewport" content="width=device-width, initial-scale=0.7">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-transparent">


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


<style type="text/css">
  body
{
  padding-top: 40px;
  text-align: center;

}
</style>


</head>

<body ><center>


<?php
include('menu_top_new.php');
?>
	
<div id="content-asset-crud"></div>

<div id="content-item" class="content-item"  style="padding-top:0px;align-content: center;width:50%;">


        <div class="panel-body" style="background-color:#444; ">

        <h4 class="modal-title" id="myModalLabel"><font color=white>NEW ASSET</font></h4>


              <form method="post" action="crud/assets_action.php" class="form" id="assetForm">
                      <div class="form-group">
                         <!--  <label>Projects</label> -->
                          <input type="hidden" class="form-control" name="ids_projects" id="ids_projects" value="<?php echo $_GET['id_project']; ?>"/>
                      </div>
                      <div class="form-group">
                          <label><font color=white>NOM</font></label>
                          <input type="text" class="form-control" name="name" value=""/>
                      </div>
                      <div class="form-group">
                          <label><font color=white>DURÉE</font></label>
                          <input type="text" class="form-control" name="duree" value=""/>
                      </div>
                      <div class="form-group">
                          <label><font color=white>DESCRIPTION</font></label>
                          <input type="text" class="form-control" name="description"  value=""/>
                      </div>


                        <div class="form-group">
                            <label><font color=white>Tags</font></label>

                            <select class="form-control" name="ids_tags[]" multiple id="ids_tags">
                                  <?php
                                        if(!empty($datas_tags)){ 
                                            foreach($datas_tags as $data3){ 
                                                echo "<option value='".$data3['id']."'>".$data3['tag']."</option>";
                                            }
                                        }
                                    ?>
                            </select>
                        </div>


                      <input type="hidden" name="action_type" value="add"/>
                      <input type="hidden" name="activeValue" value="1"/>
                      <input type="hidden" name="archivedValue" value="0"/>
                      <input type="hidden" name="ids_tagsValue" value=""/>
                      <input type="hidden" name="id_creator" value="<?php echo $_SESSION['id']; ?>"/>
                      <input type="hidden" name="modified_by" value="<?php echo $_SESSION['id']; ?>"/>



                    
                      

                            <div class="modal-footer">
                              
                              <!--  <button type="submit" class="form-control btn btn-primary" name="submit" id="submit_asset2">Create Asset</button>
                            <input type="submit" class="form-control btn-default" name="submit" value="Create Asset"/> -->
                             <input type="submit" class="form-control btn-primary" name="submit" value="Create Asset"/>
                          <!--    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
                            </div>


              </form>

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


<script type="text/javascript">
$(document).ready(function(){

    $(function () {

        $('#ids_tags').multiselect({
            columns: 1,
            placeholder: 'Select Tag(s)',
            search: true,
            selectAll: false
        });


    });
});

</script>



</center>




</body>


</html>