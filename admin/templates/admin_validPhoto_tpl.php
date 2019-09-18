<!DOCTYPE html>
<html lang="fr">

    <head>
        <title>Popup! La banque d'images gratuites socialement connectée!</title>
        <link rel="shortcut icon" href="../../public/images/popup.png">
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
            <section id="valid-photo">
                <a href="../index.php" class="button white-button">Retour à l'administration</a>
                <form method="post" action="admin_editPhoto.php?photo_Id=<?= $photo["id"] ?>">
                    <div id="infos-photo">
                        <div id="preview-photo">
                            <h3>Apperçu de la photo :</h3>
                            <div id="view">
                                <a href="<?= $dossier_traite ?>/<?= $photo["name"] ?>" target="_blank">
                                    <img src="<?= $dossier_traite ?>/<?= $photo["name"] ?>" alt="Photo partagée sur Popup">
                                </a>
                            </div>
                        </div>
                        <div id="details-photo">
                            <h3>Informations sur la photo :</h3>
                            <div>
                                <h4>ID de la photo :</h4>
                                <p id="photo_Id"><?= $photo["id"] ?></p>
                                <h4>Nom :</h4>
                                <p id="fileName"><?= $photo["name"] ?></p>
                                <h4>Description (<em>si renseignée</em>) :</h4>
                                <p><?= !empty($photo["description"]) ? $photo["description"] : "N/A" ?></p>
                                <h4>Format :</h4>
                                <p><?= $photo["type"] ?></p>
                                <h4>Taille originale :</h4>
                                <p>largeur = <?= $fileSize[0] ?>px <span>x</span> hauteur = <?= $fileSize[1] ?>px</p>
                                <h4>Poids :</h4>
                                <p>
                                    <?php
                                    if ($photo["size"] >= 1024 && $photo["size"] < 1048576) {
                                        echo (round(($photo["size"] / 1024), 1) . ' Ko');
                                    } else if ($photo["size"] >= 1048576) {
                                        echo (round(($photo["size"] / 1048576), 1) . ' Mo');
                                    }
                                    ?>
                                </p>
                                <h4>Dernière modification :</h4>
                                <!-- <p><?= $photo["lastModifiedDate"] ?></p> -->
                                <p><?= strftime("%F %T", $photo["lastModified"] / 1000) ?></p>

                                <h4>Partagée le :</h4>
                                <p><?= $photo["creationTimestamp"] ?></p>
                            </div>
                        </div>
                        <div id="infos-user">
                            <div>
                                <h3>Informations sur l'auteur :</h3>
                                <h4>ID de l'auteur :</h4>
                                <p><?= $photo["user_Id"] ?></p>
                                <h4>Nom :</h4>
                                <p><?= $photo["Lastname"] ?></p>
                                <h4>Prenom :</h4>
                                <p><?= $photo["Firstname"] ?></p>
                                <h4>Pseudo :</h4>
                                <p><?= $photo["Username"] ?></p>
                                <h4>Adresse mail :</h4>
                                <p><?= $photo["Usermail"] ?></p>
                                <h4>Crée le :</h4>
                                <p><?= $photo["CreationTimestamp"] ?></p>
                            </div>
                        </div>
                    </div>
                    <div id="choices-photo">
                        <h3>Choisissez les options et confirmez la publication :</h3>
                        <div id="choice-category">
                            <label for="category">Selectionnez la catégorie de la photo :</label>
                            <select id="category" name="category_Id" required>
                                <option value="">--Catégorie--</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['id'] ?>"><?= $category["category_name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div id="choice-date">
                            <p>Publiez :</p>
                            <div>
                                <input type="radio" name="publishChoice" class="publishChoice" value="now" id="now" checked>
                                <label for="now">Maintenant</label>
                                <input type="radio" name="publishChoice" class="publishChoice" value="planifier" id="planifier" />
                                <label for="planifier">Planifier une date de publication</label>
                            </div>
                            <div id="divPublishDate" class="hide">
                                <input type="date" name="publishDate" id="publishDate">
                                <select id="publishHours" name="heures">
                                    <option value="">--Heure(s)--</option>
                                    <?php for ($i = 0; $i <= 24; $i++) : ?>
                                        <?php if ($i < 10) {
                                                $i = "0" . $i;
                                            } ?>
                                        <option value="<?= $i ?>"><?= $i ?>h</option>
                                    <?php endfor; ?>
                                </select>
                                <select id="publishMinutes" name="minutes">
                                    <option value="">--Minute(s)--</option>
                                    <?php for ($i = 0; $i <= 60; $i++) : ?>
                                        <?php if ($i < 10) {
                                                $i = "0" . $i;
                                            } ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div id="valid">
                            <a href="#" class="button delete-button">Supprimer la photo</a>
                            <!-- <input type="submit" name="supprimer" value="Supprimer la photo" class="button delete-button"> -->
                            <input type="submit" name="publier" value="Publier la photo" class="button black-button">
                        </div>
                    </div>
                </form>
            </section>
        </main>
        <script src="../scripts/admin.js"></script>
    </body>

</html>