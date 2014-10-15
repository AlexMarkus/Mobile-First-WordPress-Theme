<?php
// Theme functions


// Prevent switching to this theme on older versions of WordPress
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	switch_theme( WP_DEFAULT_THEME );
	wp_die( __('This theme requires at least WordPress version 3.6. Please upgrade and try again.', 'mobilefirst') );
}


// Set a recommended content width
if ( ! isset( $content_width ) ) {
	$content_width = 768;
}


if ( ! function_exists('mobilefirst_theme_setup') ) {
// Sets up the theme
function mobilefirst_theme_setup() {

	// Make the theme available for translation
	load_theme_textdomain( 'mobilefirst', get_template_directory() . '/lib/lang' );

	// This theme uses featured images (post thumbnails)
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(768, 0, false);
	add_image_size( 'gallery', 300, 300, true );
	add_image_size( 'full-md', 992 );

	// This theme uses custom nav locations
	$nav_menus = array(
		'nav'      => __('Navigation', 'mobilefirst'),
	);
	register_nav_menus( apply_filters('the_nav_menus', $nav_menus) );

	// This theme supports html5
	$html5_support = array( 'gallery', 'caption', 'comment-list', 'comment-form', 'search-form' );
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
	wp_register_style( 'style', apply_filters('mobilefirst_stylesheet_filename', get_stylesheet_uri()) );
	wp_enqueue_style( 'style' );

	// modernizr.js
	wp_register_script( 'modernizr', get_template_directory_uri() . '/lib/js/min/modernizr.custom.min.js', array(), false, true );

	// fastclick.js
	wp_register_script( 'fastclick', get_template_directory_uri() . '/lib/js/min/fastclick.min.js', array(), false, true );

	// headroom.js
	wp_register_script( 'headroom', get_template_directory_uri() . '/lib/js/min/headroom.min.js', array(), false, true );

	// Theme script
	wp_enqueue_script( 'theme', get_template_directory_uri() . '/lib/js/min/theme.min.js', array(), false, true );
	if ( $the_localized_theme_script = apply_filters('mobilefirst_localized_theme_script', array()) ) {
		wp_localize_script( 'theme', 'theme', $the_localized_theme_script );
	}

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
		'name'          => __('Sidebar', 'mobilefirst'),
		'description'   => __('This is the default sidebar, the widgets you drag here will show up in various locations on your pages and posts.', 'mobilefirst'),
		'before_widget' => '<div id="%1$s" class="w widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="wt widget-title">',
		'after_title'   => '</h4>',
	) );
}
}

add_action('widgets_init', 'mobilefirst_register_widget_areas');


// Hooks&Filters
include_once( get_template_directory() . '/lib/helpers.php' );

// Shortcodes
include_once( get_template_directory() . '/lib/shortcodes.php' );


if ( ! function_exists('mobilefirst_hooks_setup') ) {
// Hook some theme functions and filters
function mobilefirst_hooks_setup() {

	// Use the minified stylesheet
	//add_filter('mobilefirst_stylesheet_filename', 'mobilefirst_minified_stylesheet');
	//add_filter('wp_head', 'mobilefirst_html_js_class');
	//add_filter('wp_head', 'mobilefirst_inline_html5shiv');
	//add_filter('wp_head', 'mobilefirst_respondjs');

	// Filter the html title, site title and colophon
	add_filter('wp_title', 'mobilefirst_wp_title', 10, 2);
	add_filter('branding_title', 'mobilefirst_branding_title');
	add_filter('the_colophon', 'mobilefirst_colophon');

	// Add body and post classes
	add_filter('body_class', 'mobilefirst_body_classes', 12);
	add_filter('post_class', 'mobilefirst_post_class', 12);

	// Add breadcrumbs and page title before the feed
	add_action('before_posts', 'mobilefirst_breadcrumbs');
	add_action('before_posts', 'mobilefirst_page_header');

	// Post content templates
	add_filter('the_post_header', 'mobilefirst_post_title');
	add_filter('the_post_header', 'mobilefirst_postedon');
	add_filter('after_post_content', 'mobilefirst_post_meta');

	// Add nav links right after the feed
	add_action('after_posts', 'mobilefirst_post_nav');
	add_action('after_posts', 'mobilefirst_archive_nav');

	// Better resolution for galleries
	add_filter('shortcode_atts_gallery', 'mobilefirst_gallery_atts', 10, 3);

	// Hide ACF field admin menu item when not on localhost
	if ( $_SERVER["SERVER_ADDR"] != '::1' ) {
		add_filter('acf/settings/show_admin', '__return_false');
	}
}
}

add_action('wp', 'mobilefirst_hooks_setup', 8);


// Done with the theme setup
do_action('after_theme_functions');