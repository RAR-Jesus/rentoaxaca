<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

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
	
<div id="page" class="page">

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
    	
        <?php if($page_layout == 'LCC') { echo '<aside class="woo-sidebar col-1-3 padd-bott-50"><ul>'; dynamic_sidebar( $page_sidebar_id ); echo '</ul></aside>'; } ?>

        <?php while ( have_posts() ) : the_post(); ?>

            
			 
        <article id="content-<?php echo $page_content_id; ?>" class="<?php echo $page_content_class; ?>">
            <div class="post-content padd-x-25">
                <div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    
                    <?php
                        /**
                         * woocommerce_before_single_product_summary hook
                         *
                         * @hooked woocommerce_show_product_sale_flash - 10
                         * @hooked woocommerce_show_product_images - 20
                         */
                        do_action( 'woocommerce_before_single_product_summary' );
                    ?>
                    
                    <div class="summary entry-summary">
    
                        <?php
                            /**
                             * woocommerce_single_product_summary hook
                             *
                             * @hooked woocommerce_template_single_title - 5
                             * @hooked woocommerce_template_single_rating - 10
                             * @hooked woocommerce_template_single_price - 10
                             * @hooked woocommerce_template_single_excerpt - 20
                             * @hooked woocommerce_template_single_add_to_cart - 30
                             * @hooked woocommerce_template_single_meta - 40
                             * @hooked woocommerce_template_single_sharing - 50
                             */
                            do_action( 'woocommerce_single_product_summary' );
                        ?>
    
                    </div><!-- .summary -->
    
                    <?php
                        /**
                         * woocommerce_after_single_product_summary hook
                         *
                         * @hooked woocommerce_output_product_data_tabs - 10
                         * @hooked woocommerce_upsell_display - 15
                         * @hooked woocommerce_output_related_products - 20
                         */
                        do_action( 'woocommerce_after_single_product_summary' );
                    ?>
    
                    <meta itemprop="url" content="<?php the_permalink(); ?>" />
    
                </div><!-- #product-<?php the_ID(); ?> -->
    
                <?php do_action( 'woocommerce_after_single_product' ); ?>
            </div>
    	</article>

            

        <?php endwhile; // end of the loop. ?>

        <?php
            /**
             * woocommerce_after_main_content hook
             *
             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
             */
            do_action( 'woocommerce_after_main_content' );
        ?>
        
        <?php if($page_layout == 'CCR') { echo '<aside class="woo-sidebar col-1-3 padd-bott-50"><ul>'; dynamic_sidebar( $page_sidebar_id ); echo '</ul></aside>'; } ?>
        
        <div class="clear"></div>
    </div>
    
    <?php 
	// Display additional Sections
	echo un_page_sections($shop_page_id);
	?>
    
</div>

<?php get_footer( 'shop' ); ?>