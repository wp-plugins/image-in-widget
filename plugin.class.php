<?php 

/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class WCP_Image_In_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function WCP_Image_In_Widget() {
        $widget_ops = array( 'classname' => 'wcp_image', 'description' => 'Responsive Images in Widgets' );
        $this->WP_Widget( 'wcp_image', 'Image in Widget', $widget_ops );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        extract($instance);
        wp_enqueue_style( 'wcp-caption-styles' );

		if(isset($wcp_zoom_yes) && $wcp_zoom_yes == 'on') {

        	wp_enqueue_script( 'jquery-zoom-js' );
        	wp_enqueue_script( 'wcp-zoom-js' );

		}
?>

		<div class="image-in-widget-plugin" id="<?php echo $this->get_field_id('image_url'); ?>">
			
			<?php if(isset($instance['wcp_remove_link']) && $instance['wcp_remove_link'] == 'on') { ?>
				
					<img class="img-responsive <?php echo $imagestyle ?>" src="<?php echo $image_url ?>"
					alt="<?php echo $image_alt_text ?>"
					title="<?php echo $image_title ?>">

			<?php } else { ?>

				<a href="<?php
					if ($image_link_to != ''){
						echo $image_link_to;
					}
					else {
						echo $image_url;
					}
				?>" target="<?php echo $wcp_newtab = (isset($instance['wcp_newtab']) && $instance['wcp_newtab']) ? '_blank' : '_self'; ?>">
					<img class="img-responsive <?php echo $imagestyle ?>" src="<?php echo $image_url ?>"
					alt="<?php echo $image_alt_text ?>"
					title="<?php echo $image_title ?>">
				</a>					
			<?php } ?>
			
			<div><?php echo $description ?></div>
		</div>
<?php

    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance ) {

        // update logic goes here
        $updated_instance = $new_instance;
        return $updated_instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance ) {
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
	    <input data-title="Image in Widget" data-btntext="Select it" class="button upload_image_button" type="button" value="<?php _e('Upload','image-in-widget') ?>" />
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
	    <input class="checkbox" type="checkbox" <?php if(isset($instance['wcp_newtab'])) checked($instance['wcp_newtab'], 'on'); ?> id="<?php echo $this->get_field_id('wcp_newtab'); ?>" name="<?php echo $this->get_field_name('wcp_newtab'); ?>" /> 
	    <label for="<?php echo $this->get_field_id('wcp_newtab'); ?>"><?php _e( 'Open link in new tab', 'image-in-widget' ); ?></label>
	</p>

	<p>
	    <input class="checkbox" type="checkbox" <?php if(isset($instance['wcp_remove_link'])) checked($instance['wcp_remove_link'], 'on'); ?> id="<?php echo $this->get_field_id('wcp_remove_link'); ?>" name="<?php echo $this->get_field_name('wcp_remove_link'); ?>" /> 
	    <label for="<?php echo $this->get_field_id('wcp_remove_link'); ?>"><?php _e( 'Remove link from image', 'image-in-widget' ); ?></label>
	</p>

	<p>
	    <input class="checkbox" type="checkbox" <?php if(isset($instance['wcp_zoom_yes'])) checked($instance['wcp_zoom_yes'], 'on'); ?> id="<?php echo $this->get_field_id('wcp_zoom_yes'); ?>" name="<?php echo $this->get_field_name('wcp_zoom_yes'); ?>" /> 
	    <label for="<?php echo $this->get_field_id('wcp_zoom_yes'); ?>"><?php _e( 'Zoom on Hover', 'image-in-widget' ); ?></label>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('imagestyle'); ?>"><?php _e('Image style','image-in-widget') ?>:</label>
		<select class="widefat" id="<?php echo $this->get_field_id('imagestyle'); ?>" name="<?php echo $this->get_field_name('imagestyle'); ?>">
			<option value="default"<?php if(isset($imagestyle) && $imagestyle == 'default'){echo 'selected';} ?>>Default</option>
			<option value="img-thumbnail" <?php if(isset($imagestyle) && $imagestyle == 'img-thumbnail'){echo 'selected';} ?>>Thumbnail</option>
			<option value="img-rounded" <?php if(isset($imagestyle) && $imagestyle == 'img-rounded'){echo 'selected';} ?>>Rounded</option>
			<option value="img-circle"<?php if(isset($imagestyle) && $imagestyle == 'img-circle'){echo 'selected';} ?>>Circle</option>
		</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description (You can use HTML tags here)','image-in-widget') ?>:</label>
		<textarea
			class="widefat"
			id="<?php echo $this->get_field_id('description'); ?>"
			name="<?php echo $this->get_field_name('description'); ?>"><?php if (isset($description)) echo esc_attr($description); 
		?></textarea>
	</p>

<?php
    }
}
// End of Plugin Class

add_action( 'widgets_init', create_function( '', "register_widget( 'WCP_Image_In_Widget' );" ) );

add_action( 'admin_enqueue_scripts', 'wcp_upload_script' );
add_action( 'wp_head', 'wcp_image_styles' );
add_action( 'plugins_loaded', 'wcp_load_plugin_textdomain' );
/*
*	Script for Media uploader
 */
function wcp_upload_script($hook){
    if ( 'widgets.php' != $hook ) {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script( 'wcp_uploader', plugin_dir_url( __FILE__ ) . 'js/admin.js', array('jquery') );
}
function wcp_image_styles(){
	wp_register_style( 'wcp-caption-styles', plugin_dir_url( __FILE__ ) .'css/style.css' );
	wp_register_script( 'jquery-zoom-js', plugin_dir_url( __FILE__ ) .'js/jquery.zoom.min.js', array('jquery'));
	wp_register_script( 'wcp-zoom-js', plugin_dir_url( __FILE__ ) .'js/zoom.js', array('jquery'));
}

function wcp_load_plugin_textdomain(){
	load_plugin_textdomain( 'image-in-widget', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
?>