<body class="sub_page">
  <!-- food section -->

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Menu
        </h2>
      </div>


      <ul class="filters_menu">
        <?php
        echo '<a href ="?controller=recipe&action=list&sort=all"><li';
        if (!isset($_GET['sort']) || $_GET['sort'] == 'all') {
          echo ' class="active"';
        }
        echo '>All</li></a>';

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
                      <h6>
                        Voir en détail
                      </h6>
                      <?php echo '<a href="?controller=recipe&action=updateRecipe&id=' . $recipe['idRecipe'] . '">'; ?>
                      <img src="resources/images/edit.png" alt="Edit logo">
                      </a>
                      <?php echo '<a href="?controller=recipe&action=detail&id=' . $recipe['idRecipe'] . '">'; ?>
                      <img src="./resources/images/detail.png" alt="Voir en détail">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="btn-box">
        <a href="index.php?controller=recipe&action=addRecipe">
          Ajouter une recette
        </a>
      </div>
    </div>
  </section>

  <!-- end food section -->