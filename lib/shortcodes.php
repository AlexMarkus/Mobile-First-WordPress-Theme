<?php

function the_post_date_shortcode( $atts ) {

	$defaults = array(
		'format' => get_option('date_format')
	);

	$atts = shortcode_atts( $defaults, $atts, 'post_date' );

	$post_date = sprintf( '<time class="entry-date published updated" datetime="%s">%s</time>',
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	return $post_date;

}

add_shortcode('post_date', 'the_post_date_shortcode');


function the_post_time_shortcode( $atts ) {
}

add_shortcode('post_time', '');


function the_post_modified_shortcode( $atts ) {
}

add_shortcode('post_modified', '');


function the_post_author_shortcode( $atts ) {

	$defaults = array();

	$atts = shortcode_atts( $defaults, $atts, 'post_author' );

	$post_author = sprintf( '<span class="author vcard"><span class="url fn n">%s</span></span>',
		get_the_author()
	);

	return $post_author;

}

add_shortcode('post_author', 'the_post_author_shortcode');


function the_post_author_link_shortcode( $atts ) {

	$defaults = array();

	$atts = shortcode_atts( $defaults, $atts, 'post_author_link' );

	$post_author_link = sprintf( '<span class="author vcard"><a class="url fn n" href="%s" rel="author">%s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);

	return $post_author_link;

}

add_shortcode('post_author_link', 'the_post_author_link_shortcode');


function the_post_comments_shortcode( $atts ) {

	$defaults = array(
		'after'       => '',
		'before'      => '',
		'none'        => __( 'No comments', 'starter' ),
		'one'         => __( '1 Comment', 'starter' ),
		'many'        => __( '% Comments', 'starter' ),
	);

	$atts = shortcode_atts( $defaults, $atts, 'post_comments' );
	extract($atts);

	ob_start();
	comments_number( $none, $one, $many );
	$comments_number = ob_get_clean();

	$post_comments = sprintf( '<a href="%s" class="comments">%s</a>',
		get_comments_link(),
		$comments_number
	);

	return $post_comments;

}

add_shortcode('post_comments', 'the_post_comments_shortcode');


function the_post_categories_shortcode( $atts ) {

	$defaults = array();

	$atts = shortcode_atts( $defaults, $atts, 'post_categories' );

	$post_categories = '<span class="categories">' . get_the_category_list( _x( ', ', 'term separator', 'starter' ) ) . '</span>';

	return $post_categories;

}

add_shortcode('post_categories', 'the_post_categories_shortcode');


function the_post_tags_shortcode( $atts ) {

	$defaults = array();

	$atts = shortcode_atts( $defaults, $atts, 'post_tags' );

	$post_tags = '<span class="tags">' . get_the_tag_list( '', _x( ', ', 'term separator', 'starter' ), '' ) . '</span>';

	return $post_tags;

}

add_shortcode('post_tags', 'the_post_tags_shortcode');


function the_post_terms_shortcode( $atts ) {

	$defaults = array(
		'taxonomy' => 'category',
	);

	$atts = shortcode_atts( $defaults, $atts, 'post_terms' );

	$post_terms = get_the_term_list( get_the_id(), $atts['taxonomy'], '<span class="terms">', _x( ', ', 'term separator', 'starter' ), '</span>' );

	return $post_terms;

}

add_shortcode('post_terms', 'the_post_terms_shortcode');


function the_post_meta_shortcode( $atts ) {

	$defaults = array(
		'field'  => '',
		'before' => '',
		'after'  => '',
		'separator' => _x( ', ', 'meta separator', 'starter' ),
	);

	$atts = shortcode_atts( $defaults, $atts, 'post_meta' );
	extract($atts);

	if ( empty($field) ) {
		return;
	}

	$post_meta = $before . implode( $separator, get_post_meta( get_the_ID(), $field ) ) . $after;

	return $post_meta;

}

add_shortcode('post_meta', 'the_post_meta_shortcode');

