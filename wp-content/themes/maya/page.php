<?php
/**
 * The Page template
 *
 * @package WordPress
 * @subpackage Maya
 *
 */

// Load Header
get_header();

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
	$page_sidebar_id = '';
}

// Page Content Class
switch ($page_layout) {	
	case 'CCC':
	$page_content_id = 'full';
	$page_content_class = 'row';
	break;

	case 'LCC':
	$page_content_id = 'right';
	$page_content_class = 'col-2-3';
	break;

	case 'CCR':
	$page_content_id = 'left';
	$page_content_class = 'col-2-3';
	break;
	
	default:
	$page_content_id = 'full';
	$page_content_class = 'row';
	break;
	
}

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
    
    <div class="post-wrap padd-y-50 boxed">
    
    	<?php if($page_layout == 'LCC') { echo '<aside class="col-1-3"><ul>'; dynamic_sidebar( $page_sidebar_id ); echo '</ul></aside>'; } ?>
                        
        <article id="content-<?php echo $page_content_id; ?>" class="<?php echo $page_content_class; ?>">
        
            <div class="post-content padd-x-25">
    
                <?php the_content(); ?>
                
            </div>
            
        </article>
        
        <?php if($page_layout == 'CCR') { echo '<aside class="col-1-3"><ul>'; dynamic_sidebar( $page_sidebar_id ); echo '</ul></aside>'; } ?>
        
        <div class="clear"></div>
                                            
    </div>
    
    <?php 
	// Display additional Sections
	echo un_page_sections(get_the_ID());
	?>
          
</div>

<?php
// Reset Post Data
wp_reset_postdata();


// Load Footer
get_footer();