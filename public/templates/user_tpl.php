<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Popup! La banque d'images gratuites socialement connectée!</title>
		<!-- Balises META -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- CSS perso -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/normalize.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		<header>
            <!-- <nav class="nav-mobile">
                <ul>
                    <li>
                        <a href="../../index.php"><i class="fas fa-home"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-layer-group"></i></a>
                    </li>
                    <li class="button-share-photo">
                        <a href="#"><i class="fas fa-plus-square"></i></a>
                    </li>
                    <li>
                        <a href="../src/logout.php"><i class="fas fa-search"></i></a>
                    </li>
                    <li>
                        <a href="../template/user.php"><i class="fas fa-user-circle"></i></a>
                    </li>
                </ul>
            </nav>
			<nav id="nav-desktop">
				<div id="nav-left">
					<a href="../../index.php"><img src="../images/popup.png" alt="Logo du site Popup!" title="Logo du site Popup!" id="logo-popup"></a>
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
						<a href="#">Thèmes</a>
					</li>
					<li>
						<a href="#"><i class="fas fa-ellipsis-h"></i></a>
						<div id="deroulant"></div>
					</li>
				</ul>	
				<ul id="nav-right">
                    <li class="button-share-photo tablette">
                        <a href="#"><i class="fas fa-plus-square"></i></a>
                    </li>
                    <li class="button-share-photo desktop">
                        <a class="button" href="#">Partager une photo</a>
                    </li>
                    <li>
                        <a href="../src/logout.php"><i class="fas fa-bell"></i></a>
                    </li>
                    <li>
                        <a href="../template/user.php"><i class="fas fa-user-circle"></i></a>
                    </li>
				</ul>
            </nav> -->
            <h1>Bienvenu sur votre profile utilisateur</h1>
            <a href="../../index.php">retour à la page d'accueil</a>
		</header>
		<main>
			<section>
                <h1><?= $_SESSION["firstname"] ?> <?= $_SESSION["lastname"] ?></h1>
            </section>
		</main>
		<!-- <script src="../libs/jquery214.js"></script> -->
		<!-- <script src="../scripts/main.js"></script> -->
		<!-- <script src="../scripts/upload-photo.js"></script> -->
	</body>
</html>