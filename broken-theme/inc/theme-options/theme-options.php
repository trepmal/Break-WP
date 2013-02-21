<?php
/**
 * Stripay Theme Options
 *
 * @package Stripay
 * @since Stripay 1.0
 */

/**
 * Register the form setting for our stripay_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, stripay_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are complete, properly
 * formatted, and safe.
 *
 * We also use this function to add our theme option if it doesn't already exist.
 *
 * @since Stripay 1.0
 */
 
function stripay_theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( false === stripay_get_theme_options() )
		add_option( 'stripay_theme_options', stripay_get_default_theme_options() );

	register_setting(
		'stripay_options',       // Options group, see settings_fields() call in stripay_theme_options_render_page()
		'stripay_theme_options', // Database option, see stripay_get_theme_options()
		'stripay_theme_options_validate' // The sanitization callback, see stripay_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see stripay_theme_options_add_page()
	);

	/* Register our individual settings fields */

	add_settings_field( 'stripay_theme_style', __( 'Theme Style', 'stripay' ), 'stripay_settings_field_theme_style', 'theme_options', 'general' );
	

}
add_action( 'admin_init', 'stripay_theme_options_init' );

/**
 * Change the capability required to save the 'stripay_options' options group.
 *
 * @see stripay_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see stripay_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function stripay_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_stripay_options', 'stripay_option_page_capability' );

/**
 * Add our theme options page to the admin menu, including some help documentation.
 *
 * This function is attached to the admin_menu action hook.
 *
*/

function stripay_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'stripay' ),   // Name of page
		__( 'Theme Options', 'stripay' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'theme_options',                         // Menu slug, used to uniquely identify the page
		'stripay_theme_options_render_page' // Function that renders the options page
	);

	if ( ! $theme_page )
		return;
}
add_action( 'admin_menu', 'stripay_theme_options_add_page' );

/**
 * Returns an array of sample radio options registered for _s.
 *
*/

function stripay_theme_style() {
	$stripay_theme_style = array(
		'mustard' => array(
			'value' => 'mustard',
			'label' => __( 'Mustard', 'stripay' )
		),
		'fushia' => array(
			'value' => 'fushia',
			'label' => __( 'Fushia', 'stripay' )
		),
		'green' => array(
			'value' => 'green',
			'label' => __( 'Green', 'stripay' )
		),
		'grayscale' => array(
			'value' => 'grayscale',
			'label' => __( 'Grayscale', 'stripay' )
		)
	);

	return apply_filters( 'stripay_theme_style', $stripay_theme_style );
}

/**
 * Returns the default options for Stripay.
 *
*/

function stripay_get_default_theme_options() {
	$default_theme_options = array(
		'stripay_theme_style' => 'mustard'
	);

	return apply_filters( 'stripay_default_theme_options', $default_theme_options );
}

/**
 * Returns the options array for Stripay.
 *
*/

function stripay_get_theme_options() {
	return get_option( 'stripay_theme_options', stripay_get_default_theme_options() );
}

/**
 * Renders the Theme Style setting field.
 *
*/

function stripay_settings_field_theme_style() {
	$options = stripay_get_theme_options();

	foreach ( stripay_theme_style() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<img src="<?php echo get_template_directory_uri() ?>/images/ss/<?php echo $button['value']; ?>.png" alt="<?php echo $button['label']; ?> Style" /><br />
			<input type="radio" name="stripay_theme_options[theme_style]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['theme_style'], $button['value'] ); ?> />
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	}
}


/**
 * Returns the options array for Stripay.
 *
*/

function stripay_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'stripay' ), wp_get_theme() ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'stripay_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see stripay_theme_options_init()
 * @todo set up Reset Options action
 *
*/

function stripay_theme_options_validate( $input ) {
	$output = $defaults = stripay_get_default_theme_options();

	// The sample Theme Styles value must be in our array of Theme Styles values
	if ( isset( $input['theme_style'] ) && array_key_exists( $input['theme_style'], stripay_theme_style() ) )
		$output['theme_style'] = $input['theme_style'];


	return apply_filters( 'stripay_theme_options_validate', $output, $input, $defaults );
}

/**
 * Theme Options Admin Styles
*/

function stripay_theme_options_admin_styles() {
	echo "<style type='text/css'>";
	echo ".layout .description { width: 300px; float: left; text-align: center; margin-bottom: 10px; padding: 10px; }";
	echo "</style>";
}

add_action( 'admin_enqueue_scripts', 'stripay_theme_options_admin_styles' );

?>