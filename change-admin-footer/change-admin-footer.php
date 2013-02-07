<?php
/*
Plugin Name: Change Admin Footer
Description: Change left-side admin footer text
Version: 1.0
Author: Kailey Lampert
Author URI: kaileylampert.com
*/

$change_admin_footer = new Change_Admim_Footer();

class Change_Admin_Footer {

	function __construct() {
		add_filter( 'admin_footer_text', array( &$this, 'admin_footer_text' ) ) ;
	}

	function admin_footer_text( $original ) {

		$text  = '<span id="footer-thankyou">';
		$text .= '<a href="'. home_url() .'">'. get_bloginfo('name') .'</a>';
		$text .= '</span>';
		return $text;
	}

}
