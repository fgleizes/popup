<?php  
	// namespace \Classes;

	class Photo
	{
		// Variables
		public $nomImage = '';
		public $extension = '';
		// public $infosImg = '';
		public $infosImage = array();
		// public $thumbnails = array();
		public $message = '';

		// public $pageCourante;
		// public $pagesTotales;
		// public $photos;
		
		public function uploadPhoto($files)
		{	
			define('TARGET', '../../../files/'.$_SESSION['id'].'_'.strtolower($_SESSION['firstname']).'_'.strtolower($_SESSION['lastname']));    // Repertoire cible
			define('MAX_SIZE', 15728640);   // Taille max en octets du fichier (15728640 octets / 1048576 octets(=>1Mo) = 15Mo)
			define('WIDTH_MAX', 10000);     // Largeur max de l'image en pixels
			define('HEIGHT_MAX', 10000);    // Hauteur max de l'image en pixels

			// Tableaux de donnees
			$tabExt = array('jpg','jpeg');    // Extensions autorisees
			// $infosImg = array();
			 
			/************************************************************
			* Creation du repertoire cible si inexistant
			*************************************************************/
			if( !is_dir(TARGET) ) {
			  if( !mkdir(TARGET, 0755, true) ) {
			    exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
			  }
			}
			 
			/************************************************************
			* Script d'upload
			*************************************************************/

			if(!empty($files))
			{
			  // On verifie si le champ est rempli
			  if( !empty($files['fichier']['name']) )
			  {
			    // Recuperation de l'extension du fichier
			    $extension = pathinfo($files['fichier']['name'], PATHINFO_EXTENSION);
			 
			    // On verifie l'extension du fichier
			    if(in_array(strtolower($extension),$tabExt))
			    {
			      // On recupere les dimensions du fichier
			     $infosImg = getimagesize($files['fichier']['tmp_name']);
			 
			      // On verifie le type de l'image
			      if($infosImg[2] == 2) //(2 = jpeg)
			      {
			        // On verifie les dimensions et taille de l'image
			        if(filesize($files['fichier']['tmp_name']) <= MAX_SIZE /* && ($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX)*/)
			        {
			          // Parcours du tableau d'erreurs
			          if(isset($files['fichier']['error']) 
			            && UPLOAD_ERR_OK === $files['fichier']['error'])
			          {
			          	// On protège le nom du fichier à charger sur le serveur
						$nomImage = htmlspecialchars(basename($files["fichier"]["name"]));

			            // On upload le fichier
						$upload = move_uploaded_file($files['fichier']['tmp_name'], TARGET."/$nomImage");

						/************************************************************************************************************************
          				* On renomme le fichier (A FAIRE QUAND L'UTILISATER VALIDE LE FORMULAIRE D'UPLOAD, AVANT DE L'ENVOYER VERS LA BDD!!!!!!!!)
          				*************************************************************************************************************************/

			            // $nomImage = md5(uniqid()) .'.'. $extension;
			            // 
			            // ou
			            // 
			            // $nomImage = $_SESSION["firstName"] . "-" . $_SESSION["name"] . "-" . uniqid() . "-popup" . '.' . $extension;
						
			            //On teste l'upload
			            if($upload)
			            {
							// l'upload est réussi
							// $this->message = 'Upload réussi !';
						}
			            else
			            {
						  // Si l'upload n'a pas réussi, on affiche une erreur systeme
						  $this->message = 'Problème lors de l\'upload !';

			            }
			          }
			          else
			          {
			            $this->message = 'Une erreur interne a empêché l\'upload de l\'image';
			          }
			        }
			        else
			        {
			          // Sinon erreur sur les dimensions et taille de l'image
			          $this->message = 'La photo chargée est trop volumineuse!' ."\n". '(maximum autorisé : ' . MAX_SIZE / 1048576 . ' Mo.)' /*'Erreur dans les dimensions ou le poids de l\'image!'*/ ;
			        }
			      }
			      else
			      {
			        // Sinon erreur sur le type de l'image
			        $this->message = 'Le fichier à uploader n\'est pas une image !';
			      }
			    }
			    else
			    {
			      // Sinon on affiche une erreur pour l'extension
			      $this->message = 'L\'extension du fichier est incorrecte !';
			    }
			  }
			  else
			  {
			    // Sinon on affiche une erreur pour le champ vide
			    $this->message = 'Veuillez remplir le formulaire svp !';
			  }
			}
		}

		public function deleteUploadPhoto($infosPhotoToDelete)
		{	
			define('TARGET', '../../../files/'.$_SESSION['id'].'_'.strtolower($_SESSION['firstname']).'_'.strtolower($_SESSION['lastname']));    // Repertoire cible
			
			if( is_dir(TARGET) ) {
				$dossier_traite = TARGET; 
				$repertoire = opendir($dossier_traite); // On définit le répertoire dans lequel on souhaite travailler.
			}

			/************************************************************
			* Script de suppression
			*************************************************************/

			// On verifie si la variable existe et si elle contient des informations.
			if(isset($infosPhotoToDelete))
			{
				if(!empty($infosPhotoToDelete))
				{
					// On verifie si le champ fileName est rempli
					if( !empty($infosPhotoToDelete['fileName']) )
					{
						$photoToDelete = htmlspecialchars(basename($infosPhotoToDelete['fileName'])); // On protège le nom du fichier (envoyé par l'utilisateur) à supprimer sur le serveur

						if( file_exists( $dossier_traite.'/'.$photoToDelete ) // On vérifie que le dossier traité et le fichier existe,
						&& is_file( $dossier_traite.'/'.$photoToDelete ) ) // et qu'il s'agit bien d'un fichier.
						{
							$chemin = $dossier_traite."/".$photoToDelete; // On définit le chemin du fichier à effacer.

							unlink($chemin); // On efface.
						}
					}
				}
			}
			closedir($repertoire); // On referme le répertoire dans lequel on vient de travailler.
		}

		public function validateUpload($photoToValidate)
		{	
			define('TARGET', '../../../files/'.$_SESSION['id'].'_'.strtolower($_SESSION['firstname']).'_'.strtolower($_SESSION['lastname']));    // Repertoire cible
			
			if( is_dir(TARGET) ) {
				$dossier_traite = TARGET; 
				$repertoire = opendir($dossier_traite); // On définit le répertoire dans lequel on souhaite travailler.
			}
			 
			/************************************************************
			* Script de validation définitive de l'upload, et changement de nom
			*************************************************************/
			// var_dump($photoToValidate);

			if(!empty($photoToValidate))
			{	
				if( array_key_exists("name", $photoToValidate)
				&& array_key_exists( "description", $photoToValidate )
				&& array_key_exists( "type", $photoToValidate )
				&& array_key_exists( "size", $photoToValidate )
				&& array_key_exists( "lastModified", $photoToValidate )
				&& array_key_exists( "lastModifiedDate", $photoToValidate )
				&& array_key_exists( "webkitRelativePath", $photoToValidate )
				){
					if( !empty($photoToValidate->{"name"})
					&& !empty($photoToValidate->{"type"}) 
					&& !empty($photoToValidate->{"size"}) 
					&& !empty($photoToValidate->{"lastModified"}) 
					&& !empty($photoToValidate->{"lastModifiedDate"})
					){
						$nameInitialPhotoToInsert = htmlspecialchars(basename($photoToValidate->{"name"})); // On protège le nom du fichier à renommer sur le serveur

						if (file_exists( $dossier_traite.'/'.$nameInitialPhotoToInsert ) // On vérifie que le fichier existe dans le répertoire traité, 
						&& is_file( $dossier_traite.'/'.$nameInitialPhotoToInsert ) ) // et qu'il s'agit bien d'un fichier
						{
							// On renomme le fichier avant de stocker les infos à envoyer vers la BDD'
							$extension = pathinfo( $dossier_traite.'/'.$nameInitialPhotoToInsert, PATHINFO_EXTENSION);
							$this->nomImage = strtolower($_SESSION["firstname"] . "-" . ($_SESSION["lastname"])) . "-" . uniqid() . "-popup" . '.' . $extension;
							rename ( $dossier_traite.'/'.$nameInitialPhotoToInsert , $dossier_traite.'/'.$this->nomImage );
							
						}
						// $infosPhoto = [  // On stock toutes les infos dans un tableau
						$this->infosImage = [  // On stock toutes les infos à envoyer vers la BDD' dans un tableau
							$this->nomImage,
							// $photoToValidate->{"name"},
							!empty($photoToValidate->{"description"}) ? $photoToValidate->{"description"} : null,
							$photoToValidate->{"type"},
							$photoToValidate->{"size"},
							$photoToValidate->{"lastModified"},
							$photoToValidate->{"lastModifiedDate"},
							!empty($photoToValidate->{"webkitRelativePath"}) ? $photoToValidate->{"webkitRelativePath"} : null,
							intval($_SESSION["id"]),
							1, // On définit la catégorie par défaut => id : 1 / En cours de validation
							0 // On définit la visibilité par défaut à 0
						];
					}
				}
				closedir($repertoire);
			}
		}
		
		public function insertPhotoBdd($infosPhotoToInsert) {
			// On prépare la requête SQL d'insertion de données
			$sql = 
				"INSERT INTO `Photos`(`id`, `name`, `description`, `type`, `size`, `lastModified`, `lastModifiedDate`,
				`webkitRelativePath`, `creationTimestamp`, `publishDate`, `user_Id`, `category_Id`, `visibility`)
				VALUES ( null, ?, ?, ?, ?, ?, ?, ?, NOW(), null, ?, ?, ? )"
			;

			$database = new Database();
			$database->executeSql($sql, $infosPhotoToInsert);
		}

		public function updateValidatedPhotoToBdd($photo_Id, $category_Id, $publishDate) {
			// On prépare la requête SQL de modification de données
			$sqlEdit = 
				"UPDATE `Photos` 
				SET `publishDate` = ?, `category_Id` = ?, `visibility` = '1' 
				WHERE `Photos`.`id` = ?"
			;
			$database = new Database();
			$database->executeSql($sqlEdit, [ $publishDate, $category_Id, $photo_Id ]);
		}

		// public function displayPhotos(){
		// 	$photosParPage = 6; // nombre de photos à afficher par pages
			
		// 	$database = new database();
		// 	$sqlPhotosTotales = "SELECT id FROM `Photos` WHERE `Photos`.`visibility` = 1 AND `Photos`.`publishDate` <= NOW()";
		// 	$photosTotales = sizeof($database->query($sqlPhotosTotales)); // nombre total de photos à afficher
		// 	$pagesTotales = ceil($photosTotales / $photosParPage); // nombre total de pages
			
		// 	if ( isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 ) {
		// 		$_GET['page'] = intval($_GET['page']);
		// 		$pageCourante = $_GET['page'];
		// 	} else {
		// 		$pageCourante = 1;
		// 	}

		// 	$depart = ($pageCourante - 1) * $photosParPage;

		// 	$sqlPhotos = 
		// 		"SELECT Photos.id, Photos.name, Photos.description, Photos.size, Photos.category_Id,
		// 				Photos.creationTimestamp, Photos.lastModified, Photos.lastModifiedDate, Photos.publishDate,
		// 				Thumbnails.150w, Thumbnails.300w, Thumbnails.500w, Thumbnails.768w, Thumbnails.1024w, 
		// 				Photos.user_Id, Users.Firstname, Users.Lastname, Users.Username
		// 		FROM `Photos`
		// 		JOIN Users ON Users.Id = Photos.user_Id
		// 		JOIN Thumbnails ON Photos.Id = Thumbnails.photo_Id
		// 		JOIN Category ON Photos.category_Id = Category.id
		// 		WHERE `Photos`.`visibility` = 1 AND `Photos`.`publishDate` <= NOW()
		// 		ORDER BY `Photos`.`publishDate` DESC
		// 		LIMIT $depart,$photosParPage"
		// 	;
		// 	$photos = $database->query($sqlPhotos);
		// }



		
		// public function createThumbnails($nomImage) {

		// 	define('TARGET', '../../../files/'.$_SESSION['id'].'_'.strtolower($_SESSION['firstname']).'_'.strtolower($_SESSION['lastname']));    // Repertoire cible concernant l'utilisateur

		// 	$dossier_thumbnails = TARGET.'/thumbs//'; 
			 
		// 	/************************************************************
		// 	* Creation du repertoire cible si inexistant
		// 	*************************************************************/
		// 	if( !is_dir($dossier_thumbnails) ) {
		// 	  if( !mkdir($dossier_thumbnails, 0755) ) {
		// 	    exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
		// 	  }
		// 	}

		// 	/* read the source image */
		// 	$src = TARGET.'/'.$nomImage;
		// 	$source_image = imagecreatefromjpeg($src);
		// 	$width = imagesx($source_image);
		// 	$height = imagesy($source_image);

		// 	// $desired_width = [100, 200, 300, 400, 500, 600, 700, 800 ,900 , 1000, 1100, 1200, 1296, 1400, 1600, 1800, 2000, 2200, 2400, 2592];
		// 	$desired_width = [150, 300, 500, 768, 1024/*, 1508*/];
		// 	// $desired_width = [1024];
		// 	// $desired_width = [500, 768];
		// 	// $desired_width = [464, 752];

		// 	for ($i=0; $i < sizeof($desired_width) ; $i++) { 
				
		// 		/* find the "desired height" of this thumbnail, relative to the desired width  */
		// 		$desired_height = floor($height * ($desired_width[$i] / $width));
				
		// 		/* create a new, "virtual" image */
		// 		$virtual_image = imagecreatetruecolor($desired_width[$i], $desired_height);
				
		// 		/* copy source image at a resized size */
		// 		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width[$i], $desired_height, $width, $height);

		// 		$thumbnailName = 'thumb-'.$desired_width[$i]."w-".$nomImage;
		// 		$this->thumbnails[] = $thumbnailName;
		// 		$dest = $dossier_thumbnails.$thumbnailName;

		// 		/* create the physical thumbnail image to its destination */
		// 		imagejpeg($virtual_image, $dest);
		// 	}


		// 	// /* find the "desired height" of this thumbnail, relative to the desired width  */
		// 	// $desired_height_thumb = floor($height * (150 / $width));
		// 	// $desired_height_small = floor($height * (300 / $width));
		// 	// $desired_height_medium = floor($height * (500 / $width));
		// 	// $desired_height_medium_large = floor($height * (768 / $width));
		// 	// $desired_height_large = floor($height * (1024 / $width));
			
		// 	// /* create a new, "virtual" image */
		// 	// $virtual_image_thumb = imagecreatetruecolor(150, $desired_height_thumb);
		// 	// $virtual_image_small = imagecreatetruecolor(300, $desired_height_small);
		// 	// $virtual_image_medium = imagecreatetruecolor(500, $desired_height_medium);
		// 	// $virtual_image_medium_large = imagecreatetruecolor(768, $desired_height_medium_large);
		// 	// $virtual_image_large = imagecreatetruecolor(1024, $desired_height_large);
			
		// 	// /* copy source image at a resized size */
		// 	// imagecopyresampled($virtual_image_thumb, $source_image, 0, 0, 0, 0, 150, $desired_height_thumb, $width, $height);
		// 	// imagecopyresampled($virtual_image_small, $source_image, 0, 0, 0, 0, 300, $desired_height_small, $width, $height);
		// 	// imagecopyresampled($virtual_image_medium, $source_image, 0, 0, 0, 0, 500, $desired_height_medium, $width, $height);
		// 	// imagecopyresampled($virtual_image_medium_large, $source_image, 0, 0, 0, 0, 768, $desired_height_medium_large, $width, $height);
		// 	// imagecopyresampled($virtual_image_large, $source_image, 0, 0, 0, 0, 1024, $desired_height_large, $width, $height);

		// 	// $thumbnailName_thumb = 'thumb-'.$nomImage;
		// 	// $thumbnailName_small = 'small-'.$nomImage;
		// 	// $thumbnailName_medium = 'medium-'.$nomImage;
		// 	// $thumbnailName_medium_large = 'medium_large-'.$nomImage;
		// 	// $thumbnailName_large = 'large-'.$nomImage;

		// 	// // $this->thumbnails[] = $thumbnailName;

		// 	// $dest_thumb = $dossier_thumbnails.$thumbnailName_thumb;
		// 	// $dest_small = $dossier_thumbnails.$thumbnailName_small;
		// 	// $dest_medium = $dossier_thumbnails.$thumbnailName_medium;
		// 	// $dest_medium_large = $dossier_thumbnails.$thumbnailName_medium_large;
		// 	// $dest_large = $dossier_thumbnails.$thumbnailName_large;

		// 	// /* create the physical thumbnail image to its destination */
		// 	// imagejpeg($virtual_image_thumb, $dest_thumb);
		// 	// imagejpeg($virtual_image_small, $dest_small);
		// 	// imagejpeg($virtual_image_medium, $dest_medium);
		// 	// imagejpeg($virtual_image_thumb, $dest_medium_large);
		// 	// imagejpeg($virtual_image_thumb, $dest_large);
		// }
	}
?>