<?php
// Theme functions


// Prevent switching to this theme on older versions of WordPress
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	switch_theme( WP_DEFAULT_THEME );
	wp_die( __('This theme requires at least WordPress version 3.6. Please upgrade and try again.', 'first') );
}


// Set the recommended content width
if ( ! isset( $content_width ) ) {
	$content_width = 768;
}


if ( ! function_exists('mobilefirst_theme_setup') ) {
// Sets up the theme
function mobilefirst_theme_setup() {

	// Make the theme available for translation
	load_theme_textdomain( 'first', get_template_directory() . '/lib/lang' );

	// This theme uses featured images (post thumbnails)
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(768, 0, false);
	add_image_size( 'gallery', 300, 300, true );

	// This theme uses custom nav locations
	$nav_menus = array(
		'nav'      => __('Navigation', 'first'),
	);
	register_nav_menus( apply_filters('the_nav_menus', $nav_menus) );

	// This theme supports html5
	$html5_support = array( 'gallery', 'caption' );
	add_theme_support( 'html5', $html5_support );

	add_theme_support( 'automatic-feed-links' );

	$custom_background_args = array();
	add_theme_support( 'custom-background', apply_filters('the_custom_background_args', $custom_background_args) );

	// The custom header support is used to display a logo
	$custom_header_args = array();
	add_theme_support( 'custom-header', apply_filters('the_custom_header_args', $custom_header_args) );

	// This theme uses its own gallery styles
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Cleanup various theme code
	add_theme_support('am-clean-up');

}
}

add_action('after_setup_theme', 'mobilefirst_theme_setup');


if ( ! function_exists('mobilefirst_enqueue_styles') ) {
// Enqueue styles and scripts
function mobilefirst_enqueue_styles() {

	// Theme stylesheet
	wp_register_style( 'style', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style( 'style' );

	// modernizr.js
	wp_register_script( 'modernizr', get_template_directory_uri() . '/lib/js/modernizr.custom.min.js', array(), false, true );

	// fastclick.js
	wp_register_script( 'fastclick', get_template_directory_uri() . '/lib/js/fastclick.min.js', array(), false, true );

	// headroom.js
	wp_register_script( 'headroom', get_template_directory_uri() . '/lib/js/headroom.min.js', array(), false, true );

	// Theme script
	wp_enqueue_script( 'theme', get_template_directory_uri() . '/lib/js/theme.js', array(), false, true );
	wp_localize_script( 'theme', 'theme', array());

	// Comment reply script for threaded comments
	if ( is_singular() && comments_open() && get_option('thread_comments') ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
}

add_action('wp_enqueue_scripts', 'mobilefirst_enqueue_styles');


if ( ! function_exists('mobilefirst_register_widget_areas') ) {
// Register widget areas used by this theme
function mobilefirst_register_widget_areas() {
	register_sidebar( array(
		'id'            => 'sidebar',
		'name'          => __('Sidebar', 'first'),
		'description'   => __('This is the default sidebar, the widgets you drag here will show up in various locations on your pages and posts.', 'first'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
}

add_action('widgets_init', 'mobilefirst_register_widget_areas');


// Hooks&Filters

include_once( dirname(__FILE__) . '/lib/helpers.php' );

// Adds inline html5shiv and respond js
add_action('wp_head', 'wp_head_inline_html5shiv', 6);
add_action('wp_head', 'wp_head_respondjs_ie', 9);

// Filter the html title, site title and colophon
add_filter('wp_title', 'filter_the_wp_title', 10, 2);
add_filter('branding_title', 'filter_the_branding_title');
add_filter('the_colophon', 'filter_the_colophon');

// Add body and post classes
add_filter('body_class', 'filter_the_body_class', 12);
add_filter('post_class', 'filter_the_post_class', 12);

// Add breadcrumbs and page title before the feed
add_action('before_posts', 'the_breadcrumbs');
add_action('before_posts', 'the_page_header');

// Add nav links and comments right after the feed
add_action('after_posts', 'the_post_nav');
add_action('after_posts', 'the_archive_nav');
add_action('after_posts', 'comments_template');

add_filter('shortcode_atts_gallery', 'filter_gallery_atts', 10, 3);

// Shortcodes
include_once( dirname(__FILE__) . '/lib/shortcodes.php' );

