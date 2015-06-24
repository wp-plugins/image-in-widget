<?php
/**
 * Plugin Name: Image in Widget
 * Plugin URI: http://webcodingplace.com/image-in-widget/
 * Description: A simple way to add responsive images in widgets.
 * Version: 3.0
 * Author: Rameez
 * Author URI: http://webcodingplace.com/
 * Text Domain: image-in-widget
 * Domain Path: /languages/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

/*

  Copyright (C) 2015  Rameez  rameez.iqbal@live.com

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
*/
require_once('plugin.class.php');

	if( class_exists('Image_In_Widget')){
		
		$image_widget = new Image_In_Widget;
	}

?>