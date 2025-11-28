<?php 

namespace BadFennec\Queries\Traits;
use WP_Query;

if ( ! defined( 'ABSPATH' ) )
    die();

trait QueryHelper {

    /**
     * Execute a WP_Query with the given arguments and return the posts.
     *
     * @param array $args Arguments for WP_Query.
     * @return array Array of WP_Post objects.
     */
    private static function get_wp_query( array $args = [] ): array
    {
		$query = new WP_Query( $args );
		$res = $query->get_posts();
		wp_reset_query();
		wp_reset_postdata();		
		return $res;
	}

    /**
     * Get the term IDs of a specific taxonomy for a given post.
     *
     * @param int $post_id The ID of the post.
     * @param string $taxonomy The taxonomy to retrieve terms from.
     * @return array Array of term IDs.
     */
    private static function get_post_taxonomies( int $post_id, string $taxonomy ): array
    {
        $terms = wp_get_post_terms( $post_id, $taxonomy );
        
        $term_ids = [];

        if( is_array( $terms ) && count( $terms ) > 0 ){

            foreach( $terms as $term ){
                $term_ids[] = $term->term_id;
            }

        }

        return $term_ids;
    }

    /**
     * Get posts related by a specific taxonomy.
     *
     * @param int $post_id The ID of the current post.
     * @param string $taxonomy The taxonomy to match.
     * @param array $taxonomy_ids Array of taxonomy term IDs to match.
     * @param array $args Additional query arguments.
     * @return array Array of related WP_Post objects.
     */
    private static function get_taxonomy_query( 
        int $post_id, 
        string $taxonomy,
        array $taxonomy_ids = [], 
        array $args = [] 
    ): array
    {
        // If no taxonomy IDs provided, get them from the post
        if( !is_array( $taxonomy_ids ) || count( $taxonomy_ids ) == 0 ){
            $taxonomy_ids = self::get_post_taxonomies( $post_id, $taxonomy );
        }

        // If still no taxonomy IDs, return empty array
        if( count( $taxonomy_ids ) == 0 ){
            return [];
        }

        // Prepare query arguments and remove current post from results
        $query_args = [
            'post__not_in'      =>  [ $post_id ],
        ];

        // Merge additional args if provided
        if( @$args && is_array( $args ) ){
            $query_args = array_merge( $query_args, $args );
        }

        // Build tax_query
        $tax_query = [
            [
                'taxonomy'  => $taxonomy,
                'field'     => 'id',
                'terms'     => $taxonomy_ids,
                'operator'  => 'IN',
            ]
        ];

        $query_args['tax_query'] = $tax_query;

        return self::get_wp_query( $query_args ); 
    }
}