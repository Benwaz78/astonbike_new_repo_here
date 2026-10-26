<?php

function oltouch_cart_enqueue_scripts() {

    wp_enqueue_script(
        'oltouch-cart',
        get_stylesheet_directory_uri() . '/woocommerce/cart-endpoints/assets/js/script.js',
        array(),
        null,
        true
    );

    wp_localize_script(
        'oltouch-cart',
        'oltouchCart',
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
        )
    );
}

add_action(
    'wp_enqueue_scripts',
    'oltouch_cart_enqueue_scripts'
);