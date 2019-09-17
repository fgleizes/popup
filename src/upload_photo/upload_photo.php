<?php 
	session_start();

	if(array_key_exists("connected", $_SESSION) 
	&& $_SESSION['connected']) {
		require "../../classes/Database.class.php";
		require "../../classes/Photo.class.php";

		if (isset($_FILES)) {
			if (!empty($_FILES)) {
				$photo = new photo();
				$photo->uploadPhoto($_FILES);
				echo $photo->message;
			}
		}
	} else {
		header("location: ../login.php");
	}
?>