<?php

/**
 * Tabs Standard Component
 * keep this structure for all components that implements tabs
 * badfennec-tabs is the main class
 * badfennec-tabs__button is the button class, add modifier badfennec-tabs__button--active for the active button
 * badfennec-tabs__item is the item class, add modifier badfennec-tabs__item--active for the active item
 * Feel free to extend this component as needed but kep the class above and is logical structure
 */

if ( ! defined( 'ABSPATH' ) )
	die();

$loop = @$args['loop'];

if( !$loop || count( $loop ) == 0 )
    return;

$buttons = [];
$tab_contents = [];

foreach( $loop as $k => $item ){

    $buttons[] = '
        <div class="badfennec-tabs__button'.( $k === 0 ? ' badfennec-tabs__button--active' : '' ).'" role="button">
            '.esc_attr( @$item['title'] ).'
        </div>
    ';

    $tab_contents[] = '
        <div class="badfennec-tabs__item'.( $k === 0 ? ' badfennec-tabs__item--active' : '' ).'">
            '.@$item['content'].'
        </div>
    ';
}

?>

<div class="badfennec-tabs">
    <div class="badfennec-tabs__buttons flex gap-2">
        <?php echo implode( '', $buttons ); ?>
    </div>
    <div class="badfennec-tabs__items">
        <?php echo implode( '', $tab_contents ); ?>
    </div>
</div>