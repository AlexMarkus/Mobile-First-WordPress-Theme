<?php
// Default post content

?>
	<article <?php post_class(); ?>>
	
	<header>
	<?php the_post_title(); ?>
	<?php the_posted_on(); ?>
	</header>

	<?php the_featured_image(); ?>

	<div class="entry-content">
	<?php
		the_content( __('Read more &rsaquo;', 'first') );
		
		wp_link_pages();
		
		edit_post_link();
	?>
	</div>
	
	<?php the_posted_meta(); ?>
	
	</article>
