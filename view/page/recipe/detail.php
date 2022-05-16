<body class="sub_page">
	<div class="container">
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
					echo '<h3>Ingredients</h3>';
					$ingredients = explode(",", $recipe[0]["recListOfItems"]);

					echo "<ul>";
					foreach ($ingredients as $ingredient) {
						echo "<li>$ingredient</li>";
					}
					echo "</ul>";
					echo '<h3>Préparation</h3> <p>';
					echo '<p>' . $recipe[0]["recPreparation"] . '</p>';
					if (isset($note[0]['notStars'])) {
						echo '<a href="?controller=note&action=delete&idRecipe=' . $recipe[0]['idRecipe'] .'&idNote=' . $note[0]['idNote'] . '">Supprimer la note</a>';
					} else {
						echo "<h3>Attribuer une note</h3>";
					?>
						<div class="form_container">
							<?php
								echo '<form action="?controller=note&action=add&id=' . $recipe[0]['idRecipe'] . '" method="post" enctype="multipart/form-data">';
								echo '<input type="hidden" value="' . $recipe[0]['idRecipe'] . '" name="idRecipe" id="idRecipe">';
							?>
							<div class="star-rating">
								<input type="radio" name="stars" value="9" id="star-1"><label for="star-1">☆</label>
								<input type="radio" name="stars" value="7" id="star-2"><label for="star-2">☆</label>
								<input type="radio" name="stars" value="5" id="star-3"><label for="star-3">☆</label>
								<input type="radio" name="stars" value="3" id="star-4"><label for="star-4">☆</label>
								<input type="radio" name="stars" value="1" id="star-5"><label for="star-5">☆</label>
							</div>
							<?php ?>
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
</body>