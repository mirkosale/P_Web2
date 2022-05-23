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
                    <form action="index.php?controller=recipe&action=checkUpdateRecipe" method="post" enctype="multipart/form-data">
                        <?php
                        #Affichage de la recette choisie et affiche toutes ses informations
                        foreach ($recipes as $recipe) {
                            #Image
                            echo '<div class="text-topRight">' . '<div class="imgDetail">' . '<h4 class="oldImage imgDetail"> Ancienne image </h4>';
                            echo '<img class="imgDetail" src="./resources/images/' . $recipe['recImage'] . '" alt="Image de : ' . $recipe['recName'] . '">';
                            echo '</div>' . '</div>';
                            echo '<div class="row">' . '<div class="w100">';
                            echo '<input type="hidden" id="id" name="id" value="' . $recipe['idRecipe'] . '">';
                            echo '<input type="hidden" id="image" name="imagePath" value="resources/images/' . $recipe['recImage'] . '">';
                            #Nom de la recette
                            echo '<label for="name"><a style="color:red">*</a>Nom de la recette</label>';
                            echo '<input type="text" class="form-control" id="name" name="name" value="' . $recipe["recName"] . '" />';
                            echo  '</div>' . '<div  class="w100">' . '<br>';
                            echo '<label for="typedish"><a style="color:red">*</a>Type de plat</label>';
                            echo '<br>';
                            #Select permettant changer le type de recette
                            echo '<select name="typedish" id="typedish">';
                            foreach ($dishTypes as $typedishName) {
                                if ($typedishName["typName"] == $recipe["typName"]) {
                                    echo '<option value=' . $typedishName["idTypeDish"] . ' selected>' .
                                        $typedishName["typName"] . '</option>';
                                } else {
                                    echo '<option value=' .
                                        $typedishName["idTypeDish"] . '>' . $typedishName["typName"] . '</option>';
                                }
                            }
                            echo '</select>';
                            echo '</div>' . '<div  class="w100">';
                            #Liste des ingrédients
                            echo '<label for="itemList"><a style="color:red">*</a>Liste des ingrédients</label>';
                            echo '<textarea id="itemList" name="itemList" rows="5">' . $recipe["recListOfItems"]
                                . '</textarea>';
                            echo '</div>' . '<div  class="w100">';
                            echo '<label for="preparation"><a style="color:red">*</a>Préparation</label>';
                            echo '<textarea id="preparation" name="preparation" rows="10">' .
                                $recipe["recPreparation"] . '</textarea>';
                            echo '</div>' . '<div  class="w100">';
                            
                            #Import nouvel image
                            echo '<label for="image">Nouvelle image</label>' . '<br>';
                            echo '<input type="file" name="image" id="image">' . '</div>';
                        } ?>
                        <button type="submit" name="btnSubmit" id="btnSubmit">
                            Modifier la recette
                        </button>
                        <br>
                </div>
                </form>
            </div>
            <div class="btn-box">
                <a href="?controller=recipe&action=list">
                    RETOUR AUX RECETTES
                </a>
            </div>
        </div>
        </div>
    </section>