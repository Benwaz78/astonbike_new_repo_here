<?php

defined( 'ABSPATH' ) || exit;


/**
 * Check whether a product is a new arrival.
 *
 * A product is considered a new arrival when
 * it was published within the configured number
 * of days.
 *
 * @param WC_Product $product Product object.
 * @return bool
 */
function shop_is_new_arrival( $product ) {

    if ( ! $product instanceof WC_Product ) {
        return false;
    }

    $days = (int) get_option(
        'shop_new_arrival_days',
        30
    );

    if ( $days <= 0 ) {
        return false;
    }

    $published_timestamp = get_post_timestamp(
        $product->get_id(),
        'date'
    );

    if ( ! $published_timestamp ) {
        return false;
    }

    $current_timestamp = current_time( 'timestamp' );

    $age = $current_timestamp - $published_timestamp;

    return $age >= 0 && $age <= ( $days * DAY_IN_SECONDS );
}



/**
 * Get the cache key used for Best Seller sales data.
 *
 * @return string
 */
function shop_get_best_seller_cache_key() {

	$days = (int) get_option(
		'shop_best_seller_days',
		30
	);

	return 'shop_best_seller_sales_' . $days;
}


/**
 * Clear the Best Seller sales cache.
 *
 * @return void
 */
function shop_clear_best_seller_cache() {

	delete_transient(
		shop_get_best_seller_cache_key()
	);
}


/**
 * Get product sales within the configured Best Seller period.
 *
 * The result is an array where:
 *
 * product ID => units sold
 *
 * Example:
 *
 * array(
 *     123 => 8,
 *     124 => 3,
 *     125 => 12,
 * )
 *
 * @return array
 */
function shop_get_best_seller_sales() {

	$days = (int) get_option(
		'shop_best_seller_days',
		30
	);

	if ( $days <= 0 ) {
		return array();
	}

	$cache_key = shop_get_best_seller_cache_key();

	$cached_sales = get_transient( $cache_key );

	if ( false !== $cached_sales && is_array( $cached_sales ) ) {
		return $cached_sales;
	}

	$sales = array();

	$current_timestamp = current_time( 'timestamp' );

	$start_date = wp_date(
		'Y-m-d H:i:s',
		$current_timestamp - ( $days * DAY_IN_SECONDS )
	);

	$end_date = wp_date(
		'Y-m-d H:i:s',
		$current_timestamp
	);

	$page = 1;

	do {

		$order_query = wc_get_orders(
			array(
				'status' => array(
					'wc-processing',
					'wc-completed',
				),

				'date_created' => $start_date . '...' . $end_date,

				'limit' => 100,

				'page' => $page,

				'paginate' => true,

				'return' => 'ids',
			)
		);

		if ( empty( $order_query->orders ) ) {
			break;
		}

		foreach ( $order_query->orders as $order_id ) {

			$order = wc_get_order( $order_id );

			if ( ! $order ) {
				continue;
			}

			foreach ( $order->get_items( 'line_item' ) as $item_id => $item ) {

				$quantity = (int) $item->get_quantity();

				/*
				 * Remove refunded quantities so Best Seller
				 * represents actual units sold.
				 */
				$refunded_quantity = (int) $order->get_qty_refunded_for_item(
					$item_id
				);

				$quantity = max(
					0,
					$quantity - $refunded_quantity
				);

				if ( $quantity <= 0 ) {
					continue;
				}

				$product_id   = (int) $item->get_product_id();
				$variation_id = (int) $item->get_variation_id();

				/*
				 * Add sales to the parent product.
				 *
				 * This means all variations contribute
				 * to the variable product's Best Seller count.
				 */
				if ( $product_id > 0 ) {

					if ( ! isset( $sales[ $product_id ] ) ) {
						$sales[ $product_id ] = 0;
					}

					$sales[ $product_id ] += $quantity;
				}

				/*
				 * Also store sales against the variation itself.
				 *
				 * This makes the function work correctly
				 * if it is ever called with a variation product.
				 */
				if ( $variation_id > 0 ) {

					if ( ! isset( $sales[ $variation_id ] ) ) {
						$sales[ $variation_id ] = 0;
					}

					$sales[ $variation_id ] += $quantity;
				}
			}
		}

		$page++;

	} while ( $page <= $order_query->max_num_pages );

	/*
	 * Cache the result for one hour.
	 *
	 * Product cards will reuse this result instead
	 * of querying orders repeatedly.
	 */
	set_transient(
		$cache_key,
		$sales,
		HOUR_IN_SECONDS
	);

	return $sales;
}



/**
 * Check whether a product is a Best Seller.
 *
 * A product qualifies if it is manually marked as a
 * Best Seller or meets the automatic sales threshold.
 *
 * @param WC_Product $product Product object.
 * @return bool
 */
function shop_is_best_seller( $product ) {

	if ( ! $product instanceof WC_Product ) {
		return false;
	}


	/*
	 * Manual Best Seller designation.
	 */
	if (
		'yes' === $product->get_meta(
			'_shop_manual_best_seller',
			true
		)
	) {
		return true;
	}


	/*
	 * Automatic Best Seller detection.
	 */
	$minimum_units = (int) get_option(
		'shop_best_seller_minimum_units',
		5
	);

	if ( $minimum_units <= 0 ) {
		return false;
	}

	$sales = shop_get_best_seller_sales();

	$product_id = $product->get_id();

	$units_sold = isset( $sales[ $product_id ] )
		? (int) $sales[ $product_id ]
		: 0;

	return $units_sold >= $minimum_units;
}


/**
 * Clear Best Seller cache when an order
 * enters or leaves a counted status.
 *
 * @param int      $order_id Order ID.
 * @param string   $from     Previous status.
 * @param string   $to       New status.
 * @param WC_Order $order    Order object.
 * @return void
 */
function shop_handle_best_seller_order_status_change(
	$order_id,
	$from,
	$to,
	$order
) {

	$tracked_statuses = array(
		'processing',
		'completed',
	);

	if (
		in_array( $from, $tracked_statuses, true ) ||
		in_array( $to, $tracked_statuses, true )
	) {
		shop_clear_best_seller_cache();
	}
}

add_action(
	'woocommerce_order_status_changed',
	'shop_handle_best_seller_order_status_change',
	10,
	4
);


/**
 * Clear Best Seller cache when an order is refunded.
 */
add_action(
	'woocommerce_order_partially_refunded',
	'shop_clear_best_seller_cache'
);

add_action(
	'woocommerce_order_fully_refunded',
	'shop_clear_best_seller_cache'
);





/**
 * Check whether a product is on sale.
 *
 * @param WC_Product $product Product object.
 * @return bool
 */
function shop_is_product_on_sale( $product ) {

    if ( ! $product instanceof WC_Product ) {
        return false;
    }

    return $product->is_on_sale();
}


/**
 * Get product labels.
 *
 * This is the central function used by
 * product cards, menus and product filters.
 *
 * @param WC_Product $product Product object.
 * @return array
 */
function shop_get_product_labels( $product ) {

    if ( ! $product instanceof WC_Product ) {
        return array();
    }

    $labels = array();

    if ( shop_is_new_arrival( $product ) ) {

        $labels['new-arrival'] = array(
            'label' => 'New Arrival',
            'class' => 'new-arrival',
        );

    }

    if ( shop_is_best_seller( $product ) ) {

        $labels['best-seller'] = array(
            'label' => 'Best Seller',
            'class' => 'best-seller',
        );

    }

    if ( shop_is_product_on_sale( $product ) ) {

        $labels['sale'] = array(
            'label' => 'Sale',
            'class' => 'sale',
        );

    }

    return $labels;
}





/**
 * Get product discount percentage.
 *
 * Handles simple and variable products.
 *
 * @param WC_Product $product Product object.
 * @return int Discount percentage.
 */
function shop_get_product_discount( $product ) {

	if ( ! $product instanceof WC_Product || ! $product->is_on_sale() ) {
		return 0;
	}

	/*
	 * Simple product.
	 */
	if ( $product->is_type( 'simple' ) ) {

		$regular_price = (float) $product->get_regular_price();
		$sale_price    = (float) $product->get_sale_price();

		if ( $regular_price <= 0 || $sale_price <= 0 || $sale_price >= $regular_price ) {
			return 0;
		}

		return (int) round(
			( ( $regular_price - $sale_price ) / $regular_price ) * 100
		);
	}

	/*
	 * Variable product.
	 */
	if ( $product->is_type( 'variable' ) ) {

		$variation_prices = $product->get_variation_prices( true );

		if ( empty( $variation_prices['regular_price'] ) ) {
			return 0;
		}

		$highest_discount = 0;

		foreach ( $variation_prices['regular_price'] as $variation_id => $regular_price ) {

			$sale_price = $variation_prices['sale_price'][ $variation_id ];

			if ( ! $sale_price || $regular_price <= 0 || $sale_price >= $regular_price ) {
				continue;
			}

			$discount = (int) round(
				( ( $regular_price - $sale_price ) / $regular_price ) * 100
			);

			if ( $discount > $highest_discount ) {
				$highest_discount = $discount;
			}
		}

		return $highest_discount;
	}

	return 0;
}