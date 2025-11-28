<?php

namespace BadFennec\Frontend\Styles;

if ( ! defined( 'ABSPATH' ) )
    die();

/**
 * Class Critical
 * It deals with loading critical CSS styles in the header
 * @package BadFennec\Frontend\Styles
 */
class Critical {
    /**
     * Critical styles stack to be included in the header
     * @var array
     */
    static array $style_critical_stack = [
        'critical.css',
    ];

    public static function wp_head(): void
    {
        // Add critical CSS to the header
        add_action( 'wp_head', [ __CLASS__, 'enqueue_critical_css'] );
    }

    /**
     * Add critical CSS files to the critical stack
     *
     * @return void
     */
    public static function add_critical_to_stack( string $cssName ): void
    {
        if( !in_array( $cssName, self::$style_critical_stack ) ) {
            self::$style_critical_stack[] = $cssName;
        }
    }

    /**
     * Add critical CSS to the header
     *
     * @return void
     */
    public static function enqueue_critical_css(): void
    {
        $base_dir = THEME_DIR . '/assets/css/';

        $critical = '';

        foreach( self::$style_critical_stack as $style ) {
            $critical_path = $base_dir . $style;
            if ( file_exists( $critical_path ) ) {
                $critical .= file_get_contents( $critical_path );
            }
        }

        if ( ! empty( $critical ) ) {
            echo '<style id="critical-css">' . $critical . '</style>';
        }
    }
}