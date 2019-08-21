<?php
	// require "../../classes/Database.class.php";
	class Administrateur{

		public function loginAdmin($admin){
			session_start();

			$_SESSION["administrateur"] = false;

			if ( array_key_exists( "login_admin", $admin )
			&& array_key_exists( "password_admin", $admin ) 
			){
                $login_admin = $admin["login_admin"];
		  		$email_admin = $admin["login_admin"];
				$password_admin = $admin["password_admin"];

				if( !empty($login_admin) 
				&& !empty($email_admin)
				&& !empty($password_admin)
				){
					$sql = "SELECT * FROM `Administrateurs` WHERE Login_admin = ? OR Email_admin = ?";
			        
					$database = new Database();
			        $infosAdminDb = $database->queryOne($sql, [ $login_admin, $email_admin ]);

			        if ( $infosAdminDb )
			        {
						$comparePassword = password_verify($password_admin, $infosAdminDb["Password_admin"]);
						
				    	if ($comparePassword)
				    	{
							$_SESSION["administrateur"] = true;
							$_SESSION["login_admin"] = $infosAdminDb["Login_admin"];
							$_SESSION["email_admin"] = $infosAdminDb["Email-admin"];
							$_SESSION["id_admin"] = $infosAdminDb["Id_admin"];

					        header("location: ../index.php");
						}else{
							echo "Mot de passe incorrect!";
						}
					}else{
						echo "Erreur de saisie, ou administrateur inexistant";
					}
				}else{
					echo "Vous n'avez pas rempli tous les champs!";
				}
			}
		}

		public function logoutAdmin(){
			session_start();
			$_SESSION="";
			session_destroy();
			header("location: ../../index.php");
		}
	}
?>
