<body class="sub_page">
    <section class="book_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <?php
                            #Affiche toutes les erreurs lors de la validation de la page de contact
                            foreach ($errors as $error) {
                                echo '<li>' . $error . '</li>';
                            }
                        ?>
                    </ul>
                    <div class="form_container">
                        <div class="btn-box">
                            <button><a href="javascript:window.history.back();" style="color:white;">Retour en arrière</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>