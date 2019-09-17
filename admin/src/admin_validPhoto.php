<?php 
    session_start();
    date_default_timezone_set("Europe/Paris");

    if( array_key_exists("administrateur", $_SESSION)
    && $_SESSION['administrateur']){
        require "../../classes/Database.class.php";

        if (!empty($_GET)) {
            if ( array_key_exists("photo_id", $_GET)
            && !empty($_GET["photo_id"])) {
                $photo_Id = $_GET["photo_id"];
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
                        // $fileLastModifiedDate = filemtime( $dossier_traite.'/'.$photo["name"] );
                    }
                }
                $sql2 = "SELECT * FROM `Category` WHERE Category.id != 1";
                $categories = $database->query($sql2);
            }
        }
        include "../templates/admin_validPhoto_tpl.php";
    } else {
        header("location: src/login_admin.php");
    }
?>