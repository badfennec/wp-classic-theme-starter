<?php

namespace Badfennec;

if ( ! defined( 'ABSPATH' ) )
	die();

/**
 * Init Class: Initialize the theme by registering all the services
 */
class Init {

    /**
     * Start theme installation and register all the services
     * @return void
    */
    public static function run(): void
    {
        // Get all classes/Services to register
        $services = self::get_services();

        // Register all the services calling their register method if it exists
        foreach ($services as $service) {
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }


    /**
     * Get all the services to register
     * Here you can add your new services, custom post types, taxonomies, etc.
     * @return array An array of service instances    
    */
    public static function get_services(): array
    {
        $services = [
            new \Badfennec\Setup\ThemeSetup(),
            new \Badfennec\Ajax\Handler(),
        ];

        if( is_admin() ) {
            $services[] = new \Badfennec\Setup\AdminSettings();
            $services[] = new \Badfennec\Backend\AdminMenu();
        } else {
            $services[] = new \Badfennec\Setup\FrontendSettings();
            $services[] = new \Badfennec\Frontend\Styles();
            $services[] = new \Badfennec\Frontend\Scripts();
        }

        if( \Badfennec\Utils\WP::is_login() ) {
            $services[] = new \Badfennec\Setup\LoginSettings();
        }

        if ( WOOCOMMERCE_IS_ACTIVE ){
            $services[] = new \Badfennec\Woocommerce\Setup();
        }
        
        return $services;
    }
}