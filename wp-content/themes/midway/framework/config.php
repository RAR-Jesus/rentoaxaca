<?php
//Theme configuration
$config = array (

	//Modules
	'modules' => array(

		//base modules
		'interface' => 'ThemexInterface',
		
		//additional
		'themex_widgetiser' => 'ThemexWidgetiser',
		'themex_form' => 'ThemexForm',
		'themex_shortcoder' => 'ThemexShortcoder',
		'themex_styler' => 'ThemexStyler',
	),

	//Components
	'components' => array(
	
		//Theme Supports
		'supports' => array (
			'automatic-feed-links',
			'post-thumbnails',
		),
		
		//Editor styles
		'editor_styles' => array(
			'styled-list list-1'=>__('List Style','midway').' 1',
			'styled-list list-2'=>__('List Style','midway').' 2',
			'styled-list list-3'=>__('List Style','midway').' 3',
			'styled-list list-4'=>__('List Style','midway').' 4',
			'styled-list list-5'=>__('List Style','midway').' 5',
		),
	
		//Menus
		'custom_menus' => array (
			array(
				'slug' => 'main_menu',
				'name' => __('Main Menu','midway'),
			),
			
			array(
				'slug' => 'footer_menu',
				'name' => __('Footer Menu','midway'),
			),
		),
	
		//Image Sizes
		'image_sizes' => array (
		
			array(
				'name' => 'preview',
				'width' => 440,
				'height' => 330,
				'crop' => true,
			),
		
			array(
				'name' => 'normal',
				'width' => 440,
				'height' => 9999,
				'crop' => false,
			),
			
			array(
				'name' => 'extended',
				'width' => 600,
				'height' => 9999,
				'crop' => false,
			),
			
		),

		//Theme backend styles
		'backend_styles' => array (
								
			//admin panel style
			array(	'name' => 'themex_admin',
					'uri' => THEMEX_URI.'admin/css/style.css'),
		
			//color picker
			array(	'name' => 'themex_colorpicker',
					'uri' => THEMEX_URI.'admin/css/colorpicker.css'),
					
			//date picker
			array(	'name' => 'jquery-ui-datepicker',
					'uri' => THEMEX_URI.'admin/css/datepicker.css'),
					
			//thickbox
			array(	'name' => 'thickbox' ),

		),
		
		//Theme frontend styles
		'frontend_styles' => array (		

			//fancybox
			array(	'name' => 'fancybox',
					'uri' => THEME_URI.'js/fancybox/jquery.fancybox.css'),
					
			//datepicker
			array(	'name' => 'datepicker',
					'uri' => THEME_URI.'js/datepicker/datepicker.css'),
					
			//main style
			array(	'name' => 'main',
					'uri' => THEME_CSS_URI.'style.css'),
			
		),
		
		//Theme backend scripts
		'backend_scripts' => array (
		
			//thickbox
			array(	'name' => 'thickbox' ),
			
			//media upload
			array(	'name' => 'media-upload' ),
			
			//jquery datepicker
			array(	'name' => 'jquery-ui-datepicker' ),
			
			//jquery slider
			array(	'name' => 'jquery-ui-slider' ),
		
			//panel interface
			array(	'name' => 'themex_admin',
					'uri' => THEMEX_URI.'admin/js/jquery.interface.js',
					'deps' => array('jquery')),
					
			//color picker
			array(	'name' => 'themex_colorpicker',
					'uri' => THEMEX_URI.'admin/js/jquery.colorpicker.js',
					'deps' => array('jquery')),
					
			//shortcodes popup
			array(	'name' => 'themex_shortcode_popup',
					'uri' => THEMEX_URI.'extensions/themex-shortcoder/js/popup.js',
					'deps' => array('jquery')),
					
			//shortcodes preview
			array(	'name' => 'themex_livequery',
					'uri' => THEMEX_URI.'extensions/themex-shortcoder/js/jquery.livequery.js',
					'deps' => array('jquery')),
					
			//shortcodes cloner
			array(	'name' => 'themex_appendo',
				'uri' => THEMEX_URI.'extensions/themex-shortcoder/js/jquery.appendo.js',
				'deps' => array('jquery')),
							
			
		),	
		
		//Theme frontend scripts
		'frontend_scripts' => array (
		
			//jquery
			array(	'name' => 'jquery' ),
			
			//text pattern
			array(	'name' => 'textPattern',
					'uri' => THEME_URI.'js/jquery.textPattern.js'),
					
			//placeholders script
			array(	'name' => 'placeholder',
					'uri' => THEME_URI.'js/jquery.placeholder.min.js'),
					
			//comment reply
			array(	'name' => 'comment-reply',
			'condition' => array('function'=>'is_single','value'=>'')),
			
			//fancybox
			array(	'name' => 'fancybox',
					'uri' => THEME_URI.'js/fancybox/jquery.fancybox.js'),
					
			//fade slider
			array(	'name' => 'fadeSlider',
					'uri' => THEME_URI.'js/jquery.fadeSlider.js'),
					
			//hover intent
			array(	'name' => 'hoverIntent',
					'uri' => THEME_URI.'js/jquery.hoverIntent.js'),
					
			//twitter fetcher
			array(	'name' => 'twitterFetcher',
					'uri' => THEME_URI.'js/jquery.twitterFetcher.js'),
					
			//custom
			array(	'name' => 'customScript',
					'uri' => THEME_URI.'js/jquery.custom.js'),
					
		),	
		
		//User Roles
		'user_roles' => array (
			
		),
		
		//Default widget areas
		'widget_areas' => array (
			array(	'name' => 'Footer Sidebar',
					'before_widget' => '<div class="column threecol"><div class="widget %2$s">',
					'after_widget' => '</div></div>',
					'before_title' => '<div class="block-title"><h3>',
					'after_title' => '</h3></div>',
					'id' => 'footer_sidebar'),
		),
		
		//Widgets
		'widgets' => array ('themex_subscribe_widget', 'themex_posts_widget', 'themex_twitter_widget'),
		
		//Post types
		'post_types' => array (
			
			//Tour
			array (
				'id' => 'tour',
				'labels' => array (
					'name' => __('Tours','midway'),
					'singular_name' => __( 'Tour','midway' ),
					'add_new' => __('Add New','midway'),
					'add_new_item' => __('Add New Tour','midway'),
					'edit_item' => __('Edit Tour','midway'),
					'new_item' => __('New Tour','midway'),
					'view_item' => __('View Tour','midway'),
					'search_items' => __('Search Tours','midway'),
					'not_found' =>  __('No Tours Found','midway'),
					'not_found_in_trash' => __('No Tours Found in Trash','midway'), 
					'parent_item_colon' => ''
				 ),
				'public' => true,
				'exclude_from_search' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title','editor','thumbnail','excerpt','revisions'),
				'rewrite' => array('slug' => __('tour', 'midway')),
			),
			
			//Gallery
			array (
				'id' => 'gallery',
				'labels' => array (
					'name' => __('Galleries','midway'),
					'singular_name' => __( 'Gallery','midway' ),
					'add_new' => __('Add New','midway'),
					'add_new_item' => __('Add New Gallery','midway'),
					'edit_item' => __('Edit Gallery','midway'),
					'new_item' => __('New Gallery','midway'),
					'view_item' => __('View Gallery','midway'),
					'search_items' => __('Search Galleries','midway'),
					'not_found' =>  __('No Galleries Found','midway'),
					'not_found_in_trash' => __('No Galleries Found in Trash','midway'), 
					'parent_item_colon' => ''
				 ),
				'public' => true,
				'exclude_from_search' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title','thumbnail', 'editor'),	
				'rewrite' => array('slug' => __('gallery', 'midway')),
			),
			
			//Testimonial
			array (
				'id' => 'testimonial',
				'labels' => array (
					'name' => __('Testimonials','midway'),
					'singular_name' => __( 'Testimonial','midway' ),
					'add_new' => __('Add New','midway'),
					'add_new_item' => __('Add New Testimonial','midway'),
					'edit_item' => __('Edit Testimonial','midway'),
					'new_item' => __('New Testimonial','midway'),
					'view_item' => __('View Testimonial','midway'),
					'search_items' => __('Search Testimonials','midway'),
					'not_found' =>  __('No Testimonials Found','midway'),
					'not_found_in_trash' => __('No Testimonials Found in Trash','midway'),
					'parent_item_colon' => ''
				 ),
				'public' => true,
				'exclude_from_search' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title','editor'),				
			),
			
			//Slide
			array (
				'id' => 'slide',
				'labels' => array (
					'name' => __('Slides','midway'),
					'singular_name' => __( 'Slide','midway' ),
					'add_new' => __('Add New','midway'),
					'add_new_item' => __('Add New Slide','midway'),
					'edit_item' => __('Edit Slide','midway'),
					'new_item' => __('New Slide','midway'),
					'view_item' => __('View Slide','midway'),
					'search_items' => __('Search Slides','midway'),
					'not_found' =>  __('No Slides Found','midway'),
					'not_found_in_trash' => __('No Slides Found in Trash','midway'), 
					'parent_item_colon' => ''
				 ),
				'public' => true,
				'exclude_from_search' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title','thumbnail','editor'),				
			),
		),		
		
		//Taxonomies
		'taxonomies' => array (			
			array(	'taxonomy' => 'tour_destination',		
				'object_type' => array('tour'),
				'settings' => array(
					'hierarchical' => true,
					'show_in_nav_menus' => true,					
					'show_admin_column' => true,
					'labels' => array(
	                    'name' 				=> __( 'Destinations', 'midway'),
	                    'singular_name' 	=> __( 'Destination', 'midway'),
						'menu_name'			=> __( 'Destinations', 'midway' ),
	                    'search_items' 		=> __( 'Search Destinations', 'midway'),
	                    'all_items' 		=> __( 'All Destinations', 'midway'),
	                    'parent_item' 		=> __( 'Parent Destination', 'midway'),
	                    'parent_item_colon' => __( 'Parent Destination', 'midway'),
	                    'edit_item' 		=> __( 'Edit Destination', 'midway'),
	                    'update_item' 		=> __( 'Update Destination', 'midway'),
	                    'add_new_item' 		=> __( 'Add New Destination', 'midway'),
	                    'new_item_name' 	=> __( 'New Destination Name', 'midway')
	            	),
					'rewrite' => array(
						'slug' => __('destinations', 'midway'),
						'hierarchical' => true
					)
				)
			),
			array(	'taxonomy' => 'tour_type',
				'object_type' => array('tour'),
				'settings' => array(
					'hierarchical' => true,
					'show_in_nav_menus' => true,					
					'show_admin_column' => true,
					'labels' => array(
	                    'name' 				=> __( 'Types', 'midway'),
	                    'singular_name' 	=> __( 'Type', 'midway'),
						'menu_name'			=> __( 'Types', 'midway' ),
	                    'search_items' 		=> __( 'Search Types', 'midway'),
	                    'all_items' 		=> __( 'All Types', 'midway'),
	                    'parent_item' 		=> __( 'Parent Type', 'midway'),
	                    'parent_item_colon' => __( 'Parent Type', 'midway'),
	                    'edit_item' 		=> __( 'Edit Type', 'midway'),
	                    'update_item' 		=> __( 'Update Type', 'midway'),
	                    'add_new_item' 		=> __( 'Add New Type', 'midway'),
	                    'new_item_name' 	=> __( 'New Type Name', 'midway')
	            	),
					'rewrite' => array(
						'slug' => __('types', 'midway'),
						'hierarchical' => true
					)
				)
			),
			array(	'taxonomy' => 'gallery_category',				
				'object_type' => array('gallery'),
				'settings' => array(
					'hierarchical' => true,
					'show_in_nav_menus' => true,
					'show_admin_column' => true,
					'labels' => array(
	                    'name' 				=> __( 'Gallery Categories', 'midway'),
	                    'singular_name' 	=> __( 'Gallery Category', 'midway'),
						'menu_name'			=> __( 'Categories', 'midway' ),
	                    'search_items' 		=> __( 'Search Gallery Categories', 'midway'),
	                    'all_items' 		=> __( 'All Gallery Categories', 'midway'),
	                    'parent_item' 		=> __( 'Parent Gallery Category', 'midway'),
	                    'parent_item_colon' => __( 'Parent Gallery Category', 'midway'),
	                    'edit_item' 		=> __( 'Edit Gallery Category', 'midway'),
	                    'update_item' 		=> __( 'Update Gallery Category', 'midway'),
	                    'add_new_item' 		=> __( 'Add New Gallery Category', 'midway'),
	                    'new_item_name' 	=> __( 'New Gallery Category Name', 'midway')
	            	),
					'rewrite' => array(
						'slug' => __('categories', 'midway'),
						'hierarchical' => true
					)
				)
			),
		),
		
		//Meta boxes
		'meta_boxes' => array(
		
			//Page
			array(
				'id' => 'page_metabox',
				'title' =>  __('Page Options', 'midway'),
				'page' => 'page',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(						
					array(	'name' => __('Page Background','midway'),
							'id' => 'background',
							'type' => 'uploader'),
					
					array(	'name' => __('Tours Destination','midway'),
							'id' => 'tours_destination',
							'type' => 'select_category',
							'attributes' => array('class'=>'template-tours-child child-option hidden'),
							'taxonomy' => 'tour_destination'),
					
					array(	'name' => __('Tours Type','midway'),
							'id' => 'tours_type',
							'type' => 'select_category',
							'attributes' => array('class'=>'template-tours-child child-option hidden'),
							'taxonomy' => 'tour_type'),
							
					array(	'name' => __('Galleries Category','midway'),
							'id' => 'galleries_category',
							'type' => 'select_category',
							'attributes' => array('class'=>'template-gallery-child child-option hidden'),
							'taxonomy' => 'gallery_category'),
				),			
			),	
						
			//Slides
			array(
				'id' => 'slide_metabox',
				'title' =>  __('Slide Options', 'midway'),
				'page' => 'slide',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(
				
					array(	'name' => __('Image Link','midway'),
							'desc' => __('Link for the slide image.','midway'),
							'id' => 'link',
							'type' => 'text'),

					array(	'name' => __('Video Code','midway'),
							'desc' => __('Paste embedded video code here.','midway'),
							'id' => 'video',
							'type' => 'textarea'),

				),			
			),			
				
			//Tours
			array(
				'id' => 'tour_metabox',
				'title' =>  __('Tour Options', 'midway'),
				'page' => 'tour',
				'context' => 'normal',
				'priority' => 'high',				
				'options' => array(
					array(	'name' => __('Price','midway'),
							'desc' => __('Tour minimum price.','midway'),
							'id' => 'price',
							'type' => 'number'),					
					array(	'name' => __('Duration','midway'),
							'desc' => __('Tour duration (days).','midway'),
							'id' => 'duration',
							'type' => 'text'),
					array(	'name' => __('Daparts','midway'),
							'desc' => __('Tour departure date.','midway'),
							'id' => 'departure_date',
							'type' => 'date'),
					array(	'name' => __('Arrives','midway'),
							'desc' => __('Tour arrival date.','midway'),
							'id' => 'arrival_date',
							'type' => 'date'),
					array(	'name' => __('Booking Link','midway'),
							'desc' => __('Link to book the tour.','midway'),
							'id' => 'booking',
							'type' => 'text'),
					array(	'name' => __('Runs On','midway'),
							'desc' => __('List of the week days.','midway'),
							'id' => 'days',
							'type' => 'days'),					
					array(	'name' => __('Gallery Images','midway'),
							'desc' => __('Add images for this tour.','midway'),
							'id' => 'images',
							'type' => 'gallery'),
				),
			),
			
			//Galleries
			array(
				'id' => 'gallery_metabox',
				'title' =>  __('Gallery Options', 'midway'),
				'page' => 'gallery',
				'context' => 'normal',
				'priority' => 'high',				
				'options' => array(
					array(	'name' => __('Gallery Images','midway'),
							'desc' => __('Add images for this gallery.','midway'),
							'id' => 'images',
							'type' => 'gallery'),
					array(	'name' => __('Video Code','midway'),
							'desc' => __('Paste embedded video code here.','midway'),
							'id' => 'video',
							'type' => 'textarea'),
				),
			),
		),
		
		'shortcodes' => array(	
		
			//Columns
			'column' => array(
				'options' => array(),
				'shortcode' => '{{child_shortcode}}',
				'popup_title' => __('Insert Columns Shortcode', 'midway'),
				'child_shortcode' => array(
					'options' => array(
						'column' => array(
							'type' => 'select',
							'label' => __('Column Width', 'midway'),
							'options' => array(
								'one_sixth' => __('One Sixth', 'midway'),
								'one_sixth_last' => __('One Sixth Last', 'midway'),
								'one_fourth' => __('One Fourth', 'midway'),
								'one_fourth_last' => __('One Fourth Last', 'midway'),
								'one_third' => __('One Third', 'midway'),
								'one_third_last' => __('One Third Last', 'midway'),
								'five_twelfths' => __('Five Twelfths', 'midway'),
								'five_twelfths_last' => __('Five Twelfths Last', 'midway'),
								'one_half' => __('One Half', 'midway'),
								'one_half_last' => __('One Half Last', 'midway'),
								'seven_twelfths' => __('Seven Twelfths', 'midway'),
								'seven_twelfths_last' => __('Seven Twelfths Last', 'midway'),
								'two_thirds' => __('Two Thirds', 'midway'),
								'two_thirds_last' => __('Two Thirds Last', 'midway'),
								'three_fourths' => __('Three Fourths', 'midway'),
								'three_fourths_last' => __('Three Fourths Last', 'midway'),
							)
						),
						'content' => array(
							'std' => '',
							'type' => 'textarea',
							'label' => __('Column Content', 'midway'),
						)
					),
					'shortcode' => '[{{column}}]{{content}}[/{{column}}] ',
					'clone_button' => __('Add Columns Shortcode', 'midway')
				)
			),
		
			//Block
			'block' => array(
				'options' => array(
					'background' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Block Background', 'midway'),
					),
					'content' => array(
						'std' => '',
						'type' => 'textarea',
						'label' => __('Block Content', 'midway'),
					),
				),
				'shortcode' => '[block background="{{background}}"]{{content}}[/block]',			
				'popup_title' => __('Insert Block Shortcode', 'midway')
			),			
			
			//Title
			'title' => array(
				'options' => array(
					'content' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Title Text', 'midway'),
					),
				),
				'shortcode' => '[title]{{content}}[/title]',			
				'popup_title' => __('Insert Title Shortcode', 'midway')
			),
			
			//Image
			'image' => array(
				'options' => array(
					'content' => array(
						'std' => '',
						'type' => 'textarea',
						'label' => __('Image URL', 'midway'),
					),
					'url' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Link URL', 'midway'),
					),					
				),
				'shortcode' => '[image url="{{url}}"]{{content}}[/image]',	
				'popup_title' => __('Insert Image Shortcode', 'midway')
			),
			
			//Button
			'button' => array(
				'options' => array(
					'color' => array(
						'type' => 'select',
						'label' => __('Button Color', 'midway'),
						'options' => array(
							'default' => __('Default', 'midway'),
							'grey' => __('Grey', 'midway'),						
						)
					),
					'size' => array(
						'type' => 'select',
						'label' => __('Button Size', 'midway'),
						'options' => array(
							'small' => __('Small', 'midway'),
							'medium' => __('Medium', 'midway'),
							'large' => __('Large', 'midway')
						)
					),
					'url' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Button URL', 'midway'),
					),
					'target' => array(
						'type' => 'select',
						'label' => __('Button Target', 'midway'),
						'options' => array(
							'self' => __('Current Tab', 'midway'),
							'blank' => __('New Tab', 'midway'),
						)
					),
					'content' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Button Text', 'midway'),
					)
				),
				'shortcode' => '[button url="{{url}}" target="{{target}}" size="{{size}}"]{{content}}[/button]',
				'popup_title' => __('Insert Button Shortcode', 'midway')
			),
			
			//Posts
			'posts' => array(
				'options' => array(
					'number' => array(
						'std' => '1',
						'type' => 'text',
						'label' => __('Posts Number', 'midway'),
					),
					'category' => array(
						'type' => 'select_category',
						'label' => __('Posts Category', 'midway'),
						'taxonomy' => 'category',
					),
					'order' => array(
						'type' => 'select',
						'label' => __('Posts Order', 'midway'),
						'options' => array(
							'date' => __('Date', 'midway'),
							'random' => __('Random', 'midway'),
						),
					),					
				),
				'shortcode' => '[posts number="{{number}}" order="{{order}}" category="{{category}}"]',		
				'popup_title' => __('Insert Posts Shortcode', 'midway')
			),	
			
			//Tours
			'tours' => array(
				'options' => array(
					'type' => array(
						'type' => 'select_category',
						'label' => __('Tours Type', 'midway'),
						'taxonomy' => 'tour_type',
					),
					'destination' => array(
						'type' => 'select_category',
						'label' => __('Tours Destination', 'midway'),
						'taxonomy' => 'tour_destination',
					),
					'number' => array(
						'std' => '4',
						'type' => 'text',
						'label' => __('Tours Number', 'midway'),
					),					
					'order' => array(
						'type' => 'select',
						'label' => __('Tours Order', 'midway'),
						'options' => array(
							'date' => __('Date', 'midway'),
							'title' => __('Title', 'midway'),
							'random' => __('Random', 'midway'),
						)
					),
					'columns' => array(
						'type' => 'select',
						'label' => __('Columns Number', 'midway'),
						'options' => array(
							'3' => __('Three', 'midway'),
							'4' => __('Four', 'midway'),
						)
					),
				),
				'shortcode' => '[tours type="{{type}}" destination="{{destination}}" number="{{number}}" columns="{{columns}}" order="{{order}}"]',		
				'popup_title' => __('Insert Tours Shortcode', 'midway')
			),
			
			//Galleries
			'galleries' => array(
				'options' => array(
					'caption' => array(
						'type' => 'select',
						'label' => __('Gallery Caption', 'midway'),
						'options' => array(
							'visible' => __('Visible', 'midway'),
							'hidden' => __('Hidden', 'midway'),
							'none' => __('None', 'midway'),
						)
					),
					'category' => array(
						'type' => 'select_category',
						'label' => __('Galleries Category', 'midway'),
						'taxonomy' => 'gallery_category',
					),
					'number' => array(
						'std' => '4',
						'type' => 'text',
						'label' => __('Galleries Number', 'midway'),
					),					
					'order' => array(
						'type' => 'select',
						'label' => __('Galleries Order', 'midway'),
						'options' => array(
							'date' => __('Date', 'midway'),
							'random' => __('Random', 'midway'),
						)
					),
					'columns' => array(
						'type' => 'select',
						'label' => __('Columns Number', 'midway'),
						'options' => array(
							'3' => __('Three', 'midway'),
							'4' => __('Four', 'midway'),
						)
					),
				),
				'shortcode' => '[galleries category="{{category}}" number="{{number}}" columns="{{columns}}" order="{{order}}" caption="{{caption}}"]',
				'popup_title' => __('Insert Galleries Shortcode', 'midway')
			),
						
			//Testimonials
			'testimonials' => array(
				'options' => array(
					'number' => array(
						'std' => '3',
						'type' => 'text',
						'label' => __('Testimonials Number', 'midway'),
					),
					'order' => array(
						'type' => 'select',
						'label' => __('Testimonials Order', 'midway'),
						'options' => array(
							'date' => __('Date', 'midway'),
							'random' => __('Random', 'midway'),
						)
					),
					'pause' => array(
						'std' => '0',
						'type' => 'text',
						'label' => __('Slider Pause', 'midway'),
					),
					'speed' => array(
						'std' => '400',
						'type' => 'text',
						'label' => __('Transition Speed', 'midway'),
					),
				),
				'shortcode' => '[testimonials number="{{number}}" order="{{order}}" pause="{{pause}}" speed="{{speed}}"]',		
				'popup_title' => __('Insert Testimonials Shortcode', 'midway')
			),	
			
			//Itinerary
			'itinerary' => array(
				'options' => array(),
				'shortcode' => '[itinerary]{{child_shortcode}}[/itinerary]',
				'popup_title' => __('Insert Itinerary Shortcode', 'midway'),
				'child_shortcode' => array(					
					'options' => array(
						'title' => array(
							'std' => '',
							'type' => 'text',
							'label' => __('Day Title', 'midway'),
						),
						'image' => array(
							'std' => '',
							'type' => 'text',
							'label' => __('Day Image', 'midway'),
						),
						'content' => array(
							'std' => '',
							'type' => 'textarea',
							'label' => __('Day Content', 'midway'),
						)
					),
					'shortcode' => '[day title="{{title}}" image="{{image}}"]{{content}}[/day]',
					'clone_button' => __('Add New Day', 'midway')
				)
			),
			
			//Google Map
			'map' => array(
				'no_preview' => true,
				'options' => array(
					'align' => array(
						'type' => 'select',
						'label' => __('Align', 'midway'),
						'options' => array(
							'none' => __('None', 'midway'),
							'top' => __('Top', 'midway'),
							'bottom' => __('Bottom', 'midway'),
						)
					),
					'latitude' => array(
						'type' => 'text',
						'label' => __('Latitude', 'midway'),
					),
					'longitude' => array(
						'type' => 'text',
						'label' => __('Longitude', 'midway'),
					),
					'zoom' => array(
						'type' => 'text',
						'label' => __('Zoom', 'midway'),
					),
					'height' => array(
						'type' => 'text',
						'std' => '250',
						'label' => __('Height', 'midway'),
					),
					'description' => array(
						'type' => 'textarea',
						'std' => '',
						'label' => __('Description', 'midway'),
					),
				),
				'shortcode' => '[map align="{{align}}" latitude="{{latitude}}" longitude="{{longitude}}" zoom="{{zoom}}" description="{{description}}" height="{{height}}"][/map]',
				'popup_title' => __('Insert Map Shortcode', 'midway')
			),
			
			//Search Form
			'search_form' => array(
				'shortcode' => '[search_form]',
				'popup_title' => __('Insert Search Form Shortcode', 'midway')
			),
			
			//Contact Form
			'contact_form' => array(
				'shortcode' => '[contact_form]',
				'popup_title' => __('Insert Contact Form Shortcode', 'midway')
			),
			
			//Sidebar
			'sidebar' => array(
				'options' => array(
					'name' => array(
						'type' => 'sidebars',
						'label' => __('Name', 'midway'),
					),
				),
				'shortcode' => '[sidebar name="{{name}}"]',
				'popup_title' => __('Insert Sidebar Shortcode', 'midway')
			),
			
			//Tabs
			'tabs' => array(
				'options' => array(
					'type' => array(
							'type' => 'select',
							'label' => __('Tabs Type', 'midway'),
							'options' => array(
								'horizontal' => __('Horizontal', 'midway'),
								'vertical' => __('Vertical', 'midway'),
						)
					),
					'titles' => array(
						'type' => 'text',
						'label' => __('Tab Titles', 'midway'),
						'desc' => __('Enter the comma separated tab titles.', 'midway')
					),		
				),
				'shortcode' => '[tabs type="{{type}}" titles="{{titles}}"]{{child_shortcode}}[/tabs]',
				'popup_title' => __('Insert Tabs Shortcode', 'midway'),
				'child_shortcode' => array(
					'options' => array(
						'content' => array(
							'std' => '',
							'type' => 'textarea',
							'label' => __('Tab Content', 'midway'),
						)
					),
					'shortcode' => '[tab]{{content}}[/tab]',
					'clone_button' => __('Add Tab', 'midway')
				)
			),
			
			//Toggle
			'toggle' => array(
				'options' => array(
					'title' => array(
						'type' => 'text',
						'label' => __('Toggle Title', 'midway'),
						'std' => ''
					),
					'content' => array(
						'std' => '',
						'type' => 'textarea',
						'label' => __('Toggle Content', 'midway'),
					)
					
				),
				'shortcode' => '[toggle title="{{title}}"]{{content}}[/toggle]',
				'popup_title' => __('Insert Toggle Shortcode', 'midway')
			),
		
		),		
		
		//Theme custom styles
		'custom_styles' => array (
			array(
				'elements' => '.global-container, .header',
				'attributes' => array('background-image'=>'background_pattern'),
			),
			
			array(
				'elements' => '.global-container, .header',
				'attributes' => array('background-image'=>'background_image'),
			),
			
			array(
				'elements' => 'body, input, select, textarea',
				'attributes' => array('font-family'=>'content_font'),
			),
			
			array(
				'elements' => 'h1,h2,h3,h4,h5,h6, .button, .header .menu a',
				'attributes' => array('font-family'=>'heading_font'),
			),
			
			array(
				'elements' => 'a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .header .menu ul ul a:hover, .header  .menu > ul > li.current-menu-item > a,.header  .menu > ul > li.current-menu-parent > a,.header  .menu > ul > li.hover > a,.header  .menu > ul > li:hover > a',
				'attributes' => array('color'=>'primary_color')
			),
			
			array(
				'elements' => 'input[type="submit"], input[type="button"], .button, .colored-icon, .ui-slider .ui-slider-range, .tour-itinerary .tour-day-number h5, .testimonials-slider .controls a.current',
				'attributes' => array('background-color'=>'primary_color')
			),
			
			array(
				'elements' => '.header .logo a, .header .header-text h5, .header .social-links span, .header .menu a, .header .menu a span, .footer .row, .footer a',
				'attributes' => array('color'=>'secondary_color')
			),
			
			array(
				'elements' => '.header .menu ul ul li, .header  .menu > ul > li.current-menu-item > a, .header  .menu > ul > li.current-menu-parent > a, .header  .menu > ul > li.hover > a, .header  .menu > ul > li:hover > a',
				'attributes' => array('background-color'=>'secondary_color')
			),
			
			array(
				'elements' => '::-moz-selection',
				'attributes' => array('background-color'=>'primary_color')
			),
			array(
				'elements' => '::selection',
				'attributes' => array('background-color'=>'primary_color')
			),
		),
	),

	
	//Options
	'options' => array (
			
		//General Settings
		array(	'name' => __('General','midway'),
				'type' => 'page'),
				
		array(	'name' => __('Site Favicon','midway'),
				'description' => __('Upload an image for your site favicon.','midway'),
				'id' => 'favicon',
				'type' => 'uploader'),
				
		array(	'name' => __('Site Logo Type','midway'),
				'id' => 'logo_type',
				'options' => array('image' => __('Image','midway'), 'text' => __('Text','midway')),
				'type' => 'select'),
				
		array(	'name' => __('Site Logo Image','midway'),
				'description' => __('Upload an image for your site logo.','midway'),
				'id' => 'logo_image',
				'type' => 'uploader',
				'parent' => array('logo_type','0')),
				
		array(	'name' => __('Site Logo Text','midway'),
				'description' => __('Enter the text for your site logo.','midway'),
				'id' => 'logo_text',
				'type' => 'text',
				'parent' => array('logo_type','1')),
				
		array(	'name' => __('Login Logo Image','midway'),
				'description' => __('Upload an image to show on the login page.','midway'),
				'id' => 'login_logo',
				'type' => 'uploader'),
				
		array(	'name' => __('Date Format','midway'),
				'description' => __('Choose the date format for all post types and comments.','midway'),
				'id' => 'date_format',
				'options' => array(
					'm/d/Y'=>'MM/DD/YY',
					'd/m/Y'=>'DD/MM/YY',						
				),
				'type' => 'select'),
				
		array(	'name' => __('Copyright Text','midway'),
				'description' => __('Enter the copyright text to be displayed in the footer.','midway'),
				'id' => 'copyright_text',
				'default' => '',
				'type' => 'textarea'),
				
		array(	'name' => __('Tracking Code','midway'),
				'description' => __('Add tracking analytics code here.','midway'),
				'id' => 'tracking_code',
				'default' => '',
				'type' => 'textarea'),				
				
		//Styling
		array(	'name' => __('Styling','midway'),
				'type' => 'page'),
				
		array(	'name' => __('Custom CSS','midway'),
				'description' => __('Write CSS rules here to overwrite the default styles.','midway'),
				'default' => '',
				'id' => 'css',
				'type' => 'textarea'),
				
		array(	'name' => __('Primary Theme Color','midway'),
				'default' => '#FF9000',
				'id' => 'primary_color',
				'type' => 'color'),
				
		array(	'name' => __('Secondary Theme Color','midway'),
				'default' => '#FFFFFF',
				'id' => 'secondary_color',
				'type' => 'color'),
				
		array(	'name' => __('Background Type','midway'),
				'id' => 'background_type',
				'options' => array('default' => __('Default','midway'), 'custom' => __('Custom','midway')),
				'description' => __('Choose from the default patterns or upload your own image.','midway'),
				'type' => 'select'),
				
		array(	'name' => __('Background Pattern','midway'),
				'id' => 'background_pattern',
				'options' => array(
									THEME_URI.'images/patterns/pattern_1.png'=>THEME_URI.'images/patterns/pattern_1_thumb.png', 
									THEME_URI.'images/patterns/pattern_2.png'=>THEME_URI.'images/patterns/pattern_2_thumb.png', 
									THEME_URI.'images/patterns/pattern_3.png'=>THEME_URI.'images/patterns/pattern_3_thumb.png', 
									THEME_URI.'images/patterns/pattern_4.png'=>THEME_URI.'images/patterns/pattern_4_thumb.png', 
									THEME_URI.'images/patterns/pattern_5.png'=>THEME_URI.'images/patterns/pattern_5_thumb.png', 
									THEME_URI.'images/patterns/pattern_6.png'=>THEME_URI.'images/patterns/pattern_6_thumb.png', 
									THEME_URI.'images/patterns/pattern_7.png'=>THEME_URI.'images/patterns/pattern_7_thumb.png', 
									THEME_URI.'images/patterns/pattern_8.png'=>THEME_URI.'images/patterns/pattern_8_thumb.png', 
									THEME_URI.'images/patterns/pattern_9.png'=>THEME_URI.'images/patterns/pattern_9_thumb.png', 
									THEME_URI.'images/patterns/pattern_10.png'=>THEME_URI.'images/patterns/pattern_10_thumb.png', 
									THEME_URI.'images/patterns/pattern_11.png'=>THEME_URI.'images/patterns/pattern_11_thumb.png', 
									THEME_URI.'images/patterns/pattern_12.png'=>THEME_URI.'images/patterns/pattern_12_thumb.png', 
									THEME_URI.'images/patterns/pattern_13.png'=>THEME_URI.'images/patterns/pattern_13_thumb.png', 
									THEME_URI.'images/patterns/pattern_14.png'=>THEME_URI.'images/patterns/pattern_14_thumb.png', 
									THEME_URI.'images/patterns/pattern_15.png'=>THEME_URI.'images/patterns/pattern_15_thumb.png', 
									THEME_URI.'images/patterns/pattern_16.png'=>THEME_URI.'images/patterns/pattern_16_thumb.png', 
									),
				'type' => 'select_image',				
				'parent' => array('background_type','0')),
				
		array(	'name' => __('Background Image','midway'),
				'id' => 'background_image',
				'type' => 'uploader',
				'parent' => array('background_type','1')),
				
		array(	'name' => __('Tiled Background','midway'),
					'id' => 'background_fullwidth',
					'description' => __('Check this to use tiled background instead of full width image.','midway'),
					'type' => 'checkbox'),
					
		array(	'name' => __('Heading Font','midway'),					
				'id' => 'heading_font',
				'default' => 'Signika',
				'options' => array(
					'Arial' => 'Arial',					
					'Helvetica' => 'Helvetica',
				),
				'type' => 'select_font'),
				
		array(	'name' => __('Content Font','midway'),
				'id' => 'content_font',
				'default' => 'Open Sans',
				'options' => array(
					'Arial' => 'Arial',					
					'Helvetica' => 'Helvetica',
				),
				'type' => 'select_font'),
				
		//Header
		array(	'name' => __('Header','midway'),
				'type' => 'page'),
				
			array(	'name' => __('Header Layout','midway'),
				'id' => 'header_layout',
				'options' => array(
					'separated'=>THEMEX_URI.'admin/images/layouts/7.png',
					'fullwidth'=>THEMEX_URI.'admin/images/layouts/8.png',
				),
				'type' => 'select_image'),
				
			array(	'name' => __('Header Text','midway'),
				'description' => __('Enter the text to be displayed at the social links.','midway'),
				'id' => 'header_text',
				'default' => '',
				'type' => 'textarea'),
				
			array(	'name' => __('Slider','midway'),
				'type' => 'section'),
				
				array(	'name' => __('Slider Type','midway'),
					'id' => 'slider_type',
					'options' => array('fade' => __('Fade Slider','midway'), 'motion' => __('Motion Slider','midway')),
					'type' => 'select'),
					
			array(	'name' => __('Slider Pause','midway'),
					'default' => '0',
					'id' => 'slider_pause',
					'attributes' => array('min_value' => '0', 'max_value' => '20000', 'unit' => 'ms'),
					'type' => 'slider'),
					
			array(	'name' => __('Transition Speed','midway'),
					'default' => '400',
					'id' => 'slider_speed',
					'attributes' => array('min_value' => '100', 'max_value' => '1000', 'unit' => 'ms'),
					'type' => 'slider'),
				
			array(	'name' => __('Social Links','midway'),
				'type' => 'section'),
				
			array(	'name' => __('RSS Link','midway'),
					'id' => 'rss_link',
					'type' => 'text'),
					
			array(	'name' => __('Facebook Link','midway'),
					'id' => 'facebook_link',
					'type' => 'text'),
					
			array(	'name' => __('Twitter Link','midway'),
					'id' => 'twitter_link',
					'type' => 'text'),
					
			array(	'name' => __('Google Link','midway'),
					'id' => 'google_link',
					'type' => 'text'),

			array(	'name' => __('Flickr Link','midway'),
					'id' => 'flickr_link',
					'type' => 'text'),
					
			array(	'name' => __('Tumblr Link','midway'),
					'id' => 'tumblr_link',
					'type' => 'text'),

			array(	'name' => __('LinkedIn Link','midway'),
					'id' => 'linkedin_link',
					'type' => 'text'),		
					
			array(	'name' => __('YouTube Link','midway'),
					'id' => 'youtube_link',
					'type' => 'text'),
					
			array(	'name' => __('Vimeo Link','midway'),
					'id' => 'vimeo_link',
					'type' => 'text'),
					
			array(	'name' => __('Skype Link','midway'),
					'id' => 'skype_link',
					'type' => 'text'),
					
			array(	'name' => __('Blogger Link','midway'),
					'id' => 'blogger_link',
					'type' => 'text'),
					
			array(	'name' => __('StumbleUpon Link','midway'),
					'id' => 'stumbleupon_link',
					'type' => 'text'),			
					
		//Tours
		array(	'name' => __('Tours','midway'),
				'type' => 'page'),
				
			array(	'name' => __('Tours Layout','midway'),
				'id' => 'tours_layout',
				'options' => array(
					'right'=>THEMEX_URI.'admin/images/layouts/3.png',
					'left'=>THEMEX_URI.'admin/images/layouts/2.png',									
					'fullwidth'=>THEMEX_URI.'admin/images/layouts/1.png',
				),
				'type' => 'select_image'),
				
			array(	'name' => __('Tours View','midway'),
					'id' => 'tours_view',
					'options' => array('grid' => __('Grid','midway'), 'list' => __('List','midway')),
					'type' => 'select'),
					
			array(	'name' => __('Tours Per Page','midway'),
				'id' => 'tours_limit',
				'default' => '12',
				'type' => 'number'),
				
			array(	'name' => __('Price Currency','midway'),
					'id' => 'tours_currency',
					'default' => '$',
					'description' => __('Set price currency symbol.','midway'),
					'type' => 'text'),
					
			array(	'name' => __('Currency Position','midway'),
					'id' => 'tours_currency_position',
					'options' => array('left' => __('Left','midway'), 'right' => __('Right','midway')),
					'type' => 'select'),			
				
			array(	'name' => __('Related Tours Order','midway'),
					'id' => 'tours_related_order',
					'options' => array(
						'rand' => __('Random','midway'), 
						'type' => __('Type','midway'), 'destination' => __('Destination','midway')
					),
					'type' => 'select'),
					
			array(	'name' => __('Hide Related Tours','midway'),
					'id' => 'tours_related',
					'type' => 'checkbox'),

			array(	'name' => __('Disable Booking','midway'),
					'id' => 'tours_booking',
					'description' => __('Check this to disable booking form.','midway'),
					'type' => 'checkbox'),
					
			array(	'name' => __('Disable Questions','midway'),
					'id' => 'tours_questions',
					'description' => __('Check this to disable question form.','midway'),
					'type' => 'checkbox'),
					
		//Gallery
		array(	'name' => __('Galleries','midway'),
				'type' => 'page'),
				
				array(	'name' => __('Galleries Layout','midway'),
				'id' => 'galleries_layout',
				'options' => array(
					'four'=>THEMEX_URI.'admin/images/layouts/5.png',
					'three'=>THEMEX_URI.'admin/images/layouts/6.png',
				),
				'type' => 'select_image'),
				
				array(	'name' => __('Galleries Per Page','midway'),
				'id' => 'galleries_limit',
				'default' => '12',
				'type' => 'number'),
				
				array(	'name' => __('Galleries Caption','midway'),
					'id' => 'galleries_caption',
					'options' => array(
						'visible' => __('Visible', 'midway'),
						'hidden' => __('Hidden', 'midway'),
						'none' => __('None', 'midway'),
					),
					'type' => 'select'),
				
		//Search Form
		array(	'name' => __('Search Form','midway'),
				'type' => 'page'),
				
			array(	'name' => __('Form Title','midway'),
					'id' => 'search_form_title',
					'default' => '',
					'type' => 'text'),
				
			array(	'name' => __('Hide Destination Field','midway'),
					'id' => 'search_form_destination',
					'type' => 'checkbox'),
					
			array(	'name' => __('Hide Type Field','midway'),
					'id' => 'search_form_type',
					'type' => 'checkbox'),
					
			array(	'name' => __('Hide Date Fields','midway'),
					'id' => 'search_form_date',
					'type' => 'checkbox'),
					
			array(	'name' => __('Hide Price Field','midway'),
					'id' => 'search_form_price',
					'type' => 'checkbox'),
					
		//Booking Payments
		array(	'name' => __('Booking Payment','midway'),
				'type' => 'page'),
				
			array(	'name' => __('Enable Booking Payment','midway'),
						'id' => 'booking_payment',
						'type' => 'checkbox'),				
				
			array(	'name' => __('Payment Language','midway'),
				'id' => 'booking_language',
				'options' => array(
					'AU' => __('Australian','midway'), 
					'CN' => __('Chinese','midway'),
					'EN' => __('English','midway'), 
					'FR' => __('French','midway'),
					'DE' => __('German','midway'), 
					'IT' => __('Italian','midway'),
					'JP' => __('Japanese','midway'), 
					'PL' => __('Polish','midway'),
					'ES' => __('Spanish','midway'),
				),
				'type' => 'select'),
				
			array(	'name' => __('Payment Currency','midway'),
				'id' => 'booking_currency',
				'options' => array(
					'AUD' => __('Australian Dollar','midway'), 
					'CAD' => __('Canadian Dollar','midway'),
					'EUR' => __('Euro','midway'),
					'GBP' => __('British Pound','midway'),
					'JPY' => __('Japanese Yen','midway'), 
					'USD' => __('United States Dollar','midway'),
					'NZD' => __('New Zealand Dollar','midway'),
					'CHF' => __('Swiss Franc','midway'),
					'HKD' => __('Hong Kong Dollar','midway'),
					'SGD' => __('Singapore Dollar','midway'),
					'SEK' => __('Swedish Krona','midway'),
					'DKK' => __('Danish Krone','midway'),
					'PLN' => __('Polish Zloty','midway'),
					'NOK' => __('Norwegian Krone','midway'),
					'HUF' => __('Hungarian Forint','midway'),
					'CZK' => __('Czech Koruna','midway'),
					'ILS' => __('Israeli Shekel','midway'),
					'MXN' => __('Mexican Peso','midway'),
					'BRL' => __('Brazilian Real','midway'),
					'MYR' => __('Malaysian Ringgit','midway'),
					'PHP' => __('Philippine Peso','midway'),
					'TWD' => __('New Taiwan Dollar','midway'),
					'THB' => __('Thai Baht','midway'),
					'TRY' => __('Turkish Lira','midway'),
				),
				'type' => 'select'),
				
			array(	'name' => __('Payment Amount','midway'),
				'id' => 'booking_price',
				'default' => '0',
				'description' => __('Enter in the booking fee amount.','midway'),
				'type' => 'number'),
				
			array(	'name' => __('PayPal Account','midway'),
				'id' => 'booking_email',
				'default' => '',
				'description' => __('Enter in your PayPal account email address.','midway'),
				'type' => 'text'),
			
		//Booking Form
		array(	'name' => __('Booking Form','midway'),
				'type' => 'page'),	

			array(	'type' => 'themex_form',
					'id' => 'booking_form' ),			
					
		//Question Form
		array(	'name' => __('Question Form','midway'),
				'type' => 'page'),
				
			array(	'type' => 'themex_form',
					'id' => 'question_form' ),
		
		//Contact Form
		array(	'name' => __('Contact Form','midway'),
				'type' => 'page'),
				
			array(	'type' => 'themex_form',
					'id' => 'contact_form' ),	

		//Custom Sidebars
		array(	'name' => __('Sidebars','midway'),
				'type' => 'page'),
				
			array(	'type' => 'themex_widgetiser',
					'id' => 'themex_widgetiser' ),
				
		//Mailing List
		array(	'name' => __('Mailing List','midway'),
				'type' => 'page'),
				
			array(	'name' => '',
					'id' => 'mailing_list',
					'default' => '',
					'description' => __('This is the list of subcribers from Newsletter Widget.','midway'),
					'type' => 'textarea'),
	),

);
?>