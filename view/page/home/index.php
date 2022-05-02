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
                We Are Feane
              </h2>
            </div>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
              in some form, by injected humour, or randomised words which don't look even slightly believable. If you
              are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
              the middle of text. All
            </p>
            <a href="">
              Read More
            </a>
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
              <?php echo '<img src="./resources/images/' . $latestRecipe[0]['recImage'] . '" alt="Image de : ' . $latestRecipe[0]['recName'] .  '">'; ?>
            </div>
            <div class="detail-box">
              <h4>
                <?php echo $latestRecipe[0]['recName']; ?>
              </h4>
              <p>
              </p>
              <div class="options">
                <h6>
                  Voir en détail
                </h6>
                <?php echo '<a href="?controller=recipe&action=detail&id=' . $latestRecipe[0]['idRecipe'] . '">'; ?>
                <img src="./resources/images/detail.png" alt="Voir en détail">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4 all pizza"></div>

    </div>
    <div class="btn-box">
      <a href="?controller=recipe&action=list">
        Voir plus
      </a>
    </div>
    </div>
  </section>

  <!-- end food section -->