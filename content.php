<?php
// Default post content

do_action('before_post');

?>
	<article <?php post_class(); ?>>
	
	<header>
	<?php do_action('the_post_header'); ?>
	</header>

	<?php do_action('before_post_content'); ?>

	<div class="ec entry-content">
	<?php
	if ( ! is_search() ) {
		the_content( __('Read more ›', 'mobilefirst') );
	} else {
		the_excerpt();
	}
		
		wp_link_pages();
		
		if ( is_singular() ) {
			edit_post_link(null, '<p class="el edit-link">', '</p>');
		}
	?>
	</div>
	
	<?php do_action('after_post_content'); ?>
	
	</article>
<?php do_action('after_post'); ?>
