<?php
	session_start();
	
	if (array_key_exists("connected", $_SESSION) 
	&& $_SESSION['connected'] 
	&& array_key_exists("id", $_SESSION)) {
		require "../classes/Database.class.php";
		require "../classes/User.class.php";
		
		if(!empty($_POST)) {
			if (array_key_exists("firstname", $_POST)
			&& array_key_exists("lastname", $_POST)
			&& array_key_exists("usermail", $_POST)
			&& array_key_exists("username", $_POST)) {
				if (!empty($_POST["firstname"])
				&& !empty($_POST["lastname"])
				&& !empty($_POST["usermail"])
				&& !empty($_POST["username"])) {
					if (filter_var($_POST["usermail"], FILTER_VALIDATE_EMAIL)) {
						$user = new user();
						$user->editUserProfil($_POST);
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

		// On récupère dans la BDD les informations actuelles de l'utilisateur, qu'on réaffiche dans le formulaire.
		$sql = ("SELECT Users.Firstname, Users.Lastname, Users.Username, Users.Usermail FROM `Users` WHERE Users.Id = ?");
		$database = new database();
		$infosUser = $database->queryOne($sql, [ $_SESSION['id'] ]);

		include "../public/templates/editUserProfil_tpl.php";
	} else {
		header("location: login.php");
	}
?>