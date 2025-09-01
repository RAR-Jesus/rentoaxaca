<?php
/**
 * Maya Assets
 *
 * @package WordPress
 * @subpackage Maya
 * 
 */


/* *************** */
/*       CSS       */
/* *************** */


// FRONTEND
add_action( 'wp_enqueue_scripts', 'un_styles' );

function un_styles() {
	   
    /* Theme Styles */
	
	global $wp_styles;

	// Main
	wp_register_style( 'un-main-style',  UN_THEME_URI . 'assets/css/main.css' );
    wp_enqueue_style( 'un-main-style' );
	
	// Plugins
	wp_register_style( 'un-plugins-style',  UN_THEME_URI . 'assets/css/plugins.css' );
    wp_enqueue_style( 'un-plugins-style' );
	
	// Socials (since v1.6)
	wp_register_style( 'un-socials-style',  UN_THEME_URI . 'assets/css/socials.css' );
    wp_enqueue_style( 'un-socials-style' );
	
	// Woocommerce (since v2.0)
	if(un_is_woocommerce()){
		wp_register_style( 'un-woocommerce-style',  UN_THEME_URI . 'assets/css/woocommerce.css' );
		wp_enqueue_style( 'un-woocommerce-style' );
	}
	
	// IE Fixs
	wp_register_style( 'un-ie-style',  UN_THEME_URI . 'assets/css/ie.css' );
    wp_enqueue_style( 'un-ie-style' );
	$wp_styles->add_data( 'un-ie-style', 'conditional', 'IE' );
	
	// Load GFonts
    wp_register_style( 'un-gfonts', UN_THEME_URI . 'assets/css/gfonts.css' );
	wp_enqueue_style( 'un-gfonts' ); 
	
	
	
	// ================ //
	//  CUSTOM STYLES   //
	// ================ //
	
	
	// Custom CSS (Options Field)
	$custom_CSS = un_option('custom_css');
	if(!empty($custom_CSS)) { 
		wp_add_inline_style( 'un-plugins-style', $custom_CSS );
	} 
	
	// Basic Styling Options	
	if(un_option('color1')) {
		$fs_clr = un_option('color1');
	}else{
		$fs_clr = 'rgb(37,116,169)';
	}
	
	if(un_option('color1a')) {
		$fs_alpha = un_option('color1a');
	}else{
		$fs_alpha = 'rgba(37,116,169,0.7)';
	}
	
	if(un_option('color2')) {
		$nd_clr = un_option('color2');
	}else{
		$nd_clr = 'rgb(34,49,63)';
	}
	
	if(un_option('color2a')) {
		$nd_alpha = un_option('color2a');
	}else{
		$nd_alpha = 'rgba(34,49,63,0.7)';
	}
	
	if(un_option('mainfont')) {
		$font_family = un_option('mainfont');
		$font_name = str_replace(' ', '+', $font_family);		
	}else{
		$font_family = 'Lato';
	}
	
		
	// Custom Typography	
	if (un_option('advanced_style') != 1) {
		
		// Basic Styles
		$inline_style = '
		html, body, input, textarea { font-family:\''.$font_family.'\', sans-serif; }
		a, .woocommerce .woocommerce-breadcrumb a, .woocommerce-page .woocommerce-breadcrumb a { color: '.$fs_clr.'; text-decoration: none; }
		a:hover, .woocommerce .woocommerce-breadcrumb a:hover, .woocommerce-page .woocommerce-breadcrumb a:hover { color: '.$nd_clr.'; }
		.fs-clr { color: '.$fs_clr.'; } 
		.fs-clr-hov:hover { color: '.$fs_clr.'; } 
		.bg-fs-clr { background-color: '.$fs_clr.'; }
		.bg-fs-clr-hov:hover { background-color: '.$fs_clr.'; } 
		.bg-fs-alpha { background-color: '.$fs_alpha.'; }
		.brd-fs-clr { border-color: '.$fs_clr.'; }
		.brd-fs-clr-hov:hover { border-color: '.$fs_clr.'; }
		.nd-clr { color: '.$nd_clr.'; } 
		.nd-clr-hov:hover { color: '.$nd_clr.'; } 
		.bg-nd-clr { background-color: '.$nd_clr.'; }
		.bg-nd-clr-hov:hover { background-color: '.$nd_clr.'; }
		.bg-nd-alpha { background-color: '.$nd_alpha.'; }
		.brd-nd-clr { border-color: '.$nd_clr.'; }
		.brd-nd-clr-hov:hover { border-color: '.$fs_clr.'; }
		#jpreBar { background: '.$fs_clr.'; }
		#jprePercentage { border-color: '.$fs_clr.'; color: '.$fs_clr.'; }
		.header-clear .sub-menu li a:hover { color: '.$nd_clr.'; }
		.header-dark .sub-menu li a { background-color: '.$nd_clr.' !important; }
		.header-dark .sub-menu li a:hover {	background-color: '.$fs_clr.' !important; color: #fff; }
		.sticky .main-menu li, .sticky .main-menu li a { color: '.$nd_clr.'; }
		.sticky .main-menu li:hover a {	background-color: '.$nd_clr.'; }
		.sticky .sub-menu li a { background-color: '.$nd_clr.' !important; }
		.sticky #quick-icons li { color: '.$nd_clr.'; }
		.sticky #quick-icons li:hover { border-color: '.$nd_clr.'; }
		.sticky-icons li{ color: '.$nd_clr.' !important; }
		.port-filter li.selected { background-color: '.$fs_clr.'; }
		.team-skills li .bar-val { background: '.$fs_clr.'; }
		#mobile-menu { background-color: '.$nd_clr.'; }
		#mobile-menu li:hover { background: '.$fs_clr.'; }
		#mobile-menu .sub-menu li a { background-color: #fff; color: '.$nd_clr.'; }
		#mobile-menu .sub-menu li a:hover { background: '.$fs_clr.'; color: #fff; }
		#volume { position: absolute; left: 0; bottom: 0; background: '.$nd_clr.'; z-index:9999; color: #fff; padding: 10px; display: block; opacity: 0.2; font-size: 16px; cursor: pointer; }
		#volume:hover { opacity: 1; }
		#internal-video:after { content: \'\'; display: block; width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: '.$fs_alpha.'; }
		blockquote { border-color: '.$fs_clr.';	color: '.$fs_clr.'; }
		h1, h2, h3 { color: '.$fs_clr.'; }
		.ui-tabs .ui-tabs-nav li.ui-tabs-active { background: '.$fs_clr.'; color: #fff; }
		.search-field {	border-color: '.$fs_clr.'; }
		.blog-nav a:hover { color: '.$fs_clr.'; }
		.page-numbers.current {	color: '.$fs_clr.'; }
		.wdg-thumb a { color: '.$fs_clr.'; }
		.wdg-thumb a:hover { color: '.$nd_clr.'; }
		.tagcloud a:hover {	border-color: '.$fs_clr.'; background-color: '.$fs_clr.'; }
		aside .widget-box li a { color: '.$fs_clr.'; }
		.widget-box li a:hover { color: '.$nd_clr.'; }
		.mks_tab_nav_item:hover, .mks_tab_nav_item.active { background-color: '.$fs_clr.'; color: #fff; }
		.mks_tab_nav_item.active,
		.mks_tab_nav_item,
		.mks_tabs.vertical .mks_tab_nav_item,
		.mks_tabs.vertical .mks_tab_nav_item.active,
		.mks_tabs.vertical .mks_tab_nav_item.active,
		.mks_accordion_item,
		.mks_toggle,
		.mks_accordion,
		.mks_toggle,
		.mks_accordion_content,
		.mks_toggle_content,
		.mks_tab_item {	border-color: '.$fs_clr.'; }
		.comment-author, .comment-content { border-color: '.$fs_clr.'; }
		.comment-reply-link:hover { background-color: '.$nd_clr.'; }
		textarea, input[type="text"], 
		input[type="email"], 
		input[type="number"], 
		input[type="tel"], 
		input[type="date"], 
		input[type="url"],
		input[type="search"],
		select { border-color: '.$fs_clr.'; }
		input[type="reset"], input[type="submit"] { background-color: '.$fs_clr.'; }
		input[type="reset"]:hover,
		input[type="submit"]:hover { background-color: '.$nd_clr.'; border-color: '.$nd_clr.'; }
		.ui-slider .ui-slider-range { background: none repeat scroll 0 0 '.$fs_clr.' !important; }
		.price_slider_wrapper .ui-widget-content { background: '.$nd_clr.' !important; }
		.woocommerce nav.woocommerce-pagination { background: '.$fs_clr.'; }
		.woocommerce nav.woocommerce-pagination ul li a:focus, 
		.woocommerce nav.woocommerce-pagination ul li a:hover, 
		.woocommerce nav.woocommerce-pagination ul li span.current { color: '.$fs_clr.'; }
		.list-view a.full-product-desc { background-color: '.$fs_clr.'; }
		.woocommerce span.onsale { background-color: '.$fs_clr.' !important; }
		.woocommerce div.product p.price, .woocommerce div.product span.price { color: '.$fs_clr.' !important; }
		.woocommerce #reviews #comments ol.commentlist li img.avatar { background: '.$fs_clr.' !important; border: 1px solid '.$fs_clr.' !important; }
		.woocommerce #reviews #comments ol.commentlist li .comment-text { border-color: '.$fs_clr.'; }
		.woocommerce form .form-row.woocommerce-validated select { border-color: '.$fs_clr.' !important; }';
		
	}else{
		
		// Advanced Styles
		$inline_style = '
		html, input, textarea { font-family:\''.$font_family.'\', sans-serif; }
		
		body { font-family:\''.un_option('custom_body_font').'\', sans-serif; color: '.un_option('custom_body_color').'; font-size: '.un_option('custom_body_size').'px; font-style: '.un_option('custom_body_style').'; font-weight: '.un_option('custom_body_weight').'; }
		
		.main-menu > li, .main-menu > li a { font-family:\''.un_option('custom_mainmenu_font').'\', sans-serif; font-size: '.un_option('custom_mainmenu_size').'px; font-style: '.un_option('custom_mainmenu_style').'; font-weight: '.un_option('custom_mainmenu_weight').'; }
		
		.sub-menu > li, .sub-menu > li a { font-family:\''.un_option('custom_submenu_font').'\', sans-serif; font-size: '.un_option('custom_submenu_size').'px!important; font-style: '.un_option('custom_submenu_style').'!important; font-weight: '.un_option('custom_submenu_weight').'!important; }
		
		h1 { font-family:\''.un_option('custom_h1_font').'\', sans-serif; color: '.un_option('custom_h1_color').'; font-size: '.un_option('custom_h1_size').'px; font-style: '.un_option('custom_h1_style').'; font-weight: '.un_option('custom_h1_weight').'; }
		
		h2 { font-family:\''.un_option('custom_h2_font').'\', sans-serif; color: '.un_option('custom_h2_color').'; font-size: '.un_option('custom_h2_size').'px; font-style: '.un_option('custom_h2_style').'; font-weight: '.un_option('custom_h2_weight').'; }
		
		h3 { font-family:\''.un_option('custom_h3_font').'\', sans-serif; color: '.un_option('custom_h3_color').'; font-size: '.un_option('custom_h3_size').'px; font-style: '.un_option('custom_h3_style').'; font-weight: '.un_option('custom_h3_weight').'; }
		
		h4 { font-family:\''.un_option('custom_h4_font').'\', sans-serif; color: '.un_option('custom_h4_color').'; font-size: '.un_option('custom_h4_size').'px; font-style: '.un_option('custom_h4_style').'; font-weight: '.un_option('custom_h4_weight').'; }
		
		h5 { font-family:\''.un_option('custom_h5_font').'\', sans-serif; color: '.un_option('custom_h5_color').'; font-size: '.un_option('custom_h5_size').'px; font-style: '.un_option('custom_h5_style').'; font-weight: '.un_option('custom_h5_weight').'; }
		
		h6 { font-family:\''.un_option('custom_h6_font').'\', sans-serif; color: '.un_option('custom_h6_color').'; font-size: '.un_option('custom_h6_size').'px; font-style: '.un_option('custom_h6_style').'; font-weight: '.un_option('custom_h6_weight').'; }
		
		.title-page { font-family:\''.un_option('custom_page_title_font').'\', sans-serif; color: '.un_option('custom_page_title_color').'!important; font-size: '.un_option('custom_page_title_size').'px; font-style: '.un_option('custom_page_title_style').'; font-weight: '.un_option('custom_page_title_weight').'; }
		
		.post-content { font-family:\''.un_option('custom_page_content_font').'\', sans-serif; color: '.un_option('custom_page_content_color').'!important; font-size: '.un_option('custom_page_content_size').'px; font-style: '.un_option('custom_page_content_style').'; font-weight: '.un_option('custom_page_content_weight').'; }
		
		.widgettitle { font-family:\''.un_option('custom_widget_title_font').'\', sans-serif; color: '.un_option('custom_widget_title_color').'!important; font-size: '.un_option('custom_widget_title_size').'px; font-style: '.un_option('custom_widget_title_style').'; font-weight: '.un_option('custom_widget_title_weight').'; }
		
		#footer-copy { font-family:\''.un_option('custom_footer_text_font').'\', sans-serif; color: '.un_option('custom_footer_text_color').'; font-size: '.un_option('custom_footer_text_size').'px; font-style: '.un_option('custom_footer_text_style').'; font-weight: '.un_option('custom_footer_text_weight').'; }
		
		a, .woocommerce .woocommerce-breadcrumb a, .woocommerce-page .woocommerce-breadcrumb a { color: '.$fs_clr.'; text-decoration: none; }
		a:hover, .woocommerce .woocommerce-breadcrumb a:hover, .woocommerce-page .woocommerce-breadcrumb a:hover { color: '.$nd_clr.'; }
		.fs-clr { color: '.$fs_clr.'; } 
		.fs-clr-hov:hover { color: '.$fs_clr.'; } 
		.bg-fs-clr { background-color: '.$fs_clr.'; }
		.bg-fs-clr-hov:hover { background-color: '.$fs_clr.'; } 
		.bg-fs-alpha { background-color: '.$fs_alpha.'; }
		.brd-fs-clr { border-color: '.$fs_clr.'; }
		.brd-fs-clr-hov:hover { border-color: '.$fs_clr.'; }
		.nd-clr { color: '.$nd_clr.'; } 
		.nd-clr-hov:hover { color: '.$nd_clr.'; } 
		.bg-nd-clr { background-color: '.$nd_clr.'; }
		.bg-nd-clr-hov:hover { background-color: '.$nd_clr.'; }
		.bg-nd-alpha { background-color: '.$nd_alpha.'; }
		.brd-nd-clr { border-color: '.$nd_clr.'; }
		.brd-nd-clr-hov:hover { border-color: '.$fs_clr.'; }
		#jpreBar { background: '.$fs_clr.'; }
		#jprePercentage { border-color: '.$fs_clr.'; color: '.$fs_clr.'; }
		.header-clear .sub-menu li a:hover { color: '.$nd_clr.'; }
		.header-dark .sub-menu li a { background-color: '.$nd_clr.' !important; }
		.header-dark .sub-menu li a:hover {	background-color: '.$fs_clr.' !important; color: #fff; }
		.sticky .main-menu li, .sticky .main-menu li a { color: '.$nd_clr.'; }
		.sticky .main-menu li:hover a {	background-color: '.$nd_clr.'; }
		.sticky .sub-menu li a { background-color: '.$nd_clr.' !important; }
		.sticky #quick-icons li { color: '.$nd_clr.'; }
		.sticky #quick-icons li:hover { border-color: '.$nd_clr.'; }
		.sticky-icons li{ color: '.$nd_clr.' !important; }
		.port-filter li.selected { background-color: '.$fs_clr.'; }
		.team-skills li .bar-val { background: '.$fs_clr.'; }
		#mobile-menu { background-color: '.$nd_clr.'; }
		#mobile-menu li:hover { background: '.$fs_clr.'; }
		#mobile-menu .sub-menu li a { background-color: #fff; color: '.$nd_clr.'; }
		#mobile-menu .sub-menu li a:hover { background: '.$fs_clr.'; color: #fff; }
		#volume { position: absolute; left: 0; bottom: 0; background: '.$nd_clr.'; z-index:9999; color: #fff; padding: 10px; display: block; opacity: 0.2; font-size: 16px; cursor: pointer; }
		#volume:hover { opacity: 1; }
		#internal-video:after { content: \'\'; display: block; width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: '.$fs_alpha.'; }
		blockquote { border-color: '.$fs_clr.';	color: '.$fs_clr.'; }
		.ui-tabs .ui-tabs-nav li.ui-tabs-active { background: '.$fs_clr.'; color: #fff; }
		.search-field {	border-color: '.$fs_clr.'; }
		.blog-nav a:hover { color: '.$fs_clr.'; }
		.page-numbers.current {	color: '.$fs_clr.'; }
		.wdg-thumb a { color: '.$fs_clr.'; }
		.wdg-thumb a:hover { color: '.$nd_clr.'; }
		.tagcloud a:hover {	border-color: '.$fs_clr.'; background-color: '.$fs_clr.'; }
		aside .widget-box li a { color: '.$fs_clr.'; }
		.widget-box li a:hover { color: '.$nd_clr.'; }
		.mks_tab_nav_item:hover, .mks_tab_nav_item.active { background-color: '.$fs_clr.'; color: #fff; }
		.mks_tab_nav_item.active,
		.mks_tab_nav_item,
		.mks_tabs.vertical .mks_tab_nav_item,
		.mks_tabs.vertical .mks_tab_nav_item.active,
		.mks_tabs.vertical .mks_tab_nav_item.active,
		.mks_accordion_item,
		.mks_toggle,
		.mks_accordion,
		.mks_toggle,
		.mks_accordion_content,
		.mks_toggle_content,
		.mks_tab_item {	border-color: '.$fs_clr.'; }
		.comment-author, .comment-content { border-color: '.$fs_clr.'; }
		.comment-reply-link:hover { background-color: '.$nd_clr.'; }
		textarea, input[type="text"], 
		input[type="email"], 
		input[type="number"], 
		input[type="tel"], 
		input[type="date"], 
		input[type="url"],
		input[type="search"],
		select { border-color: '.$fs_clr.'; }
		input[type="reset"], input[type="submit"] { background-color: '.$fs_clr.'; }
		input[type="reset"]:hover,
		input[type="submit"]:hover { background-color: '.$nd_clr.'; border-color: '.$nd_clr.'; }
		.ui-slider .ui-slider-range { background: none repeat scroll 0 0 '.$fs_clr.' !important; }
		.price_slider_wrapper .ui-widget-content { background: '.$nd_clr.' !important; }
		.woocommerce nav.woocommerce-pagination { background: '.$fs_clr.'; }
		.woocommerce nav.woocommerce-pagination ul li a:focus, 
		.woocommerce nav.woocommerce-pagination ul li a:hover, 
		.woocommerce nav.woocommerce-pagination ul li span.current { color: '.$fs_clr.'; }
		.list-view a.full-product-desc { background-color: '.$fs_clr.'; }
		.woocommerce span.onsale { background-color: '.$fs_clr.' !important; }
		.woocommerce div.product p.price, .woocommerce div.product span.price { color: '.$fs_clr.' !important; }
		.woocommerce #reviews #comments ol.commentlist li img.avatar { background: '.$fs_clr.' !important; border: 1px solid '.$fs_clr.' !important; }
		.woocommerce #reviews #comments ol.commentlist li .comment-text { border-color: '.$fs_clr.'; }
		.woocommerce form .form-row.woocommerce-validated .select2-container, 
		.woocommerce form .form-row.woocommerce-validated input.input-text, 
		.woocommerce form .form-row.woocommerce-validated select { border-color: '.$fs_clr.' !important; }';
		
	}
	
	wp_add_inline_style( 'un-plugins-style', $inline_style );	
		

}


// BACKEND
add_action( 'admin_enqueue_scripts', 'un_backend_styles' );

function un_backend_styles() {
	
	// Main
	wp_register_style( 'un-main-style',  UN_THEME_URI . 'assets/css/backend.css' );
    wp_enqueue_style( 'un-main-style' );
	
}
 

/* *************** */
/*       JS        */
/* *************** */


// FRONTEND
add_action('wp_enqueue_scripts', 'un_scripts');

function un_scripts() {
	
	// Load WP jQuery if not included
	wp_enqueue_script('jquery'); 
	
	
	// Load WP jQuery UI if not included
	wp_enqueue_script('jquery-ui-core');
	
	
	/* Library Scripts */
	
	// GMAP API
	wp_register_script('un-gmap', 'https://maps.googleapis.com/maps/api/js?v=3.exp', array( 'jquery' ), '', false );
	wp_enqueue_script('un-gmap');
	
	// Plugins
	wp_register_script('un-plugins-script', UN_THEME_URI . 'assets/js/plugins.js', array( 'jquery' ), '', true );
	wp_enqueue_script('un-plugins-script');
	
	// Isotope
	wp_register_script('un-isotope-script', UN_THEME_URI . 'assets/js/isotope.js', array( 'jquery' ), '', true );
	wp_enqueue_script('un-isotope-script');
	
	/* Main Scripts */
	wp_register_script('un-main-script', UN_THEME_URI . 'assets/js/main.js', array( 'jquery' ), '', true );
	wp_enqueue_script('un-main-script');
	 
}


// BACKEND
add_action( 'admin_enqueue_scripts', 'un_backend_scripts', 1 );

function un_backend_scripts() {
	
	wp_register_script( 'un-backend-script',  UN_THEME_URI . 'assets/js/backend.js' );
    wp_enqueue_script( 'un-backend-script' );
	
}
