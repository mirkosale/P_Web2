<body class="sub_page">
    <section class="food_section layout_padding book_section">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Modifier une recette
                </h2>
                <p style="color:red">*Informations obligatoires</p>
            </div>
            <div class="row">
                    <div class="form_container">
                        <form action="index.php?controller=recipe&action=checkUpdateRecipe" method="post"
                            enctype="multipart/form-data">
                            <?php
                            foreach($recipes as $recipe)
                            {
                            echo '<div>';
                            echo '<input type="hidden" id="id" name="id" value="' . $recipe['idRecipe'] . '">';
                            echo '<label for="name"><a style="color:red">*</a>Nom de la recette</label>';
                            echo '<input type="text" class="form-control" id="name" name="name" value="' . $recipe["recName"] . '" />';
                            echo '</div>' . '<div>';
                            echo '<label for="typedish"><a style="color:red">*</a>Type de plat</label>';
                            echo '<br>';
                            echo '<select name="typedish" id="typedish">';
                            foreach ($dishTypes as $typedishName) {
                                if ($typedishName["typName"] == $recipe["typName"]) {
                                    echo '<option value=' . $typedishName["idTypeDish"] . ' selected>' . $typedishName["typName"] . '</option>';
                                }
                                else {
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
                            echo '<label for="image">Nouvelle image</label>' . '<br>';
                            echo '<input type="file" name="image" id="image">' . '</div>';
                            }
                            ?>
                            <div class="oldImage">
                                <h4 class="oldImage"> Ancienne image </h4>
                            </div>
                            <div class="col-sm-6 col-lg-4 all pizza">
                                <div class="box">
                                    <div>
                                        <div class="img-box">
                                            <?php echo '<img src="./resources/images/' . $recipe['recImage'] . '" alt="Image de : ' . $recipe['recName'] . '">'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit">
                                Modifier la recette
                            </button>
                            <div class="btn-box">
                                <a href="?controller=recipe&action=list">
                                    Retour aux recettes
                                </a>
                            </div>
                        </form>
                </div>
                <div class="col-md-6">
                    <div class="map_container ">
                        <div id="googleMap"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>