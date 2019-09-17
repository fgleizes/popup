<?php
	require "../classes/Database.class.php";
	require "../classes/User.class.php";

	if(!empty($_POST)) {
		if(array_key_exists("usermail", $_POST)
		&& array_key_exists("userpassword", $_POST)) {
			if(!empty($_POST["usermail"])
			&& !empty($_POST["userpassword"])) {
				$user = new user();
				$user->loginUser($_POST);
				$message = $user->message;
			} else {
				$message = "Un des champs du formulaire n'a pas été correctement rempli";
			}
		} else {
			$message = "Il y a une erreur de saisie";
		}
	}

	include "../public/templates/login_tpl.php";
?>