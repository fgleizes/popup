<?php 
	require "../../../classes/Database.class.php";
	require "../../../classes/Photo.class.php";

	session_start();

	if (isset($_SESSION)) {
		if( array_key_exists("connected", $_SESSION) 
		&& $_SESSION['connected']){
			if (isset($_POST)) {
				if (!empty($_POST)) {
					$photo = new photo();
					$photo->deleteUploadPhoto($_POST);
				}
			}
		}
	}
?>