<main>
	<section id="presentation">
		<div id="titles">
			<h1>Popup!</h1>
			<h2>Partage de photos réutilisables, gratuites, en haute définition</h2>
		</div>
	</section>

	<section id="gallery">
		<div class="grid are-images-unloaded">
			<div class="grid__col-sizer"></div>
			<div class="grid__gutter-sizer"></div>

			<?php foreach ($photos as $photo) : ?>
				<div class="grid__item <?= $photo['category_Id'] ?>">
					<a title="Afficher la photo originale de <?= $photo['Firstname'] ?> <?= $photo['Lastname'] ?> dans un nouvel onglet" target="_blank" href="files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/<?= $photo['name'] ?>">
						<img sizes="(min-width: 992px) calc(calc(100vw - 5rem) / 3), (min-width: 768px) calc(calc(100vw - 4rem) / 2), 100vw" srcset="
						files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['150w'] ?> 150w,
						files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['300w'] ?> 300w,
						files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['500w'] ?> 500w,
						files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['768w'] ?> 768w,
						files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['1024w'] ?> 1024w" src="files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['1024w'] ?>" alt="Photo gratuite partagée sur Popup!" />
					</a>
					<div>
						<div class="effect-hover"></div>
						<!-- Emplacement prévu pour ajouter des fonctionnalités, tel que la possibilité de "liker" une photo -->
						<!-- <div class="infos-top">
							<div class="buttons-top">
								<a title="Like photo" class="button photo-button" href="/">
									<i class="fas fa-heart"></i>
								</a>
							</div>
						</div> -->
						<div class="infos-bottom">
							<p class="auteur">
								<a href="src/author.php?user_Id=<?= $photo['user_Id'] ?>"><?= $photo['Firstname'] . " " . $photo['Lastname'] ?></a>
							</p>
							<div class="buttons-bottom">
								<a title="Télécharger la photo" download="<?= $photo['name'] ?>" class="button photo-button" href="files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/<?= $photo['name'] ?>">
									<i class="fas fa-arrow-down"></i>
								</a>
							</div>
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
				<a class="pagination__next" href="index.php?page=<?= $pageCourante + 1 ?>">Next page</a>
			</p>
		<?php endif; ?>
	</section>

	<!-- On vérifie que l'utilisateur est connecté à la session pour accéder au modal d'upload de photo -->
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
											<img src="public/images/1x.png" id="image-upload">
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