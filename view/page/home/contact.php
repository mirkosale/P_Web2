<body class="sub_page">
  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Book A Table
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="?controller=recipe&action=checkContact">
              <div class="was-validated">
                <label for="name"><a style="color:red">*</a>Nom de la recette</label>
                <input type="text" class="form-control" id="firstname" name="firstname" />
              </div>
              <div>
                <label for="typedish"><a style="color:red">*</a>Type de recette</label>
                <input type="text" class="form-control" id="typedish" name="typedish" />
              </div>
              <div>
                <label for="itemList"><a style="color:red">*</a>Liste des ingrédients</label>
                <textarea id="itemList" name="itemList"  rows="5"></textarea>
              </div>
              <div>
                <label for="preparation"><a style="color:red">*</a>Préparation</label>
                <textarea id="preparation" name="preparation" rows="10"></textarea>
              </div>
              <div>
                <label for="downloadFile"><a style="color:red">*</a>Image</label>
                <br>
                <input type="file" name="downloadFile" id="downloadFile" />
              </div>
              <div class="btn_box">
                <button>
                  Book Now
                </button>
              </div>
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