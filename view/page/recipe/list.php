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
          if (!isset($_GET['sort']) || $_GET['sort'] == 'all')
          {echo ' class="active"';}
          echo '>All</li></a>';

          foreach ($dishTypes as $dishType)
          {
            echo '<a href="?controller=recipe&action=list&sort=' . $dishType['idTypeDish'] . '">';
            if (isset($_GET['sort']) && $_GET['sort'] == $dishType['idTypeDish'])
            {
              echo '<li class="active">';
            }
            else
            {
              echo '<li>';
            }
            echo $dishType['typName'] . '</li></a>';
          }
        ?>
      </ul>

      <div class="filters-content">
        <div class="row grid">
          
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
