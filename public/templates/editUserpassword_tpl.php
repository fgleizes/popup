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
            <form action="editUserpassword.php" method="post">
                <h2><img src="../public/images/popup.png" alt="Logo du site Popup!" title="Logo du site Popup!" id="logo-popup"></h2>
                <h2>Modifier votre mot de passe!</h2>
                <div class="form-group">
                    <label for="oldUserpassword">Saisissez votre ancien mot de passe <!-- <span>(min 6 char.)</span> --> </label>
                    <input type="password" name="oldUserpassword" id="oldUserpassword" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="newUserpassword">Saisissez votre nouveau mot de passe <!-- <span>(min 6 char.)</span> --> </label>
                    <input type="password" name="newUserpassword" id="newUserpassword" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="verifNewUserpassword">Ressaisissez votre nouveau mot de passe <!-- <span>(min 6 char.)</span> --> </label>
                    <input type="password" name="verifNewUserpassword" id="verifNewUserpassword" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Modifier le mot de passe" class="button black-button">
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