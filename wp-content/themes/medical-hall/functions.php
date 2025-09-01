<?php
/**
* Medical Hall functions and definitions.
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
*
* @package Medical Hall

* Child theme Functions file
*
* @link http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme 
*
* Function to dequeue child theme style from parent theme.
* Medical Hall
* Since 1.0.0
*/
function medical_hall_style_dequeue() {
  wp_dequeue_style('better-health-style');
}
add_action( 'wp_print_styles', 'medical_hall_style_dequeue', 100 );

/*
* Enqueue parent style, bootstrap, fonts and child style
* Medical Hall
* Since 1.0.0
*/
function medical_hall_enqueue_styles() {    
    wp_enqueue_style('better-health-googleapis', '//fonts.googleapis.com/css?family=Rubik:300,400,500,700,900', array(), null);
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    wp_enqueue_style( 'better-health-parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'medical-hall-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('better-health-parent-style')
    );
}
add_action( 'wp_enqueue_scripts', 'medical_hall_enqueue_styles' );


/*
* Function to remove some section from customizer panel
* Medical Hall
* Since 1.0.0
*/
function medical_hall_remove_customize_section() {     
	global $wp_customize;
	$wp_customize->remove_section( 'better_health_primary_color_option' );
	$wp_customize->remove_section( 'better_health_reset_option' );  
	} 
add_action( 'customize_register', 'medical_hall_remove_customize_section', 11 );