<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
include '../../classes/__classes_movie.php';
$ds = DIRECTORY_SEPARATOR;



// $project = 'M2'; 
$ids_projects = $_GET['ids_projects']; 
$name_project = $_GET['name_project']; 
$id_asset = $_GET['id_asset']; 
$folder_name = $_GET['folder_name']; 
/*$comment_timestamp = $_GET['comment_timestamp']; 
$comment_id_creator = $_GET['comment_id_creator']; */

/*$comment_timestamp = "120054782016"; 
$comment_id_creator = "1"; */
$timestamp_id_creator = $_GET['timestamp_id_creator']; 


$DATASstoreFolder = "../../".DATASstoreFolderName.$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds."comments".$ds.$timestamp_id_creator;


if (!file_exists($DATASstoreFolder)) {
    mkdir($DATASstoreFolder, 0777, true);
}
 sleep(1);
if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];
    // $targetPath = dirname( __FILE__ ) . $ds. $DATASstoreFolder . $ds  ;
    //$targetFile =  $targetPath. $_FILES['file']['name'];  
    $targetFile =  $DATASstoreFolder .$ds. $_FILES['file']['name'];
    move_uploaded_file($tempFile,$targetFile); 



	if( pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'mp4'){
		sleep(2);

	    // mp4 vignette

		$basename = basename( $_FILES['file']['name'] );
		$basename = str_replace(".mp4",".jpg",$basename);
		$image = $DATASstoreFolder .$ds. "thumbMP4_".$basename;
		$wich_sec = 1;


		$comp = new movie();
		$comp->mp4_to_jpeg($targetFile,$image,W_THUMB_COM,H_THUMB_COM,$wich_sec);

/*		$ffmpeg = '/usr/bin/ffmpeg';  
		$video = $targetFile;  
		$image = $DATASstoreFolder .$ds. "thumbMP4_".$basename;  
		$interval = 1;  // 2 secs
		//$size = '128x72';  
		$size = W_THUMB_COM.'x'.H_THUMB_COM;
		$cmd = "$ffmpeg -i $video -deinterlace -an -ss $interval -f mjpeg -t 1 -r 1 -y -s $size $image 2>&1";
		exec($cmd);*/



	}

}
?>   