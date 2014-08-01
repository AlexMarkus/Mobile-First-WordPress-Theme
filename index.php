<?php
// Default template file

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="initial-scale=1,user-scalable=yes,minimal-ui">

<title><?php wp_title( __('&rsaquo;', 'first'), true, 'right' ); ?></title>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<a id="top"></a>
<a href="#copy" class="srt skip"><?php _e('Skip to content &rsaquo;', 'first'); ?></a>

<header class="header">

<div class="branding">

	<div class="title"><?php
		printf( '<a href="%s">%s</a>',
			get_home_url(),
			apply_filters('branding_title', get_bloginfo('name', 'display'))
		);
	?></div>

	<div class="description"><span><?php bloginfo('description'); ?></span></div>

	<nav id="nav" class="nav">
	<!--a class="toggle"><?php _e('Navigation', 'first'); ?></a-->
	<?php
		wp_nav_menu( array(
			'theme_location' => 'nav',
			'items_wrap' => '<ul class="%2$s">%3$s</ul>',
			'container' => '',
		) );
	?></nav>

</div>

</header>

<main id="copy" role="main">
<div class="main">
<div class="hfeed">
<?php

do_action('before_feed');

if ( have_posts() ) : // If we've got posts to show

	while ( have_posts() ) : the_post(); // Show the posts
	
?>

	<article <?php post_class(); ?>>
	
	<header>
	<?php // Show the title
		if ( is_singular() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
	?>
	
	<h4 class="entry-meta"><?php // Show the posted on
		
		$author_url     = '<a class="author vcard"><span class="fn">' . get_the_author() . '</span></a>';
		$published_date = '<span class="published">' . get_the_date() . '</span>';
		$updated_date   = sprintf( '<span class="hide modified">' . __(' Updated on %s.', 'first') . '</span>',
			the_modified_date( '', '<span class="updated">', '</span>', false )
		);
		
		printf( __('Posted by %s on %s.', 'first') . $updated_date,
			$author_url,
			$published_date
		)
	?></h4>
	</header>

	<?php
		if ( has_post_thumbnail() ) {
			
			$featured_image = get_the_post_thumbnail();
			
			if ( is_singular() ) {
				printf( '<div class="featured-image">%s</div>', $featured_image );
			} else {
				printf( '<a class="featured-image" href="%s">%s</a>', esc_url( get_permalink() ), $featured_image );
			}
		}
	?>

	<div class="entry-content">
	<?php // Show the content
		the_content();
		
		wp_link_pages();
		
		edit_post_link();
	?>
	</div>
	
	<footer class="entry-footer"><?php
		if ( is_single() ) {
		
			printf( '<span class="categories">' . __('Filled under %s', 'first') . '</span>',
				get_the_category_list( _x(', ', 'category separator', 'first') )
			);
			printf( '<br/><span class="tags">' . __('Tagged %s', 'first') . '</span>',
				get_the_tag_list( '', _x(', ', 'tag separator', 'first'), '' )
			);
			
		} elseif ( is_singular() && get_the_taxonomies() ) {
			the_taxonomies(array(
				'before' => '<p>',
				'after' => '</p>',
			));
		}
	?></footer>
	
	</article>

<?php

	endwhile;

?>

	<div class="post-nav"><?php
		// Show the navigation links
		if ( is_single() ) {
		
			previous_post_link();
			next_post_link();
		
		} else {
		
			posts_nav_link();
		
		}
	?></div>

	<?php
		// Show the comments
		comments_template();
	?>

<?php

else : // No posts found

?>

	<article <?php post_class(); ?>>
	
	<header>
	<h1><?php // Show a proper page title
		if ( is_404() ) {
		
			_e('Page not found', 'first');
		
		} elseif ( is_search() ) {
		
			_e('No results found', 'first');
		
		} else {
		
			_e('Nothing to show', 'first');
		
		}
	?></h1>
	</header>
	
	<div class="entry-content">
	<p><?php
	
		if ( is_404() ) {
		
			_e('Sorry, the requested page does not exist or is not available at this time.', 'first');
		
		} elseif ( is_search() ) {
		
			_e('No results have been found to match your search query. Try searching again using different words, or <a href="%s">go back to the homepage</a> and start browsing from there.', 'first');
		
		} else {
		
			_e('We don\'t seem to find what you\'re looking for. Maybe searching can help.', 'first');
		
		}
	
	?></p>
	</div>
	
	</article>

<?php

endif; // Loop ends

do_action('after_feed');

?>
</div><!-- /.hfeed -->

<?

// Check if the sidebar is not empty and show it
if ( is_active_sidebar('sidebar') ) :

?>
	<aside class="sidebar">
	<?php
		do_action('before_sidebar');
		dynamic_sidebar('sidebar');
		do_action('after_sidebar');
	?>
	</aside>

<?php

endif;

do_action('after_copy');

?>
</div><!-- /.main --><?php do_action('after_main'); ?>
</main>

<footer class="footer">

<div class="colophon"><?php
	echo apply_filters('the_colophon', __('Copyright &copy;. Designed by AlexMarkus. Powered by WordPress.', 'first') );
?></div>

</footer>

<?php wp_footer(); ?>

</body>
</html>