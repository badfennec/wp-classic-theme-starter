<?php

namespace BadFennec\Setup;

if ( ! defined( 'ABSPATH' ) )
    die();

interface SetupInterface {
    /**
     * Register WP hooks for this service.
     *
     * @return void
     */
    public function register() :void;
}