<?php

namespace Badfennec\Setup;

if ( ! defined( 'ABSPATH' ) )
    die();

class LoginSettings {

    public function register() :void
    {
        // Register login settings here
        add_action('login_enqueue_scripts', [$this, 'login_enqueue_scripts']);

        // Customize the login header URL
        add_filter( 'login_headerurl', [$this, 'login_headerurl'] );

        // Customize the login header title
		add_filter( 'login_headertext', [$this, 'login_headertitle'] );

    }

    /**
     * Customize the login header URL
     *
     * @return string
     */
    public function login_enqueue_scripts() {
        wp_enqueue_style( 'core', THEME_URL . '/assets/css/login.css', null, \Badfennec\Utils\FileHelper::get_file_timestamp( '/assets/css/login.css' ) );
		wp_enqueue_script( 'theme-login-js', THEME_URL . '/assets/js/login.js', null, \Badfennec\Utils\FileHelper::get_file_timestamp( '/assets/js/login.js' ), true);
    }

    /**
     * Customize the login header title
     *
     * @return string
     */
    public static function login_headerurl(): string
    {
        return home_url();
    }

    /**
     * Customize the login header title
     *
     * @return string
     */
    public static function login_headertitle(): string
    {
        return get_bloginfo( 'name' );
    }

}