<?php 
	session_start();
	
	// On vérifie que l'utilisateur qui essaye de valider l'upload d'une photo temporaire est bien connecté à la $_SESSION
	if(array_key_exists("connected", $_SESSION) 
	&& $_SESSION['connected']
	){
		require "../../classes/Database.class.php";
		require "../../classes/Photo.class.php";

		// On vérifie que la validation de la photo temporaire, envoyée par xhr a bien fonctionné
		if (isset($_POST)
		){	// On vérifie que post n'est pas vide
			if(!empty($_POST)
			){	// on decode les informations json envoyées lors de la validation
				$_POST = json_decode($_POST["json_upload"]);
				// On instancie la class Photo
				$photo = new photo();
				// On utilise la méthode validateUpload pour changer le nom et valider la photo définitive sur le serveur
				$photo->validateUpload($_POST);
				// On utilise la méthode insertPhotoBdd pour envoyer les informations de la photo définitive sur la bdd
				$photo->insertPhotoBdd($photo->infosImage);
			}
		}
	} else {
		// Si l'utilisateur n'est pas connecté à la session
		echo "Vous n'êtes plus connecté, reconnectez-vous pour uploader vos photos";
	}
?>