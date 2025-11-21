<?php

namespace Badfennec\Queries;

use Badfennec\Queries\Traits\QueryHelper;

if ( ! defined( 'ABSPATH' ) )
    die();

class PostQueries {

    use QueryHelper;

    /**
     * Get related posts based on shared categories.
     *
     * @param int $post_id The ID of the current post.
     * @param array $category_ids Array of category IDs to match.
     * @param array $args Additional query arguments (e.g., 'posts_per_page').
     * @return array Array of related WP_Post objects.
     */
    public static function get_post_related( int $post_id, array $category_ids = [], array $args = [] ){        

        return self::get_taxonomy_query(
            post_id : $post_id, 
            taxonomy:'category', 
            taxonomy_ids: $category_ids, 
            args: $args
        );       
 
    }

}