<?php
/**
 * The Contact Page template
 * Template Name: Page Contact
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

// Contact Data
$data = vp_metabox( 'un_page_contact_meta', '', get_the_ID() );
$data = $data->meta;

$map_coord = array($data['lat'], $data['lng']);


?>

<div id="contacts" class="page">
	
    <div class="map-content marg-top-100">
    
    	<div class="row">
        
            <?php echo '<div data-address="'.esc_attr($data['address']).'" data-zoom="'.$data['zoom'].'" data-color="'.$data['color'].'" data-saturation="-50" class="gmap" id="gmap" data-lat="'.$map_coord[0].'" data-lng="'.$map_coord[1].'"></div>'; ?>
            
            <div id="gmap_markers">';
        	
            <?php
			
			// Markers
            foreach($data['marker'] as $marker) {
            	
				$mark_coord = array($marker['lat'], $marker['lng']);
				
                echo '<div class="marker-wrap" data-markericon=\''.UN_THEME_URI.'assets/img/marker.png\' data-mark-address=\''.esc_attr($marker['address']).'\' data-lat=\''.$mark_coord[0].'\' data-lng=\''.$mark_coord[1].'\'><div class="mark-wrapper">'.$marker['content'].'</div></div>';			
            
            }
            
            ?>
        
            </div>
        
        </div>
        
    </div>
    
    <div class="header-section padd-y-75 bg-gr1-clr">
            
            <?php if( !isset($page_meta['title']) || $page_meta['title'] != 1 ){ ?>
            <div class="title-section padd-x-25 fs-clr"><?php the_title(); ?></div>
            <?php } ?>
            <div class="subtitle-section padd-x-25"><?php the_content(); ?></div>
            
    </div>
    
    <div class="form-content padd-top-50 padd-bott-25">
    
        <div class="boxed">
            
            <div class="col-2-3">
                <div class="form-box marg-25 transit-bottom">
                <?php
                if (!empty($data['cf7'])){
                    echo do_shortcode('[contact-form-7 id="'.$data['cf7'].'"]'); 
                }else{
                   _e('Select a CF7\'s Form in the section options', UN);
                } ?>
                </div>
            </div>
            
            <div class="col-1-3">
                <div class="contact-content transit-top">
                	<div class="contact-message padd-25"><?php echo $data['content']; ?></div>    
                </div>
            </div>
            
            <div class="clear"></div>   
              
                                    
        </div>
        
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