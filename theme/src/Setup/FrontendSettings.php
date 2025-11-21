<?php

namespace Badfennec\Setup;
use Badfennec\Utils\FileHelper;

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
        
        // Enqueue frontend scripts and styles here
        add_action(	'wp_enqueue_scripts', [$this, 'remove_unnecessary_scripts']);
    }

    /**
     * Remove unnecessary scripts and styles from the frontend
     * @return void
     */
    public function remove_unnecessary_scripts(): void
    {
        // Dequeue Gutenberg block library CSS
        // Comment out these lines if you want to keep the block library styles
        wp_dequeue_style('wp-block-library');
		wp_dequeue_style('wp-block-library-theme');
		wp_dequeue_style('global-styles');
		wp_dequeue_style('classic-theme-styles');

        // Disable emoji scripts and styles
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        add_filter('emoji_svg_url', '__return_false');
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