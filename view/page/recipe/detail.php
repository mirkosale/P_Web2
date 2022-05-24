<body class="sub_page">
<<<<<<< HEAD
    <div class="container food_section">

        <div class="text-topRight">
            <div class="imgDetail">
                <?php echo '<img class="imgDetail" src="./resources/images/' . $recipe[0]['recImage'] . '" alt="Image de : ' . $recipe[0]['recName'] . '">'; ?>
                <?php
				?>
            </div>
        </div>
        <?php
		echo "<h1>" . $recipe[0]["recName"] . "</h1>";
		?>

        <?php
		echo "<h2>Type : " . $recipe[0]["typName"] . "</h2>";
		?>

        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="parafsd">
                    <?php
						echo '<h3>Ingredients</h3> <p>' . $recipe[0]["recListOfItems"] . '</p>';
						echo '<h3>Préparation</h3> <p>' . $recipe[0]["recPreparation"] . '</p>';
					?>
                </div>
            </div>
        </div>
        <!-- Affichage de la note -->
        <?php
			if (isset($note[0]['notStars'])) {
				echo '<p>Votre note actuelle : ' . $note[0]["notStars"] . '</p>';
				echo '<a href="?controller=note&action=delete&id=' . $note[0]['idNote'] . '">Supprimer la note</a>';
			} else {
				echo "Attribuer une note";
		?>

        <!-- https://www.foolishdeveloper.com/2022/01/5-star-rating-html-css.html -->
        <div class="row">
            <div class="col-md-6">
                <div class="form_container">
                    <?php echo '<form action="?controller=note&action=add&id=' . $recipe[0]['idRecipe'] . '">'; ?>
                    <div class="btn-box">
                        <button type="submit">Envoyer votre note</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="row">
            <div class="btn-box">
                <a href="index.php?controller=recipe&action=list">Retour à la liste des Recettes</a>
            </div>
        </div>
    </div>
=======
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
						echo '<a href="?controller=note&action=delete&idRecipe=' . $recipe[0]['idRecipe'] . '&idNote=' . $note[0]['idNote'] . '">Supprimer la note</a>';
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
								<div class="btn-box">
									<button type="submit" name="btnSubmit" id="btnSubmit">Envoyer votre note</button>
								</div>
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
>>>>>>> 4fdb30d97e96fc462cb686c2fe420cde4197dcd4
</body>