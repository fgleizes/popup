<?php 
    // On vérifie si le fichier footer.php est appelé depuis l'index.php, ou depuis un fichier dans le dossier src,
	// et on définit la racine du chemin relatif à utiliser
    if (preg_match('/index.php/', $_SERVER['PHP_SELF'])) {
		$root = "";
	} else {
		$root = "../";
    }
    
    include ($root . "public/templates/footer_tpl.php");
?>