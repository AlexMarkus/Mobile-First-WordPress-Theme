<?php
// Main sidebar

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