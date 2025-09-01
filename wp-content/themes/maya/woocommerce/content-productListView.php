<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $post;

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

<div class="item-product list-view list-view-desc ">

    <div <?php post_class( $classes ); ?>>
    
        <div class="product-frame">

            <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
        
                
                    <div class="thumb-wrapper col-1-2">
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
                    
                    <div class="col-1-2 product-details padd-25">
                    <div class="product-title fs-clr"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                    <?php
                        /**
                         * woocommerce_after_shop_loop_item_title hook
                         *
                         * @hooked woocommerce_template_loop_rating - 5
                         * @hooked woocommerce_template_loop_price - 10
                         */
                        do_action( 'woocommerce_after_shop_loop_item_title' );
                    ?>
                    <?php echo wp_trim_words(apply_filters( 'woocommerce_short_description', $post->post_excerpt ), 30, '...'); ?>
                    <div class="clear"></div>
                    <a class="btn-woo-more" href="<?php the_permalink(); ?>">Read More &raquo;</a>
                     
                    </div>
        
        
        </div>
    
    </div>

</div>