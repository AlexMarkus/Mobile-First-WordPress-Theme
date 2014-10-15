<?php
// 404 template

get_header(); ?>

<div class="main">
<div class="hfeed">
<?php

do_action('before_posts');

?>

	<article class="hentry error-404">
	
	<header>
	<h1 class="et entry-title"><?php echo apply_filters('the_title', __('Page not found', 'mobilefirst')); ?></h1>
	</header>
	
	<div class="ec entry-content"><?php

		echo apply_filters('the_content', __('Sorry, the requested page does not exist or is not available at this time.', 'mobilefirst'));
	?></div>
	
	</article>

<?php

do_action('after_posts');

?>
</div><!-- /.hfeed -->

<?php

	do_action('after_copy');

?>

</div><!-- /.main -->

<?php get_footer(); ?>
