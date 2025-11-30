<?php

namespace BadFennec\Setup;
use WP_REST_Request;
use WP_REST_Response;

if ( ! defined( 'ABSPATH' ) )
    die();

class RestApiSettings implements SetupInterface {
    /**
     * Register WP hooks for this service.
     *
     * @return void
     */
    public function register() :void
    {
        add_action( 'rest_api_init', [ $this, 'rest_api_init'] );
    }

    /**
     * REST API init hook callback
     *
     * @return void
     */
    public function rest_api_init() :void
    {
        // Register custom REST API routes here if needed
        register_rest_route( 'badfennecapi/v1/', 'user', array(
            'methods' => 'GET',
            'callback' => array( $this, 'user' ),
        ) );
    }

    public function user( WP_REST_Request $request ) : WP_REST_Response
    {
        if( is_user_logged_in() ) {
            $current_user = wp_get_current_user();
            return new WP_REST_Response( array( 'message' => 'Hello, ' . $current_user->user_login . '!' ), 200 );
        }
        return new WP_REST_Response( array( 'message' => 'User endpoint reached successfully, but user is not logged in.' ), 200 );
    }
}