<!DOCTYPE html>
<html lang="fr">

    <head>
        <title>Popup! Modifier le profil utilisateur</title>
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
            <form action="editUserProfil.php" method="post">
                <h2><img src="../public/images/popup.png" alt="Logo du site Popup!" title="Logo du site Popup!" id="logo-popup"></h2>
                <h2>Modifier votre profil utilisateur!</h2>
                <div class="form-group form-group-flex">
                    <div class="form-group-2">
                        <label for="firstname">Prénom</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" value="<?= $infosUser["Firstname"] ?>" required>
                    </div>
                    <div class="form-group-2">
                        <label for="lastname">Nom de famille</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" value="<?= $infosUser["Lastname"] ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="usermail">Adresse mail</label>
                    <input type="email" name="usermail" id="usermail" class="form-control" value="<?= $infosUser["Usermail"] ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Nom d'utilisateur <!-- <span>(uniquement lettres, nombres, et underscores)</span> --> </label>
                    <input type="text" name="username" id="username" class="form-control" value="<?= $infosUser["Username"] ?>" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Modifier le profil" class="button black-button">
                </div>
            </form>
        </div>

        <!-- Pour afficher les messages en cas d'erreur -->
        <?php if (isset($message) && !empty($message)) : ?>
        <script>
            alert("<?= $message ?>")
        </script>
        <?php endif; ?>
    </body>

</html>