<?php

/*
 * Plugin Name:       Footer Photo Album - Test Task
 * Description:       Would you like to get amazing pictures in the site footer? When activated you will get images from the remote album and will show them in the footer of the site's front page.
 * Version:           0.0.1
 * Author:            Roman Piatyntsev
 * Author URI:        https://www.linkedin.com/in/roman-piatyntsev/
 * License:           GPLv3 or later
 * License URI:	      https://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FPA_Footer_Photo_Album  {

	private static $_instance;

	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function __construct() {
		add_action( 'init', array( $this, 'launch' ), 10 );
	}

	public function launch() {
		$this->define_constants();
		$this->includes();
		( new FPA_Manager() )->run();
	}

	private function define_constants() {
		$this->define( 'FPA_DIR',     plugin_dir_path( __FILE__ ) );
		$this->define( 'FPA_URL',     plugin_dir_url( __FILE__ ) ) ;
		$this->define( 'FPA_VERSION', $this->get_plugin_meta( 'Version' ) ) ;
		$this->define( 'FPA_OPTION',  '__fpa_option' );
	}

	private function includes() {
		require_once FPA_DIR . 'includes/config/class-fpa-auto-loader.php';
	}

	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	private function get_plugin_meta( $key ) {
		$plugin_meta = get_file_data( __FILE__, array( $key => $key ), false );
		return $plugin_meta == null ? '' : $plugin_meta[ $key ];
	}
}

FPA_Footer_Photo_Album::get_instance();