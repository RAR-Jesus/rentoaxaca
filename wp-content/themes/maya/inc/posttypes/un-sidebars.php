<?php
/**
 * Sidebars Post Type
 *
 * @package WordPress
 * @subpackage Maya
 *
 */
 
// Services Registration
add_action( 'init', 'un_sidebars_registration' );

function un_sidebars_registration() {

	$labels = array(
		'name'               => __('Sidebars', UN),
		'singular_name'      => __('Sidebar', UN),
		'add_new'            => __('Add New', UN),
		'add_new_item'       => __('Add New Sidebar', UN),
		'edit_item'          => __('Edit Sidebar', UN),
		'new_item'           => __('New Sidebar', UN),
		'all_items'          => __('All Sidebars', UN),
		'view_item'          => __('View Sidebar', UN),
		'search_items'       => __('Search Sidebars', UN),
		'not_found'          => __('No sidebar found', UN),
		'not_found_in_trash' => __('No sidebar found in Trash', UN),
		'parent_item_colon'  => '',
		'menu_name'          => __('Sidebars', UN)
	  );
	
	  $args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => false,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'un-sidebars' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => UN_THEME_URI.'assets/img/sidebars.png',
		'supports'           => array( 'title', 'excerpt' )
	  );
	
	  register_post_type( 'un-sidebars', $args ); 

}


// Sidebars custom messages
add_filter( 'post_updated_messages', 'un_sidebars_custom_messages' );

function un_sidebars_custom_messages( $messages ) {
	
  global $post, $post_ID;

  $messages['un-sidebars'] = array(
    0 => '',
    1 => sprintf( __('Sidebar updated. <a href="%s">View image</a>', UN), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', UN),
    3 => __('Custom field deleted.', UN),
    4 => __('Sidebar updated.', UN),
    5 => isset($_GET['revision']) ? __('Sidebar restored to revision from %s', UN) : false,
    6 => __('Sidebar published.', UN),
    7 => __('Sidebar saved.', UN),
    8 => __('Sidebar submitted.', UN),
    9 => __('Sidebar scheduled.', UN),
  );

  return $messages;
  
} 
