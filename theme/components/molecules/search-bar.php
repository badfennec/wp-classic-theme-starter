<?php

if ( ! defined( 'ABSPATH' ) )
	die();

?>

<div class="badfennec-searchbar">
    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <span class="sr-only"><?php _e('Search for:', 'badfennec') ?></span>
        <input type="search" name="s" placeholder="<?php _e('Search...', 'badfennec') ?>">
        <button class="badfennec-button-form" type="submit"><?php _e('Search', 'badfennec') ?></button>
    </form>
</div>