<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Popup! S'enregistrer</title>
		<link rel="shortcut icon" href="../public/images/popup-favicon.png">
		<!-- Balises META -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- CSS perso -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<link rel="stylesheet" href="../public/css/normalize.css">
		<link rel="stylesheet" type="text/css" href="../public/css/style.css">
	</head>

	<body>
		<div class="login-form">
			<form action="signup.php" method="post">
				<h2><img src="../public/images/popup.png" alt="Logo du site Popup!" title="Logo du site Popup!" id="logo-popup"></h2>
				<h2>Rejoignez Popup!</h2>
				<p>Vous avez déja un compte? <a href="login.php">Connectez-vous ici!</a></p>
				<div class="form-group form-group-flex">
					<div class="form-group-2">
						<label for="firstname">Prénom</label>
						<input type="text" name="firstname" id="firstname" class="form-control" required>
					</div>
					<div class="form-group-2">
						<label for="lastname">Nom de famille</label>
						<input type="text" name="lastname" id="lastname" class="form-control" required>
					</div>
				</div>
				<div class="form-group">
					<label for="usermail">Adresse mail</label>
					<input type="email" name="usermail" id="usermail" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="username">Nom d'utilisateur<span>(uniquement lettres, nombres, et underscores)</span></label>
					<input type="text" name="username" id="username" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="userpassword">Mot de passe<span>(min 6 char.)</span></label>
					<input type="password" name="userpassword" id="userpassword" class="form-control" required>
				</div>
				<div class="form-group">
					<input type="submit" value="Connexion" class="button black-button">
				</div>
				<p class="login-form-footer">By joining, you agree to the <a href="#">Terms</a> and <a href="#">Privacy Policy</a>.</p>
			</form>
		</div>
		<?php if (!empty($message)) : ?>
			<script>
				alert("<?= $message ?>")
			</script>
		<?php endif; ?>
	</body>

</html>