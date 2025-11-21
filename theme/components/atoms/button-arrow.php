<?php

if( !defined( 'ABSPATH' ) ){
    exit;
}

$class = array( 'badfennec-arrow-link');

if( @$args['class'] )
    $class[] = $args['class'];

$attrs = array();

if( @$args['url'] )
    $attrs[] = 'href = " '. $args['url'] .'"';

if( @$args['target'] )
    $attrs[] = 'target = " '. $args['target'] .'"';

if( @$args['attrs'] ){
    foreach( $args['attrs'] as $k => $v )
        $attrs[] = $k . ' = "'. $v .'"';
}



if( @$args['reverse'] ){  
    $svgShape = 'arrow-left';
    $class[] = 'badfennec-arrow-link--reverse';
} else {
    $svgShape = 'arrow-right';
}

?>
<a 
    class="<?php echo implode(' ', $class ) ?>" 
    <?php echo implode( ' ', $attrs) ?>
><?php echo trim( esc_attr( @$args['title'] ) ); ?> <?php echo \Badfennec\Utils\SVG::print( $svgShape ) ?>
</a>