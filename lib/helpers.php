<?php


// Pluggable filters

if ( ! function_exists('filter_the_wp_title') ) {
// Creates a nicely formatted and more specific title text
function filter_the_wp_title($title, $sep) {

	global $paged, $page;

	$site_description = get_bloginfo('description', 'display');
	$site_title       = get_bloginfo('name', 'display');

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	if ( is_front_page() ) {
		$title .= $site_title;
	}

	// Add the site description for the home/front page.
	if ( $site_description && is_front_page() ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number when necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title " . sprintf( __('page %s', 'allin'), max( $paged, $page ) );
	} elseif ( ! is_front_page() ) {
		// Add the site name.
		$title .= $site_title;
	}

	return $title;

}
}// filter_the_wp_title


if ( ! function_exists('filter_the_branding_title') ) {
function filter_the_branding_title( $the_title ) {
	return sprintf( '<span>%s</span>', $the_title );
}
}// filter_the_branding_title


if ( ! function_exists('filter_the_colophon') ) {
function filter_the_colophon( $the_colophon ) {
	return wpautop( do_shortcode($the_colophon) );
}
}// filter_the_colophon



if ( ! function_exists('filter_the_body_class') ) {
function filter_the_body_class( $classes ) {
	return $classes;
}
}// filter_the_body_class


if ( ! function_exists('filter_the_post_class') ) {
function filter_the_post_class( $classes ) {
	return $classes;
}
}// filter_the_post_class

if ( ! function_exists('filter_gallery_atts') ) {
// Change the default gallery thumbnail size
function filter_gallery_atts( $out, $pairs, $atts ) {

	$atts = shortcode_atts( array(
		'size' => 'gallery',
	 ), $atts );

	$out['size'] = $atts['size'];

	return $out;

}
} // filter_gallery_atts


// Pluggable Template Tags

if ( ! function_exists('the_post_title') ) {
// Show the post title
function the_post_title() {
	
	if ( is_singular() ) {
		the_title( '<h1 class="entry-title">', '</h1>' );
	} else {
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	}

}
} // the_post_title


if ( ! function_exists('the_featured_image') ) {
// Shows the featured image
function the_featured_image( $size = '', $class = '' ) {

	if ( ! has_post_thumbnail() || post_password_required() ) {
		// Exit early if there's no need to show a featured image
		return;
	}

	$thumbnail_size = 'post-thumbnail';
	$class = esc_attr($class);

	// Show a full width featured image in some cases
	if ( apply_filters('fullwidth_featured_image', false) ) {
		$thumbnail_size = 'fullwidth';
	}

	// But change the featured image size to the prefered size if specified
	if ( $size ) {
		$thumbnail_size = $size;
	}

	// Show the featured image
	if ( is_singular() ) {
?>
	<div class="featured-image<?php if ( $class ) { echo ' ' . $class; } ?>"><?php the_post_thumbnail($thumbnail_size); ?></div>
<?php
	} else {
?>
	<a class="featured-image<?php if ( $class ) { echo ' ' . $class; } ?>" href="<?php esc_attr( the_permalink() ); ?>"><?php the_post_thumbnail($thumbnail_size); ?></a>
<?php
	}

}
} // the_featured_image


if ( ! function_exists('the_posted_on') ) {
// Shows the posted on
function the_posted_on( $before = '<p class="entry-meta postedon">', $after = '</p>' ) {

	$author_url     = '<a class="author vcard"><span class="fn">' . get_the_author() . '</span></a>';
	$published_date = '<span class="published">' . get_the_date() . '</span>';
	$updated_date   = sprintf( '<span class="hide modified"> ' . __('Updated on %s.', 'first') . '</span>',
		'<span class="updated">' . get_the_modified_date() . '</span>'
	);
	
	printf( $before . __('Posted by %s on %s.%s', 'first') . $after, $author_url, $published_date, $updated_date );

}
} // the_posted_on


if ( ! function_exists('the_posted_meta') ) {
// Shows the post meta
function the_posted_meta( $before = '<footer class="entry-meta"><p>', $after = '</p></footer>' ) {

	echo $before;
	
	if ( is_single() ) {
	
		if ( $categories = get_the_category_list( _x(', ', 'category separator', 'first') ) ) {
			printf( '<span class="categories">' . __('Filled under %s.', 'first') . '</span> ', $categories );
		}
		
		if ( $tags = get_the_tag_list( '', _x(', ', 'tag separator', 'first'), '' ) ) {
			printf( '<span class="tags">' . __('Tagged %s.', 'first') . '</span>', $tags );
		}
		
	} elseif ( is_singular() && get_the_taxonomies() ) {
		the_taxonomies();
	}
	
	echo $after;

}
} // the_posted_meta


if ( ! function_exists('the_breadcrumbs') ) {
// Shows the breadcrumbs
function the_breadcrumbs($before = '', $after = '') {

	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb( $before . '<p class="bc breadcrumbs">', '</p>' . $after );
	}

}
} // the_breadcrumbs


if ( ! function_exists('the_page_header') ) {
// Show a formatted page header
function the_page_header() {

	do_action('before_page_header');

	global $wp_query;

	$page_title = '';
	$page_description = '';

	if ( is_archive() ) {
	
		if ( is_category() ) {
		
			$page_title = sprintf( __( 'Category: %s', 'allin' ), '<span>' . single_cat_title('', false) . '</span>' );
			$page_description = category_description();
		
		} elseif ( is_tag() ) {
		
			$page_title = sprintf( __( 'Tagged: %s', 'allin' ), '<span>' . single_tag_title('', false) . '</span>' );
			$page_description = tag_description();
		
		} elseif ( is_tax() ) {
		
			$page_title = sprintf( __( 'Term: %s', 'allin' ), '<span>' . single_term_title('', false) . '</span>' );
			$page_description = term_description();
		
		} elseif ( is_author() ) {
		
			the_post();
			$page_title = sprintf( __( 'Author: %s', 'allin' ), '<span class="vcard">' . get_the_author() . '</span>' );
			$page_description = the_author_meta('description');
			rewind_posts();
		
		} elseif ( is_day() ) {
		
			$page_title = sprintf( __( 'Day: %s', 'allin' ), '<span>' . get_the_date() . '</span>' );
		
		} elseif ( is_month() ) {
		
			$page_title = sprintf( __( 'Month: %s', 'allin' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
		
		} elseif ( is_year() ) {
		
			$page_title = sprintf( __( 'Year: %s', 'allin' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
		
		} elseif ( is_post_type_archive() ) {
		
			$page_title = post_type_archive_title('', false);
		
		} else {
			
			$page_title = __( 'Archives', 'allin' );
			
		}
	
	} elseif ( is_search() ) {
	
		$page_title = sprintf( __( 'Search: %s', 'allin' ), '<span>' . get_search_query() . '</span>' );
		$page_description = sprintf( _n('One result was found.', 'There are %s search results.', $wp_query->found_posts, 'allin'), $wp_query->found_posts );
	
	} elseif ( is_home() || is_page_template('home.php') ) {
		
		if ( is_home() ) {
			$page_for_posts = get_option('page_for_posts' );
		} else {
			$page_for_posts = get_the_id();
		}
		
		// Get a proper page title
		if ( empty($page_for_posts) ) {
			$page_title = __('Latest posts', 'allin');
		} else {
		
			$blog_page = get_post( $page_for_posts );
			
			$page_title = apply_filters('the_title', $blog_page->post_title);
			$page_description = wpautop($blog_page->post_content);
		
		}
		
		// Get the actual posts when using the template
		if ( is_page() ) {
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			query_posts('post_type=post&paged=' . $paged);
		}
	
	}

	$page_title = apply_filters('the_page_title', $page_title);
	$page_description = apply_filters('the_page_description', $page_description);

	if ( empty( $page_title ) && empty( $page_description ) ) {
		return;
	}

	?>
<div class="ph page-header">
	<?php
		if ( ! empty($page_title) ) {
			printf( '<h1 class="pt page-title">%s</h1>', $page_title );
		}
		if ( ! empty($page_description) ) {
			printf( '<div class="pd page-description">%s</div>', $page_description );
		}
		if ( is_tax() || is_category() || is_tag() ) {
			edit_term_link( null, '<p class="el edit-link">', '</p>' );
		} elseif ( is_home() ) {
			edit_post_link( null, '<p class="el edit-link">', '</p>' );
		}
	?>
</div>
	<?php

	do_action('after_page_header');

}
} // the_page_header


if ( ! function_exists('the_post_nav') ) {
// Show links to next/previous post @todo: $args
function the_post_nav( $before = '', $after = '' ) {

	if ( ! is_single() ) {
		return;
	}

	if ( empty($before) ) {
		$before = '<div class="post-nav"><p>';
	}
	if ( empty($after) ) {
		$after = '</p></div>';
	}

	if ( get_next_post() || get_previous_post() ) {
	
		echo $before;
		previous_post_link( '<span class="prev">' . '&laquo; %link' . '</span>' );
		next_post_link( '<span class="next">' . '%link &raquo;' . '</span>' );
		echo $after;
	
	}

}
} // the_post_nav


if ( ! function_exists('the_archive_nav') ) {
// Show links to next/previous page @todo: $args
function the_archive_nav( $before = '', $after = '', $next = '' ) {

	if ( is_singular() ) {
		return;
	}

	if ( empty($before) ) {
		$before = '<div class="archive-nav"><p>';
	}
	if ( empty($after) ) {
		$after = '</p></div>';
	}

	$prev = __('&lsaquo; Previous Page', 'first');
	$next = __('Next Page &rsaquo;', 'first');

	if ( is_search() ) {
		$next = __('More results &rsaquo;', 'first');
	}

	if ( get_next_posts_link() || get_previous_posts_link() ) {
	
		echo $before;
		previous_posts_link( $prev );
		next_posts_link( $next );
		echo $after;
	
	}

}
} // the_archive_nav


/* Pluggable support hooks */

if ( ! function_exists('wp_head_inline_html5shiv') ) {
function wp_head_inline_html5shiv() {
	printf('<!--[if lt IE 9]><script>\'aside, details, figcaption, figure, footer, header, hgroup, main, nav, section, summary, time\'.replace(/\w+/g,function(n){document.createElement(n)})</script><![endif]-->' . "\n");
}
}// wp_head_inline_html5shiv


if ( ! function_exists('wp_head_respondjs_ie') ) {
function wp_head_respondjs_ie() {
	printf( '<!--[if lt IE 9]><script src="%s/lib/js/respond.min.js"></script><![endif]-->' . "\n", get_template_directory_uri() );
}
}// wp_head_respondjs_ie
