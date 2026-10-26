<?php

/**
 * Get active promotion information for a product.
 *
 * @param WC_Product $product Product object.
 * @return array
 */


function shop_get_product_promotion_data( $product ) {

	if ( ! $product instanceof WC_Product ) {
		return array(
			'type'     => '',
			'label'    => '',
			'discount' => 0,
		);
	}

	if ( shop_global_promotion_applies( $product ) ) {

		$discount = shop_get_global_promotion_discount();

		return array(
			'type'     => 'promotion',
			'label'    => 'Promotion',
			'discount' => (int) round( $discount ),
		);
	}

	if ( $product->is_on_sale() ) {

		$discount = shop_get_product_discount( $product );

		return array(
			'type'     => 'sale',
			'label'    => 'Sale',
			'discount' => $discount,
		);
	}

	return array(
		'type'     => '',
		'label'    => '',
		'discount' => 0,
	);
}





/**
 * Get the global store promotion settings.
 *
 * @return array
 */
function shop_get_global_promotion() {

    return array(
        'enabled'           => (bool) get_option( 'shop_promotion_enabled', false ),
        'discount'          => (float) get_option( 'shop_promotion_discount', 0 ),
        'exclude_sale'      => (bool) get_option( 'shop_promotion_exclude_sale', true ),
        'start_date'        => get_option( 'shop_promotion_start_date', '' ),
        'end_date'          => get_option( 'shop_promotion_end_date', '' ),
    );
}


/**
 * Check whether the global promotion is currently active.
 *
 * @return bool
 */
function shop_is_global_promotion_active() {

    $promotion = shop_get_global_promotion();

    if ( ! $promotion['enabled'] ) {
        return false;
    }

    if ( $promotion['discount'] <= 0 || $promotion['discount'] >= 100 ) {
        return false;
    }

    $current_date = current_time( 'Y-m-d' );

    if ( $promotion['start_date'] && $current_date < $promotion['start_date'] ) {
        return false;
    }

    if ( $promotion['end_date'] && $current_date > $promotion['end_date'] ) {
        return false;
    }

    return true;
}


/**
 * Get the global promotion discount percentage.
 *
 * @return float
 */
function shop_get_global_promotion_discount() {

    if ( ! shop_is_global_promotion_active() ) {
        return 0;
    }

    $promotion = shop_get_global_promotion();

    return $promotion['discount'];
}


/**
 * Check whether the global promotion applies to a product.
 *
 * @param WC_Product $product Product object.
 * @return bool
 */
function shop_global_promotion_applies( $product ) {

    if ( ! $product instanceof WC_Product ) {
        return false;
    }

    if ( ! shop_is_global_promotion_active() ) {
        return false;
    }

    $promotion = shop_get_global_promotion();

    /*
     * Exclude products that already have a WooCommerce sale price.
     */
   if ( $promotion['exclude_sale'] && $product->get_sale_price() !== '' ) {
		return false;
	}

    return true;
}


/**
 * Calculate the global promotional price.
 *
 * @param WC_Product $product Product object.
 * @return float
 */
function shop_get_global_promotion_price( $product ) {

    if ( ! shop_global_promotion_applies( $product ) ) {
        return (float) $product->get_price();
    }

    $regular_price = (float) $product->get_regular_price();

    if ( $regular_price <= 0 ) {
        return (float) $product->get_price();
    }

    $discount = shop_get_global_promotion_discount();

    return round(
        $regular_price * ( 1 - ( $discount / 100 ) ),
        wc_get_price_decimals()
    );
}


/**
 * Apply global promotion price.
 *
 * @param string|float $price   Current product price.
 * @param WC_Product   $product Product object.
 * @return string|float
 */
function shop_apply_global_promotion_price( $price, $product ) {

    if ( is_admin() && ! wp_doing_ajax() ) {
        return $price;
    }

    if ( ! $product instanceof WC_Product ) {
        return $price;
    }

    if ( ! shop_global_promotion_applies( $product ) ) {
        return $price;
    }

    /*
     * Start from the current selling price.
     *
     * If the product already has a Sale Price,
     * the promotion will be applied on top of that
     * price when sale products are allowed.
     */
    $base_price = $product->get_sale_price();

    if ( $base_price === '' ) {
        $base_price = $product->get_regular_price();
    }

    $base_price = (float) $base_price;

    if ( $base_price <= 0 ) {
        return $price;
    }

    $discount = shop_get_global_promotion_discount();

    return round(
        $base_price * ( 1 - ( $discount / 100 ) ),
        wc_get_price_decimals()
    );
}

add_filter(
    'woocommerce_product_get_price',
    'shop_apply_global_promotion_price',
    20,
    2
);

add_filter(
    'woocommerce_product_variation_get_price',
    'shop_apply_global_promotion_price',
    20,
    2
);

