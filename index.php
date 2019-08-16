<?php 
	// require "classes/Configuration.class.php";
	require "classes/Database.class.php";

	session_start();

	$photosParPage = 6; // nombre de photos à afficher par pages
	$database = new database();
	$sqlPhotosTotales = "SELECT id FROM `Photos` WHERE `Photos`.`visibility` = 1 AND `Photos`.`publishDate` <= NOW()";
	$photosTotales = sizeof($database->query($sqlPhotosTotales)); // nombre total de photos à afficher
	$pagesTotales = ceil($photosTotales / $photosParPage); // nombre total de pages
	
	if ( isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 ) {
		$_GET['page'] = intval($_GET['page']);
		$pageCourante = $_GET['page'];
	} else {
		$pageCourante = 1;
	}

	$depart = ($pageCourante - 1) * $photosParPage;
	
	$sqlPhotos = 
		"SELECT Photos.id, Photos.name, Photos.description, Photos.type, Photos.size,
				Photos.creationTimestamp, Photos.lastModified, Photos.lastModifiedDate, Photos.publishDate,
				Thumbnails.150w, Thumbnails.300w, Thumbnails.500w, Thumbnails.768w, Thumbnails.1024w, 
				Photos.user_Id, Users.Firstname, Users.Lastname, Users.Username
		FROM `Photos`
		JOIN Users ON Users.Id = Photos.user_Id
		JOIN Thumbnails ON Photos.Id = Thumbnails.photo_Id
		WHERE `Photos`.`visibility` = 1 AND `Photos`.`publishDate` <= NOW()
		ORDER BY `Photos`.`publishDate` DESC
		LIMIT $depart,$photosParPage"
	;
	$photos = $database->query($sqlPhotos);
	
	include "public/templates/index_tpl.php";
?>