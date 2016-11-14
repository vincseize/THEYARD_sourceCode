<?php


// 'images' refers to your file input name attribute
if (empty($_FILES['images'])) {
    echo json_encode(['error'=>'No files found for upload or max file size reached!']); 
    // or you can throw an exception 
    return; // terminate
}





// get the files posted
$images = $_FILES['images'];

// get case infos
// $name_vignette = empty($_POST['name_vignette']) ? '' : $_POST['name_vignette'];
$name_vignette = "vignette_" . md5(uniqid());
//$caseInfos = empty($_POST['caseInfos']) ? '' : $_POST['caseInfos'];
//$casePath = empty($_POST['casePath']) ? '' : $_POST['casePath'];
$name_case = empty($_POST['name_case']) ? '' : $_POST['name_case'];
$type_upload = empty($_POST['type_upload']) ? '' : $_POST['type_upload'];
$inc = empty($_POST['inc']) ? '' : $_POST['inc'];
if($name_case===NULL OR $name_case==NULL OR $name_case=='' OR empty($_POST['name_case']) OR is_null($name_case)){
    $name_case="XXX";
    } // todo) ? true : false;){$inc=md5(uniqid());} // todo
//$ext = empty($_POST['ext']) ? '' : $_POST['ext'];

$ar = array(" ", "/", "\\", "$");
$name_case = str_replace($ar, "-", $name_case);


$name_case = $name_case.'_case_'.$inc;



$casePath = '_medias/cases/'.$name_case;



/*$tmp = explode("|", $caseInfos);
$path = $tmp[1];*/
if (!file_exists($casePath)) {
    @mkdir($casePath, 0755);
    @mkdir($casePath."/thumbnails", 0755);
    @mkdir($casePath."/jpg", 0755);
    @mkdir($casePath."/png", 0755);
    @mkdir($casePath."/gif", 0755);
    @mkdir($casePath."/svg", 0755);
    @mkdir($casePath."/mp3", 0755);
    @mkdir($casePath."/ogg", 0755);
}






























// a flag to see if everything is ok
$success = null;

// file paths to store
$paths= [];

// get file names
$filenames = $images['name'];

// loop and process files
for($i=0; $i < count($filenames); $i++){
    $ext = explode('.', basename($filenames[$i]));
    //$target = "_medias" . DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
    //$target = $path . DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
    $target = $casePath . DIRECTORY_SEPARATOR . $name_vignette . "." . array_pop($ext);
    if(move_uploaded_file($images['tmp_name'][$i], $target)) {


// convert to ... DO
// imagepng(imagecreatefromstring(file_get_contents($filename)), "output.png");

// compression thumbnails
//$img = imagecreatefromjpeg("myimage.jpg");   // load the image-to-be-saved
//imagejpeg($img,"myimage_new.jpg",50);
//unlink("myimage.jpg");   // remove the old image


    // create thumbnails
    $pInfo  =   pathinfo($target);
    // Save the new path using the current file name
    $dest   =   $casePath."/thumbnails/".$pInfo['basename'];

    // Do the rest of your stuff and things...
    $source_image = imagecreatefromjpeg($target);
    $width = imagesx($source_image);
    $height = imagesy($source_image);
    $desired_width = $width;
    $desired_height = floor($height * ($desired_width / $width));
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
    imagejpeg($virtual_image, $dest);

























        $success = true;
        $paths[] = $target;
    } else {
        $success = false;
        break;
    }
}

// check and process based on successful status 
if ($success === true) {
    // call the function to save all data to database
    // code for the following function `save_data` is not 
    // mentioned in this example
    // save_data($userid, $username, $paths);

    // store a successful response (default at least an empty array). You
    // could return any additional response info you need to the plugin for
    // advanced implementations.
    $output = [];
    // for example you can get the list of files uploaded this way
    // $output = ['uploaded' => $paths];
} elseif ($success === false) {
    $output = ['error'=>'Error while uploading images. Contact the system administrator'];
    // delete any uploaded files
    foreach ($paths as $file) {
        // unlink($thumbnail, 0755); TODO
        unlink($file);
    }
} else {
    $output = ['error'=>'No files were processed.'];
}

// return a json encoded response for plugin to process successfully
echo json_encode($output);
?>