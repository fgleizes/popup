<?php 
    require "../../classes/Database.class.php";
	require "../../classes/User.class.php";

    session_start();
    
    if (isset($_SESSION)) {
        if( array_key_exists("connected", $_SESSION) 
        // && array_key_exists("status", $_SESSION) 
        // && $_SESSION['status'] === "admin"
        && $_SESSION['connected']){
            $sql = ( 
                "SELECT Photos.id, Photos.name, Photos.description, Photos.creationTimestamp,
                        Photos.visibility, Photos.user_Id, Users.Firstname, Users.Lastname
                FROM `Photos`
                JOIN Users ON Users.Id = Photos.user_Id
                WHERE Photos.category_Id = ?" 
            );

            $database = new database();
            $photos = $database->query($sql, [ 1 ]);

            include "../templates/admin_tpl.php";
        }
    }
?>