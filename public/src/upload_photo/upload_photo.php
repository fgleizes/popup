<?php 
	require "../../../classes/Database.class.php";
	require "../../../classes/Photo.class.php";

	session_start();
	
	if (isset($_SESSION)) {
		if( array_key_exists("connected", $_SESSION) 
		&& $_SESSION['connected']){
			if (isset($_FILES)) {
				if (!empty($_FILES)) {
					$photo = new photo();
					$photo->uploadPhoto($_FILES);
					echo $photo->message;
				}
			}
		}
	}
?>