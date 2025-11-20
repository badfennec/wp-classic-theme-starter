<?php

if ( ! defined( 'ABSPATH' ) ) {
    die();
}

?>

<div id = "navbar" class = "navbar">
	
    <div class = "navbar__content">

        <div class = "container">

            <div class = "navbar__content__container">

                <div class = "navbar__content__container__logo text-pink-600">
                    <a class="font-medium" href="<?php echo home_url('/') ?>">LOGO</a>
                </div><!-- .logo -->

                <div class = "navbar__content__container__hamb">
                    <span id = "hamb" class = "" role = "button" aria-label = "Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span><!-- #hamb -->

                </div><!-- .navbar__content__container__hamb -->
                
                <nav class="navbar__content__container__navigation">
                    
                    <div class = "navbar__content__container__navigation__content">

                        <?php wp_nav_menu( array( 'theme_location' => 'main-navigation', 'menu_class' => 'main-navigation', 'container' => 'ul' ) ); ?>

                    </div>

                </nav><!-- .navbar__content__container__navigation -->

                <?php //vctheme_navigation_woo_cart_counter(); ?>

            </div><!-- .navbar__content__container -->

        </div><!-- .container -->

    </div><!-- .navbar__content -->

</div><!-- #navbar -->