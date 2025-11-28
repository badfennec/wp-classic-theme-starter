<?php

namespace BadFennec\Frontend;

use BadFennec\Frontend\Styles\DynamicBlocks;

if ( ! defined( 'ABSPATH' ) )
    die();
/**
 * Class Components
 * It deals with rendering frontend components
 * @package BadFennec\Frontend
 */
class Components {

    /**
     * @var array<string, string> $components List of available components
     */
    static array $components = [
        'spacer'                => 'atoms/spacer',
        'thumb-handler'         => 'atoms/thumb-handler',
        'button-arrow'          => 'atoms/button-arrow',

        'search-bar'            => 'molecules/search-bar',
        'header-cart'           => 'molecules/woocommerce-header-cart',

        'header'                => 'organisms/header',
        'footer'                => 'organisms/footer',
        'social-list'           => 'organisms/social-list',
        'carousel-standard'     => 'organisms/carousel-standard',
        'accordion-standard'    => 'organisms/accordion-standard',   
        'tabs-standard'         => 'organisms/tabs-standard',   
        
        'product-variation'     => 'organisms/woocommerce-product-variation',
    ];

    /**
     * Render a component
     * @param string $componentKey The component key
     * @param array|null $args Optional arguments to pass to the component  
     * @param bool $echo Whether to echo the output or return it
     * @return string The rendered component (if $echo is false)
     */
    public static function get_component(
        string $componentKey,
        ?array $args = [],
        bool $echo = true
    ): string
    {

        ob_start();
        self::render( $componentKey, $args ?? [] );
        $res = ob_get_clean();

        if( $echo ) {
            echo $res;
            return '';
        } else {
            return $res;
        }
    }

    /**
     * Render the component file
     * @param string $componentKey The component key
     * @param array $args Optional arguments to pass to the component  
     * @return void
     */
    private static function render( string $componentKey, array $args = [] ): void
    {
        // Check if component exists
        if( !in_array( $componentKey, array_keys( self::$components ), true ) ){
            return;
        }

        $path = THEME_DIR . "/components/" . self::$components[$componentKey] . ".php";

        // Check if file exists
        if (!file_exists($path)) {
            return;
        }

        // Add dynamic block CSS to the frontend settings
        DynamicBlocks::add_to_dynamic_blocks_stack( $componentKey );

        // Extract args and include the component file
        extract($args);
        include $path;
    }

}