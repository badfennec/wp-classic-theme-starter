<?php

if ( ! defined( 'ABSPATH' ) ) {
    die();
}

$tags = array();
$style = array();

if( @$args['id'] )
    $tags[] = 'id = "'. $args['id'] .'"';

$class = array('badfennec-block-spacer');

if( @$args['hide_on_mobile'] ){
    $class[] = 'hidden xl:block';

    if( !@$args['hide_on_tablet'] )
    $class[] = 'md:block';
}       

if( @$args['hide_on_tablet'] )
    $class[] = 'md:hidden';

if( @$args['hide_on_desktop'] )
    $class[] = 'xl:hidden';

$min = @$args['min'] ? $args['min'] . 'px' : 0;
$max = @$args['max'] ? $args['max'] . 'px' : 0;

?>

<div <?php echo implode(' ', $tags ); ?> class="<?php echo implode( ' ', $class ) ?>">
    <div class="xl:hidden" style = "height: <?php echo $min; ?>"></div>
    <div class="hidden xl:block" style = "height: <?php echo $max; ?>"></div>
</div>