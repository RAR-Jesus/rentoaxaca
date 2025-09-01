<?php
/**
 * Maya Header
 *
 * @package WordPress
 * @subpackage Maya
 *
 */
?>

<?php 

// Curtain Option
if(un_option('curtain') === 'allpages'){ 
	$curtain_class = 'curtain';
}elseif(un_option('curtain') === 'onlyhome' && (is_home() || is_front_page())){
	$curtain_class = 'curtain';
}else{
	$curtain_class = '';
}
?>

<!DOCTYPE html> 

<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]--> 
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->

<html <?php language_attributes(); ?>>
<!--<![endif]-->
                         
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0 user-scalable=no">
	
    <?php echo un_meta_seo(); // META SEO ?>	
	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
    <?php 
	$favicon_option = un_option('favicon'); 
	if( !empty($favicon_option) ) { $favicon = wp_get_attachment_url( un_option('favicon') ); }else{ $favicon = UN_THEME_URI.'assets/img/favicon.png'; } 
	?>
    
	<!-- FAVICON -->
    <link rel="shortcut icon" href="<?php echo $favicon; ?>">
  	
    <?php
    // Custom Code
	$custom_header_code = un_kses(un_option('head_code'), true);
	if(!empty($custom_header_code)) { echo $custom_header_code; } 
	?>
    
    <!-- WP HEAD -->
	<?php wp_head(); ?> 

</head>

<body <?php body_class(); ?>>

    
<?php

// Menu type
if(function_exists('is_woocommerce') && is_woocommerce()){ 
	$menu_type_specific = vp_metabox('un_post_page_meta.menu', '', get_option( 'woocommerce_shop_page_id' ));
}else{
	$menu_type_specific = vp_metabox('un_post_page_meta.menu', '', get_the_ID());
}
$menu_type_default = un_option('menu');
$page_no_intro = vp_metabox('un_page_intro_section_meta.type', '', get_the_ID());

if ($menu_type_specific == 'light' ) {
	
	$menu_type = 'header-clear';
	
}else{
	
	if($menu_type_default == 'light' || !$menu_type_default) {
		
		$menu_type = 'header-clear';
		
	}else{
		
		$menu_type = 'header-dark';
		
	}
	
} 



if ($menu_type_specific == 'dark' ) {
	
	$menu_type = 'header-dark';
	
}


if((!is_single() && !is_page()) || $page_no_intro == 'no_intro') {
	
	$menu_type = 'header-dark';
	
}


if( (is_page_template( 'page-home.php' ) || is_page_template( 'page-sections.php' ) ) && $page_no_intro != 'no_intro') {
	
	$menu_type = 'header-clear';
	
}


// Page Intro
$page_intro = vp_metabox( 'un_page_intro_section_meta', '', get_the_ID() );
if($page_intro){
	$page_intro = $page_intro->meta;
}

// Page Sections
$page_sections = vp_metabox( 'un_page_other_section_meta', '', get_the_ID() );
if($page_sections){
	$page_sections = $page_sections->meta;
}

// Logos
if( un_option('logo-light') ){ 
	$logo_light = wp_get_attachment_image_src(un_option('logo-light'), 'maya-full');
	$logo_light = $logo_light[0];
}else{ 
	$logo_light = UN_THEME_URI.'assets/img/logo-white.png'; 
}

if( un_option('logo-dark') ){ 
	$logo_dark = wp_get_attachment_image_src(un_option('logo-dark'), 'maya-full');
	$logo_dark = $logo_dark[0];
}else{ 
	$logo_dark = UN_THEME_URI.'assets/img/logo-dark.png'; 
}

if( un_option('logo-sticky') ){ 
	$logo_sticky = wp_get_attachment_image_src(un_option('logo-sticky'), 'maya-full');
	$logo_sticky = $logo_sticky[0];
}else{ 
	$logo_sticky = UN_THEME_URI.'assets/img/logo-sticky.jpg'; 
}


?>
<header class="transit <?php echo $menu_type; ?>">

    <div id="logo-light" class="logo"><a href="<?php echo get_home_url(); ?>"><img src="<?php echo $logo_light; ?>" alt=""></a></div> 
    <div id="logo-dark" class="logo"><a href="<?php echo get_home_url(); ?>"><img src="<?php echo $logo_dark; ?>" alt=""></a></div>
    <div id="logo-short" class="logo"><a href="<?php echo get_home_url(); ?>"><img class="brd-nd-clr" src="<?php echo $logo_sticky; ?>" alt=""></a></div>

    <!-- MAIN MENU -->
    <div class="wrap-menu">
	<?php un_main_menu(); ?>
    </div>
 	
   
    <div id="quick-icons">
    	
        <?php if(un_option('email') || un_option('follow')){ ?>
            <ul class="info-menu">
            	
                <?php if(un_option('email')){ ?>
                	<li class="un-tooltip" data-title="<?php _e('Get in touch', UN); ?>"><a data-curtain="false" href="mailto:<?php echo un_kses(un_option('email'), false); ?>"><i class="icon-mail"></i></a></li>
                <?php } ?>
                
                <?php if(un_option('follow')){ ?>
                	<li class="un-tooltip" data-title="<?php _e('Follow us', UN); ?>"><a data-curtain="false" target="_blank" href="<?php echo un_kses(un_option('follow'), false); ?>"><i class="icon-heart"></i></a></li>
                <?php } ?>
                
            </ul>
        <?php } ?>
        
        <ul class="switch-menu">
            <li class="open-menu"><i class="icon-menu"></i></li>
        </ul>
        
        <?php if( (is_page_template( 'page-sections.php' ) || is_page_template( 'page-home.php' )) && ($page_intro['onepage'] == 1) ) { ?>
        <ul class="quick-menu">
        	
            <?php 
			foreach($page_sections['section'] as $section) {
				
				if($section['icon'] && $section['icon'] != 'no-icon'){
					echo '<li data-title="'.$section['iconlabel'].'" data-scrollto="#section-'.$section['id'].'"><i class="'.$section['icon'].'"></i></li>';
				}
			
			} ?>
            
        </ul>
        <?php } ?>
        
        <div class="clear"></div>
        
	</div>
   
    
    <div class="clear"></div>
    
</header>

<!-- MOBILE MAIN MENU -->
<?php un_mobile_menu();