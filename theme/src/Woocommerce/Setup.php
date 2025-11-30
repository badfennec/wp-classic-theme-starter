<?php

namespace BadFennec\Woocommerce;
use BadFennec\Woocommerce\Utils as WoocommerceUtils;

if ( ! defined( 'ABSPATH' ) )
    die();

class Setup implements \BadFennec\Setup\SetupInterface {
    
    public function register(): void
    {
        add_action( 'after_setup_theme', [ $this, 'after_setup_theme'] );
    }

    public function after_setup_theme(): void
    {
        add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		//add_theme_support( 'wc-product-gallery-lightbox' );

        add_action( 'wp', [ $this, 'add_styles'] );
    }

    /**
     * Enqueue WooCommerce specific styles
     * @return void
     */
    public function add_styles(): void
    {

        if( !is_admin() ){

            if( WoocommerceUtils::is_woocommerce_page() ){

                // Enqueue WooCommerce specific styles here if needed
                \BadFennec\Frontend\Styles\Critical::add_critical_to_stack( 'woocommerce-reset.css' );                

                // Add to critical styles if on shop, product, category or tag pages. Change as needed if not is needed that the loop appear above the fold
                if( is_shop() || is_product_category() || is_product_tag() ){
                    \BadFennec\Frontend\Styles\Critical::add_critical_to_stack( 'woocommerce-loop.css' );
                }

                //The loop styes are loaded on product pages to style related products, upsells, and cross-sells
                if( is_product() ){
                    \BadFennec\Frontend\Styles\DynamicBlocks::add_to_dynamic_blocks_stack( 'woocommerce-single-product' );
                }
            }
        }

     }

}