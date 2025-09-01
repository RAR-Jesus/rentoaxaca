<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
 
 // EDITED BY UNCOMMONS 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Load Header
get_header( 'shop' );

// Set Post Data
$shop_page_id = get_option( 'woocommerce_shop_page_id' ); 

// Page Meta
$page_meta = vp_metabox( 'un_post_page_meta', '', $shop_page_id );
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

<div id="page" class="page <?php if( isset($page_meta['title']) || $page_meta['title'] == 1 ){ echo 'marg-top-100'; } ?>">

    <?php if(has_post_thumbnail($shop_page_id)) { ?>
    
        <div id="post-image" class="row" style="background-image: url('<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($shop_page_id), 'maya-full', false, '' ); echo $src[0]; ?>');">
        	<?php if( !isset($page_meta['title']) || $page_meta['title'] != 1 ){ ?>
            <div class="header-page padd-y-75">
        
                <div class="header-layer-page padd-y-75 bg-wh-alpha">

                    <div class="title-page padd-x-25 fs-clr"><?php echo get_the_title($shop_page_id); ?></div>
                    <div class="meta-page padd-x-25 fs-clr">
                    <?php
					/**
					 * woocommerce_before_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					do_action( 'woocommerce_before_main_content' );
					?>
					</div>
                    
                    
                </div>
                
            </div>
            <?php } ?>
        
        </div>
    
    <?php }else{ ?>
    	
        <?php if( !isset($page_meta['title']) || $page_meta['title'] != 1 ){ ?> 
    	<div class="header-page marg-top-100 padd-y-75 bg-gr1-clr">
               
    		<div class="title-page padd-x-25 fs-clr"><?php echo get_the_title($shop_page_id); ?></div>
          
    	</div>
        <?php } ?>
    
    <?php } ?>
    
    <div class="post-wrap padd-y-50 boxed">
    
    	<?php if($page_layout == 'LCC') { echo '<aside class="woo-sidebar col-1-3"><ul>'; dynamic_sidebar( $page_sidebar_id ); echo '</ul></aside>'; } ?>
                        
        <article id="content-<?php echo $page_content_id; ?>" class="<?php echo $page_content_class; ?>">

            <div class="post-content padd-x-25">
            	
            	  				
                <?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
				?>
                
                <div class="clear"></div>
                
                <?php if ( have_posts() ) : ?>
                
                <?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<div class="grid-view-loop">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>
				</div>
				<div class="list-view-loop" style="display: none;">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'productListView' ); ?>

					<?php endwhile; // end of the loop. ?>
				</div>
            	

				
				<?php woocommerce_product_loop_end(); ?>
          
                
                <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
    
                <?php wc_get_template( 'loop/no-products-found.php' ); ?>
    
           		<?php endif; ?>
                
                 
                
            </div>
            
            <?php
				/**
				 * woocommerce_after_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );
			?>
            
            
        </article>
        
        <?php if($page_layout == 'CCR') { echo '<aside class="woo-sidebar col-1-3"><ul>'; dynamic_sidebar( $page_sidebar_id ); echo '</ul></aside>'; } ?>
        
        <div class="clear"></div>
                                 
    </div>
    
     <?php
	/**
	 * woocommerce_after_shop_loop hook
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
	?>
    
    <?php 
	// Display additional Sections
	echo un_page_sections($shop_page_id);
	?>

          
</div>

<?php
// Reset Post Data
wp_reset_postdata();


// Load Footer
get_footer('shop');