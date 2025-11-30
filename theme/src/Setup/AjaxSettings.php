<?php
namespace BadFennec\Setup;

if ( ! defined( 'ABSPATH' ) )
    die();

class AjaxSettings implements SetupInterface {

    /**
     * Register WP hooks for this service.
     *
     * @return void
     */
    public function register() :void
    {
        \BadFennec\Ajax\PublicAjax::register_actions();
        \BadFennec\Ajax\PrivateAjax::register_actions();
    }
}