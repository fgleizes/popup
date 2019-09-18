<?php 
    require "../../classes/Database.class.php";
	require "../../classes/Administrateur.class.php";

	if(!empty($_POST)
	) {
		if(array_key_exists("login_admin", $_POST)
		&& array_key_exists("password_admin", $_POST)
		) {
			if(!empty($_POST["login_admin"]) 
			&& !empty($_POST["password_admin"])
			) {
				$admin = new Administrateur();
				$admin->loginAdmin($_POST);
				$message = $admin->message;
			} else {
				$message = "Un des champs du formulaire n'a pas été correctement rempli";
			}
		} else {
			$message = "Il y a eu une erreur lors de la soumission du formulaire!";
		}
	}

    include "../templates/login_admin_tpl.php"
?>