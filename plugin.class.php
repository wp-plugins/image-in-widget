<?php

class Image_In_Widget extends WP_Widget {

	function __construct() {
		$param = array(
			'name'			=>	'Image in Widget',
			'description' 	=> 	'Responsive Images in Widgets'
		);

		parent::__construct('image_in_widget','',$param);

	}

	public function form($instance) {
		extract($instance);
	
	?>
	<p>
		<label for="<?php echo $this->get_field_id('image_url'); ?>"><?php _e('Paste URL or upload Image', 'image-in-widget') ?>:</label>
	    <input 	id="<?php echo $this->get_field_id('image_url'); ?>"
				type="text"
				class="image-url"
				name="<?php echo $this->get_field_name('image_url'); ?>"
				value="<?php if (isset($image_url)) echo esc_attr($image_url); ?>"
		/>
	    <input id="upload_image_button" class="button" type="button" value="<?php _e('Upload','image-in-widget') ?>" />
	</p>
	<p class="img-prev">
		<?php if (isset($image_url)) { echo '<img src="'.$image_url.'" style="max-width: 100%;">';} ?>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('image_title'); ?>"><?php _e('Image title','image-in-widget') ?>:</label>
		<input type="text"
			class="image-title widefat"
			id="<?php echo $this->get_field_id('image_title'); ?>"
			name="<?php echo $this->get_field_name('image_title'); ?>"
			value="<?php if (isset($image_title)) echo esc_attr($image_title); ?>"
		/>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('image_alt_text'); ?>"><?php _e('Alternate text','image-in-widget') ?>:</label>
		<input type="text"
			class="alttext widefat"
			id="<?php echo $this->get_field_id('image_alt_text'); ?>"
			name="<?php echo $this->get_field_name('image_alt_text'); ?>"
			value="<?php if (isset($image_alt_text)) echo esc_attr($image_alt_text); ?>"
		/>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('image_link_to'); ?>"><?php _e('Link to','image-in-widget') ?>:</label>
		<input type="text"
			class="widefat"
			id="<?php echo $this->get_field_id('image_link_to'); ?>"
			name="<?php echo $this->get_field_name('image_link_to'); ?>"
			value="<?php if (isset($image_link_to)) echo esc_attr($image_link_to); ?>"
		/>
		<span><?php _e('Leaving blank will link to image itself','image-in-widget') ?></span>
	</p>

	<p>
	    <input class="checkbox" type="checkbox" <?php checked($instance['wcp_newtab'], 'on'); ?> id="<?php echo $this->get_field_id('wcp_newtab'); ?>" name="<?php echo $this->get_field_name('wcp_newtab'); ?>" /> 
	    <label for="<?php echo $this->get_field_id('wcp_newtab'); ?>"><?php _e( 'Open link in new tab', 'image-in-widget' ); ?></label>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('imagestyle'); ?>"><?php _e('Image style','image-in-widget') ?>:</label>
		<select class="widefat" id="<?php echo $this->get_field_id('imagestyle'); ?>" name="<?php echo $this->get_field_name('imagestyle'); ?>">
			<option value="default"<?php if($imagestyle == 'default'){echo 'selected';} ?>>Default</option>
			<option value="img-thumbnail" <?php if($imagestyle == 'img-thumbnail'){echo 'selected';} ?>>Thumbnail</option>
			<option value="img-rounded" <?php if($imagestyle == 'img-rounded'){echo 'selected';} ?>>Rounded</option>
			<option value="img-circle"<?php if($imagestyle == 'img-circle'){echo 'selected';} ?>>Circle</option>
		</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description','image-in-widget') ?>:</label>
		<textarea
			class="widefat"
			id="<?php echo $this->get_field_id('description'); ?>"
			name="<?php echo $this->get_field_name('description'); ?>"><?php if (isset($description)) echo esc_attr($description); 
		?></textarea>
	</p>	
	<?php

	}

	public function widget($args, $instance) {
	
		extract($args);
		extract($instance);
	?>
	<style>
	<?php 
		include_once('image-widget-style.php');
	?>
	</style>	

		<div class="image-in-widget-plugin">
			<a href="<?php
				if ($image_link_to != ''){
					echo $image_link_to;
				}
				else {
					echo $image_url;
				}
			?>" target="<?php echo $wcp_newtab = $instance['wcp_newtab'] ? '_blank' : '_self'; ?>">
				<img class="img-responsive <?php echo $imagestyle ?>" src="<?php echo $image_url ?>"
				alt="<?php echo $image_alt_text ?>"
				title="<?php echo $image_title ?>">
			</a>
			<p><?php echo $description ?></p>
		</div>

	<?php
	}
	
}

add_action ('widgets_init', 'register_image_in_widget');

function register_image_in_widget(){
	register_widget('image_in_widget');
}

function image_in_widget_scripts() {
	wp_enqueue_media();
	wp_register_script( 'my_custom_script', plugin_dir_url( __FILE__ ) . 'image-in-widget-scripts.js', array('jquery'));
	wp_enqueue_script('my_custom_script');
}

add_action( 'admin_enqueue_scripts', 'image_in_widget_scripts' );


?>