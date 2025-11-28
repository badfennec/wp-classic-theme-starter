<?php

if ( ! defined( 'ABSPATH' ) )
	die();

$contacts = \BadFennec\Frontend\Contacts::get();
$socials = \BadFennec\Frontend\Socials::get();

?>

<div id = "main_footer" class="main-footer">

    <div class="container">

        <?php echo implode( '<br>', $contacts ); ?>

        <?php \BadFennec\Frontend\Components::get_component( 'social-list' ); ?>

    </div><!-- .container -->

</div><!-- #main_footer -->