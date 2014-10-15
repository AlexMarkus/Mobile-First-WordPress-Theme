<?php
// No content template

do_action('before_post');

?>
	<article class="hentry no-posts">
	
	<header>
	<h2 class="et entry-title"><?php // Show a proper page title
		if ( is_404() ) {
		
			$page_title = __('Page not found', 'mobilefirst');
		
		} elseif ( is_search() ) {
		
			$page_title = __('No results found', 'mobilefirst');
		
		} else {
		
			$page_title = __('Nothing to show', 'mobilefirst');
		
		}

		echo apply_filters('the_title', $page_title);

	?></h2>
	</header>
	
	<div class="ec entry-content"><?php
	
		if ( is_404() ) {
		
			$page_content = __('Sorry, the requested page does not exist or is not available at this time.', 'mobilefirst');
		
		} elseif ( is_search() ) {
		
			$page_content = sprintf( __('No results have been found to match your search query. Try searching again using different words, or <a href="%s">go back to the homepage</a> and start browsing from there.', 'mobilefirst'),
				get_home_url()
			);
		
		} else {
		
			$page_content = __('We don\'t seem to find what you\'re looking for. Maybe searching can help.', 'mobilefirst');
		
		}

		echo apply_filters('the_content', $page_content);
	
	?></div>
	
	</article>
	<?php do_action('after_post'); ?>
