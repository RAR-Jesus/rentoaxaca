<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>

<div class="buttons">
	<input class="vp-js-upload vp-button button" type="button" value="<?php _e('Choose File', 'vp_textdomain'); ?>" />
	<input class="vp-js-remove-upload vp-button button" type="button" value="x" />
</div>
<input class="vp-input" type="hidden" readonly id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" />
<div class="image">
	<?php if($value) { ?>
	<?php $preview_image = wp_get_attachment_image_src( $value, 'full' ); ?>    
		<img src="<?php echo $preview_image[0]; ?>" alt="" />
    <?php }else{ ?>
    	<img src="<?php echo UN_THEME_URI.'assets/img/default_XS.png'; ?>" alt="" />
    <?php } ?>
    
</div>

<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_foot'); ?>