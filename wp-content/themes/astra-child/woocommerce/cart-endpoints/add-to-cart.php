<?php

defined('ABSPATH') || exit;


add_action(
    'wp_ajax_oltouch_add_to_cart',
    'oltouch_add_to_cart'
);

add_action(
    'wp_ajax_nopriv_oltouch_add_to_cart',
    'oltouch_add_to_cart'
);





function oltouch_add_to_cart() {

    $product_id = isset($_POST['product_id'])
        ? absint($_POST['product_id'])
        : 0;

    $quantity = isset($_POST['quantity'])
        ? max(1, absint($_POST['quantity']))
        : 1;


    /*
     * Variation information.
     */
    $variation_id = isset($_POST['variation_id'])
        ? absint($_POST['variation_id'])
        : 0;

    $variation = array();


    if (!empty($_POST['variation'])) {

        $variation_data = json_decode(
            wp_unslash($_POST['variation']),
            true
        );

        if (is_array($variation_data)) {

            $variation = $variation_data;

        }
    }


    /*
     * Validate product.
     */
    if (!$product_id) {

        wp_send_json_error(
            array(
                'message' => 'Invalid product.',
            )
        );
    }


    $product = wc_get_product($product_id);


    if (!$product) {

        wp_send_json_error(
            array(
                'message' => 'Product not found.',
            )
        );
    }


    if (!$product->is_purchasable()) {

        wp_send_json_error(
            array(
                'message' =>
                    'This product cannot be purchased.',
            )
        );
    }


    /*
     * Variable product.
     */
    if ($product->is_type('variable')) {

        if (!$variation_id) {

            wp_send_json_error(
                array(
                    'message' =>
                        'Please select a product option.',
                )
            );
        }


        $variation_product =
            wc_get_product($variation_id);


        if (!$variation_product) {

            wp_send_json_error(
                array(
                    'message' =>
                        'Selected variation not found.',
                )
            );
        }


        if (!$variation_product->is_purchasable()) {

            wp_send_json_error(
                array(
                    'message' =>
                        'This variation cannot be purchased.',
                )
            );
        }


        if (!$variation_product->is_in_stock()) {

            wp_send_json_error(
                array(
                    'message' =>
                        'This variation is out of stock.',
                )
            );
        }


    } else {

        /*
         * Simple product.
         */
        if (!$product->is_in_stock()) {

            wp_send_json_error(
                array(
                    'message' =>
                        'This product is out of stock.',
                )
            );
        }
    }


    /*
     * Add to WooCommerce cart.
     */
    $cart_item_key = WC()->cart->add_to_cart(
        $product_id,
        $quantity,
        $variation_id,
        $variation
    );


    if (!$cart_item_key) {

        wp_send_json_error(
            array(
                'message' =>
                    'Unable to add product to cart.',
            )
        );
    }


    /*
     * Return updated cart.
     */
    wp_send_json_success(
        array(

            'message' =>
                'Product added to cart.',

            'cart' =>
                oltouch_get_cart_data(),

            'cart_item_key' =>
                $cart_item_key,

        )
    );
}