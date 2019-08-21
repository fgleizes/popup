<?php 
	require $_SERVER["DOCUMENT_ROOT"]."/projets/Popup/classes/Database.class.php";

	session_start();

    $sqlCategories = "SELECT * FROM `Category` WHERE id != 1";
	$database = new Database;
	$categories = $database->query($sqlCategories);

	$nav_en_cours = $_SERVER["REQUEST_URI"];

    include $_SERVER["DOCUMENT_ROOT"]."/projets/Popup/public/templates/header_tpl.php";
?>