<?php
/**
 * Metaboxes: Only Post Metas
 *
 * @package WordPress
 * @subpackage Maya
 * 
 */


// Metas
$post_format_metas = array(
	'id'          => 'un_post_format_meta',
	'types'       => array('post', 'un-portfolio'),
	'title'       => __('Format Options', UN),
	'priority'    => 'high',
	'template'    => array(
		
		// Audio
		array(
			'type' => 'textarea',
			'name' => 'un_audio',
			'label' => __('SoundCloud', UN),
			'description' => __('Paste the embed iframe from SoundCloud (working on <b>Audio</b> format)', UN),
		),
		
		// Video
		array(
			'type' => 'textarea',
			'name' => 'un_video',
			'label' => __('Video Code', UN),
			'description' => __('Paste the embed code from Youtube or Vimeo (working on <b>Video</b> format)', UN),
		),	
		
		// Gallery
		array(
			'type' => 'group',
			'repeating' => false,
			'length'    => 1,
			'name' => 'un_gallery',
			'title' => __('Gallery (working on <b>Gallery</b> format)', UN),
			'fields' => array(
				
				// Type
				array(
					'type' => 'select',
					'name' => 'un_gallery_type',
					'label' => __('Gallery Type', UN),
					'items' => array(
						array(
							'value' => 'grid',
							'label' => __('Grid Layout', UN),
						),
						array(
							'value' => 'slider',
							'label' => __('Slider Layout', UN),
						),
					),
					'default' => array(
						'grid',
					),
				),
				
				// Images
				array(
					'type' => 'group',
					'repeating' => true,
					'sortable' => true,
					'name' => 'un_gallery_images',
					'title' => __('Image', UN),
					'fields' => array( 
						
						// Image				
						array(
							'type' => 'upload',
							'name' => 'un_gallery_image',
							'label' => __('Upload Image', UN),
							'default' => UN_THEME_URI.'assets/img/default_S.png',
						),	
						
						// Title				
						array(
							'type' => 'textbox',
							'name' => 'un_gallery_title',
							'label' => __('Image Title', UN),
						),	
						
						// Subtitle				
						array(
							'type' => 'textbox',
							'name' => 'un_gallery_subtitle',
							'label' => __('Image Subtitle', UN),
						),	
					),
				),
				
			),
		),
		
	),
);

// Init Metas
new VP_Metabox($post_format_metas);