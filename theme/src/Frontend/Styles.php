<?php

namespace BadFennec\Frontend;
use Badfennec\Utils\FileHelper;

if ( ! defined( 'ABSPATH' ) )
    die();

class Styles {
    /**
     * Critical styles stack to be included in the header
     * @var array
     */
    static array $style_critical_stack = [
        'critical.css',
    ];

    /**
     * Styles stack to be included in the header
     * Put here all style that are not critical but needed on all pages
     * @var array
     */
    static array $styles_stack = [
        'main.css',
    ];

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

        'button-arrow'                   =>  ['button-arrow.css'],

		'carousel-standard'	            =>	['carousels.css'],
        'accordion-standard'	        =>	['accordions.css'],
        'search-bar'                    =>  ['search-bar.css', 'forms.css', 'badfennec-button-form.css'],

        'product-variation'             =>  ['wooccommerce-product-variation.css'],
        'woocommerce-reset'             =>  ['woocommerce-reset.css'],
        'woocommerce-loop'              =>  ['woocommerce-loop.css'],
        'woocommerce-single-product'    =>  ['woocommerce-loop.css', 'woocommerce-single-product.css']
	];

    public function register() :void
    {
        // Add header scripts
        $this->wp_head();

        // Add footer scripts
        $this->wp_footer();
    }

    private function wp_head (): void
    {
        // Add critical CSS to the header
        add_action( 'wp_head', [ $this, 'enqueue_critical_css'] );

        // Add main CSS to the header with preload
        add_action( 'wp_head', [ $this, 'enqueue_main_css'] );

        // Preload fonts to improve performance
        //add_action( 'wp_head', array(__CLASS__, 'add_preaload_fonts'), 2 );
    }

    /**
     * Add footer scripts
     * @return void
     */
    private function wp_footer (): void
    {
        // Add footer scripts
        add_action('wp_footer', [$this, 'enqueue_dynamic_blocks_css'], 9999);        
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
    public function enqueue_critical_css(): void
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

    /**
     * Add main CSS to the header with preload to improve performance
     * CSSs file names are included in $styles_stack array
     * Put here only non critical CSS and 
     *
     * @return void
     */
    public function enqueue_main_css(): void {

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

        $this->enqueue_preload_styles( $sources );
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
                    !in_array( $style, self::$style_critical_stack ) ) {

                    self::$dynamic_blocks_stack[] = $style;			
                }
            }

        }
	}

    /**
     * Enqueue preload styles to avoid render blocking
     * @param array $sources Array of style URLs to preload
     * @return void
     */
    public function enqueue_preload_styles( array $sources ) : void 
    {
		if( count($sources) === 0 ){
			return;
		}

		foreach( $sources as $src ){
			?>
			<link rel="preload" href="<?php echo esc_url( $src ); ?>" as="style">
			<link rel="stylesheet" href="<?php echo esc_url( $src ); ?>" media="print" onload="this.media='all'">
			<noscript><link rel="stylesheet" href="<?php echo esc_url( $src ); ?>"></noscript>
			<?php
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

		$this->enqueue_preload_styles( $sources );
	}
}