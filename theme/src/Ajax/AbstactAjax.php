<?php

namespace BadFennec\Ajax;

if ( ! defined( 'ABSPATH' ) )
    die();

/**
 * Abstract class for AJAX handlers
 */
abstract class AbstactAjax {


    /**
     * Register AJAX actions
     *
     * @return void
     */
    abstract static function register_actions(): void;

    abstract static function handle_action(): void;

    /**
     * Verify AJAX nonce
     *
     * @param string $nonce
     * @return bool
     */
    private static function verify_nonce( $nonce ): bool
    {
        return wp_verify_nonce( $nonce, BADFENNEC_AJAX_NONCE );
    }

    /**
     * Check nonce and send error response if invalid
     *
     * @return void
     */
    protected static function check_nonce(): void
    {

        $nonce = $_SERVER['HTTP_X_NONCE'] ?? null;

        if (!$nonce && function_exists('getallheaders')) {
            $headers = array_change_key_case(getallheaders(), CASE_LOWER);
            print_r($headers);
            $nonce = $headers['x-nonce'] ?? null;
        }

        if ( !$nonce || !self::verify_nonce( $nonce ) ){
            wp_send_json_error( [ 'message' => self::get_not_allowed_message() ] );
            wp_die();
        }
    }

    /**
     * Get not allowed message
     *
     * @return string
     */
    private static function get_not_allowed_message(): string
    {
        return __( 'Your not are allowed to perform this action.', 'badfennec' );
    }

}