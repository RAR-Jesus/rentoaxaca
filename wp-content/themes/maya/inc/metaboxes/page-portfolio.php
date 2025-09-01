<?php
/**
 * Metaboxes: Page Portfolio Metas
 *
 * @package WordPress
 * @subpackage Maya
 * 
 */
 

// Portfolio Metas
$page_portfolio_metas = array(
	'id'          => 'un_page_portfolio_meta',
	'types'       => array('page'),
	'title'       => __('Portfolio Options', UN),
	'priority'    => 'high',
	'template'    => array(
				
		// Filter by Cats
		array(
			'type' => 'multiselect',
			'name' => 'category_filter',
			'label' => __('Categories', UN),
			'description' => __('Filter your projects by Category', UN),
			'items' => array(
				array(
					'value' => 'all', 
					'label' => __('All Categories', UN),
				),
				'data' => array(
					array(
					'source' => 'function',
					'value' => 'un_get_proj_categories',
					),
				),
			),
			'default' => array(
				'{{first}}',
			),
		),
		
		// Limit
		array(
		'type' => 'slider',
		'name' => 'limit',
		'label' => __('Items Limit', UN),
		'description' => __('Leave to 0 if you want to show all your projects', UN),
		'min' => '0',
		'max' => '100',
		'step' => '1',
		'default' => '6',
		),
		
	),
);

// Portfolio Metas
new VP_Metabox($page_portfolio_metas);