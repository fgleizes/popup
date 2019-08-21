<?php
    require "../../classes/Database.class.php";
	require "../../classes/Photo.class.php";
	require "../../classes/Thumbnail.class.php";

	if ( isset( $_POST ) 
	&& isset( $_GET )
	){
		// FORMULAIRE DE VALIDATION D'UNE PHOTO
		if ( array_key_exists( "photo_Id", $_GET )
		&& array_key_exists( "category_Id", $_POST )
		&& array_key_exists( "publishChoice", $_POST )
		){
			$photo_Id = $_GET["photo_Id"];
            $category_Id = $_POST["category_Id"];
			$publishChoice = $_POST["publishChoice"];

			/**** CREATION DES MINIATURES, A PARTIR DES INFOS DE LA BASE DE DONNEES ****/
			if( !empty($photo_Id)
			&& !empty($category_Id)
			&& !empty($publishChoice)
			){	
				$sql = 
					"SELECT Photos.id, Photos.name, Photos.user_Id, Users.Firstname, Users.Lastname
					FROM `Photos`
					JOIN `Users` ON Users.Id = Photos.user_Id
					WHERE Photos.id = ?" 
				;
				$database = new database();
				$infosPhotoDb = $database->queryOne($sql, [ $photo_Id ]);

				$thumb = new thumbnail();
				// ini_set('memory_limit', '-1');
				$thumb->createThumbnails($infosPhotoDb);

				/**** INSERTION DES NOMS DES MINIATURES DANS LA BASE DE DONNEES ****/
				$thumb->insertThumbnailsToBdd($photo_Id, $thumb->thumbnails);
				
				/**** UPDATE DE LA PHOTO VALIDEE DANS LA BASE DE DONNEES ****/	
				if ( $publishChoice === "planifier"
				&& array_key_exists( "publishDate", $_POST )
				&& array_key_exists( "heures", $_POST )
				&& array_key_exists( "minutes", $_POST ) 
				&& !empty($_POST["publishDate"])
				){
					if ( !empty($_POST["heures"]) && !empty($_POST["minutes"]) 
					){
						$publishDate = $_POST["publishDate"] . " " . $_POST["heures"] . ":" . $_POST["minutes"] . ":00";
					} 
					elseif ( !empty($_POST["heures"]) && empty($_POST["minutes"]) 
					){
						$publishDate = $_POST["publishDate"] . " " . $_POST["heures"] . ":00:00";
					} 
					elseif ( empty($_POST["heures"]) && !empty($_POST["minutes"]) 
					){
						$publishDate = $_POST["publishDate"] . " 00:" . $_POST["minutes"] . ":00";
					} 
					else 
					{
						$publishDate = $_POST["publishDate"];
					}
				} 
				elseif ( $publishChoice === "now" ) 
				{
					$publishDate = date("Y-m-d H:i:s");
				}

				$photo = new photo();
				$photo->updateValidatedPhotoToBdd($photo_Id, $category_Id, $publishDate);
				header("location: admin.php");

			}else{
				header("refresh: 0.001; " . $_SERVER['HTTP_REFERER']);
				$message = "Il y a une erreur de saisie";
			}
		}else{
			header("refresh: 0.001; " . $_SERVER['HTTP_REFERER']);
			$message = "Les champs n'ont pas été rempli";
		}
	}else{
		header("refresh: 0.001; " . $_SERVER['HTTP_REFERER']);
		$message = "Il y a eu une erreur lors de la soumission du formulaire";
	}

	if ( isset( $message )
	&& !empty( $message ) ){
		echo "<script>alert('" . $message . "')</script>";
		echo $message;
	}
?>