<?php

namespace BadFennec\Frontend;
use BadFennec\Utils\FileHelper;

if ( ! defined( 'ABSPATH' ) )
    die();

class Scripts {

    /**
     * Add all JS scripts to the frontend
     *
     * @return void
     */
    public static function init() :void
    {
        // Enqueue frontend scripts and styles here
        add_action(	'wp_enqueue_scripts', [__CLASS__, 'remove_unnecessary_scripts']);

        // Add footer scripts
        self::wp_footer();
    }

    /**
     * Remove unnecessary scripts and styles from the frontend
     * @return void
     */
    public static function remove_unnecessary_scripts(): void
    {
        // Dequeue Gutenberg block library CSS
        // Comment out these lines if you want to keep the block library styles
        wp_dequeue_style('wp-block-library');
		wp_dequeue_style('wp-block-library-theme');
		wp_dequeue_style('global-styles');
		wp_dequeue_style('classic-theme-styles');

        // Disable emoji scripts and styles
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        add_filter('emoji_svg_url', '__return_false');
    }

    /**
     * Add footer scripts
     * @return void
     */
    private static function wp_footer (): void
    {
        // Add footer scripts
        add_action('wp_footer', [__CLASS__, 'enqueue_footer_scripts'], 9999);        
    }

    /**
     * Get asset URL considering dev mode (Vite hot reloading)
     *
     * @param string $entry_point
     * @return array [url, version]
     */
    private static function get_assets_url( string $entry_point ) : array
    {
        $assets_dir = THEME_DIR . '/assets';

        $hot_file_path = $assets_dir . '/hot';

        if (file_exists($hot_file_path)) {
            $url = file_get_contents( $hot_file_path );
            return [rtrim(trim($url), '/') . '/' . $entry_point, time()];
        }

        return [THEME_URL . '/assets/' . $entry_point, FileHelper::get_file_timestamp( '/assets/' . $entry_point ) ];
    }

    /**
     * Add footer scripts
     * @return void
     */
    public static function enqueue_footer_scripts() : void
    {

        // Localize main script with data
		$script_data = array( 
			'theme_url' 				=>		THEME_URL, 
            'rest_url'                  =>      esc_url_raw( rest_url() ),
			'ajax_url' 					=>		admin_url( 'admin-ajax.php' ),
			'is_woocommerce_active'		=>		WOOCOMMERCE_IS_ACTIVE,
            'ajax_nonce'                =>      wp_create_nonce( BADFENNEC_AJAX_NONCE ),
            'rest_nonce'                =>      wp_create_nonce( 'wp_rest' ),
		);

        // Check if we are in dev mode or production
        $main_script = self::get_assets_url('js/main.js');

		?>
		
		<script type="text/javascript">
		/* <![CDATA[ */
		window.badfennec = <?php echo json_encode($script_data); ?>;
		/* ]]> */
		</script>

		<script type = "module" src = "<?php echo esc_url( $main_script[0] . '?v=' . $main_script[1] ); ?>"></script>

		<?php
	}
}