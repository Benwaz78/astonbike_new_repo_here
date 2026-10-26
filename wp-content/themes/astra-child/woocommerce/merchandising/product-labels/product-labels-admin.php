<?php

defined( 'ABSPATH' ) || exit;


/**
 * Add Product Labels settings page.
 */
function shop_add_product_labels_settings_page() {

	add_submenu_page(
		'woocommerce',
		'Product Labels',
		'Product Labels',
		'manage_options',
		'shop-product-labels',
		'shop_render_product_labels_settings_page'
	);
}

add_action( 'admin_menu', 'shop_add_product_labels_settings_page' );


/**
 * Register Product Labels settings.
 */
function shop_register_product_labels_settings() {

	register_setting(
		'shop_product_labels_settings',
		'shop_new_arrival_days',
		array(
			'type'              => 'integer',
			'sanitize_callback' => function ( $value ) {
				return max( 1, absint( $value ) );
			},
			'default'           => 30,
		)
	);

	register_setting(
		'shop_product_labels_settings',
		'shop_best_seller_minimum_units',
		array(
			'type'              => 'integer',
			'sanitize_callback' => function ( $value ) {
				return max( 1, absint( $value ) );
			},
			'default'           => 5,
		)
	);

	register_setting(
		'shop_product_labels_settings',
		'shop_best_seller_days',
		array(
			'type'              => 'integer',
			'sanitize_callback' => function ( $value ) {
				return max( 1, absint( $value ) );
			},
			'default'           => 30,
		)
	);
}

add_action( 'admin_init', 'shop_register_product_labels_settings' );


/**
 * Render Product Labels settings page.
 */
function shop_render_product_labels_settings_page() {
	?>

	<div class="wrap">

		<h1>Product Labels</h1>

		<form method="post" action="options.php">

			<?php settings_fields( 'shop_product_labels_settings' ); ?>

			<table class="form-table">

				<tr>

					<th scope="row">
						<label for="shop_new_arrival_days">
							New Arrival Period
						</label>
					</th>

					<td>

						<input
							type="number"
							id="shop_new_arrival_days"
							name="shop_new_arrival_days"
							value="<?php echo esc_attr( get_option( 'shop_new_arrival_days', 30 ) ); ?>"
							min="1"
							step="1"
							class="small-text"
						>

						<p class="description">
							Products published within this number of days will be marked as New Arrival.
						</p>

					</td>

				</tr>


				<tr>

					<th scope="row">
						<label for="shop_best_seller_minimum_units">
							Best Seller Minimum Units
						</label>
					</th>

					<td>

						<input
							type="number"
							id="shop_best_seller_minimum_units"
							name="shop_best_seller_minimum_units"
							value="<?php echo esc_attr( get_option( 'shop_best_seller_minimum_units', 5 ) ); ?>"
							min="1"
							step="1"
							class="small-text"
						>

						<p class="description">
							A product must sell at least this many units during the Best Seller period.
						</p>

					</td>

				</tr>


				<tr>

					<th scope="row">
						<label for="shop_best_seller_days">
							Best Seller Period
						</label>
					</th>

					<td>

						<input
							type="number"
							id="shop_best_seller_days"
							name="shop_best_seller_days"
							value="<?php echo esc_attr( get_option( 'shop_best_seller_days', 30 ) ); ?>"
							min="1"
							step="1"
							class="small-text"
						>

						<p class="description">
							Only sales from this number of recent days are used to determine Best Seller.
						</p>

					</td>

				</tr>

			</table>

			<?php submit_button( 'Save Settings' ); ?>

		</form>

	</div>

	<?php
}



/**
 * Add a manual Best Seller checkbox to the product editor.
 *
 * @param WC_Product $product Product object.
 */
function shop_add_manual_best_seller_field( $product ) {

	if ( ! $product instanceof WC_Product ) {
		return;
	}

	$is_manual_best_seller = 'yes' === $product->get_meta(
		'_shop_manual_best_seller',
		true
	);
	?>

	<div class="options_group">

		<p class="form-field">

			<label for="_shop_manual_best_seller">
				Manual Best Seller
			</label>

			<input
				type="checkbox"
				id="_shop_manual_best_seller"
				name="_shop_manual_best_seller"
				value="yes"
				<?php checked( $is_manual_best_seller ); ?>
			>

			<span class="description">
				Manually mark this product as a Best Seller,
				regardless of its recorded WooCommerce sales.
			</span>

		</p>

	</div>

	<?php
}

add_action(
	'woocommerce_product_options_general_product_data',
	function () {

		global $product_object;

		shop_add_manual_best_seller_field( $product_object );

	}
);


/**
 * Save the manual Best Seller setting.
 *
 * @param int $product_id Product ID.
 */
function shop_save_manual_best_seller_field( $product_id ) {

	if ( ! current_user_can( 'edit_post', $product_id ) ) {
		return;
	}

	$product = wc_get_product( $product_id );

	if ( ! $product ) {
		return;
	}

	if (
		isset( $_POST['_shop_manual_best_seller'] ) &&
		'yes' === sanitize_text_field(
			wp_unslash( $_POST['_shop_manual_best_seller'] )
		)
	) {

		$product->update_meta_data(
			'_shop_manual_best_seller',
			'yes'
		);

	} else {

		$product->delete_meta_data(
			'_shop_manual_best_seller'
		);

	}

	$product->save();
}

add_action(
	'woocommerce_process_product_meta',
	'shop_save_manual_best_seller_field'
);
