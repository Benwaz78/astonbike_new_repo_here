<?php

defined( 'ABSPATH' ) || exit;

add_action( 'wp_enqueue_scripts', 'shop_enqueue_quick_view' );

function shop_enqueue_quick_view() {

    wp_enqueue_script(
        'shop-product-quick-view',
        get_stylesheet_directory_uri() . '/woocommerce/quick-view-endpoint/assets/js/quick-view.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );

    wp_localize_script(
        'shop-product-quick-view',
        'shopQuickView',
        array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'shop_product_quick_view' ),
        )
    );
}