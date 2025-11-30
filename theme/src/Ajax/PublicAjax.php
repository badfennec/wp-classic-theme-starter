<?php

namespace BadFennec\Ajax;

if ( ! defined( 'ABSPATH' ) )
    die();

class PublicAjax extends AbstactAjax {

    /**
     * List of public AJAX actions (no login required)
     *
     * @var array
     */
    static array $actions = [
        'badfennec_test_action',
    ];

    /**
     * Register AJAX actions
     *
     * @return void
     */
    public static function register_actions(): void
    {
        foreach( self::$actions as $action ){
			add_action('wp_ajax_' . $action, [__CLASS__, 'handle_action']);
			add_action('wp_ajax_nopriv_' . $action, [__CLASS__, 'handle_action']);
		}
    }

    /**
     * Handle public AJAX actions
     *
     * @return void
     */
    public static function handle_action(): void
    {
        self::check_nonce();        

        // Handle public AJAX actions
        if (isset( $_REQUEST['action'] ) && in_array( $_REQUEST['action'], self::$actions, true ) ){

            switch ($_REQUEST['action']){
                /** Add your public AJAX action handlers here.
                 * Return a response using wp_send_json_success() or wp_send_json_error() like this:
                 * 
                 * case 'your_action':
                 *     // Your code here
                 *     wp_send_json_success( $response );
                 *     break;
                 */

                // this is an example action
                case 'badfennec_test_action':
                    // Example action handler
                    $data = [ 'message' => 'This is a test response from badfennec_test_action.' ];
                    wp_send_json_success( $data );
                break;
            }
        }

        wp_die();
    }
}