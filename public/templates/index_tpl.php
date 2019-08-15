<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Popup! La banque d'images gratuites socialement connectée!</title>
		<!-- Balises META -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- CSS perso -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<link rel="stylesheet" href="public/css/normalize.css">
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
	</head>
	<body>
		<header id="home-page">
			<?php if( array_key_exists("connected", $_SESSION) && $_SESSION['connected']): ?>
			<nav class="nav-mobile">
				<ul>
					<li>
						<a href="index.php"><i class="fas fa-home"></i></a>
					</li>
					<li>
						<a href="#"><i class="fas fa-layer-group"></i></a>
					</li>
					<li class="button-share-photo">
						<a href="#"><i class="fas fa-plus-square"></i></a>
					</li>
					<li>
						<a href="public/src/logout.php"><i class="fas fa-search"></i></a>
					</li>
					<li>
						<a href="public/src/user.php"><i class="fas fa-user-circle"></i></a>
					</li>
				</ul>
			</nav>
			<?php else : ?>
			<nav class="nav-mobile">
				<ul>
					<li>
						<a href="index.php"><i class="fas fa-home"></i></a>
					</li>
					<li>
						<a href="#"><i class="fas fa-layer-group"></i></a>
					</li>
					<li>
						<a href="public/src/login.php"><i class="fas fa-plus-square"></i></a>
					</li>
					<li>
						<a href="#"><i class="fas fa-search"></i></a>
					</li>
				</ul>
			</nav>
			<div id="login-form-mobile">
				<a href="public/src/login.php" class="button login-button">S'identifier</a>
				<a href="public/src/signup.php" class="button signup-button">S'enregistrer</a>
			</div>
			<?php endif ?>
			<nav id="nav-desktop">
				<div id="nav-left">
					<a href="index.php"><img src="public/images/popup.png" alt="Logo du site Popup!" title="Logo du site Popup!" id="logo-popup"></a>
					<form action="">
						<button><i class="fas fa-search"></i></button>
						<input type="search" placeholder="Rechercher une photo"> <!--libre de droit, en haute résolution"-->
					</form>
				</div>
				<ul id="nav-center">
					<li>
						<a href="#">Collections</a>
					</li>
					<li>
						<a href="#">Thèmes</a>
					</li>
					<li>
						<a href="#"><i class="fas fa-ellipsis-h"></i></a>
						<div id="deroulant"></div>
					</li>
				</ul>	
				<ul id="nav-right">
					<?php if( array_key_exists("connected", $_SESSION) && $_SESSION['connected']): ?>
						<li class="button-share-photo tablette">
							<a href="#"><i class="fas fa-plus-square"></i></a>
						</li>
						<li class="button-share-photo desktop">
							<a class="button" href="#">Partager une photo</a>
						</li>
						<li>
							<a href="public/src/logout.php"><i class="fas fa-bell"></i></a>
						</li>
						<li>
							<a href="public/src/user.php"><i class="fas fa-user-circle"></i></a>
						</li>
					<?php else : ?>
						<li class="button-share-photo tablette">
							<a href="#"><i class="fas fa-plus-square"></i></a>
						</li>
						<li class="button-share-photo desktop">
							<a class="button" href="public/src/login.php">Partager une photo</a>
						</li>
						<li>
							<a href="public/src/login.php">S'identifier</a>
						</li>
						<li>
							<a href="public/src/signup.php">S'enregistrer</a>
						</li>
					<?php endif ?>
				</ul>
			</nav>
		</header>
		<main>
			<?php if( array_key_exists("connected", $_SESSION) && $_SESSION['connected']): ?>
			<section>
				<a href="public/src/admin.php">Administration</a>
			</section>
			<?php endif ?>

			<!-- <section id="presentation">
				<div id="recherche">
					<h1>Popup!</h1>
					<h2>Partage de photos, gratuites, et socialement connectées:</h2>
					<form action="">
						<button><i class="fas fa-search"></i></button>
						<input type="search" placeholder="Rechercher une photo">
					</form>
					<p>Les recherches du moment: <a href="#">fleurs</a> <a href="#">fonds d'écran</a> <a href="#">arrière-plans</a> <a href="#">triste</a> <a href="#">amour</a></p>
				</div>
			</section> -->

			<section id="gallery">
				<div class="grid are-images-unloaded">
					<div class="grid__col-sizer"></div>
					<div class="grid__gutter-sizer"></div>

					<?php for($i = 0; $i < sizeof($photos); $i++): ?>
					<div class="grid__item">
						<a title="Voir la photo de <?= $photos[$i]['Firstname'] ?> <?= $photos[$i]['Lastname']?>" href="public/src/viewPhoto.php?photo_Id=<?= $photos[$i]['id'] ?>">
							<img 
							sizes="(min-width: 992px) calc(calc(100vw - 5rem) / 3), (min-width: 768px) calc(calc(100vw - 4rem) / 2), 100vw" 
							srcset="
							files/<?= $photos[$i]['user_Id'].'_'.strtolower($photos[$i]['Firstname']).'_'.strtolower($photos[$i]['Lastname']) ?>/thumbs/<?= $photos[$i]['150w'] ?> 150w,
							files/<?= $photos[$i]['user_Id'].'_'.strtolower($photos[$i]['Firstname']).'_'.strtolower($photos[$i]['Lastname']) ?>/thumbs/<?= $photos[$i]['300w'] ?> 300w,
							files/<?= $photos[$i]['user_Id'].'_'.strtolower($photos[$i]['Firstname']).'_'.strtolower($photos[$i]['Lastname']) ?>/thumbs/<?= $photos[$i]['500w'] ?> 500w,
							files/<?= $photos[$i]['user_Id'].'_'.strtolower($photos[$i]['Firstname']).'_'.strtolower($photos[$i]['Lastname']) ?>/thumbs/<?= $photos[$i]['768w'] ?> 768w,
							files/<?= $photos[$i]['user_Id'].'_'.strtolower($photos[$i]['Firstname']).'_'.strtolower($photos[$i]['Lastname']) ?>/thumbs/<?= $photos[$i]['1024w'] ?> 1024w
							"
							src="files/<?= $photos[$i]['user_Id'].'_'.strtolower($photos[$i]['Firstname']).'_'.strtolower($photos[$i]['Lastname']) ?>/thumbs/<?= $photos[$i]['1024w'] ?>"
							alt="Photo gratuite partagée sur Popup!"
							>
						</a>
						<div>
							<div class="effect-hover"></div>
							<div class="infos-top">
								<div class="buttons-top">
									<a title="Like photo" class="button photo-button" href="/">
										<i class="fas fa-heart"></i>
									</a>
									<!-- <div class="add-to-collec">
										<a title="Add to collection" class="_1QwHQ _1l4Hh _1CBrG _1zIyn xLon9 _3dBbn _2L6Ut _2Xklx" href="/?modal=%7B%22tag%22%3A%22AddToCollection%22%2C%22value%22%3A%7B%22step%22%3A%22AddToCollection%22%2C%22photoId%22%3A%22on4iXApWLh0%22%7D%7D">
											
											<span class="_1eyJo">Collect</span>
										</a>
									</div> -->
								</div>
							</div>
							<div class="infos-bottom">coucou</div>
						</div>
					</div>
					<?php endfor; ?>
				</div>

				<!-- status elements -->
				<div class="page-load-status">
					<div class="loader-ellips infinite-scroll-request">
						<span class="loader-ellips__dot"></span>
						<span class="loader-ellips__dot"></span>
						<span class="loader-ellips__dot"></span>
						<span class="loader-ellips__dot"></span>
					</div>
					<p class="infinite-scroll-last">End of content</p>
					<p class="infinite-scroll-error">No more pages to load</p>
				</div>
				
				<!-- pagination has path -->
				<?php if($pageCourante != $pagesTotales): ?>
				<p class="pagination">
					<a class="pagination__next" href="index.php?page=<?= $pageCourante+1 ?>">Next page</a>
				</p>
				<?php endif; ?>
			
				<!-- <div class="pagination">
				<?php 
					for($i = 1; $i <= $pagesTotales; $i++){
						if($i == $pageCourante){
							echo $i;
						} elseif($i == $pageCourante+1) {
							echo '<a href="index.php?page=' . $i . '" class="pagination__next">' . $i . '</a> ';
						} else {
							echo '<a href="index.php?page=' . $i . '">' . $i . '</a> ';
						}
					}
				?>
				</div> -->
			</section>

			<!-- <section id="photos-mobile">
				<div class="colonne" id="colonne">
					<div class="container-photo">
						<div class="info-photo">
							<div class="avatar">
								<a href="#">
									<img src="public/avatar/profile-fb-1520251127-bf82d47e3135.jpg" alt="Photo de profil de...">
								</a>
							</div>
							<div class="author">
								<a href="#">
									<p>Daiga Ellaby</p>
								</a>
							</div>
						</div>
						<div class="photo">
							<a href="#">
								<img src="public/images/xiyaan-maldives-L1TGflJrqTM-unsplash.jpg" alt="Photo gratuite partagée sur Popup!">
							</a>
						</div>
						<div class="interaction-photo">
							<a href="#" class="button"><i class="fas fa-heart"></i></a>
							<a href="#" class="button"><i class="fas fa-plus"></i></a>
							<a href="#" class="button"><i class="fas fa-arrow-down"></i></a>
						</div>
					</div>

					<div class="container-photo">
						<div class="info-photo">
							<div class="avatar">
								<a href="#">
									<img src="public/avatar/profile-1528743432375-fe0572215100.jpeg" alt="Photo de profil de...">
								</a>
							</div>
							<div class="author">
								<a href="#">
									<p>Daiga Ellaby</p>
								</a>
							</div>
						</div>
						<div class="photo">
							<a href="#">
								<img src="public/images/daiga-ellaby-hZvx336dhAg-unsplash.jpg" alt="Photo gratuite partagée sur Popup!">
							</a>
						</div>
						<div class="interaction-photo">
							<a href="#" class="button"><i class="fas fa-heart"></i></a>
							<a href="#" class="button"><i class="fas fa-plus"></i></a>
							<a href="#" class="button"><i class="fas fa-arrow-down"></i></a>
						</div>
					</div>
					
				</div>
			</section> -->

			<!-- <section id="photos">
				<div class="colonnes" id="colonne1">
					<img src="public/images/lianhao-qu-1574692-unsplash.jpg" alt="Photo gratuite partagée sur Popup!">
					<img src="public/images/analise-benevides-1573789-unsplash.jpg" alt="Photo gratuite partagée sur Popup!">
				</div>
				<div class="colonnes" id="colonne2">
					<img src="public/images/pawel-czerwinski-1574309-unsplash.jpg" alt="Photo gratuite partagée sur Popup!">
					<img src="public/images/josh-hild-1574362-unsplash.jpg" alt="Photo gratuite partagée sur Popup!">
				</div>
				<div class="colonnes" id="colonne3">
					<img src="public/images/simon-zhu-1574915-unsplash.jpg" alt="Photo gratuite partagée sur Popup!">
					<img src="public/images/kelsey-curtis-1570051-unsplash.jpg" alt="Photo gratuite partagée sur Popup!">
				</div>
			</section> -->

			<?php if( array_key_exists("connected", $_SESSION) && $_SESSION['connected']): ?>
			<section id="share-photo" class="hide">
				<button type="button" id="close-share-photo">
					<i class="fas fa-times"></i>
				</button>
				<div id="position-share-photo">
					<div id="container-share-photo">
						<div id="overflow-container-share-photo">
							<div id="container-share-photo-form">
								<div id="header-share-photo-form">
									<h4>Publiez vos premières photos!</h4>
									<p>Il vous reste <span class="nombre-upload">10</span> téléchargements.</p>
								</div>
								<form action="#" id="share-photo-form" enctype="multipart/form-data">
									<div id="container-upload-photo">
										<label for="upload-photo">
											<div id="box1-upload-photo">
												<img src="public/images/1x.png" id="visuel">
												<div>
													Déplacez vos photos ici :
												</div>
											</div>
											<!-- <div id="box2-upload-photo">
												<ul>
													<li>
														<strong>Photos de haute qualité</strong> (au moins <strong>5 MP</strong>)
													</li>
													<li>
														Les photos sont <strong>claires et originales</strong>
													</li>
												</ul>
												<ul>
													<li>
														Téléchargez uniquement des photos pour lesquelles vous <strong>détenez les droits</strong>
													</li>
													<li>
														Tolérance zéro pour la nudité, la violence ou la haine
													</li>
												</ul>
												<ul>
													<li>
														Respecter la propriété intellectuelle d'autrui
													</li>
													<li>
														Lire les <a href="/terms" target="_blank">termes de Popup!</a> 
													</li>
												</ul>
											</div> -->
											<input type="file" id="upload-photo" name="fichier[]" accept="image/jpeg" multiple>
										</label>
									</div>
									<div id="footer-share-photo-form">
										<a class="_22m_Y" target="_blank" href="/license">Lire la licence de Popup!</a>
										<div id="footer-share-photo-form-buttons">
											<input type="reset" value="Annuler" class="button" id="cancel-upload-photo">
											<input type="submit"  value="Publier sur Popup!" class="button" disabled>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php endif ?>
		</main>
		<script src="public/libs/jquery214.js"></script>
		<script src="public/scripts/masonry.js"></script>
		<script src="public/scripts/infinite-scroll.js"></script>
		<script src="public/scripts/main.js"></script>
		<script src="public/scripts/upload-photo.js"></script>
	</body>
</html>