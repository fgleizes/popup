<?php 
	// On vérifie si le fichier header.php est appelé depuis l'index.php, ou depuis un fichier src,
	// et on définit la racine du chemin relatif à utiliser
	if (preg_match('/index.php/', $_SERVER['PHP_SELF'])) {
		$root = "";
	} else {
		$root = "../";
	}

	require ($root . "classes/Database.class.php");

	// On récupère les catégories à afficher dans le menu
    $sqlCategories = "SELECT * FROM `Category` WHERE id != 1";
	$database = new Database;
	$categories = $database->query($sqlCategories);

	include ($root . "public/templates/header_tpl.php");
?>