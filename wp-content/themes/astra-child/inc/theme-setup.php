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

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'woocommerce' );
    add_image_size('category-image', 1080, 1350, true);
    add_image_size('product-card-image', 1080, 1350, true);
    add_image_size('single-product-image', 1200, 1200, true);
    add_image_size('customer-review', 1080, 1350, true);
    add_image_size('about-image', 600, 450, true);

}

/**
 * Change standard post URLs to /blog/post-name/
 */
function veksra_post_permalink( $post_link, $post ) {

    if ( 'post' === $post->post_type && 'publish' === $post->post_status ) {
        return home_url( '/blog/' . $post->post_name . '/' );
    }

    return $post_link;
}
add_filter( 'post_link', 'veksra_post_permalink', 10, 2 );


/**
 * Make /blog/post-name/ load the correct post.
 */
function veksra_blog_post_rewrite() {

    add_rewrite_rule(
        '^blog/([^/]+)/?$',
        'index.php?name=$matches[1]',
        'top'
    );

}
add_action( 'init', 'veksra_blog_post_rewrite' );