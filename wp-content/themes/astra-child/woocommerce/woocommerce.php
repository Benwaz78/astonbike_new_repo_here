<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WooCommerce Files
 */

require_once get_stylesheet_directory() . '/woocommerce/merchandising/product-flags.php';
require_once get_stylesheet_directory() . '/woocommerce/merchandising/product-queries.php';
require_once get_stylesheet_directory() . '/woocommerce/merchandising/archive-filters.php';
require_once get_stylesheet_directory() . '/woocommerce/merchandising/template-functions.php';

require_once get_stylesheet_directory() . '/woocommerce/product-video/enqueue.php';
require_once get_stylesheet_directory() . '/woocommerce/product-video/product-video.php';