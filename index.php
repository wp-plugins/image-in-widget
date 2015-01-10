<?php
/**
 * Plugin Name: Image in Widget
 * Plugin URI: http://webcodingplace.com/image-in-widget/
 * Description: A simple way to add responsive images in widgets.
 * Version: 1.3
 * Author: Rameez
 * Author URI: http://webcodingplace.com/
 * Text Domain: image-in-widget
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

require_once('plugin.class.php');

	if( class_exists('Image_In_Widget')){
		
		$image_widget = new Image_In_Widget;
	}

?>