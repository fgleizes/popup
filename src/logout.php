<?php
	require "../classes/User.class.php";
	// On instancie la class User
	$user = new user();
	// On utilise la méthode logoutUser pour vider et détruire la variable globale $_SESSION
	$user->logoutUser(); 
?>