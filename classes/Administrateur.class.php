<?php
	class Administrateur{

		public $message;

		public function loginAdmin($admin){
			session_start();
			$_SESSION["administrateur"] = false;

			$login_admin = $admin["login_admin"];
			$email_admin = $admin["login_admin"];
			$password_admin = $admin["password_admin"];

			// Requête SQL pour récupérer dans la BDD les informations de l'administrateur.
			$sql = "SELECT * FROM `Administrateurs` WHERE Login_admin = ? OR Email_admin = ?";
			$database = new Database();
			$infosAdminDb = $database->queryOne($sql, [ $login_admin, $email_admin ]);

			if ( $infosAdminDb ) 
			{	
				// Si l'administrateur existe bien, on vérifie que le mot de passe est correct
				$comparePassword = password_verify($password_admin, $infosAdminDb["Password_admin"]);
				
				if ($comparePassword) 
				{
					// Si le mot de passe est correct, on se connecte à la session, 
					// et on conserve les informations de l'administrateur dans la variable globale $_SESSION
					$_SESSION["admin_connected"] = true;
					$_SESSION["login_admin"] = $infosAdminDb["Login_admin"];
					$_SESSION["email_admin"] = $infosAdminDb["Email-admin"];
					$_SESSION["id_admin"] = $infosAdminDb["Id_admin"];

					// Une fois la connexion établie, on renvoie l'administrateur sur index.php de l'admin
					header("location: ../index.php");
				}else{
					$this->message = "Mot de passe incorrect!";
				}
			}else{
				$this->message = "Erreur de saisie, ou administrateur inexistant";
			}
		}

		public function logoutAdmin(){
			session_start();

			//On vide la session en cours et on la détruit.
			$_SESSION="";
			session_destroy();

			// Une fois la session détruite, on renvoie l'utilisateur sur la homepage du site : index.php
			header("location: ../../index.php");
		}
	}
?>
