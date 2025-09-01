<?php
/**
 * Sections Post Type
 *
 * @package WordPress
 * @subpackage Maya
 *
 */
 
// Sections Registration
add_action( 'init', 'un_sections_registration' );

function un_sections_registration() {

	$labels = array(
		'name'               => __('Sections', UN),
		'singular_name'      => __('Section', UN),
		'add_new'            => __('Add New', UN),
		'add_new_item'       => __('Add New Section', UN),
		'edit_item'          => __('Edit Section', UN),
		'new_item'           => __('New Section', UN),
		'all_items'          => __('All Sections', UN),
		'view_item'          => __('View Section', UN),
		'search_items'       => __('Search Sections', UN),
		'not_found'          => __('No section found', UN),
		'not_found_in_trash' => __('No sections found in Trash', UN),
		'parent_item_colon'  => '',
		'menu_name'          => __('Sections', UN)
	  );
	
	  $args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => false,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'un-sections' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => UN_THEME_URI.'assets/img/sections.png',
		'supports'           => array( 'title' )
	  );
	
	  register_post_type( 'un-sections', $args ); 

}


// Sections custom messages
add_filter( 'post_updated_messages', 'un_sections_custom_messages' );

function un_sections_custom_messages( $messages ) {
	
  global $post, $post_ID; 

  $messages['un-sections'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Section updated. <a href="%s">View image</a>', UN), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', UN),
    3 => __('Custom field deleted.', UN),
    4 => __('Section updated.', UN),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Section restored to revision from %s', UN), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Section published. <a href="%s">View image</a>', UN), esc_url( get_permalink($post_ID) ) ),
    7 => __('Section saved.', UN),
    8 => sprintf( __('Section submitted. <a target="_blank" href="%s">Preview image</a>', UN), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Section scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview image</a>', UN),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i', UN ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Section draft updated. <a target="_blank" href="%s">Preview image</a>', UN), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
  
}


// Post Type custom column -> Section Type
add_filter('manage_edit-un-sections_columns', 'un_add_type_col');

function un_add_type_col( $columns ) {
	
	$columns['type'] = __('Type', UN);
	return $columns;
	
}

add_action( 'manage_un-sections_posts_custom_column', 'un_add_type_val', 10, 2 );

function un_add_type_val( $column_name, $post_id ) {
	
	if ( 'type' == $column_name ) {
		
		$type = vp_metabox( 'un_sections_meta.type', '', $post_id );
		
		echo $type;
	} 	
	
}