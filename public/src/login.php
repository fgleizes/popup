<?php
	require "../../classes/Database.class.php";
	require "../../classes/User.class.php";

	// session_start();

	if (isset($_POST)) {
		// if( array_key_exists( "mail", $_POST )
		// && array_key_exists( "password", $_POST )) {
		// 	if( !empty($_POST["mail"])
		// 	&& !empty($_POST["password"]) 
		// 	){
		// 		$user = new user();
		// 		$user->loginUser($_POST);
		// 	}
		// }

		$user = new user();
		$user->loginUser($_POST);
	} else {
		echo "Il y a eu une erreur lors de la soumission du formulaire!";
	}

	include "../templates/login_tpl.php";
?>