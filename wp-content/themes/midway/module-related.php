<div class="related-tours">
	<div class="block-title"><h1><?php _e('Related Tours','midway'); ?></h1></div>
	<?php
	$order=ThemexCore::getOption('tours_related_order','rand');
	$taxonomies=array($order);
	if($order!='rand') {
		$taxonomies=wp_get_post_terms($post->ID,'tour_'.$order);
		shuffle($taxonomies);
	}

	$used_posts[]=$post->ID;
	$GLOBALS['row_class']='three';
	$GLOBALS['row_limit']=4;
	$GLOBALS['counter']=0;
	
	foreach ($taxonomies as $taxonomy) {
		if($GLOBALS['counter']<4) {
			$args=array(
			  'tour_'.$order => $order=='rand'?null:$taxonomy->slug,
			  'post__not_in' => $used_posts,
			  'post_type' => 'tour',
			  'orderby' => 'rand',
			  'meta_key'    => '_thumbnail_id',
			  'showposts'=>4,
			);
			$query = new WP_Query($args);


			while ($query->have_posts() && $GLOBALS['counter']<4) {
				$query->the_post(); 
				$GLOBALS['counter']++;
				$destinations=themex_category($post->ID, 'destination');	
				$duration=themex_duration($post->ID);
				get_template_part('loop', 'grid-tour');
				$used_posts[]=$post->ID;
				
			}
			wp_reset_query();
		}
	}
	?>
	<div class="clear"></div>	
</div>