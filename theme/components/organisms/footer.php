<?php

if ( ! defined( 'ABSPATH' ) )
	die();

$contacts = \Badfennec\Frontend\Contacts::get();
$socials = \Badfennec\Frontend\Socials::get();

?>

<div id = "main_footer">

    <div class = "container">

        <?php echo implode( '<br>', $contacts ); ?>

        <?php \Badfennec\Frontend\Components::get_components( 'social-list' ); ?>

    </div><!-- .container -->

</div><!-- #main_footer -->