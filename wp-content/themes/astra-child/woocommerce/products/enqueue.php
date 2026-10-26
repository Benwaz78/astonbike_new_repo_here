<?php
/**
 * Product assets.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue product variation styles and scripts.
 */
function theme_enqueue_product_assets() {

	$is_product_context =
		is_product() ||
		is_shop() ||
		is_page() ||
		is_product_category() ||
		is_product_tag() ||
		is_search();

	if ( ! $is_product_context ) {
		return;
	}

	$asset_uri = get_stylesheet_directory_uri() . '/woocommerce/products/assets';

	$css_file = get_stylesheet_directory() . '/woocommerce/products/assets/css/product.css';
	$js_file  = get_stylesheet_directory() . '/woocommerce/products/assets/js/product.js';

	wp_enqueue_style(
		'theme-product-variations',
		$asset_uri . '/css/product.css',
		array(),
		file_exists( $css_file ) ? filemtime( $css_file ) : wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_script(
		'theme-product-variations',
		$asset_uri . '/js/product.js',
		array( 'jquery' ),
		file_exists( $js_file ) ? filemtime( $js_file ) : wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_product_assets' );