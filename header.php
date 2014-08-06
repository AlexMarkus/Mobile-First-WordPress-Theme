<?php
// Theme header

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="initial-scale=1,user-scalable=yes,minimal-ui">

<title><?php wp_title( __('&rsaquo;', 'first'), true, 'right' ); ?></title>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<a id="top"></a>
<a href="#copy" class="srt skip-content"><?php _e('Skip to content &rsaquo;', 'first'); ?></a>

<header class="header">

<div class="branding">

	<div class="title"><?php
		printf( '<a href="%s">%s</a>',
			get_home_url(),
			apply_filters('branding_title', get_bloginfo('name', 'display'))
		);
	?></div>

	<div class="tagline"><?php echo apply_filters('branding_description', get_bloginfo('description')); ?></div>

	<p class="skip-nav"><a href="#nav" id="skip-nav"><?php _e('Show navigation', 'first'); ?></a></p>
	<nav id="nav" class="nav"><?php
		wp_nav_menu( array(
			'theme_location' => 'nav',
			'items_wrap' => '<ul class="%2$s">%3$s</ul>',
			'container' => '',
		) );
	?></nav>

</div>

</header>

<main id="copy" role="main"><?php do_action('before_main'); ?>