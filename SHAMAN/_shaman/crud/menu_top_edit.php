
<?php
//require '../../inc/crud.php';

$db = new DB();
$tblName = 'assets';
$datas_id_asset              = $db->getRows($tblName,array('where'=>array('id'=>$_GET['id']),'return_type'=>'single'));
$modified    = $datas_id_asset['modified'];


/*if ( $_SERVER["SERVER_ADDR"] == "82.223.10.101" ) {
  $db_host = "82.223.10.101";
  $db_name = "minuscule2";
  $db_user = "Mimi";
  $db_pass = "Coccinelle2016";
}else{ // dev server


  $db_host = "db651115066.db.1and1.com";
  $db_name = "db651115066";
  $db_user = "dbo651115066";
  $db_pass = "shaman2016";


}
try {
  $db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
  $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $ex) {
    echo "An Error occured!"; //user friendly message
}



$stmt = $db_con->prepare("SELECT id,modified,name FROM assets WHERE modified LIKE '2016-11-13 23:11:38'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
*/

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="height:76px">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">

                  <div class="assetEdit_title_div"  style="position:absolute;top:5px;left:10px;color: :#ddd">
           <!--        <li class="filter active" data-filter="all" > -->

<?php 
//echo $modified;
?>

       <!-- <span id="assetEdit_before" style="font-size:38px;font-weight:bold;color:#ddd;"><</span> -->

       <span id="assetEdit_name" style="font-size:38px;font-weight:bold;color:#ddd;"></span>

       <!-- <span id="assetEdit_next" style="font-size:38px;font-weight:bold;color:#ddd;">></span>   -->             


<?php 
//print_r($count);
// echo $_SERVER["SERVER_ADDR"];
?>



                  </div>
            </div>







                  <div style="position:absolute;right:15px;top:12px;">
<!--                   <ul class="nav navbar-nav" style="position:absolute;top:5px;right:15px;">
                      <img src='../images/logo_shaman_menutop.png'>    
                       </ul>  -->




                       <ul style="text-decoration:none;margin-top:0px;"> 
  
<a  href="#"  title="[ esc key ]" style="text-decoration:none;font-size:32px;color:#eee;" id="closeA7edit">
  

<span class="glyphicon glyphicon-remove-sign">

            </span>
</a>


                       </ul> 
                  </div>
            <!-- /.navbar-collapse -->









        </div>
        <!-- /.container -->
    </nav>


<!--                            <a class="fa  fa-icon-remove-sign" href="../index.php"  title="[ esc key ]" style="text-decoration:none;font-size:16px;"></a> -->