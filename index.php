<?php 
	session_start();

	include "src/header.php";

	// Gestion de l'affichage des photos dans la gallery : pour plugin Masonry et infinite scroll / JQUERY
	$photosParPage = 6; // nombre de photos à afficher par pages
	$sqlPhotosTotales = "SELECT id FROM `Photos` WHERE `Photos`.`visibility` = 1 AND `Photos`.`publishDate` <= NOW()";
	$photosTotales = sizeof($database->query($sqlPhotosTotales)); // nombre total de photos à afficher
	$pagesTotales = ceil($photosTotales / $photosParPage); // nombre total de pages
	
	// Création de la pagination en php : pour plugin infinite scroll / JQUERY
	if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) {
		$_GET['page'] = intval($_GET['page']);
		$pageCourante = $_GET['page'];
	} else {
		$pageCourante = 1;
	}

	$depart = ($pageCourante - 1) * $photosParPage;

	// On récupère les photos à afficher dans la gallery (main => section gallery)
	$sqlPhotos = 
		"SELECT Photos.id, Photos.name, Photos.category_Id, Photos.user_Id,
				Thumbnails.150w, Thumbnails.300w, Thumbnails.500w, Thumbnails.768w, Thumbnails.1024w, 
				Users.Firstname, Users.Lastname, Users.Username
		FROM `Photos`
		JOIN Thumbnails ON Photos.Id = Thumbnails.photo_Id
		JOIN Users ON Users.Id = Photos.user_Id
		WHERE `Photos`.`visibility` = 1 AND `Photos`.`publishDate` <= NOW()
		ORDER BY `Photos`.`publishDate` DESC
		LIMIT $depart,$photosParPage"
	;
	$photos = $database->query($sqlPhotos);
		
	include "public/templates/index_tpl.php";
	include "src/footer.php";
?>