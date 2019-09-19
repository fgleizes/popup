<?php  
	require "../classes/Database.class.php";
	require "../classes/User.class.php";

	if(!empty($_POST)
	){	// On vérifie que les index existent bien
		if(array_key_exists("firstname", $_POST) 
		&& array_key_exists("lastname", $_POST)
		&& array_key_exists("usermail", $_POST)
		&& array_key_exists("username", $_POST)
		&& array_key_exists("userpassword", $_POST)
		){	// On vérifie que tous les champs soient rempli
			if(!empty($_POST["firstname"]) 
			&& !empty($_POST["lastname"])
			&& !empty($_POST["usermail"]) 
			&& !empty($_POST["username"]) 
			&& !empty($_POST["userpassword"])
			){	// On vérifie si l'adresse mail saisie est au bon format
				if (filter_var($_POST["usermail"], FILTER_VALIDATE_EMAIL)
				){ 	// On instancie la class User
					$user = new user(); 
					// On utilise la méthode insertUser pour insérer les données de l'utilisateur dans la bdd
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