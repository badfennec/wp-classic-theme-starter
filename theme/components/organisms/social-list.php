<?php

if ( ! defined( 'ABSPATH' ) )
    die();

$socials = \Badfennec\Frontend\Socials::get();

if( empty( $socials ) )
    return;

?>

<ul class="flex gap-3">
    <?php

    foreach( $socials as $social ){
    ?>

    <li>
        <a 
            href="<?php echo esc_url( $social['url'] ); ?>"
            title="<?php printf(__('Follow us on %s', 'badfennec'), $social['name']); ?>"
            target="_blank" 
            rel="noopener noreferrer" 
            aria-label="<?php echo esc_attr( $social['name'] ); ?>"
        >
            <?php echo $social['icon']; ?>
        </a>
    </li>

    <?php
    }
    ?>
</ul>