<?php

namespace BadFennec\Backend;
use BadFennec\Features\Options;

if ( ! defined( 'ABSPATH' ) )
    die();

/**
 * Admin Menu Class
 * This class manages the admin menu items in the WordPress dashboard
 */
class AdminMenu {

	/**
	 * Register the admin menu items
	 */
    public function register(): void 
    {
        // Add admin menu items here
        add_action('admin_menu', [ $this, 'admin_menu']);
    }

	/**
	 * Add admin menu items using ACF options pages
	 * @return void
	 */
    public function admin_menu(): void 
    {
        if(function_exists('acf_add_options_page')){
			acf_add_options_page(array(
				'menu_title'	=> 'Opzioni tema',
				'menu_slug' 	=> Options::$main,
				'capability'	=> 'manage_options',
				'parent_slug'	=> ''
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> 'Contatti',
				'menu_title'	=> 'Contatti',
				'menu_slug' 	=> Options::$main . '-contacts',
				'parent_slug'	=> Options::$main,
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> 'Social',
				'menu_title'	=> 'Social',
				'menu_slug' 	=>  Options::$main . '-socials',
				'parent_slug'	=> Options::$main,
			));
			
			acf_add_options_sub_page(array(
				'page_title' 	=> 'Dati fiscali',
				'menu_title'	=> 'Dati fiscali',
				'menu_slug' 	=> Options::$main . '-fisc',
				'parent_slug'	=> Options::$main,
			));
		}
    }

}