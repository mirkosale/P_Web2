<body class="sub_page">
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Ajouter une recette
                </h2>
                <p style="color:red">*Informations obligatoires</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <form action="index.php?controller=recipe&action=checkAdd" method="post"
                            enctype="multipart/form-data">
                            <?php
                            foreach($recipes as $recipe)
                            {

              echo '<div>';
              echo '<label for="name"><a style="color:red">*</a>Nom de la recette</label>';
              echo '<input type="text" class="form-control" id="name" name="name" value="' . $recipe["recName"] . '" />';
              echo '</div>' . '<div>';
              echo '<label for="typedish"><a style="color:red">*</a>Type de plat</label>';
              echo '<br>';
              echo '<select name="typedish" id="typedish">';
                  foreach ($typedish as $typedishName) {
                    if ($nameSection["secName"] == $teacher["secName"]) {
                        echo '<option value=' . $typedishName["idTypeDish"] . 'selected>' . $typedishName["typName"] . '</option>';
                    } else {
                        echo '<option value=' . $typedishName["idTypeDish"] . '>' . $typedishName["typName"] . '</option>';
                    }
                  }
                echo '</select>';
                echo '</div>' . '<div>';
                echo '<label for="itemList"><a style="color:red">*</a>Liste des ingrédients</label>';
                echo '<textarea id="itemList" name="itemList" rows="5">' . $recipe["recListOfItems"] . '</textarea>';
                echo '</div>' . '<div>';
                echo '<label for="preparation"><a style="color:red">*</a>Préparation</label>';
                echo '<textarea id="preparation" name="preparation" rows="10">' . $recipe["recPreparation"] . '</textarea>';
                echo '</div>' . '<div>';
                echo '<label for="image"><a style="color:red">*</a>Image</label>' . '<br>';
                echo '<input type="file" name="image" id="image" />' . '</div>';
                }
                ?>
                    <button type="submit">
                        Ajouter la recette
                    </button>
                    </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="map_container ">
                        <div id="googleMap"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>