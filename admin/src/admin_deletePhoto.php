<?php
	session_start();

	if( array_key_exists("administrateur", $_SESSION)
    && $_SESSION['administrateur']
    ){
		require "../../classes/Database.class.php";
		require "../../classes/Photo.class.php";

        if (!empty($_POST)
        ){
            if (array_key_exists("file_Id", $_POST)
            && !empty($_POST["file_Id"])
            ){

                var_dump($_POST);

				// $photo = new photo();
				// $photo->deleteUploadPhoto($_POST);
			}
		}
	} else {
        header("location: src/login_admin.php");
    }
?>