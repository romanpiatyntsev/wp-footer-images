<?php

if (!defined('ABSPATH')) {
	exit;
}

class FPA_Cache
{
	public function is_limit_request() {
		return get_transient( FPA_OPTION ); 
	}

	public function set_limit_request($expiration) {
		set_transient( FPA_OPTION, true, $expiration); 
	}

	public function get_last_request() {
		return get_option( FPA_OPTION ); 
	}

	public function update_last_request( $images ) {
		update_option( FPA_OPTION, $images, false ); 
	}
}
