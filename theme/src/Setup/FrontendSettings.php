<?php

namespace BadFennec\Setup;

if ( ! defined( 'ABSPATH' ) )
    die();

class FrontendSettings {

    /**
     * Register WP hooks for this service.
     *
     * @return void
     */
    public function register() :void
    {
        // Register frontend settings here
        \BadFennec\Frontend\Styles\Loader::init();
        \BadFennec\Frontend\Scripts::init();
    }

    

    /**
     * Preload featured image to improve performance
     *
     * @return void
     */
    public function add_preaload_thumbnail() : void
    {
        if( !is_singular(['post', 'page']) )
			return;

		$post_id = get_the_ID();

		if( !($post_thumbnail_id = get_post_thumbnail_id( $post_id )) )
			return;

		$src = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
		$srcset = wp_get_attachment_image_srcset( $post_thumbnail_id, 'full' );
		$sizes = wp_get_attachment_image_sizes( $post_thumbnail_id, 'full' );

		if ($src) {

            $attrs = [
                'rel' => 'preload',
                'as' => 'image',
                'href' => esc_url($src[0]),
                'imagesrcset' => $srcset ? esc_attr($srcset) : null,
                'imagesizes' => $sizes ? esc_attr($sizes) : null,
                'fetchpriority' => 'high'
            ];

			echo '<link '. implode(' ', array_filter(array_map(
                function($key) use ($attrs) {
                    return isset($attrs[$key]) ? $key . '="' . $attrs[$key] . '"' : null;
                },
                array_keys($attrs)
            ))) . ' />' . "\n";
		}
    }
}