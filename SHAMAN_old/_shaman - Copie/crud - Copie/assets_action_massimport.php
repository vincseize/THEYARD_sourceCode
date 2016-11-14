<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$db = new DB();
$tblName = 'assets';

if(isset($_GET['action_edit']) && !empty($_GET['action_edit'])){
    if($_GET['action_edit'] == 'massimport'){

        $date = date("Y-m-d H:i:s");
        $datas = $_GET['datas'];

        echo $date ;
        echo "<br>" ;

        $myfile = fopen("massimport.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $datas);
        fclose($myfile);


        $myfile = fopen("massimport.txt", "r") or die("Unable to open file!");
        echo fread($myfile,filesize("massimport.txt"));
        fclose($myfile);

  }

}