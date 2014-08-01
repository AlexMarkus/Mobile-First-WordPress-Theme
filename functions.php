<?php


// Set the recommended content width
if ( ! isset( $content_width ) ) {
	$content_width = 768;
}

if ( ! function_exists('') ) {
function first_theme_setup() {

	load_theme_textdomain( 'allin', get_template_directory() . '/lang' );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(768, 0, false);

	$nav_menus = array(
		'nav'      => __('Navigation', 'allin'),
	);
	register_nav_menus( apply_filters('the_nav_menus', $nav_menus) );

	$html5_support = array( 'gallery', 'caption' );
	add_theme_support( 'html5', $html5_support );

	add_theme_support( 'automatic-feed-links' );

	$custom_background_args = array();
	add_theme_support( 'custom-background', apply_filters('the_custom_background_args', $custom_background_args) );

	$custom_header_args = array();
	add_theme_support( 'custom-header', apply_filters('the_custom_header_args', $custom_header_args) );

	add_theme_support('soil-clean-up');

}
}

add_action('after_setup_theme', 'first_theme_setup');


if ( ! function_exists('first_enqueue_styles') ) {
function first_enqueue_styles() {

	// Theme stylesheet
	wp_register_style( 'style', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style( 'style' );

	// Custom modernizr build
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/lib/js/modernizr.custom.min.js', array(), false, true );

	// Theme script
	wp_enqueue_script( 'theme', get_template_directory_uri() . '/lib/js/theme.min.js', array(), false, true );

	// Comment reply script for threaded comments
	if ( is_singular() && comments_open() && get_option('thread_comments') ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
}

add_action('wp_enqueue_scripts', 'first_enqueue_styles');


if ( ! function_exists('first_register_widget_areas') ) {
function first_register_widget_areas() {
	register_sidebar( array(
		'id'            => 'sidebar',
		'name'          => __('Sidebar', 'allin'),
		'description'   => __('This is the default sidebar, the widgets you drag here will show up in various locations on your pages and posts.', 'allin'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
}

add_action('widgets_init', 'first_register_widget_areas');


// Hooks&Filters

include_once( dirname(__FILE__) . '/lib/helpers.php' );

// Adds inline html5shiv to the head
add_action('wp_head', 'wp_head_inline_html5shiv', 6);

add_filter('wp_title', 'filter_the_wp_title', 10, 2);
add_filter('branding_title', 'filter_the_branding_title');
add_filter('the_colophon', 'filter_the_colophon');

add_filter('body_class', 'filter_the_body_class', 12);
add_filter('post_class', 'filter_the_post_class', 12);

// Add breadcrumbs and page title before the feed
add_action('before_feed', 'the_breadcrumbs');
add_action('before_feed', 'the_page_header');

// Add navigation links after the feed
/* add_action('after_feed', 'the_post_nav');
add_action('after_feed', 'the_page_nav');
add_action('after_feed', 'the_archive_nav'); */

// More stuff
include_once( dirname(__FILE__) . '/lib/shortcodes.php' );
