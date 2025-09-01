<?php
/**
 * The Page template
 * Template Name: Blog 2
 * @package WordPress
 * @subpackage Maya
 *
 */

// Load Header
get_header();

// Page Data
the_post();

// Page ID
$page_id = get_the_ID();

// Page Meta
$page_meta = vp_metabox( 'un_post_page_meta', '', get_the_ID() );
$page_meta = $page_meta->meta;

?>

<div id="page" class="page">
	
    <?php if(has_post_thumbnail()) { ?>
    
        <div id="post-image" class="row" style="background-image: url('<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'maya-full', false, '' ); echo $src[0]; ?>');">
        	<?php if( !isset($page_meta['title']) || $page_meta['title'] != 1 ){ ?>
            <div class="header-page padd-y-75">
        
                <div class="header-layer-page padd-y-75 bg-wh-alpha">
                
                    <div class="title-page padd-x-25 fs-clr"><?php the_title(); ?></div>
                    
                </div>
                
            </div>
            <?php } ?>
        
        </div>
    
    <?php }else{ ?>
    	
        <?php if( !isset($page_meta['title']) || $page_meta['title'] != 1 ){ ?>
    	<div class="header-page marg-top-100 padd-y-75 bg-gr1-clr">
                
    		<div class="title-page padd-x-25 fs-clr"><?php the_title(); ?></div>
          
    	</div>
        <?php } ?>
    
    <?php } ?>
    
    <?php 
	
	// Blog Query
	$args = array (
		'post_status' => 'publish',
		'pagination' => true,
		'paged' => get_query_var('paged'),
	);
	
	$blog_query = new WP_Query( $args );
	
	?>
    
    <div class="blog-content">
               
        <div class="blog-list row">
        
            <?php if( $blog_query->have_posts() ){ while ( $blog_query->have_posts() ){ $blog_query->the_post(); // Start the Loop ?>  
            
                <div class="blog-row">
                	
                    <?php if ($blog_query->current_post % 2 == 0){ ?>
                    
                    <div class="col-1-2">
                    
                        <div class="blog-box padd-25">
                            
                            <div class="blog-thumb padd-y-75" style="background-image: url('<?php if( has_post_thumbnail() ){ $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'maya-full', false, '' ); echo $src[0]; }else{ echo UN_THEME_URI.'assets/img/default_XL.png'; } ?>');">
                                                            
                                <div class="blog-caption transit">
                                    <div class="blog-more nd-clr"><a href="<?php the_permalink(); ?>"><?php _e('Read More', UN); ?></a></div>
                                    <div class="blog-icon"><?php echo un_format_icon(get_the_ID()); ?></div>
                                    <div class="blog-date marg-bott-25 fs-col"><?php echo get_the_date(); ?></div>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <?php } // Image Sx ?>
            
                    <div class="col-1-2">
                    
                        <div class="blog-box padd-25">
                            
                            <div class="blog-detail marg-y-100">
                            
                                <div class="blog-title padd-x-50 fs-clr">
                                    <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( wp_strip_all_tags( get_the_title() ), $num_words = 5, $more = '...' ); ?></a>
                                </div>
                                                            
                                <div class="blog-meta">
                                    <span class="blog-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span> / 
                                    <span class="blog-cat"><a href="<?php $un_post_categories = get_the_category(); echo get_category_link( $un_post_categories[0]->term_id ); ?>"><?php echo $un_post_categories[0]->cat_name; ?></a></span>
                                </div>
                                
                                <div class="line-center brd-gr2-clr"></div>
                                
                                <div class="blog-exc padd-x-50">
                                     <?php echo wp_trim_words( wp_strip_all_tags( strip_shortcodes(get_the_content()) ), $num_words = 50, $more = '...' ); ?>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <?php if ($blog_query->current_post % 2 == 1){ ?>
                    
                    <div class="col-1-2">
                    
                        <div class="blog-box padd-25">
                            
                            <div class="blog-thumb padd-y-75" style="background-image: url('<?php if( has_post_thumbnail() ){ $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'maya-full', false, '' ); echo $src[0]; }else{ echo UN_THEME_URI.'assets/img/default_XL.png'; } ?>');">
                                                            
                                <div class="blog-caption transit">
                                    <div class="blog-more nd-clr"><a href="<?php the_permalink(); ?>"><?php _e('Read More', UN); ?></a></div>
                                    <div class="blog-icon"><?php echo un_format_icon(get_the_ID()); ?></div>
                                    <div class="blog-date marg-bott-25 fs-col"><?php echo get_the_date(); ?></div>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <?php } // Image Dx ?>
           
                    <div class="clear"></div>
                
                </div>
            
            <?php } } // Close the Loop ?>
                       
            <div class="clear"></div>
            
        </div>
     
   	</div>
    
    <?php un_paging_nav($blog_query); ?>
    <?php echo un_page_sections($page_id); ?>
          
</div>

<?php
// Reset Post Data
wp_reset_postdata();

// Load Footer
get_footer();