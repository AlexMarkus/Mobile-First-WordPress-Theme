<?php
// No content template

?>
	<article <?php post_class(); ?>>
	
	<header>
	<h2 class="et entry-title"><?php // Show a proper page title
		if ( is_404() ) {
		
			_e('Page not found', 'mobilefirst');
		
		} elseif ( is_search() ) {
		
			_e('No results found', 'mobilefirst');
		
		} else {
		
			_e('Nothing to show', 'mobilefirst');
		
		}
	?></h2>
	</header>
	
	<div class="ec entry-content">
	<p><?php
	
		if ( is_404() ) {
		
			_e('Sorry, the requested page does not exist or is not available at this time.', 'mobilefirst');
		
		} elseif ( is_search() ) {
		
			_e('No results have been found to match your search query. Try searching again using different words, or <a href="%s">go back to the homepage</a> and start browsing from there.', 'mobilefirst');
		
		} else {
		
			_e('We don\'t seem to find what you\'re looking for. Maybe searching can help.', 'mobilefirst');
		
		}
	
	?></p>
	</div>
	
	</article>
