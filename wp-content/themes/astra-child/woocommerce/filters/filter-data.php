<?php

defined( 'ABSPATH' ) || exit;


/**
 * Get product categories available for filtering.
 *
 * @return WP_Term[]
 */
function shop_filter_get_categories() {

	$categories = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
		)
	);

	if ( is_wp_error( $categories ) ) {
		return array();
	}

	return $categories;
}


/**
 * Get product attributes available for filtering.
 *
 * @return array
 */
function shop_filter_get_attributes() {

	$attributes = wc_get_attribute_taxonomies();

	if ( empty( $attributes ) ) {
		return array();
	}

	return $attributes;
}




/**
 * Get terms for a product attribute.
 *
 * @param string $attribute_name Attribute name.
 * @return WP_Term[]
 */
function shop_filter_get_attribute_terms( $attribute_name ) {

	$taxonomy = wc_attribute_taxonomy_name(
		$attribute_name
	);

	$terms = get_terms(
		array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => true,
		)
	);

	if ( is_wp_error( $terms ) ) {
		return array();
	}

	return $terms;
}