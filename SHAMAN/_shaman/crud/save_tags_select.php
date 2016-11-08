<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$db = new DB();
$tblName = 'assets';





/*		$myfile = fopen("save_tags.txt", "w") or die("Unable to open file!");

		$ids_tags = $_POST['ids_tags'];
		$txt = $ids_tags."\n";
		fwrite($myfile, $txt);
		$txt = $_POST['ids_tags_steps']."\n";
		fwrite($myfile, $txt);
		$txt = $_POST['id']."\n";
		fwrite($myfile, $txt);
		fclose($myfile);*/

// data:{ids_tags:ids_tags_string, ids_tags_steps:ids_tags_steps, id:id_asset}, 

/*		echo $_POST['id'];
		echo "<br>";
		echo $_POST['ids_tags'];
		echo "<br>";
		echo $_POST['ids_tags_steps'];*/

$datas_assets  		= $db->getRows('assets',array('where'=>array('id'=>'112'),'return_type'=>'single'));
$datas_tags_steps   = $datas_assets['ids_tags_steps'];
// echo $datas_tags_steps;

//$datas_tags_steps   =  "6-8-11-15-9[5]-10[5]";

$old = (explode("-",$datas_tags_steps));


// $old = 6-8-11-15-9[5]-10[5];
//$new = array('6','8','11','15','10[3]'); // 9[6]-6-8-10-11-15

$new = explode("-",$_POST['ids_tags_steps']);

$ids_tags_steps_conc = array_unique (array_merge ($old, $new));
// print_r($ids_tags_steps_conc);
$ids_tags_steps = "";
foreach($ids_tags_steps_conc as $st){
	$ids_tags_steps = $st."-".$ids_tags_steps;
}
$ids_tags_steps = substr ( $ids_tags_steps , 0, -1 );
//echo $ids_tags_steps ;
//echo "<br>";
$ids_tags_steps_tmp = explode("-",$ids_tags_steps);

$ids_tags_steps_excl = "";
foreach($ids_tags_steps_tmp as $st){
	if(!in_array($st, $old)){
		$ids_tags_steps_excl = $st."-".$ids_tags_steps_excl;
	}
}
$ids_tags_steps_excl = substr ( $ids_tags_steps_excl , 0, -1 );
//echo $ids_tags_steps_excl ;
//echo "<br>";
$ids_tags_steps_excl_id = explode("[",$ids_tags_steps_excl)[0];
//echo $ids_tags_steps_excl_id ;
//echo "<br> ------------------------------------------ <br>  ";




$ids_tags_steps = "";
foreach($ids_tags_steps_conc as $st){
	if (strpos($st, '[') !== false) {
    			

    					$tmp = explode("[",$st);

    					if($tmp[0]!=$ids_tags_steps_excl_id ){
    						//echo $tmp."<br>";
    						$ids_tags_steps = $ids_tags_steps."-".$st;
    					}			

				
		}
		else {
				if($st!='9' and $st!='10'){
						$ids_tags_steps = $ids_tags_steps."-".$st;
				}

		}
		// $ids_tags_steps_excl = $st."-".$ids_tags_steps_excl;
	
}

$ids_tags_steps = $ids_tags_steps."-".$ids_tags_steps_excl;
//echo "<br> ------------------------------------------ <br>  ";
$ids_tags_steps = substr ( $ids_tags_steps , 1);
//echo $ids_tags_steps ;
//echo "<br> ------------------------------------------ <br>  ";



$tmp = explode("-",$ids_tags_steps);
$ids_tags_steps = "";
foreach($tmp as $st){
			if($st!='9' and $st!='10'){
					$ids_tags_steps = $ids_tags_steps."-".$st;
			}
}
$ids_tags_steps = substr ( $ids_tags_steps , 1);


if(isset($_POST['id'])){
      $data = array('ids_tags' => $_POST['ids_tags'],'ids_tags_steps' => $ids_tags_steps);
      $condition = array('id' => $_POST['id']);
      $update = $db->update($tblName,$data,$condition);


}

?>