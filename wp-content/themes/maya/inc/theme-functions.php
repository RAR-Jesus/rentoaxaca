<?php
/**
 * Maya Theme Functions
 *
 * @package WordPress
 * @subpackage Maya
 * 
 */
 

// STANDARD FORMAT IN ARCHIVE
add_action('pre_get_posts', 'un_standard_format_fix');

function un_standard_format_fix($query) {

    if (isset($query->query_vars['post_format']) && $query->query_vars['post_format'] == 'post-format-standard') {
        
        if (($post_formats = get_theme_support('post-formats')) && is_array($post_formats[0]) && count($post_formats[0])) {
			
            $terms = array();
            foreach ($post_formats[0] as $format) {
                $terms[] = 'post-format-'.$format;
            }
			
					
            $query->is_tax = null;
            
            unset($query->query_vars['post_format']);
            unset($query->query_vars['taxonomy']);
            unset($query->query_vars['term']);
            unset($query->query['post_format']);

            $query->set('tax_query', array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'post_format',
                    'terms' => $terms,
                    'field' => 'slug',
                    'operator' => 'NOT IN'
                )
            ));
		
        }
    }
    
}


// LIST OF CATEGORY'S SLUGS
function un_categories_slugs( $categories ){
	
	$slugs = '';
	if($categories) {
		foreach($categories as $category){
			$slugs .= $category->slug.' ';
		}
	}
	return $slugs;
	
}


// POST VIEWS FUNCTIONS
function un_getPostViews($postID){
    $count_key = 'un_post_views_count';
    $count = get_post_meta($postID, $count_key, true);

    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }

    if($count==1){
    	return '1 View';
    }

    return $count.' Views'; 
}

function un_setPostViews($postID) {
    $count_key = 'un_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// PAGE NAV
function un_paging_nav($wp_query = NULL) {
	
	if(!$wp_query) {
		global $wp_query, $wp_rewrite;
	}else{
		global $wp_rewrite;
	}

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => '<i class="icon-arrow-left"></i>',
		'next_text' => '<i class="icon-arrow-right"></i>',
	) );

	if ( $links ) :
	
	echo '<div class="blog-nav bg-fs-clr padd-25">';
	echo $links;
	echo '</div>';
	
	endif;
}


// Get Format Icon
function un_format_icon($id) {
	
	$post_format = get_post_format($id);
	if ( false === $post_format ) {
		$post_format = 'standard';
	}

	switch ($post_format) {
		
		case 'standard':
		return '<i class="icon-paper"></i>';
		break;
		
		case 'gallery':
		return '<i class="icon-image"></i>';
		break;
		
		case 'video':
		return '<i class="icon-play"></i>';
		break;
		
		case 'audio':
		return '<i class="icon-bar-graph"></i>';
		break;
		
	}			
		
}


// Customize WP Gallery
add_filter('post_gallery', 'un_post_gallery', 10, 2);

function un_post_gallery($output, $attr) {
    
	global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby']) {
            unset($attr['orderby']);
		}
    }

    if(isset($attr['columns'])) {
		$columns = $attr['columns'];
	}else{
		$columns = '3';
	}
	
	if(isset($attr['orderby'])) {
		$orderby = $attr['orderby'];
	}else{
		$orderby = 'none';
	}
	
	if(isset($attr['include'])) {
		$include = $attr['include'];
	}else{
		$include = '0';
	}	
	
	$order = 'ASC';
	

    if ('rand' == $order) { $orderby = 'none'; }
	
       
	$include = preg_replace('/[^0-9,]+/', '', $include);
	
	$_attachments = get_posts(
		array(
			'include' => $include, 
			'post_status' => 'inherit', 
			'post_type' => 'attachment', 
			'post_mime_type' => 'image', 
			'order' => $order, 
			'orderby' => $orderby,
		)
	);
	
	
	$attachments = array();
	
	foreach ($_attachments as $key => $val) {
		$attachments[$val->ID] = $_attachments[$key];
	}


    if (empty($attachments)) { return ''; }

    //Gallery Wrapper
    $output = '<div class="gallery-list row">';

    // Gallery Images Loop
    foreach ($attachments as $id => $attachment) {

        $img = wp_get_attachment_image_src($id, 'full');
		
		switch($columns) {
			
			case 1:
			$col_class = 'row';
			break;
			
			case 2:
			$col_class = 'col-1-2';
			break;
			
			case 3:
			$col_class = 'col-1-3';
			break;
			
			case 4:
			$col_class = 'col-1-4';
			break;
			
			case 5:
			$col_class = 'col-1-5';
			break;
			
			case 6:
			$col_class = 'col-1-6';
			break;
			
			default:
			$col_class = 'col-1-3';
			break;
			
		}
		
        $output .= '<div class="gallery-box '.$col_class.'">';
		
		$output .= '<div style="background-image: url(\''.$img[0].'\');" class="gallery-thumb">
                        <div class="gallery-caption transit">
                            <div class="gallery-icon"><a class="lightbox" rel="attachment" href="'.$img[0].'"><i class="icon-zoom-in"></i></a></div>
                        </div>                        
                    </div>';
					
        $output .= '</div>';
		
    }

	$output .= '<div class="clear"></div>';
	
    $output .= "</div>";

    return $output;
}




// *************** //
// Section display //
// *************** //

function un_get_section($id){
	
	// Section Data
	$data = vp_metabox( 'un_sections_meta', '', $id );
	
	$html = '';
	
	if($data) {
		
		$data = $data->meta;
	
		
		if($data){
			
			//Section Header
			
			if(!empty($data['title'])) { 
				$sec_title = $data['title'];
			}else{
				$sec_title = '';
			}
			
			if(!empty($data['title_color'])) { 
				$title_color = $data['title_color'];
			}else{
				$title_color = 'rgb(85,85,85)';
			}
			
			if(!empty($data['subtitle'])) { 
				$sec_subtitle = $data['subtitle'];
			}else{
				$sec_subtitle = '';
			}
			
			if(!empty($data['subtitle_color'])) { 
				$subtitle_color = $data['subtitle_color'];
			}else{
				$subtitle_color = 'rgb(85,85,85)';
			}
			
			if(!empty($data['bg_color'])) { 
				$bg_color = $data['bg_color'];
			}else{
				$bg_color = 'rgba(255,255,255,1)';
			}
			
			$header = array(
				'title' => $sec_title, 
				'title_color' => $title_color, 
				'subtitle' => $sec_subtitle, 
				'subtitle_color' => $subtitle_color, 
				'bg_color' => $bg_color,
			);
			
			switch($data['type']) {
				
				case 'blog_1':
				$data = $data['blog_1'];
				$html .= un_section_blog_1($data[0], $header, $id);
				break;
				
				case 'blog_2':
				$data = $data['blog_2'];
				$html .= un_section_blog_2($data[0], $header, $id);
				break;
				
				case 'blog_3':
				$data = $data['blog_3'];
				$html .= un_section_blog_3($data[0], $header, $id);
				break;
				
				case 'callout':
				$data = $data['callout'];
				$html .= un_section_callout($data[0], $header, $id);
				break;
				
				case 'clients':
				$data = $data['clients'];
				$html .= un_section_clients($data[0], $header, $id);
				break;
				
				case 'form':
				$data = $data['form'];
				$html .= un_section_form($data[0], $header, $id);
				break;
				
				case 'counters':
				$data = $data['counters'];
				$html .= un_section_counters($data[0], $header, $id);
				break;
				
				case 'custom':
				$data = $data['custom'];
				$html .= un_section_custom($data[0], $header, $id);
				break;
				
				case 'features':
				$data = $data['features'];
				$html .= un_section_features($data[0], $header, $id);
				break;
				
				case 'map':
				$data = $data['map'];
				$html .= un_section_map($data[0], $header, $id);
				break;
				
				case 'overview':
				$data = $data['overview'];
				$html .= un_section_overview($data[0], $header, $id);
				break;
				
				case 'playground':
				$data = $data['playground'];
				$html .= un_section_playground($data[0], $header, $id);
				break;
				
				case 'portfolio':
				$data = $data['portfolio'];
				$html .= un_section_portfolio($data[0], $header, $id);
				break;
				
				case 'services_1':
				$data = $data['services_1'];
				$html .= un_section_services_1($data[0], $header, $id);
				break;
				
				case 'services_2':
				$data = $data['services_2'];
				$html .= un_section_services_2($data[0], $header, $id);
				break;
				
				case 'team':
				$data = $data['team'];
				$html .= un_section_team($data[0], $header, $id);
				break;
				
				case 'testimonials':
				$data = $data['testimonials'];
				$html .= un_section_testimonials($data[0], $header, $id);
				break;
				
				case 'widgets':
				$data = $data['widgets'];
				$html .= un_section_widgets($data[0], $header, $id);
				break;
				
			}
		
		}
		
	}
	
	return $html;
	
}




// Section Blog 1
function un_section_blog_1($data, $header, $id) {
	
	$html = '';
	$bg_image = wp_get_attachment_image_src($data['bg_image'], 'maya-full');
	$bg_image = $bg_image[0];
	
	// WP_Query arguments
	$args = array (
		'post_status'            => 'publish',
		'pagination'             => false,
		'posts_per_page'         => $data['limit'],
	);
	
	// The Query
	$query = new WP_Query( $args );
	
	// Start Section
	$html .='
	<div id="section-'.$id.'" class="section">
	<div class="blog-content">
	<div class="parallax" style="background-image: url(\''.$bg_image.'\');">
	<div class="blog-layer padd-y-25 bg-bk-alpha">';
	
	if($data['title']){
		$html .='
		<div class="header-section padd-y-75">
		<div class="title-section padd-x-25 wh-clr transit-words">'.$data['title'].'</div>
		</div>';
	}
	                                  
	$html .= '<div class="boxed transit-bouncein" data-delay="0">
	<div id="blog-carousel">';

	
	// The Loop
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			
			$query->the_post();
			
			if( has_post_thumbnail() ){ 
				$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'maya-full', false, '' ); 
				$src = $src[0]; 
			}else{ 
				$src = UN_THEME_URI.'assets/img/default_XL.png'; 
			}
			
			$categories = get_the_category(); 
			$category_link = get_category_link( $categories[0]->term_id );
			$category_name = $categories[0]->cat_name;
			
			// Post Box
			$html .= '
			<div class="blog-box padd-25">
			<div class="blog-date marg-bott-25 wh-clr">
			<a href="'.get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ).'">
			<span class="meta-info">'.get_the_date().'</span>
			</a>
			</div>			
			<div class="blog-thumb" style="background-image: url(\''.$src.'\');">								
			<div class="blog-caption transit">
			<div class="blog-more nd-clr">
			<a href="'.get_permalink().'">'.__('Read More', UN).'</a>
			</div>
			<div class="blog-icon">'.un_format_icon(get_the_ID()).'</div>
			</div>			
			</div>			
			<div class="blog-detail padd-25 bg-gr1-clr">			
			<div class="blog-title fs-clr">
			<a href="'.get_the_permalink().'">'.wp_trim_words( wp_strip_all_tags( get_the_title() ), $num_words = 5, $more = '...' ).'</a>
			</div>								
			<div class="blog-meta">
			<span class="blog-author"><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a></span> / 
			<span class="blog-cat"><a href="'.$category_link.'">'.$category_name.'</a></span>
			</div>			
			<div class="line-center brd-gr2-clr"></div>			
			<div class="blog-exc">
			'.wp_trim_words( wp_strip_all_tags( strip_shortcodes(get_the_content()) ), $num_words = 15, $more = '...' ).'
			</div>			
			</div>			
			</div>';
			
		}
	} else {
		$html .= __('No published posts found', UN);
	}
	
	// Restore original Post Data
	wp_reset_postdata();
	
	// End Section
	$html .= '                     
	</div>
	<div class="clear"></div>   
	</div>
	</div>                        
	</div>
	</div>
	</div>';
	
	// Return the code
	return $html;
	
}




// Section Blog 2
function un_section_blog_2($data, $header, $id) {
	
	$html = '';
	
	// WP_Query arguments
	$args = array (
		'post_status'            => 'publish',
		'pagination'             => false,
		'posts_per_page'         => $data['limit'],
	);
	
	// The Query
	$query = new WP_Query( $args );
	
	// Start Section
	$html .='
	<div id="section-'.$id.'" class="section">';
	
	// Section Header
	$html .= un_section_header($header);
	
	$html .='<div class="blog-content">        
	<div class="blog-list">
	<div class="boxed">';
	
	// The Loop
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			
			if( has_post_thumbnail() ){ 
				$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'maya-full', false, '' ); 
				$src = $src[0]; 
			}else{ 
				$src = UN_THEME_URI.'assets/img/default_XL.png'; 
			}
			
			$categories = get_the_category(); 
			$category_link = get_category_link( $categories[0]->term_id );
			$category_name = $categories[0]->cat_name;
			
			// Post Row
			$html .= '<div class="blog-row">';	
					
			if ($query->current_post % 2 == 0){
			
				$html .= '
				<div class="col-1-2 transit-left">			
				<div class="blog-box padd-25">			
				<div class="blog-thumb" style="background-image: url(\''.$src.'\');">			
				<div class="blog-caption transit">
				<div class="blog-more nd-clr">
				<a href="'.get_permalink().'">'.__('Read More', UN).'</a>
				</div>
				<div class="blog-icon">'.un_format_icon(get_the_ID()).'</div>
				<div class="blog-date marg-bott-25 fs-col">
				<a href="'.get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ).'">'.get_the_date().'</a>
				</div>
				</div>			
				</div>			
				</div>			
				</div>';
			
			} // Image Sx 
			
			$html .= '
			<div class="col-1-2 transit-top">			
			<div class="blog-box padd-25">			
			<div class="blog-detail marg-top-50">			
			<div class="blog-title padd-x-25 fs-clr">
			<a href="'.get_the_permalink().'">'.wp_trim_words( wp_strip_all_tags( get_the_title() ), $num_words = 5, $more = '...' ).'</a>
			</div>			
			<div class="blog-meta">
			<span class="blog-author"><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a></span> / 
			<span class="blog-cat"><a href="'.$category_link.'">'.$category_name.'</a></span>
			</div>			
			<div class="line-center line-grey"></div>			
			<div class="blog-exc padd-x-25">'.wp_trim_words( wp_strip_all_tags( strip_shortcodes(get_the_content()) ), $num_words = 15, $more = '...' ).'</div>			
			</div>			
			</div>			
			</div>';
			
			if ($query->current_post % 2 == 1){
			
				$html .= '
				<div class="col-1-2 transit-right">			
				<div class="blog-box padd-25">			
				<div class="blog-thumb" style="background-image: url(\''.$src.'\');">			
				<div class="blog-caption transit">
				<div class="blog-more nd-clr">
				<a href="'.get_permalink().'">'.__('Read More', UN).'</a>
				</div>
				<div class="blog-icon">'.un_format_icon(get_the_ID()).'</div>
				<div class="blog-date marg-bott-25 fs-col">
				<a href="'.get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ).'">'.get_the_date().'</a>
				</div>
				</div>			
				</div>			
				</div>			
				</div>';
			
			} // Image Dx 
			
			$html .= '
			<div class="clear"></div>			
			</div>';
			
		}
	} else {
		$html .= __('No published posts found', UN);
	}
	
	// Restore original Post Data
	wp_reset_postdata();
	
	// End Section
	$html .= '
	<div class="clear"></div>                        
	</div>            
	</div>                        
	</div>    
	</div>';
	
	// Return the code
	return $html;
	
}




// Section Blog 3
function un_section_blog_3($data, $header, $id) {
	
	$html = '';
	$bg_image = wp_get_attachment_image_src($data['bg_image'], 'maya-full');
	$bg_image = $bg_image[0];
	
	// WP_Query arguments
	$args = array (
		'post_status'            => 'publish',
		'pagination'             => false,
		'posts_per_page'         => $data['limit'],
	);
	
	// The Query
	$query = new WP_Query( $args );
	
	// Start Section
	$html .='
	<div id="section-'.$id.'" class="section">';
	
	// Section Header
	$html .= un_section_header($header);
	
	$html .='<div class="blog-content">
	<div class="parallax" style="background-image: url(\''.$bg_image.'\');">
	<div class="blog-layer padd-y-25 bg-fs-alpha">    
	<div class="boxed transit-bouncein">';
	
	// The Loop
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			
			if( has_post_thumbnail() ){ 
				$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'maya-full', false, '' ); 
				$src = $src[0]; 
			}else{ 
				$src = UN_THEME_URI.'assets/img/default_XL.png'; 
			}
			
			$categories = get_the_category(); 
			$category_link = get_category_link( $categories[0]->term_id );
			$category_name = $categories[0]->cat_name;
			
			// Post Box
			$html .= '
			<div class="col-1-3">
			<div class="blog-box padd-25">
			<div class="blog-date marg-bott-25">
			<a href="'.get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ).'">
			<span class="meta-info">'.get_the_date().'</span>
			</a>
			</div>                
			<div class="blog-detail padd-25 bg-wh-clr">
			<div class="blog-title fs-clr">
			<a href="'.get_the_permalink().'">'.wp_trim_words( wp_strip_all_tags( get_the_title() ), $num_words = 5, $more = '...' ).'</a>
			</div>                
			<div class="blog-meta">
			<span class="blog-author"><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a></span> / 
			<span class="blog-cat"><a href="'.$category_link.'">'.$category_name.'</a></span>
			</div>
			<div class="line-center brd-gr2-clr"></div>
			<div class="blog-exc">
			'.wp_trim_words( wp_strip_all_tags( strip_shortcodes(get_the_content()) ), $num_words = 15, $more = '...' ).'
			</div>
			</div>
			</div>
			</div>';
			
		}
	} else {
		$html .= __('No published posts found', UN);
	}
	
	// Restore original Post Data
	wp_reset_postdata();
	
	// End Section
	$html .= '
	<div class="clear"></div>
	</div>
	</div>
	</div>
	</div>
	</div>';
	
	// Return the code
	return $html;
	
}




// Section Callout
function un_section_callout($data, $header, $id) {
	
	$html = '
	<div id="section-'.$id.'" class="callout section">
	<div class="parallax">
	<div class="callout-layer padd-y-100">
	<div class="callout-content padd-x-25">
	<div class="callout-title marg-bott-25 nd-clr transit-words">'.$data['title'].'</div>
	<div class="callout-exc marg-bott-25">'.$data['excerpt'].'</div>
	</div>
	</div>
	</div>
	</div>';
	
	// Return the code
	return $html;
	
}




// Section Clients
function un_section_clients($data, $header, $id) {
	
	
	// Start Section
	$html = '
	<div id="section-'.$id.'" class="section">';
	
	// Section Header
	$html .= un_section_header($header);
	
	$html .= '<div class="clients-content padd-y-50 bg-fs-clr">
	<div class="boxed">
	<div class="client-list" id="clients-carousel">';
	
	$delay = 0;
	
	foreach($data['client'] as $client) {
		
		if($client['logo']) {
			$logo = wp_get_attachment_image_src($client['logo'], 'maya-full');
			$logo = $logo[0];
		}else{
			$logo = UN_THEME_URI.'assets/img/default_XS.png';
		}
		
		if($delay <= 1000){
			$html .='<div class="client-thumb marg-25 transit-top" data-delay="'.$delay.'">';
		}else{
			$html .='<div class="client-thumb marg-25">';
		}
		
		if($client['url']){
			$html .='<a href="'.$client['url'].'" data-curtain="false" target="_blank"><img src="'.$logo.'" style="max-width: 150px;" alt=""></a>';
		}else{
			$html .='<img src="'.$logo.'" style="max-width: 150px;" alt="">';
		}
		
		$html .='</div>';	
		
		$delay = $delay + 200;
		
	}
	
	// End Section
	$html .= '
	</div>
	</div> 
	</div>
	</div>';
	
	// Return the code
	return $html;
	
}




// Section Form
function un_section_form($data, $header, $id) {
	
	if (isset($_SERVER['HTTPS'])) {
		$action = 'https://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	}else{
		$action = 'http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	}
	
	$html = '
	<div id="section-'.$id.'" class="section">';
	
	// Section Header
	$html .= un_section_header($header);
	
	$html .= '<div class="form-content padd-bott-50">
	<div class="boxed">
	<div class="col-2-3">
	<div class="form-box marg-25 transit-bottom">';
	if (!empty($data['cf7'])){
		$html .= do_shortcode('[contact-form-7 id="'.$data['cf7'].'"]'); 
	}else{
		$html .= __('Select a CF7\'s Form in the section options', UN);
	}
	$html .= '</div>
	</div>
	<div class="col-1-3">
	<div class="contact-content transit-top">
	<div class="contact-message padd-25">'.$data['content'].'</div>    
	</div>
	</div>
	<div class="clear"></div>                            
	</div>
	</div>
	</div>';
	
	// Return the code
	return $html;
	
}




// Section Counters
function un_section_counters($data, $header, $id) {
	
	$bg_image = wp_get_attachment_image_src($data['bg_image'], 'maya-full');
	$bg_image = $bg_image[0];
	
	// Start Section
	$html = '
	<div id="section-'.$id.'" class="counters section">';
	
	// Section Header
	$html .= un_section_header($header);
	
	$html .= '<div class="count-content">
	<div class="parallax" style="background-image: url(\''.$bg_image.'\');">
	<div class="count-layer padd-y-50 '.$data['overlayer'].'">
	<div class="boxed">';
	
	foreach($data['counter'] as $counter) {
		
		if($data['overlayer'] == 'bg-fs-alpha') {
			
			$icon = $counter['icon'].' wh-clr';
			$line = 'brd-gr1-clr brd-wh-clr';
			$value = 'wh-clr wh-clr';
			$title = 'wh-clr';
			
		}else{
			
			$icon = $counter['icon'].' nd-clr';
			$line = 'brd-gr3-clr brd-nd-clr';
			$value = 'nd-clr nd-clr';
			$title = 'nd-clr';
			
		}
		
		$html .='
		<div class="col-1-4">
		<div class="count-box padd-25">
		<div class="count-icon"><i class="'.$icon.'"></i></div>
		<div class="line-center '.$line.'"></div>
		<div class="count-value '.$value.'" data-speed="1000" data-from="'.$counter['from'].'" data-to="'.$counter['to'].'">'.$counter['from'].'</div>
		<div class="count-title '.$title.'">'.$counter['label'].'</div>
		</div>
		</div>';	
		
		
	}
	
	// End Section
	$html .= '
	<div class="clear"></div>
	</div>
	</div>
	</div>
	</div>
	</div>';
	
	// Return the code
	return $html;
	
}




// Section Custom Html
function un_section_custom($data, $header, $id) {
	
	$html = '
	<div id="section-'.$id.'" class="section">';
	
	// Section Header
	$html .= un_section_header($header);
	
	// Get Section Style
	$styles = '';
	$classes = '';
	$paddings = '';
	$overlay = '';
	$content_classes = '';
	
	if(!empty($data['bg_image'])){
		$bg_image = $data['bg_image'];
	}else{
		$bg_image = '';
	}
	
	if(!empty($data['bg_parallax'])){
		$bg_parallax = $data['bg_parallax'];
	}else{
		$bg_parallax = '';
	}
	
	if(!empty($data['bg_color'])) { 
		$bg_color = $data['bg_color']; 
	}else{ 
		$bg_color = 'rgba(255,255,255,1)'; 
	}
	
	if(!empty($data['bg_width'])) { 
		$bg_width = $data['bg_width'];
	}else{
		$bg_width = '';
	}
	
	if(!empty($data['padding_top'])) {
		$paddings .= 'padding-top: '.$data['padding_top'].'px;';
	}
	
	if(!empty($data['padding_bottom'])) {
		$paddings .= ' padding-bottom: '.$data['padding_bottom'].'px;';
	}
	
	if(!empty($data['padding_left'])) {
		$paddings .= ' padding-left: '.$data['padding_left'].'px;';
	}
	
	if(!empty($data['padding_right'])) {
		$paddings .= ' padding-right: '.$data['padding_right'].'px;';
	}
	
	if(!empty($data['bg_overlay'])) {
		$overlay .= ' background: '.$data['bg_overlay'].';';
	}
	
	if(!empty($data['content_width'])) { 
		$content_width = $data['content_width'];
	}else{
		$content_width = '';
	}
	
	
	if($bg_image){
		
		$bg_image = wp_get_attachment_image_src($bg_image, 'maya-full');
		$bg_image = $bg_image[0];
		
		$styles = 'background-image: url(\''.$bg_image.'\'); background-color: '.$bg_color.'; ';
		
	}else{
		
		$styles = 'background-color: '.$bg_color.'; ';
		
	}	
	
	if($bg_parallax) {
		$classes .= 'parallax';
	}
	
	if($bg_width == 'boxed' && $content_width == 'boxed') {
		$classes .= ' boxed';
	}
	
	if($content_width == 'boxed') {
		$content_classes .= ' boxed';
	}
	
	$html .= '<div class="'.$classes.'" style="'.$styles.'">';
	
	$html .= '<div style="'.$overlay.' width:100%; height: 100%;">';

	$html .= '<div class="'.$content_classes.'" style="box-sizing: border-box; '.$paddings.'">'.do_shortcode($data['content']).'</div>';
	
	$html .= '</div>';
		
	$html .= '</div>';
	$html .= '</div>';
	
	// Return the code
	return $html;
	
}




// Section Features
function un_section_features($data, $header, $id) {
	
	// Start Section
	$html = '
	<div id="section-'.$id.'" class="section">';
	
	// Section Header
	$html .= un_section_header($header);
	
	$html .= '<div class="feat-content">
	<div class="feat-list padd-y-50">
	<div class="boxed">';
	
	foreach($data['feature'] as $feature) {
		
		if(isset($feature['url'])) {
			$icon = '<a href="'.$feature['url'].'"><i class="'.$feature['icon'].'"></i></a>';
		}else{
			$icon = '<i class="'.$feature['icon'].'"></i>';
		}
		
		$html .='		
		<div class="col-1-3 transit-bottom">
		<div class="feat-box marg-25">
		<div class="feat-icon fs-clr brd-fs-clr bg-fs-clr-hov transit">'.$icon.'</div>
		<div class="feat-title fs-clr">'.$feature['title'].'</div>
		<div class="line-center brd-gr2-clr"></div>
		<div class="feat-exc">'.$feature['excerpt'].'</div>
		</div>
		</div>';	
		
		
	}
	
	// End Section
	$html .= '
	<div class="clear"></div>
	</div>
	</div>
	</div>
	</div>';
	
	// Return the code
	return $html;
	
}



// Section Map
function un_section_map($data, $header, $id) {
	
	$html = '';
	
	if(isset($data['lat']) && isset($data['lng'])) {
		
		$map_coord = array($data['lat'], $data['lng']);
		
		// Start Section
		$html .= '
		<div id="section-'.$id.'" class="section">';
		
		// Section Header
		$html .= un_section_header($header);
		
		$html .= '<div class="map-content">
		<div class="row">
		<div data-zoom="'.$data['zoom'].'" data-color="'.$data['color'].'" data-saturation="-50" class="gmap" id="gmap" data-lat="'.$map_coord[0].'" data-lng="'.$map_coord[1].'"></div>
		<div id="gmap_markers">';
		
		foreach($data['marker'] as $marker) {
			
			if(!empty($marker['lat']) && !empty($marker['lng'])) {
				
				$mark_coord = array($marker['lat'], $marker['lng']);
				
				$html .='<div class="marker-wrap" data-markericon=\''.UN_THEME_URI.'assets/img/marker.png\' data-lat=\''.$mark_coord[0].'\' data-lng=\''.$mark_coord[1].'\'><div class="mark-wrapper">'.$marker['content'].'</div></div>';	
			
			}else{
				
				$marker_error = '<blockquote class="marg-25"><p>'.__('You have to insert the coordinates for all your markers.', UN).'</p></blockquote>';
				
			}
			
		}
		
		$html .= '</div>'; // /gmap_markers
		
		if (isset($marker_error)){
			$html .= $marker_error;
		}
		
		// End Section
		$html .= '
		</div>
		</div>
		</div>';
	
	}else{
		
		$html .= '<div id="section-'.$id.'" class="section"><div class="row">'; 
		
		$html .= '<div class="boxed padd-y-50"><blockquote><p>'.__('You have to insert the coordinates in this map section.', UN).'</p></blockquote></div>';
		
		$html .= '</div></div>';
		
	}
	
	// Return the code
	return $html;
	
}



// Section Overview
function un_section_overview($data, $header, $id) {
	
	$bg_image = wp_get_attachment_image_src($data['bg_image'], 'maya-full');
	$bg_image = $bg_image[0];
	
	// Start Section
	$html = '<div id="section-'.$id.'" class="section">';
	
	// Section Header
	$html .= un_section_header($header);
	
	$html .= '<div class="overw-content">
	<div class="parallax" style="background-image: url(\''.$bg_image.'\');">	
	<div class="overw-list padd-y-75 '.$data['overlayer'].'">
	<div class="boxed">';
	
	foreach($data['feature'] as $feature) {
				
		$html .='
		<div class="col-1-4">
		<div class="overw-box padd-25 transit-bouncein">
		<div class="overw-icon fs-clr-hov transit"><i class="'.$feature['icon'].'"></i></div>
		<div class="overw-title marg-y-25">'.$feature['title'].'</div>
		<div class="line-center brd-gr2-clr"></div>
		<div class="overw-exc">'.$feature['excerpt'].'</div>
		</div>
		</div>';	
		
		
	}
	
	// End Section
	$html .= '
	<div class="clear"></div>
	</div>
	</div>
	</div>
	</div>
	</div>';
	
	// Return the code
	return $html;
	
}




// Section Playground
function un_section_playground($data, $header, $id) {
	/*
	// Section Header
	$html = un_section_header($header);
	
	$html .= '
	<div id="section-'.$id.'" class="section">';
	
	if(!empty($data['url'])) {
	
	
		if($data['volume'] == '1'){
			$html .= '<a id="volume"><i class="icon-volume"></i></a>';
		}
		
		$html .= '<div class="video-box player" id="internal-video" data-property="{videoURL:\''.esc_attr($data['url']).'\', containment:\'self\', showControls:false, autoPlay:true, mute:true, startAt:0, opacity:1}">
		</div>';
		
		if(!empty($data['title']) || !empty($data['subtitle'])){
			$html .= '
			<div class="video-message">
			<div class="video-title wh-clr transit-bottom">'.$data['title'].'</div>
			<div class="line-center brd-wh-clr transit-top"></div>
			<div class="video-subtitle wh-clr transit-top">'.$data['subtitle'].'</div>               
			</div>';
		}
	
	}else{
		$html .= '<center><h1>'.__('Youtube URL is missing', UN).'</h1></center>';
	}
	
	$html .= '</div>';
	*/
	
	// Return the code
	return __('<center><blockquote class="marg-top-50">The playground section is no longer available. Please edit this section switching to another section type.</blockquote></center>', UN);
	
}




// Section Portfolio
function un_section_portfolio($data, $header, $id) {
	
	$html = '';
	
	// Projetcs Query
	if ( empty($data['category_filter']) || in_array('all', $data['category_filter']) ) {
	
		$args = array (
			'post_type'              => 'un-portfolio',
			'post_status'            => 'publish',
			'pagination'             => false,
			'posts_per_page'         => $data['limit'],
		);
		
		$query = new WP_Query( $args );
		
	}else{
		
		$args = array (
			'post_type'              => 'un-portfolio',
			'post_status'            => 'publish',
			'pagination'             => false,
			'posts_per_page'         => $data['limit'],
			'tax_query' => array(
				array(
					'taxonomy' => 'un-portfolio-categories',
					'field' => 'id',
					'terms' => $data['category_filter'],
				),
			),
		);
		
		$query = new WP_Query( $args );
		
	}
	
	// Terms Query
	if ( !empty($data['category_filter']) && in_array('all', $data['category_filter']) ) {
		
		$terms_args = array(
			'orderby'           => 'name', 
			'order'             => 'ASC',
			'hide_empty'        => true,
		); 
		
		$terms_wp = get_terms('un-portfolio-categories', $terms_args);
		
		foreach($terms_wp as $term){
			
			$terms[] = array(
				'name' => $term->name,
				'slug' => $term->slug,			
			);
			
		}
		
	}else{
		
		$terms_selected = $data['category_filter'];
		
		foreach($terms_selected as $term){
			
			$term_data = get_term( $term, 'un-portfolio-categories' );
			$term_name = $term_data->name;
			$term_slug = $term_data->slug;
			
			$terms[] = array(
				'name' => $term_name,
				'slug' => $term_slug,			
			);
	
		}
		
	}	
	
	
	// Start Section
	$html .= '	
	<div id="section-'.$id.'" class="section">';
	
	// Section Header
	$html .= un_section_header($header);
	
	$html .= '<div class="port-content '.$data['width'].'">
	<div class="port-filter marg-y-50">
	<ul>
	<li class="fs-clr bg-fs-clr-hov transit selected" data-filter="all">All</li>';
	
	foreach($terms as $term){
		$html .= '<li class="fs-clr bg-fs-clr-hov transit" data-filter="'.$term['slug'].'">'.$term['name'].'</li>';
	}
	
	$html .= '</ul>
	</div>
	<div class="port-list row">';
	
	// The Loop
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			
			if( has_post_thumbnail() ){ 
				$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'maya-full', false, '' ); 
				$src = $src[0]; 
			}else{ 
				$src = UN_THEME_URI.'assets/img/default_XL.png'; 
			}
			
			$categories = wp_get_post_terms( get_the_ID(), 'un-portfolio-categories' );
			$slugs = un_categories_slugs($categories);
		
			$html .= '
			<div class="col-1-3 '.$data['padding'].' '.$slugs.' all">
			<div class="port-item" style="background-image: url(\''.$src.'\');">
			<div class="port-caption transit">
			<div class="port-title marg-top-75 marg-left-25 marg-right-25">
			<a href="'.get_the_permalink().'">'.wp_trim_words( wp_strip_all_tags( get_the_title() ), $num_words = 5, $more = '...' ).'</a>
			</div>
			<div class="line-center brd-gr2-clr"></div>
			<div class="port-icon">'.un_format_icon(get_the_ID()).'</div>
			</div>
			</div>
			</div>
			';
						
		}
	} else {
		$html .= __('No published projects found', UN);
	}
	
	// Restore original Post Data
	wp_reset_postdata();
	
	// End Section
	$html .= '
	<div class="clear"></div>
	</div>
	</div>
	</div>';
	
	// Return the code
	return $html;
	
}




// Section Services 1
function un_section_services_1($data, $header, $id) {
	
	$bg_image = wp_get_attachment_image_src($data['bg_image'], 'maya-full');
	$bg_image = $bg_image[0];
	
	// Start Section
	$html = '
	<div id="section-'.$id.'" class="section">';
	
	// Section Header
	$html .= un_section_header($header);
	
	$html .= '<div class="serv-content">
	<div class="serv-list parallax" style="background-image: url(\''.$bg_image.'\');">
	<div class="serv-layer padd-y-25 bg-bk-alpha">
	<div class="boxed">
	<div id="serv-carousel">';
	
	foreach($data['service'] as $service) {
				
		$html .='
		<div>
		<div class="serv-box padd-25 marg-25 brd-wh-clr">
		<div class="serv-icon wh-clr"><i class="'.$service['icon'].'"></i></div>
		<div class="serv-title wh-clr">'.$service['title'].'</div>
		<div class="line-center brd-wh-clr"></div>
		<div class="serv-exc wh-clr">'.$service['excerpt'].'</div>
		</div>
		</div>';	
		
		
	}
	
	// End Section
	$html .= '
	</div>
	<div class="clear"></div>
	</div>
	</div>
	</div>
	</div>
	</div>';
	
	// Return the code
	return $html;
	
}




// Section Services 2
function un_section_services_2($data, $header, $id) {

	
	// Start Section
	$html = '
	<div id="section-'.$id.'" class="section">';
	
	// Section Header
	$html .= un_section_header($header);
	
	$html .='<div class="serv-content">
	<div class="serv-list">
	<div class="serv-layer padd-y-25">
	<div class="boxed">';
	
	foreach($data['service'] as $service) {
				
		$html .='
		<div class="col-1-3">
		<div class="serv-box padd-25 marg-25 transit-top brd-wh-clr">
		<div class="serv-icon nd-clr"><i class="'.$service['icon'].'"></i></div>
		<div class="serv-title nd-clr">'.$service['title'].'</div>
		<div class="line-center brd-gr2-clr"></div>
		<div class="serv-exc">'.$service['excerpt'].'</div>
		</div>
		</div>';	
		
		
	}
	
	// End Section
	$html .= '
	<div class="clear"></div>
	</div>
	</div>
	</div> 
	</div>
	</div>';
	
	// Return the code
	return $html;
	
}




// Section Team
function un_section_team($data, $header, $id) {
		
	// Start Section
	$html = '
	<div id="section-'.$id.'" class="section">';
	
	// Section Header
	$html .= un_section_header($header);
	
	$html .= '<div class="team-content bg-gr1-clr">
	<div class="team-list padd-y-25">
	<div class="boxed">';
	
	foreach($data['person'] as $person) {
		
		// Person Image
		$person_image = wp_get_attachment_image_src($person['image'], 'maya-full');
		$person_image = $person_image[0];
		
		// Custom Url
		if(!empty($person['url'])){
			$href = 'href="'.$person['url'].'"';
		}else{
			$href = '';
		}
				
		$html .='
		<div class="col-1-4">
		<div class="team-box marg-25 transit-top">
		<a class="team-thumb" '.$href.' style="background-image: url(\''.$person_image.'\');">
		<div class="team-caption transit">
		<div class="team-name marg-top-25 fs-clr">'.$person['name'].'</div>
		<div class="line-center brd-gr2-clr"></div>
		<div class="team-skills">
		<ul>
		<li><div class="bar-bg"><div class="bar-val" style="width: '.$person['skill1_value'].'%;"><div class="bar-label">'.$person['skill1_label'].'</div></div></div></li>
		<li><div class="bar-bg"><div class="bar-val" style="width: '.$person['skill2_value'].'%;"><div class="bar-label">'.$person['skill2_label'].'</div></div></div></li>
		<li><div class="bar-bg"><div class="bar-val" style="width: '.$person['skill3_value'].'%;"><div class="bar-label">'.$person['skill3_label'].'</div></div></div></li>
		</ul>                            
		</div>
		</div>
		</a>
		<div class="team-detail padd-x-25 fs-clr brd-fs-clr">
		<a class="team-role" '.$href.'>'.$person['role'].'</a>
		<span class="team-contact"><a href="mailto:'.$person['email'].'" data-curtain="false"><i class="icon-mail"></i></a></span>
		</div>
		</div>
		</div>';	
		
		
	}
	
	// End Section
	$html .= '
	<div class="clear"></div>
	</div>
	</div>
	</div>
	</div>';
	
	// Return the code
	return $html;
	
}




// Section Testimonials
function un_section_testimonials($data, $header, $id) {
	
	$bg_image = wp_get_attachment_image_src($data['bg_image'], 'maya-full');
	$bg_image = $bg_image[0];
	
	// Start Section
	$html = '
	<div id="section-'.$id.'" class="section">';
	
	// Section Header
	$html .= un_section_header($header);
	
	$html .= '<div class="quote-content">
	<div class="parallax" style="background-image: url(\''.$bg_image.'\');">
	<div class="quote-layer padd-y-50 bg-nd-alpha transit-top">
	<div id="quote-carousel">';
	
	foreach($data['testimonial'] as $testimonial) {
		
		$person_image = wp_get_attachment_image_src($testimonial['image'], 'maya-full');
		$person_image = $person_image[0];
	
		$html .='
		<div class="quote-message">
		<div class="quote-thumb" style="background-image: url(\''.$person_image.'\');"></div>
		<div class="quote-exc padd-x-25">'.$testimonial['message'].'</div>
		<div class="line-center brd-gr2-clr"></div>                
		<div class="quote-author padd-x-25">'.$testimonial['name'].'</div>
		</div>';		
		
	}
	
	// End Section
	$html .= '
	 
	</div>
	</div>
	</div>
	</div>
	</div>';
	
	// Return the code
	return $html;
	
}




// Section Widgets
function un_section_widgets($data, $header, $id) {
	
	// Get Sidebars
	ob_start();
	dynamic_sidebar($data['sidebar1']);
	$sidebar1 = ob_get_contents();
	ob_end_clean();
	
	ob_start();
	dynamic_sidebar($data['sidebar2']);
	$sidebar2 = ob_get_contents();
	ob_end_clean();
	
	ob_start();
	dynamic_sidebar($data['sidebar3']);
	$sidebar3 = ob_get_contents();
	ob_end_clean();
	
	$html = '
	<div id="section-'.$id.'" class="section widgets">';
	
	// Section Header
	$html .= un_section_header($header);
	
	$html .= '<div class="widget-content padd-y-50 bg-fs-clr">
	<div class="boxed">
	<div class="col-1-3"><ul>'.$sidebar1.'</ul></div>
	<div class="col-1-3"><ul>'.$sidebar2.'</ul></div>
	<div class="col-1-3"><ul>'.$sidebar3.'</ul></div>
	<div class="clear"></div>
	</div>
	</div>
	</div>';
	
	// Return the code
	return $html;
	
}




// Section Intro Slider
function un_section_introslider($intro, $sections) {
	
	//Dotted Overlay
	if(!empty($intro['dotted']) && $intro['dotted'] == '1'){
		$dotted = 'dotted';
	}else{
		$dotted = '';
	}
	
	// Start Section
	$html = '
	<div id="intro" class="section">
	<div id="intro-slideshow">';
	
	foreach($intro['slide'] as $slide) {
		
		$image = wp_get_attachment_image_src($slide['image'], 'maya-full');
		$image = $image[0];
	
		$html .='
		<div>
		<span class="item-image '.$dotted.'" style="background-image: url(\''.$image.'\');"></span>
		<div class="intro-message">';
		
		if($slide['title']) {
			$html .='<div class="intro-title padd-x-50">'.$slide['title'].'</div>';
		}
		
		if($slide['subtitle']) {
			$html .='<div class="intro-subtitle marg-x-50 bg-fs-clr">'.$slide['subtitle'].'</div>';  
		}
		
		$html .='
		</div>  
		</div>';		
		
	}
	
	$html .= '</div>';	
	
	// Onepage Navy
	if($intro['onepage'] == 1){	
		
		$html .= '<div id="icons-menu" class="transit-top" data-delay="1500" data-appear="false">';
		
		$html .='<ul>';
		
		foreach($sections['section'] as $section) {
			
			if($section['icon'] && $section['icon'] != 'no-icon'){
				$html .= '<li data-title="'.$section['iconlabel'].'" data-scrollto="#section-'.$section['id'].'"><i class="'.$section['icon'].'"></i></li>';
			}
		
		}
		
		$html .='</ul>';
		
		$html .= '</div>';
	
	}
			
	// Botton Arrow
	if($intro['bottonarrow'] == 1){	
		
		$first_section = $sections['section'];
		$first_section  = $first_section[0];
		
		$html .='
		<div class="btn-down brd-wh-clr brd-fs-clr-hov transit-bouncein" data-delay="2000" data-appear="false" data-scrollto="#section-'.$first_section['id'].'">
		<i class="icon-arrow-down"></i>
		</div>';
	
	}
		
	// End Section
	$html .= '</div>';
	
		
	// Return the code
	return $html;
	
}




// Section Intro Video
function un_section_introvideo($intro, $sections) {
	
	//Dotted Overlay
	if(!empty($intro['dotted']) && $intro['dotted'] == '1'){
		$dotted = 'dotted';
	}else{
		$dotted = '';
	}
	
	// Video Data
	if($intro['url']){
		$url = $intro['url'];
		$player = 'player';
	}else{
		$url = '';
		$player = '';
	}
	
	if($intro['mute'] == 1) {
		$mute = 'true'; 
	}else{
		$mute = 'false';
	}
	
	if($intro['controls'] == 1) {
		$controls = 'true';
	}else{
		$controls = 'false';
	}
	
	if($intro['autoplay'] == 1) {
		$autoplay = 'true';
	}else{
		$autoplay = 'false';
	}
	
	if($intro['startat']) {
		$startat = $intro['startat'];
	}else{
		$startat = '0';
	}
	
	
	// Start Section
	$html = '
	<div id="intro" class="section '.$player.' '.$dotted.'" data-property="{videoURL:\''.esc_attr($url).'\',containment:\'self\', showControls:'.$controls.', autoPlay:'.$autoplay.', loop:false, mute:'.$mute.', startAt:'.$startat.', opacity:1, addRaster:false, quality:\'highres\'}">';	
	
	// Onepage Navy
	if($intro['onepage'] == 1){	
		
		$html .= '<div id="icons-menu" class="transit-top" data-delay="1500" data-appear="false">';
		
		$html .='<ul>';
		
		foreach($sections['section'] as $section) {
			
			if($section['icon'] && $section['icon'] != 'no-icon'){
				$html .= '<li data-title="'.esc_attr($section['iconlabel']).'" data-scrollto="#section-'.$section['id'].'"><i class="'.$section['icon'].'"></i></li>';
			}
		
		}
		
		$html .='</ul>';
		
		$html .= '</div>';
	
	}
			
	// Botton Arrow
	if($intro['bottonarrow'] == 1 && $sections['section']){	
		
		$first_section = $sections['section'];
		$first_section  = $first_section[0];
		
		$html .='
		<div class="btn-down brd-wh-clr brd-fs-clr-hov transit-bouncein" data-delay="2000" data-appear="false" data-scrollto="#section-'.$first_section['id'].'">
		<i class="icon-arrow-down"></i>
		</div>';
	
	}
		
	// End Section
	$html .= '</div>';
	
		
	// Return the code
	return $html;
	
}




// Section Intro Parallax
function un_section_introparallax($intro, $sections) {
	
	//Dotted Overlay
	if(!empty($intro['dotted']) && $intro['dotted'] == '1'){
		$dotted = 'dotted';
	}else{
		$dotted = '';
	}
	
	$bg_image = wp_get_attachment_image_src($intro['image'], 'maya-full');
	$bg_image = $bg_image[0];
	
	// Start Section
	$html = '
	<div id="intro" class="section">
	<div class="parallax '.$dotted.'" style="background-image: url(\''.$bg_image.'\')"></div>
	<div class="intro-message">';
	
	if($intro['title']) {
		$html .='<div class="intro-title padd-x-50">'.$intro['title'].'</div>';
	}
	
	if($intro['subtitle']) {
		$html .='<div class="intro-subtitle marg-x-50 bg-fs-clr">'.$intro['subtitle'].'</div>';  
	}
	
	$html .='</div>';
	
	// Onepage Navy
	if($intro['onepage'] == 1){	
		
		$html .= '<div id="icons-menu" class="transit-top" data-delay="1500" data-appear="false">';
		
		$html .='<ul>';
		
		foreach($sections['section'] as $section) {
			
			if($section['icon'] && $section['icon'] != 'no-icon'){
				$html .= '<li data-title="'.esc_attr($section['iconlabel']).'" data-scrollto="#section-'.$section['id'].'"><i class="'.$section['icon'].'"></i></li>';
			}
		
		}
		
		$html .='</ul>';
		
		$html .= '</div>';
	
	}
			
	// Botton Arrow
	if($intro['bottonarrow'] == 1){	
		
		$first_section = $sections['section'];
		$first_section  = $first_section[0];
		
		$html .='
		<div class="btn-down brd-wh-clr brd-fs-clr-hov transit-bouncein" data-delay="2000" data-appear="false" data-scrollto="#section-'.$first_section['id'].'">
		<i class="icon-arrow-down"></i>
		</div>';
	
	}
		
	// End Section
	$html .= '</div>';
	
		
	// Return the code
	return $html;
	
}


// Section No Intro
function un_section_nointro($intro) {
	
	if(!empty($intro['nointro_custom'])){
	
		return '<div class="marg-top-100">'.do_shortcode($intro['nointro_custom']).'</div>';
		
	}else{
		
		return '<div class="marg-top-100"></div>';
		
	}
	
}



// Page Sections
function un_page_sections($id){
	
	$html = '';
	
	// Meta
	$page_meta = vp_metabox( 'un_post_page_meta', '', $id );
	$page_meta = $page_meta->meta;
	
	// Sections
	if (isset($page_meta['sections'])){
		$page_sections = $page_meta['sections'];
	}else{
		$page_sections = array();
	}
	
	// Display
	foreach($page_sections as $section) {
		
		$html .= un_get_section( $section );
		
	}
	
	return $html;
	
}

// Section Header
function un_section_header($header) {
	
	$html = '';
	
	if($header['title']){
		$html .='<div class="header-section padd-y-75" style="background: '.$header['bg_color'].';">
		<div class="title-section padd-x-25 transit-words" style="color: '.$header['title_color'].';">'.$header['title'].'</div>';
		if($header['subtitle']){
			$html .='<div class="subtitle-section marg-top-25" style="color: '.$header['subtitle_color'].';">'.$header['subtitle'].'</div>'; 
		}
		$html .='</div>';
	}
	
	return $html;
	
}

// Enable/Disable Page Loading
add_filter( 'body_class','un_manage_body_classes' );

function un_manage_body_classes( $classes ) {
	
	// Loading Option
	if(un_option('loading') === 'allpages'){ 
		$loading_class = 'loading';
	}elseif(un_option('loading') === 'onlyhome' && (is_home() || is_front_page())){
		$loading_class = 'loading';
	}else{
		$loading_class = '';
	}
	
	// Curtain Option
	if(un_option('curtain') === 'allpages'){ 
		$curtain_class = 'curtain';
	}elseif(un_option('curtain') === 'onlyhome' && (is_home() || is_front_page())){
		$curtain_class = 'curtain';
	}else{
		$curtain_class = '';
	}
	
	// Animations Option
	if(un_option('anim') === 'allpages'){ 
		$anim_class = 'anim';
	}elseif(un_option('anim') === 'onlyhome' && (is_home() || is_front_page())){
		$anim_class = 'anim';
	}else{
		$anim_class = '';
	}
	
	 
    $classes[] = $curtain_class;
	$classes[] = $loading_class;
	$classes[] = $anim_class;
     
    return $classes;
     
}


// ********* //
// SEO METAS //
// ********* //

function un_meta_seo(){
	
	$html = '';
	
	// HOME
	if (is_home() || is_front_page()) {
		
		// Meta Title		
		$home_title = un_kses(un_option('home_title'), false); 
				
		if(!empty($home_title)){ 			
			$html .= '<title>'.$home_title.'</title>';		
		}else{
			$html .= '<title>'.get_bloginfo( 'name' ).'</title>';
		}	
		
		// Meta Desc
		$home_desc = un_kses(un_option('home_desc'), false); 
				
		if(!empty($home_desc)){
			$html .= '<meta name="description" content="'.$home_desc.'">';
		}else{
			$html .= '<meta name="description" content="'.get_bloginfo( 'description' ).'">';
		}
		
		// Meta Keys
		$home_keys = un_kses(un_option('home_keys'), false); 	
			
		if(!empty($home_keys)){
			$html .= '<meta name="keywords" content="'.$home_keys.'">';
		}
		
	}else{ // OTHER PAGES
		
		// Meta Title		
		$page_title_blocks = un_kses(un_option('page_title'), false);
		$page_title = '';	
		
		foreach ($page_title_blocks as $title_block) {
			
			switch ($title_block) {
				
				case 'blog_name':
				$page_title .= get_bloginfo( 'name' ).' - ';
				break;
				
				case 'page_title':				
				if(is_404()){
					$page_title .= __('404 Error', UN).' - ';
				}elseif(is_category() || is_tax()){
					$page_title .= single_cat_title('', false).' - ';
				}elseif(is_archive()){
					if(un_is_woocommerce()) {
						$page_title .= get_the_title(get_option( 'woocommerce_shop_page_id' )).' - ';
					}else{
						$page_title .= __('Archive', UN).' - ';
					}
				}elseif(is_search()){
					$page_title .= __('Search', UN).' - ';
				}else {
					$page_title .= get_the_title().' - ';
				}				
				break;
				
				case 'page_excerpt':				
				if( has_excerpt() ) {
					$page_title .= get_the_excerpt().' - ';
				}				
				break;
				
				default:
				$page_title .= get_bloginfo( 'name' ).' - ';
				break;
				
			}
			
		}
		
		$page_title = substr($page_title, 0, -3);
		$html .= '<title>'.$page_title.'</title>';
		
		
		// Meta Desc
		$page_desc = un_option('page_desc'); 
				
		if( $page_desc == 1 && has_excerpt() ){
			$html .= '<meta name="description" content="'.get_the_excerpt().'">';
		}
		
		// Meta Keys	
		$page_keys = un_kses(un_option('page_keys'), false); 
				
		if(!empty($page_keys)){
			$html .= '<meta name="keywords" content="'.$page_keys.'">';
		}
	
	}
	
	return $html;

}


// Display unCommons Notices
add_action('admin_notices', 'un_notices_display');

function un_notices_display() {
	
	// User Data
	global $current_user ;
    $user_id = $current_user->ID;


	if ( !get_user_meta($user_id, 'un_notices_ignore') && un_option('uncommons') != '1' ) {
		
		
		// Data Url
		$xml_url = 'http://www.uncommons.pro/envato/maya/notices.json'; 
		
		// Get Data
		if(function_exists('file_get_contents') && ini_get('allow_url_fopen')) {
			 
			$content = file_get_contents($xml_url);
		
		}else{
		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL,$xml_url);
			$content = curl_exec($ch);
			curl_close($ch);
			
		}
		
		// Content decode
		$content = json_decode($content, true);
		$html = '';
		
		if($content) {
			
			// News Loop
			foreach($content as $news){
			
				if($news['enabled'] == 1) {
					$html .= '<div class="updated un-notice-bg">';	
					$html .= '<h3>'.$news['title'].'</h3>';
					$html .= '<p>'.$news['message'].'</p>';
					$html .= '<p><a class="disable-news" href="?un_notices=0">Hide Notices</a></p>';
					$html .= '<div class="un-notice-logo"><a href="http://www.uncommons.pro/" target="blank;"></a></div>';
					$html .= '</div>';
				}
			
			}
		
		}
		
		// Print Notice
		if($html){
			echo $html;
		}
		
	
	} // IF Not Ignored and Not Disabled by Theme Options

}


// Ignore unCommons Notices
add_action('admin_init', 'un_notices_ignore');

function un_notices_ignore() {
	global $current_user;
	$user_id = $current_user->ID;
	
	/* If user clicks to ignore the notice, add that to their user meta */
	if ( isset($_GET['un_notices']) && '0' == $_GET['un_notices'] ) {
		 add_user_meta($user_id, 'un_notices_ignore', 'true', true);
		 add_user_meta($user_id, 'un_notices_ignore_data', time(), true);
	}
	
	$data = get_user_meta($user_id, 'un_notices_ignore_data');
	
	
	if ($data){
		$days = time() - $data[0];	
	}else{
		$days = time();
	}
	
	// Expire after 1 month
	if ( get_user_meta($user_id, 'un_notices_ignore_data') AND $days > 2629743 ) {
		delete_user_meta($user_id, 'un_notices_ignore');
		delete_user_meta($user_id, 'un_notices_ignore_data');
	}
	
} 


// unCommons News
add_action( 'wp_dashboard_setup', 'un_news' );

function un_news() {
	
	if ( un_option('uncommons') != '1' ) {
		
		// Add Widget
		wp_add_dashboard_widget( 'un_news', 'unCommons News', 'un_news_display' );
		
		// Get Normal Dashboard
		global $wp_meta_boxes;
		$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
		
		// Backup and delete our new dashboard widget from the end of the array 
		$un_news_backup = array( 'un_news' => $normal_dashboard['un_news'] );
		unset( $normal_dashboard['un_news'] );
	 
		// Merge the two arrays together so our widget is at the beginning 
		$sorted_dashboard = array_merge( $un_news_backup, $normal_dashboard );
	 
		// Save the sorted array back into the original metaboxes  
		$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
		
	} // IF Not Disabled by Theme Options
	
} 


// unCommons News Display
function un_news_display() {

	
		// Data Url
		$xml_url = 'http://www.uncommons.pro/envato/news.json'; 
		
		// Get Data
		if(function_exists('file_get_contents') && ini_get('allow_url_fopen')) {
			 
			$content = file_get_contents($xml_url);
		
		}else{
		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL,$xml_url);
			$content = curl_exec($ch);
			curl_close($ch);
			
		}
		
		// Content decode
		$content = json_decode($content, true);
		$html = '';
		$atleastone = '';
		
		if ($content) {
			
			$html .= '<ul class="un-news-list">';
			
			// News Loop
			foreach($content as $news){
			
				if($news['enabled'] == 1) {
					
					$atleastone = 1;
					
					$html .= '<li>';
					$html .= '<div class="un-news-title">'.$news['title'].'</div>';
					$html .= '<div class="un-news-date">'.$news['date'].'</div>';
					$html .= '<div class="un-news-message">'.$news['message'].'</div>';
					$html .= '</li>';
					
				}
			
			}
			
			if($atleastone != 1) {
					$html .= '<li>';
					$html .= '<div class="un-news-message">'.__('No news found', UN).'</div>';
					$html .= '</li>';
			}
			
			$html .= '</ul>';
		
		
		}else{
			
			$html .= '<div class="un-news-message">'.__('No news found', UN).'</div>';
			
		}
		
		// Print Notice
		if($html){
			echo $html;
		}else{
			_e('No news from unCommons Team', UN);
		}
		
	
}

// Our personal wp_kses function
function un_kses($string, $html = false) {
	
	if($html == false) {
		
		return wp_kses($string, array());
		
	}else{
		
		$tags = wp_kses_allowed_html( 'post' );
		
		$tags['script'] = array(
			'language' => 1,
			'src'      => 1,
			'type'     => 1  
		);
			
		return wp_kses($string, $tags);
		
	}
	
}

// Check if is_woocommerce 
function un_is_woocommerce() {
	
	if( (function_exists('is_woocommerce') && is_woocommerce()) || 
		(function_exists('is_cart') && is_cart()) || 
		(function_exists('is_checkout') && is_checkout()) || 
		(function_exists('is_account_page') && is_account_page()) ||
		(function_exists('is_add_payment_method_page') && is_add_payment_method_page()) ||   
		(function_exists('is_checkout_pay_page') && is_checkout_pay_page()) ||   
		(function_exists('is_order_received_page') && is_order_received_page()) ||   
		(function_exists('is_view_order_page') && is_view_order_page()) ||   
		(function_exists('is_checkout') && is_checkout())		
		) {
		return true;
	}else{
		return false;
	}
	
}

// Comment Walker Customization

class UN_Comment_Walker extends Walker_Comment {
	
function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					</div><!-- .comment-author -->

					<div class="comment-metadata">
						<span class="comment-author-name"><?php echo get_comment_author_link(); ?></span> (<a class="comment-date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s at %2$s', '1: date, 2: time' ), get_comment_date(), get_comment_time() ); ?>
							</time>
						</a>)
						<?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>'
				) ) );
				?>
			</article><!-- .comment-body -->
<?php
	}
}

// Basic WP Function
function un_basic_wp_functions() {
	posts_nav_link();
	wp_link_pages();
	post_class();
	wp_title('', false);
	get_the_tags();
	add_theme_support( 'custom-header', array() );
	add_theme_support( 'custom-background', array() );
}

