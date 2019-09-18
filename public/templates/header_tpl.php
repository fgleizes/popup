<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Popup! La banque d'images gratuites socialement connectée!</title>
		<link rel="shortcut icon" href="<?= $root ?>public/images/popup-favicon.png">
		<!-- Balises META -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- CSS perso -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="<?= $root ?>public/css/normalize.css">
		<link rel="stylesheet" type="text/css" href="<?= $root ?>public/css/style.css">
	</head>

	<body>
		<header>
			<div id="nav-mobile">
				<?php if (array_key_exists("connected", $_SESSION) && $_SESSION['connected']) : ?>
					<nav class="nav-mobile">
						<ul>
							<li class="button-homepage" <?php if (preg_match('/index.php/', $_SERVER['PHP_SELF'])) echo ' id="en-cours"'; ?>>
								<a href="<?= $root ?>index.php"><i class="fas fa-home"></i></a>
							</li>
							<li class="button-toggle-categories" <?php if (preg_match('/theme.php/', $_SERVER['PHP_SELF'])) echo ' id="en-cours"'; ?>>
								<a href="#" class="js-toggle-categories">
									<p>Afficher les catégories</p>
									<i class="fas fa-layer-group"></i>
								</a>
							</li>
							<li class="button-share-photo">
								<a href="#modal-share-photos" class="js-modal">
									<p>Partager une photo</p>
									<i class="fas fa-plus-square"></i>
								</a>
							</li>
							<li class="button-profile-user" <?php if (preg_match('/accountUser.php/', $_SERVER['PHP_SELF'])) echo ' id="en-cours"'; ?>>
								<a href="<?= $root ?>src/accountUser.php"><i class="fas fa-user-circle"></i></a>
							</li>
						</ul>
						<div class="container-list-themes">
							<ul class="list-themes">
								<?php foreach ($categories as $category) : ?>
									<li class="theme" <?php if (array_key_exists('category_Id', $_GET) && $_GET['category_Id'] === $category['id']) echo ' id="en-cours"'; ?>>
										<a href="<?= $root ?>src/theme.php?category_Id=<?= $category['id'] ?>"><?= $category['category_name'] ?></a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</nav>
				<?php else : ?>
					<nav class="nav-mobile">
						<ul>
							<li class="button-homepage" <?php if (preg_match('/index.php/', $_SERVER['PHP_SELF'])) echo ' id="en-cours"'; ?>>
								<a href="<?= $root ?>index.php"><i class="fas fa-home"></i></a>
							</li>
							<li class="button-toggle-categories" <?php if (preg_match('/theme.php/', $_SERVER['PHP_SELF'])) echo ' id="en-cours"'; ?>>
								<a href="#" class="js-toggle-categories">
									<p>Afficher les catégories</p>
									<i class="fas fa-layer-group"></i>
								</a>
							</li>
							<li>
								<a href="<?= $root ?>src/login.php"><i class="fas fa-plus-square"></i></a>
							</li>
						</ul>
						<div class="container-list-themes">
							<ul class="list-themes">
								<?php foreach ($categories as $category) : ?>
									<li class="theme" <?php if (array_key_exists('category_Id', $_GET) && $_GET['category_Id'] === $category['id']) echo ' id="en-cours"'; ?>>
										<a href="<?= $root ?>src/theme.php?category_Id=<?= $category['id'] ?>"><?= $category['category_name'] ?></a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</nav>
					<div id="login-form-mobile">
						<a href="<?= $root ?>src/login.php" class="button white-button login-button">S'identifier</a>
						<a href="<?= $root ?>src/signup.php" class="button signup-button">S'enregistrer</a>
					</div>
				<?php endif ?>
			</div>
			<nav id="nav-desktop">
				<div id="nav-left">
					<a title="Aller vers la page d'accueil" href="<?= $root ?>index.php"><img src="<?= $root ?>public/images/popup.png" alt="Logo du site Popup!" title="Logo du site Popup!" id="logo-popup"></a>
				</div>
				<div id="nav-center">
					<div id="border-list-themes"></div>
					<div class="container-list-themes">
						<ul class="list-themes">
							<?php foreach ($categories as $category) : ?>
								<li class="theme" <?php if (array_key_exists('category_Id', $_GET) && $_GET['category_Id'] === $category['id']) echo ' id="en-cours"'; ?>>
									<a href="<?= $root ?>src/theme.php?category_Id=<?= $category['id'] ?>"><?= $category['category_name'] ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<ul id="nav-right">
					<div id="border-list-themes"></div>
					<?php if (array_key_exists("connected", $_SESSION) && $_SESSION['connected']) : ?>
						<li class="button-share-photo tablette">
							<a class="js-modal" href="#modal-share-photos">
								<p>Partager une photo</p>
								<i class="fas fa-plus-square"></i>
							</a>
						</li>
						<li class="button-share-photo desktop">
							<a class="button white-button js-modal" href="#modal-share-photos">Partager une photo</a>
						</li>
						<li <?php if (preg_match('/accountUser.php/', $_SERVER['PHP_SELF'])) echo ' id="en-cours"'; ?>>
							<a href="<?= $root ?>src/accountUser.php"><i class="fas fa-user-circle"></i></a>
						</li>
					<?php else : ?>
						<li class="button-share-photo tablette">
							<a href="<?= $root ?>src/login.php"><i class="fas fa-plus-square"></i></a>
						</li>
						<li class="button-share-photo desktop">
							<a class="button white-button" href="<?= $root ?>src/login.php">Partager une photo</a>
						</li>
						<li>
							<a href="<?= $root ?>src/login.php">S'identifier</a>
						</li>
						<li>
							<a href="<?= $root ?>src/signup.php">S'enregistrer</a>
						</li>
					<?php endif ?>
				</ul>
			</nav>
		</header>