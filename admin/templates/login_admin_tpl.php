<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Popup! Administrateurs :</title>
		<link rel="shortcut icon" href="../../public/images/popup-favicon.png">
		<!-- Balises META -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- CSS perso -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<link rel="stylesheet" href="../../public/css/normalize.css">
		<link rel="stylesheet" type="text/css" href="../../public/css/style.css">
	</head>
	<body>
		<div class="login-form">
			<form action="login_admin.php" method="post">
				<h2><img src="../../public/images/popup.png" alt="Logo du site Popup!" title="Logo du site Popup!" id="logo-popup"></h2>
				<h2>Connectez-vous en tant qu'administrateur</h1>
				<div class="form-group">
					<label for="login_admin">Login / Email administrateur</label>
					<input type="text" name="login_admin" id="login_admin" required class="form-control" >
				</div>
				<div class="form-group">
					<label for="password_admin">Mot de passe <!-- <span><a href="#">(Mot de passe oublié ?)</a></span>!--></label>
					<input type="password" name="password_admin" id="password_admin" required class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" value="Connexion" class="button black-button">
				</div>
			</form>
		</div>

		<!-- Pour afficher les messages en cas d'erreur -->
		<?php if (!empty($message)) : ?>
			<script>
				alert("<?= $message ?>")
			</script>
		<?php endif; ?>
	</body>
</html>