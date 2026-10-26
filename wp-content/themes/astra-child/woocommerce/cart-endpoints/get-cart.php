<?php

defined('ABSPATH') || exit;


/**
 * Oltouch Get Cart
 */
add_action(
    'wp_ajax_oltouch_get_cart',
    'oltouch_get_cart'
);

add_action(
    'wp_ajax_nopriv_oltouch_get_cart',
    'oltouch_get_cart'
);


function oltouch_get_cart() {

    if (!WC()->cart) {

        wp_send_json_error(
            array(
                'message' => 'Cart is unavailable.',
            )
        );
    }


    wp_send_json_success(
        oltouch_get_cart_data()
    );
}