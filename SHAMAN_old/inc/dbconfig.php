<?php

require 'DB.php';
$db = new DB();

if ( $_SERVER["SERVER_ADDR"] == "127.0.0.1" ) {
	$db_host = "localhost";
	$db_name = "theyard";
	$db_user = "root";
	$db_pass = "";
}else{
/*	$db_host = "localhost";
	$db_name = "shaman";
	$db_user = "root";
	$db_pass = "shaman";*/	
	$db_host = "82.223.10.101";
	$db_name = "minuscule2";
	$db_user = "Mimi";
	$db_pass = "Coccinelle2016";

/*    private $dbHost     = "82.223.10.101";
    private $dbName     = "theyard";
    private $dbUsername = "Mimi";
    private $dbPassword = "Coccinelle2016";*/

}
try {
	$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
	$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	//$db_con = $db->$conn;

} catch(PDOException $ex) {
    echo "An Error occured!"; //user friendly message
}
?>