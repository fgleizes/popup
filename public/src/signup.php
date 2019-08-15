<?php  
	require "../../classes/Database.class.php";
	require "../../classes/User.class.php";

	if(isset($_POST)){
		if( array_key_exists( "firstname", $_POST )
		&& array_key_exists( "lastname", $_POST )
		&& array_key_exists( "usermail", $_POST )
		&& array_key_exists( "username", $_POST )
		&& array_key_exists( "userpassword", $_POST )
		){
			if( !empty($_POST["firstname"])
			&& !empty($_POST["lastname"])
			&& !empty($_POST["usermail"]) 
			&& !empty($_POST["username"]) 
			&& !empty($_POST["userpassword"]) 
			){
				$infosUser = [
					htmlspecialchars( $_POST["firstname"] ),
					htmlspecialchars( $_POST["lastname"] ),
					htmlspecialchars( $_POST["usermail"] ),
					htmlspecialchars( $_POST["username"] ),
					password_hash( $_POST["userpassword"], PASSWORD_DEFAULT )
				];

				$sql = ( "SELECT Usermail FROM `Users` WHERE Usermail = ?" );

				$database = new database();
				$compareMail = $database->queryOne($sql, [ $_POST["usermail"] ]);

				if ($compareMail) 
				{
					echo "<p>Un utilisateur est déja enregistré avec cette adresse mail : ".$_POST["usermail"]."</p>";
				}
				else
				{
					$user = new user();
					$user->insertUser($infosUser);
				}
			}
			else
			{
				echo "Il y a une erreur de saisie";
			}
		}
	}
	include "../templates/signup_tpl.php";
?>