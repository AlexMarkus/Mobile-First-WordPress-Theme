<?php

// Check if we have anything to show
if ( post_password_required() ) {
	return;
}

?>

<div id="comments" class="comments">
<?php

if ( have_comments() ) : // Show the comments

?>

	<h3 class="comments-title"><?php
		printf(
			_n( 'One response to %2$s', '%1$s responses to %2$s', get_comments_number(), 'mobilefirst' ),
			number_format_i18n( get_comments_number() ),
			'<em>' . get_the_title() . '</em>' 
		);
	?></h3>

	<div class="comment-list"><ul><?php
		wp_list_comments( array(
			'style'       => 'ul',
			'short_ping'  => true,
			'avatar_size' => 64,
		) );
	?></ul></div>

	<?php
		if ( get_comment_pages_count() > 1 && get_option('page_comments') ) :
	?>
	
	<nav class="nav comment-nav" role="navigation">
		<div class="nav-previous"><?php previous_comments_link( __( '‹ Older comments', 'mobilefirst' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer comments ›', 'mobilefirst' ) ); ?></div>
	</nav><!-- /.comment-nav -->

	<?php
		endif;
	?>

<?php

	if ( ! comments_open() ) : // Show a message if comments are closed

?>

	<p class="no-comments"><?php _e( 'Comments are closed.', 'mobilefirst' ); ?></p>

<?php

	endif;

endif;

$comment_form_args = array();
comment_form( apply_filters('the_comment_form_args', $comment_form_args) );

?>
</div><!-- /#comments -->