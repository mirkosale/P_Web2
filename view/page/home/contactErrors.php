<body class="sub_page">
    <section class="book_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <?php
                            #Affiche toutes les erreurs lors de la validation de la page de 
                            foreach ($errors as $error) {
                                echo '<li>' . $error . '</li>';
                            }

                            echo '<a href="javascript:window.history.back();">Retour en arrière</a>';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

</body>