<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: logout.php");}
require '../inc/crud.php';
$tbl = strtolower(substr($tblName,0,-1));

$datas_projets      =$projects;
$datas_tags         =$tags;
$datas_assets       =$assets;
$datas_users        =$users;
$datas_comments     =$comments;
$datas_comments_asc =$comments_asc;


?>  
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

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


<link rel="stylesheet" href="shaman.css" type="text/css" media="screen" />


<div style="padding-top:50px;">

    <form method="post" action="crud/assets_action.php" class="form" id="assetForm">
                      <div class="form-group">
                         <!--  <label>Projects</label> -->
                          <input type="hidden" class="form-control" name="ids_projects" id="ids_projects" value=""/>
                      </div>
                      <div class="form-group">
                          <label>NOM</label>
                          <input type="text" class="form-control" name="name" value=""/>
                      </div>
                      <div class="form-group">
                          <label>DURÉE</label>
                          <input type="text" class="form-control" name="duree" value=""/>
                      </div>
                      <div class="form-group">
                          <label>DESCRIPTION</label>
                          <input type="text" class="form-control" name="description"  value=""/>
                      </div>


                        <div class="form-group">
                            <label>Tags</label>

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
   
                             <input type="submit" class="form-control btn-primary" name="submit" value="Create Asset"/>
                            </div>


      </form>
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



<script type="text/javascript">
$(document).ready(function(){

    $(function () {

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