<?php
require('config/config.php');
require('model/functions.fn.php');
session_start();

if(	isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && 
	!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {

	$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

if(isset($_POST['email']) && isset($_POST['password'])){
	if(!empty($_POST['email']) && !empty($_POST['password'])){
if (isEmailAvailable($db, $email) && isUsernameAvailable($db, $username)){
	userRegistration($db, $username, $email, $password);

	header('Location: login.php');
}
else{
	$error = 'Un champ est déjà utilisé';
}
}
}


}else{ 
	$_SESSION['message'] = 'Erreur : Formulaire incomplet';
	header('Location: register.php');
}