<?php 
    session_start();

    if (array_key_exists("administrateur", $_SESSION) 
    && $_SESSION['admin_connected']
    ){
        require "../classes/Database.class.php";

        $sql = ( 
            "SELECT Photos.id, Photos.name, Photos.description, Photos.creationTimestamp,
                    Photos.visibility, Photos.user_Id, Users.Firstname, Users.Lastname
            FROM `Photos`
            JOIN Users ON Users.Id = Photos.user_Id
            WHERE Photos.category_Id = ?" 
        );

        $database = new database();
        $photos = $database->query($sql, [ 1 ]);

        include "templates/index_tpl.php";
    } else {
        header("location: src/login_admin.php");
    }
?>