<?php 
	if (preg_match('/index.php/', $_SERVER['PHP_SELF'])) {
		$root = "";
	} else {
		$root = "../";
	}

	require ($root . "classes/Database.class.php");

    $sqlCategories = "SELECT * FROM `Category` WHERE id != 1";
	$database = new Database;
	$categories = $database->query($sqlCategories);

	include ($root . "public/templates/header_tpl.php");
?>