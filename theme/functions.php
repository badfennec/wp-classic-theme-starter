<?php

if ( ! defined( 'ABSPATH' ) )
	die();

define( 'THEME_VER', time() );

define( 'THEME_URL', get_template_directory_uri() );
define( 'THEME_DIR', get_template_directory() );

define( 'DISALLOW_FILE_EDIT', true );
define( 'WOOCOMMERCE_PUGIN_PATH', trailingslashit( WP_PLUGIN_DIR ) . 'woocommerce/woocommerce.php' );
define( 'WOOCOMMERCE_IS_ACTIVE', in_array( WOOCOMMERCE_PUGIN_PATH, wp_get_active_and_valid_plugins(), true ) );

define( 'BADFENNEC_AJAX_NONCE', 'badfennec_ajax_nonce' );

ini_set('precision', 14);
ini_set('serialize_precision', 14);

require_once THEME_DIR . '/vendor/autoload.php';
\Badfennec\Init::run();