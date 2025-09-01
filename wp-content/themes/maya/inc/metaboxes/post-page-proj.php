<?php
/**
 * Metaboxes: Post & Page Metas
 *
 * @package WordPress
 * @subpackage Maya
 * 
 */

// Functions
VP_Security::instance()->whitelist_function('un_meta_sidebar_list');

function un_meta_sidebar_list(){
	
	global $wp_registered_sidebars; 
	
	$result = array();
	foreach ($wp_registered_sidebars as $sidebar)
	{
		$result[] = array('value' => $sidebar['id'], 'label' => $sidebar['name']);
	}
	return $result;	
	
}

VP_Security::instance()->whitelist_function('un_meta_sections_list');

function un_meta_sections_list(){
	
	$args = array(
		'orderby'          => 'title',
		'order'            => 'ASC',
		'post_type'        => 'un-sections',
		'post_status'      => 'publish',
		'posts_per_page'   => -1,
	);
	
	$sections = get_posts( $args );

	$result = array();
	foreach ($sections as $section)
	{
		$result[] = array('value' => $section->ID, 'label' => $section->post_title);
	}
	return $result;
	
}


// Metas
$post_page_metas = array(
	'id'          => 'un_post_page_meta',
	'types'       => array('post', 'page', 'un-portfolio'),
	'title'       => __('Page Options', UN),
	'priority'    => 'high',
	'template'    => array(
	
		// Title Display
		array(
			'type' => 'toggle',
			'name' => 'title',
			'label' => __('Disable Page Header', UN),
			'default' => '0',
		),
		
		// Layout
		array(
			'type' => 'radioimage',
			'name' => 'layout',
			'label' => __('Layout', UN),
			'description' => __('Choose the layout for this page.', UN),
			'item_max_height' => '90',
			'item_max_width' => '90',
			'validation' => 'minselected[1]|maxselected[1]',
			'items' => array(
				array(
				'value' => 'CCR',
				'label' => __('Right Sidebar', UN),
				'img' => UN_THEME_URI.'assets/img/vs_CCR.png',
				),
				array(
				'value' => 'LCC',
				'label' => __('Left Sidebar', UN),
				'img' => UN_THEME_URI.'assets/img/vs_LCC.png',
				),
				array(
				'value' => 'CCC',
				'label' => __('Full Content', UN),
				'img' => UN_THEME_URI.'assets/img/vs_CCC.png',
				), 
			),
			'default' => array(
				'CCC',
			),
		),	
		
		// Sidebar
		array(
			'type' => 'select',
			'name' => 'sidebar',
			'label' => __('Select Sidebar', UN),
			'description' => __('Select the sidebar you want in this page (doesn\'t work with full content layout).', UN),
			'items' => array(
				'data' => array(
					array(
					'source' => 'function',
					'value' => 'un_meta_sidebar_list',
					),
				),
			),
		),
		
		// Menu Type
		array(
			'type' => 'select',
			'name' => 'menu',
			'label' => __('Menu Type', UN),
			'items' => array(
				array(
				'value' => 'light',
				'label' => __('Light Menu', UN),
				),
				array(
				'value' => 'dark',
				'label' => __('Dark Menu', UN),
				),
			),
			'default' => array(
				'light',
			),
		),
		
		// Add Section
		array(
			'type' => 'sorter',
			'name' => 'sections',
			'label' => __('Add Sections', UN),
			'description' => __('Select the sections you want to add to the end of page and sort them.', UN),
			'items' => array(
				'data' => array(
					array(
					'source' => 'function',
					'value' => 'un_meta_sections_list',
					),
				),
			),			
		),
		
	),
);



// Init Metas
new VP_Metabox($post_page_metas);