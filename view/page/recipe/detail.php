<body class="sub_page">
	<section class="food_section layout_padding book_section">
		<div class="container">
			<div class="text-topRight">
				<div class="imgDetail">
					<!-- Affichage de l'image de la recette -->
					<?php echo '<img class="imgDetail" src="./resources/images/' . $recipe[0]['recImage'] . '" alt="Image de : ' . $recipe[0]['recName'] . '">'; ?>
				</div>
			</div>
			<?php
				#Affichage des informations de la recette
				echo "<h1>" . $recipe[0]["recName"] . "</h1>";
				echo "<h2>Type : " . $recipe[0]["typName"] . "</h2>";
			?>

			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="parafsd">
						<?php
						echo '<h3>Ingredients</h3>';

						#Affichage des informations sous forme de liste à puce
						$ingredients = explode(",", $recipe[0]["recListOfItems"]);

						echo "<ul>";
							foreach ($ingredients as $ingredient) {
								echo "<li>$ingredient</li>";
							}
						echo "</ul>";

						echo '<h3>Préparation</h3> <p>';
						echo '<p>' . $recipe[0]["recPreparation"] . '</p>';

						#Check de si l'utilisateur a déjà attribué une note à une recette
						if (isset($note[0]['notStars'])) {
							#Ecriture de la note actuelle avec des étoiles
							echo '<h3>Votre note actuelle</h3>';
							echo '<div class="stars">';
								#Ecriture des notes en étoiles
								for ($x = 0; $x < 9; $x += 2) {
									if ($x == $note[0]['notStars']) {
										echo '<div class="bi-star-half"></div>';
									} elseif ($x < $note[0]['notStars']) {
										echo '<div class="bi-star-fill"></div>';
									} else {
										echo '<div class="bi-star"></div>';
									}
								}
							echo '</div>';
							#Supprime la note
							echo '<div class="form_container">';
							echo '<button><a href="?controller=note&action=delete&idRecipe=' . $recipe[0]['idRecipe'] . '&idNote=' . $note[0]['idNote'] . '"  style="color: white;">Supprimer la note</a></button>';
							echo '</div>';
						} else {
							echo "<h3>Attribuer une note</h3>";
							echo '<div class="form_container">';
								echo '<form action="?controller=note&action=add&id=' . $recipe[0]['idRecipe'] . '" method="post" enctype="multipart/form-data">';
									#Passage de l'ID de la recette en paramètre caché
									echo '<input type="hidden" value="' . $recipe[0]['idRecipe'] . '" name="idRecipe" id="idRecipe">'; ?>

									<!-- 
									Système d'entrée de notes en forme d'étoile
									SRC : https://www.foolishdeveloper.com/2022/01/5-star-rating-html-css.html
									-->
									<div class="star-rating">
										<input type="radio" name="stars" value="9" id="star-1"><label for="star-1">☆</label>
										<input type="radio" name="stars" value="7" id="star-2"><label for="star-2">☆</label>
										<input type="radio" name="stars" value="5" id="star-3"><label for="star-3">☆</label>
										<input type="radio" name="stars" value="3" id="star-4"><label for="star-4">☆</label>
										<input type="radio" name="stars" value="1" id="star-5"><label for="star-5">☆</label>
									</div>
										<button type="submit" name="btnSubmit" id="btnSubmit">Envoyer votre note</button>
								</form>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="btn-box">
						<a href="index.php?controller=recipe&action=list">Retour à la liste des Recettes</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>