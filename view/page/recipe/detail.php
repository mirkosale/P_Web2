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
					echo '<h3>Ingredients</h3> <p>' . $recipe[0]["recListOfItems"] . '</p>';
					echo '<h3>Préparation</h3> <p>' . $recipe[0]["recPreparation"] . '</p>';
					?>
				</div>
			</div>
		</div>
		<!-- Affichage de la note -->
		<?php
			echo '<p>Votre note actuelle : ' . $note[0]["notStars"] . '</p>';
		
			echo '<a href="?controller=note&action=delete&id=' . $note[0]['idNote'] . '">Supprimer la note</a>';
		?>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<a href="index.php?controller=recipe&action=list">Retour à la liste des Recettes</a>
			</div>
		</div>
	</div>
</body>