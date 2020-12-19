<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
	exit;
}

/**
 * Delete cahce
 */
delete_transient('__fpa_option');
delete_option( '__fpa_option' );
wp_cache_flush();