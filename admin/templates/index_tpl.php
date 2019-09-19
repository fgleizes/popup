<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Popup! La banque d'images gratuites socialement connectée!</title>
	    <link rel="shortcut icon" href="../public/images/popup-favicon.png">
		<!-- Balises META -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- CSS perso -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<main>
			<section id="admin">
                <a href="src/logout_admin.php" class="button white-button">Déconnexion et retour à la page d'accueil</a>
                <h1 class="center">Portail d'administration :</h1>
                <h3>Liste des photos partagées par les utilisateurs, à valider :</h3>
                <ul id="title">
                    <li>ID</li>
                    <li>Nom :</li>
                    <!-- <li>Description</li> -->
                    <li>Partagé le :</li>
                    <li>Par :</li>
                    <li>UserID</li>
                    <li></li>
                </ul>
                <?php foreach ( $photos as $photo ): ?>
                    <ul>
                        <li><?= $photo["id"] ?></li>
                        <li><?= $photo["name"] ?></li>
                        <!-- <li><?= !empty( $photo["description"] ) ? $photo["description"] : "N/A" ?></li> -->
                        <li><?= $photo["creationTimestamp"] ?></li>
                        <li><?= $photo["Firstname"] ?> <?= $photo["Lastname"] ?></li>
                        <li><?= $photo["user_Id"] ?></li>
                        <li><a href="src/admin_validPhoto.php?photo_id=<?= $photo["id"] ?>" class="button" title="Valider la photo">Consulter</a ></li>
                    </ul>
                <?php endforeach; ?>
            </section>
		</main>
	</body>
</html>