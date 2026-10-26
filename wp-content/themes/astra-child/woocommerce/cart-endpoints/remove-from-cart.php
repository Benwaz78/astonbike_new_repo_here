<?php

defined('ABSPATH') || exit;


/**
 * Oltouch Remove From Cart
 */
add_action(
    'wp_ajax_oltouch_remove_from_cart',
    'oltouch_remove_from_cart'
);

add_action(
    'wp_ajax_nopriv_oltouch_remove_from_cart',
    'oltouch_remove_from_cart'
);


function oltouch_remove_from_cart() {

    /*
     * Cart item key.
     */
    $cart_item_key = isset($_POST['cart_item_key'])
        ? wc_clean(wp_unslash($_POST['cart_item_key']))
        : '';


    if (!$cart_item_key) {

        wp_send_json_error(
            array(
                'message' => 'Invalid cart item.',
            )
        );
    }


    /*
     * Make sure cart exists.
     */
    if (!WC()->cart) {

        wp_send_json_error(
            array(
                'message' => 'Cart is unavailable.',
            )
        );
    }


    /*
     * Make sure item exists.
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
     * Remove item.
     */
    $removed = WC()->cart->remove_cart_item(
        $cart_item_key
    );


    if (!$removed) {

        wp_send_json_error(
            array(
                'message' => 'Unable to remove item from cart.',
            )
        );
    }


    /*
     * Return complete updated cart.
     */
    wp_send_json_success(
        array(
            'message' => 'Product removed from cart.',
            'cart'    => oltouch_get_cart_data(),
        )
    );
}