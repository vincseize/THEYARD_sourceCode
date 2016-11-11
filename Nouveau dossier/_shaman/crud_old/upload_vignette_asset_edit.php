<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
require '../../inc/crud.php';
$ds = DIRECTORY_SEPARATOR;


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





if(isset($_FILES["file"]["type"]))
			//if(isset($_FILES["images"]["type"]))
			{
			$validextensions = array("jpeg", "jpg", "png");
			$temporary = explode(".", $_FILES["file"]["name"]);
			$file_extension = end($temporary);
			if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
			) && ($_FILES["file"]["size"] < 10000000)//Approx. 10 000kb files can be uploaded.
			&& in_array($file_extension, $validextensions)) {
			if ($_FILES["file"]["error"] > 0)
			{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
			}
			else
			{
			if (file_exists($_FILES["file"]["name"])) {
			echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
			}
			else
			{


















			$ids_projects = $_POST['ids_projects']; 
			$name_project = $_POST['name_project']; 
			//$id_asset = $_POST['id_asset']; 
			$folder_name = $_POST['folder_name']; 

			$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
			//$targetPath = $_FILES['file']['name']; // Target path where file is to be stored
			$targetPath = "..".$ds."..".$ds.DATASstoreFolderName.$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds.'vignette.jpg';
			$targetPath_comp = "..".$ds."..".$ds.DATASstoreFolderName.$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds.'vignette_comp.jpg';
			$targetPath_home = "..".$ds."..".$ds.DATASstoreFolderName.$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds.'vignette_home.jpg';


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




			echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
			echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
			echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
			echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
			}
			}
			}
			else
			{
			echo "<span id='invalid'>***Invalid file Size or Type***<span>";
			}
}
?>