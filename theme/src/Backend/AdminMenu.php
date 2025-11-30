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
	 * Add admin menu items
	 * @return void
	 */
    public static function add_menu(): void 
    {
        // Add admin menu items here
        add_action('admin_menu', [ __CLASS__, 'admin_menu']);
    }

	/**
	 * Add admin menu items using ACF options pages
	 * @return void
	 */
    public static function admin_menu(): void 
    {
        if(function_exists('acf_add_options_page')){
			acf_add_options_page(array(
				'menu_title'	=> __('Theme Options', 'badfennec'),
				'menu_slug' 	=> Options::$main,
				'capability'	=> 'manage_options',
				'parent_slug'	=> ''
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> __('Contacts', 'badfennec'),
				'menu_title'	=> __('Contacts', 'badfennec'),
				'menu_slug' 	=> Options::$main . '-contacts',
				'parent_slug'	=> Options::$main,
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> __('Social', 'badfennec'),
				'menu_title'	=> __('Social', 'badfennec'),
				'menu_slug' 	=>  Options::$main . '-socials',
				'parent_slug'	=> Options::$main,
			));
			
			acf_add_options_sub_page(array(
				'page_title' 	=> __('Fiscal Data', 'badfennec'),
				'menu_title'	=> __('Fiscal Data', 'badfennec'),
				'menu_slug' 	=> Options::$main . '-fisc',
				'parent_slug'	=> Options::$main,
			));
		}
    }

}