<?php

namespace BadFennec\Utils;

if ( ! defined( 'ABSPATH' ) )
    die();

class WP {

    /**
     * Check if the current page is the login or register page
     *
     * @return bool
     */
    public static function is_login(): bool
    {
        return in_array( $GLOBALS['pagenow'], [ 'wp-login.php', 'wp-register.php' ], true );
    }

}