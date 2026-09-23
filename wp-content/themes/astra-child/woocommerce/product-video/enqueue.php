<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function woocommerce_product_video_enqueue_assets() {

    if ( ! is_product() ) {
        return;
    }

    wp_enqueue_style(
        'woocommerce-product-video',
        get_stylesheet_directory_uri() . '/woocommerce/product-video/assets/css/style.css',
        array(),
        '1.0.0'
    );

    wp_enqueue_script(
        'woocommerce-product-video',
        get_stylesheet_directory_uri() . '/woocommerce/product-video/assets/js/script.js',
        array(),
        '1.0.0',
        true
    );
}

add_action( 'wp_enqueue_scripts', 'woocommerce_product_video_enqueue_assets' );