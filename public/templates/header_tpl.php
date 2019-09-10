<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Popup! La banque d'images gratuites socialement connectée!</title>
	<!-- Balises META -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS perso -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/projets/Popup/public/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="/projets/Popup/public/css/style.css">
</head>

<body>
	<header>
		<div id="nav-mobile">
			<?php if (array_key_exists("connected", $_SESSION) && $_SESSION['connected']) : ?>
			<nav class="nav-mobile">
				<ul>
					<li class="button-homepage">
						<a href="/projets/Popup/index.php"><i class="fas fa-home"></i></a>
					</li>
					<li class="button-toggle-categories">
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
					<!-- <li>
						<a href="public/src/logout.php"><i class="fas fa-search"></i></a>
					</li> -->
					<li class="button-profile-user">
						<a href="/projets/Popup/public/src/user.php"><i class="fas fa-user-circle"></i></a>
					</li>
				</ul>
				<div class="container-list-themes">
					<ul class="list-themes">
						<?php foreach ($categories as $category) : ?>
						<li class="theme" <?php if ($nav_en_cours === $_SERVER['PHP_SELF'] . "?category_Id=" . $category['id']) {
														echo ' id="en-cours"';
													} ?>>
							<a href="/projets/Popup/public/src/theme.php?category_Id=<?= $category['id'] ?>"><?= $category['category_name'] ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</nav>
			<?php else : ?>
			<nav class="nav-mobile">
				<ul>
					<li class="button-homepage">
						<a href="/projets/Popup/index.php"><i class="fas fa-home"></i></a>
					</li>
					<li class="button-toggle-categories">
						<a href="#" class="js-toggle-categories">
							<p>Afficher les catégories</p>
							<i class="fas fa-layer-group"></i>
						</a>
					</li>
					<li>
						<a href="/projets/Popup/public/src/login.php"><i class="fas fa-plus-square"></i></a>
					</li>
					<!-- <li>
						<a href="#"><i class="fas fa-search"></i></a>
					</li> -->
				</ul>
				<div class="container-list-themes">
					<ul class="list-themes">
						<?php foreach ($categories as $category) : ?>
						<li class="theme" <?php if ($nav_en_cours === $_SERVER['PHP_SELF'] . "?category_Id=" . $category['id']) {
														echo ' id="en-cours"';
													} ?>>
							<a href="/projets/Popup/public/src/theme.php?category_Id=<?= $category['id'] ?>"><?= $category['category_name'] ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</nav>
			<div id="login-form-mobile">
				<a href="/projets/Popup/public/src/login.php" class="button white-button login-button">S'identifier</a>
				<a href="/projets/Popup/public/src/signup.php" class="button signup-button">S'enregistrer</a>
			</div>
			<?php endif ?>
		</div>
		<?php if (array_key_exists("connected", $_SESSION) && $_SESSION['connected']) : ?>
		<?php endif; ?>
		<nav id="nav-desktop">
			<div id="nav-left">
				<a href="/projets/Popup/index.php"><img src="/projets/Popup/public/images/popup.png" alt="Logo du site Popup!" title="Logo du site Popup!" id="logo-popup"></a>
			</div>
			<div id="nav-center">
				<div id="border-list-themes"></div>
				<div class="container-list-themes">
					<ul class="list-themes">
						<?php foreach ($categories as $category) : ?>
						<li class="theme" <?php if ($nav_en_cours === $_SERVER['PHP_SELF'] . "?category_Id=" . $category['id']) {
													echo ' id="en-cours"';
												} ?>>
							<a href="/projets/Popup/public/src/theme.php?category_Id=<?= $category['id'] ?>"><?= $category['category_name'] ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<ul id="nav-right">
				<div id="border-list-themes"></div>
				<?php if (array_key_exists("connected", $_SESSION) && $_SESSION['connected']) : ?>
				<!-- <li class="button-share-photo tablette">
							<a href="#"><i class="fas fa-plus-square"></i></a>
						</li> -->
				<li class="button-share-photo tablette">
					<a class="js-modal" href="#modal-share-photos">
						<p>Partager une photo</p>
						<i class="fas fa-plus-square"></i>
					</a>
				</li>
				<!-- <li class="button-share-photo desktop">
							<a class="button" href="#">Partager une photo</a>
						</li> -->
				<li class="button-share-photo desktop">
					<a class="button white-button js-modal" href="#modal-share-photos">Partager une photo</a>
				</li>
				<li>
					<a href="/projets/Popup/public/src/logout.php"><i class="fas fa-bell"></i></a>
				</li>
				<li>
					<a href="/projets/Popup/public/src/user.php"><i class="fas fa-user-circle"></i></a>
				</li>
				<?php else : ?>
				<li class="button-share-photo tablette">
					<a href="/projets/Popup/public/src/login.php"><i class="fas fa-plus-square"></i></a>
				</li>
				<li class="button-share-photo desktop">
					<a class="button white-button" href="/projets/Popup/public/src/login.php">Partager une photo</a>
				</li>
				<li>
					<a href="/projets/Popup/public/src/login.php">S'identifier</a>
				</li>
				<li>
					<a href="/projets/Popup/public/src/signup.php">S'enregistrer</a>
				</li>
				<?php endif ?>
			</ul>
			<!-- <div id="nav-left">
					<a href="index.php"><img src="../images/popup.png" alt="Logo du site Popup!" title="Logo du site Popup!" id="logo-popup"></a>
					<form action="">
						<button><i class="fas fa-search"></i></button>
						<input type="search" placeholder="Rechercher une photo">
					</form>
				</div>
				<ul id="nav-center">
					<li>
						<a href="#">Collections</a>
					</li>
					<li>
						<a href="#" id="themes">Thèmes</a>
					</li>
					<li>
						<a href="#"><i class="fas fa-ellipsis-h"></i></a>
						<div id="deroulant"></div>
					</li>
				</ul> -->
		</nav>
	</header>