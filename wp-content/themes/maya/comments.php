<?php
/**
 * The Comments template
 *
 * @package WordPress
 * @subpackage Maya
 *
 */
?>


<?php if ( have_comments() ) { // have_comments() ?>

<div class="line-center gr2-clr"></div>

<div id="comments" class="post-comments padd-x-25">
	
    <h3>
		<?php echo '#'.get_comments_number().' '.__('Comments', UN );?>
	</h3>

	<ul class="list-comments marg-y-50">
		<?php
			wp_list_comments( array(
				'walker'            => new UN_Comment_Walker(), // Customize the list
				'style'             => 'ul',
				'type'              => 'all',
				'reply_text'        => __('Reply', UN),
				'avatar_size'       => 50,
				'format'            => 'html5',
        		'echo'     => true 
			) );
		?>
	</ul>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Check for comment navigation ?>
    
        <nav class="navigation comment-navigation" role="navigation">
            <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', UN ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', UN ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', UN ) ); ?></div>
        </nav>
    
	<?php } ?>

	<?php if ( ! comments_open() && get_comments_number() ) { ?>
		<p class="no-comments"><?php _e( 'Comments are closed.' , UN ); ?></p>
	<?php } ?>

</div>
<?php } ?>

<div class="form-comment padd-x-25">
<?php comment_form(); ?>
</div>

