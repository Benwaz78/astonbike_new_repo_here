<?php
/*
Template Name: My Shop
*/

get_header();


$shop_collection = get_query_var(
	'collection',
	''
);

$shop_collection = sanitize_key(
	$shop_collection
);


$collections = shop_get_product_collections();


$collection_title = 'Shop';

if (
	$shop_collection &&
	isset( $collections[ $shop_collection ] )
) {
	$collection_title = $collections[ $shop_collection ]['label'];
}


$collection_ids = array();

if ( $shop_collection ) {

	$collection_ids = shop_get_product_collection_ids(
		$shop_collection
	);
}


$query_args = array(
	'post_type'      => 'product',
	'post_status'    => 'publish',
	'posts_per_page' => 12,
);


if ( $shop_collection ) {

	$query_args['post__in'] = ! empty( $collection_ids )
		? $collection_ids
		: array( 0 );

	/*
	 * Keep Best Sellers in sales order.
	 */
	if ( 'best-sellers' === $shop_collection ) {

		$query_args['orderby'] = 'post__in';
	}
}


$query_args = shop_filter_apply_to_query(
	$query_args
);



$product_query = new WP_Query(
	$query_args
);




?>
	<div role="main" class="main shop pt-4">
		<div class="container">
			<?php get_template_part( "template-parts/components/shop-filter-btn" ) ?>
			<div class="row">
				<?php get_sidebar("shop") ?>

				<div class="col-lg-9 order-1 order-lg-2">

					<!-- Your existing products -->
					<div class="masonry-loader masonry-loader-showing">
							<div
								class="row products product-thumb-info-list"
								data-plugin-masonry
								data-plugin-options="{'layoutMode': 'fitRows'}"
							>

								<?php if ( $product_query->have_posts() ) : ?>

									<?php while ( $product_query->have_posts() ) : 

										$product_query->the_post();

										$product = wc_get_product( get_the_ID() );

										if ( ! $product ) {
											continue;
										}
										?>

										<div class="col-6 col-sm-6 col-lg-3">
											<?php get_template_part( 'template-parts/components/product-card' ); ?>
										</div>

									<?php endwhile; ?>

									<?php wp_reset_postdata(); ?>

								<?php endif; ?>

							</div>

					</div>

				</div>

			</div>
	</div>
	
<?php get_footer() ?>
