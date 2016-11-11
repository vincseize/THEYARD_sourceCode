<?php
session_start();
if(!isset($_SESSION['user_session'])){header("Location: logout.php");}
//include_once '../inc/dbconfig.php';
require '../inc/crud.php';
$tbl = strtolower(substr($tblName,0,-1));
$datas_projets=$projects;
$datas_tags=$tags;
$datas_assets=$assets;


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
  <link rel="stylesheet" href="jquery.modal.css" type="text/css" media="screen" />


    <style>

body {
    background-color: #252930;
}


.row {

  margin-bottom: 10px;

}



    </style>



























  </head>

  <body>





<?php
include('menu_top.php');
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


                                        /*,{
                                          name: 'Another action',
                                          onClick: function() {
                                            toastr.info("'Another action' clicked!");
                                          }
                                        }, 

                                        {
                                          name: 'A third action',
                                          onClick: function() {
                                            toastr.info("'A third action' clicked!");
                                          }
                                        }*/


                                        ]
                                      });
                                      </script>






                        <?php
                        $D = '_medias/';
                        $images=array() ; //Initialize once at top of script
                        if(count($images)==0){
                          $images = glob($D. '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                          shuffle($images);
                          }
                        $randomImage=array_pop($images);





// echo $_SESSION['id_status_user'];












                        ?>
















<?php
/*                if(!empty($datas_assets)){ 
                    foreach($datas_assets as $data3){ 
                          echo "<font color=white><a href='#' data-toggle='modal'  data-target='#myModal2' >".$data3['name']."</a></font><br>";

                    }
                }*/
                            ?>





















        <!-- Projects Row -->
<div class="row"  id="recipes" >
      <div class="col-xs-6 portfolio-item" >
            <div class="row">











                            <?php


                            if($_SESSION['id_status_user']=='2'){
                                            echo "<div class='col-xs-3 portfolio-item'>";
                                                echo "<a href='#'>";
                                                echo "<img data-toggle='modal' data-target='#myModal' class='img-responsive' src='../images/add_a7.png' alt=''>";
                                                echo "</a>";
                                            echo "</div>";
                              }

                            ?>









<?php
  if(!empty($datas_assets)){ 
      foreach($datas_assets as $data3){ 
          $tags = ' ';
          $ar_tags = explode(",", $data3['ids_tags']);
          foreach($ar_tags as $t){ 
                 

                    foreach($datas_tags as $data4){ 

                        if($t==$data4['id']){$tags = $tags . ' ' . $data4['tag'] ;}

                        
          }

      }
              


              echo "<div class='col-xs-3 portfolio-item' >";


              echo "<li class='mix ".$tags." mix_all' data-name='id-1' style='display: inline-block;  opacity: 1;'>";
          
/*a href="#myModal" class="btn btn-default btn-small" id="custId" data-toggle="modal" data-id="'.$row['ID'].'">Edit</a>*/




              echo "<a href='crud/assets_edit.php?id=".$data3['id']."' rel='modal:open' data-id='2' class='thumbnail' id='B-1'>";
/*              echo "<a href='#myModalEdit2'  data-toggle='modal' id='2' data-target2='#myModalEdit2' data-id='2' class='thumbnail' id='B-1'>";*/
              echo "<h4>".$data3['name']."</h4>";              
              echo "<img src='".array_pop($images)."' alt='Cake 1'>";
              

              echo "<p>".$tags."</p>";


              echo "<p>".$data3['description']."</p>";
              echo "</a>";


              echo "</li>";
                echo "</div>";








      }
  }




                            ?>









                <div class="col-xs-3 portfolio-item" >
              <li class="mix concat mix_all" data-name="id-1" style="display: inline-block;  opacity: 1;">
              <a href="#"  data-toggle='modal'  data-target='#myModal2' class="thumbnail" id="B-1">
              <img src="<?php echo array_pop($images); ?>" alt="Cake 1">
              <h4>Asset Name tag concat</h4>
              <p>Croissant liquorice lemon drops sweet roll gummi bears dessert 
              marzipan unerdwear.com. Toffee chupa chups danish cotton candy bear 
              claw. Tootsie roll macaroon.</p>
              </a>
              </li>
                </div>










                <div class="col-xs-3 portfolio-item" >
              <li class="mix shot concat mix_all" data-name="id-2" style="display: inline-block;  opacity: 1;">
              <a href="#"  data-toggle='modal'  data-target='#myModal2' class="thumbnail" id="B-2">
              <img src="<?php echo array_pop($images); ?>" alt="Cake 1">
              <h4>Asset Name tag shot</h4>
              <p>Croissant liquorice lemon drops sweet roll gummi bears dessert 
              marzipan unerdwear.com. Toffee chupa chups danish cotton candy bear 
              claw. Tootsie roll macaroon.</p>
              </a>
              </li>
                </div>
















                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div> 
    <div class="col-xs-6 portfolio-item" >
            <div class="row">
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div>
</div>
        <!-- /.row -->




        <!-- Projects Row -->
<div class="row">
      <div class="col-xs-6 portfolio-item" >
            <div class="row">
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div> 
    <div class="col-xs-6 portfolio-item" >
            <div class="row">
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div>
</div>
        <!-- /.row -->





        <!-- Projects Row -->
<div class="row">
      <div class="col-xs-6 portfolio-item" >
            <div class="row">
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div> 
    <div class="col-xs-6 portfolio-item" >
            <div class="row">
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div>
</div>
        <!-- /.row -->




        <!-- Projects Row -->
<div class="row">
      <div class="col-xs-6 portfolio-item" >
            <div class="row">
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div> 
    <div class="col-xs-6 portfolio-item" >
            <div class="row">
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div>
</div>
        <!-- /.row -->




        <!-- Projects Row -->
<div class="row">
      <div class="col-xs-6 portfolio-item" >
            <div class="row">
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div> 
    <div class="col-xs-6 portfolio-item" >
            <div class="row">
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div>
</div>
        <!-- /.row -->




        <!-- Projects Row -->
<div class="row">
      <div class="col-xs-6 portfolio-item" >
            <div class="row">
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div> 
    <div class="col-xs-6 portfolio-item" >
            <div class="row">
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div>
</div>
        <!-- /.row -->




        <!-- Projects Row -->
<div class="row">
      <div class="col-xs-6 portfolio-item" >
            <div class="row">
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div> 
    <div class="col-xs-6 portfolio-item" >
            <div class="row">
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div>
</div>
        <!-- /.row -->




        <!-- Projects Row -->
<div class="row">
      <div class="col-xs-6 portfolio-item" >
            <div class="row">
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div> 
    <div class="col-xs-6 portfolio-item" >
            <div class="row">
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-xs-3 portfolio-item" >
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div>
</div>
        <!-- /.row -->



















<!-- Modal1 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">NEW ASSET</h4>
      </div>
      <div class="modal-body">
  <div class="panel panel-default crud-add-edit">


          <div class="panel-body">
<!-- action="crud/assets_action.php" -->
             <!--  <form method="post"  class="form" role="form" id="ADDassetForm"> -->
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
                                                echo "<option value='".$data3['id']."' ".$selected.">".$data3['tag']."</option>";
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
                                

<!--               <input type="submit" class="form-control btn-default" name="submit" value="Create New tag wip"/>
                      
                  -->         
                                                

                                            </div>    
                                    </div>



























                <!--       <form action="upload.php" class="dropzone"></form> -->









                            </div>
                            <div class="modal-footer">
                              
                              <!--  <button type="submit" class="form-control btn btn-primary" name="submit" id="submit_asset2">Create Asset</button>
                            <input type="submit" class="form-control btn-default" name="submit" value="Create Asset"/> -->
                             <input type="submit" class="form-control btn-primary" name="submit" value="Create Asset"/>
                          <!--    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
                            </div>




                          </div>
                        </div>
                      </div>




</form>


<!-- Modal1 -->

























<!-- Modal edit -->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      



                          </div>
                        </div>
                      </div>




<!-- Modal edit -->







<div class="modal fade" id="myModalEdit2" role="dialog">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
        <div class="modal-content2">


        </div>
        </div>
    </div>
</div>














































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








        $("#submit_asset").click(function(e){
            $.ajax({
                type: "POST",
                url: "crud/assets_edit.php", // 
                data: {
                      'name':'n',
                      'description':'d',
                      'duree':'du',
                      'ids_projects':'1'
                },
                success: function(msg){
                    alert("ok");
                    //$('#ADDassetForm').modal('hide');
                },
                error: function(){
                    alert("Something went wrong!");
                }
            });
        });











       $('#myModalEdit2').on('show.bs.modal', function (e) {
              //var rowid = $(e.relatedTarget).data('id');



/*              $.ajax({
                  type : 'post',
                  url : 'crud/assets_edit.php', //Here you will fetch records 

                  data: {rowid: 2},
                  success : function(data){
                  $('#fetched-data').html(data);//Show fetched data from database
                  }
              });*/


                    //var ID=$(this).attr('data-a');
                    var ID='2';
                    $.ajax({url:"crud/assets_edit.php.php?ID="+ID,
                      cache:false,
                      success:function(result){
                        $(".modal-content2").html(result);
                    }});







           });
















        var select_id_project = document.getElementById("select_projects").value;
        //alert(select_id_project);
        $('#ids_projects').val(select_id_project);

        $('#select_projects').change( function() {
            $('#ids_projects').val($(this).val());
        });





//jQuery('#denials').multiselect( )

        $('#ids_tags').multiselect({
            columns: 1,
            placeholder: 'Select Tags',
            search: true,
            selectAll: true
        });







    });




});












  </script>








</body>


</html>
