<?php
/**
 * Metaboxes: Sections
 *
 * @package WordPress
 * @subpackage Maya
 * 
 */


// Functions

VP_Security::instance()->whitelist_function('un_is_blog_1');

function un_is_blog_1($value){
	
	if($value === 'blog_1') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_blog_2');

function un_is_blog_2($value){
	
	if($value === 'blog_2') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_blog_3');

function un_is_blog_3($value){
	
	if($value === 'blog_3') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_callout');

function un_is_callout($value){
	
	if($value === 'callout') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_clients');

function un_is_clients($value){
	
	if($value === 'clients') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_counters');

function un_is_counters($value){
	
	if($value === 'counters') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_features');

function un_is_features($value){
	
	if($value === 'features') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_form');

function un_is_form($value){
	
	if($value === 'form') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_custom');

function un_is_custom($value){
	
	if($value === 'custom') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_map');

function un_is_map($value){
	
	if($value === 'map') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_overview');

function un_is_overview($value){
	
	if($value === 'overview') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_playground');

function un_is_playground($value){
	
	if($value === 'playground') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_portfolio');

function un_is_portfolio($value){
	
	if($value === 'portfolio') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_get_proj_categories');

function un_get_proj_categories() {
	
	$wp_cat = get_categories(array('type' => 'un-portfolio', 'taxonomy' => 'un-portfolio-categories', 'hide_empty' => 0 ));

	$result = array();
	foreach ($wp_cat as $cat)
	{
		$result[] = array('value' => $cat->cat_ID, 'label' => $cat->name);
	}
	return $result;
	
}

VP_Security::instance()->whitelist_function('un_is_team');

function un_is_team($value){
	
	if($value === 'team') {
		return true;
	}else{
		return false;
	}
		
}


VP_Security::instance()->whitelist_function('un_is_testimonials');

function un_is_testimonials($value){
	
	if($value === 'testimonials') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_services_1');

function un_is_services_1($value){
	
	if($value === 'services_1') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_services_2');

function un_is_services_2($value){
	
	if($value === 'services_2') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_widgets');

function un_is_widgets($value){
	
	if($value === 'widgets') {
		return true;
	}else{
		return false;
	}
		
}

VP_Security::instance()->whitelist_function('un_is_not_callout_blog1');

function un_is_not_callout_blog1($value){
	
	if($value === 'callout' || $value === 'blog_1') {
		return false;
	}else{
		return true;
	}
		
}


VP_Security::instance()->whitelist_function('un_meta_map_preview');

function un_meta_map_preview($value){
	$address = $value;
	$address = str_replace(' ', '+', $address);
							
	$search = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false'); 
	$json = json_decode($search, true);
	
	if(isset($json['results'][0])){	
		
		return '<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;q='.$address.'&amp;ie=UTF8&amp;t=m&amp;iwloc=A&amp;output=embed&amp;dg=oo"></iframe>';

	}else{
		
		return '
		<div class="vp-field vp-notebox vp-meta-single note-error">
			<i class="fa fa-times-circle"></i>
			<div class="label">'.__('Address Search', UN).'</div>
			<div class="description"><p>'.__('The address you searched for is not found in Google Map! Try to edit your search keyword.', UN).'</p>
			</div>
		</div>';
		
	}
	
}


VP_Security::instance()->whitelist_function('un_cf7_list');

function un_cf7_list(){	

$args = array(
  'post_type' => 'wpcf7_contact_form',
  'post_status' => 'publish',
  'posts_per_page' => -1
);

$forms = get_posts($args);

$result = array();

foreach ($forms as $form){
	
	$result[] = array('value' => $form->ID, 'label' => $form->post_title);
	
}

return $result;
	
}



// Metas
$sections_metas = array(
	'id'          => 'un_sections_meta',
	'types'       => array('un-sections'),
	'title'       => __('Options', UN),
	'priority'    => 'high',
	'template'    => array(
		
		// Type
		array(
			'type' => 'select',
			'name' => 'type',
			'label' => __('Type', UN),
			'description' => __('Choose your preferred Section among many types', UN),
			'items' => array(
			
				array(
					'value' => 'blog_1',
					'label' => __('Blog 1', UN),
				),
				array(
					'value' => 'blog_2',
					'label' => __('Blog 2', UN),
				),
				array(
					'value' => 'blog_3',
					'label' => __('Blog 3', UN),
				),
				array(
					'value' => 'callout',
					'label' => __('Callout', UN),
				),
				array(
					'value' => 'clients',
					'label' => __('Clients', UN),
				),
				array(
					'value' => 'form',
					'label' => __('Contact Form', UN),
				),
				array(
					'value' => 'counters',
					'label' => __('Counters', UN),
				),				
				array(
					'value' => 'custom',
					'label' => __('Custom HTML', UN),
				),				
				array(
					'value' => 'features',
					'label' => __('Features', UN),
				),
				array(
					'value' => 'map',
					'label' => __('Map', UN),
				),
				array(
					'value' => 'overview',
					'label' => __('Overview', UN),
				),
				/* Removed for instability
				array(
					'value' => 'playground',
					'label' => __('Playground', UN),
				),*/
				array(
					'value' => 'portfolio',
					'label' => __('Portfolio', UN),
				),
				array(
					'value' => 'services_1',
					'label' => __('Services 1', UN),
				),
				array(
					'value' => 'services_2',
					'label' => __('Services 2', UN),
				),
				array(
					'value' => 'team',
					'label' => __('Team', UN),
				),
				array(
					'value' => 'testimonials',
					'label' => __('Testimonials', UN),
				),
				array(
					'value' => 'widgets',
					'label' => __('Widgets', UN),
				),
							
				
			),
			'default' => array(
				'blog_1',
			),
		),
		
		// Title 
		array(
			'type' => 'textbox',
			'name' => 'title',
			'label' => __('Title', UN),
			'description' => __('Leave blank to disable the section header'),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_not_callout_blog1',
			),
		),
		
		// Title color
		array(
			'type' => 'color',
			'name' => 'title_color',
			'label' => __('Title Color', UN),
			'default' => 'rgb(85,85,85)',
			'format' => 'rgb',
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_not_callout_blog1',
			),
		),
		
		// Subtitle
		array(
			'type' => 'textarea',
			'name' => 'subtitle',
			'label' => __('Subtitle', UN),
			'description' => __('HTML allowed'),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_not_callout_blog1',
			),
		),
		
		// Subtitle color
		array(
			'type' => 'color',
			'name' => 'subtitle_color',
			'label' => __('Subtitle Color', UN),
			'default' => 'rgb(85,85,85)',
			'format' => 'rgb',
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_not_callout_blog1',
			),
		),
		
		// BG Color
		array(
			'type' => 'color',
			'name' => 'bg_color',
			'label' => __('Background Color', UN),
			'default' => 'rgba(255,255,255,1)',
			'format' => 'rgba',
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_not_callout_blog1',
			),
		),
		
		
		// Blog 1		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'blog_1',
			'title' => __('Blog 1 Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_blog_1',
			),
			'fields' => array(
			
				// Title
				array(
				'type' => 'textbox',
				'name' => 'title',
				'label' => __('Blog Title', UN),
				),
					
				// Bg Image
				array(
				'type' => 'upload',
				'name' => 'bg_image',
				'label' => __('Background Image', UN),
				),
				
				// Limit
				array(
				'type' => 'slider',
				'name' => 'limit',
				'label' => __('Items Limit', UN),
				'description' => __('Leave to 0 if you want to show all your posts', UN),
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '9',
				),

				
			),
		),
		
		
		// Blog 2		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'blog_2',
			'title' => __('Blog 2 Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_blog_2',
			),
			'fields' => array(
				
				// Limit
				array(
				'type' => 'slider',
				'name' => 'limit',
				'label' => __('Items Limit', UN),
				'description' => __('Leave to 0 if you want to show all your posts', UN),
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '3',
				),

				
			),
		),
		
		
		// Blog 3		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'blog_3',
			'title' => __('Blog 3 Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_blog_3',
			),
			'fields' => array(
	
				// Bg Image
				array(
				'type' => 'upload',
				'name' => 'bg_image',
				'label' => __('Background Image', UN),
				),
				
				// Limit
				array(
				'type' => 'slider',
				'name' => 'limit',
				'label' => __('Items Limit', UN),
				'description' => __('Leave to 0 if you want to show all your posts', UN),
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '6',
				),

				
			),
		),
		
		
		// Callout		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'callout',
			'title' => __('Callout Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_callout',
			),
			'fields' => array(
				
				// Title
				array(
				'type' => 'textbox',
				'name' => 'title',
				'label' => __('Callout Title', UN),
				),
				
				// Excerpt
				array(
				'type' => 'textarea',
				'name' => 'excerpt',
				'label' => __('Callout Excerpt', UN),
				'description' => __('HTML allowed', UN),
				),
				
			),
		),
		
		
		// Clients		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'clients',
			'title' => __('Clients Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_clients',
			),
			'fields' => array(
				
				// Client
				array(
					'type' => 'group',
					'repeating' => true,
					'name' => 'client',
					'title' => __('Client', UN),
					'fields' => array(
						
						// Logo
						array(
						'type' => 'upload',
						'name' => 'logo',
						'label' => __('Logo', UN),
						),
						
						// Url
						array(
						'type' => 'textbox',
						'name' => 'url',
						'label' => __('URL', UN),
						),
						
					),
				),				
			),
		),
		
		
		// Counters		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'counters',
			'title' => __('Counters Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_counters',
			),
			'fields' => array(
				
				// Bg Image
				array(
				'type' => 'upload',
				'name' => 'bg_image',
				'label' => __('Background Image', UN),
				),	
				
				// Overlayer color
				array(
					'type' => 'select',
					'name' => 'overlayer',
					'label' => __('Overlayer style', UN),
					'items' => array(
						array(
						'value' => 'bg-wh-alpha',
						'label' => __('Light', UN),
						),
						array(
						'value' => 'bg-fs-alpha',
						'label' => __('Your primary custom color', UN),
						),						
					),
					'default' => array(
					'value_3',
					),
				),	
				
				// Counter
				array(
					'type' => 'group',
					'repeating' => true,
					'name' => 'counter',
					'title' => __('Counter', UN),
					'fields' => array(
						
						// Icon
						array(
						'type' => 'fontawesome',
						'name' => 'icon',
						'label' => __('Icon', UN),
						'description' => __('Select a icon from the included package ', UN),
						),
						
						// From
						array(
						'type' => 'slider',
						'name' => 'from',
						'label' => __('Start the count from', UN),
						'min' => '0',
						'max' => '10000',
						'step' => '1',
						'default' => '0',
						),
						
						// To
						array(
						'type' => 'slider',
						'name' => 'to',
						'label' => __('End the count to', UN),
						'min' => '0',
						'max' => '10000',
						'step' => '1',
						'default' => '1000',
						),
						
						// Label
						array(
						'type' => 'textbox',
						'name' => 'label',
						'label' => __('Counter Label', UN),
						),
						
					),
				),				
			),
		),
		
		
		// Features		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'features',
			'title' => __('Features Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_features',
			),
			'fields' => array(
				
				// Feature
				array(
					'type' => 'group',
					'repeating' => true,
					'name' => 'feature',
					'title' => __('Feature', UN),
					'fields' => array(
						
						// Icon
						array(
						'type' => 'fontawesome',
						'name' => 'icon',
						'label' => __('Icon', UN),
						'description' => __('Select a icon from the included package ', UN),
						),
						
						// Feature Title
						array(
						'type' => 'textbox',
						'name' => 'title',
						'label' => __('Feature Title', UN),
						),
						
						// Feature Excerpt
						array(
						'type' => 'textarea',
						'name' => 'excerpt',
						'label' => __('Feature Excerpt', UN),
						'description' => __('HTML allowed', UN),
						),
						
						// Feature URL
						array(
						'type' => 'textbox',
						'name' => 'url',
						'label' => __('Feature URL', UN),
						'description' => __('Leave blank to disable the link', UN),
						'validation' => 'url'
						),
						
					),
				),				
			),
		),
		
		
		// Contact Form		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'form',
			'title' => __('Contact Form Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_form',
			),
			'fields' => array(
					
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
		),
		
		
		// Custom HTML		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'custom',
			'title' => __('Custom HTML Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_custom',
			),
			'fields' => array(
			
				// Background Image
				array(
				'type' => 'upload',
				'name' => 'bg_image',
				'label' => __('Background Image', UN),
				'description' => __('Leave it blank to disable Image BG', UN),
				),
				
				// Background Parallax
				array(
				'type' => 'toggle',
				'name' => 'bg_parallax',
				'label' => __('Parallax', UN),
				'default' => '1',
				'description' => __('It is working only if you attach an image in the previous field', UN),
				),
				
				// Background Color
				array(
				'type' => 'color',
				'name' => 'bg_color',
				'label' => __('Background Color', UN),
				'default' => 'rgba(255,255,255,1)',
				'format' => 'rgba',
				),
				
				// Background Width
				array(
				'type' => 'select',
				'name' => 'bg_width', 
				'label' => __('Background Width', UN),
				'items' => array(
					array(
					'value' => 'full',
					'label' => __('Fullwidth', UN),
					),
					array(
					'value' => 'boxed',
					'label' => __('Boxed', UN),
					),
				),
				'default' => array(
					'boxed',
					),
				),
				
				// Background Overlay
				array(
				'type' => 'color',
				'name' => 'bg_overlay',
				'label' => __('Background Overlay', UN),
				'description' => __('Leave it blank to disable the overlay', UN),
				'default' => 'rgba(255,255,255,0.8)',
				'format' => 'rgba',
				),
				
				// Content Width
				array(
				'type' => 'select',
				'name' => 'content_width', 
				'label' => __('Content Width', UN),
				'items' => array(
					array(
					'value' => 'full',
					'label' => __('Fullwidth', UN),
					),
					array(
					'value' => 'boxed',
					'label' => __('Boxed', UN),
					),
				),
				'default' => array(
					'boxed',
					),
				),
				
				// Top Padding
				array(
				'type' => 'slider',
				'name' => 'padding_top',
				'label' => __('Top Padding', UN),
				'min' => '0',
				'max' => '500',
				'step' => '1',
				'default' => '25',
				),
				
				// Bottom Padding
				array(
				'type' => 'slider',
				'name' => 'padding_bottom',
				'label' => __('Bottom Padding', UN),
				'min' => '0',
				'max' => '500',
				'step' => '1',
				'default' => '25',
				),
				
				// Left Padding
				array(
				'type' => 'slider',
				'name' => 'padding_left',
				'label' => __('Left Padding', UN),
				'min' => '0',
				'max' => '500',
				'step' => '1',
				'default' => '25',
				),
				
				// Right Padding
				array(
				'type' => 'slider',
				'name' => 'padding_right',
				'label' => __('Right Padding', UN),
				'min' => '0',
				'max' => '500',
				'step' => '1',
				'default' => '25',
				),
										
				// Content
				array(
				'type' => 'textarea',
				'name' => 'content',
				'label' => __('HTML Content', UN),
				),
				
			),
		),
		
		
		// Map		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'map',
			'title' => __('Map Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_map',
			),
			'fields' => array(
				
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
			),
		),
				
		// Overview		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'overview',
			'title' => __('Overview Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_overview',
			),
			'fields' => array(
				
				
				// Bg Image
				array(
				'type' => 'upload',
				'name' => 'bg_image',
				'label' => __('Background Image', UN),
				),	
				
				// Overlayer color
				array(
					'type' => 'select',
					'name' => 'overlayer',
					'label' => __('Overlayer style', UN),
					'items' => array(
						array(
						'value' => 'bg-bk-alpha',
						'label' => __('Dark', UN),
						),
						array(
						'value' => 'bg-fs-alpha',
						'label' => __('Your primary custom color', UN),
						),						
					),
					'default' => array(
					'value_3',
					),
				),	
				
				// Feature
				array(
					'type' => 'group',
					'repeating' => true,
					'name' => 'feature',
					'title' => __('Feature', UN),
					'fields' => array(
						
						// Icon
						array(
						'type' => 'fontawesome',
						'name' => 'icon',
						'label' => __('Icon', UN),
						'description' => __('Select a icon from the included package ', UN),
						),
						
						// Feature Title
						array(
						'type' => 'textbox',
						'name' => 'title',
						'label' => __('Feature Title', UN),
						),
						
						// Feature Content
						array(
						'type' => 'textarea',
						'name' => 'excerpt',
						'label' => __('Feature Excerpt', UN),
						'description' => __('HTML allowed', UN),
						),
						
					),
				),				
			),
		),
		
		
		/* Playground (removed for instability)		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'playground',
			'title' => __('Playground Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_playground',
			),
			'fields' => array(
				
				// Youtube URL
				array(
				'type' => 'textbox',
				'name' => 'url',
				'label' => __('Youtube URL', UN),
				'description' => __('You can use the video id too', UN),
				),
				
				// Video Title
				array(
				'type' => 'textbox',
				'name' => 'title',
				'label' => __('Video Title', UN),
				),
				
				// Video Subtitle
				array(
				'type' => 'textarea',
				'name' => 'subtitle',
				'label' => __('Video Subtitle', UN),
				'description' => __('HTML allowed', UN),
				),
				
				// Volume
				array(
				'type' => 'toggle',
				'name' => 'volume',
				'label' => __('Enable Volume icon', UN),
				'default' => '1',
				),				
			),
		),
		*/
		
		// Portfolio		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'portfolio',
			'title' => __('Portfolio Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_portfolio',
			),
			'fields' => array(
			
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
					'validation' => 'required',
					'default' => array(
						'{{first}}',
					),
				),
				
				// Limit
				array(
				'type' => 'slider',
				'name' => 'limit',
				'label' => __('Items Limit', UN),
				'description' => __('Leave to 0 if you want to show all your posts', UN),
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '6',
				),
				
				// Width
				array(
					'type' => 'radiobutton',
					'name' => 'width',
					'label' => __('Portfolio Width', UN),
					'items' => array(
						array(
						'value' => 'row',
						'label' => __('Fullwidth', UN),
						),
						array(
						'value' => 'boxed',
						'label' => __('Boxed', UN),
						),
					),
					'default' => array(
					'row',
					),
				),
				
				// Padding
				array(
					'type' => 'radiobutton',
					'name' => 'padding',
					'label' => __('Items Spacing', UN),
					'items' => array(
						array(
						'value' => '',
						'label' => __('0 Pixels', UN),
						),
						array(
						'value' => 'padd-25',
						'label' => __('25 Pixels', UN),
						),
						array(
						'value' => 'padd-50',
						'label' => __('50 Pixels', UN),
						),
					),
					'default' => array(
					'row',
					),
				),				
			),
		),
		
		
		// Services 1	
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'services_1',
			'title' => __('Sercives Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_services_1',
			),
			'fields' => array(
				
	
				// Bg Image
				array(
				'type' => 'upload',
				'name' => 'bg_image',
				'label' => __('Background Image', UN),
				),
				
				// Service
				array(
					'type' => 'group',
					'repeating' => true,
					'name' => 'service',
					'title' => __('Service', UN),
					'fields' => array(
						
						// Icon
						array(
						'type' => 'fontawesome',
						'name' => 'icon',
						'label' => __('Icon', UN),
						'description' => __('Select a icon from the included package ', UN),
						),
						
						// Service Title
						array(
						'type' => 'textbox',
						'name' => 'title',
						'label' => __('Service Title', UN),
						),
						
						// Service Excerpt
						array(
						'type' => 'textarea',
						'name' => 'excerpt',
						'label' => __('Service Excerpt', UN),
						'description' => __('HTML allowed', UN),
						),
						
					),
				),				
			),
		),
		
		
		// Services 2	
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'services_2',
			'title' => __('Sercives Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_services_2',
			),
			'fields' => array(
								
				// Service
				array(
					'type' => 'group',
					'repeating' => true,
					'name' => 'service',
					'title' => __('Service', UN),
					'fields' => array(
						
						// Icon
						array(
						'type' => 'fontawesome',
						'name' => 'icon',
						'label' => __('Icon', UN),
						'description' => __('Select a icon from the included package ', UN),
						),
						
						// Service Title
						array(
						'type' => 'textbox',
						'name' => 'title',
						'label' => __('Service Title', UN),
						),
						
						// Service Excerpt
						array(
						'type' => 'textarea',
						'name' => 'excerpt',
						'label' => __('Service Excerpt', UN),
						'description' => __('HTML allowed', UN),
						),
						
					),
				),				
			),
		),
				
		
		// Team		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'team',
			'title' => __('Team Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_team',
			),
			'fields' => array(
				
				// Person
				array(
					'type' => 'group',
					'repeating' => true,
					'name' => 'person',
					'title' => __('Person', UN),
					'fields' => array(
						
						// Image
						array(
						'type' => 'upload',
						'name' => 'image',
						'label' => __('Image', UN),
						),	
						
						// Feature Title
						array(
						'type' => 'textbox',
						'name' => 'name',
						'label' => __('Name', UN),
						),
						
						// Email
						array(
						'type' => 'textbox',
						'name' => 'email',
						'label' => __('Email', UN),
						'validation' => 'email',
						),
						
						// Role
						array(
						'type' => 'textbox',
						'name' => 'role',
						'label' => __('Role', UN),
						),
						
						// Custom URL
						array(
						'type' => 'textbox',
						'name' => 'url',
						'label' => __('Custom Url', UN),
						),
						
						// Skill 1 Label
						array(
						'type' => 'textbox',
						'name' => 'skill1_label',
						'label' => __('Skill 1 Label', UN),
						),
						
						// Skill 1 Value
						array(
						'type' => 'slider',
						'name' => 'skill1_value',
						'label' => __('Skill 1 Value', UN),
						'min' => '1',
						'max' => '100',
						'step' => '1',
						'default' => '80',
						),
						
						// Skill 2 Label
						array(
						'type' => 'textbox',
						'name' => 'skill2_label',
						'label' => __('Skill 2 Label', UN),
						),
						
						// Skill 2 Value
						array(
						'type' => 'slider',
						'name' => 'skill2_value',
						'label' => __('Skill 2 Value', UN),
						'min' => '1',
						'max' => '100',
						'step' => '1',
						'default' => '80',
						),
						
						// Skill 3 Label
						array(
						'type' => 'textbox',
						'name' => 'skill3_label',
						'label' => __('Skill 3 Value', UN),
						),
						
						// Skill 3 Value
						array(
						'type' => 'slider',
						'name' => 'skill3_value',
						'label' => __('Skill 3 Value', UN),
						'min' => '1',
						'max' => '100',
						'step' => '1',
						'default' => '80',
						),
						
					),
				),				
			),
		),
		
				
		// Testimonials		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'testimonials',
			'title' => __('Testimonials Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_testimonials',
			),
			'fields' => array(
			
				// Bg Image
				array(
				'type' => 'upload',
				'name' => 'bg_image',
				'label' => __('Background Image', UN),
				),
				
				// Testimonial
				array(
					'type' => 'group',
					'repeating' => true,
					'name' => 'testimonial',
					'title' => __('Testimonial', UN),
					'fields' => array(
						
						// Bg Image
						array(
						'type' => 'upload',
						'name' => 'image',
						'label' => __('Image', UN),
						),	
						
						// Name
						array(
						'type' => 'textbox',
						'name' => 'name',
						'label' => __('Name', UN),
						),
						
						// Message
						array(
						'type' => 'textarea',
						'name' => 'message',
						'label' => __('Message', UN),
						'description' => __('HTML allowed', UN),
						), 
						
					),
				),				
			),
		),
		
		
		// Widgets		
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'widgets',
			'title' => __('Widgets Options', UN),
			'dependency' => array(
				'field' => 'type',
				'function' => 'un_is_widgets',
			),
			'fields' => array(
				
				// Sidebar 1
				array(
					'type' => 'select',
					'name' => 'sidebar1',
					'label' => __('Select Sidebar 1', UN),
					'items' => array(
						'data' => array(
							array(
							'source' => 'function',
							'value' => 'un_meta_sidebar_list',
							),
						),
					),
				),
				
				// Sidebar 2
				array(
					'type' => 'select',
					'name' => 'sidebar2',
					'label' => __('Select Sidebar 2', UN),
					'items' => array(
						'data' => array(
							array(
							'source' => 'function',
							'value' => 'un_meta_sidebar_list',
							),
						),
					),
				),
				
				// Sidebar 3
				array(
					'type' => 'select',
					'name' => 'sidebar3',
					'label' => __('Select Sidebar 3', UN),
					'items' => array(
						'data' => array(
							array(
							'source' => 'function',
							'value' => 'un_meta_sidebar_list',
							),
						),
					),
				),			
			),
		),
	),
);

// Init Metas
new VP_Metabox($sections_metas);