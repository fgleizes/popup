<?php
	session_start();
	
	// On vérifie que l'utilisateur qui essaye d'atteindre la page d'édition du profil est bien connecté à la $_SESSION
	if (array_key_exists("connected", $_SESSION) 
	&& $_SESSION['connected'] 
	&& array_key_exists("id", $_SESSION)
	){ 
		require "../classes/Database.class.php";
		require "../classes/User.class.php";
		
		// On vérifie si l'utilisateur à soumis le formulaire d'édition du profil
		if(!empty($_POST)
		){	// On vérifie que les index existent
			if (array_key_exists("firstname", $_POST)
			&& array_key_exists("lastname", $_POST)
			&& array_key_exists("usermail", $_POST)
			&& array_key_exists("username", $_POST)
			){	// On vérifie que tous les champs soient rempli
				if (!empty($_POST["firstname"])
				&& !empty($_POST["lastname"])
				&& !empty($_POST["usermail"])
				&& !empty($_POST["username"])
				){	// On vérifie si l'adresse mail saisie est au bon format
					if (filter_var($_POST["usermail"], FILTER_VALIDATE_EMAIL)
					){	// On instancie la class User
						$user = new user();
						// On utilise la méthode editUserProfil pour modifier les données de l'utilisateur dans la bdd
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
		// Si l'utilisateur n'est pas connecté, on le renvoie vers la page login.php
		header("location: login.php");
	}
?>