<body class="sub_page">
  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Contact 
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="?controller=recipe&action=checkContact" method="post">
              <div class="was-validated">
                <label for="firstname"><a style="color:red">*</a>Nom</label>
                <input type="text" class="form-control" id="firstname" name="firstname" />
              </div>
              <div>
                <label for="email"><a style="color:red">*</a>Email</label>
                <input type="email" class="form-control" id="typedish" name="email" />
              </div>
              <div>
                <label for="address"><a style="color:red">*</a>Adresse</label>
                <textarea id="itemList" name="address"></textarea>
              </div>
              <div>
                <label for="phoneNumber"><a style="color:red">*</a>Numero de téléphone</label>
                <textarea id="text" name="phoneNumber"></textarea>
              </div>
              <div>
                <label for="message"><a style="color:red">*</a>Message :</label>
						    <textarea id="preparation" name="message" rows="10"></textarea>
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