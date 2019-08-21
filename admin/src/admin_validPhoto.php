<?php 
    require "../../classes/Database.class.php";
	// require "../../classes/User.class.php";

    session_start();

    if (isset($_SESSION)) {
        if( array_key_exists("administrateur", $_SESSION)
        && $_SESSION['administrateur']){
            if (isset($_GET)) {
                if ( array_key_exists("photo_id", $_GET) ){
                    $photo_Id = $_GET["photo_id"];
                    if (!empty($photo_Id)) 
                    {    
                        $sql = 
                            "SELECT Photos.id, Photos.name, Photos.description, Photos.type, Photos.size,
                                    Photos.creationTimestamp, Photos.lastModified, Photos.lastModifiedDate,
                                    Photos.user_Id, Users.Firstname, Users.Lastname, Users.Username, Users.Usermail, Users.CreationTimestamp
                            FROM `Photos`
                            JOIN Users ON Users.Id = Photos.user_Id
                            WHERE Photos.id = ?" 
                        ;
                        $database = new database();
                        $photo = $database->queryOne($sql, [ $photo_Id ]);
            
                        // On verifie si le nom est renseigné
                        if( !empty($photo["name"]) )
                        {
                            $dossier_traite = '../../files/'.$photo['user_Id'].'_'.strtolower($photo['Firstname']).'_'.strtolower($photo['Lastname']);
                                 
                            $repertoire = opendir($dossier_traite); // On définit le répertoire dans lequel on souhaite travailler.
            
                            if (file_exists( $dossier_traite.'/'.$photo["name"] ) && is_file( $dossier_traite.'/'.$photo["name"] ) ) {
                                $fileSize = getimagesize( $dossier_traite.'/'.$photo["name"] );
                                $fileLastModifiedDate = filemtime( $dossier_traite.'/'.$photo["name"] );
                            }
                        }
                        $sql2 = "SELECT * FROM `Category` WHERE Category.id != 1";
                        $categories = $database->query($sql2);
                    }
                }
            }
            include "../templates/admin_validPhoto_tpl.php";
        }
    }
?>