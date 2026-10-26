
<?php

defined( 'ABSPATH' ) || exit;

global $product;



/*
 * Get the product passed by the template,
 * or fall back to the WooCommerce global.
 */
if (
	! isset( $args['product'] ) ||
	! $args['product'] instanceof WC_Product
) {
	$product = isset( $product ) && $product instanceof WC_Product
		? $product
		: wc_get_product( get_queried_object_id() );
} else {
	$product = $args['product'];
}

if ( ! $product instanceof WC_Product ) {
	return;
}

$product_id = $product->get_id();

?>


<div class="row shop-product-content"
     data-product-id="<?php echo esc_attr( $product_id ); ?>">

	
<!-- Product Gallery -->
<div class="col-md-6 mb-4 mb-md-0">
	<?php
	$gallery_ids = $product->get_gallery_image_ids();
	$featured_id = $product->get_image_id();

	if ( $featured_id ) {
		array_unshift( $gallery_ids, $featured_id );
	}

	$gallery_ids = array_values( array_unique( array_filter( $gallery_ids ) ) );

	/*
	 * Retrieve the video saved by the existing product-video module.
	 * Supports an attachment ID or a directly stored URL.
	 */
	$video_value = get_post_meta( $product_id, '_product_video', true );
	$video_url   = '';

	if ( is_numeric( $video_value ) && $video_value ) {
		$video_url = wp_get_attachment_url( absint( $video_value ) );
	} elseif ( is_string( $video_value ) && filter_var( $video_value, FILTER_VALIDATE_URL ) ) {
		$video_url = $video_value;
	}

	$poster_url = $featured_id
		? wp_get_attachment_image_url( $featured_id, 'woocommerce_single' )
		: wc_placeholder_img_src( 'woocommerce_single' );

	$has_video = ! empty( $video_url );
	?>

	<div
		class="thumb-gallery-wrapper lightbox product-gallery"
		data-plugin-options="{'delegate': 'a.shop-gallery', 'type': 'image', 'gallery': {'enabled': true}, 'mainClass': 'mfp-with-zoom', 'zoom': {'enabled': true, 'duration': 300}}"
	>
		<!-- Main Gallery -->
		<div class="thumb-gallery-detail owl-carousel owl-theme manual nav-inside nav-style-1 nav-dark mb-3">

			<?php foreach ( $gallery_ids as $image_id ) : ?>
                
                <?php if ( $has_video ) : ?>
                    <div class="product-gallery-slide product-video-slide">
                        <div
                            class="product-video-viewer"
                            data-video-url="<?php echo esc_url( $video_url ); ?>"
                            data-poster="<?php echo esc_url( $poster_url ); ?>"
                        >
                            <button
                                type="button"
                                class="product-video-play"
                                aria-label="<?php echo esc_attr( 'Play ' . $product_name . ' product video' ); ?>"
                            >
                                <img
                                    src="<?php echo esc_url( $poster_url ); ?>"
                                    class="img-fluid product-video-poster"
                                    alt="<?php echo esc_attr( $product_name . ' video preview' ); ?>"
                                >

                                <span class="product-video-play-icon" aria-hidden="true">
                                    <i class="fas fa-play"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>


				<?php
				$image_url = wp_get_attachment_image_url( $image_id, 'full' );

				if ( ! $image_url ) {
					continue;
				}
				?>

				<div class="product-gallery-slide">
					<a
						href="<?php echo esc_url( $image_url ); ?>"
						class="shop-gallery"
						title="<?php echo esc_attr( $product_name ); ?>"
					>
						<?php
						echo wp_get_attachment_image(
							$image_id,
							'woocommerce_single',
							false,
							array(
								'class' => 'img-fluid',
								'alt'   => esc_attr( $product_name ),
							)
						);
						?>
					</a>
				</div>

			<?php endforeach; ?>

			
		</div>

		<!-- Gallery Thumbnails -->
		<?php if ( count( $gallery_ids ) > 1 || $has_video ) : ?>
			<div class="thumb-gallery-thumbs owl-carousel owl-theme manual">
                <?php if ( $has_video ) : ?>
					<div class="cur-pointer product-gallery-thumb product-video-thumb">
						<img
							src="<?php echo esc_url( $poster_url ); ?>"
							class="img-fluid"
							alt="<?php echo esc_attr( $product_name . ' video thumbnail' ); ?>"
						>
						<span class="product-video-thumb-icon" aria-hidden="true">
							<i class="fas fa-play"></i>
						</span>
					</div>
				<?php endif; ?>

				<?php foreach ( $gallery_ids as $image_id ) : ?>
					<div class="cur-pointer product-gallery-thumb">
						<?php
						echo wp_get_attachment_image(
							$image_id,
							'woocommerce_thumbnail',
							false,
							array(
								'class' => 'img-fluid',
								'alt'   => esc_attr( $product_name ),
							)
						);
						?>
					</div>
				<?php endforeach; ?>

				

			</div>
		<?php endif; ?>
	</div>
</div>



	<div class="col-md-6">

		<div class="summary entry-summary position-relative">

			<?php
			/*
			 * Product badge.
			 * Preserve the existing Aston Bike badge priority.
			 */
			$labels    = function_exists( 'shop_get_product_labels' )
				? shop_get_product_labels( $product )
				: array();

			$promotion = function_exists( 'shop_get_product_promotion_data' )
				? shop_get_product_promotion_data( $product )
				: array( 'type' => '', 'discount' => 0 );

			$display_badge = null;

			if ( 'promotion' === $promotion['type'] ) {
				$display_badge = array(
					'label' => ! empty( $promotion['discount'] )
						? $promotion['discount'] . '% OFF'
						: 'Promotion',
					'class' => 'text-bg-primary',
				);
			} elseif ( isset( $labels['sale'] ) ) {
				$regular_price = (float) $product->get_regular_price();
				$sale_price    = (float) $product->get_sale_price();
				$discount      = 0;

				if (
					! $product->is_type( 'variable' ) &&
					$regular_price > 0 &&
					$sale_price > 0 &&
					$sale_price < $regular_price
				) {
					$discount = (int) round(
						( ( $regular_price - $sale_price ) / $regular_price ) * 100
					);
				}

				$display_badge = array(
					'label' => $discount > 0 ? $discount . '% OFF' : 'Sale',
					'class' => 'text-bg-danger',
				);
			} elseif ( isset( $labels['best-seller'] ) ) {
				$display_badge = array(
					'label' => 'Best Seller',
					'class' => 'text-bg-warning',
				);
			} elseif ( isset( $labels['new-arrival'] ) ) {
				$display_badge = array(
					'label' => 'New Arrival',
					'class' => 'text-bg-success',
				);
			}elseif ( isset( $labels['sale'] ) ) {
				$discount = shop_get_product_discount( $product );

				$display_badge = array(
					'label' => $discount > 0 ? '-' . $discount . '% OFF' : 'Sale',
					'class' => 'text-bg-danger',
				);
			}

			?>

			<?php if ( $display_badge ) : ?>
				<span class="badge badge-ecommerce <?php echo esc_attr( $display_badge['class'] ); ?>">
					<?php echo esc_html( $display_badge['label'] ); ?>
				</span>
			<?php endif; ?>

			<h1 class="mb-0 font-weight-bold text-7">
				<?php echo esc_html( $product->get_name() ); ?>
			</h1>

			<div class="divider divider-small">-
				<hr class="bg-color-grey-400">
			</div>

			
        
			<div class="price mb-3" data-product-price>
				 <?php
					echo shop_get_single_product_price_html( $product );
				  ?>
			</div>




			<?php if ( $product->get_short_description() ) : ?>
				<div class="text-3-5 mb-3">
					<?php echo wp_kses_post( wpautop( $product->get_short_description() ) ); ?>
				</div>
			<?php endif; ?>

			<ul class="list list-unstyled text-2">

				
				<li class="mb-0" data-product-stock>
					AVAILABILITY:
					<strong class="text-color-dark">
						<?php
						if ( $product->is_type( 'variable' ) ) {

							echo esc_html( 'Choose options to check availability' );

						} elseif ( ! $product->is_in_stock() ) {

							echo esc_html( 'Out of stock' );

						} elseif ( $product->is_on_backorder() ) {

							echo esc_html( 'Available on backorder' );

						} elseif ( $product->managing_stock() ) {

							$quantity = $product->get_stock_quantity();

							echo esc_html(
								$quantity . ( 1 === (int) $quantity ? ' in stock' : ' in stock' )
							);

						} else {

							echo esc_html( 'In stock' );

						}
						?>
					</strong>
				</li>


				<?php if ( $product->get_sku() ) : ?>
					<li class="mb-0">
						SKU:
						<strong class="text-color-dark" data-product-sku>
							<?php echo esc_html( $product->get_sku() ); ?>
						</strong>
					</li>
				<?php endif; ?>

			</ul>

			
            <?php if ( $product->is_type( 'variable' ) ) : ?>
			
			
				<?php
				$available_variations = $product->get_available_variations();

				foreach ( $available_variations as &$variation_data ) {
					$variation_product = wc_get_product( $variation_data['variation_id'] );

					$variation_data['stock_quantity'] = (
						$variation_product && $variation_product->managing_stock()
					)
						? $variation_product->get_stock_quantity()
						: null;
				}
				unset( $variation_data );

				$default_attributes = $product->get_default_attributes();
				?>
			

                <div
                    class="product-attributes"
                    data-variation-options
                    data-product-id="<?php echo esc_attr( $product->get_id() ); ?>"
					data-default-attributes="<?php echo esc_attr( wp_json_encode( $default_attributes ) ); ?>"
                    data-product-variations="<?php echo esc_attr( wp_json_encode( $available_variations ) ); ?>"
                >

            
                  

                    <?php foreach ( $product->get_variation_attributes() as $attribute_name => $options ) : ?>

                        <?php
                        $attribute_key = wc_variation_attribute_name( $attribute_name );
                        ?>

                        <div
                            class="attribute-item mb-3"
                            data-attribute-group="<?php echo esc_attr( $attribute_key ); ?>"
                        >

                            <p class="font-weight-semibold mb-2">
                                <?php echo esc_html( wc_attribute_label( $attribute_name, $product ) ); ?>:
                            </p>

                            <?php foreach ( $options as $option ) : ?>

                                <?php
                                $taxonomy = $attribute_name;
                                $term     = taxonomy_exists( $taxonomy )
                                    ? get_term_by( 'slug', $option, $taxonomy )
                                    : false;

                                $option_label = $term && ! is_wp_error( $term )
                                    ? $term->name
                                    : $option;
                                ?>

                                <button
                                    type="button"
                                    class="variation-option btn btn-outline-dark mb-2"
                                    data-attribute="<?php echo esc_attr( $attribute_key ); ?>"
                                    data-value="<?php echo esc_attr( $option ); ?>"
                                    aria-pressed="false"
                                >
                                    <?php echo esc_html( $option_label ); ?>
                                </button>

                            <?php endforeach; ?>

                        </div>

                    <?php endforeach; ?>

                    <button type="button" class="variation-reset btn btn-link p-0">
                        Clear selection
                    </button>

                    <input type="hidden" name="variation_id" value="">

                </div>

            <?php endif; ?>


			<!-- Add to Cart controls will be added in the next step. -->

		</div>

	</div>

</div>
