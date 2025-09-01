<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Canyon Themes
 * @subpackage Better Health
 */
$hide_top_title=better_health_get_option( 'better_health_hide_top_title_single_option');
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
			      if(has_post_thumbnail()) {
			?> 
			 <div class="feature-image">
			    <?php the_post_thumbnail( 'full' ); ?>
			 </div>

			 <?php } ?> 

			<div class="textcont">
			<?php
              if( $hide_top_title == "hide-top-tile")
              {
            ?>	<h3><?php the_title(); ?></h3>
			  <?php 
			  }
			  	the_content();
			 	wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:','better-health'),
					'after'  => '</div>',
				) );

			 if ( get_edit_post_link() ) : ?>
					<footer class="entry-footer">
						<?php
							edit_post_link(
								sprintf(
									/* translators: %s: Name of current post */
									esc_html__( 'Edit %s','better-health'),
									the_title( '<span class="screen-reader-text">"', '"</span>', false )
								),
								'<span class="edit-link">',
								'</span>'
							);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
			</div>
</div><!-- #post-## -->