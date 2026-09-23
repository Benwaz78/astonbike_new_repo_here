<?php
/**
 * Merchandising Helper Functions
 *
 * @package BrightAngel
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if product is marked as New In.
 */
function ba_is_new_in( $product_id = 0 ) {

	$product_id = $product_id ? $product_id : get_the_ID();

	return 'yes' === get_post_meta( $product_id, '_ba_new_in', true );
}

/**
 * Check if product is marked as Best Seller.
 */
function ba_is_best_seller( $product_id = 0 ) {

	$product_id = $product_id ? $product_id : get_the_ID();

	return 'yes' === get_post_meta( $product_id, '_ba_best_seller', true );
}


/**
 * Check if product is marked as Sales.
 */
function ba_is_sales( $product_id = 0 ) {

	$product_id = $product_id ? $product_id : get_the_ID();

	return 'yes' === get_post_meta( $product_id, '_ba_sales', true );
}


/**
 * Return CSS classes for product.
 */
function ba_get_product_display_classes( $product_id = 0 ) {

	$product_id = $product_id ? $product_id : get_the_ID();

	$classes = array();

	if ( ba_is_new_in( $product_id ) ) {
		$classes[] = 'new-in';
	}

	if ( ba_is_best_seller( $product_id ) ) {
		$classes[] = 'best-seller';
	}

	if ( ba_is_sales( $product_id ) ) {
		$classes[] = 'sales';
	}

	return implode( ' ', $classes );
}