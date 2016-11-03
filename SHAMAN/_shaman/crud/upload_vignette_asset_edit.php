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


/*

echo $ids_projects;
echo '<br>';
echo $name_project;
echo '<br>';
echo $folder_name;*/

//exit;




// If you want to ignore the uploaded files, 
// set $demo_mode to true;

// $demo_mode = false;
$upload_dir = 'uploads/';
//$upload_dir = "..".$ds."..".$ds.DATASstoreFolderName.$ds."1_".$name_project.$ds."/assets/1_14_ZAAAAAAAAAAAA/";

$allowed_ext = array('jpg','jpeg','png','gif');


if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
	exit_status('Error! Wrong HTTP method!');
}


if(array_key_exists('pic',$_FILES) && $_FILES['pic']['error'] == 0 ){
	
	$pic = $_FILES['pic'];

	if(!in_array(get_extension($pic['name']),$allowed_ext)){
		exit_status('Only '.implode(',',$allowed_ext).' files are allowed!');
	}	

	if($demo_mode){
		
		// File uploads are ignored. We only log them.
		
		$line = implode('		', array( date('r'), $_SERVER['REMOTE_ADDR'], $pic['size'], $pic['name']));
		file_put_contents('log.txt', $line.PHP_EOL, FILE_APPEND);
		
		exit_status('Uploads are ignored in demo mode.');
	}
	
	
	// Move the uploaded file from the temporary 
	// directory to the uploads folder:
	


			$sourcePath = $_FILES['pic']['name']; // Storing source path of the file in a variable
			//$targetPath = $_FILES['file']['name']; // Target path where file is to be stored
			$targetPath = "..".$ds."..".$ds.DATASstoreFolderName.$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds.'vignette.jpg';
			$targetPath_comp = "..".$ds."..".$ds.DATASstoreFolderName.$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds.'vignette_comp.jpg';
			$targetPath_home = "..".$ds."..".$ds.DATASstoreFolderName.$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds.'vignette_home.jpg';
/*
	if(move_uploaded_file($pic['tmp_name'], $targetPath)){
		exit_status('File was uploaded successfuly!');
	}

	if(move_uploaded_file($pic['tmp_name'], $upload_dir.$pic['name'])){
		exit_status('File was uploaded successfuly!');
	}
	
}*/	






			$sourcePath = $_FILES['pic']['tmp_name']; // Storing source path of the file in a variable
			//$targetPath = $_FILES['file']['name']; // Target path where file is to be stored
			$targetPath = "..".$ds."..".$ds.DATASstoreFolderName.$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds.'vignette.jpg';
			$targetPath_comp = "..".$ds."..".$ds.DATASstoreFolderName.$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds.'vignette_comp.jpg';
			$targetPath_home = "..".$ds."..".$ds.DATASstoreFolderName.$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds.'vignette_home.jpg';

/*echo $sourcePath;
echo $targetPath;

*/

			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
			$v_comp = compress($targetPath, $targetPath_comp, COMP_VIGNETTE_A7_EDIT);
			$v_home = compress($targetPath, $targetPath_home, COMP_VIGNETTE_A7_HOME);
			// $c = create_thumbnail($targetPath, $targetPath_home, W_V_HOME, H_V_HOME)

			// home Thumb resize
			$source = imagecreatefromjpeg($targetPath); // La photo est la source
			$destination = imagecreatetruecolor(W_V_HOME, H_V_HOME); // On crée la miniature vide
			// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
			$largeur_source = imagesx($source);
			$hauteur_source = imagesy($source);
			$largeur_destination = imagesx($destination);
			$hauteur_destination = imagesy($destination);
			// On crée la miniature
			imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
			// On enregistre la miniature 
			imagejpeg($destination, $targetPath_home);



			// edit vignette resize
			$source = imagecreatefromjpeg($targetPath); // La photo est la source
			$destination = imagecreatetruecolor(W_V_EDIT, H_V_EDIT); // On crée la miniature vide
			// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
			$largeur_source = imagesx($source);
			$hauteur_source = imagesy($source);
			$largeur_destination = imagesx($destination);
			$hauteur_destination = imagesy($destination);
			// On crée la miniature
			imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
			// On enregistre la miniature 
			imagejpeg($destination, $targetPath_comp);



			@unlink($sourcePath);



/*
			echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
			echo "<br/><b>File Name:</b> " . $_FILES["pic"]["name"] . "<br>";
			echo "<b>Type:</b> " . $_FILES["pic"]["type"] . "<br>";
			echo "<b>Size:</b> " . ($_FILES["pic"]["size"] / 1024) . " kB<br>";
			echo "<b>Temp file:</b> " . $_FILES["pic"]["tmp_name"] . "<br>";

*/






















}

//exit_status('Something went wrong with your upload!');


// Helper functions

function exit_status($str){
	echo json_encode(array('status'=>$str));
	exit;
}

function get_extension($file_name){
	$ext = explode('.', $file_name);
	$ext = array_pop($ext);
	return strtolower($ext);
}

function compress($source, $destination, $quality) {
		$info = getimagesize($source);
		if ($info['mime'] == 'image/jpeg') 
			$image = imagecreatefromjpeg($source);
		elseif ($info['mime'] == 'image/gif') 
			$image = imagecreatefromgif($source);
		elseif ($info['mime'] == 'image/png') 
			$image = imagecreatefrompng($source);
		imagejpeg($image, $destination, $quality);
		return $destination;
	}

function create_thumbnail($source, $targetPath, $w, $h) {

	$source = imagecreatefromjpeg($source); // La photo est la source
	$destination = imagecreatetruecolor($w, $h); // On crée la miniature vide

	// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
	$largeur_source = imagesx($source);
	$hauteur_source = imagesy($source);
	$largeur_destination = imagesx($destination);
	$hauteur_destination = imagesy($destination);

	// On crée la miniature
	imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

	// On enregistre la miniature 
	imagejpeg($destination, $targetPath);

}







?>