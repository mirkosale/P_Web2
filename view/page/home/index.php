<body class="sub_page">

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src='./resources/bootstrap/images/about-img.png' alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
               Site sur des recettes 
              </h2>
            </div>
            <p>
              Dans ce site, nous avons mis à disposition une liste de recettes avec les informations nécessaires à la création d’un plat 
              et pour simplifier la recherche de recettes, une barre de recherche est ajoutée sur le site.
              Nous avons également mis à disposition un moyen de se connecter afin de voir les informations des recettes.
              Puis pour finir il existe également un moyen de nous contacter en cas de problème ou si vous souhaitez donner des idées pour le site.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->


  <!-- food section -->

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Dernière recette
        </h2>
      </div>


      <div class="filters-content">
      <div class="row grid">
      <div class="col-sm-6 col-lg-4 all pizza"></div>

      <div class="col-sm-6 col-lg-4 all pizza">
              <div class="box">
                <div>
                  <div class="img-box">
                    <?php echo '<img src="./resources/images/' . $latestRecipe[0]['recImage'] . '" alt="Image de : ' . $latestRecipe[0]['recName'] . '">'; ?>
                  </div>
                  <div class="detail-box">
                    <?php echo '<h5>' . $latestRecipe[0]['recName'] . '</h5>'; ?>
                    <div class="options">
                      <div class="stars">
                        <?php {
                          if (isset($latestRecipe[0]['note'])) {
                            for ($x = 0; $x < 9; $x += 2) {
                              if ($x == $latestRecipe[0]['note']) {
                                echo '<div class="bi-star-half"></div>';
                              } elseif ($x < $latestRecipe[0]['note']) {
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


                      <?php if (isset($_SESSION['useLogin'])) : ?>
                        
                        <?php if (isset($_SESSION['useLogin']) && $_SESSION['useAdministrator'] == 1) : ?>
                          <?php echo '<a href="?controller=recipe&action=updateRecipe&id=' . $latestRecipe[0]['idRecipe'] . '">'; ?>
                          <img src="resources/userContent/images/edit.png" alt="Edit logo">
                          </a>
                          <?php echo '<a href="#" onClick="confirmDeleteRecipe(' . $latestRecipe[0]['idRecipe'] . ')">'; ?>
                          <img src="resources/userContent/images/delete.png" alt="delete logo">
                          </a>
                        <?php endif; ?>

                        <?php echo '<a href="?controller=recipe&action=detail&id=' . $latestRecipe[0]['idRecipe'] . '">'; ?>
                        <img src="./resources/userContent/images/detail.png" alt="Voir en détail">
                        </a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    </div>
    <div class="col-sm-6 col-lg-4 all pizza"></div>

    <div class="btn-box">
      <a href="?controller=recipe&action=list">
        Voir plus
      </a>
    </div>
    </div>
  </section>

  <!-- end food section -->