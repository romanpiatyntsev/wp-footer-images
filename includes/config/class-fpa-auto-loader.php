<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FPA_Auto_Loader {

	private $dirs = array();

	public function __construct() {
		spl_autoload_register( array( $this, 'loader' ) );
	}

	public function register() {
		$this->dirs = array(
			FPA_DIR,
			FPA_DIR . 'includes/',
			FPA_DIR . 'includes/config/',
		);
	}

	public function loader( $classname ) {
		$classname = strtolower( $classname );
		$classname = str_replace( '_','-', $classname );
		foreach ( $this->dirs as $dir ) {
			$file = "{$dir}class-{$classname}.php";
			if ( file_exists( $file ) ) {
				require_once $file;
				return;
			}
		}
	}
}

$auto_loader = new FPA_Auto_Loader();
$auto_loader->register();