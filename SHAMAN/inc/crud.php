<?php
/*@session_start();
if(!isset($_SESSION['user_session'])){header("Location: ../index.php");exit;}
if(isset($_SESSION['user_session'])==0){header("Location: ../index.php");exit;}*/
include 'define.php';
require 'DB.php';
$db = new DB();

$users 					= $db->getRows('users',array('order_by'=>'id DESC'));
$status_users 			= $db->getRows('status_users',array('order_by'=>'id ASC'));
$projects 				= $db->getRows('projects',array('order_by'=>'id DESC'));
$tags 					= $db->getRows('tags',array('order_by'=>'id DESC'));
$tags_asc 				= $db->getRows('tags',array('order_by'=>'id ASC'));
$steps 					= $db->getRows('steps',array('order_by'=>'id DESC'));
$steps_pos_asc 			= $db->getRows('steps',array('order_by'=>'position ASC'));
$steps_pos_desc 		= $db->getRows('steps',array('order_by'=>'position DESC'));
$flags 					= $db->getRows('flags',array('order_by'=>'id DESC'));
$assets 				= $db->getRows('assets',array('order_by'=>'id DESC'));
$comments 				= $db->getRows('comments',array('order_by'=>'id DESC'));
$comments_asc 			= $db->getRows('comments',array('order_by'=>'id ASC'));

$tmp = explode('/', $_SERVER["SCRIPT_NAME"]);
$file = $tmp[count($tmp) - 1];
$filename = explode('.', $file)[0];
$tblName = explode('_', $filename)[0];
//echo $tblName;
/*$string = $filename;
extract(array($string => $string));
echo $filename;*/


?>