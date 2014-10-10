<?php
// Theme header

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>

<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="<?php echo apply_filters('meta_viewport', 'initial-scale=1,user-scalable=yes,minimal-ui'); ?>">
<title><?php wp_title( _x('›', 'title separator', 'mobilefirst'), true, 'right' ); ?></title>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<a id="top"></a>
<a href="#copy" class="srt skip-content"><?php _e('Skip to content ›', 'mobilefirst'); ?></a>

<header class="header">

<div class="branding">

	<p class="logo"><?php
		printf( '<a href="%s/">%s</a>',
			get_home_url(),
			apply_filters('branding_title', get_bloginfo('name', 'display'))
		);
	?></p>

	<p class="tagline"><?php echo apply_filters('branding_description', get_bloginfo('description')); ?></p>

	<p class="hide-lap skip-nav"><a href="#nav" id="skip-nav" title="<?php _e('Show navigation', 'mobilefirst'); ?>"><?php _e('Show navigation', 'mobilefirst'); ?></a></p>
	<nav id="nav" class="hide block-lap nav"><?php
		wp_nav_menu( array(
			'theme_location' => 'nav',
			'items_wrap' => '<ul class="%2$s">%3$s</ul>',
			'container' => '',
		) );
	?></nav>

</div>

</header>

<main id="copy" role="main"><?php do_action('before_main'); ?>