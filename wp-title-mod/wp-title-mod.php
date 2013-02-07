<?php
/*
Plugin Name: WP_Title Mod
Description: 
Version: 1.0
Author: Kailey Lampert
Author URI: kaileylampert.com
*/

// I saw this great function in Twenty Twelve and didn't change the function name!
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return str_replace( '|', '~', $title );
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );
