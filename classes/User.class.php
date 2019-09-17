<?php
	class User{

		public $message;
		public $validate = false;

		public function insertUser($infosUser){

			// Requête SQL pour vérifier si un compte existe déjà avec cette adresse mail.
			$sql = ( "SELECT Usermail FROM `Users` WHERE Usermail = ?" );
			$database = new database();
			$userMail = $database->queryOne($sql, [ $infosUser["usermail"] ]);

			if ($userMail) { 

				// Si l'adresse mail saisie est déjà utilisée, on envoie un message d'erreur.
				$this->message = "Un utilisateur est déja enregistré avec cette adresse mail : ". $userMail["Usermail"];
			} else { 

				// sinon on se protège des informations saisies par l'utilisateur et on crée le compte dans la BDD
				$arrayInfosUser = [
					htmlspecialchars($infosUser["firstname"]),
					htmlspecialchars($infosUser["lastname"]),
					htmlspecialchars($infosUser["usermail"]),
					htmlspecialchars($infosUser["username"]),
					password_hash($infosUser["userpassword"], PASSWORD_DEFAULT)
				];

				$sql = 
					"INSERT INTO Users ( Firstname, Lastname, Usermail, Username, Userpassword, CreationTimestamp ) 
					VALUES ( ?, ?, ?, ?, ?, NOW() )"
				;

				$database = new Database();
				$database->executeSql($sql, $arrayInfosUser);

				// $this->message = "Votre compte a été créé avec succès.";
				// echo "Votre compte a été créé avec succès.";
				// echo "<script>alert('Votre compte a été créé avec succès.')</script>";

				// sleep(2);

				// Après la création du compte utilisateur, on se connecte automatiquement à la session 
				// et on renvoie l'utilisateur sur index.php
				$user = [
					"usermail" => $infosUser["usermail"],
					"userpassword" => $infosUser["userpassword"]
				];
				$this->loginUser($user);
			}
		}

		public function loginUser($user){
			session_start();
			$_SESSION["connected"] = false;

			// Requête SQL pour récupérer dans la BDD les informations de l'utilisateur.
			$sql = "SELECT * FROM `Users` WHERE Usermail = ? OR Username = ?";
			$database = new database();
			$infosUserDb = $database->queryOne($sql, [ $user["usermail"], $user["usermail"] ]);

			if ($infosUserDb) {

				// Si l'utilisateur existe bien, on vérifie que le mot de passe est correct
				$comparePassword = password_verify($user["userpassword"], $infosUserDb["Userpassword"]);
				
				if ($comparePassword) {

					// Si le mot de passe est correct, on se connecte à la session, 
					// et on conserve les informations de l'utilisateur dans la variable globale $_SESSION
					$_SESSION["connected"] = true;
					$_SESSION["firstname"] = $infosUserDb["Firstname"];
					$_SESSION["lastname"] = $infosUserDb["Lastname"];
					$_SESSION["usermail"] = $infosUserDb["Usermail"];
					$_SESSION["username"] = $infosUserDb["Username"];
					$_SESSION["creationTimestamp"] = $infosUserDb["CreationTimestamp"];
					$_SESSION["id"] = $infosUserDb["Id"];

					// $this->message = "Connexion réussie!";
					// echo "Connexion réussie!";

					// Une fois la connexion établie, on renvoie l'utilisateur sur index.php
					header("location: ../index.php");
				} else {
					$this->message = "Mot de passe incorrect!";
				}
			} else {
				$this->message = "Erreur de saisie, ou utilisateur inexistant";
			}
		}

		public function logoutUser(){
			// session_start();

			//On vide la session en cours et on la détruit.
			$_SESSION="";
			session_destroy();

			// $this->message = "Vous êtes déconnecté.";
			// echo "Vous êtes déconnecté.";

			// Une fois la session détruite, on renvoie l'utilisateur sur index.php
			header("location: ../index.php");
		}

		public function editUserProfil($infosUser) {

			// on se protège des nouvelles informations saisies par l'utilisateur et on modifie le compte dans la BDD.
			$arrayInfosUser = [
				htmlspecialchars($infosUser["firstname"]),
				htmlspecialchars($infosUser["lastname"]),
				htmlspecialchars($infosUser["usermail"]),
				htmlspecialchars($infosUser["username"]),
				$_SESSION['id']
			];

			$sql =
				"UPDATE `Users` SET `Firstname` = ?, `Lastname` = ?, `Usermail` = ?, `Username` = ?
				WHERE `Users`.`Id` = ?"
			;

			$database = new Database();
			$database->executeSql($sql, $arrayInfosUser);

			// On met à jour les informations stockées dans $_SESSION.
			$_SESSION["firstname"] = $arrayInfosUser[0];
			$_SESSION["lastname"] = $arrayInfosUser[1];
			$_SESSION["usermail"] = $arrayInfosUser[2];
			$_SESSION["username"] = $arrayInfosUser[3];

			// $this->message = "Profil utilisateur modifié avec succès.";
			// echo "Profil utilisateur modifié avec succès.";
			// echo "<script>alert('Profil utilisateur modifié avec succès.')</script>";

			// Une fois le profil utilisateur modifié, on renvoie l'utilisateur sur la page user.php
			header("location: accountUser.php");
		}

		public function editUserPassword($arrayUserPasswords) {

			// Requête SQL pour récupérer dans la BDD le mot de passe crypté de l'utilisateur.
			$sql = "SELECT Userpassword FROM `Users` WHERE id = ?";
			$database = new database();
			$cryptedUserPassword = $database->queryOne($sql, [$_SESSION["id"]]);

			// On vérifie que l'ancien mot de passe est correct.
			$comparePassword = password_verify($arrayUserPasswords["oldUserpassword"], $cryptedUserPassword["Userpassword"]);
			if ($comparePassword) {

				// Si l'ancien mot de passe est correct, on vérifie si le nouveau mot de passe a été correctement saisi.
				if ($arrayUserPasswords["newUserpassword"] === $arrayUserPasswords["verifNewUserpassword"]) {

					// Si le nouveau mot de passe a été correctement saisi, 
					// on crypte le nouveau mot de passe et on le modifie dans la BDD.
					$arrayInfosUser = [
						password_hash($_POST["newUserpassword"], PASSWORD_DEFAULT),
						$_SESSION["id"]
					];

					$sql =
						"UPDATE `Users` SET `Userpassword` = ?
						WHERE `Users`.`Id` = ?"
					;

					$database = new Database();
					$database->executeSql($sql, $arrayInfosUser);

					// $this->message = "Mot de passe modifié avec succès.";
					// echo "Mot de passe modifié avec succès.";

					// Une fois le mot de passe modifié, on renvoie l'utilisateur sur la page user.php
					header("location: accountUser.php");
				} else {
					$this->message = "Erreur lors de la saisie du nouveau mot de passe. La vérification ne correspond pas au nouveau mot de passe saisi.";
				}
			} else {
				$this->message = "Ancien mot de passe incorrect!";
			}
		}
	}
?>
