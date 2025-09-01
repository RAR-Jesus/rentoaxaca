<?php
/**
 * Metaboxes: Page Sections Metas
 *
 * @package WordPress
 * @subpackage Maya
 * 
 */
 
// Functions

VP_Security::instance()->whitelist_function('un_is_intro_slider');

function un_is_intro_slider($value){
	
	if($value === 'intro_slider') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_intro_video');

function un_is_intro_video($value){
	
	if($value === 'intro_video') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_intro_parallax');

function un_is_intro_parallax($value){
	
	if($value === 'intro_parallax') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_no_intro');

function un_is_no_intro($value){
	
	if($value === 'no_intro') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_isnt_no_intro');

function un_isnt_no_intro($value){
	
	if($value === 'no_intro') {
		return false;
	}else{
		return true;
	}
		
}

// Intro Section Metas
$page_intro_section_metas = array(
	'id'          => 'un_page_intro_section_meta',
	'types'       => array('page'),
	'title'       => __('Intro Section Options', UN),
	'priority'    => 'high',
	'template'    => array(
	
		// Intro Section
		array(
			'type' => 'select',
			'name' => 'type',
			'label' => __('Intro Section', UN),
			'description' => __('Choose your preferred Intro Section for your page', UN),
			'items' => array(
			
				array(
					'value' => 'intro_slider',
					'label' => __('Slider', UN),
				),
				array(
					'value' => 'intro_video',
					'label' => __('Video', UN),
				),
				array(
					'value' => 'intro_parallax',
					'label' => __('Parallax Image', UN),
				),
				array(
					'value' => 'no_intro',
					'label' => __('No Intro', UN),
				),					
				
			),
			'default' => array(
				'intro_slider',
			),
		),
		
		// Onepage Navigation
		array(
			'type' => 'toggle',
			'name' => 'onepage',
			'label' => __('Enable Onepage Navigation', UN),
			'default' => '1',
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_isnt_no_intro',
			),
		),
		
		// Dotted Overlay
		array(
			'type' => 'toggle',
			'name' => 'dotted',
			'label' => __('Enable Dotted Pattern', UN),
			'default' => '1',
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_isnt_no_intro',
			),
		),
		
		// Bottom Arrow
		array(
			'type' => 'toggle',
			'name' => 'bottonarrow',
			'label' => __('Enable Bottom Arrow', UN),
			'default' => '1',
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_isnt_no_intro',
			),
		),
		
		
		// INTRO SLIDER //
		
		// Slides
		array(
			'type' => 'group',
			'repeating' => true,
			'name' => 'slide',
			'title' => __('Slide', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_intro_slider',
			),
			'fields' => array(
				
				// Image
				array(
					'type' => 'upload',
					'name' => 'image',
					'label' => __('Image', UN),
				),
				
				// Title
				array(
					'type' => 'textbox',
					'name' => 'title',
					'label' => __('Title', UN),
				),
				
				// SubTitle
				array(
					'type' => 'textbox',
					'name' => 'subtitle',
					'label' => __('Subtitle', UN),
				),				
			),
		),	
		
		
		// INTRO VIDEO //
		
		// Youtube URL
		array(
			'type' => 'textbox',
			'name' => 'url',
			'label' => __('Youtube URL', UN),
			'description' => __('You can use the video id too', UN),
			'dependency' => array(
					'field' => 'type',
					'function' => 'un_is_intro_video',
			),
		),
		
		// Mute
		array(
			'type' => 'toggle',
			'name' => 'mute',
			'label' => __('Start video on Mute', UN),
			'default' => '1',
			'dependency' => array(
					'field' => 'type',
					'function' => 'un_is_intro_video',
			),
		),			
		
		// Controls
		array(
			'type' => 'toggle',
			'name' => 'controls',
			'label' => __('Enable Video Controls', UN),
			'default' => '1',
			'dependency' => array(
					'field' => 'type',
					'function' => 'un_is_intro_video',
			),
		),	
		
		// Autoplay
		array(
			'type' => 'toggle',
			'name' => 'autoplay',
			'label' => __('Autoplay', UN),
			'default' => '1',
			'dependency' => array(
					'field' => 'type',
					'function' => 'un_is_intro_video',
			),
		),
		
		// Start At
		array(
			'type' => 'slider',
			'name' => 'startat',
			'label' => __('Start Video at', UN),
			'description' => __('Set the seconds the video should start at', UN),
			'min' => '0',
			'max' => '5000',
			'step' => '1',
			'default' => '0',
			'dependency' => array(
					'field' => 'type',
					'function' => 'un_is_intro_video',
			),
		),	
		
		
		// INTRO PARALLAX //
		
		// Image
		array(
			'type' => 'upload',
			'name' => 'image',
			'label' => __('Image', UN),
			'dependency' => array(
					'field' => 'type',
					'function' => 'un_is_intro_parallax',
			),
		),
		
		// Title
		array(
			'type' => 'textbox',
			'name' => 'title',
			'label' => __('Title', UN),
			'dependency' => array(
					'field' => 'type',
					'function' => 'un_is_intro_parallax',
			),
		),
		
		// SubTitle
		array(
			'type' => 'textbox',
			'name' => 'subtitle',
			'label' => __('Subtitle', UN),
			'dependency' => array(
					'field' => 'type',
					'function' => 'un_is_intro_parallax',
			),
		),			
		
		
		// NO INTRO //
		
		// Custom HTML
		array(
			'type' => 'textarea',
			'name' => 'nointro_custom',
			'label' => __('Custom HTML', UN),
			'description' => __('Add your custom html for you intro or leave blank to disable thie feature', UN),
			'dependency' => array(
					'field' => 'type',
					'function' => 'un_is_no_intro',
			),
		),
		
		
	),
);


// Other Sections Metas
$page_other_sections_metas = array(
	'id'          => 'un_page_other_section_meta',
	'types'       => array('page'),
	'title'       => __('Sections Options', UN),
	'priority'    => 'high',
	'template'    => array(
		
		// Notice
		array(
			'type' => 'notebox',
			'name' => 'desc',
			'label' => __('Manage the page Sections', UN),
			'description' => __('Add your sections after the intro and order them using Drag & Drop.', UN),
			'status' => 'info',
		),
		
		// Add Section
		array(
			'type' => 'group',
			'repeating' => true,
			'name' => 'section',
			'title' => __('Section', UN),
			'sortable' => true,
			'fields' => array(
				
				// Section ID
				array(
					'type' => 'select',
					'name' => 'id',
					'label' => __('Choose the Section', UN),
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
				
				// Section Icon
				array(
					'type' => 'fontawesome',
					'name' => 'icon',
					'label' => __('Choose the Icon', UN),
					'description' => __('This icon will be used for the onepage navigation feature', UN),
					'default' => array(
						'{{first}}',
					),
				),
				
				// Icon Label
				array(
					'type' => 'textbox',
					'name' => 'iconlabel',
					'label' => __('Icon Label', UN),
					'description' => __('This label will appear as a tooltip on the icon', UN),
				),				
			),
		),	
	),
);

// Intro Metas
new VP_Metabox($page_intro_section_metas);

// Sections Metas
new VP_Metabox($page_other_sections_metas);