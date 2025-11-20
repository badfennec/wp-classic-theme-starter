<?php

namespace Badfennec\Utils;

if ( ! defined( 'ABSPATH' ) )
    die();

/**
 * ACF  Utility Class
 * This class implements helper functions for Advanced Custom Fields (ACF) plugin
 */
class ACF {
    /**
     * Safely get a field value using ACF's get_field function
     * @param string $field The field name
     * @param int|string $value The post ID or other identifier
     * @return mixed The field value or false if ACF is not available
    */
    static function get_field( string $field, int | string $value ): mixed
    {
		if( function_exists( 'get_field') )
			$r = get_field( $field, $value );
		else
			$r = false;
		return $r;
	}
}