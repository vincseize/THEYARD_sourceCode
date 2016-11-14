<?php
session_start();

/*error_reporting(E_ALL); 
ini_set('display_errors', 'On');*/
$ds = DIRECTORY_SEPARATOR;

	require_once '../inc/dbconfig.php';
	if(isset($_POST['login']) && isset($_POST['password']))
	{
		$login = trim($_POST['login']);
		$password = trim($_POST['password']);
		try
		{	
			$stmt = $db_con->prepare("SELECT * FROM users WHERE login=:login");
			//$stmt = $db->prepare("SELECT * FROM users WHERE login=:login");
			$stmt->execute(array(":login"=>$login));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			if($row['password']==$password){

					$id_status_users = $row['id_status_users'];
					$stmt2 = $db_con->prepare("SELECT * FROM status_users WHERE id=:id_status_users");
					$stmt2->execute(array(":id_status_users"=>$id_status_users));
					$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

					$_SESSION['user_session'] 		= $row['id'];
					$_SESSION['id'] 				= $row['id'];
					$_SESSION['login'] 				= $row['login'];
					$_SESSION['pseudo'] 			= $row['pseudo'];
					$_SESSION['admin']				= $row['admin'];
					$_SESSION['id_status_user']		= $row2['id'];
					$_SESSION['status']  			= $row2['status']; // 1 - user / 2 - manager / 3 - visitor / 4 - root

					$_SESSION['prefs_user'] 		= '';

					$_SESSION['is_root'] 			= False;

					if($_SESSION['login']=='root' and $_SESSION['pseudo']=='root' and $_SESSION['id_status_user']=='4' and $_SESSION['user_session']=='1' and $row['id_creator']=='1'){ 
							$_SESSION['is_root'] 	= True;
					}
					$_SESSION['_shaman_TMP']  = '_shaman_TMP';
					$DATASstoreFolderName  = '_shamanDATAS';
					if ( $_SERVER["SERVER_ADDR"] == "127.0.0.1" ) {
						$DATASstoreFolderName  = '_shamanDATAS_localhost';
					}
					$DATASstoreFolderPath = "../".$DATASstoreFolderName;
					if (!file_exists($DATASstoreFolderPath)) {
					    mkdir($DATASstoreFolderPath, 0777, true);
					}

					$_SESSION['$DATASstoreFolder'] = $_SERVER["DOCUMENT_ROOT"].$ds.'theyard'.$ds.'SHAMAN'.$ds.$DATASstoreFolderName;

					define ('ROOT_PATH', dirname(dirname(__FILE__)));


					echo '<script>window.location = "index.php";</script>';
			}
			// redirection
			else{
				echo '<script>window.location = "home.php";</script>';
			}
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>



