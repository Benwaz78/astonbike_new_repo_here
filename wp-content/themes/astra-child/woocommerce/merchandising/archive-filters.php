<?php
/**
 * Merchandising Archives
 *
 * @package BrightAngel
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register query vars.
 */
add_filter( 'query_vars', 'ba_merchandising_query_vars' );

function ba_merchandising_query_vars( $vars ) {

	$vars[] = 'product_display';

	return $vars;
}


/**
 * Rewrite Rules
 */
add_action( 'init', 'ba_merchandising_rewrite_rules' );

function ba_merchandising_rewrite_rules() {

	add_rewrite_rule(
		'^shop/new-in/?$',
		'index.php?post_type=product&product_display=new-in',
		'top'
	);

	add_rewrite_rule(
		'^shop/best-seller/?$',
		'index.php?post_type=product&product_display=best-seller',
		'top'
	);

	add_rewrite_rule(
		'^shop/sales/?$',
		'index.php?post_type=product&product_display=sales',
		'top'
	);
}

/**
 * Filter Shop Query
 */
add_action( 'pre_get_posts', 'ba_filter_merchandising_archive' );

function ba_filter_merchandising_archive( $query ) {

	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	$display = get_query_var( 'product_display' );

	if ( empty( $display ) ) {
		return;
	}

	if ( 'new-in' === $display ) {

		$query->set(
			'meta_query',
			array(
				array(
					'key'   => '_ba_new_in',
					'value' => 'yes',
				),
			)
		);

	}

	if ( 'best-seller' === $display ) {

		$query->set(
			'meta_query',
			array(
				array(
					'key'   => '_ba_best_seller',
					'value' => 'yes',
				),
			)
		);

	}

	if ( 'sales' === $display ) {

		$query->set(
			'meta_query',
			array(
				array(
					'key'   => '_ba_sales',
					'value' => 'yes',
				),
			)
		);

	}
}