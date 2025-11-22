<?php

if ( ! defined( 'ABSPATH' ) ) {
    die();
}

?>

<div id = "navbar" class="badfennec-navbar">
	
    <div class="badfennec-navbar__content">

        <div class="container">

            <div class="badfennec-navbar__container">
                <div class="badfennec-navbar__logo text-pink-600">
                    <a class="font-medium" href="<?php echo home_url('/') ?>">LOGO</a>
                </div><!-- .logo -->

                <div class="badfennec-navbar__hamb">
                    <span id = "hamb" class="" role = "button" aria-label = "Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span><!-- #hamb -->

                </div><!-- .badfennec-navbar__hamb -->
                
                <div class="badfennec-navbar__navigation">

                    <div class = "navbar__navigation-wrapper">
                    
                        <nav class="badfennec-navbar__main-navigation">
                            <?php wp_nav_menu( array( 'theme_location' => 'main-navigation', 'menu_class' => 'main-navigation', 'container' => 'ul' ) ); ?>
                        </nav>

                    </div><!-- .navbar__navigation-wrapper -->

                </div><!-- .badfennec-navbar__navigation -->

                <?php \Badfennec\Frontend\Components::get_component('header-cart'); ?>

            </div><!-- .badfennec-navbar__container -->
            
        </div><!-- .container -->

    </div><!-- .badfennec-navbar__content -->

</div><!-- #navbar -->