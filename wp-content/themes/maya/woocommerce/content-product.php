<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $post;

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
	$item_col_class = 'col-1-3';
	break;

	case 'LCC':
	$item_col_class = 'col-1-2';
	break;

	case 'CCR':
	$item_col_class = 'col-1-2';
	break;
	
	default:
	$item_col_class = 'col-1-3';
	break;
	
}

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
	
	$classes[] = 'product-box';
	$classes[] = 'padd-25';
	
?>

<div class="item-product <?php echo $item_col_class; ?> grid-view-desc">

	<div <?php post_class( $classes ); ?>>
	
    	<div class="product-frame">

			<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
        
                
            		<div class="thumb-wrapper">
                    <?php
                        /**
                         * woocommerce_before_shop_loop_item_title hook
                         *
                         * @hooked woocommerce_show_product_loop_sale_flash - 10
                         * @hooked woocommerce_template_loop_product_thumbnail - 10
                         */
                        do_action( 'woocommerce_before_shop_loop_item_title' );
                    ?>
                    	<a href="<?php the_permalink(); ?>" class="product-caption transit">
							<?php
                                /**
                                 * woocommerce_after_shop_loop_item_title hook
                                 *
                                 * @hooked woocommerce_template_loop_rating - 5
                                 * @hooked woocommerce_template_loop_price - 10
                                 */
                                do_action( 'woocommerce_after_shop_loop_item_title' );
                            ?>
                    	</a>
                        
                        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                    </div>
            		
                    <div class="product-detail padd-25">
                    <div class="product-title fs-clr"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>

                    </div>
        
    	
        </div>
    
    </div>

</div>
