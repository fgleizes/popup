<?php
	require "../classes/Database.class.php";
	require "../classes/User.class.php";

	if(!empty($_POST)
	){	// On vérifie que les index existent
		if(array_key_exists("usermail", $_POST) 
		&& array_key_exists("userpassword", $_POST)
		){	// On vérifie que tous les champs soient rempli
			if(!empty($_POST["usermail"]) 
			&& !empty($_POST["userpassword"])
			){	// On instancie la class User
				$user = new user(); 
				// On utilise la méthode loginUser pour vérifier les données de l'utilisateur dans la bdd, 
				// démarrer la session et stocker les données dans $_SESSION
				$user->loginUser($_POST); 
				$message = $user->message;
			} else {
				$message = "Un des champs du formulaire n'a pas été correctement rempli";
			}
		} else {
			$message = "Il y a eu une erreur lors de la soumission du formulaire!";
		}
	}

	include "../public/templates/login_tpl.php";
?>