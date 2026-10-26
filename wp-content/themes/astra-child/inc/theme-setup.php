<?php
/**
 * Theme Setup
 */

defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', 'general_theme_setup' );

function general_theme_setup() {

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'brightangel' ),
        'footer'  => __( 'Footer Menu', 'brightangel' ),
    ) );

   
    wp_dequeue_style( 'astra-theme-css' );
	wp_deregister_style( 'astra-theme-css' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'woocommerce' );
    add_image_size('category-image', 1080, 1350, true);
    add_image_size('product-card-image', 1080, 1350, true);
    add_image_size('single-product-image', 1200, 1200, true);
    add_image_size('customer-review', 1080, 1350, true);
    add_image_size('about-image', 600, 450, true);

}



