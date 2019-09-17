<?php 
	session_start();

	if( array_key_exists("connected", $_SESSION) 
	&& $_SESSION['connected']){
		require "../../classes/Database.class.php";
		require "../../classes/Photo.class.php";

		if (isset($_POST)) {
			if (!empty($_POST)) {
				$photo = new photo();
				$photo->deleteUploadPhoto($_POST);
			}
		}
	} else {
		header("location: ../login.php");
	}
?>