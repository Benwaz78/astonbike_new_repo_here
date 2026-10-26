<?php

defined('ABSPATH') || exit;


/**
 * Get Oltouch cart data.
 */
function oltouch_get_cart_data() {

    $items = array();


    if (!WC()->cart) {

        return array(
            'items'      => array(),
            'cart_count' => 0,
            'cart_total' => '',
            'is_empty'   => true,
        );
    }


    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {

        $product = $cart_item['data'];


        if (!$product || !$product->exists()) {
            continue;
        }


        /*
         * Variation attributes.
         */
        $variation_attributes = array();

        if (!empty($cart_item['variation'])) {

            foreach ($cart_item['variation'] as $attribute => $value) {

                $attribute_name = wc_attribute_label(
                    str_replace('attribute_', '', $attribute)
                );

                $variation_attributes[] = array(
                    'name'  => $attribute_name,
                    'value' => $value,
                );
            }
        }


        /*
         * Cart item.
         */
        $items[] = array(

            'cart_item_key' => $cart_item_key,

            'product_id' => $product->get_id(),

            'name' => $product->get_name(),

            'url' => $product->get_permalink(),

            'image' => wp_get_attachment_image_url(
                $product->get_image_id(),
                'woocommerce_thumbnail'
            ),

            'quantity' => $cart_item['quantity'],

            'price_html' => wc_price(
                wc_get_price_to_display($product)
            ),

            'regular_price_html' => wc_price(
                wc_get_price_to_display(
                    $product,
                    array(
                        'price' => $product->get_regular_price(),
                    )
                )
            ),

            'on_sale' => $product->is_on_sale(),

            'subtotal_html' =>
                WC()->cart->get_product_subtotal(
                    $product,
                    $cart_item['quantity']
                ),

            'variation' => $variation_attributes,

        );
    }


    return array(

        'items' => $items,

        'cart_count' =>
            WC()->cart->get_cart_contents_count(),

        'cart_total' =>
            WC()->cart->get_cart_total(),

        'is_empty' =>
            WC()->cart->is_empty(),

    );
}