<?php
/*@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
if(isset($_SESSION['user_session'])==0){header("Location: ../index.php");exit;}*/

define ('WEB_APP_NAME', 'shaman');

define ('ROOT_PATH', dirname(dirname(__FILE__)));
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

// NAMES
define ('VIGNETTE_A7','vignette.jpg');
define ('VIGNETTE_A7_COMP','vignette_comp.jpg');
define ('VIGNETTE_A7_HOME','vignette_home.jpg');

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


///// IMG THUMB
define ('W_DFLT',W_1280);
define ('H_DFLT',H_720);


define ('W_THUMB_COM',W_128);
define ('H_THUMB_COM',H_72);
?>