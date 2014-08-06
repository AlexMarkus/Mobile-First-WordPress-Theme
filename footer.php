<?php
// Theme footer

do_action('after_main'); ?>
</main>

<footer class="footer">

<div class="colophon">

	<div class="copy"><?php
		echo apply_filters('the_colophon', __('Designed by AlexMarkus. Powered by WordPress.', 'first') );
	?></div>

</div>

</footer>

<?php wp_footer(); ?>

</body>
</html>