<?php
/**
 * The Page Sections
 * Template Name: Homepage
 *
 * @package WordPress
 * @subpackage Maya
 *
 */

// Load Header
get_header();

// Set Post Data
the_post(); 

// Page Intro
$page_intro = vp_metabox( 'un_page_intro_section_meta', '', get_the_ID() );
$page_intro = $page_intro->meta;

// Page Sections
$page_sections = vp_metabox( 'un_page_other_section_meta', '', get_the_ID() );
$page_sections = $page_sections->meta;

// Get Intro Section
switch($page_intro['type']){
	
	case 'intro_slider':
	echo un_section_introslider( $page_intro, $page_sections );
	break;
	
	case 'intro_video':
	echo un_section_introvideo( $page_intro, $page_sections );
	break;
	
	case 'intro_parallax':
	echo un_section_introparallax( $page_intro, $page_sections );
	break;
	
	case 'no_intro':
	echo un_section_nointro( $page_intro );
	break;
	
}

// Get Other Sections
foreach($page_sections['section'] as $section) {
	
	echo un_get_section( $section['id'] );
	
}	


// Reset Post Data
wp_reset_postdata();


// Load Footer
get_footer();