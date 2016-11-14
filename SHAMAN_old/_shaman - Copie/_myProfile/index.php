
<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';

$db = new DB();



$title_user = "Hi' ".$_SESSION['login']." [ ".$_SESSION['status']." ]";

$timestamp_id_creator = date("Ymd_his")."_".$_SESSION['id'];

$ds = DIRECTORY_SEPARATOR;

$get_user  = $db->getRows('users',array('where'=>array('id'=>$_SESSION['id']),'return_type'=>'single'));


?>




<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


    <script src="../js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="../js/jquery.ui-contextmenu.min.js" type="text/javascript"></script>
<!--     <script src="../js/BootstrapMenu.min.js"></script> -->



    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <script src="../js/BootstrapMenu.min.js"></script>



    <link href="../css/jquery-ui.css" type="text/css" rel="stylesheet">

    <script src="../js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="../js/jquery.ui-contextmenu.min.js" type="text/javascript"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">


<script src="jquery.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>



<style type="text/css">


body { background: #555555; padding:1.8em 0;overflow-x:hidden; }

.header { padding:0; }


a:link { text-decoration: none; } 
a:visited { text-decoration: none; } 
a:hover { text-decoration: none; } 
a:active { text-decoration: none; }

























.dropdown-submenu {
  position: relative;
}
.dropdown-submenu > .dropdown-menu {
  top: 0;
  left: 100%;
  margin-top: -6px;
  margin-left: -1px;
}
.dropdown-submenu:hover > .dropdown-menu {
  display: block;
}
.dropdown-submenu:hover > a:after {
  border-left-color: #fff;
}
.dropdown-submenu.pull-left {
  float: none;
}
.dropdown-submenu.pull-left > .dropdown-menu {
  left: -100%;
  margin-left: 10px;
}






</style>







<body>



<!-- <div class="section group">
header

</div> -->

<div class="header">
<?php include('menu_top_profile.php'); ?>
</div>



<div id="content-asset-crud"></div>

<div id="content-item" class="content-item"  style="padding-top:0px;align-content: center;width:50%;">


        <div class="panel-body" style="background-color:#444; ">

        <h4 class="modal-title" id="myModalLabel"><font color=white>NEW ASSET</font></h4>


              <form method="post" action="_user_edit.php" class="form" id="assetForm">

                      <div class="form-group">
                          <label><font color=white>Name</font></label>
                          <input type="text" class="form-control" name="name" value="<?php echo $get_user['name']; ?>"/>
                      </div>
                      <div class="form-group">
                          <label><font color=white>Pseudo</font></label>
                          <input type="text" class="form-control" name="pseudo" value="<?php echo $get_user['pseudo']; ?>"/>
                      </div>
                      <div class="form-group">
                          <label><font color=white>Login</font></label>
                          <input type="text" class="form-control" name="login"  value="<?php echo $get_user['login']; ?>" disabled/>
                      </div>


                      <div class="form-group">
                          <label><font color=white>Password</font></label>
                          <input type="password" class="form-control" name="password"  value="<?php echo $get_user['password']; ?>" required/>
                      </div>

                      <div class="form-group">
                          <label><font color=white>Mail</font></label>
                          <input type="text" class="form-control" name="mail"  value="<?php echo $get_user['mail']; ?>" required/>
                      </div>

                      <input type="hidden" name="modified_by" value="<?php echo $_SESSION['id']; ?>"/>
                      <input type="hidden" name="id" value="<?php echo $get_user['id']; ?>"/>


                    
                      

                            <div class="modal-footer">
                              
                              <!--  <button type="submit" class="form-control btn btn-primary" name="submit" id="submit_asset2">Create Asset</button>
                            <input type="submit" class="form-control btn-default" name="submit" value="Create Asset"/> -->
                             <input type="submit" class="form-control btn-primary" name="submit" value="Update"/>
                          <!--    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
                            </div>


              </form>
            <a href="#" class="forgot-password">
                Forgot the password?
            </a>
          </div>


</div>    
</div>




</body>