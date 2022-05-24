<body class="sub_page">
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Compte
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <form action="index.php?controller=user&action=logout" method="post">
                            <p>Vous êtes actuellement connecté. Votre nom est : <?php echo $_SESSION['useLogin'];?></p>
                            <div class="btn_box">
                                <button type="submit">Se déconnecter</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
    </section>
    </div>
</body>