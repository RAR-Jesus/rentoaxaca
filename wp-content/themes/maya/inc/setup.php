<?php
/**
 * Maya Setup
 *
 * @package WordPress
 * @subpackage Maya
 * 
 */

add_action( 'after_setup_theme', 'un_theme_setup' );

// Global theme setup	
function un_theme_setup() {
	
	// Content width setup
	if ( ! isset( $content_width ) ) {
	    $content_width = 1200;
	}
	
	// Language setup
	load_theme_textdomain( UN, UN_THEME_DIR . '/languages' );
	
	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	
	// Enable support for Post Thumbnails, and declare the sizes.
	add_theme_support( 'post-thumbnails' );
		
	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );
	
	// Enable Post Formats
	add_theme_support( 'post-formats', array(
		'video', 'audio', 'gallery',
	) );
	
	// SIZES
	add_image_size( 'maya-full', 1920, 1080, true );
	add_image_size( 'maya-widget', 50, 50, true );
	
	add_filter('widget_text', 'do_shortcode');
	
	// Default Sidebars	
	$un_main_sidebar = array(
	'name'          => __( 'Main', UN ),
	'id'            => 'un-main-sidebar',
	'before_widget' => '<li id="%1$s" class="widget-box marg-25">',
	'after_widget'  => '</li>'
	); 
	
	register_sidebar( $un_main_sidebar );
	
	
	// DYNAMIC SIDEBARS
	$un_sidebars = get_posts(array('post_type' => 'un-sidebars', 'posts_per_page' => -1, 'post_status' => 'publish')); 
	
	foreach ($un_sidebars as $sidebar) {
	
		// Register Sidebar
		register_sidebar( array(
			'name' => $sidebar->post_title,
			'id' => $sidebar->post_name,
			'description' => $sidebar->post_excerpt,
			'before_widget' => '<li id="%1$s" class="widget-box marg-25">',
			'after_widget'  => '</li>'
		) );
	
	}
	
	
	//:::::::::::::::::::::::::::://
	//     WOOCOMMERCE SETUP      //
	//        (since v2.0)        //
	//:::::::::::::::::::::::::::://
	
	// Woocommerce Support
	add_theme_support( 'woocommerce' );
	
	
	// Woocommerce Menu Cart
	add_filter('wp_nav_menu_items','un_woomenucart', 10, 2);
		
	
}


// CART
function un_woomenucart($menu, $args) {

	// Check if WooCommerce is active
	if( un_is_woocommerce() ){
		
		ob_start();
	
		global $woocommerce;
		$viewing_cart = __('View your shopping cart', UN);
		$start_shopping = __('Start shopping', 'uncommon');
		$cart_url = $woocommerce->cart->get_cart_url();
		$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
		$cart_contents_count = $woocommerce->cart->cart_contents_count;
		$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, UN), $cart_contents_count);
		$cart_total = $woocommerce->cart->get_cart_total();
	
		if ($cart_contents_count == 0) {
			$menu_item = '<li class="pull-right"><a class="woo-menu-cart" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
		} else {
			$menu_item = '<li class="pull-right"><a class="woo-menu-cart" href="'. $cart_url .'" title="'. $viewing_cart .'">';
		}
	
		$menu_item .= '<i class="fa fa-shopping-cart"></i> ';
	
		$menu_item .= $cart_contents.' - '. $cart_total;
		$menu_item .= '</a></li>';
	
		echo $menu_item;
			
		$cart = ob_get_clean();
		
		return $menu . $cart;
		
	}else{
		
		return $menu;
		
	}	

}
