<?php



function resize from jpeg
			// home Thumb resize
			$source = imagecreatefromjpeg($targetPath); // La photo est la source
			$destination = imagecreatetruecolor(W_V_HOME, H_V_HOME); // On crée la miniature vide
			// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
			$largeur_source = imagesx($source);
			$hauteur_source = imagesy($source);
			$largeur_destination = imagesx($destination);
			$hauteur_destination = imagesy($destination);
			// On crée la miniature
			imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

function to jpeg
			// On enregistre la miniature 
			imagejpeg($destination, $targetPath_home);


function resize from jpeg
			// edit vignette resize
			$source = imagecreatefromjpeg($targetPath); // La photo est la source
			$destination = imagecreatetruecolor(W_V_EDIT, H_V_EDIT); // On crée la miniature vide
			// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
			$largeur_source = imagesx($source);
			$hauteur_source = imagesy($source);
			$largeur_destination = imagesx($destination);
			$hauteur_destination = imagesy($destination);
			// On crée la miniature
			imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
			// On enregistre la miniature 


function to jpeg
			imagejpeg($destination, $targetPath_comp);


function delete
			@unlink($sourcePath);



function thumbnail_vignette


function thumbnail_file

?>