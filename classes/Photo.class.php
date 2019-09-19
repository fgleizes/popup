<?php  
	// namespace \Classes;

	class Photo
	{
		// Variables
		public $nomImage = '';
		public $extension = '';
		public $infosImage = array();
		public $message = '';
		
		public function uploadPhoto($files)
		{	
			$dossier_traite = '../../files/'.$_SESSION['id'].'_'.strtolower($_SESSION['firstname']).'_'.strtolower($_SESSION['lastname']);    // Repertoire cible
			define('MAX_SIZE', 15728640);   // Taille max en octets du fichier (15728640 octets / 1048576 octets(1Mo) = 15Mo)
			define('WIDTH_MAX', 10000);     // Largeur max de l'image en pixels
			define('HEIGHT_MAX', 10000);    // Hauteur max de l'image en pixels

			// Tableaux de donnees
			$tabExt = array('jpg','jpeg');    // Extensions autorisees

			/************************************************************
			* Creation du repertoire cible si inexistant
			*************************************************************/
			if( !is_dir($dossier_traite) ) {
			  if( !mkdir($dossier_traite, 0705, true) ) {
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
			          	// On protège le nom du fichier temporaire à charger sur le serveur
						$nomImage = htmlspecialchars(basename($files["fichier"]["name"]));

			            // On upload le fichier temporaire
						$upload = move_uploaded_file($files['fichier']['tmp_name'], $dossier_traite."/$nomImage");
						
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

		public function deleteUploadPhoto($infosPhotoToDelete) // suppression de l'upload temporaire
		{
			$dossier_traite = '../../files/'.$_SESSION['id'].'_'.strtolower($_SESSION['firstname']).'_'.strtolower($_SESSION['lastname']);    // Repertoire cible
			
			if( is_dir($dossier_traite) ) {
				$repertoire = opendir($dossier_traite); // On définit le répertoire dans lequel on souhaite travailler.
			}

			/************************************************************
			* Script de suppression de l'upload temporaire
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
			$dossier_traite = '../../files/'.$_SESSION['id'].'_'.strtolower($_SESSION['firstname']).'_'.strtolower($_SESSION['lastname']);    // Repertoire cible
			
			if( is_dir($dossier_traite) ) {
				$repertoire = opendir($dossier_traite); // On définit le répertoire dans lequel on souhaite travailler.
			}
			 
			/******************************************************************
			* Script de validation définitive de l'upload, et changement de nom
			******************************************************************/

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
							/************************************************************************
          					* On renomme le fichier avant de stocker les infos à envoyer vers la BDD'
          					************************************************************************/
							$extension = pathinfo( $dossier_traite.'/'.$nameInitialPhotoToInsert, PATHINFO_EXTENSION);
							$this->nomImage = strtolower($_SESSION["firstname"] . "-" . ($_SESSION["lastname"])) . "-" . uniqid() . "-popup" . '.' . $extension;
							rename ( $dossier_traite.'/'.$nameInitialPhotoToInsert , $dossier_traite.'/'.$this->nomImage );

							$this->infosImage = [  // On stock dans un tableau toutes les infos à envoyer vers la BDD'
								$this->nomImage,
								!empty($photoToValidate->{"description"}) ? $photoToValidate->{"description"} : null, // Pour le moment desciption est désactivée, on retourne null
								$photoToValidate->{"type"},
								$photoToValidate->{"size"},
								$photoToValidate->{"lastModified"},
								$photoToValidate->{"lastModifiedDate"},
								!empty($photoToValidate->{"webkitRelativePath"}) ? $photoToValidate->{"webkitRelativePath"} : null, // Si "webkitRelativePath" est vide, on retourne null
								intval($_SESSION["id"]),
								1, // On définit la catégorie par défaut => id : 1 / En cours de validation
								0 // On définit la visibilité par défaut à 0
							];
						}
					}
				}
			}
			closedir($repertoire);
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


		/***********************************************************************************
		* Suppression d'une photo du serveur par l'admin (par ex, pour photo non appropriée)
		***********************************************************************************/

		public function deletePhotoAdmin($infosPhotoToDelete) // suppression de l'upload définitive par l'admin
		{
			// On verifie si la variable existe et si elle contient des informations.
			if(isset($infosPhotoToDelete)
			){
				if(!empty($infosPhotoToDelete)
				){
					if(!empty($infosPhotoToDelete['user_Id'])
					&& !empty($infosPhotoToDelete['Firstname'])
					&& !empty($infosPhotoToDelete['Lastname'])
					){
						$dossier_traite = '../../files/'.$infosPhotoToDelete['user_Id'].'_'.strtolower($infosPhotoToDelete['Firstname']).'_'.strtolower($infosPhotoToDelete['Lastname']);    // Repertoire cible

						if( is_dir($dossier_traite) ) {
							$repertoire = opendir($dossier_traite); // On définit le répertoire dans lequel on souhaite travailler.
							
							/************************************************************
							 * Script de suppression
							*************************************************************/
							
							// On verifie si le champ fileName est rempli
							if( !empty($infosPhotoToDelete['name']) )
							{
								$photoToDelete = $infosPhotoToDelete['name'];
								
								if(file_exists( $dossier_traite.'/'.$photoToDelete ) // On vérifie que le dossier traité et le fichier existe,
								&& is_file( $dossier_traite.'/'.$photoToDelete ) ) // et qu'il s'agit bien d'un fichier.
								{
									$chemin = $dossier_traite."/".$photoToDelete; // On définit le chemin du fichier à effacer.
									
									unlink($chemin); // On efface.
								}
							}
							closedir($repertoire); // On referme le répertoire dans lequel on vient de travailler.
						}
					}
				}
			}
		}

		public function updateDeletedPhotoToBdd($photo_Id) {
			// On prépare la requête SQL de modification de données
			$sqlEdit = 
				"UPDATE `Photos` 
				SET `category_Id` = 0
				WHERE `Photos`.`id` = ?"  
			;
			// On ne supprime pas les données de la bdd, mais on passe la catégorie à 0 pour indiquer que le fichier a été supprimé du serveur
			
			$database = new Database();
			$database->executeSql($sqlEdit, [ $photo_Id ]);
		}
	}
?>