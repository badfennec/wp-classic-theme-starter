<?php

namespace BadFennec\Frontend;
use Badfennec\Utils\FileHelper;

if ( ! defined( 'ABSPATH' ) )
    die();

class Scripts {

    /**
     * Register WP hooks for this service.
     *
     * @return void
     */
    public function register() :void
    {
        // Add footer scripts
        $this->wp_footer();
    }

    /**
     * Add footer scripts
     * @return void
     */
    private function wp_footer (): void
    {
        // Add footer scripts
        add_action('wp_footer', [$this, 'enqueue_footer_scripts'], 9999);
        
    }

    /**
     * Add footer scripts
     * @return void
     */
    public function enqueue_footer_scripts() : void
    {

		$dep = array( 
			'theme_url' 				=>		THEME_URL, 
			'ajax_url' 					=>		admin_url( 'admin-ajax.php' ),
			'is_woocommerce_active'		=>		WOOCOMMERCE_IS_ACTIVE,
            'ajax_nonce'                =>      wp_create_nonce( BADFENNEC_AJAX_NONCE )
		);

		?>
		
		<script type="text/javascript" id="vctheme-main-js-js-extra">
		/* <![CDATA[ */
		var vctheme = <?php echo json_encode($dep); ?>;
		/* ]]> */
		</script>

		<script type = "module" src = "<?php echo esc_url( THEME_URL . '/assets/js/main.js?v=' . FileHelper::get_file_timestamp( '/assets/js/main.js' ) ); ?>"></script>

		<?php
	}
}