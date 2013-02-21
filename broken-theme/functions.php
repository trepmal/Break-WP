<?php
/**
 * stripay functions and definitions
 *
 * @package stripay
 * @since stripay 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since stripay 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 620; /* pixels */

if ( ! function_exists( 'stripay_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since stripay 1.0
 */
function stripay_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );
	
	/**
	 * Custom Theme Options
	 */
	require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on stripay, use a find and replace
	 * to change 'stripay' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'stripay', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'stripay' ),
	) );

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
	
	add_editor_style();
	
	//Add features images support 
	add_theme_support( 'post-thumbnails' ); 
	set_post_thumbnail_size( 640, 200, true );
	
	// Add support for custom backgrounds
	add_theme_support( 'custom-background' );
	
}
endif; // stripay_setup
add_action( 'after_setup_theme', 'stripay_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since stripay 1.0
 */
function stripay_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'stripay' ),
		'id' => 'sidebar-1',
		'description' => __( 'Your main sidebar column', 'stripay' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	// Area 2, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'stripay' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'stripay' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'stripay' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'stripay' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'stripay' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'stripay' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'stripay' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'stripay' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'stripay_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function stripay_scripts() {
	global $post;
	
	if ( ! is_admin() ) {
		
		$options = get_option('stripay_theme_options');
		
		$stripay_themestyle = $options['theme_style'];
		
		if ( file_exists( get_template_directory() . '/css/fushia.css' ) && 'fushia' == $stripay_themestyle ) {
			wp_enqueue_style( 'stripay_fushia', get_template_directory_uri() . '/css/fushia.css' );
			
		} else if ( file_exists( get_template_directory() . '/css/green.css' ) && 'green' == $stripay_themestyle ) {
			wp_enqueue_style( 'stripay_green', get_template_directory_uri() . '/css/green.css' );

		} else if ( file_exists( get_template_directory() . '/css/grayscale.css' ) && 'grayscale' == $stripay_themestyle ) {
			wp_enqueue_style( 'stripay_grayscale', get_template_directory_uri() . '/css/grayscale.css' );

		} else if ( file_exists( get_template_directory() . '/css/mustard.css' ) && 'mustard' == $stripay_themestyle ) {
			wp_enqueue_style( 'stripay_mustard', get_template_directory_uri() . '/css/mustard.css' );

		}
						
	}
	
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
	wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lora|Oswald:400');

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', 'jquery', '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'stripay_scripts' );


/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' )


//sld_register_post_type( 'project' );