<body class="sub_page">
	<div class="container">

		<h2>
			<?php
			echo "<h2>" . $recipe[0]["recName"] . "</h2>";
			?>
		</h2>
		<h4>
			<?php
				echo "<h4>" . "Type : " . $recipe[0]["typName"] . "</h4>";
			?>
		</h4>
		<div class="img-box">
			<?php echo '<img src="..\..\..\resources\images\ ' . $recipe[0]['recImage'] . '" alt="Image de : ' . $recipe[0]['recName'] . '">'; ?>
		</div>
		<!-- Three columns of text below the carousel -->
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<?php
				echo '<p>ingredients : ' . $recipe[0]["recListOfItems"] . '</p>';
				echo '<p>Préparation : ' . $recipe[0]["recPreparation"] . '</p>';
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