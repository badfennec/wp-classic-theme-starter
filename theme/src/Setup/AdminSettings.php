<?php

namespace Badfennec\Setup;

if ( ! defined( 'ABSPATH' ) )
	die();

class AdminSettings {
    /**
     * Register WP hooks for this service.
     *
     * @return void
     */
    public function register() :void
    {
        // Register admin settings here
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
    }

    /**
     * Enqueue admin scripts and styles
     *
     * @return void
     */
    public function admin_enqueue_scripts(): void
    {
        // Enqueue admin scripts and styles here
        wp_enqueue_style( 'theme-backend-style', THEME_URL . '/assets/css/backend.css', null, \Badfennec\Utils\AssetManager::get_file_timestamp( '/assets/css/backend.css' ) );
		wp_enqueue_script( 'theme-backend-js', THEME_URL . '/assets/js/backend.js', [], \Badfennec\Utils\AssetManager::get_file_timestamp( '/assets/js/backend.js' ), true);

		wp_localize_script( 'theme-backend-js', 'vctheme_ajaxurl', array( 
			'theme_url' 				=> THEME_URL,
			'ajax_url' 					=> admin_url( 'admin-ajax.php' ) 
		) );
    }
}