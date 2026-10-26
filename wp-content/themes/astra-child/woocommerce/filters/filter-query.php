<?php

defined( 'ABSPATH' ) || exit;


/**
 * Get selected product categories.
 *
 * @return array
 */
function shop_filter_get_selected_categories() {

	if ( empty( $_GET['product_cat'] ) ) {
		return array();
	}

	$categories = wp_unslash(
		$_GET['product_cat']
	);

	if ( ! is_array( $categories ) ) {
		$categories = array( $categories );
	}

	return array_values(
		array_filter(
			array_map(
				'sanitize_title',
				$categories
			)
		)
	);
}


/**
 * Apply product filters to a query.
 *
 * @param array $query_args WP_Query arguments.
 * @return array
 */
function shop_filter_apply_to_query( $query_args ) {

	$selected_categories = shop_filter_get_selected_categories();

	if ( ! empty( $selected_categories ) ) {

		$query_args['tax_query'][] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $selected_categories,
		);
	}


	/*
	 * Product attributes.
	 */
	$selected_attributes = shop_filter_get_selected_attributes();

   foreach ( $selected_attributes as $attribute_name => $values ) {

	$taxonomy = wc_attribute_taxonomy_name(
		$attribute_name
	);




	$query_args['tax_query'][] = array(
		'taxonomy' => $taxonomy,
		'field'    => 'slug',
		'terms'    => $values,
	);
}

	/*
	 * Price filter.
	 */
	$min_price = shop_filter_get_min_price();
	$max_price = shop_filter_get_max_price();

	if ( '' !== $min_price || '' !== $max_price ) {

		$price_query = array(
			'key'  => '_price',
			'type' => 'NUMERIC',
		);

		if ( '' !== $min_price ) {

			$price_query['value'][] = (float) $min_price;
			$price_query['compare'] = '>=';
		}

		if ( '' !== $max_price ) {

			if ( isset( $price_query['value'] ) ) {

				$price_query['value'][] = (float) $max_price;
				$price_query['compare'] = 'BETWEEN';

			} else {

				$price_query['value'] = (float) $max_price;
				$price_query['compare'] = '<=';
			}
		}

		if (
			isset( $price_query['value'] ) &&
			is_array( $price_query['value'] )
		) {

			$price_query['value'] = array_map(
				'floatval',
				$price_query['value']
			);
		}

		$query_args['meta_query'][] = $price_query;
	}


	return $query_args;
}

/**
 * Get selected product attributes.
 *
 * @return array
 */
function shop_filter_get_selected_attributes() {

	$attributes = array();

	$registered_attributes = wc_get_attribute_taxonomies();

	if ( empty( $registered_attributes ) ) {
		return $attributes;
	}

	foreach ( $registered_attributes as $attribute ) {

		$attribute_name = sanitize_key(
			$attribute->attribute_name
		);

		$query_key = 'filter_' . $attribute_name;

		if ( empty( $_GET[ $query_key ] ) ) {
			continue;
		}

		$values = wp_unslash(
			$_GET[ $query_key ]
		);

		if ( ! is_array( $values ) ) {
			$values = array( $values );
		}

		$values = array_values(
			array_filter(
				array_map(
					'sanitize_title',
					$values
				)
			)
		);

		if ( ! empty( $values ) ) {

			$attributes[ $attribute_name ] = $values;
		}
	}


	return $attributes;
}