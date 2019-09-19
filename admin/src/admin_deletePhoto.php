<?php
	session_start();

	if( array_key_exists("administrateur", $_SESSION)
    && $_SESSION['admin_connected']
    ){
		require "../../classes/Database.class.php";
		require "../../classes/Photo.class.php";

        if (!empty($_POST)
        ){
            if (array_key_exists("photo_Id", $_POST)
            && !empty($_POST["photo_Id"])
            ){
                $photo_Id = $_POST["photo_Id"];

                $sql = 
                    "SELECT Photos.id, Photos.name, Photos.user_Id, Users.Firstname, Users.Lastname
                    FROM `Photos`
                    JOIN Users ON Users.Id = Photos.user_Id
                    WHERE Photos.id = ?" 
                ;
                $database = new database();
                $infosPhotoToDelete = $database->queryOne($sql, [ $photo_Id ]);

                $photoToDelete = new Photo();
                $photoToDelete->deletePhotoAdmin($infosPhotoToDelete);
                $photoToDelete->updateDeletedPhotoToBdd($photo_Id);

                echo "La photo a été supprimée du serveur";
			} else {
                echo "Il y a eu une erreur lors de la soumission du formulaire"; 
            }
		} else {
            echo "Il y a eu une erreur";            
        }
	} else {
        echo "(Re)connectez-vous en tant qu'administrateur pour supprimer ou valider une photo!";
	}
?>