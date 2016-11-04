
<?php



header("Access-Control-Allow-Origin: *");

/*


if (isset($_POST['vignette'])){
		echo 'OK';
		$myfile = fopen('toto.txt', "w");
		fclose($myfile);

	$imageData=$_GET['vignette']
	$imageData = base64_decode($imageData);
	$source = imagecreatefromstring($imageData);
	$rotate = imagerotate($source, $angle, 0); // if want to rotate the image
	$imageSave = imagejpeg($rotate,$imageName,100);
	imagedestroy($source);




}
*/


if(isset($_POST['image'])){
	// echo 'toto';
	$curlUrl='showimg.php';	
/*	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $curlUrl);
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS, 'image='.$_POST['image']);
	$result = curl_exec($ch);
	curl_close($ch);*/

	$myfile = fopen('toto.txt', "w");
		file_put_contents('toto.txt', $_POST['image']);	
	fclose($myfile);



$base64Image=$_POST['image'];
$newImageName= time();
$getImageMimeType=substr($base64Image, 5, strpos($base64Image, ';')-5);
$imageTypeArray=array('image/png'=>'png','image/jpeg'=>'jpg','image/gif');
$imgExt=$imageTypeArray[$getImageMimeType];
$newImageName=$newImageName.'.'.$imgExt;
list($type, $base64Image) = explode(';', $base64Image);
list(, $base64Image)      = explode(',', $base64Image);
$base64Image = base64_decode($base64Image);
file_put_contents(''.$newImageName, $base64Image);
//echo $avatar=$newImageName;


echo "<img src='".$newImageName."'>";

}










?>

<script>

function covertImageInBase64()
{
    var imageFile = document.getElementById("imageFile").files;
    if (imageFile.length > 0)
    {
        var imageFileUpload = imageFile[0];
        var readFile = new FileReader();
        readFile.onload = function(fileLoadedEvent) 
        {
            var base64image = document.getElementById("image");
            base64image.value = fileLoadedEvent.target.result;
        };
        readFile.readAsDataURL(imageFileUpload);
    }
}


</script>








<form method="post" id="SampleForm" action="">
	<input type="file" onchange="covertImageInBase64();" id="imageFile"/>
	<input type="text" name="image" id="image">
	<input type="submit" value="Submit">
</form>
 

