<?php
@session_start();
$ds = DIRECTORY_SEPARATOR;
$project = 'M2';  
$asset = 'toto'; 
$DATASstoreFolder = $_SESSION['$DATASstoreFolder'] . $ds . $project . $ds .'assets' . $ds .$asset;

if (!file_exists($DATASstoreFolder)) {
    mkdir($DATASstoreFolder, 0777, true);
}
 
if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];
    $targetPath = dirname( __FILE__ ) . $ds. $DATASstoreFolder . $ds  ;
    $targetFile =  $targetPath. $_FILES['file']['name'];  
    move_uploaded_file($tempFile,$targetFile); 
}
?>   