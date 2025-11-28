<!doctype html>
<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="format-detection" content="telephone=no,address=no,email=no,url=no">
		<title><?php wp_title(); ?></title>
		<?php wp_head(); ?>
	</head>

	<body <?php body_class('font-sans antialiased'); ?>>

	<div id = "container">

		<?php \BadFennec\Frontend\Components::get_component( 'header' ); ?>
					
		<div id = "content">