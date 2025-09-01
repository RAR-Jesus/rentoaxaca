<?php
/**
 * Portfolio Post Type
 *
 * @package WordPress
 * @subpackage Maya
 *
 */
 
// Portfolio Registration
add_action( 'init', 'un_portfolio_registration' );

function un_portfolio_registration() {

	$labels = array(
		'name'               => __('Projects', UN),
		'singular_name'      => __('Project', UN),
		'add_new'            => __('Add New', UN),
		'add_new_item'       => __('Add New Project', UN),
		'edit_item'          => __('Edit Project', UN),
		'new_item'           => __('New Project', UN),
		'all_items'          => __('All Projects', UN),
		'view_item'          => __('View Project', UN),
		'search_items'       => __('Search Projects', UN),
		'not_found'          => __('No projects found', UN),
		'not_found_in_trash' => __('No projects found in Trash', UN),
		'parent_item_colon'  => '',
		'menu_name'          => __('Portfolio', UN)
	  );
	
	  $args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'un-portfolio' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => UN_THEME_URI.'assets/img/portfolio.png',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'post-formats' )
	  );
	
	  register_post_type( 'un-portfolio', $args );

}

// Portfolio Taxonomy Registration
add_action( 'init', 'un_portfolio_taxonomy_registration', 0 );

function un_portfolio_taxonomy_registration() {
	
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => __( 'Portfolio Categories', UN),
		'singular_name'     => __( 'Portfolio Category', UN),
		'search_items'      => __( 'Search Portfolio Categories', UN),
		'all_items'         => __( 'All Portfolio Categories', UN),
		'parent_item'       => __( 'Parent Portfolio Category', UN),
		'parent_item_colon' => __( 'Parent Portfolio Category:', UN),
		'edit_item'         => __( 'Edit Portfolio Category', UN),
		'update_item'       => __( 'Update Portfolio Category', UN),
		'add_new_item'      => __( 'Add New Portfolio Category', UN),
		'new_item_name'     => __( 'New Portfolio Category Name', UN),
		'menu_name'         => __( 'Portfolio Categories', UN),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'un-portfolio-category' ),
	);

	register_taxonomy( 'un-portfolio-categories', array( 'un-portfolio' ), $args );
	
}


// Portfolio custom messages
add_filter( 'post_updated_messages', 'un_portfolio_custom_messages' );

function un_portfolio_custom_messages( $messages ) {
	
  global $post, $post_ID;

  $messages['un-portfolio'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Project updated. <a href="%s">View project</a>', UN), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', UN),
    3 => __('Custom field deleted.', UN),
    4 => __('Project updated.', UN),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Project restored to revision from %s', UN), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Project published. <a href="%s">View project</a>', UN), esc_url( get_permalink($post_ID) ) ),
    7 => __('Project saved.', UN),
    8 => sprintf( __('Project submitted. <a target="_blank" href="%s">Preview project</a>', UN), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>', UN),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i', UN ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Project draft updated. <a target="_blank" href="%s">Preview project</a>', UN), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
  
}
