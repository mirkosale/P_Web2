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
            <form action="?controller=receipe&action=checkContact">
              <div class="was-validated">
                <label for="name"><a style="color:red">*</a>Nom de la recette</label>
                <input type="text" class="form-control" id="firstname" name="firstname" />
              </div>
              <div>
                <label for="name"><a style="color:red">*</a>Name</label>
                <input type="text" class="form-control" placeholder="Phone Number" />
              </div>
              <div>
                <label for="name"><a style="color:red">*</a>Your firstname</label>
                <input type="email" class="form-control" placeholder="Your Email" />
              </div>
              <div>
                <label for="name"><a style="color:red">*</a>Your firstname</label>
                <input type="date" class="form-control">
              </div>
              <div>
                <label for="name"><a style="color:red">*</a>Your firstname</label>
                <textarea name="" id="" cols="30" rows="10"></textarea>
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