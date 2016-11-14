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

<html>




  <link rel="stylesheet" media="screen" href="styles_gridShaman.css" />


<style type="text/css">

.g {
  		padding: 0.25em;
			overflow: hidden;
		}
		.g li {
			float: left;
			width: 50%;
			padding: 0.25em;
		}
		.g img {
			display: block;
		}
		.g li:nth-child(odd) {
			clear: left;
		}
	
		@media screen and (min-width: 40em) {
			.g li {
		    	width: 33.3333333333333333%; 
		  	}
		  	.g li:nth-child(3n+1) {
		  		clear: left;
		  	}
		  	.g li:nth-child(odd) {
				clear: none;
			}
		}
		@media screen and (min-width: 55em) {
			.g li {
		    	width: 25%; 
		  	}
		  	.g li:nth-child(4n+1) {
		  		clear: left;
		  	}
		  	.g li:nth-child(3n+1) {
				clear: none;
			}
		}
		@media screen and (min-width: 72em) {
			.g li {
		    	width: 20%; 
		  	}
		  	.g li:nth-child(5n+1) {
		  		clear: left;
		  	}
		  	.g li:nth-child(4n+1) {
				clear: none;
			}
		}
		@media screen and (min-width: 90em) {
			.g li {
		    	width: 16.666666666%; 
		  	}
		  	.g li:nth-child(6n+1) {
		  		clear: left;
		  	}
		  	.g li:nth-child(5n+1) {
				clear: none;
			}
		}

		</style>















<body>




                        <?php
                        $D = '_medias/';
                        $images=array() ; //Initialize once at top of script
                        if(count($images)==0){
                          $images = glob($D. '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                          shuffle($images);
                          }
                        $randomImage=array_pop($images);



                        ?>






<!--Pattern HTML-->
  <div id="pattern" class="pattern">
  	<ul class="g">


<?php

if(!empty($datas_assets)){ 




                if($_SESSION['id_status_user']=='2'){
          
                      echo "<li class='mix mix_all' data-name='add_a7' style='display: inline-block;  opacity: 1;' >";
                          echo "<a href='#' class='thumbnail' id='add_a7' >";
                          echo "<h4 style='background-color:black;color:white;'> Add Asset</h4>";
                          echo "<img data-toggle='modal' data-target='#myModal' class='img-responsive' src='../images/add_a7.png' alt=''>";
                          //echo "</a>";
                      echo "<p></p>";
                      echo "<p></p>";
                      echo "</li>";
          
                }



}




foreach($datas_assets as $data3){ 
        if($data3['ids_projects']=="1"){ 





                  $tags = ' ';
                  $ar_tags = explode(",", $data3['ids_tags']);
                  foreach($ar_tags as $t){ 
                            foreach($datas_tags as $data4){ 
                                if($t==$data4['id']){$tags = $tags . ' ' . $data4['tag'] ;}
                                }
                  }
                  
              
                  echo "<li class='mix  mix_all' data-name='".$data3['id']."' style='display: inline-block;  opacity: 1;'>";
                  echo "<a href='crud/assets_edit.php?id=".$data3['id']."' rel='modal:open' data-id='".$data3['id']."' class='thumbnail' id='".$data3['id']."'>";
                  echo "<h4 style='background-color:black;color:white;'>".$data3['name']."</h4>";              
                  echo "<img src='".array_pop($images)."' alt='Cake 1'>";
                  echo "<p></p>";
                  echo "<p style='background-color:gray;color:black;'>".$data3['description']."</p>";
                  echo "</a>";
                  echo "</li>";
                 


          }
      }
  









?>


		</ul>
	</div>
	


	</body>



	</html>