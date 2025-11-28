<?php

namespace BadFennec\Frontend\Styles;
use BadFennec\Utils\FileHelper;

if ( ! defined( 'ABSPATH' ) )
    die();

class DynamicBlocks {
    use StyleRendererTrait;

    /**
     * Dynamic blocks stack to be included in the footer
     * Each dynamic block may have its own CSS file and if so, it will be added to the styles stack.
     * All dynamic blocks CSS files are mapped in the $dynamic_blocks_css_maps array.
     * The final CSS files will be included in the footer to avoid render blocking.
     * @var array
     */
    static array $dynamic_blocks_stack = [];

    /**
     * Mapping of dynamic block names to their CSS files
     * Each entry can be a string (single CSS file) or an array of strings (multiple CSS files)
     * @var array
     */
    static array $dynamic_blocks_css_maps = [

        'button-arrow'                  =>  ['button-arrow.css'],

		'carousel-standard'	            =>	['carousels.css'],
        'accordion-standard'	        =>	['accordions.css'],
        'search-bar'                    =>  ['search-bar.css', 'forms.css', 'badfennec-button-form.css'],

        'product-variation'             =>  ['wooccommerce-product-variation.css'],
        'woocommerce-reset'             =>  ['woocommerce-reset.css'],
        'woocommerce-loop'              =>  ['woocommerce-loop.css'],
        'woocommerce-single-product'    =>  ['woocommerce-loop.css', 'woocommerce-single-product.css']
	];

    public function wp_footer(): void
    {
        // Add dynamic blocks CSS to the footer
        add_action('wp_footer', [$this, 'enqueue_dynamic_blocks_css'], 9999);
    }

    /**
     * Add dynamic block CSS to the dynamic blocks stack
     * @param string $key The dynamic block key
     * @return void
     */
    public static function add_to_dynamic_blocks_stack( string $key ) : void 
    {

        // Check if the key exists in the dynamic blocks CSS maps
        if( array_key_exists( $key, self::$dynamic_blocks_css_maps ) ) {
            
            $styles = [];

            // If the value is an array, add all styles, otherwise add the single style
            if( is_array( self::$dynamic_blocks_css_maps[$key] ) ) {
                $styles = self::$dynamic_blocks_css_maps[$key];
            } else {
                $styles[] = self::$dynamic_blocks_css_maps[$key];
            }

            // Add styles to the dynamic blocks stack if not already present on critical or styles stack
            foreach( $styles as $style ) {

                if( !in_array( $style, self::$dynamic_blocks_stack ) && 
                    !in_array( $style, \BadFennec\Frontend\Styles\Critical::$style_critical_stack ) ) {

                    self::$dynamic_blocks_stack[] = $style;			
                }
            }

        }
	}

    /**
     * Load dynamic blocks CSS files in the footer
     *
     * @return void
     */
    public function enqueue_dynamic_blocks_css() : void 
    {

		if( count( self::$dynamic_blocks_stack ) === 0 )
			return;

		$sources = [];

		foreach( self::$dynamic_blocks_stack as $style ){
			$dir = THEME_DIR . '/assets/css/' . $style;
			if( file_exists( $dir ) ){
				$sources[] =THEME_URL . '/assets/css/' . $style . '?ver=' . FileHelper::get_file_timestamp( '/assets/css/' . $style );
			}
		}

		$this->render_preload_links( $sources );
	}
}