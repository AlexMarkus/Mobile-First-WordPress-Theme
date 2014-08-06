<?php
// 404 template

get_header(); ?>

<div class="main">
<div class="hfeed">
<?php

do_action('before_feed');

?>

	<article <?php post_class(); ?>>
	
	<header>
	<h1 class="entry-title"><?php _e('Page not found', 'first'); ?></h1>
	</header>
	
	<div class="entry-content">
	<p><?php _e('Sorry, the requested page does not exist or is not available at this time.', 'first'); ?></p>
	</div>
	
	</article>

<?php

do_action('after_feed');

?>
</div><!-- /.hfeed -->

<?php

	get_sidebar();
	do_action('after_copy');

?>

</div><!-- /.main -->

<?php get_footer(); ?>
