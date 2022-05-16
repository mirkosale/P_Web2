<body class="sub_page">
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Contact
                </h2>
                <p style="color:red">*Informations obligatoires</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <form action="?controller=recipe&action=checkContact">
                            <div>
                                <label for="name"><a style="color:red">*</a>Nom</label>
                                <input type="text" class="form-control" id="name" name="name" />
                            </div>
                            <div>
                                <label for="email"><a style="color:red">*</a>Email</label>
                                <input type="email" class="form-control" id="email" name="email" />
                            </div>
                            <div>
                                <label for="adress">Adresse</label>
                                <textarea id="adress" name="adress"></textarea>
                            </div>
                            <div>
                                <label for="phoneNumber">Numero de téléphone</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" />
                            </div>
                            <div>
                                <label for="message"><a style="color:red">*</a>Message</label>
                                <textarea id="message" name="message" rows="10"></textarea>
                            </div>
                            <div class="btn_box">
                                <button type="submit">
                                    Envoyer
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