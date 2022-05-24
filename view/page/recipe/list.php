<body class="sub_page">
  <!-- food section -->

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Liste des recettes
        </h2>
      </div>

      <ul class="filters_menu">
        <?php
        echo '<a href ="?controller=recipe&action=list&sort=all"><li';
        if (!isset($_GET['sort']) || $_GET['sort'] == 'all') {
          echo ' class="active"';
        }
        echo '>Tout</li></a>';

        #Affichage de tous les types de plats et permet à l'utilisateur de trier avec ces boutons
        foreach ($dishTypes as $dishType) {
          echo '<a href="?controller=recipe&action=list&sort=' . $dishType['idTypeDish'] . '">';
          if (isset($_GET['sort']) && $_GET['sort'] == $dishType['idTypeDish']) {
            echo '<li class="active">';
          } else {
            echo '<li>';
          }
          echo $dishType['typName'] . '</li></a>';
        }
        ?>
      </ul>

      <div class="filters-content">
        <div class="row grid">
          <?php
            foreach ($recipes as $recipe) {
          ?>
            <div class="col-sm-6 col-lg-4 all pizza">
              <div class="box">
                <div>
                  <div class="img-box">
                    <?php echo '<img src="./resources/images/' . $recipe['recImage'] . '" alt="Image de : ' . $recipe['recName'] . '">'; ?>
                  </div>
                  <div class="detail-box">
                    <?php echo '<h5>' . $recipe['recName'] . '</h5>'; ?>
                    <div class="options">
                      <div class="stars">
                        <?php 
                        {
                          #Affichage de la moyenne de toutes les notes pour une recette en étoiles
                          if (isset($recipe['note'])) {
                            for ($x = 0; $x < 9; $x += 2) {
                              if ($x == $recipe['note']) {
                                echo '<div class="bi-star-half"></div>';
                              } elseif ($x < $recipe['note']) {
                                echo '<div class="bi-star-fill"></div>';
                              } else {
                                echo '<div class="bi-star"></div>';
                              }
                            }
                          } else {
                            echo 'Pas de notes';
                          }
                        }
                        ?>
                      </div>
                      <?php
                        #Affichage des différents selon si l'utilisateur est connecté et s'il a les droits d'administrateur ou non 
                        if (isset($_SESSION['useLogin'])) {
                          if (isset($_SESSION['useLogin']) && $_SESSION['useAdministrator'] == 1) { ?>
                            <?php echo '<a href="?controller=recipe&action=updateRecipe&id=' . $recipe['idRecipe'] . '">'; ?>
                            <img src="resources/userContent/images/edit.png" alt="Edit logo">
                            </a>
                            <?php echo '<a href="#" onClick="confirmDeleteRecipe(' . $recipe['idRecipe'] . ')">'; ?>
                            <img src="resources/userContent/images/delete.png" alt="delete logo">
                            </a>
                          <?php }
                          echo '<a href="?controller=recipe&action=detail&id=' . $recipe['idRecipe'] . '">'; ?>
                          <img src="./resources/userContent/images/detail.png" alt="Voir en détail">
                          </a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
      <?php if (isset($_SESSION['useLogin']) && $_SESSION['useAdministrator'] == 1) : ?>
        <div class="btn-box">
          <a href="index.php?controller=recipe&action=addRecipe">
            Ajouter une recette
          </a>
        </div>
      <?php endif; ?>
    </div>
  </section>
  <!-- Script de confirmation de suppression d'une recette en javascript -->
  <script>
    function confirmDeleteRecipe($id) {
      if (window.confirm("Voulez-vous supprimer la recette avec l'identifiant n° " + $id + "?")) {
        window.location.replace('index.php?controller=recipe&action=delete&id=' + $id);
      }
    }
  </script>