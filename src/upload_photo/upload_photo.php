<?php 
	session_start();

	// On vérifie que l'utilisateur qui essaye d'uploader une photo est bien connecté à la $_SESSION
	if(array_key_exists("connected", $_SESSION) 
	&& $_SESSION['connected']
	){
		require "../../classes/Database.class.php";
		require "../../classes/Photo.class.php";

		// On vérifie que la variable globale $_FILES existe
		if (isset($_FILES)
		){	// et qu'elle n'est pas vide
			if (!empty($_FILES)
			){	// On instancie la class Photo
				$photo = new photo();
				// On utilise la méthode uploadPhoto pour charger temporairement la photo de l'utilisateur sur le serveur
				$photo->uploadPhoto($_FILES);
				echo $photo->message;
			}
		}
	} else {
		// Si l'utilisateur n'est pas connecté à la session, on le renvoie vers la page login.php
		header("location: ../login.php");
	}
?>