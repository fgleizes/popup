<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Popup! S'identifier</title>
		<!-- Balises META -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- CSS perso -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/normalize.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		<!-- <p><a href="../../index.php">Retour</a></p> -->
		<div class="login-form">
			<form action="login.php" method="post">
				<h2><img src="../images/popup.png" alt="Logo du site Popup!" title="Logo du site Popup!" id="logo-popup"></h2>
				<h2>Connectez-vous</h1>
				<div class="form-group">
					<label for="usermail">Adresse mail / nom d'utilisateur</label>
					<input type="text" name="usermail" id="usermail" required class="form-control" >
				</div>
				<div class="form-group">
					<label for="userpassword">Mot de passe<span><a href="#">(Mot de passe oublié ?)</a></span></label>
					<input type="password" name="userpassword" id="userpassword" required class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" value="Connexion">
				</div>
				<p class="login-form-footer">Si vous n'êtes pas encore inscrit, <a href="signUp.php">enregistrez-vous ici gratuitement :</a></p>
			</form>
		</div>
	</body>
</html>