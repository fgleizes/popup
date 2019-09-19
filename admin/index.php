<?php 
    session_start();

    // On vérifie que l'utilisateur qui essaye d'atteindre l'admin est connecté à la $_SESSION en tant qu'administrateur
    if (array_key_exists("administrateur", $_SESSION) 
    && $_SESSION['admin_connected']
    ){
        require "../classes/Database.class.php";

        // On récupère les photos soumisent par les utilisateurs, à valider et classifier par l'administrateur, et on affiche la liste
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
        // Si l'utilisateur n'est pas connecté à la session en tant qu'administrateur, on le renvoie vers la page login.php
        header("location: src/login_admin.php");
    }
?>