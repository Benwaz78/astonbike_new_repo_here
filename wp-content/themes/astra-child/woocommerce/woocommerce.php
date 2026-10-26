<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WooCommerce Files
 */



require_once get_stylesheet_directory() . '/woocommerce/product-video/enqueue.php';
require_once get_stylesheet_directory() . '/woocommerce/product-video/product-video.php';

require_once get_stylesheet_directory() . '/woocommerce/products/product.php';
require_once get_stylesheet_directory() . '/woocommerce/products/enqueue.php';

require_once get_stylesheet_directory() . '/woocommerce/merchandising/merchandising.php';
require_once get_stylesheet_directory() . '/woocommerce/filters/filters.php';
require_once get_stylesheet_directory() . '/woocommerce/quick-view-endpoint/enqueue.php';
require_once get_stylesheet_directory() . '/woocommerce/cart-endpoints/cart-bootstrap.php';
require_once get_stylesheet_directory() . '/woocommerce/quick-view-endpoint/quick-view.php';
