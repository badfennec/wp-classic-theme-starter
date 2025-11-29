<?php

namespace BadFennec\Frontend\Styles;
use BadFennec\Utils\FileHelper;

if ( ! defined( 'ABSPATH' ) )
    die();

class Common {
    use StyleRendererTrait;

    /**
     * Styles stack to be included in the header
     * Put here all style that are not critical but needed on all pages
     * @var array
     */
    static array $styles_stack = [
        'main.css',
    ];

    public static function wp_head(): void
    {
        // Add main CSS to the header with preload
        add_action( 'wp_head', [ __CLASS__, 'enqueue_main_css'] );
    }

    /**
     * Add main CSS to the header with preload to improve performance
     * CSSs file names are included in $styles_stack array
     * Put here only non critical CSS and 
     *
     * @return void
     */
    public static function enqueue_main_css(): void {

        if( empty( self::$styles_stack ) ) {
            return;
        }

        $sources = [];

		foreach( self::$styles_stack as $style ){
			$dir = THEME_DIR . '/assets/css/' . $style;
			if( file_exists( $dir ) ){
				$sources[] =THEME_URL . '/assets/css/' . $style . '?ver=' . FileHelper::get_file_timestamp( '/assets/css/' . $style );
			}
		}

        $Common = new self();
        $Common->render_preload_links( $sources );
    }
}