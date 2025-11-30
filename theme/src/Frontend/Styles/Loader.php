<?php

namespace BadFennec\Frontend\Styles;
use BadFennec\Utils\FileHelper;

if ( ! defined( 'ABSPATH' ) )
    die();

class Loader { 

    /**
     * Add all CSS styles to the frontend
     * Critical are added in the head, common in the head, dynamic blocks in the footer
     *
     * @return void
     */
    public static function init() :void
    {
        // Add header scripts
        self::wp_head();

        // Add footer scripts
        self::wp_footer();
    }

    private static function wp_head (): void
    {

        \BadFennec\Frontend\Styles\Critical::wp_head();
        \BadFennec\Frontend\Styles\Common::wp_head();

        // Preload fonts to improve performance
        //add_action( 'wp_head', array(__CLASS__, 'add_preaload_fonts'), 2 );
    }

    /**
     * Add footer styles
     * @return void
     */
    private static function wp_footer (): void
    {
        \BadFennec\Frontend\Styles\DynamicBlocks::wp_footer();        
    }
}