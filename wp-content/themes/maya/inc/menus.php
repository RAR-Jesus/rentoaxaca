<?php
/**
 * Maya Menus
 *
 * @package WordPress
 * @subpackage Maya
 * 
 */

// Regiter menu locations
register_nav_menu( 'mainmenu', 'Main Menu' );
register_nav_menu( 'mobilemenu', 'Mobile Menu' ); 

// Main menu
function un_main_menu() {

	$args = array (
		'theme_location'  => 'mainmenu',
		'container'       => '',
		'menu_id'         => 'main-menu',
		'echo'            => true,
		'items_wrap'      => '<ul id="%1$s" class="%1$s">%3$s</ul>',
		'fallback_cb'     => 'un_nav_fallback',
		'depth'           => 0
	);

	wp_nav_menu( $args ); 

}

// Mobile menu
function un_mobile_menu() {

	$args = array (
		'theme_location'  => 'mobilemenu',
		'container'       => '',
		'menu_id'         => 'mobile-menu',
		'echo'            => true,
		'items_wrap'      => '<ul id="%1$s" class="hide">%3$s</ul>',
		'fallback_cb'     => false,
		'depth'           => 3
	);

	wp_nav_menu( $args ); 

}


function un_nav_fallback() {
	
	echo '<a class="no-menu" href="'.admin_url( 'nav-menus.php?action=edit&menu=0' ).'">Add a Menu</a>';
	
}