<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$db = new DB();
$tblName = 'assets';


/*


		$myfile = fopen("save_tags.txt", "w") or die("Unable to open file!");

		$ids_tags = $_POST['ids_tags'];

		$txt = $ids_tags."\n";
		fwrite($myfile, $txt);
		$txt = $_POST['id']."\n";
		fwrite($myfile, $txt);
		fclose($myfile);

*/
if(isset($_POST['ids_tags'])){
      $data = array('ids_tags' => $_POST['ids_tags']);
      $condition = array('id' => $_POST['id']);
      $update = $db->update($tblName,$data,$condition);


}

?>