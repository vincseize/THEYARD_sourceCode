<?php  
//@session_start();
//if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}


header("Access-Control-Allow-Origin: *");











if(isset($_GET['json'])){
		require '../inc/crud.php';
		$db = new DB();
		$tblName = 'assets';




$mode = 'C';
//$name = 'tutu';
//$id_creator = '7';
//$ids_projects = '1';
$duree = 'd';
//$ids_tags = '6-8-9[3]';



// $json = $_GET['json'];
// echo $_GET['json'];
$rest = substr($_GET['json'], 1, -1);
/*echo $rest;*/

$tmp = explode(",'id_tags':", $rest);
$ids_tags_steps = $tmp[1];
$rest = $tmp[0];

$tmp = explode(",'id_user':", $rest);
$id_creator = substr($tmp[1], 1, -1);
//echo $id_creator;
$rest = $tmp[0];
//echo $rest;
//echo "<br>";
$tmp = explode(",'asset_name':'", $rest);
$name = substr($tmp[1], 0, -1);
//echo $name;
//echo "<br>";
$rest = $tmp[0];
//echo $rest;
//echo "<br>";
$tmp = explode(",'id_project':'", $rest);
$ids_projects = substr($tmp[1], 0, -1);
//echo $ids_projects;
//echo "<br>";
$rest = $tmp[0];
//echo $rest;

/*echo "<br>----------------------------------------";

echo "<br>";
echo $name;
echo "<br>";
echo $id_creator;
echo "<br>";
echo $duree;
echo "<br>";
echo $ids_tags;
echo "<br>";
echo $ids_projects;
echo "<br>";*/


$ids_tags = '';
//echo $ids_tags_steps;
$tmp = explode("-", $ids_tags_steps);
//print_r($tmp);
foreach($tmp as $t){ 

$tmp2 = explode("[", $t);
$ids_tags = $tmp2[0].','.$ids_tags;

}




// echo $ids_tags;


//exit;




if($mode='C'){



		$datas_projects     = $db->getRows('projects',array('where'=>array('id'=>$ids_projects),'return_type'=>'single'));
		




		$now = date("Y-m-d_His");
		$file = "fromUkraina_".$now.".txt";
		$myfile = fopen($file, "w");

		/*$current = file_get_contents($myfile);*/
/*		file_put_contents($file, $_GET['json']);
		fclose($myfile);*/

		// echo file_get_contents($file);


























        //check unique name !!!!!! 
        $name_project   = $datas_projects['project'];
        $asset = $name;
        $asset = preg_replace('{/@|\./}','',$asset);
        //$asset = iconv('utf-8', 'us-ascii//TRANSLIT', $asset);


        $data = array(
            'ids_projects' => $ids_projects,
            'ids_tags' => $ids_tags,
            'ids_tags_steps' => $ids_tags_steps,
            //'name' => $_POST['name'],
            'name' => $asset,
            //'vignette' => $vignette_blob,
            'duree' => $duree,
            'description' => '',
            'archived' => '0',
            'active' => '1',
            'id_creator' => $id_creator,
            'modified_by' => $id_creator
        );
        $insert = $db->insert($tblName,$data);
        $Msg = $insert?'Asset data has been inserted successfully.':'Some problem occurred, please try again.';
        $_SESSION['projectMsg'] = $Msg;








sleep(1);
$datas_assets = $db->getRows('assets',array('order_by'=>'id DESC'));
foreach($datas_assets as $data){
    if($data['name'] == $asset){ $id_asset = $data['id']; }
}





        $ds = DIRECTORY_SEPARATOR;
        //$id_project = $_POST['id_project'];  
/*        $id_project = '1';  
        $project = 'M2';  
        $asset = $_POST['name'];
        $asset = preg_replace('{/@|\./}','',$asset);
        $asset = str_replace(' ', '_', $asset);
        $asset = mb_strtoupper($asset); // check name*/
        //$id_asset = '1500';


        $asset = preg_replace('{"\'#$[/@|\./;,]}','',$asset);
        $asset = str_replace(' ', '-', $asset);
        $asset = str_replace("'", '-', $asset);



$pattern = array("'é'", "'è'", "'ë'", "'ê'", "'É'", "'È'", "'Ë'", "'Ê'", "'á'", "'à'", "'ä'", "'â'", "'å'", "'Á'", "'À'", "'Ä'", "'Â'", "'Å'", "'ó'", "'ò'", "'ö'", "'ô'", "'Ó'", "'Ò'", "'Ö'", "'Ô'", "'í'", "'ì'", "'ï'", "'î'", "'Í'", "'Ì'", "'Ï'", "'Î'", "'ú'", "'ù'", "'ü'", "'û'", "'Ú'", "'Ù'", "'Ü'", "'Û'", "'ý'", "'ÿ'", "'Ý'", "'ø'", "'Ø'", "'œ'", "'Œ'", "'Æ'", "'ç'", "'Ç'");

$replace = array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E', 'a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'A', 'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 'i', 'i', 'i', 'I', 'I', 'I', 'I', 'I', 'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U', 'y', 'y', 'Y', 'o', 'O', 'a', 'A', 'A', 'c', 'C'); 



        $asset = preg_replace($pattern, $replace, $asset);


        $asset_upper = mb_strtoupper($asset); // check name


        $folder_name = $ids_projects.'_'.$id_asset.'_'.$asset_upper;
        $DATASstoreFolder = '../'. DATASstoreFolderName . $ds . $ids_projects ."_". $name_project . $ds .'assets' . $ds . $folder_name;
        $DATASstoreFolderComments = $DATASstoreFolder. $ds . 'comments';

        if (!file_exists($DATASstoreFolder)) {
            mkdir($DATASstoreFolder, 0777, true);
            mkdir($DATASstoreFolderComments, 0777, true);
        }
         

/*echo $DATASstoreFolder;
echo $DATASstoreFolderComments;*/

        $data = array(
            'folder_name' => $folder_name
        );
        $condition = array('id' => $id_asset);
        $update = $db->update($tblName,$data,$condition);
        $Msg = $insert?'Asset data has been updated successfully.':'Some problem occurred, please try again.';
        $_SESSION['projectMsg'] = $Msg;



















echo "[1,".$id_asset.",".$folder_name."]";



}












}

/*if(isset($_POST['json'])){

echo $_POST['json'];

}*/
































?>