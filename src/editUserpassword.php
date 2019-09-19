<?php  
    session_start();
    
    // On vérifie que l'utilisateur qui essaye d'atteindre la page d'édition du mot de passe est bien connecté à la $_SESSION
    if (array_key_exists("connected", $_SESSION) 
    && $_SESSION['connected'] 
    && array_key_exists("id", $_SESSION)) {
        require "../classes/Database.class.php";
        require "../classes/User.class.php";
        
        // On vérifie si l'utilisateur à soumis le formulaire d'édition du profil
        if(!empty($_POST)
        ){  // On vérifie que les index existent
            if ( array_key_exists("oldUserpassword", $_POST)
            && array_key_exists("newUserpassword", $_POST)
            && array_key_exists("verifNewUserpassword", $_POST)
            ){  // On vérifie que tous les champs soient rempli
                if (!empty($_POST["oldUserpassword"])
                && !empty($_POST["newUserpassword"])
                && !empty($_POST["verifNewUserpassword"])
                ){  // On instancie la class User
                    $user = new user();
                    // On utilise la méthode editUserPassword pour modifier le mot de passe de l'utilisateur dans la bdd
                    $user->editUserPassword($_POST);
                    $message = $user->message;
                } else {
                    $message = "Un des champs du formulaire n'a pas été correctement rempli";
                }
            } else {
                $message = "Il y a une erreur de saisie";
            }
        }

        include "../public/templates/editUserpassword_tpl.php";
    } else {
        // Si l'utilisateur n'est pas connecté à la session, on le renvoie vers la page login.php
        header("location: login.php");
    }
?>