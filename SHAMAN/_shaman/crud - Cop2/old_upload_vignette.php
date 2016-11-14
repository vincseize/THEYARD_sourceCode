<?php
@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
$ds = DIRECTORY_SEPARATOR;


require '../../inc/crud.php';



$ids_projects = $_GET['ids_projects']; 
$name_project = $_GET['name_project']; 
$id_asset = $_GET['id_asset']; 
$folder_name = $_GET['folder_name']; 

$quality = 80;
$quality_thumb = 40;
$name = ''; $type = ''; $size = ''; $error = '';

$width_thumb 	= '400';
$height_thumb 	= '300';


function create_thumbnail($source_url, $destination_url, $quality) {

  	$info = getimagesize($source_url);

      if ($info['mime'] == 'image/jpeg')
      $image = imagecreatefromjpeg($source_url);

      elseif ($info['mime'] == 'image/gif')
      $image = imagecreatefromgif($source_url);

      elseif ($info['mime'] == 'image/png')
      $image = imagecreatefrompng($source_url);





      imagejpeg($image, $destination_url, $quality);
      return $destination_url;
}


/*function resize($width, $height, $src, $dest){
  list($w, $h) = getimagesize($src);
  $ratio = max($width/$w, $height/$h);
  $h = ceil($height / $ratio);
  $x = ($w - $width / $ratio) / 2;
  $w = ceil($width / $ratio);
  $imgString = file_get_contents($src);
  $image = imagecreatefromstring($imgString);
  $tmp = imagecreatetruecolor($width, $height);
  imagecopyresampled($tmp, $image,
    0, 0,
    $x, 0,
    $width, $height,
    $w, $h);
 $data = getimagesize($src);
 var_dump($data);
	$img = imagejpeg($tmp, $dest, 80);
}




*/
  



$DATASstoreFolder = "../../".DATASstoreFolderName.$ds.$ids_projects."_".$name_project.$ds."assets".$ds.$folder_name.$ds;


if (!file_exists($DATASstoreFolder)) {
    mkdir($DATASstoreFolder, 0777, true);
}
 
if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];
    //$targetPath = dirname( __FILE__ ) . $ds. $DATASstoreFolder . $ds  ;
    //$targetFile =  $targetPath. $_FILES['file']['name'];  
    $targetFile =  $DATASstoreFolder . $_FILES['file']['name'];
    move_uploaded_file($tempFile,$targetFile); 


	create_thumbnail($targetFile, $DATASstoreFolder . VIGNETTE_A7, $quality_thumb);

	// compress_image($targetFile, $DATASstoreFolder . "vignette_thumbnail.jpg", $quality);

	// resize($width_thumb, $height_thumb, $DATASstoreFolder . "vignette.jpg", $DATASstoreFolder . "vignette_comp.jpg");





$source = imagecreatefromjpeg($DATASstoreFolder . VIGNETTE_A7); // La photo est la source
$destination = imagecreatetruecolor(W_V_HOME, H_V_HOME); // On crée la miniature vide

// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);

// On crée la miniature
imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

// On enregistre la miniature sous le nom "mini_couchersoleil.jpg"
imagejpeg($destination, $DATASstoreFolder . VIGNETTE_A7_HOME);







	 @unlink($targetFile);

    // rename($targetFile,$DATASstoreFolder . "vignette.jpg");

// compress_image($DATASstoreFolder . $targetFile, $DATASstoreFolder . "vignette.jpg", 80)    ;
}
?>   