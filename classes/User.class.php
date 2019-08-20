<?php
	// require "../../classes/Database.class.php";
	class User{

		public function insertUser($infosUser){
			if( array_key_exists( "firstname", $infosUser )
			&& array_key_exists( "lastname", $infosUser )
			&& array_key_exists( "usermail", $infosUser )
			&& array_key_exists( "username", $infosUser )
			&& array_key_exists( "userpassword", $infosUser )
			){
				if( !empty($infosUser["firstname"])
				&& !empty($infosUser["lastname"])
				&& !empty($infosUser["usermail"]) 
				&& !empty($infosUser["username"]) 
				&& !empty($infosUser["userpassword"]) 
				){
					$arrayInfosUser = [
						htmlspecialchars( $infosUser["firstname"] ),
						htmlspecialchars( $infosUser["lastname"] ),
						htmlspecialchars( $infosUser["username"] ),
						htmlspecialchars( $infosUser["usermail"] ),
						password_hash( $infosUser["userpassword"], PASSWORD_DEFAULT )
					];

					$sql = ( "SELECT Usermail FROM `Users` WHERE Usermail = ?" );

					$database = new database();
					$compareMail = $database->queryOne($sql, [ $arrayInfosUser[3] ]);

					if ($compareMail) 
					{
						echo "<p>Un utilisateur est déja enregistré avec cette adresse mail : ".$arrayInfosUser[3]."</p>";
					}
					else
					{
						$sql = 
							"INSERT INTO Users ( Firstname, Lastname, Usermail, Username, Userpassword, CreationTimestamp ) 
							VALUES ( ?, ?, ?, ?, ?, NOW() )"
						;

						$database = new Database();
						$database->executeSql($sql, $arrayInfosUser);

						$this->loginUser($infosUser);

						// header("location: ../../index.php");
					}
				}
				else
				{
					echo "Il y a une erreur de saisie";
				}
			}
		}

		// public function insertUser($infosUser){
			
		// 	$sql = 
		// 		"INSERT INTO Users ( Firstname, Lastname, Usermail, Username, Userpassword, CreationTimestamp ) 
		// 		VALUES ( ?, ?, ?, ?, ?, NOW() )"
		// 	;

		// 	$database = new Database();
	    //     $database->executeSql($sql, $infosUser);

	    //     header("location: ../../index.php");
		// }

		public function loginUser($user){
			session_start();

			$_SESSION["connected"] = false;

			if ( array_key_exists( "usermail", $user )
			&& array_key_exists( "userpassword", $user ) 
			){
		  		$usermail = $user["usermail"];
		  		$username = $user["usermail"];
				$password = $user["userpassword"];

				if( !empty($usermail) 
				&& !empty($password) 
				){
					$sql = "SELECT * FROM `Users` WHERE Usermail = ? OR Username = ?";
			        
					$database = new database();
			        $infosUserDb = $database->queryOne($sql, [ $usermail, $username ]);

			        if ( $infosUserDb )
			        {
						$comparePassword = password_verify($password, $infosUserDb["Userpassword"]);
						
				    	if ($comparePassword)
				    	{
							$_SESSION["connected"] = true;
							$_SESSION["firstname"] = $infosUserDb["Firstname"];
							$_SESSION["lastname"] = $infosUserDb["Lastname"];
							$_SESSION["username"] = $infosUserDb["Username"];
							$_SESSION["usermail"] = $infosUserDb["Usermail"];
							$_SESSION["creationTimestamp"] = $infosUserDb["CreationTimestamp"];
							$_SESSION["id"] = $infosUserDb["Id"];

					        header("location: ../../index.php");
						}else{
							echo "Mot de passe incorrect!";
						}
					}else{
						echo "Erreur de saisie, ou utilisateur inexistant";
					}
				}else{
					echo "Vous n'avez pas rempli tous les champs!";
				}
			}
		}

		public function logoutUser(){
			session_start();
			session_destroy();
			header("location: ../../index.php");
		}
	}
?>
