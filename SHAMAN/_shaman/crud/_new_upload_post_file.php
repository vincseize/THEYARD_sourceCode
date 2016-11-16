<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
include '../../classes/__classes_movie.php';
include '../../classes/__classes_img.php';
$db = new DB();
$tblName = 'assets';
$datas              = $db->getRows($tblName,array('where'=>array('id'=>$_GET['id']),'return_type'=>'single'));
$datas_projects     = $db->getRows('projects',array('where'=>array('id'=>$datas['ids_projects']),'return_type'=>'single'));

$ds = DIRECTORY_SEPARATOR;

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






        if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name)){



				if( pathinfo($_FILES['files']['name'][$f], PATHINFO_EXTENSION) == 'mp4'){
					sleep(2);

					$basename = basename( $_FILES['files']['name'][$f] );
					$basename = str_replace(".mp4",".jpg",$basename);
					$targetFile = $path.$name; 
					$image = $path. "thumbMP4_".$basename; 			
					$wich_sec = 1;	


					$comp = new movie();
					$comp->mp4_to_jpeg($targetFile,$image,W_THUMB_COM,H_THUMB_COM,$wich_sec);





				    // comp file
/*							$ffmpeg = '/usr/bin/ffmpeg';  
					$video = $path.$name;  
					$image = $path. "thumbMP4_".$basename;  
					$interval = 1;  // 2 secs
					//$size = '128x72';
					$size = W_THUMB_COM.'x'.H_THUMB_COM;
					  
					$cmd = "$ffmpeg -i $video -deinterlace -an -ss $interval -f mjpeg -t 1 -r 1 -y -s $size $image 2>&1";
					exec($cmd);*/
				}





        $count++; // Number of successfully uploaded file
    	}

	        }
	    }
	}
}
?>


<SCRIPT language=javascript>
window.location.href= 'assets_edit.php?id=<?php echo $_GET['id'];?>'
</SCRIPT>