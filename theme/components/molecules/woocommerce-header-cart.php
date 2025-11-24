<?php

if ( ! defined( 'ABSPATH' ) ) {
    die();
}

if( !WOOCOMMERCE_IS_ACTIVE )
		return;

if( is_cart () || is_checkout() ){
    echo apply_filters('the_content', '<!-- wp:woocommerce/cart-link /-->');
    return;
}

?>

<div class="badfennec-navbar__cart">
    <?php echo apply_filters('the_content', '<!-- wp:woocommerce/mini-cart {"addToCartBehaviour":"open_drawer", "productCountVisibility":"always"} /-->'); ?>
</div>
