<?php

namespace BadFennec\Setup;

if ( ! defined( 'ABSPATH' ) )
	die();

/**
 * ThemeSetup: handle base theme configuration and global assets.
 */
class ThemeSetup implements SetupInterface {
    /**
     * Register WP hooks for this service.
     *
     * @return void
     */
    public function register() :void
    {
        add_action( 'after_setup_theme', [ $this, 'after_setup_theme'] );
    }

    /**
     * After setup theme hook callback
     *
     * @return void
     */
    public function after_setup_theme() :void
    {
        $this->add_theme_support();

        $this->register_menus();
    }

    /**
     * Add theme support features
     *
     * @return void
     */
    private function add_theme_support(): void
    {
        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable featured images for posts and pages.
        // Add here other post types if needed.
        add_theme_support('post-thumbnails', ['post', 'page']);

        // Switch default core markup for search form, comment form, comments, gallery, and caption to output valid HTML5.
        // This helps ensure the markup is semantic and accessible.
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]);
    }

    /**
     * Register theme menus
     *
     * @return void
     */
    private function register_menus(): void
    {
        register_nav_menus( array(
			'main-navigation' 	    => __('Main Navigation', 'badfennec'),
			'footer-navigation' 	=> __('Footer Navigation', 'badfennec')
		));
    }
}