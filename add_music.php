<?php
session_start();
require('config/config.php');
require('model/functions.fn.php');

if( isset($_FILES['music']) && !empty($_FILES['music']) && 
	isset($_POST['title']) && !empty($_POST['title'])){
	
	$file = $_FILES['music'];

	if(is_file($file['tmp_name'])){

		$ext = strtolower(substr(strrchr($file['name'], '.')  ,1));
		// Vérification des extentions
		if (preg_match('/\.(mp3|ogg)$/i', $file['name'])) {
			$filename = md5(uniqid(rand(), true));
			$destination = "musics/{$filename}.{$_SESSION['id']}.{$ext}";

			move_uploaded_file($file['tmp_name'], $destination);

			addMusic($db, $_SESSION['id'], $_POST['title'], $filename);

			header("Location: dashboard.php");
		
		} else {
			$error = 'Erreur, le fichier n\'a pas une extension autorisée !';
		}
	}else $error = "C'est pas un fichier!";
}

include 'view/_header.php';
include 'view/add_music.php';
include 'view/_footer.php';