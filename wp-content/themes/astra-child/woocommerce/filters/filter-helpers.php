<?php

defined( 'ABSPATH' ) || exit;



/**
 * Check whether a product category is selected.
 *
 * @param string $category_slug Category slug.
 * @return bool
 */
function shop_filter_is_category_selected( $category_slug ) {

	$selected_categories = shop_filter_get_selected_categories();

	return in_array(
		sanitize_title( $category_slug ),
		$selected_categories,
		true
	);
}


/**
 * Check whether an attribute term is selected.
 *
 * @param string $attribute_name Attribute name.
 * @param string $term_slug      Term slug.
 * @return bool
 */
function shop_filter_is_attribute_selected(
	$attribute_name,
	$term_slug
) {

	$selected_attributes = shop_filter_get_selected_attributes();

	$attribute_name = sanitize_key(
		$attribute_name
	);

	$term_slug = sanitize_title(
		$term_slug
	);

	if (
		empty( $selected_attributes[ $attribute_name ] )
	) {
		return false;
	}

	return in_array(
		$term_slug,
		$selected_attributes[ $attribute_name ],
		true
	);
}



/**
 * Get the filter form action URL.
 *
 * Preserves the current product collection.
 *
 * @return string
 */
function shop_filter_get_form_action() {

	$collection = sanitize_key(
		get_query_var( 'collection', '' )
	);

	if ( $collection ) {

		return shop_get_product_collection_url(
			$collection
		);
	}

	return home_url( '/my-shop/' );
}


/**
 * Get the selected minimum price.
 *
 * @return string
 */
function shop_filter_get_min_price() {

	if ( ! isset( $_GET['min_price'] ) ) {
		return '';
	}

	return wc_format_decimal(
		wp_unslash( $_GET['min_price'] )
	);
}


/**
 * Get the selected maximum price.
 *
 * @return string
 */
function shop_filter_get_max_price() {

	if ( ! isset( $_GET['max_price'] ) ) {
		return '';
	}

	return wc_format_decimal(
		wp_unslash( $_GET['max_price'] )
	);
}


/**
 * Get the URL for a product category filter.
 *
 * Preserves the current product collection.
 *
 * @param string $category_slug Product category slug.
 * @return string
 */
function shop_filter_get_category_url( $category_slug ) {

	$category_slug = sanitize_title( $category_slug );

	if ( ! $category_slug ) {
		return '';
	}

	/*
	 * Get the current product collection.
	 */
	$collection = sanitize_key(
		get_query_var( 'collection', '' )
	);


	/*
	 * Start with the correct shop URL.
	 */
	if ( $collection ) {

		$url = shop_get_product_collection_url(
			$collection
		);

	} else {

		$url = home_url( '/my-shop/' );
	}


	/*
	 * Add the selected category.
	 */
	return add_query_arg(
		'product_cat',
		$category_slug,
		$url
	);
}


/**
 * Get the URL for an attribute filter.
 *
 * @param string $attribute_name Attribute name.
 * @param string $term_slug      Attribute term slug.
 * @return string
 */
function shop_filter_get_attribute_url(
	$attribute_name,
	$term_slug
) {

	$attribute_name = sanitize_key(
		$attribute_name
	);

	$term_slug = sanitize_title(
		$term_slug
	);

	if ( ! $attribute_name || ! $term_slug ) {
		return '';
	}


	/*
	 * Preserve the current product collection.
	 */
	$collection = sanitize_key(
		get_query_var( 'collection', '' )
	);


	if ( $collection ) {

		$url = shop_get_product_collection_url(
			$collection
		);

	} else {

		$url = home_url( '/my-shop/' );
	}


	/*
	 * Add the attribute filter.
	 */
	$url = add_query_arg(
		'filter_' . $attribute_name,
		$term_slug,
		$url
	);


	return $url;
}