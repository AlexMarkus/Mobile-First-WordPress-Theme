<?php
// 404 template

get_header(); ?>

<div class="main">
<div class="hfeed">
<?php

do_action('before_posts');

?>

	<article <?php post_class(); ?>>
	
	<header>
	<h1 class="et entry-title"><?php _e('Page not found', 'mobilefirst'); ?></h1>
	</header>
	
	<div class="ec entry-content">
	<p><?php _e('Sorry, the requested page does not exist or is not available at this time.', 'mobilefirst'); ?></p>
	</div>
	
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
