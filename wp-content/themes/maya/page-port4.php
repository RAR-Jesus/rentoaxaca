<?php
/**
 * The Page template
 * Template Name: Portfolio 4
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
$page_title = get_the_title();

// Page Meta
$page_meta = vp_metabox( 'un_post_page_meta', '', get_the_ID() );
$page_meta = $page_meta->meta;

// Portfolio Meta
$port_meta = vp_metabox( 'un_page_portfolio_meta', '', get_the_ID() );
$port_meta = $port_meta->meta;
if(!empty($port_meta['limit']) && $port_meta['limit'] != '0') { $port_limit = $port_meta['limit']; }else{ $port_limit = '-1'; }

?>

<div id="portfolio" class="page">
	
    <?php if( !isset($page_meta['title']) || $page_meta['title'] != 1 ){ ?>
    <div class="header-page padd-y-75 marg-top-100 bg-gr1-clr">
        
        <div class="title-page padd-x-25 fs-clr"><?php echo $page_title; ?></div>
        
    </div>
    <?php } ?>
    	
    <?php 
	
	// Projetcs Query
	if ( empty($port_meta['category_filter']) || in_array('all', $port_meta['category_filter']) ) {
	
		$args = array (
			'post_type'              => 'un-portfolio',
			'post_status'            => 'publish',
			'pagination'             => false,
			'posts_per_page'         => $port_limit,
		);
		
		$port_query = new WP_Query( $args );
		
	}else{
		
		$args = array (
			'post_type'              => 'un-portfolio',
			'post_status'            => 'publish',
			'pagination'             => false,
			'posts_per_page'         => $port_limit,
			'tax_query' => array(
				array(
					'taxonomy' => 'un-portfolio-categories',
					'field' => 'id',
					'terms' => $port_meta['category_filter'],
				),
			),
		);
		
		$port_query = new WP_Query( $args );
		
	}
	
	?>
    
   <div class="grid-content">
               
   		<div class="port-list row">
  
            <?php if( $port_query->have_posts() ){ while ( $port_query->have_posts() ){ $port_query->the_post(); // Start the Loop ?>  
            
                <div class="col-1-2 transit-top">
                    <div class="port-item vector" style="background-image: url('<?php if( has_post_thumbnail() ){ $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'maya-full', false, '' ); echo $src[0]; }else{ echo UN_THEME_URI.'assets/img/default_XL.png'; } ?>');">
                        <div class="port-caption transit">
                            <div class="port-title marg-top-75 marg-left-25 marg-right-25">
                            	<a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( wp_strip_all_tags( get_the_title() ), $num_words = 5, $more = '...' ); ?></a>
                            </div>
                            <div class="line-center brd-gr2-clr"></div>
                            <div class="port-icon"><?php echo un_format_icon(get_the_ID()); ?></div>
                        </div>
                    </div>
                </div>
            
            <?php } } // Close the Loop ?>
                       
            <div class="clear"></div>
            
        </div>
                            
   	</div>
    
    <div class="clear"></div>
 
    <?php echo un_page_sections($page_id); ?>
          
</div>

<?php
// Reset Post Data
wp_reset_postdata();

// Load Footer
get_footer();