<?php
/*
Plugin Name: Twitter Profile Field
Description: Add Twitter to the Contact Fields section of the Edit User/Profile page
Version: 5.1
Author: Kailey Lampert
Author URI: kaileylampert.com
*/


$twitter_profile_field = new Twitter_Profile_Field();

class Twitter_Profile_Field {

	function __construct() {
		add_filter( 'user_contactmethods', array( &$this, 'user_contactmethods' ) ) ;
	}

	function user_contactmethods( $contactmethods ) {
		$contactmethods['twitter'] = __( 'Twitter', 'twitter-profile-field' );
		return $contactmethods;
	}

}

?>

