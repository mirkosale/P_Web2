<div class="hero_area">
    <div class="bg-box">
        <img src='./resources/bootstrap/images/hero-bg.jpg' alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="?controller=home&action=index">
                    <span>
                        Recettes
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav  mx-auto ">

                        <?php
                        if ($_GET['controller'] == 'home' && $_GET['action'] == 'index') {
                        ?>
                            <li class="nav-item active">
                                <a class="nav-link" href="?controller=home&action=index">Accueil <span class="sr-only">(current)</span></a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="?controller=home&action=index">Accueil</a>
                            </li>
                        <?php } ?>
                        <?php
                        if ($_GET['controller'] == 'recipe' && $_GET['action'] == 'list') {
                        ?>
                            <li class="nav-item active">
                                <a class="nav-link" href="?controller=recipe&action=list">Recettes <span class="sr-only">(current)</span></a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="?controller=recipe&action=list">Recettes</a>
                            </li>
                        <?php } ?>
                        <?php
                        if ($_GET['controller'] == 'home' && $_GET['action'] == 'contact') {
                        ?>
                            <li class="nav-item active">
                                <a class="nav-link" href="?controller=home&action=contact">Contact <span class="sr-only">(current)</span></a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="?controller=home&action=contact">Contact</a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="user_option">
                        <a href="?controller=user&action=connection" class="user_link">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </a>
                        
                        <form action="?controller=recipe&action=search" class="form-inline" >
                        <?php 
                            echo"<input type='search' class='searchbar' textdidchange= id='searchbar' name='searchbar' />";
                        ?>
                        <input type="submit" name="searchSubmit" class="order_online" value="Chercher">
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- end header section -->
</div>