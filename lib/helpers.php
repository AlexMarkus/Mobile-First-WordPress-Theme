<?php


// Pluggable filters

if ( ! function_exists('mobilefirst_wp_title') ) {
// Creates a nicely formatted and more specific title text
function mobilefirst_wp_title($title, $sep) {

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
		$title = "$title " . sprintf( __('page %s', 'mobilefirst'), max( $paged, $page ) );
	} elseif ( ! is_front_page() ) {
		// Add the site name.
		$title .= $site_title;
	}

	return $title;

}
}// mobilefirst_wp_title


if ( ! function_exists('mobilefirst_branding_title') ) {
function mobilefirst_branding_title( $the_title ) {
	return sprintf( '<span>%s</span>', $the_title );
}
}// mobilefirst_branding_title


if ( ! function_exists('mobilefirst_branding_logotitle') ) {
function mobilefirst_branding_logotitle( $the_title ) {
	if ( ! get_custom_header() ) {
		return $the_title;
	}
	return sprintf( '<img src="%s" width="%s" height="%s" alt="%s" >', get_header_image(), get_custom_header()->width, get_custom_header()->height, esc_attr($the_title) );
}
}// mobilefirst_branding_logotitle


if ( ! function_exists('mobilefirst_colophon') ) {
function mobilefirst_colophon( $the_colophon ) {
	return wpautop( do_shortcode($the_colophon) );
}
}// mobilefirst_colophon


if ( ! function_exists('mobilefirst_body_classes') ) {
function mobilefirst_body_classes( $classes ) {
	return $classes;
}
}// mobilefirst_body_classes


if ( ! function_exists('mobilefirst_post_class') ) {
function mobilefirst_post_class( $classes ) {
	return $classes;
}
}// mobilefirst_post_class


if ( ! function_exists('mobilefirst_gallery_atts') ) {
// Change the default gallery thumbnail size
function mobilefirst_gallery_atts( $out, $pairs, $atts ) {

	$atts = shortcode_atts( array(
		'size' => 'gallery',
	 ), $atts );

	$out['size'] = $atts['size'];

	return $out;

}
} // mobilefirst_gallery_atts


// Pluggable Template Tags

if ( ! function_exists('mobilefirst_post_title') ) {
// Show the post title
function mobilefirst_post_title() {
	
	if ( is_singular() ) {
		the_title( '<h1 class="et entry-title">', '</h1>' );
	} else {
		the_title( '<h2 class="et entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	}

}
} // mobilefirst_post_title


if ( ! function_exists('mobilefirst_featured_image') ) {
// Shows the featured image
function mobilefirst_featured_image( $post_id = false, $size = '', $class = '' ) {

	if ( ! has_post_thumbnail() || post_password_required() ) {
		// Exit early if there's no need to show a featured image
		return;
	}

	$thumbnail_size = 'post-thumbnail';
	$class = esc_attr($class);

	// Show a full width featured image
	if ( apply_filters('fullwidth_featured_image', false) ) {
		$thumbnail_size = 'fullwidth';
	}

	// But change the featured image size to the prefered size if specified
	if ( $size ) {
		$thumbnail_size = $size;
	}

	if ( ! $post_id ) {
		$post_id = get_the_id();
	}

	// Show the featured image
	if ( is_singular() ) {
?>
	<div class="fi featured-image<?php if ( $class ) { echo ' ' . $class; } ?>"><?php echo get_the_post_thumbnail($post_id, $thumbnail_size); ?></div>
<?php
	} else {
?>
	<a class="fi featured-image<?php if ( $class ) { echo ' ' . $class; } ?>" href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail($post_id, $thumbnail_size); ?></a>
<?php
	}

}
} // mobilefirst_featured_image


if ( ! function_exists('mobilefirst_postedon') ) {
// Shows the posted on
function mobilefirst_postedon( $before = '', $after = '' ) {

	if ( ! $before ) {
		$before = '<p class="pm po entry-meta postedon">';
	}
	if ( ! $after ) {
		$after = '</p>';
	}

	$author_url     = '<span class="author vcard"><span class="fn">' . get_the_author() . '</span></span>';
	$published_date = '<span class="published">' . get_the_date() . '</span>';
	$updated_date   = sprintf( '<span class="hide modified"> ' . __('Updated on %s.', 'mobilefirst') . '</span>',
		'<span class="updated">' . get_the_modified_date() . '</span>'
	);
	
	$utility_text = $before . __('Posted by %1$s on %2$s.%3$s', 'mobilefirst') . $after;
	printf( $utility_text, $author_url, $published_date, $updated_date );

}
} // mobilefirst_postedon


if ( ! function_exists('mobilefirst_post_meta') ) {
// Shows the post meta
function mobilefirst_post_meta( $before = '', $after = '' ) {

	if ( ! $before ) {
		$before = '<footer class="pm entry-meta"><p>';
	}
	if ( ! $after ) {
		$after = '</p></footer>';
	}

	echo $before;
	
	if ( is_single() ) {
	
		if ( $categories = get_the_category_list( _x(', ', 'category separator', 'mobilefirst') ) ) {
			printf( '<span class="categories">' . __('Filled under %s.', 'mobilefirst') . '</span> ', $categories );
		}
		
		if ( $tags = get_the_tag_list( '', _x(', ', 'tag separator', 'mobilefirst'), '' ) ) {
			printf( '<span class="tags">' . __('Tagged %s.', 'mobilefirst') . '</span>', $tags );
		}
		
	} elseif ( is_singular() && get_the_taxonomies() ) {
		the_taxonomies();
	}
	
	echo $after;

}
} // mobilefirst_post_meta


if ( ! function_exists('mobilefirst_breadcrumbs') ) {
// Shows the breadcrumbs
function mobilefirst_breadcrumbs($before = '', $after = '') {

	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb( $before . '<p class="bc breadcrumbs">', '</p>' . $after );
	}

}
} // mobilefirst_breadcrumbs


if ( ! function_exists('mobilefirst_page_header') ) {
// Show a formatted page header
function mobilefirst_page_header() {

	do_action('before_page_header');

	global $wp_query;

	$page_title = '';
	$page_description = '';

	if ( is_archive() ) {
	
		if ( is_category() ) {
		
			$page_title = sprintf( __( 'Category: %s', 'mobilefirst' ), '<span>' . single_cat_title('', false) . '</span>' );
			$page_description = category_description();
		
		} elseif ( is_tag() ) {
		
			$page_title = sprintf( __( 'Tagged: %s', 'mobilefirst' ), '<span>' . single_tag_title('', false) . '</span>' );
			$page_description = tag_description();
		
		} elseif ( is_tax() ) {
		
			$page_title = sprintf( __( 'Term: %s', 'mobilefirst' ), '<span>' . single_term_title('', false) . '</span>' );
			$page_description = term_description();
		
		} elseif ( is_author() ) {
		
			the_post();
			$page_title = sprintf( __( 'Author: %s', 'mobilefirst' ), '<span class="vcard">' . get_the_author() . '</span>' );
			$page_description = the_author_meta('description');
			rewind_posts();
		
		} elseif ( is_day() ) {
		
			$page_title = sprintf( __( 'Day: %s', 'mobilefirst' ), '<span>' . get_the_date() . '</span>' );
		
		} elseif ( is_month() ) {
		
			$page_title = sprintf( __( 'Month: %s', 'mobilefirst' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
		
		} elseif ( is_year() ) {
		
			$page_title = sprintf( __( 'Year: %s', 'mobilefirst' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
		
		} elseif ( is_post_type_archive() ) {
		
			$page_title = post_type_archive_title('', false);
		
		} else {
			
			$page_title = __( 'Archives', 'mobilefirst' );
			
		}
	
	} elseif ( is_search() ) {
	
		$page_title = sprintf( __( 'Search: %s', 'mobilefirst' ), '<span>' . get_search_query() . '</span>' );
		$page_description = sprintf( _n('One result was found.', 'There are %s search results.', $wp_query->found_posts, 'mobilefirst'), $wp_query->found_posts );
	
	} elseif ( is_home() || is_page_template('home.php') ) {
		
		if ( is_home() ) {
			$page_for_posts = get_option('page_for_posts');
		} else {
			$page_for_posts = get_the_id();
		}
		
		// Get a proper page title
		if ( empty($page_for_posts) ) {
			$page_title = __('Latest posts', 'mobilefirst');
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
	
	} elseif ( is_single() ) {
		$page_for_posts = get_option('page_for_posts');
		$blog_page = get_post( $page_for_posts );
		$page_title = apply_filters('the_title', $blog_page->post_title);
		$page_description = wpautop($blog_page->post_content);
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
} // mobilefirst_page_header


if ( ! function_exists('mobilefirst_post_nav') ) {
// Show links to next/previous post @todo: $args
function mobilefirst_post_nav( $before = '', $after = '' ) {

	if ( ! is_single() ) {
		return;
	}

	if ( empty($before) ) {
		$before = '<p class="pn post-nav">';
	}
	if ( empty($after) ) {
		$after = '</p>';
	}

	if ( get_next_post() || get_previous_post() ) {
	
		echo $before;
		previous_post_link( '<span class="prev">' . '‹ %link' . '</span>' );
		next_post_link( '<span class="next">' . '%link ›' . '</span>' );
		echo $after;
	
	}

}
} // mobilefirst_post_nav


if ( ! function_exists('mobilefirst_archive_nav') ) {
// Show links to next/previous page @todo: $args
function mobilefirst_archive_nav( $before = '', $after = '', $next = '' ) {

	if ( is_singular() ) {
		return;
	}

	if ( empty($before) ) {
		$before = '<p class="an archive-nav">';
	}
	if ( empty($after) ) {
		$after = '</p>';
	}

	$prev = __('‹ Previous page', 'mobilefirst');
	$next = __('Next page ›', 'mobilefirst');

	if ( is_search() ) {
		$next = __('More results ›', 'mobilefirst');
	}

	if ( get_next_posts_link() || get_previous_posts_link() ) {
	
		echo $before;
		previous_posts_link( $prev );
		next_posts_link( $next );
		echo $after;
	
	}

}
} // mobilefirst_archive_nav


/* Pluggable support hooks */

// Add the html5shiv inline script
function mobilefirst_inline_html5shiv() {
	printf('<!--[if lt IE 9]><script>\'abbr,article,aside,audio,bdi,canvas,data,datalist,details,dialog,figcaption,figure,footer,header,hgroup,main,mark,meter,nav,output,picture,progress,section,summary,template,time,video\'.replace(/\w+/g,function(n){document.createElement(n)})</script><![endif]-->' . "\n");
}

// Conditionally load the respond.js script
function mobilefirst_respondjs() {
	printf( '<!--[if IE 8]><script src="%s/lib/js/min/respond.min.js"></script><![endif]-->' . "\n", get_template_directory_uri() );
}

// Inline script to add a html .js class
function mobilefirst_html_js_class() {
	printf("<script>document.documentElement.className = document.documentElement.className.replace('no-js', 'js');</script>\n");
}

// Use the minified stylesheet
function mobilefirst_minified_stylesheet($stylesheet) {
  return get_stylesheet_directory_uri() . '/style.min.css';
}


