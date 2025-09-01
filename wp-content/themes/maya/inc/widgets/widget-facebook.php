<?php
/**
 * Facebook Widget
 *
 * @package WordPress
 * @subpackage Maya
 * 
 */


add_action( 'widgets_init', 'un_facebook_widget' );

function un_facebook_widget() {
	register_widget( 'un_facebook_widget' );
}
class un_facebook_widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'facebook-widget' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'facebook-widget' );
		$this->WP_Widget( 'facebook-widget', 'UN: Facebook Box', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$page_fb = $instance['page_fb'];
		$height = $instance['height'];
		$scheme = $instance['scheme'];
		$header = $instance['header'];
		$stream = $instance['stream'];
		$faces = $instance['faces'];
		$css = $instance['css'];

		echo $before_widget;
		if ( $title )
			echo $before_title;
			echo $title ; ?>
		<?php echo $after_title; ?>
        
			<div class="facebook-box">
            <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $page_fb; ?>&amp;width=250&amp;height=<?php echo $height; ?>&amp;colorscheme=<?php echo $scheme; ?>&amp;show_faces=<?php echo $faces; ?>&amp;header=<?php echo $header; ?>&amp;stream=<?php echo $stream; ?>&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:<?php echo $height; ?>px; <?php echo $css; ?>" allowTransparency="true"></iframe>



			</div>
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['page_fb'] = strip_tags( $new_instance['page_fb'] );
		$instance['height'] = strip_tags( $new_instance['height'] );
		$instance['scheme'] = strip_tags( $new_instance['scheme'] );
		$instance['header'] = strip_tags( $new_instance['header'] );
		$instance['stream'] = strip_tags( $new_instance['stream'] );
		$instance['faces'] = strip_tags( $new_instance['faces'] );
		$instance['css'] = strip_tags( $new_instance['css'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 
					'title' =>__( 'Find us on Facebook' , UN),
					'page_fb' => __( 'https://www.facebook.com/envato', UN),
					'height' => '250',
					'scheme' => 'light',
					'header' => 'false',
					'stream' => 'false',
					'faces' => 'true',
					'css' => 'background:#EDEFF4; border:none; width:100%;'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' , UN); ?> : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page_fb' ); ?>"><?php _e( 'Page Url' , UN); ?> : </label>
			<input id="<?php echo $this->get_field_id( 'page_fb' ); ?>" name="<?php echo $this->get_field_name( 'page_fb' ); ?>" value="<?php echo $instance['page_fb']; ?>" class="widefat" type="text" />
		</p>


        


        <p>


			<input type="checkbox" <?php if($instance['header'] == true) {echo 'checked="checked"';} ?> value="true" name="<?php echo $this->get_field_name( 'header' ); ?>" id="<?php echo $this->get_field_id( 'header' ); ?>">


			<label for="<?php echo $this->get_field_id( 'header' ); ?>"><?php _e( 'Show Header' , UN); ?></label>


        </p>   


        <p> 


            <input type="checkbox" <?php if($instance['stream'] == true) {echo 'checked="checked"';} ?> value="true" name="<?php echo $this->get_field_name( 'stream' ); ?>" id="<?php echo $this->get_field_id( 'stream' ); ?>">


			<label for="<?php echo $this->get_field_id( 'stream' ); ?>"><?php _e( 'Show Stream' , UN); ?></label>


        </p>


        <p> 


            <input type="checkbox" <?php if($instance['faces'] == true) {echo 'checked="checked"';} ?> value="true" name="<?php echo $this->get_field_name( 'faces' ); ?>" id="<?php echo $this->get_field_id( 'faces' ); ?>">


			<label for="<?php echo $this->get_field_id( 'faces' ); ?>"><?php _e( 'Show Faces' , UN); ?></label>


		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Box Height' , UN); ?> : </label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" class="widefat" type="text" />
		</p>


        


        <p>
			<label for="<?php echo $this->get_field_id( 'scheme' ); ?>"><?php _e( 'Color Scheme' , UN); ?> : </label>


			


            <select id="<?php echo $this->get_field_id( 'scheme' ); ?>" name="<?php echo $this->get_field_name( 'scheme' ); ?>" class="widefat">


            <option <?php if ($instance['scheme'] == 'dark' ){echo 'selected="selected"';} ?> value="dark">Dark</option>


            <option <?php if ($instance['scheme'] == 'light' ){echo 'selected="selected"';} ?> value="light">Light</option>


            </select>


			
		</p>


        


        <p>
			<label for="<?php echo $this->get_field_id( 'css' ); ?>"><?php _e( 'Iframe CSS' , UN); ?> : </label>
			<textarea id="<?php echo $this->get_field_id( 'css' ); ?>" name="<?php echo $this->get_field_name( 'css' ); ?>" class="widefat"><?php echo $instance['css']; ?></textarea>
		</p>



	<?php
	}
}
?>