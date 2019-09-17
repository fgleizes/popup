<?php  
	require "../classes/Database.class.php";
	require "../classes/User.class.php";

	if(!empty($_POST)) {
		if(array_key_exists("firstname", $_POST)
		&& array_key_exists("lastname", $_POST)
		&& array_key_exists("usermail", $_POST)
		&& array_key_exists("username", $_POST)
		&& array_key_exists("userpassword", $_POST)) {
			if(!empty($_POST["firstname"])
			&& !empty($_POST["lastname"])
			&& !empty($_POST["usermail"]) 
			&& !empty($_POST["username"]) 
			&& !empty($_POST["userpassword"])) {
				if (filter_var($_POST["usermail"], FILTER_VALIDATE_EMAIL)) {
					$user = new user();
					$user->insertUser($_POST);
					$message = $user->message;
				} else {
					$message = "L'adresse mail saisie n'est pas au bon format : exemple@exemple.com";
				}
			} else {
				$message = "Un des champs du formulaire n'a pas été correctement rempli";
			}
		} else {
			$message = "Il y a une erreur de saisie";
		}
	}

	include "../public/templates/signup_tpl.php";
?>