<?php

defined('ABSPATH') || exit;


/**
 * Oltouch Update Cart Quantity
 */
add_action(
    'wp_ajax_oltouch_update_quantity',
    'oltouch_update_quantity'
);

add_action(
    'wp_ajax_nopriv_oltouch_update_quantity',
    'oltouch_update_quantity'
);


function oltouch_update_quantity() {

    /*
     * Cart item key.
     */
    $cart_item_key = isset($_POST['cart_item_key'])
        ? wc_clean(wp_unslash($_POST['cart_item_key']))
        : '';


    /*
     * Quantity.
     */
    $quantity = isset($_POST['quantity'])
        ? absint($_POST['quantity'])
        : 0;


    if (!$cart_item_key) {

        wp_send_json_error(
            array(
                'message' => 'Invalid cart item.',
            )
        );
    }


    if ($quantity < 1) {

        wp_send_json_error(
            array(
                'message' => 'Quantity must be at least 1.',
            )
        );
    }


    /*
     * Make sure WooCommerce cart exists.
     */
    if (!WC()->cart) {

        wp_send_json_error(
            array(
                'message' => 'Cart is unavailable.',
            )
        );
    }


    /*
     * Check that the cart item exists.
     */
    $cart = WC()->cart->get_cart();

    if (!isset($cart[$cart_item_key])) {

        wp_send_json_error(
            array(
                'message' => 'Cart item not found.',
            )
        );
    }


    /*
     * Get product.
     */
    $cart_item = $cart[$cart_item_key];

    $product = $cart_item['data'];


    if (!$product || !$product->exists()) {

        wp_send_json_error(
            array(
                'message' => 'Product not found.',
            )
        );
    }


    /*
     * Let WooCommerce validate the quantity.
     */
    $passed_validation =
        apply_filters(
            'woocommerce_update_cart_validation',
            true,
            $cart_item_key,
            $cart_item,
            $quantity
        );


    if (!$passed_validation) {

        wp_send_json_error(
            array(
                'message' => 'This quantity cannot be added to the cart.',
            )
        );
    }


    /*
     * Update cart quantity.
     */
    WC()->cart->set_quantity(
        $cart_item_key,
        $quantity,
        true
    );


    /*
     * Return the complete updated cart.
     */
    wp_send_json_success(
        array(
            'message' => 'Cart quantity updated.',
            'cart'    => oltouch_get_cart_data(),
        )
    );
}