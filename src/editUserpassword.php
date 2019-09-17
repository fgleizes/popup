<?php  
    session_start();
	
    if (array_key_exists("connected", $_SESSION) 
    && $_SESSION['connected'] 
    && array_key_exists("id", $_SESSION)) {
        require "../classes/Database.class.php";
        require "../classes/User.class.php";
        
        if(!empty($_POST)) {
            if ( array_key_exists("oldUserpassword", $_POST)
            && array_key_exists("newUserpassword", $_POST)
            && array_key_exists("verifNewUserpassword", $_POST)) {
                if (!empty($_POST["oldUserpassword"])
                && !empty($_POST["newUserpassword"])
                && !empty($_POST["verifNewUserpassword"])) {

                    $user = new user();
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
        header("location: login.php");
    }
?>