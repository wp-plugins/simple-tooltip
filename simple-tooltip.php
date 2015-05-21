<?php
/*
Plugin Name: Simple Tooltip
Plugin URI: http://wp-time.com/simple-wordpress-tooltip-shortcode/
Description: Simple WordPress tooltip shortcode, full customize and easy to use.
Version: 1.0
Author: Qassim Hassan
Author URI: http://qass.im
License: GPLv2 or later
*/

/*  Copyright 2015 Qassim Hassan (email: qassim.pay@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
// WP Time Page
if( !function_exists('WP_Time_Ghozylab_Aff') ) {
	function WP_Time_Ghozylab_Aff() {
		add_menu_page( 'WP Time', 'WP Time', 'update_core', 'WP_Time_Ghozylab_Aff', 'WP_Time_Ghozylab_Aff_Page');
		function WP_Time_Ghozylab_Aff_Page() {
			?>
            	<div class="wrap">
                	<h2>WP Time</h2>
                    
					<div class="tool-box">
                		<h3 class="title">Thanks for using our plugins!</h3>
                    	<p>For more plugins, please visit <a href="http://wp-time.com/" target="_blank">WP Time Website</a> and <a href="https://profiles.wordpress.org/qassimdev/#content-plugins" target="_blank">WP Time profile on WordPress</a>.</p>
                        <p>For contact or support, please visit <a href="http://wp-time.com/contact/" target="_blank">WP Time Contact Page</a>.</p>
					</div>
                    
            	<div class="tool-box">
					<h3 class="title">Recommended Links</h3>
					<p>Get collection of 87 WordPress themes for $69 only, a lot of features and free support! <a href="http://j.mp/ET_WPTime_ref_pl" target="_blank">Get it now</a>.</p>
					<p>See also:</p>
						<ul>
							<li><a href="http://j.mp/GL_WPTime" target="_blank">Must Have Awesome Plugins.</a></li>
							<li><a href="http://j.mp/CM_WPTime" target="_blank">Premium WordPress themes on CreativeMarket.</a></li>
							<li><a href="http://j.mp/TF_WPTime" target="_blank">Premium WordPress themes on Themeforest.</a></li>
							<li><a href="http://j.mp/CC_WPTime" target="_blank">Premium WordPress plugins on Codecanyon.</a></li>
							<li><a href="http://j.mp/BH_WPTime" target="_blank">Unlimited web hosting for $3.95 only.</a></li>
						</ul>
					<p><a href="http://j.mp/GL_WPTime" target="_blank"><img src="<?php echo plugins_url( '/banner/global-aff-img.png', __FILE__ ); ?>" width="728" height="90"></a></p>
					<p><a href="http://j.mp/ET_WPTime_ref_pl" target="_blank"><img src="<?php echo plugins_url( '/banner/570x100.jpg', __FILE__ ); ?>"></a></p>
                    <p><a href="http://j.mp/Avada_WP_Theme" target="_blank"><img src="<?php echo plugins_url( '/banner/avada.jpg', __FILE__ ); ?>"></a></p>
				</div>
                
                </div>
			<?php
		}
	}
	add_action( 'admin_menu', 'WP_Time_Ghozylab_Aff' );
}


// Include CSS Style
function WPTime_simple_tooltip_css(){		
	wp_enqueue_style( 'wptime-simple-tooltip-style', plugins_url( '/css/simple-tooltip-style.css', __FILE__ ), false, null);
}
add_action('wp_enqueue_scripts', 'WPTime_simple_tooltip_css');


// Simple Tooltip Shortcode
function WPTime_simple_tooltip_shortcode( $atts, $content = null ){

	extract(
		shortcode_atts(
			array(
				"text"			=>	"",
				"background"	=>	"",
				"url"			=>	"",
				"color"			=>	"",
				"tooltip"		=>	""
			),$atts
		)
	);
	
	if( !empty($text) or !empty($url) ){
		
		if( !empty($text) and empty($url) ){
			$the_text = strip_tags($text);
		}
		
		if( empty($text) and !empty($url) ){
			$url_border 	=	' style="border-bottom:1px dotted !important;"';
			$the_text 		=	'<a href="'.$url.'"'.$url_border.'>'.$url.'</a>';
			$wrap_border 	=	' style="border:none !important;"';
		}else{
			$wrap_border 	= 	null;
			$url_border		=	null;
		}
		
		if( !empty($text) and !empty($url) ){
			$url_border 	=	' style="border-bottom:1px dotted !important;"';
			$the_text 		=	'<a href="'.$url.'"'.$url_border.'>'.$text.'</a>';
			$wrap_border 	=	' style="border:none !important;"';
		}else{
			$wrap_border 	= 	null;
			$url_border		=	null;
		}
		
	}else{
		$the_text		=	null;
		$wrap_border 	= 	null;
		$url_border		=	null;
	}
	
	if( !empty($background) ){
		$css_bg 		=	$background;
		$before_id		=	'wptime-simple-tooltip-arrow-color'.rand();
		$arrow_color 	=	'<style type="text/css">.'.$before_id.':after{border-top-color:'.$css_bg.' !important;}</style>';
		$space			=	' ';
	}else{
		$css_bg 		=	null;
		$before_id		=	null;
		$arrow_color 	=	null;
		$space			=	null;
	}
	
	if( !empty($color) ){
		$css_color = $color;
	}else{
		$css_color = null;
	}
	
	if( !empty($background) or !empty($color) ){
		$style = ' style="background-color:'.$css_bg.';color:'.$css_color.';"';
	}else{
		$style = null;
	}
	
	if( !empty($tooltip) ){
		$tooltip_text = strip_tags($tooltip);
	}else{
		$tooltip_text = null;
	}
	
	return '<span class="wptp-simple-tooltip"'.$wrap_border.'><i class="wptp-tooltip-text'.$space.$before_id.'"'.$style.'>'.$tooltip_text.'</i>'.$arrow_color.$the_text.'</span>';

}
add_shortcode('simple_tooltip', 'WPTime_simple_tooltip_shortcode');


// Add simple tooltip button to wp editor
function WPTime_simple_tooltip_tinymce_button($buttons) {
	array_push($buttons, 'wptp_simple_tooltip_button');
	return $buttons;
}
add_filter('mce_buttons', 'WPTime_simple_tooltip_tinymce_button');


// Register js for simple tooltip button
function WPTime_simple_tooltip_register_tinymce_js($plugin_array) {
	$plugin_array['wptp_simple_tooltip_button'] = plugins_url( '/js/wptp_simple_tooltip_tinymce_button.js', __FILE__);
	return $plugin_array;
}
add_filter('mce_external_plugins', 'WPTime_simple_tooltip_register_tinymce_js');

?>