<?php
session_start();
if(!isset($_SESSION['user_session'])){



  header("Location: logout.php");

}
include_once '../inc/dbconfig.php';


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




  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/jquery-ui.min.js" type="text/javascript"></script>
  <script src="js/jquery.ui-contextmenu.min.js" type="text/javascript"></script>

  <script src="js/BootstrapMenu.min.js"></script>







    <style>

.row {

  margin-bottom: 10px;

}
    </style>




  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
       <!-- navbar-header -->
        <div class="navbar-header">

          <a class="navbar-brand" href="#">SHAMAN</a>





              <ul class="nav navbar-nav">

                    <li class="dropdown"> 
                        <a data-toggle="dropdown" href="#">Projects<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">M2</a></li>
                            <li><a href="#">p1</a></li>
                            <li><a href="#">p2</a></li>
                        </ul>
                    </li>

                </ul>














        </div>
        <!-- /.navbar-header -->
        <!-- nav-collapse -->
        <div id="navbar" class="navbar-collapse collapse">





<ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $title_user;?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#"><span class="glyphicon glyphicon-cog"></span>&nbsp;My Settings</a></li>

<?php
if($_SESSION['is_root']==True)
                echo "<li><a href='../_admin/index.php'><span class='glyphicon glyphicon-list-alt'></span>&nbsp;Administration</a></li>";
?>

                <li><a href="logout.php"><span class="glyphicon glyphicon-remove"></span>&nbsp;Disconnect</a></li>
              </ul>
            </li>
          </ul>









        </div><!--/.nav-collapse -->

      </div>
    </nav>

    










    <div class="container-fluid" id="container-fluid">








    <script>
    var menu = new BootstrapMenu('#container-fluid', {
      actions: [{
        name: 'Action',
        onClick: function() {
          toastr.info("'Action' clicked!");
        }
      }, {
        name: 'Another action',
        onClick: function() {
          toastr.info("'Another action' clicked!");
        }
      }, {
        name: 'A third action',
        onClick: function() {
          toastr.info("'A third action' clicked!");
        }
      }]
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

?>








        <!-- Projects Row -->
<div class="row">
      <div class="col-md-1">
            


            <div class="col-md-2 portfolio-item">
                <a href="#">
                    <img class="img-responsive" src="http://placehold.it/700x400" alt="">
                </a>
                <h3>
                    <a href="#">Project Name</a>
                </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
            </div> 


            <div class="col-md-2 portfolio-item">
                <a href="#">
                    <img class="img-responsive" src="http://placehold.it/700x400" alt="">
                </a>
                <h3>
                    <a href="#">Project Name</a>
                </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
            </div> 
            <div class="col-md-2 portfolio-item">
                <a href="#">
                    <img class="img-responsive" src="http://placehold.it/700x400" alt="">
                </a>
                <h3>
                    <a href="#">Project Name</a>
                </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
            </div> 
            <div class="col-md-2 portfolio-item">
                <a href="#">
                    <img class="img-responsive" src="http://placehold.it/700x400" alt="">
                </a>
                <h3>
                    <a href="#">Project Name</a>
                </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
            </div> 
       










    </div> 













    <div class="col-md-1   portfolio-item">
            <div class="row">
                <div class="col-md-3">
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-md-3">
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-md-3">
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-md-3">
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div>
</div>
        <!-- /.row -->


        <!-- Projects Row -->
<div class="row">
      <div class="col-md-6   portfolio-item">
            <div class="row">
                <div class="col-md-3">
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-md-3">
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-md-3">
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-md-3">
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div> 
    <div class="col-md-6   portfolio-item">
            <div class="row">
                <div class="col-md-3">
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-md-3">
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-md-3">
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
                <div class="col-md-3">
                  <a href="#"><img class="img-responsive" src="<?php echo array_pop($images); ?>" alt=""></a>
                </div>
          </div>
    </div>
</div>
        <!-- /.row -->




















<div class="dropdown bootstrapMenu" style="z-index: 10000; position: absolute; display: none; height: 69px; width: 158px; top: 169.004px; left: 985px;">
<ul class="dropdown-menu" style="position:static;display:block;font-size:0.9em;">
<li role="presentation" data-action="0" class=""><a href="#" role="menuitem"><span class="actionName">Action</span></a></li>
<li role="presentation" data-action="1" class=""><a href="#" role="menuitem"><span class="actionName">Another action</span></a></li>
<li role="presentation" data-action="2" class=""><a href="#" role="menuitem"><span class="actionName">A third action</span></a></li>
</ul>
</div>







    </div>
    <!-- /.container -->


















    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>



</body>


</html>
