<body class="sub_page">
	<div class="container">
	<div class="text-topLeft">
		<?php
		echo "<h1>" . $recipe[0]["recName"] . "</h1>";
		?>
		</div>
		<div class="text-topRight">
			<?php
			echo "<h2>Type : " . $recipe[0]["typName"] . "</h2>";
			?>
		</div>
		<div class="img-box">
			<?php echo '<img src="..\..\..\resources\images\ ' . $recipe[0]['recImage'] . '" alt="Image de : ' . $recipe[0]['recName'] . '">'; ?>
		</div>
		<!-- Three columns of text below the carousel -->
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<?php
				echo '<h3>Ingredients</h3> <p>' . $recipe[0]["recListOfItems"] . '</p>';
				echo '<h3>Préparation</h3> <p>' . $recipe[0]["recPreparation"] . '</p>';
				?>
			</div>
		</div>
		<!-- Affichage de la note -->
		<?php
		//echo '<p>Note : ' . $recipe[0]["notStars"] . '</p>';
		?>

		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<a href="index.php?controller=recipe&action=list">Retour à la liste des Recettes</a>
			</div>
		</div>
	</div>
</body>