<?php

if ( ! defined( 'ABSPATH' ) ) {
    die();
}

function vctheme_block_image_get_video( $args ){

    ob_start();

    ?>

    <video loop autoplay muted playsinline class="<?php echo @$args['class'] ?>">
        <source src="<?php echo @$args['url'] ?>" type="video/mp4">
    </video>

    <?php

    return ob_get_clean();

}

$mobile_item = '';
$desktop_item = '';
$mobile_class = $desktop_class = array();

$mobile_id = @$args['mobile_id'];
$desktop_id = @$args['desktop_id'];
$mobile_video = @$args['video_mobile'];
$desktop_video = @$args['video_desktop'];

if( $mobile_id || $mobile_video ){
    $desktop_class[] = 'hidden';
}
    

if( $desktop_id || $desktop_video ){
    $mobile_class[] = 'md:hidden';
    $desktop_class[] = 'md:block';
}

$thumb_args = [];

if( @$args['page_index'] === 0 ){
    $thumb_args['fetchpriority'] = 'high';
    $thumb_args['loading'] = 'eager';
    $thumb_args['decoding'] = 'async';
}

if( $mobile_id ){
    $thumb_args['class'] = implode(' ', $mobile_class );
    $mobile_item = wp_get_attachment_image($mobile_id, 'full', null, $thumb_args );
}

if( $mobile_video )
    $mobile_item = vctheme_block_image_get_video( array( 'url' => $mobile_video, 'class' => implode(' ', $mobile_class ) ) );

if( $desktop_id ){
    $thumb_args['class'] = implode(' ', $desktop_class );
    $desktop_item = wp_get_attachment_image($desktop_id, 'full', null, $thumb_args );
}

if( $desktop_video )
    $desktop_item = vctheme_block_image_get_video( array( 'url' => $desktop_video, 'class' => implode(' ', $desktop_class ) ) );

echo $mobile_item;
echo $desktop_item;