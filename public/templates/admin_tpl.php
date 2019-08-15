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
		<main>
			<section id="admin">
                <a href="../../index.php" class="button white-button">retour à la page d'accueil</a>
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
                    <!-- <li><i class="fas fa-check"></i><i class="fas fa-times"></i><i class="fas fa-info-circle"></i></li>
                    <li>
                        <input type="checkbox" disabled="disabled" name="visible_admin"
                            <?php if ($photo["visibility"] == 1): ?>
                                checked
                            <?php endif; ?> 
                        />
                    </li>
                    <a href="form_edit_post.php?article_id=<?= $photo["id"] ?>" id="edition" title="Editer l'article"><i class="fas fa-pencil-alt"></i></a> -->
                </ul>
                <?php foreach ( $photos as $photo ): ?>
                    <ul>
                        <li><?= $photo["id"] ?></li>
                        <li><?= $photo["name"] ?></li>
                        <!-- <li><?= !empty( $photo["description"] ) ? $photo["description"] : "N/A" ?></li> -->
                        <li><?= $photo["creationTimestamp"] ?></li>
                        <li><?= $photo["Firstname"] ?> <?= $photo["Lastname"] ?></li>
                        <li><?= $photo["user_Id"] ?></li>
                        <li><a href="admin_validPhoto.php?photo_id=<?= $photo["id"] ?>" class="button" title="Valider la photo">Valider</a ></li>
                    </ul>
                <?php endforeach; ?>
            </section>
		</main>
		<!-- <script src="../libs/jquery214.js"></script> -->
		<!-- <script src="../scripts/main.js"></script> -->
		<!-- <script src="../scripts/upload-photo.js"></script> -->
	</body>
</html>