<?php 
	session_start();

	// On vérifie que l'utilisateur qui essaye de supprimer une photo temporaire est bien connecté à la $_SESSION
	if(array_key_exists("connected", $_SESSION) 
	&& $_SESSION['connected']
	){
		require "../../classes/Database.class.php";
		require "../../classes/Photo.class.php";

		// On vérifie que la méthode post envoyée par xhr a bien fonctionné
		if (isset($_POST)
		){	// et qu'elle n'est pas vide. ()
			if (!empty($_POST)
			){	// On instancie la class Photo
				$photo = new photo();
				// On utilise la méthode deleteUploadPhoto pour supprimer la photo temporaire de l'utilisateur du serveur
				$photo->deleteUploadPhoto($_POST);
			}
		}
	} else {
		// Si l'utilisateur n'est pas connecté à la session, on le renvoie vers la page login.php
		header("location: ../login.php");
	}
?>