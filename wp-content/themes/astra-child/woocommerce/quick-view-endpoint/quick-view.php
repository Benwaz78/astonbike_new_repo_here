
<?php
/**
 * Product Quick View AJAX handler.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_ajax_shop_product_quick_view', 'shop_product_quick_view' );
add_action( 'wp_ajax_nopriv_shop_product_quick_view', 'shop_product_quick_view' );

function shop_product_quick_view() {
    check_ajax_referer( 'shop_product_quick_view', 'nonce' );

    $product_id = isset( $_POST['product_id'] )
        ? absint( $_POST['product_id'] )
        : 0;

    $product = wc_get_product( $product_id );

    if ( ! $product || ! $product->is_visible() ) {
        wp_send_json_error(
            array(
                'message' => 'Product not found.',
            ),
            404
        );
    }

    ob_start();

    get_template_part(
        'template-parts/components/product-content',
        null,
        array(
            'product' => $product,
        )
    );

    $html = ob_get_clean();

    wp_send_json_success(
        array(
            'html' => $html,
        )
    );
}
