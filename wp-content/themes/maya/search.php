<?php
/**
 * The Search template
 *
 * @package WordPress
 * @subpackage Maya
 *
 */
 
// Load Header
get_header(); ?>


<div id="page" class="page">

    <div class="header-page marg-top-100 padd-y-75 bg-gr1-clr">
                
    	<div class="title-page padd-x-25 fs-clr"><?php printf( __( 'Search Results for:  # %s', UN ), get_search_query() ); ?></div>
          
    </div>

    <div class="blog-content marg-y-50">
                    
        <div class="boxed">
        	
            <?php if( have_posts() ){ while ( have_posts() ){ the_post(); // Start the Loop ?>  
            
            <div class="col-1-3 transit-top">
                
                <div class="blog-box padd-25">
                        
                    <div class="blog-date marg-bott-25 fs-clr">
                        <a href="<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ); ?>">
                            <span class="meta-info"><?php echo get_the_date(); ?></span>
                        </a>
        			</div>
                    
                    <div class="blog-frame brd-fs-clr">
                            
                        <div class="blog-thumb" style="background-image: url('<?php if( has_post_thumbnail() ){ $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'maya-full', false, '' ); echo $src[0]; }else{ echo UN_THEME_URI.'assets/img/default_XL.png'; } ?>');">
                                                        
                            <div class="blog-caption transit">
                                <div class="blog-more nd-clr"><a href="<?php the_permalink(); ?>"><?php _e('Read More', UN); ?></a></div>
                                <div class="blog-icon"><?php echo un_format_icon(get_the_ID()); ?></div>
                            </div>
                            
                        </div>
                            
                        <div class="blog-detail padd-25">
                        
                            <div class="blog-title fs-clr">
                                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( wp_strip_all_tags( get_the_title() ), $num_words = 5, $more = '...' ); ?></a>
                            </div>
                              
                            <div class="line-center brd-gr2-clr"></div>
                            
                            <div class="blog-exc">
                                <?php echo wp_trim_words( wp_strip_all_tags( strip_shortcodes(get_the_content()) ), $num_words = 15, $more = '...' ); ?>
                            </div>
                            
                        </div>
                        
                    </div>
                            
                </div>
            
            </div>
            
            <?php } } else {
				
				echo '<h4 class="center">'.__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', UN).'</h4>';
				
			} // Close the Loop ?>
                       
            <div class="clear"></div>
            
        </div>
                    
   	</div>
    
    <?php un_paging_nav(); ?>   

</div> 

<?php 

// Reset Data
wp_reset_postdata();                   
       
		                        
// Load Footer
get_footer();