<main>
	<section id="presentation-user">
		<div id="user">
			<h1><?= $_SESSION["firstname"] ?> <?= $_SESSION["lastname"] ?></h1>
			<h2><?= $_SESSION["username"] ?></h2>
			<div id="action-user">
				<a href="editUserProfil.php" class="button white-button">Modifier votre profil</a>
				<a href="editUserpassword.php" class="button white-button">Changer votre mot de passe</a>
				<a href="logout.php" class="button black-button">Déconnexion</a>
			</div>
		</div>
		<h2>Mes photos : </h2>
	</section>

	<section id="gallery">
		<div class="grid are-images-unloaded">
			<div class="grid__col-sizer"></div>
			<div class="grid__gutter-sizer"></div>

			<?php foreach ($photos as $photo) : ?>
				<div class="grid__item <?= $photo['category_Id'] ?>">
					<a title="Afficher la photo originale dans un nouvel onglet" target="_blank" href="../files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/<?= $photo['name'] ?>">
						<img sizes="(min-width: 992px) calc(calc(100vw - 5rem) / 3), (min-width: 768px) calc(calc(100vw - 4rem) / 2), 100vw" srcset="
						../files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['150w'] ?> 150w,
						../files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['300w'] ?> 300w,
						../files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['500w'] ?> 500w,
						../files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['768w'] ?> 768w,
						../files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['1024w'] ?> 1024w" src="../files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['1024w'] ?>" alt="Photo gratuite partagée sur Popup!" />
					</a>
					<div>
						<div class="effect-hover"></div>
						<div class="infos-bottom">
							<p class="auteur">
								<a href="theme.php?category_Id=<?= $photo['category_Id'] ?>"><?= $photo['category_name'] ?></a>
							</p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<!-- status elements : plugin Infinite scroll / JQUERY -->
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

		<!-- pagination has path : plugin Infite scroll / JQUERY -->
		<?php if ($pageCourante != $pagesTotales) : ?>
			<p class="pagination">
				<a class="pagination__next" href="accountUser.php?user_Id=<?= $user_Id ?>&page=<?= $pageCourante + 1 ?>">Next page</a>
			</p>
		<?php endif; ?>
	</section>

	<?php if (array_key_exists("connected", $_SESSION) && $_SESSION['connected']) : ?>
		<!-- Modal d'upload de photos -->
		<aside id="modal-share-photos" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none;">
			<button type="button" class="js-modal-close" id="close-share-photo">
				<p>Fermer la boite modale</p><i class="fas fa-times"></i>
			</button>
			<div class="modal-wrapper js-modal-stop">
				<div id="container-share-photo">
					<div id="overflow-share-photo-form">
						<div id="container-share-photo-form">
							<div id="header-share-photo-form">
								<h4>Publiez vos photos sur Popup!</h4>
								<p class="upload-restant">Il vous reste <span class="nombre-upload">10</span> téléchargements.</p>
							</div>
							<form id="share-photo-form">
								<div id="body-share-photo-form">
									<label for="upload-photo">
										<div id="box-upload-photo">
											<img src="../public/images/1x.png" id="image-upload">
											<p>Déplacez vos photos ici :</p>
											<p class="upload-restant">Il vous reste <span class="nombre-upload">10</span> téléchargements.</p>
										</div>
									</label>
									<input type="file" id="upload-photo" accept="image/jpeg" multiple>
								</div>
								<div id="footer-share-photo-form">
									<div id="footer-share-photo-form-buttons">
										<button type="button" class="button white-button js-modal-close" id="cancel-upload-photo">Annuler</button>
										<button type="submit" class="button black-button" id="valid-upload-photo" disabled>Publier sur Popup!</button>
									</div>
									<a href="#">Lire la licence de Popup!</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</aside>
	<?php endif ?>
</main>