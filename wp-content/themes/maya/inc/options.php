<?php
/**
 * Maya Options Setup
 *
 * @package WordPress
 * @subpackage Maya
 * 
 */
 
// Specific Functions //

VP_Security::instance()->whitelist_function('un_home_html_info');

function un_home_html_info(){
	
	$html = '';
	
	$html .= '<h2>'.__('Are you searching for the Home Options?', UN).'</h2>';
	$html .= '<h3>'.__('With Maya you can create many different Homepages!', UN).'</h3><br>';
	$html .= '<a href="post-new.php?post_type=page" class="un-options-button">'.__('Create new Page', UN).'</a><br>'; 
	$html .= '<h3>'.__('How to', UN).'</h3>';
	$html .= '<p>'.__('1. Create a new page and select the <b>Homepage</b> Template.<br> 2. Now you will see many options to appear on the bottom:', UN).'</p>';
	$html .= '<p><a href="post-new.php?post_type=page"><img src="'.UN_THEME_URI.'assets/img/home_options_screen.png"></a></p>';
	
	return $html;
		
}

VP_Security::instance()->whitelist_function('un_help_html_display');

function un_help_html_display(){
	
	$html = '';
	
	$html .= '<h2>'.__('Got you a problem using the theme?', UN).'</h2>';
	$html .= '<h3>'.__('Don\'t worry! Here there\'s all you need.', UN).'</h3><br>';
	
	$html .= '<h3>'.__('1. Try to follow our Guide', UN).'</h3>';
	$html .= '<a href="http://demo.uncommons.pro/themes/wp/maya/docs/" target="_blank" class="un-options-button">'.__('Go to the Guide', UN).'</a><br>'; 
	
	$html .= '<h3>'.__('2. Take a look in our Install Tutorial', UN).'</h3>';
	
	$html .= '<p class="un-tutorial-list">'; 
		
	$html .= '<iframe width="560" height="315" src="//www.youtube.com/embed/xDr3UVqxPfo?rel=0" frameborder="0" allowfullscreen></iframe>';
	
	$html .= '</p><br>'; 
	
	$html .= '<h3>'.__('3. Ask our help!', UN).'</h3>';
	$html .= '<a href="http://support.uncommons.pro" target="_blank" class="un-options-button">'.__('Ask Support', UN).'</a><br>'; 
	
	return $html;

		
}


////////////////////////
//  OPTIONS TEMPLATE  //
////////////////////////

$un_options_template = array(
	'title' => __('Theme Options', UN),
	'logo' => UN_THEME_URI.'assets/img/logo-dark.png', 
	'menus' => array( 
		
		
		// HELP
		array(
			'title' => __('Help', UN),
			'name' => 'help',
			'icon' => 'font-awesome:icon-help',
			'controls' => array(
				
				// HTML
				array(
					'type' => 'html',
					'name' => 'help_support_info',
					'binding' => array(
						'field' => '',
						'function' => 'un_help_html_display', 
					),
				),				
			),			
		),
		
				
		// GENERAL SETTINGS
		array(
			'title' => __('General Setting', UN),
			'name' => 'general_setting',
			'icon' => 'font-awesome:icon-cog',
			'controls' => array(
				
				// Brand
				array(
					'type' => 'section',
					'title' => __('Brand', UN),
					'name' => 'brand',
					'description' => __('Make Maya your personal Theme', UN),
					'fields' => array(
					
						// Logo Dark
						array(
							'type' => 'upload',
							'name' => 'logo-dark',
							'label' => __('Logo Dark', UN),
							'description' => __('Tip: for the best result use a 150px X 40px image (.png with transparent background)', UN),
						),
						
						// Logo Light
						array(
							'type' => 'upload',
							'name' => 'logo-light',
							'label' => __('Logo Light', UN),
							'description' => __('Tip: for the best result use a 150px X 40px image (.png with transparent background)', UN),
						),
						
						// Logo Sticky
						array(
							'type' => 'upload',
							'name' => 'logo-sticky',
							'label' => __('Logo Sticky', UN),
							'description' => __('Tip: for the best result use a 40 X 40px image with dark colors (.png with transparent background)', UN),
						),
						
						// Favicon
						array(
							'type' => 'upload',
							'name' => 'favicon',
							'label' => __('Favicon', UN),
							'description' => __('Tip: for the best result use a 16px X 16px image (.png with transparent background)', UN),
						),
						
					),
				),
			),
		),
		
		
		// STYLING
		array(
			'title' => __('Styling', UN),
			'name' => 'styling',
			'icon' => 'font-awesome:icon-eye',
			'controls' => array(
				
				// Basic Styling
				array(
					'type' => 'section',
					'title' => __('Manage the BASIC styling of your Theme', UN),
					'fields' => array(
					
						// Primary RGB Color
						array(
							'type' => 'color',
							'name' => 'color1',
							'label' => __('Primary RGB Color', UN),
							'format' => 'rgb',
							'default' => 'rgb(37,116,169)',
						),
						
						// Primary RGBA Color
						array(
							'type' => 'color',
							'name' => 'color1a',
							'label' => __('Primary RGBA Color', UN),
							'format' => 'rgba',
							'default' => 'rgba(37,116,169,0.7)',
							
						),
						
						// Secondary RGB Color
						array(
							'type' => 'color',
							'name' => 'color2',
							'label' => __('Secondary RGB Color', UN),
							'format' => 'rgb',
							'default' => 'rgb(34,49,63)',
							
						),
						
						// Secondary RGBA Color
						array(
							'type' => 'color',
							'name' => 'color2a',
							'label' => __('Secondary RGBA Color', UN),
							'format' => 'rgba',
							'default' => 'rgba(34,49,63,0.7)',
							
						),
						
						// Custom Font
						array(
							'type' => 'select',
							'name' => 'mainfont',
							'label' => __('Main Font', UN),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'default' => 'Lato',
						),					
						
					),
				),	
				
				
				// =========================== //
				//      ADVANCED STYLING       //
				// =========================== //
				
				
				// Enable Advanced Styling
				array(
					'type' => 'toggle',
					'name' => 'advanced_style',
					'label' => __('Enable Advanced Styling', UN),
					'default' => '0',
				),
				
				// BODY
				array(
					'type' => 'section',
					'title' => __('BODY', UN),
					'name' => 'custom_body',
					'dependency' => array(
						'field' => 'advanced_style',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
					
						// Custom Font
						array(
							'type' => 'select',
							'name' => 'custom_body_font',
							'label' => __('Font', UN),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'validation' => 'required',
							'default' => 'Lato',
						),		
								
						// Color
						array(
							'type' => 'color',
							'name' => 'custom_body_color',
							'label' => __('Color', UN),
							'default' => '#555555',
							'validation' => 'required',
						),
						
						// Size
						array(
							'type' => 'slider',
							'name' => 'custom_body_size',
							'label' => __('Size (px)', UN),
							'min' => '10',
							'max' => '100',
							'step' => '1',
							'default' => '14',
							'validation' => 'required',
						),	
						
						
						// Font Style
						array(
							'type' => 'radiobutton',
							'name' => 'custom_body_style',
							'label' => __('Style', UN),
							'description' => __('Note: many fonts haven\'t an Italic style', UN),
							'items' => array(
								array(
									'value' => 'normal',
									'label' => __('Normal', UN),
								),
								array(
									'value' => 'italic',
									'label' => __('Italic', UN),
								),
							),
							'default' => array(
								'normal',
							),
							'validation' => 'required',
						),
						
						// Font Weight
						array(
							'type' => 'slider',
							'name' => 'custom_body_weight',
							'label' => __('Weight', UN),
							'description' => __('Note: many fonts haven\'t all the weigths', UN),
							'min' => '100',
							'max' => '900',
							'step' => '100',
							'default' => '300',
							'validation' => 'required',
						),
					),
				),
				
				
				
				// MAIN MENU
				array(
					'type' => 'section',
					'title' => __('MAIN MENU', UN),
					'name' => 'custom_mainmenu',
					'dependency' => array(
						'field' => 'advanced_style',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
					
						// Custom Font
						array(
							'type' => 'select',
							'name' => 'custom_mainmenu_font',
							'label' => __('Font', UN),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'validation' => 'required',
							'default' => 'Lato',
						),		
														
						// Size
						array(
							'type' => 'slider',
							'name' => 'custom_mainmenu_size',
							'label' => __('Size (px)', UN),
							'min' => '10',
							'max' => '100',
							'step' => '1',
							'default' => '14',
							'validation' => 'required',
						),	
						
						
						// Font Style
						array(
							'type' => 'radiobutton',
							'name' => 'custom_mainmenu_style',
							'label' => __('Style', UN),
							'description' => __('Note: many fonts haven\'t an Italic style', UN),
							'items' => array(
								array(
									'value' => 'normal',
									'label' => __('Normal', UN),
								),
								array(
									'value' => 'italic',
									'label' => __('Italic', UN),
								),
							),
							'default' => array(
								'normal',
							),
							'validation' => 'required',
						),
						
						// Font Weight
						array(
							'type' => 'slider',
							'name' => 'custom_mainmenu_weight',
							'label' => __('Weight', UN),
							'description' => __('Note: many fonts haven\'t all the weigths', UN),
							'min' => '100',
							'max' => '900',
							'step' => '100',
							'default' => '700',
							'validation' => 'required',
						),
					),
				),
				
				
				
				// SUB MENU
				array(
					'type' => 'section',
					'title' => __('SUB MENU', UN),
					'name' => 'custom_submenu',
					'dependency' => array(
						'field' => 'advanced_style',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
					
						// Custom Font
						array(
							'type' => 'select',
							'name' => 'custom_submenu_font',
							'label' => __('Font', UN),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'validation' => 'required',
							'default' => 'Lato',
						),		
								
						// Size
						array(
							'type' => 'slider',
							'name' => 'custom_submenu_size',
							'label' => __('Size (px)', UN),
							'min' => '10',
							'max' => '100',
							'step' => '1',
							'default' => '12',
							'validation' => 'required',
						),	
						
						
						// Font Style
						array(
							'type' => 'radiobutton',
							'name' => 'custom_submenu_style',
							'label' => __('Style', UN),
							'description' => __('Note: many fonts haven\'t an Italic style', UN),
							'items' => array(
								array(
									'value' => 'normal',
									'label' => __('Normal', UN),
								),
								array(
									'value' => 'italic',
									'label' => __('Italic', UN),
								),
							),
							'default' => array(
								'normal',
							),
							'validation' => 'required',
						),
						
						// Font Weight
						array(
							'type' => 'slider',
							'name' => 'custom_submenu_weight',
							'label' => __('Weight', UN),
							'description' => __('Note: many fonts haven\'t all the weigths', UN),
							'min' => '100',
							'max' => '900',
							'step' => '100',
							'default' => '700',
							'validation' => 'required',
						),
					),
				),
				
				
				
				// H1
				array(
					'type' => 'section',
					'title' => __('H1', UN),
					'name' => 'custom_h1',
					'dependency' => array(
						'field' => 'advanced_style',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
					
						// Custom Font
						array(
							'type' => 'select',
							'name' => 'custom_h1_font',
							'label' => __('Font', UN),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'validation' => 'required',
							'default' => 'Lato',
						),		
								
						// Color
						array(
							'type' => 'color',
							'name' => 'custom_h1_color',
							'label' => __('Color', UN),
							'default' => '#2574A9',
							'validation' => 'required',
						),
						
						// Size
						array(
							'type' => 'slider',
							'name' => 'custom_h1_size',
							'label' => __('Size (px)', UN),
							'min' => '10',
							'max' => '100',
							'step' => '1',
							'default' => '35',
							'validation' => 'required',
						),	
						
						
						// Font Style
						array(
							'type' => 'radiobutton',
							'name' => 'custom_h1_style',
							'label' => __('Style', UN),
							'description' => __('Note: many fonts haven\'t an Italic style', UN),
							'items' => array(
								array(
									'value' => 'normal',
									'label' => __('Normal', UN),
								),
								array(
									'value' => 'italic',
									'label' => __('Italic', UN),
								),
							),
							'default' => array(
								'normal',
							),
							'validation' => 'required',
						),
						
						// Font Weight
						array(
							'type' => 'slider',
							'name' => 'custom_h1_weight',
							'label' => __('Weight', UN),
							'description' => __('Note: many fonts haven\'t all the weigths', UN),
							'min' => '100',
							'max' => '900',
							'step' => '100',
							'default' => '700',
							'validation' => 'required',
						),
					),
				),
				
				
				// H2
				array(
					'type' => 'section',
					'title' => __('H2', UN),
					'name' => 'custom_h2',
					'dependency' => array(
						'field' => 'advanced_style',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
					
						// Custom Font
						array(
							'type' => 'select',
							'name' => 'custom_h2_font',
							'label' => __('Font', UN),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'validation' => 'required',
							'default' => 'Lato',
						),		
								
						// Color
						array(
							'type' => 'color',
							'name' => 'custom_h2_color',
							'label' => __('Color', UN),
							'default' => '#2574a9',
							'validation' => 'required',
						),
						
						// Size
						array(
							'type' => 'slider',
							'name' => 'custom_h2_size',
							'label' => __('Size (px)', UN),
							'min' => '10',
							'max' => '100',
							'step' => '1',
							'default' => '30',
							'validation' => 'required',
						),	
						
						
						// Font Style
						array(
							'type' => 'radiobutton',
							'name' => 'custom_h2_style',
							'label' => __('Style', UN),
							'description' => __('Note: many fonts haven\'t an Italic style', UN),
							'items' => array(
								array(
									'value' => 'normal',
									'label' => __('Normal', UN),
								),
								array(
									'value' => 'italic',
									'label' => __('Italic', UN),
								),
							),
							'default' => array(
								'normal',
							),
							'validation' => 'required',
						),
						
						// Font Weight
						array(
							'type' => 'slider',
							'name' => 'custom_h2_weight',
							'label' => __('Weight', UN),
							'description' => __('Note: many fonts haven\'t all the weigths', UN),
							'min' => '100',
							'max' => '900',
							'step' => '100',
							'default' => '700',
							'validation' => 'required',
						),
					),
				),
				
				
				// H3
				array(
					'type' => 'section',
					'title' => __('H3', UN),
					'name' => 'custom_h3',
					'dependency' => array(
						'field' => 'advanced_style',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
					
						// Custom Font
						array(
							'type' => 'select',
							'name' => 'custom_h3_font',
							'label' => __('Font', UN),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'validation' => 'required',
							'default' => 'Lato',
						),		
								
						// Color
						array(
							'type' => 'color',
							'name' => 'custom_h3_color',
							'label' => __('Color', UN),
							'default' => '#2574a9',
							'validation' => 'required',
						),
						
						// Size
						array(
							'type' => 'slider',
							'name' => 'custom_h3_size',
							'label' => __('Size (px)', UN),
							'min' => '10',
							'max' => '100',
							'step' => '1',
							'default' => '25',
							'validation' => 'required',
						),	
						
						
						// Font Style
						array(
							'type' => 'radiobutton',
							'name' => 'custom_h3_style',
							'label' => __('Style', UN),
							'description' => __('Note: many fonts haven\'t an Italic style', UN),
							'items' => array(
								array(
									'value' => 'normal',
									'label' => __('Normal', UN),
								),
								array(
									'value' => 'italic',
									'label' => __('Italic', UN),
								),
							),
							'default' => array(
								'normal',
							),
							'validation' => 'required',
						),
						
						// Font Weight
						array(
							'type' => 'slider',
							'name' => 'custom_h3_weight',
							'label' => __('Weight', UN),
							'description' => __('Note: many fonts haven\'t all the weigths', UN),
							'min' => '100',
							'max' => '900',
							'step' => '100',
							'default' => '700',
							'validation' => 'required',
						),
					),
				),
				
				
				// H4
				array(
					'type' => 'section',
					'title' => __('H4', UN),
					'name' => 'custom_h4',
					'dependency' => array(
						'field' => 'advanced_style',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
					
						// Custom Font
						array(
							'type' => 'select',
							'name' => 'custom_h4_font',
							'label' => __('Font', UN),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'validation' => 'required',
							'default' => 'Lato',
						),		
								
						// Color
						array(
							'type' => 'color',
							'name' => 'custom_h4_color',
							'label' => __('Color', UN),
							'default' => '#555555',
							'validation' => 'required',
						),
						
						// Size
						array(
							'type' => 'slider',
							'name' => 'custom_h4_size',
							'label' => __('Size (px)', UN),
							'min' => '10',
							'max' => '100',
							'step' => '1',
							'default' => '20',
							'validation' => 'required',
						),	
						
						
						// Font Style
						array(
							'type' => 'radiobutton',
							'name' => 'custom_h4_style',
							'label' => __('Style', UN),
							'description' => __('Note: many fonts haven\'t an Italic style', UN),
							'items' => array(
								array(
									'value' => 'normal',
									'label' => __('Normal', UN),
								),
								array(
									'value' => 'italic',
									'label' => __('Italic', UN),
								),
							),
							'default' => array(
								'normal',
							),
							'validation' => 'required',
						),
						
						// Font Weight
						array(
							'type' => 'slider',
							'name' => 'custom_h4_weight',
							'label' => __('Weight', UN),
							'description' => __('Note: many fonts haven\'t all the weigths', UN),
							'min' => '100',
							'max' => '900',
							'step' => '100',
							'default' => '700',
							'validation' => 'required',
						),
					),
				),
				
				
				// H5
				array(
					'type' => 'section',
					'title' => __('H5', UN),
					'name' => 'custom_h5',
					'dependency' => array(
						'field' => 'advanced_style',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
					
						// Custom Font
						array(
							'type' => 'select',
							'name' => 'custom_h5_font',
							'label' => __('Font', UN),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'validation' => 'required',
							'default' => 'Lato',
						),		
								
						// Color
						array(
							'type' => 'color',
							'name' => 'custom_h5_color',
							'label' => __('Color', UN),
							'default' => '#555555',
							'validation' => 'required',
						),
						
						// Size
						array(
							'type' => 'slider',
							'name' => 'custom_h5_size',
							'label' => __('Size (px)', UN),
							'min' => '10',
							'max' => '100',
							'step' => '1',
							'default' => '18',
							'validation' => 'required',
						),	
						
						
						// Font Style
						array(
							'type' => 'radiobutton',
							'name' => 'custom_h5_style',
							'label' => __('Style', UN),
							'description' => __('Note: many fonts haven\'t an Italic style', UN),
							'items' => array(
								array(
									'value' => 'normal',
									'label' => __('Normal', UN),
								),
								array(
									'value' => 'italic',
									'label' => __('Italic', UN),
								),
							),
							'default' => array(
								'normal',
							),
							'validation' => 'required',
						),
						
						// Font Weight
						array(
							'type' => 'slider',
							'name' => 'custom_h5_weight',
							'label' => __('Weight', UN),
							'description' => __('Note: many fonts haven\'t all the weigths', UN),
							'min' => '100',
							'max' => '900',
							'step' => '100',
							'default' => '700',
							'validation' => 'required',
						),
					),
				),
				
				
				// H6
				array(
					'type' => 'section',
					'title' => __('H6', UN),
					'name' => 'custom_h6',
					'dependency' => array(
						'field' => 'advanced_style',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
					
						// Custom Font
						array(
							'type' => 'select',
							'name' => 'custom_h6_font',
							'label' => __('Font', UN),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'validation' => 'required',
							'default' => 'Lato',
						),		
								
						// Color
						array(
							'type' => 'color',
							'name' => 'custom_h6_color',
							'label' => __('Color', UN),
							'default' => '#555555',
							'validation' => 'required',
						),
						
						// Size
						array(
							'type' => 'slider',
							'name' => 'custom_h6_size',
							'label' => __('Size (px)', UN),
							'min' => '10',
							'max' => '100',
							'step' => '1',
							'default' => '16',
							'validation' => 'required',
						),	
						
						
						// Font Style
						array(
							'type' => 'radiobutton',
							'name' => 'custom_h6_style',
							'label' => __('Style', UN),
							'description' => __('Note: many fonts haven\'t an Italic style', UN),
							'items' => array(
								array(
									'value' => 'normal',
									'label' => __('Normal', UN),
								),
								array(
									'value' => 'italic',
									'label' => __('Italic', UN),
								),
							),
							'default' => array(
								'normal',
							),
							'validation' => 'required',
						),
						
						// Font Weight
						array(
							'type' => 'slider',
							'name' => 'custom_h6_weight',
							'label' => __('Weight', UN),
							'description' => __('Note: many fonts haven\'t all the weigths', UN),
							'min' => '100',
							'max' => '900',
							'step' => '100',
							'default' => '700',
							'validation' => 'required',
						),
					),
				),
				
				
				// PAGE TITLE
				array(
					'type' => 'section',
					'title' => __('Page Title', UN),
					'name' => 'custom_page_title',
					'dependency' => array(
						'field' => 'advanced_style',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
					
						// Custom Font
						array(
							'type' => 'select',
							'name' => 'custom_page_title_font',
							'label' => __('Font', UN),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'validation' => 'required',
							'default' => 'Lato',
						),		
								
						// Color
						array(
							'type' => 'color',
							'name' => 'custom_page_title_color',
							'label' => __('Color', UN),
							'default' => '#2574A9',
							'validation' => 'required',
						),
						
						// Size
						array(
							'type' => 'slider',
							'name' => 'custom_page_title_size',
							'label' => __('Size (px)', UN),
							'min' => '10',
							'max' => '100',
							'step' => '1',
							'default' => '35',
							'validation' => 'required',
						),	
						
						
						// Font Style
						array(
							'type' => 'radiobutton',
							'name' => 'custom_page_title_style',
							'label' => __('Style', UN),
							'description' => __('Note: many fonts haven\'t an Italic style', UN),
							'items' => array(
								array(
									'value' => 'normal',
									'label' => __('Normal', UN),
								),
								array(
									'value' => 'italic',
									'label' => __('Italic', UN),
								),
							),
							'default' => array(
								'normal',
							),
							'validation' => 'required',
						),
						
						// Font Weight
						array(
							'type' => 'slider',
							'name' => 'custom_page_title_weight',
							'label' => __('Weight', UN),
							'description' => __('Note: many fonts haven\'t all the weigths', UN),
							'min' => '100',
							'max' => '900',
							'step' => '100',
							'default' => '700',
							'validation' => 'required',
						),
					),
				),
				
				
				// PAGE CONTENT
				array(
					'type' => 'section',
					'title' => __('Page Content', UN),
					'name' => 'custom_page_content',
					'dependency' => array(
						'field' => 'advanced_style',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
					
						// Custom Font
						array(
							'type' => 'select',
							'name' => 'custom_page_content_font',
							'label' => __('Font', UN),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'validation' => 'required',
							'default' => 'Lato',
						),		
								
						// Color
						array(
							'type' => 'color',
							'name' => 'custom_page_content_color',
							'label' => __('Color', UN),
							'default' => '#555555',
							'validation' => 'required',
						),
						
						// Size
						array(
							'type' => 'slider',
							'name' => 'custom_page_content_size',
							'label' => __('Size (px)', UN),
							'min' => '10',
							'max' => '100',
							'step' => '1',
							'default' => '16',
							'validation' => 'required',
						),	
						
						
						// Font Style
						array(
							'type' => 'radiobutton',
							'name' => 'custom_page_content_style',
							'label' => __('Style', UN),
							'description' => __('Note: many fonts haven\'t an Italic style', UN),
							'items' => array(
								array(
									'value' => 'normal',
									'label' => __('Normal', UN),
								),
								array(
									'value' => 'italic',
									'label' => __('Italic', UN),
								),
							),
							'default' => array(
								'normal',
							),
							'validation' => 'required',
						),
						
						// Font Weight
						array(
							'type' => 'slider',
							'name' => 'custom_page_content_weight',
							'label' => __('Weight', UN),
							'description' => __('Note: many fonts haven\'t all the weigths', UN),
							'min' => '100',
							'max' => '900',
							'step' => '100',
							'default' => '300',
							'validation' => 'required',
						),
					),
				),
				
				
				// WIDGET TITLE
				array(
					'type' => 'section',
					'title' => __('Widget Title', UN),
					'name' => 'custom_widget_title',
					'dependency' => array(
						'field' => 'advanced_style',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
					
						// Custom Font
						array(
							'type' => 'select',
							'name' => 'custom_widget_title_font',
							'label' => __('Font', UN),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'validation' => 'required',
							'default' => 'Lato',
						),		
								
						// Color
						array(
							'type' => 'color',
							'name' => 'custom_widget_title_color',
							'label' => __('Color', UN),
							'default' => '#2574A9',
							'validation' => 'required',
						),
						
						// Size
						array(
							'type' => 'slider',
							'name' => 'custom_widget_title_size',
							'label' => __('Size (px)', UN),
							'min' => '10',
							'max' => '100',
							'step' => '1',
							'default' => '25',
							'validation' => 'required',
						),	
						
						
						// Font Style
						array(
							'type' => 'radiobutton',
							'name' => 'custom_widget_title_style',
							'label' => __('Style', UN),
							'description' => __('Note: many fonts haven\'t an Italic style', UN),
							'items' => array(
								array(
									'value' => 'normal',
									'label' => __('Normal', UN),
								),
								array(
									'value' => 'italic',
									'label' => __('Italic', UN),
								),
							),
							'default' => array(
								'normal',
							),
							'validation' => 'required',
						),
						
						// Font Weight
						array(
							'type' => 'slider',
							'name' => 'custom_widget_title_weight',
							'label' => __('Weight', UN),
							'description' => __('Note: many fonts haven\'t all the weigths', UN),
							'min' => '100',
							'max' => '900',
							'step' => '100',
							'default' => '700',
							'validation' => 'required',
						),
					),
				),
				
				
				// FOOTER TEXT
				array(
					'type' => 'section',
					'title' => __('Footer Text', UN),
					'name' => 'custom_footer_text',
					'dependency' => array(
						'field' => 'advanced_style',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
					
						// Custom Font
						array(
							'type' => 'select',
							'name' => 'custom_footer_text_font',
							'label' => __('Font', UN),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'validation' => 'required',
							'default' => 'Lato',
						),		
								
						// Color
						array(
							'type' => 'color',
							'name' => 'custom_footer_text_color',
							'label' => __('Color', UN),
							'default' => '#ffffff',
							'validation' => 'required',
						),
						
						// Size
						array(
							'type' => 'slider',
							'name' => 'custom_footer_text_size',
							'label' => __('Size (px)', UN),
							'min' => '10',
							'max' => '100',
							'step' => '1',
							'default' => '14',
							'validation' => 'required',
						),	
						
						
						// Font Style
						array(
							'type' => 'radiobutton',
							'name' => 'custom_footer_text_style',
							'label' => __('Style', UN),
							'description' => __('Note: many fonts haven\'t an Italic style', UN),
							'items' => array(
								array(
									'value' => 'normal',
									'label' => __('Normal', UN),
								),
								array(
									'value' => 'italic',
									'label' => __('Italic', UN),
								),
							),
							'default' => array(
								'normal',
							),
							'validation' => 'required',
						),
						
						// Font Weight
						array(
							'type' => 'slider',
							'name' => 'custom_footer_text_weight',
							'label' => __('Weight', UN),
							'description' => __('Note: many fonts haven\'t all the weigths', UN),
							'min' => '100',
							'max' => '900',
							'step' => '100',
							'default' => '300',
							'validation' => 'required',
						),
					),
				),
				
						
			),
		),
		
		
		// HEADER
		array(
			'title' => __('Header', UN),
			'name' => 'header',
			'icon' => 'font-awesome:icon-arrow-up',
			'controls' => array(
				
				// Top Bar
				array(
					'type' => 'section',
					'title' => __('Top Bar', UN),
					'fields' => array(
									
						// Email
						array(
							'type' => 'textbox',
							'name' => 'email',
							'label' => __('Email Address', UN),
							'description' => __('This address will enable an email icon with a link near the Logo', UN),
							'default' => 'your-email@domain.ext',
							'validation' => 'email'
						),
						
						// Bookmarks
						array(
							'type' => 'textbox',
							'name' => 'follow',
							'label' => __('Follow Url', UN),
							'description' => __('This url will enable a heart icon with a link near the Logo', UN),
							'default' => 'http://your-follow-url.ext',
							'validation' => 'url',
						),						
					),
				),
				
				// Menu
				array(
					'type' => 'section',
					'title' => __('Menu', UN),
					'fields' => array(
									
						// Menu Type
						array(
							'type' => 'select',
							'name' => 'menu',
							'label' => __('Default Type', UN),
							'description' => __('This is the default type for the header menu. It can be overidden by the same option in every page.', UN),
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
							
					),
				),
			),
		),
		
		
		// FOOTER
		array(
			'title' => __('Footer', UN),
			'name' => 'footer',
			'icon' => 'font-awesome:icon-arrow-down',
			'controls' => array(
				
				// Copy
				array(
					'type' => 'section',
					'title' => __('Copyright', UN),
					'fields' => array(
					
						// Text
						array(
							'type' => 'codeeditor',
							'name' => 'copy',
							'label' => __('Copyright', UN),
							'theme' => 'github',
							'mode' => 'html',
						),
					),
				),
				
				// Buttons
				array(
					'type' => 'section',
					'title' => __('Buttons', UN),
					'fields' => array(
					
						// Back the Top
						array(
							'type' => 'toggle',
							'name' => 'backtop',
							'label' => __('Back to Top', UN),
							'description' => __('Enable/Disable the button to turn back to the top of page.', UN),
							'default' => '1',
						),
						
						// Social
						array(
							'type' => 'textbox',
							'name' => 'facebook',
							'label' => __('Facebook', UN),
						),
						array(
							'type' => 'textbox',
							'name' => 'twitter',
							'label' => __('Twitter', UN),
						),
						array(
							'type' => 'textbox',
							'name' => 'gplus',
							'label' => __('Google+', UN),
						),
						array(
							'type' => 'textbox',
							'name' => 'flickr',
							'label' => __('Flickr', UN),
						),
						array(
							'type' => 'textbox',
							'name' => 'pinterest',
							'label' => __('Pinterest', UN),
						),
						array(
							'type' => 'textbox',
							'name' => 'linkedin',
							'label' => __('Linkedin', UN),
						),
						array(
							'type' => 'textbox',
							'name' => 'tumblr',
							'label' => __('Tumblr', UN),
						),
						array(
							'type' => 'textbox',
							'name' => 'instagram',
							'label' => __('Instagram', UN),
						),
						array(
							'type' => 'textbox',
							'name' => 'picasa',
							'label' => __('Picasa', UN),
						),
						
						array(
							'type' => 'textbox',
							'name' => 'soundcloud',
							'label' => __('Soundcloud', UN),
						),
						array(
							'type' => 'textbox',
							'name' => 'youtube',
							'label' => __('Youtube', UN),
						),
						array(
							'type' => 'textbox',
							'name' => 'vimeo',
							'label' => __('Vimeo', UN),
						),
						array(
							'type' => 'textbox',
							'name' => 'behance',
							'label' => __('Behance', UN),
						),
						array(
							'type' => 'textbox',
							'name' => 'github',
							'label' => __('Github', UN),
						),	
						array(
							'type' => 'textbox',
							'name' => 'paypal',
							'label' => __('PayPal', UN),
						),
						array(
							'type' => 'textbox',
							'name' => 'yahoo',
							'label' => __('Yahoo', UN),
						),
						array(
							'type' => 'textbox',
							'name' => 'codepen',
							'label' => __('CodePen', UN),
						),
						array(
							'type' => 'textbox',
							'name' => 'twitch',
							'label' => __('Twitch', UN),
						),		
					),
				),			
			),
		),
		
		
		// HOMEPAGE
		array(
			'title' => __('Homepage', UN),
			'name' => 'home',
			'icon' => 'font-awesome:icon-monitor',
			'controls' => array(
				
				// HTML
				array(
					'type' => 'html',
					'name' => 'home_info',
					'binding' => array(
						'field' => '',
						'function' => 'un_home_html_info', 
					),
				),				
			),			
		),
		
				
		// SEO
		array(
			'title' => __('SEO', UN),
			'name' => 'seo',
			'icon' => 'font-awesome:icon-star',
			'controls' => array(
				
				// Home
				array(
					'type' => 'section',
					'title' => __('Home', UN),
					'description' => __('Setup your metas for the homepage.', UN),
					'fields' => array(
					
						// Home Title
						array(
							'type' => 'textbox',
							'name' => 'home_title',
							'label' => __('Meta Title', UN),
						),
						
						// Home Desc
						array(
							'type' => 'textarea',
							'name' => 'home_desc',
							'label' => __('Meta Description', UN),
						),
						
						// Home Keys
						array(
							'type' => 'textbox',
							'name' => 'home_keys',
							'label' => __('Meta Keywords', UN),
						),
					),
				),
				
				// Pages
				array(
					'type' => 'section',
					'title' => __('Pages', UN),
					'description' => __('Setup your metas for the other pages.', UN),
					'fields' => array(
					
						// Page Title
						array(
							'type' => 'sorter',
							'name' => 'page_title',
							'label' => __('Meta Title', UN),
							'description' => __('Compose your page title with the proposed blocks and sort them.', UN),
							'max_selection' => 3,
							'items' => array(
								array(
									'value' => 'blog_name',
									'label' => __('Blog Name', UN),
								),
								array(
									'value' => 'page_title',
									'label' => __('Page Title', UN),
								),
								array(
									'value' => 'page_excerpt',
									'label' => __('Page Excerpt', UN),
								),
							),
						),
						
						// Page Desc
						array(
							'type' => 'toggle',
							'name' => 'page_desc',
							'label' => __('Meta Description', UN),
							'description' => __('Enable/Disable description from page excerpt.', UN),
							'default' => '1',
						),
						
						// Page Keys
						array(
							'type' => 'textbox',
							'name' => 'page_keys',
							'label' => __('Meta Keywords', UN),
						),
					),
				),			
			),
		),
		
		
		// ADVANCED
		array(
			'title' => __('Advanced', UN),
			'name' => 'advanced',
			'icon' => 'font-awesome:icon-layers',
			'controls' => array(
				
				// Loading
				array(
					'type' => 'select',
					'name' => 'loading',
					'label' => __('Page Loading', UN),
					'items' => array(
						array(
							'value' => 'allpages',
							'label' => __('All Pages', UN),
						),
						array(
							'value' => 'onlyhome',
							'label' => __('Only for Home', UN),
						),
						array(
							'value' => 'disabled',
							'label' => __('Disabled', UN),
						),
					),
					'default' => array(
						'allpages',
					),
				),
				
				// Curtain
				array(
					'type' => 'select',
					'name' => 'curtain',
					'label' => __('Exit Page Curtain', UN),
					'items' => array(
						array(
							'value' => 'allpages',
							'label' => __('All Pages', UN),
						),
						array(
							'value' => 'onlyhome',
							'label' => __('Only for Home', UN),
						),
						array(
							'value' => 'disabled',
							'label' => __('Disabled', UN),
						),
					),
					'default' => array(
						'allpages',
					),
				),
				
				// Animations
				array(
					'type' => 'select',
					'name' => 'anim',
					'label' => __('Appearing Animations', UN),
					'items' => array(
						array(
							'value' => 'allpages',
							'label' => __('All Pages', UN),
						),
						array(
							'value' => 'onlyhome',
							'label' => __('Only for Home', UN),
						),
						array(
							'value' => 'disabled',
							'label' => __('Disabled', UN),
						),
					),
					'default' => array(
						'allpages',
					),
				),
				
				// Notices and News
				array(
					'type' => 'toggle',
					'name' => 'uncommons',
					'label' => __('HIDE unCommons News and Notices (backend)', UN),
					'default' => '0',
				),
				
				// Codes
				array(
					'type' => 'section',
					'title' => __('Codes', UN),
					'description' => __('Use this section to add your advanced codes in different zones of theme.', UN),
					'fields' => array(
					
						// Code in Header
						array(
							'type' => 'codeeditor',
							'name' => 'head_code',
							'label' => __('Code in Header', UN),
							'theme' => 'github',
							'mode' => 'html',
						),	
						
						// Code in Footer
						array(
							'type' => 'codeeditor',
							'name' => 'foot_code',
							'label' => __('Code in Footer', UN),
							'theme' => 'github',
							'mode' => 'html',
						),	
						
						// Custom CSS
						array(
							'type' => 'codeeditor',
							'name' => 'custom_css',
							'label' => __('Custom CSS', UN),
							'theme' => 'github',
							'mode' => 'css',
						),						
					),
				),		
					
			),
		),
	),
);



/////////////////////
// INSTALL OPTIONS //
/////////////////////

$un_options = new VP_Option(array(
	'is_dev_mode' => false, // dev mode, default to false
	'option_key' => 'un_options', // options key in db, required
	'page_slug' => 'un_options', // options page slug, required
	'template' => $un_options_template, // template file path or array, required
	'menu_page' => array(
	'icon_url' => UN_THEME_URI . 'assets/img/maya.png'
	),
	'use_auto_group_naming' => true, // default to true
	'use_util_menu' => true, // default to true, shows utility menu
	'minimum_role' => 'edit_theme_options', // default to 'edit_theme_options'
	'layout' => 'fluid', // fluid or fixed, default to fixed
	'page_title' => __( 'Maya Options', UN ), // page title
	'menu_label' => __( 'Maya', UN ), // menu label
));

// Get Option Function
function un_option($name) {
	return vp_option( "un_options.".$name );
}