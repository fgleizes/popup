<?php
	class User{

		public function insertUser($infosUser){
			
			$sql = 
				"INSERT INTO Users ( Firstname, Lastname, Usermail, Username, Userpassword, CreationTimestamp ) 
				VALUES ( ?, ?, ?, ?, ?, NOW() )"
			;

			$database = new Database();
	        $database->executeSql($sql, $infosUser);

	        header("location: ../../index.php");
		}


		public function loginUser($user){

			$_SESSION["connected"] = false;

			if ( array_key_exists( "mail", $user )
			&& array_key_exists( "password", $user ) 
			){
		  		$usermail = $user["mail"];
		  		$username = $user["mail"];
				$password = $user["password"];

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

							// $sql2 = "
				   //          	UPDATE `Users` SET `LastLoginTimestamp` = NOW() WHERE `Users`.`Id` = ?
					  //       ";

					        // $id = [ $_SESSION["id"] ];
					        
					        // $database->executeSql($sql2, $id);
					        
					        // var_dump($_SESSION);

					        // header("location: ../../index.php");
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
	}
?>
