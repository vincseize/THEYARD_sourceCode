<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$db = new DB();
$tblName = 'assets';
$datas              = $db->getRows($tblName,array('where'=>array('id'=>$_GET['id']),'return_type'=>'single'));
$datas_projects     = $db->getRows('projects',array('where'=>array('id'=>$datas['ids_projects']),'return_type'=>'single'));

$ds = DIRECTORY_SEPARATOR;

/*

$ids_projects   = $POST['ids_projects'];
$name_project   = $POST['name_project'];
$folder_name    = $POST['folder_name'];
*/

/*
$ids_projects   = $GET['ids_projects'];


$ids_projects   = '1';
$name_project   = 'minuscule2';
$folder_name    = '1_14_ZAAAAAAAAAAAA';
*/

$ids_projects   = $datas['ids_projects'];
$name_project   = $datas_projects['project'];
$folder_name    = $datas['folder_name'];
$timestamp_id_creator = $_GET['timestamp_id_creator'];


$valid_formats = array("jpeg", "jpg", "png", "gif", "zip", "mp4", "tiff", "tif");
$max_file_size = 1024*1000000 ; //100 0000 kb
// $path = "uploads/"; // Upload directory
$path = $DATASstoreFolder = "../../".DATASstoreFolderName.$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds."comments".$ds.$timestamp_id_creator.$ds;



$count = 0;

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	// Loop $_FILES to exeicute all files
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }	       
	    if ($_FILES['files']['error'][$f] == 0) {	           
/*	        if ($_FILES['files']['size'][$f] > $max_file_size) {
	            $message[] = "$name is too large!.";
	            continue; // Skip large files
	        }*/
			if( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
				$message[] = "$name is not a valid format";
				continue; // Skip invalid file formats
			}
	        else{ // No error found! Move uploaded files 





if (!file_exists($path)) {
    mkdir($path, 0777, true);
}




if (pathinfo($name, PATHINFO_EXTENSION)=='mp4'){
		$ffmpeg = '/usr/bin/ffmpeg';  
		$video = $_FILES["files"]["tmp_name"][$f];  
		$image = $path.'thumb_'.$name;   
		$interval = 5;   
		$size = W_THUMB_COM."x".W_THUMB_COM;  
		$cmd = "$ffmpeg -i $video -deinterlace -an -ss $interval -f mjpeg -t 1 -r 1 -y -s $size $image 2>&1";
		exec($cmd);
}






	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
	            $count++; // Number of successfully uploaded file
	        }
	    }
	}
}
?>


<SCRIPT language=javascript>
window.location.href= 'assets_edit.php?id=<?php echo $_GET['id'];?>'
</SCRIPT>