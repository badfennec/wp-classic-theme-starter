<?php

namespace BadFennec\Frontend\Styles;
use BadFennec\Utils\FileHelper;

if ( ! defined( 'ABSPATH' ) )
    die();

class Loader { 

    use StyleRendererTrait;    

    public function register() :void
    {
        // Add header scripts
        $this->wp_head();

        // Add footer scripts
        $this->wp_footer();
    }

    private function wp_head (): void
    {

        \BadFennec\Frontend\Styles\Critical::wp_head();
        (new \BadFennec\Frontend\Styles\Common())->wp_head();

        // Preload fonts to improve performance
        //add_action( 'wp_head', array(__CLASS__, 'add_preaload_fonts'), 2 );
    }

    /**
     * Add footer styles
     * @return void
     */
    private function wp_footer (): void
    {
        (new \BadFennec\Frontend\Styles\DynamicBlocks())->wp_footer();        
    }
}