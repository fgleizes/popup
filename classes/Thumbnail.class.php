<?php  
	// namespace \Classes;

	class Thumbnail
	{
		// Variables
		public $thumbnails = array();
		
		public function createThumbnails($infosPhoto) 
		{
			define('TARGET', '../../files/'.$infosPhoto["user_Id"].'_'.strtolower($infosPhoto['Firstname']).'_'.strtolower($infosPhoto['Lastname']));    // Repertoire cible concernant l'utilisateur

			$dossier_thumbnails = TARGET.'/thumbs//'; 
			 
			/************************************************************
			* Creation du repertoire cible si inexistant
			*************************************************************/
			if( !is_dir($dossier_thumbnails) ) {
			  if( !mkdir($dossier_thumbnails, 0755) ) {
			    exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
			  }
			}

			/* read the source image */
			$src = TARGET.'/'.$infosPhoto["name"];
			$source_image = imagecreatefromjpeg($src);
			$width = imagesx($source_image);
			$height = imagesy($source_image);

			$desired_width = [150, 300, 500, 768, 1024];

			for ($i=0; $i < sizeof($desired_width) ; $i++) { 
				/* find the "desired height" of this thumbnail, relative to the desired width  */
				$desired_height = floor($height * ($desired_width[$i] / $width));
				
				/* create a new, "virtual" image */
				$virtual_image = imagecreatetruecolor($desired_width[$i], $desired_height);
				
				/* copy source image at a resized size */
				imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width[$i], $desired_height, $width, $height);

				$thumbnailName = 'thumb-'.$desired_width[$i]."w-".$infosPhoto["name"];
				$this->thumbnails[] = $thumbnailName;
				$dest = $dossier_thumbnails.$thumbnailName;

				/* create the physical thumbnail image to its destination */
				imagejpeg($virtual_image, $dest);
			}
		}

		public function insertThumbnailsToBdd($photo_Id, $thumbnailsToInsert) {
			// On prépare la requête SQL d'insertion de données
			$sql = 
				"INSERT INTO `Thumbnails`(`id`, `150w`, `300w`, `500w`, `768w`, `1024w`, `creationTimestamp`, `photo_Id`)
				VALUES ( null, ?, ?, ?, ?, ?, NOW(), ? )"
			;

			$database = new Database();
			$database->executeSql($sql, [
				$thumbnailsToInsert[0],
				$thumbnailsToInsert[1],
				$thumbnailsToInsert[2],
				$thumbnailsToInsert[3],
				$thumbnailsToInsert[4],
				$photo_Id
			]);
		}
	}
?>