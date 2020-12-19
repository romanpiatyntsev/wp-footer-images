<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	class FPA_Manager
	{
		/**
		 * Photo Album API access object
		 * @var FPA_Api
		 */
		private $api_provider;

		/**
		 * Photo Album Cache object
		 * @var FPA_Cache
		 */
		private $cache;

		public function __construct() {
			$this->api_provider = new FPA_Api( $album_id = 2 );
			$this->cache = new FPA_Cache();
		}

		public function run() {
			add_action( 'wp_enqueue_scripts', array( $this, 'load_assets' ), 10 );
			add_action( 'wp_footer', array( $this, 'album_render' ), 10 );
		}

		/**
		 * Insert template to the footer
		 */
		public function album_render() {
			if ( $this->is_load() ) {
				$fpa_images = $this->api_provider->get_remote_photo_album();
				include( $this->get_template('fpa-footer-template') );
			}
		}

		public function load_assets() {
			if( $this->is_load() ) {
				wp_enqueue_style( 'fpa', FPA_URL . '/assets/css/fpa-style.css', array(), FPA_VERSION );
			}
		}

		private function get_template($name) {
			if ( '' === ( $template = locate_template( "fpa/{$name}.php" ) ) ) {
				$template = FPA_DIR . "templates/{$name}.php";
			}
			return $template;
		}

		private function is_load(){
			return is_front_page();
		}
	}