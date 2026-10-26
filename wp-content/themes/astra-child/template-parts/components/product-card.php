<?php

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product instanceof WC_Product ) {
	return;
}

$product_id   = $product->get_id();
$product_url  = get_permalink( $product_id );
$product_name = $product->get_name();

$categories = get_the_terms(
	$product_id,
	'product_cat'
);

$category_name = '';
$category_url  = '';

if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {

	$category_name = $categories[0]->name;
	$category_url  = get_term_link( $categories[0] );

	if ( is_wp_error( $category_url ) ) {
		$category_url = '';
	}
}


/*
 * Product images.
 */
$main_image_id = $product->get_image_id();
$gallery_ids   = $product->get_gallery_image_ids();

$second_image_id = ! empty( $gallery_ids )
	? $gallery_ids[0]
	: $main_image_id;


/*
 * Product labels.
 *
 * New Arrival
 * Best Seller
 * Sale
 */
$labels = shop_get_product_labels( $product );


/*
 * Global promotion.
 */
$promotion = shop_get_product_promotion_data( $product );



?>

<div class="product mb-0">

	<div class="product-thumb-info border-0 mb-3">


    <?php

$display_badge = null;


/*
 * 1. Global promotion has highest priority.
 */
if ( 'promotion' === $promotion['type'] ) {

	$display_badge = array(
		'label' => $promotion['discount'] > 0
			? $promotion['discount'] . '% OFF'
			: 'Promotion',
		'class' => 'text-bg-primary',
	);

}


/*
 * 2. Sale.
 */
/*
 * 2. Sale.
 */
elseif ( isset( $labels['sale'] ) ) {

	$regular_price = (float) $product->get_regular_price();
	$sale_price    = (float) $product->get_sale_price();

	$discount = 0;

	if (
		$regular_price > 0 &&
		$sale_price > 0 &&
		$sale_price < $regular_price
	) {

		$discount = (int) round(
			( ( $regular_price - $sale_price ) / $regular_price ) * 100
		);

	}

	$display_badge = array(
		'label' => $discount > 0
			? $discount . '% OFF'
			: 'Sale',
		'class' => 'text-bg-danger',
	);

}


/*
 * 3. Best Seller.
 */
elseif ( isset( $labels['best-seller'] ) ) {

	$display_badge = array(
		'label' => 'Best Seller',
		'class' => 'text-bg-warning',
	);

}


/*
 * 4. New Arrival.
 */
elseif ( isset( $labels['new-arrival'] ) ) {

	$display_badge = array(
		'label' => 'New Arrival',
		'class' => 'text-bg-success',
	);

}

?>

<?php if ( $display_badge ) : ?>

	<div class="product-thumb-info-badges-wrapper">

		<span class="badge badge-ecommerce <?php echo esc_attr( $display_badge['class'] ); ?>">

			<?php echo esc_html( $display_badge['label'] ); ?>

		</span>

	</div>

<?php endif; ?>


		<div class="addtocart-btn-wrapper">

			<a
				href="#"
				class="text-decoration-none addtocart-btn"
				title="Add to Cart"
			>
				<i class="icons icon-bag"></i>
			</a>

		</div>


		<a
			href="#"
			 data-bs-toggle="modal"
			 data-bs-target="#exampleModal"
			data-product-id="<?php echo esc_attr( $product->get_id() ); ?>"
			class="quick-view text-uppercase font-weight-semibold text-2"
		>
			QUICK VIEW
		</a>


		<a href="<?php echo esc_url( $product_url ); ?>">

			<div class="product-thumb-info-image product-thumb-info-image-effect">

				<?php

				if ( $main_image_id ) {

					echo wp_get_attachment_image(
						$main_image_id,
						'woocommerce_thumbnail',
						false,
						array(
							'alt' => $product_name,
						)
					);

				}

				?>


				<?php

				if ( $second_image_id ) {

					echo wp_get_attachment_image(
						$second_image_id,
						'woocommerce_thumbnail',
						false,
						array(
							'alt' => $product_name,
						)
					);

				}

				?>

			</div>

		</a>

	</div>


	<div class="d-flex justify-content-between">

		<div>

			<?php if ( $category_name && $category_url ) : ?>

				<a
					href="<?php echo esc_url( $category_url ); ?>"
					class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1"
				>

					<?php echo esc_html( $category_name ); ?>

				</a>

			<?php endif; ?>


			<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0">

				<a
					href="<?php echo esc_url( $product_url ); ?>"
					class="text-color-dark text-color-hover-primary"
				>

					<?php echo esc_html( $product_name ); ?>

				</a>

			</h3>

		</div>


		<a
			href="#"
			class="text-decoration-none text-color-default text-color-hover-dark text-4"
		>

			<i class="far fa-heart"></i>

		</a>

	</div>


	<div
		title="Rated <?php echo esc_attr( $product->get_average_rating() ); ?> out of 5"
	>

		<input
			type="text"
			class="d-none"
			value="<?php echo esc_attr( $product->get_average_rating() ); ?>"
			title=""
			data-plugin-star-rating
			data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}"
		>

	</div>


	<p class="price text-5 mb-3">

		<?php echo shop_get_product_card_price_html( $product ); ?>

	</p>

</div>