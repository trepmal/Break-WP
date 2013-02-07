<?php
/*
Plugin Name: TinyMCE Font Family
Description: Add font family option to TinyMCE/Visual editor
Version: 1
Author: Kailey Lampert
Author URI: kaileylampert.com
*/


$tinymce_font_family = new TinyMCE_Font_Family;

class TinyMCE_Font_Family {

	function __construct() {
		// modify the buttons on the second row
		add_filter( 'mce_buttons_2', array( &$this, 'mce_buttons_2' ) );
	}

	function mce_buttons_2( $mce_buttons ) {

		// find and remove "underline" button
		$underline = array_search( 'underline', $mce_buttons );
		unset( $mce_buttons[ $underline ] );

		// find and remove 'paste from word' button
		$pasteword = array_search( 'pasteword', $mce_buttons );
		unset( $mce_buttons[ $pasteword ] );

		// insert new button where underline used to be
		array_splice( $mce_buttons, $underline, 0, 'fontselect' );

		return $mce_buttons;

	}
}
