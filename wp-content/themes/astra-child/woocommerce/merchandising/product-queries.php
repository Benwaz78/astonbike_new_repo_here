<?php
/**
 * Product Queries
 *
 * @package BrightAngel
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Featured Collection
 *
 * Products marked as either
 * New In OR Best Seller.
 */
function ba_get_featured_collection( $posts_per_page = 8 ) {

	return new WP_Query(
		array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'posts_per_page' => $posts_per_page,

			'meta_query' => array(
				'relation' => 'OR',

				array(
					'key'   => '_ba_new_in',
					'value' => 'yes',
				),

				array(
					'key'   => '_ba_best_seller',
					'value' => 'yes',
				),

				array(
					'key'   => '_ba_sales',
					'value' => 'yes',
				),
			),
		)
	);
}