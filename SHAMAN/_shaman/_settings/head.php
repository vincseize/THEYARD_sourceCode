<?php
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
?>


<head>  
  <title>Shaman</title>

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

<!--     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"> -->

<link rel="stylesheet" href="../css/font-awesome.min.css">
<!-- // https://cdnjs.com/libraries/font-awesome/4.6.3 -->

<script src="jquery.js" type="text/javascript"></script>
<!--     <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script> -->



<style type="text/css">


body { background: #555555; padding:1.8em 0;overflow:hidden; }

.header { padding:0; }


a:link { text-decoration: none; } 
a:visited { text-decoration: none; } 
a:hover { text-decoration: none; } 
a:active { text-decoration: none; }






</style>

<style type="text/css">
.box {
  float: left;
  width: 200px;
  height: 100px;
  margin: 1em;
}
.after-box {
  clear: left;
}
</style>



<link href="../css/bootstrap.min.css" rel="stylesheet">      <!--  // 1 -->


<link href="../ShotTracker_fichiers/main.css" rel="stylesheet" media="screen" type="text/css"> <!--  // 2 -->



</head>