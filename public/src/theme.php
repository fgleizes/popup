<?php   
    // require "../../classes/Database.class.php";

	// session_start();

	// /* ****************** HEADER ****************** */
	// $sqlCategories = "SELECT * FROM `Category` WHERE id != 1";
	// $database = new Database;
	// $categories = $database->query($sqlCategories);
	// /* ****************** HEADER ****************** */

	include "header.php";

    $category_Id = $_GET['category_Id'];

	$photosParPage = 3; // nombre de photos à afficher par pages
	$sqlPhotosTotales = "SELECT id FROM `Photos` WHERE `Photos`.`visibility` = 1 AND `Photos`.`publishDate` <= NOW() AND `Photos`.`category_Id` = ?";
	$photosTotales = sizeof($database->query($sqlPhotosTotales, [$category_Id])); // nombre total de photos à afficher
	$pagesTotales = ceil($photosTotales / $photosParPage); // nombre total de pages
	
	if ( isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 ) {
		$_GET['page'] = intval($_GET['page']);
		$pageCourante = $_GET['page'];
	} else {
		$pageCourante = 1;
	}

	$depart = ($pageCourante - 1) * $photosParPage;

	$sqlPhotos = 
		"SELECT Photos.id, Photos.name, Photos.description, Photos.size, Photos.category_Id,
				Photos.creationTimestamp, Photos.lastModified, Photos.lastModifiedDate, Photos.publishDate,
				Thumbnails.150w, Thumbnails.300w, Thumbnails.500w, Thumbnails.768w, Thumbnails.1024w, 
				Photos.user_Id, Users.Firstname, Users.Lastname, Users.Username
		FROM `Photos`
		JOIN Users ON Users.Id = Photos.user_Id
		JOIN Thumbnails ON Photos.Id = Thumbnails.photo_Id
		JOIN Category ON Photos.category_Id = Category.id
		WHERE `Photos`.`visibility` = 1 AND `Photos`.`publishDate` <= NOW() AND `Photos`.`category_Id` = ?
		ORDER BY `Photos`.`publishDate` DESC
		LIMIT $depart,$photosParPage"
	;
    $photos = $database->query($sqlPhotos, [$category_Id]);
    
    // echo "<pre>";
    // var_dump($_SERVER);
	
    include "../templates/theme_tpl.php";
	include "footer.php";
?>