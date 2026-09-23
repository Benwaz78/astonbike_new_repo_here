<?php
/**
 * Product Display Flags
 *
 * Adds a custom "Product Display" tab to the WooCommerce
 * Product Data panel for homepage merchandising.
 *
 * @package BrightAngel
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * --------------------------------------------------------
 * Add Product Display Tab
 * --------------------------------------------------------
 */
add_filter( 'woocommerce_product_data_tabs', 'ba_product_display_tab' );

function ba_product_display_tab( $tabs ) {

	$tabs['ba_product_display'] = array(
		'label'    => __( 'Product Display', 'brightangel' ),
		'target'   => 'ba_product_display_data',
		'class'    => array(),
		'priority' => 80,
	);

	return $tabs;
}

/**
 * --------------------------------------------------------
 * Product Display Panel
 * --------------------------------------------------------
 */
add_action( 'woocommerce_product_data_panels', 'ba_product_display_panel' );

function ba_product_display_panel() {

	global $post;

	?>
	<div id="ba_product_display_data" class="panel woocommerce_options_panel">

		<div class="options_group">

			<h3 style="padding:12px;"><?php esc_html_e( 'Homepage Collections', 'brightangel' ); ?></h3>

			<?php

			woocommerce_wp_checkbox(
				array(
					'id'          => '_ba_new_in',
					'label'       => __( 'Show in New In', 'brightangel' ),
					'description' => __( 'Display this product in the New In collection.', 'brightangel' ),
				)
			);

			woocommerce_wp_checkbox(
				array(
					'id'          => '_ba_best_seller',
					'label'       => __( 'Show as Best Seller', 'brightangel' ),
					'description' => __( 'Display this product in the Best Seller collection.', 'brightangel' ),
				)
			);

			woocommerce_wp_checkbox(
				array(
					'id'          => '_ba_sales',
					'label'       => __( 'Show as Sales', 'brightangel' ),
					'description' => __( 'Display this product in the Sales collection.', 'brightangel' ),
				)
			);

			?>

		</div>

	</div>

	<?php
}

/**
 * --------------------------------------------------------
 * Save Product Display Options
 * --------------------------------------------------------
 */
add_action( 'woocommerce_process_product_meta', 'ba_save_product_display_options' );

function ba_save_product_display_options( $product_id ) {

	$new_in = isset( $_POST['_ba_new_in'] ) ? 'yes' : 'no';
	update_post_meta( $product_id, '_ba_new_in', $new_in );

	$best_seller = isset( $_POST['_ba_best_seller'] ) ? 'yes' : 'no';
	update_post_meta( $product_id, '_ba_best_seller', $best_seller );

	$sales = isset( $_POST['_ba_sales'] ) ? 'yes' : 'no';
	update_post_meta( $product_id, '_ba_sales', $sales );
}

