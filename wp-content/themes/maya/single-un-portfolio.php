<?php
/**
 * The Single Portfolio template
 *
 * @package WordPress
 * @subpackage Maya
 *
 */

// Load Header
get_header(); 


// CONTENT 

// Set Post Data
the_post();

// Page Meta
$page_meta = vp_metabox( 'un_post_page_meta', '', get_the_ID() );
$page_meta = $page_meta->meta;
if ($page_meta) {	
	$page_layout = $page_meta['layout'];
	$page_sidebar_id = $page_meta['sidebar'];
}else{
	$page_layout = 'CCC';
}

// Set the count of user views
un_setPostViews( get_the_ID() );

// Page Content Class
switch ($page_layout) {	
	case 'CCC':
	$page_content_id = 'full';
	$page_content_class = 'row';
	break;

	case 'LCC':
	$page_content_id = 'right';
	$page_content_class = 'col-2-3';
	$page_sidebar_id = $page_meta['sidebar'];
	break;

	case 'CCR':
	$page_content_id = 'left';
	$page_content_class = 'col-2-3';
	$page_sidebar_id = $page_meta['sidebar'];
	break;
	
	default:
	$page_content_id = 'full';
	$page_content_class = 'row';
	break;
	
}

?>

<?php 

// Post Category
$post_category = wp_get_post_terms( get_the_ID(), 'un-portfolio-categories' );

if ($post_category) {
	
	$post_category = $post_category[0];
	
	// Post Metas
	$post_meta = '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' )).'">'.get_the_author_meta( 'display_name' ).'</a> / '.get_the_date().' / <a href="'.get_term_link($post_category->term_id, 'un-portfolio-categories').'">'.$post_category->name.'</a>';

}else{
	
	// Post Metas
	$post_meta = '';
	
}



// Post Format
$post_format = get_post_format();
if(!$post_format) { $post_format = 'standard'; }

switch($post_format){
	
	case 'audio':
	$post_media = '';
	
	if( !isset($page_meta['title']) || $page_meta['title'] != 1 ){
		$post_media .= '
		<div class="header-page marg-top-100 padd-y-50 bg-gr1-clr">
            
    	<div class="title-page padd-x-25 fs-clr">'.un_format_icon(get_the_ID()).get_the_title().'</div>
		<div class="meta-page padd-x-25 fs-clr">
                    
			'.$post_meta .'
					
        </div> 
            
    	</div>';
	}
	
	
	$post_media .= '
	<div id="audio-content" class="boxed">
  
	<div class="marg-x-25 marg-top-50">
	
		'.vp_metabox('un_post_format_meta.un_audio').'
	
	</div>
                
    </div>';	
	break;
	
	case 'video':
	$post_media = '';
	
	if( !isset($page_meta['title']) || $page_meta['title'] != 1 ){
		
		$post_media .= '
		<div class="header-page marg-top-100 padd-y-50 bg-gr1-clr">
            
    	<div class="title-page padd-x-25 fs-clr">'.un_format_icon(get_the_ID()).get_the_title().'</div>
		<div class="meta-page padd-x-25 fs-clr">
                    
			'.$post_meta .'
					
        </div> 
            
   		</div>';
		
	}
	
	$post_media .= '
	<div id="audio-content" class="boxed">
      
		<div class="marg-x-25 marg-top-50">
		
			'.vp_metabox('un_post_format_meta.un_video').'
		
		</div>
                
    </div>';
	break;
	
	case 'gallery':	
	$gallery_type = vp_metabox('un_post_format_meta.un_gallery.0.un_gallery_type');
	
	if($gallery_type == 'grid' || !$gallery_type) {
		
		$post_media = '
		<div class="grid-content marg-top-100">
				
			<div class="gallery-list row">';
			
			$post_gallery = vp_metabox('un_post_format_meta.un_gallery.0.un_gallery_images');
			
			foreach($post_gallery as $image) {
				
				$post_media .= '
				<div class="gallery-box col-1-3">
										
					<div class="gallery-thumb" style="background-image: url(\''.wp_get_attachment_url($image['un_gallery_image']).'\');">
																	
						<div class="gallery-caption transit">
							<div class="gallery-icon"><a href="'.wp_get_attachment_url($image['un_gallery_image']).'" rel="attachment" class="lightbox"><i class="icon-zoom-in"></i></a></div>
						</div>
						
					</div>
				
				</div>';
				
			}
		
		$post_media .='<div class="clear"></div>                               
												
			</div>
		
		</div>';
		
		if( !isset($page_meta['title']) || $page_meta['title'] != 1 ){
			
			$post_media .= '
			<div class="header-page padd-y-50 bg-gr1-clr">
				
				<div class="title-page padd-x-25 fs-clr">'.un_format_icon(get_the_ID()).get_the_title().'</div>
				<div class="meta-page padd-x-25 fs-clr">
							
					'.$post_meta .'
							
				</div>           
			
			</div>';
		}
	
	}else{
		
		$post_media = '
		<div id="post-carousel">';
			
			$post_gallery = vp_metabox('un_post_format_meta.un_gallery.0.un_gallery_images');
			
			foreach($post_gallery as $image) {
				
				$post_media .= '
				
				<div class="slide-image" style="background-image: url(\''.wp_get_attachment_url($image['un_gallery_image']).'\');">
					<div class="intro-message">
					
						<div class="intro-title padd-x-50">'.$image['un_gallery_title'].'</div>
						<div class="intro-subtitle marg-x-50 bg-fs-clr">'.$image['un_gallery_subtitle'].'</div>
										   
					</div>
            	</div>';
				
			}
		
		$post_media .='</div>';
		
		if( !isset($page_meta['title']) || $page_meta['title'] != 1 ){
			
			$post_media .= '
			<div class="header-page padd-y-50 bg-gr1-clr">
				
				<div class="title-page padd-x-25 fs-clr">'.un_format_icon(get_the_ID()).get_the_title().'</div>
				<div class="meta-page padd-x-25 fs-clr">
							
					'.$post_meta .'
							
				</div>           
			
			</div>';
		}
		
	}
	
	break;
	
	default:
	if( has_post_thumbnail() ){ 
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'maya-full', false, '' ); $src = $src[0]; 
	}else{ 
		$src = UN_THEME_URI.'assets/img/default_XL.png'; 
	}
	
	$post_media = '
	<div id="post-image" class="row" style="background-image: url(\''.$src.'\');">';
    	
		if( !isset($page_meta['title']) || $page_meta['title'] != 1 ){
			
			$post_media .= '
			<div class="header-page padd-y-50">
		
				<div class="header-layer-page padd-y-75 bg-wh-alpha">
				
					<div class="title-page padd-x-25 fs-clr">'.un_format_icon(get_the_ID()).get_the_title().'</div>
					
					<div class="meta-page padd-x-25 fs-clr">
						
						'.$post_meta .'
						
					</div>
					
				</div>
				
			</div>';
			
		}
    
   $post_media .= ' </div>';
	break;
	
}
?>

<div id="page" class="page">

    <?php echo $post_media; ?>
    
    <div class="post-wrap padd-y-50 boxed">
    
    	<?php if($page_layout == 'LCC') { echo '<aside class="col-1-3"><ul>'; dynamic_sidebar( $page_sidebar_id ); echo '</ul></aside>'; } ?>
                        
        <article id="content-<?php echo $page_content_id; ?>" class="<?php echo $page_content_class; ?>">
        
            <div class="post-content padd-x-25">
    
                <?php the_content(); ?>          
                
            </div>
            
           <?php comments_template(); // Comment Template ?>  
            
        </article>
        
        <?php if($page_layout == 'CCR') { echo '<aside class="col-1-3"><ul>'; dynamic_sidebar( $page_sidebar_id ); echo '</ul></aside>'; } ?>
        
        <div class="clear"></div>
                                            
    </div>
  
</div>

<div class="blog-nav bg-fs-clr padd-25">
    
    <ul>
    
        <?php previous_post_link('<li class="blog-prev fs-clr-hov">%link</li>', '<i class="icon-arrow-left"></i>', false); ?>
        
        <?php if($post_category){ ?>
        <li class="blog-home brd-wh-clr wh-clr bg-wh-clr-hov fs-clr-hov">
            <a href="<?php echo get_term_link($post_category->term_id, 'un-portfolio-categories'); ?>"><i class="icon-menu"></i></a>
        </li>
        <?php } ?>
        
        <?php next_post_link('<li class="blog-next fs-clr-hov">%link</li>', '<i class="icon-arrow-right"></i>', false); ?>
    
    </ul>
    
</div>

<?php 
// Display additional Sections
echo un_page_sections(get_the_ID());
?>


<?php
// Reset Post Data
wp_reset_postdata();


// Load Footer
get_footer();