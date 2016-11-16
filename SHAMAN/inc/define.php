<?php
/*@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
if(isset($_SESSION['user_session'])==0){header("Location: ../index.php");exit;}*/

define ('WEB_APP_NAME', 'shaman');

define ('ROOT_PATH', dirname(dirname(__FILE__)));

define ('ROOT_SHAMAN', $_SESSION['ROOT_SHAMAN']);

define ('DS', DIRECTORY_SEPARATOR);

if ( $_SERVER["SERVER_ADDR"] == "127.0.0.1" ) {
	define ('DATASstoreFolderName', '_shamanDATAS_localhost');
}
else{define ('DATASstoreFolderName', '_shamanDATAS');}
define ('DATASstoreFolderPath', ROOT_PATH.DS.DATASstoreFolderName);
if (!file_exists(DATASstoreFolderPath)) {
    mkdir(DATASstoreFolderPath, 0777, true);
}
define ('PATH_THUMB_HOME_A7', "../".DATASstoreFolderName);

// CURRENT PROJECT
define ('ID_PROJECT','1');

// NAMES
define ('VIGNETTE_A7','vignette.jpg');
define ('VIGNETTE_A7_COMP','vignette_comp.jpg');
define ('VIGNETTE_A7_HOME','vignette_home.jpg');

// FORMATS
define ('VALID_FORMATS_UPLOAD',array("jpeg", "jpg", "png", "gif", "zip", "mp4", "tiff", "tif"));
define ('MAX_FILE_SIZE',1024*3000000); //100 0000 kb  / 1024 000 => 1000 ko => 1 Mo

// PATTERNS

/*$pattern_accents = array("'é'", "'è'", "'ë'", "'ê'", "'É'", "'È'", "'Ë'", "'Ê'", "'á'", "'à'", "'ä'", "'â'", "'å'", "'Á'", "'À'", "'Ä'", "'Â'", "'Å'", "'ó'", "'ò'", "'ö'", "'ô'", "'Ó'", "'Ò'", "'Ö'", "'Ô'", "'í'", "'ì'", "'ï'", "'î'", "'Í'", "'Ì'", "'Ï'", "'Î'", "'ú'", "'ù'", "'ü'", "'û'", "'Ú'", "'Ù'", "'Ü'", "'Û'", "'ý'", "'ÿ'", "'Ý'", "'ø'", "'Ø'", "'œ'", "'Œ'", "'Æ'", "'ç'", "'Ç'");

define ('PATTERN_ACCENTS',$pattern_accents);

$pattern_accents_replace = array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E', 'a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'A', 'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 'i', 'i', 'i', 'I', 'I', 'I', 'I', 'I', 'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U', 'y', 'y', 'Y', 'o', 'O', 'a', 'A', 'A', 'c', 'C');

define ('PATTERN_ACCENTS_REPLACE',$pattern_accents_replace);*/

// COMPRESSION
define ('COMP_VIGNETTE_A7_HOME','40');
define ('COMP_VIGNETTE_A7_EDIT','60');
define ('W_V_HOME','192');
define ('H_V_HOME','108');
define ('W_V_EDIT','426');
define ('H_V_EDIT','240');

// SIZES BASES
define ('W_1280','1280');
define ('H_720','720');

define ('W_800','800');
define ('H_600','600');

define ('W_640','640');
define ('H_480','480');

define ('W_128','128');
define ('H_72','72');

define ('W_192','192');
define ('H_108','108');

///// IMG THUMB
define ('W_DFLT',W_1280);
define ('H_DFLT',H_720);

define ('W_THUMB_HOME',W_192);
define ('H_THUMB_HOME',H_108);

define ('W_THUMB_COM',W_128);
define ('H_THUMB_COM',H_72);
?>