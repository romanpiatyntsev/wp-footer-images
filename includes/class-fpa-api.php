<?php

if (!defined('ABSPATH')) {
	exit;
}

class FPA_Api
{
	private $api_fpa_base;

	private $album_id;

	/**
	 * Photo Album Cache object
	 * @var FPA_Cache
	 */
	private $cache;

	public function __construct($album_id)
	{
		$this->cache = new FPA_Cache();
		$this->api_fpa_base = 'https://jsonplaceholder.typicode.com/photos';
		$this->album_id = $album_id;
	}

	/**
	 * Obtaine the images from the remote Photo Album
	 * @return Array
	 */
	public function get_remote_photo_album()
	{
		if( $this->cache->is_limit_request() ) { // limit to request is active

			$body = $this->cache->get_last_request();

		} else {

			$query_params = $this->get_query_params();
			$response = wp_remote_get( $this->api_fpa_base . '?' . $query_params );
	
			if ( 200 == wp_remote_retrieve_response_code( $response ) ) {
				$body = json_decode( wp_remote_retrieve_body( $response ) );
				$this->cache->update_last_request($body);
			} else {
				$body = $this->cache->get_last_request();
			}

			$this->cache->set_limit_request(1 * MINUTE_IN_SECONDS);
		}

		return $body;
	}

	private function get_query_params()
	{
		$args = array_filter( array(
			'albumId' => $this->album_id,
		) );
		$query_params = http_build_query( $args );
		return $query_params;
	}
}
