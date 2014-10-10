<?php
// Default template

get_header(); ?>

<div class="main">
<div class="hfeed">
<?php

do_action('before_posts');

if ( have_posts() ) : // If we've got posts to show

	while ( have_posts() ) : the_post(); // Show the posts
	
		get_template_part('content', get_post_type());
	
	endwhile;

else : // No posts found

	get_template_part('content-none');

endif; // Loop ends

do_action('after_posts');
comments_template();

?>
</div><!-- /.hfeed -->

<?php

	get_sidebar();
	do_action('after_copy');

?>

</div><!-- /.main -->

<?php get_footer(); ?>
