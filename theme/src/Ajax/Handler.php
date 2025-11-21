<?php
namespace Badfennec\Ajax;

if ( ! defined( 'ABSPATH' ) )
    die();

class Handler {

    /**
     * List of public AJAX actions (no login required)
     *
     * @var array
     */
    static array $public_actions = [
        'badfennec_test_action',
    ];

    /**
     * List of private AJAX actions (login required)
     *
     * @var array
     */
    static array $private_actions = [];


    /**
     * Register WP hooks for this service.
     *
     * @return void
     */
    public function register() :void
    {
        foreach( self::$public_actions as $slug ){
			add_action('wp_ajax_' . $slug, [$this, 'public_actions_handler']);
			add_action('wp_ajax_nopriv_' . $slug, [$this, 'public_actions_handler']);
		}

        foreach( self::$private_actions as $slug ){
			add_action('wp_ajax_' . $slug, [$this, 'private_actions_handler']);
		}   
    }

    /**
     * Verify AJAX nonce
     *
     * @param string $nonce
     * @return bool
     */
    private function verify_nonce( $nonce ): bool
    {
        return wp_verify_nonce( $nonce, BADFENNEC_AJAX_NONCE );
    }

    /**
     * Check nonce and send error response if invalid
     *
     * @return void
     */
    private function check_nonce(): void
    {
        if ( ! isset( $_POST['nonce'] ) || ! $this->verify_nonce( $_POST['nonce'] ) ) {
            wp_send_json_error( [ 'message' => $this->get_not_allowed_message() ] );
            wp_die();
        }
    }

    /**
     * Handle public AJAX actions (no login required)
     *
     * @return void
     */
    public function public_actions_handler(): void
    {
        $this->check_nonce();        

        // Handle public AJAX actions
        if (isset( $_POST['action'] ) && in_array( $_POST['action'], self::$public_actions, true ) ){

            switch ($_POST['action']){
                /** Add your public AJAX action handlers here.
                 * Return a response using wp_send_json_success() or wp_send_json_error() like this:
                 * 
                 * case 'your_action':
                 *     // Your code here
                 *     wp_send_json_success( $response );
                 *     break;
                 */

                case 'badfennec_test_action':
                    // Example action handler
                    $data = [ 'message' => 'This is a test response from badfennec_test_action.' ];
                    wp_send_json_success( $data );
                    break;
            }
        }

        wp_die();
    }

    /**
     * Handle private AJAX actions (login required)
     *
     * @return void
     */
    public function private_actions_handler(): void
    {

        if( !is_user_logged_in() ){
            wp_send_json_error( [ 'message' => $this->get_not_allowed_message() ] );
            wp_die();
        }

        $this->check_nonce();

        // Handle private AJAX actions
        if (isset( $_POST['action'] ) && in_array( $_POST['action'], self::$private_actions, true ) ){

            switch ($_POST['action']){
                /** Add your public AJAX action handlers here.
                 * Return a response using wp_send_json_success() or wp_send_json_error() like this:
                 * 
                 * case 'your_action':
                 *     // Your code here
                 *     wp_send_json_success( $response );
                 *     break;
                 */
            }

        }

        wp_die();
    }

    /**
     * Get not allowed message
     *
     * @return string
     */
    private function get_not_allowed_message(): string
    {
        return __( 'Your not are allowed to perform this action.', 'badfennec' );
    }
}