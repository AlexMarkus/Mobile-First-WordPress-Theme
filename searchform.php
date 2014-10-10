<?php
// Searchform template
?>

<form method="get" class="searchform" action="<?php echo home_url( '/' ); ?>" role="search">
	<p><label for="s"><span class="label"><?php _ex( 'Search for:', 'search form label', 'mobilefirst' ); ?></span></label>
		<input id="s" type="text" value="<?php echo get_search_query(); ?>" name="s" class="input" placeholder="<?php echo esc_attr( _ex('search this website', 'search field placeholder', 'mobilefirst') ); ?>" title="<?php echo esc_attr( _ex( 'Type something and press enter to start searching', 'search field hint', 'mobilefirst' ) ); ?>" />
	</p>
	<p><input type="submit" class="submit" value="<?php echo esc_attr( _ex( 'Search', 'search button text', 'mobilefirst' ) ); ?>" /></p>
</form><!-- .searchform -->