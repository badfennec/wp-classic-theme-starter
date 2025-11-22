<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Product Variation Component
 * Prints product variation options for WooCommerce single product page using buttons instead of classic dropdowns.
 *
 * @var WC_Product_Variable $product
 * @var array $available_variations
 */
$product = $args['product'];
$product_variations = $product->get_variation_attributes();
$available_variations = $args['available_variations'];

$product_variations_list = array();
$available_variations = @$args['available_variations'];

$available_variations_list = array();

foreach( $available_variations as $variation ){

    foreach( $variation['attributes'] as $k => $v ){

        $attr_k = str_replace( 'attribute_', '', $k );

        if( !isset( $available_variations_list[ $attr_k ] ) )
            $available_variations_list[ $attr_k ] = array();

        $available_variations_list[ $attr_k ][] = $v;

    }

}

foreach( $product_variations as $k => $product_variation_options ){

    $tax = get_taxonomy( $k );

    $product_variations_list[ $k ] = array(
        'name'	=>	$tax->labels->singular_name,
        'items'	=>	array(),
    );

    //Keep only terms that are in the product variation options
    $terms = get_terms( array(
        'taxonomy'   => $k,
        'orderby'    => 'menu_order',
        'hide_empty' => false,
        'include'    => $product_variation_options,
    ) );

    // Populate items
    foreach( $terms as $term ){

        if( in_array( $term->slug, $product_variation_options ) ) {
             $product_variations_list[ $k ]['items'][ $term->slug ] = $term->name;
        }
    }

}

?>

<div class="badfennec-woo-single-product-variation" data-product_variations = "<?php echo htmlentities( json_encode( $product_variations_list ) ); ?>">

    <?php

    foreach( $product_variations_list as $product_variation_key => $product_variation ){

        if( @$available_variations_list[$product_variation_key] ){
            ?>

            <div class="badfennec-woo-single-product-variation__entry">

                <div class="badfennec-woo-single-product-variation__label"><?php echo esc_attr( $product_variation['name'] ) ?></div>

                <div class="badfennec-woo-single-product-variation__buttons">
                    <?php

                    foreach( $product_variation['items'] as $k => $product_variation_item ){

                        if( in_array( $k, $available_variations_list[$product_variation_key], true ) ){

                            ?>

                            <span 
                                class="badfennec-woo-single-product-variation__button" 
                                role="button"
                                data-variation="<?php echo esc_attr( $k ); ?>"
                                data-variation-key="<?php echo esc_attr( $product_variation_key ); ?>"
                            >
                                <?php echo esc_attr( $product_variation_item ) ?>
                            </span>

                            <?php

                        }

                    }

                    ?>
                </div><!-- .badfennec-woo-single-product-variation__buttons -->

            </div><!-- .badfennec-woo-single-product-variation__entry -->

            <?php
        }

    }

    ?>

</div><!-- .badfennec-woo-single-product-variation -->
