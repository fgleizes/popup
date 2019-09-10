<main>
	<section id="presentation-theme">
		<div id="titles-theme">
			<!-- <h1>Popup!</h1> -->
			<h1><?= $category["category_name"] ?></h1>
			<h2>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias dolorum quam nesciunt quos consequatur fugit!</h2>
		</div>
	</section>

	<section id="gallery">
		<div class="grid are-images-unloaded">
			<div class="grid__col-sizer"></div>
			<div class="grid__gutter-sizer"></div>

			<?php foreach ($photos as $photo) : ?>
			<div class="grid__item <?= $photo['category_Id'] ?>">
				<a title="Voir la photo de <?= $photo['Firstname'] ?> <?= $photo['Lastname'] ?>" href="../src/viewPhoto.php?photo_Id=<?= $photo['id'] ?>">
					<img sizes="(min-width: 992px) calc(calc(100vw - 5rem) / 3), (min-width: 768px) calc(calc(100vw - 4rem) / 2), 100vw" srcset="
							../../files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['150w'] ?> 150w,
							../../files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['300w'] ?> 300w,
							../../files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['500w'] ?> 500w,
							../../files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['768w'] ?> 768w,
							../../files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['1024w'] ?> 1024w
							" src="../../files/<?= $photo['user_Id'] . '_' . strtolower($photo['Firstname']) . '_' . strtolower($photo['Lastname']) ?>/thumbs/<?= $photo['1024w'] ?>" alt="Photo gratuite partagée sur Popup!">
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
			<?php endforeach; ?>
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
		<?php if ($pageCourante != $pagesTotales) : ?>
		<p class="pagination">
			<a class="pagination__next" href="theme.php?category_Id=<?= $category_Id ?>&page=<?= $pageCourante + 1 ?>">Next page</a>
		</p>
		<?php endif; ?>

		<!-- <div class="pagination">
		<?php
		for ($i = 1; $i <= $pagesTotales; $i++) {
			if ($i == $pageCourante) {
				echo $i;
			} elseif ($i == $pageCourante + 1) {
				echo '<a href="theme.php?page=' . $i . '" class="pagination__next">' . $i . '</a> ';
			} else {
				echo '<a href="theme.php?page=' . $i . '">' . $i . '</a> ';
			}
		}
		?>
		</div> -->
	</section>

	<?php if (array_key_exists("connected", $_SESSION) && $_SESSION['connected']) : ?>
	<!-- <section id="share-photo" class="hide">
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
										<img src="../images/1x.png" id="visuel">
										<div>
											Déplacez vos photos ici :
										</div>
									</div>
									<input type="file" id="upload-photo" name="fichier[]" accept="image/jpeg" multiple>
								</label>
							</div>
							<div id="footer-share-photo-form">
								<a class="_22m_Y" target="_blank" href="/license">Lire la licence de Popup!</a>
								<div id="footer-share-photo-form-buttons">
									<input type="reset" value="Annuler" class="button" id="cancel-upload-photo">
									<input type="submit" value="Publier sur Popup!" class="button" disabled>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<aside id="modal-share-photos" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none;">
		<button type="button" class="js-modal-close" id="close-share-photo">
			<p>Fermer la boite modale</p><i class="fas fa-times"></i>
		</button>
		<div class="modal-wrapper js-modal-stop">
			<!-- <div id="position-share-photo"> -->
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
										<img src="../images/1x.png" id="image-upload">
										<p>Déplacez vos photos ici :</p>
										<p class="upload-restant">Il vous reste <span class="nombre-upload">10</span> téléchargements.</p>
									</div>
								</label>
								<input type="file" id="upload-photo" accept="image/jpeg" multiple>
							</div>
							<div id="footer-share-photo-form">
								<div id="footer-share-photo-form-buttons">
									<!-- <input type="reset" value="Annuler" class="button" id="cancel-upload-photo"> -->
									<button type="button" class="button white-button js-modal-close" id="cancel-upload-photo">Annuler</button>
									<!-- <input type="submit" value="Publier sur Popup!" class="button" id="valid-upload-photo" disabled> -->
									<button type="submit" class="button black-button" id="valid-upload-photo" disabled>Publier sur Popup!</button>
								</div>
								<a class="_22m_Y" target="_blank" href="/license">Lire la licence de Popup!</a>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- </div> -->
		</div>
	</aside>
	<?php endif ?>
</main>