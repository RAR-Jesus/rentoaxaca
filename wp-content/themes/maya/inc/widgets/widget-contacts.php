<?php
/**
 * Contacts Widget
 *
 * @package WordPress
 * @subpackage Maya
 * 
 */
  
add_action( 'widgets_init', 'un_contacts_widget' );

function un_contacts_widget() {
	register_widget('UN_Contacts_Widget');
}

class UN_Contacts_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'contatcs_widget', 'description' => 'Get in touch with your users!');
		parent::__construct('contact-widget', 'UN: Contacts', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$htmlText = apply_filters( 'contatcs_widget', empty( $instance['htmlText'] ) ? '' : $instance['htmlText'], $instance );
		$address = apply_filters( 'contatcs_widget', empty( $instance['address'] ) ? '' : $instance['address'], $instance );
		$phone = apply_filters( 'contatcs_widget', empty( $instance['phone'] ) ? '' : $instance['phone'], $instance );
		$email = apply_filters( 'contatcs_widget', empty( $instance['email'] ) ? '' : $instance['email'], $instance );
		$buttonLabel = apply_filters( 'contatcs_widget', empty( $instance['buttonLabel'] ) ? '' : $instance['buttonLabel'], $instance );
		$buttonUrl = apply_filters( 'contatcs_widget', empty( $instance['buttonUrl'] ) ? '' : $instance['buttonUrl'], $instance );
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
			<div class="contacts_widget">

            <?php if($htmlText) { echo '<div class="text-contact">'.$htmlText.'</div>'; } ?>
             <?php if($address) { echo '<div class="item-contact"><i class="icon-location"></i>'.$address.'</div>'; } ?>
             <?php if($phone) { echo '<div class="item-contact"><i class="icon-speech-bubble"></i>'.$phone.'</div>'; } ?>
             <?php if($email) { echo '<div class="item-contact"><i class="icon-mail"></i><a href="mailto:'.$email.'">'.$email.'</a></div>'; } ?>
             <?php if($buttonLabel && $buttonUrl) { echo '<div class="item-contact"><i class="icon-link"></i><a href="'.$buttonUrl.'">'.$buttonLabel.' </a></div>'; } ?>
             <div class="clearfix"></div>
             
            </div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['htmlText'] = $new_instance['htmlText'];
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = $new_instance['phone'];
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['buttonLabel'] = strip_tags($new_instance['buttonLabel']);
		$instance['buttonUrl'] = strip_tags($new_instance['buttonUrl']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Get in Touch', 'htmlText' => '<strong>html</strong> text', 'address' => '123 Street Name - Rome', 'phone' => '(+39) 06-12345678', 'email' => 'team@uncommons.pro', 'buttonLabel' => 'Go to the Contact Page', 'buttonUrl' => '#' ) );
		$title = strip_tags($instance['title']);


		$htmlText = $instance['htmlText'];
		$address = $instance['address'];
		$phone = $instance['phone'];
		$email = strip_tags($instance['email']);
		$buttonLabel = strip_tags($instance['buttonLabel']);
		$buttonUrl = strip_tags($instance['buttonUrl']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        


		<p><label for="<?php echo $this->get_field_id('htmlText'); ?>" style="width:78px; display:inline-block;"><?php echo 'Html Text:'; ?></label>


       


        <textarea cols="31" id="<?php echo $this->get_field_id('htmlText'); ?>" name="<?php echo $this->get_field_name('htmlText'); ?>" type="text"><?php echo $htmlText; ?></textarea>


        </p>
		<p><label for="<?php echo $this->get_field_id('address'); ?>" style="width:78px; display:inline-block;"><?php echo 'Address:'; ?></label>
		<input id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" /><em> <small>HTML allowed</small></em></p>
        
        <p><label for="<?php echo $this->get_field_id('phone'); ?>" style="width:78px; display:inline-block;"><?php echo 'Phone:'; ?></label>
		<input id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" /><em> <small>HTML allowed</small></em></p>
                
        <p><label for="<?php echo $this->get_field_id('email'); ?>" style="width:78px; display:inline-block;"><?php echo 'Email:'; ?></label>
		<input id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('buttonLabel'); ?>" style="width:78px; display:inline-block;"><?php echo 'Button Label:'; ?></label>
		<input id="<?php echo $this->get_field_id('buttonLabel'); ?>" name="<?php echo $this->get_field_name('buttonLabel'); ?>" type="text" value="<?php echo $buttonLabel; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('buttonUrl'); ?>" style="width:78px; display:inline-block;"><?php echo 'Button Url:'; ?></label>
		<input id="<?php echo $this->get_field_id('buttonUrl'); ?>" name="<?php echo $this->get_field_name('buttonUrl'); ?>" type="text" value="<?php echo $buttonUrl; ?>" /></p>
		
<?php
	}
}