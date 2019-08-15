<?php 
	require "../../../classes/Database.class.php";
	require "../../../classes/Photo.class.php";
	// require "../../../classes/Thumbnail.class.php";

	session_start();
	
	if (isset($_SESSION)) {
		if( array_key_exists("connected", $_SESSION) 
		&& $_SESSION['connected']){
			if (isset($_POST)) {
				if(!empty($_POST)){	
					$_POST = json_decode($_POST["json_upload"]);

					$photo = new photo();
					$photo->validateUpload($_POST);
					
					// ini_set('memory_limit', '-1');
					// $photo->createThumbnails($photo->nomImage);
					// var_dump($photo->tumbnails);

					$photo->insertPhotoBdd($photo->infosImage);
				}
			}
		}
	}
?>