<?php

namespace Badfennec\Woocommerce;

if ( ! defined( 'ABSPATH' ) )
    die();

class Utils {
    /**
     * Check if the current page is a WooCommerce related page
     * @return bool True if it's a WooCommerce page, false otherwise
     */
    public static function is_woocommerce_page(): bool
    {
        return ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() );
    }
}