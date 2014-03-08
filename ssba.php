<?php
/*
Plugin Name: Simple Share Buttons
Plugin URI: http://www.youngbit.com
Description: A really simple share buttons shortcode that shows the facebook, twitter and google plus buttons.
Version: 0.1
Author: Manuel Escrig Ventura
Author Email: info@youngbit.com
License:

  Copyright 2011 Manuel Escrig Ventura (info@youngbit.com)

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

class SimpleShareButtons {

	/*--------------------------------------------*
	 * Constants
	 *--------------------------------------------*/
	const name = 'Simple Share Buttons';
	const slug = 'simple_share_buttons';
	
	/**
	 * Constructor
	 */
	function __construct() {
		//Hook up to the init action
		add_action( 'init', array( &$this, 'init_simple_share_buttons' ) );
	}
  
	/**
	 * Runs when the plugin is activated
	 */  
	function install_simple_share_buttons() {
		// do not generate any output here
	}
  
	/**
	 * Runs when the plugin is initialized
	 */
	function init_simple_share_buttons() {
		// Load JavaScript and stylesheets
		$this->register_scripts_and_styles();

		// Register the shortcode [ssba]
		add_shortcode( 'ssba', array( &$this, 'render_shortcode' ) );

		if ( is_admin() ) {
			//this will run when in the WordPress admin
		} else {
			//this will run when on the frontend
		}

		/*
		 * TODO: Define custom functionality for your plugin here
		 *
		 * For more information: 
		 * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */
		add_action( 'your_action_here', array( &$this, 'action_callback_method_name' ) );
		add_filter( 'your_filter_here', array( &$this, 'filter_callback_method_name' ) );    
	}

	function action_callback_method_name() {
		// TODO define your action method here
	}

	function filter_callback_method_name() {
		// TODO define your filter method here
	}

	function ssba_buttons() {
		
	}


	function render_shortcode($atts) {
		// Extract the attributes
		?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>   
		
		<script type="text/javascript">
		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/platform.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
		
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		
		<?php  
			$title = get_the_title($post); 

			$return_string = '<h4>Do you like ';
			$return_string .= $title;
			$return_string .= '? Share it with your friends!</h4>';
			$return_string .= '<div class="social_icon_1"><a style="float:left; margin-top:5px;"  href="https://twitter.com/share" class="twitter-share-button"	data-related="jasoncosta" data-lang="en" data-size="medium" data-count="horizontal">Tweet</a></div>';
			$return_string .= '<div class="social_icon_1"><div style="float:left; margin-top:5px" class="g-plus" data-action="share" data-annotation="bubble"></div></div>';
			$return_string .= '<div class="social_icon_1"><div style="float:left; margin-left:30px; margin-top:0px;" class="fb-share-button" data-width="150" data-type="button_count"></div></div>';


			return $return_string;
	}
  
	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {
		if ( is_admin() ) {

		} else {

		} // end if/else
	} // end register_scripts_and_styles
	
	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name	The 	ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file( $name, $file_path, $is_script = false ) {

		$url = plugins_url($file_path, __FILE__);
		$file = plugin_dir_path(__FILE__) . $file_path;

		if( file_exists( $file ) ) {
			if( $is_script ) {
				wp_register_script( $name, $url, array('jquery') ); //depends on jquery
				wp_enqueue_script( $name );
			} else {
				wp_register_style( $name, $url );
				wp_enqueue_style( $name );
			} // end if
		} // end if

	} // end load_file
  
} // end class
new SimpleShareButtons();

?>