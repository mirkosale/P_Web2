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
            <!-- Forumulaire d'ajout d'une recette -->
            <form action="index.php?controller=recipe&action=checkAdd" method="post" enctype="multipart/form-data">
              <div>
                <label for="name"><a style="color:red">*</a>Nom de la recette</label>
                <input type="text" class="form-control" id="name" name="name" />
              </div>
              <div>
                <label for="typedish"><a style="color:red">*</a>Type de plat</label>
                <br>
                <select name="typedish" id="typedish">
                  <?php
                  #Liste de tous les types de plats
                  foreach ($typedish as $typedishName) {
                    echo '<option value=' . $typedishName["idTypeDish"] . '>' . $typedishName["typName"] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div>
                <label for="itemList"><a style="color:red">*</a>Liste des ingrédients</label>
                <textarea id="itemList" name="itemList" rows="5"></textarea>
              </div>
              <div>
                <label for="preparation"><a style="color:red">*</a>Préparation</label>
                <textarea id="preparation" name="preparation" rows="10"></textarea>
              </div>
              <div>
                <label for="image"><a style="color:red">*</a>Image</label>
                <br>
                <input type="file" name="image" id="image" />
              </div>
              <button type="submit" name="btnSubmit" id="btnSubmit">
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
</body>