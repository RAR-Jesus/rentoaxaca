<?php
/**
 * Metaboxes: Page Contact Metas
 *
 * @package WordPress
 * @subpackage Maya
 * 
 */
 

// Contact Metas
$page_contact_metas = array(
	'id'          => 'un_page_contact_meta',
	'types'       => array('page'),
	'title'       => __('Contact Options', UN),
	'priority'    => 'high',
	'template'    => array(
				
		// Map Coordinates
		array(
		'type' => 'textbox',
		'name' => 'lat',
		'label' => __('Map Latitude', UN),
		'description' => __('You can use a live service like this: <a href="http://itouchmap.com/latlong.html" target="_blank">http://itouchmap.com/latlong.html</a>', UN),
		),
		array(
		'type' => 'textbox',
		'name' => 'lng',
		'label' => __('Map Longitude', UN),
		'description' => __('You can use a live service like this: <a href="http://itouchmap.com/latlong.html" target="_blank">http://itouchmap.com/latlong.html</a>', UN),
		),
		
		// Map Zoom
		array(
		'type' => 'slider',
		'name' => 'zoom',
		'label' => __('Map Zoom', UN),
		'min' => '1',
		'max' => '21',
		'step' => '1',
		'default' => '13',
		),
		
		// Map Color
		array(
		'type' => 'color',
		'name' => 'color',
		'label' => __('Map Color', UN),
		),
		
		// Markers
		array(
			'type' => 'group',
			'repeating' => true,
			'name' => 'marker',
			'title' => __('Marker', UN),
			'fields' => array(
			
				// Marker Coordinates
				array(
				'type' => 'textbox',
				'name' => 'lat',
				'label' => __('Marker Latitude', UN),
				'description' => __('You can use a live service like this: <a href="http://itouchmap.com/latlong.html" target="_blank">http://itouchmap.com/latlong.html</a>', UN),
				),
				array(
				'type' => 'textbox',
				'name' => 'lng',
				'label' => __('Marker Longitude', UN),
				'description' => __('You can use a live service like this: <a href="http://itouchmap.com/latlong.html" target="_blank">http://itouchmap.com/latlong.html</a>', UN),
				),
				
				// Marker Content
				array(
				'type' => 'textarea',
				'name' => 'content',
				'label' => __('Marker Content', UN),
				'description' => __('HTML allowed', UN),
				),	
			),
		),
		
		// CF7
		array(
		'type' => 'select',
		'name' => 'cf7',
		'label' => __('CF7 Form', UN),
		'description' => __('Select the CF7\'s form (to use this feature you need to install <a href="https://wordpress.org/plugins/contact-form-7/" target="_blank">CF7</a> and create your form).', UN),
		'items' => array(
			'data' => array(
				array(
				'source' => 'function',
				'value' => 'un_cf7_list',
				),
			),
		),
		'default' => '',
		),
		
		// Content
		array(
		'type' => 'textarea',
		'name' => 'content',
		'label' => __('Side Content', UN),
		'description' => __('HTML allowed', UN),
		),
		
	),
);

// Contact Metas
new VP_Metabox($page_contact_metas);