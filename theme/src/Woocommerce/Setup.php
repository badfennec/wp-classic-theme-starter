<?php

namespace Badfennec\Woocommerce;

if ( ! defined( 'ABSPATH' ) )
    die();

class Setup {
    
    public function register(): void
    {
        add_action( 'after_setup_theme', [__CLASS__, 'after_setup_theme'] );
    }

    public static function after_setup_theme(): void
    {
        add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		//add_theme_support( 'wc-product-gallery-lightbox' );
    }

}