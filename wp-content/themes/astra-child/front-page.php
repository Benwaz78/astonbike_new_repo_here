<?php 
get_header();

$new_arrival_ids = shop_get_product_collection_ids(
	'new-arrivals'
);

$best_seller_ids = shop_get_product_collection_ids(
	'best-sellers'
);

$sale_ids = shop_get_product_collection_ids(
	'sale'
);


/*
 * Combine all collection products.
 */
$featured_product_ids = array_unique(
	array_merge(
		$sale_ids,
		$best_seller_ids,
		$new_arrival_ids
	)
);

$featured_query = new WP_Query(
	array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => 12,
		'post__in'       => ! empty( $featured_product_ids )
			? $featured_product_ids
			: array( 0 ),
	)
);

?>
	
			

			<div role="main" class="main shop">

				<div class="owl-carousel-wrapper">
					<div class="owl-carousel dots-inside dots-horizontal-center show-dots-hover nav-inside nav-inside-plus nav-dark nav-md nav-font-size-md show-nav-hover mb-0" data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 1}, '979': {'items': 1}, '1199': {'items': 1}}, 'loop': false, 'autoHeight': false, 'margin': 0, 'dots': true, 'dotsVerticalOffset': '-75px', 'nav': true, 'animateIn': 'fadeIn', 'animateOut': 'fadeOut', 'mouseDrag': false, 'touchDrag': false, 'pullDrag': false, 'autoplay': true, 'autoplayTimeout': 9000, 'autoplayHoverPause': true, 'rewind': true}">

						

						<!-- Carousel Slide 1 -->
						<div class="position-relative overlay overlay-show slide-container overlay-op-8 pt-5" 
						style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/assets/img/slides/slide-1.jpg); background-size: cover; background-position: center; height: 100vh;">
							<div class="container position-relative z-index-3 h-100">
								<div class="row justify-content-start align-items-center h-100">
									<div class="col-lg-6">
										<div class="d-flex flex-column align-items-start">
											<h3 class="position-relative text-color-light slide-small-header line-height-5 font-weight-medium px-4 mb-2 appear-animation" data-appear-animation="fadeInDownShorterPlus" data-plugin-options="{'minWindowWidth': 0}">
												<span class="position-absolute right-100pct top-50pct transform3dy-n50 opacity-3">
													<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
												</span>
												PLAYFUL RIDES
												<span class="position-absolute left-100pct top-50pct transform3dy-n50 opacity-3">
													<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
												</span>
											</h3>
											<h2 class="text-color-light slide-main-header font-weight-extra-bold mb-3 appear-animation" data-appear-animation="blurIn" data-appear-animation-delay="500" data-plugin-options="{'minWindowWidth': 0}">Children's Bikes</h2>
											<p class="slide-description text-color-light font-weight-light opacity-7 text-left mb-0">
												Fun, reliable bikes made for young riders to discover the joy of cycling.
											</p>

											<a href="#" class="btn btn-primary mt-2 btn-rounded font-weight-bold text-3 px-5 py-3 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1600">EXPLORE!</a>

											
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Carousel Slide 2 -->
						<div class="position-relative overlay overlay-show slide-container overlay-op-8 pt-5" style="background-image: url(assets/img/slides/slide-2.jpg);  background-position: center; height: 100vh;">
							<div class="container position-relative z-index-3 h-100">
								<div class="row justify-content-start align-items-center h-100">
									<div class="col-lg-6">
										<div class="d-flex flex-column align-items-center">
											<h3 class="position-relative text-color-light slide-small-header line-height-5 font-weight-medium px-4 mb-2 appear-animation" data-appear-animation="fadeInDownShorterPlus" data-plugin-options="{'minWindowWidth': 0}">
												<span class="position-absolute right-100pct top-50pct transform3dy-n50 opacity-3">
													<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
												</span>
												DYNAMIC RIDES
												<span class="position-absolute left-100pct top-50pct transform3dy-n50 opacity-3">
													<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
												</span>
											</h3>
											<h2 class="text-color-light slide-main-header font-weight-extra-bold mb-3 appear-animation" data-appear-animation="blurIn" data-appear-animation-delay="500" data-plugin-options="{'minWindowWidth': 0}">Teen Bikes</h2>
											<p class="slide-description text-color-light font-weight-light opacity-7 text-left mb-0">
												Stylish and dependable bikes designed for growing riders
													and everyday adventures.
											</p>

											<a href="#" class="btn btn-primary mt-2 btn-rounded font-weight-bold text-3 px-5 py-3 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1600">EXPLORE!</a>

											
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Carousel Slide 3 -->
						<div class="position-relative overlay overlay-show slide-container overlay-op-8 pt-5" style="background-image: url(assets/img/slides/slide-3.jpg);  background-position: center; height: 100vh;">
							<div class="container position-relative z-index-3 h-100">
								<div class="row justify-content-start align-items-center h-100">
									<div class="col-lg-6">
										<div class="d-flex flex-column align-items-center">
											<h3 class="position-relative text-color-light slide-small-header line-height-5 font-weight-medium px-4 mb-2 appear-animation" data-appear-animation="fadeInDownShorterPlus" data-plugin-options="{'minWindowWidth': 0}">
												<span class="position-absolute right-100pct top-50pct transform3dy-n50 opacity-3">
													<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
												</span>
												VERSATILE RIDES
												<span class="position-absolute left-100pct top-50pct transform3dy-n50 opacity-3">
													<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
												</span>
											</h3>
											<h2 class="text-color-light slide-main-header font-weight-extra-bold mb-3 appear-animation" data-appear-animation="blurIn" data-appear-animation-delay="500" data-plugin-options="{'minWindowWidth': 0}">Adult Bikes</h2>
											<p class="slide-description text-color-light font-weight-light opacity-7 text-left mb-0">
												Quality bikes built for everyday journeys, weekend rides
													and everything in between.
											</p>

											<a href="#" class="btn btn-primary mt-2 btn-rounded font-weight-bold text-3 px-5 py-3 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1600">EXPLORE!</a>

											
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Carousel Slide 4 -->
						<div class="position-relative overlay overlay-show slide-container overlay-op-8 pt-5" style="background-image: url(assets/img/slides/slide-4.jpg);  background-position: center; height: 100vh;">
							<div class="container position-relative z-index-3 h-100">
								<div class="row justify-content-start align-items-center h-100">
									<div class="col-lg-6">
										<div class="d-flex flex-column align-items-center">
											<h3 class="position-relative text-color-light slide-small-header line-height-5 font-weight-medium px-4 mb-2 appear-animation" data-appear-animation="fadeInDownShorterPlus" data-plugin-options="{'minWindowWidth': 0}">
												<span class="position-absolute right-100pct top-50pct transform3dy-n50 opacity-3">
													<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
												</span>
												FUN ON THE MOVE
												<span class="position-absolute left-100pct top-50pct transform3dy-n50 opacity-3">
													<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
												</span>
											</h3>
											<h2 class="text-color-light slide-main-header font-weight-extra-bold mb-3 appear-animation" data-appear-animation="blurIn" data-appear-animation-delay="500" data-plugin-options="{'minWindowWidth': 0}">Scooters</h2>
											<p class="slide-description text-color-light font-weight-light opacity-7 text-left mb-0">
												Easy, exciting and practical rides for getting around
													and enjoying every journey.
											</p>

											<a href="#" class="btn btn-primary mt-2 btn-rounded font-weight-bold text-3 px-5 py-3 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1600">EXPLORE!</a>

											
										</div>
									</div>
								</div>
							</div>
						</div>

						


						
						

					</div>
				</div>
				<!-- Product Categories -->
				<section class="astonbike-categories py-5 bg-dark">
					<div class="container">

						<!-- Section Heading -->
						<div class="row align-items-end mb-4">

							<div class="col-md-8">
								<span class="text-uppercase text-white font-weight-semibold text-2">
									Explore AstonBike
								</span>

								<h2 class="text-8 text-white font-weight-bold mt-2 mb-0">
									Shop Our Collections
								</h2>
							</div>

							<div class="col-md-4 text-md-right mt-3 mt-md-0">
								<a href="#" class="text-uppercase text-white font-weight-semibold text-2">
									View All Categories
									<i class="fas fa-arrow-right ml-1"></i>
								</a>
							</div>

						</div>


						<!-- Category Cards -->
						<div class="owl-carousel owl-theme stage-margin" data-plugin-options="{'items': 3, 'margin': 10, 'loop': false, 'nav': true, 'dots': false, 'stagePadding': 40}">

							<!-- Category Card -->
							<div>
								<a href="#" class="astonbike-category-card">

									<div class="astonbike-category-image">

										<img
											src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/products/categories/children.webp"
											alt="Children's Bikes"
										>

										<div class="astonbike-category-overlay"></div>

										<div class="astonbike-category-arrow">
											<i class="fas fa-arrow-right"></i>
										</div>

									</div>

									<div class="astonbike-category-content">

										<h3 class="text-white">
											Children's Bikes
										</h3>

										<span class="text-white">
											View Collection
											<i class="fas fa-arrow-right"></i>
										</span>

									</div>

								</a>
							</div>


							<!-- Category Card -->
							<div>
								<a href="#" class="astonbike-category-card">

									<div class="astonbike-category-image">

										<img
											src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/products/categories/teen.webp"
											alt="Teen Bikes"
										>

										<div class="astonbike-category-overlay"></div>

										<div class="astonbike-category-arrow">
											<i class="fas fa-arrow-right"></i>
										</div>

									</div>

									<div class="astonbike-category-content">

										<h3 class="text-white">
											Teen Bikes
										</h3>

										<span class="text-white">
											View Collection
											<i class="fas fa-arrow-right"></i>
										</span>

									</div>

								</a>
							</div>


							<!-- Category Card -->
							<div>
								<a href="#" class="astonbike-category-card">

									<div class="astonbike-category-image">

										<img
											src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/products/categories/adult.jpg"
											alt="Adult Bikes"
										>

										<div class="astonbike-category-overlay"></div>

										<div class="astonbike-category-arrow">
											<i class="fas fa-arrow-right"></i>
										</div>

									</div>

									<div class="astonbike-category-content">

										<h3 class="text-white">
											Adult Bikes
										</h3>

										<span class="text-white">
											View Collection
											<i class="fas fa-arrow-right"></i>
										</span>

									</div>

								</a>
							</div>


							<!-- Category Card -->
							<div>
								<a href="#" class="astonbike-category-card">

									<div class="astonbike-category-image">

										<img
											src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/products/categories/scooter.webp"
											alt="Scooters"
										>

										<div class="astonbike-category-overlay"></div>

										<div class="astonbike-category-arrow">
											<i class="fas fa-arrow-right"></i>
										</div>

									</div>

									<div class="astonbike-category-content">

										<h3 class="text-white">
											Scooters
										</h3>

										<span class="text-white">
											View Collection
											<i class="fas fa-arrow-right"></i>
										</span>

									</div>

								</a>
							</div>

							<!-- Category Card -->
							<div>
								<a href="#" class="astonbike-category-card">

									<div class="astonbike-category-image">

										<img
											src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/products/categories/cycling-glove.webp"
											alt="Cycling Glove"
										>

										<div class="astonbike-category-overlay"></div>

										<div class="astonbike-category-arrow">
											<i class="fas fa-arrow-right"></i>
										</div>

									</div>

									<div class="astonbike-category-content">

										<h3 class="text-white">
											Accessories
										</h3>

										<span class="text-white">
											View Collection
											<i class="fas fa-arrow-right"></i>
										</span>

									</div>

								</a>
							</div>

						</div>

					</div>
				</section>
				

				<section id="featuredProducts" class="page-section">
					<div class="container">
						<div class="row">
							<div class="d-flex justify-content-between align-items-end mb-4 product-filter-header">

							    <!-- Left: Section information -->
							    <div class="product-section-heading">
							        <h2 class="mb-2 text-8 font-weight-bold">Shop Our Highlights</h2>
							        <p class="mb-0">
							            Discover our latest arrivals, best sellers and special offers.
							        </p>
							    </div>

							    <!-- Right: Filter -->
							    <ul class="nav nav-pills sort-source sort-source-style-3 justify-content-end"
							        data-sort-id="portfolio"
							        data-option-key="filter"
							        data-plugin-options="{'layoutMode': 'fitRows', 'filter': '*'}">

							        <li class="nav-item active" data-option-value="*">
							            <a class="nav-link text-2-5 text-uppercase active" href="#">
							                Show All
							            </a>
							        </li>

							        <li class="nav-item" data-option-value=".on-sale">
							            <a class="nav-link text-2-5 text-uppercase" href="#">
							                On Sale
							            </a>
							        </li>

							        <li class="nav-item" data-option-value=".best-sellers">
							            <a class="nav-link text-2-5 text-uppercase" href="#">
							                Best Sellers
							            </a>
							        </li>

							        <li class="nav-item" data-option-value=".new-arrival">
							            <a class="nav-link text-2-5 text-uppercase" href="#">
							                New Arrival
							            </a>
							        </li>

							    </ul>

							</div>

							<div class="sort-destination-loader masonry-loader masonry-loader-loaded sort-destination-loader-showing mt-4 pt-2">
								<div class="row portfolio-list products product-thumb-info-list sort-destination"
									data-plugin-masonry
									data-plugin-options="{'layoutMode': 'fitRows'}"
									data-sort-id="portfolio">

										<?php if ( $featured_query->have_posts() ) : ?>

											<?php while ( $featured_query->have_posts() ) : ?>

												<?php
												$featured_query->the_post();

												$product = wc_get_product( get_the_ID() );

												if ( ! $product ) {
													continue;
												}

												$product_id = $product->get_id();

												$item_classes = array(
													'isotope-item',
												);

												if ( in_array( $product_id, $sale_ids, true ) ) {
													$item_classes[] = 'on-sale';
												}

												if ( in_array( $product_id, $best_seller_ids, true ) ) {
													$item_classes[] = 'best-sellers';
												}

												if ( in_array( $product_id, $new_arrival_ids, true ) ) {
													$item_classes[] = 'new-arrival';
												}
												?>

												<div class="col-6 col-sm-6 col-lg-3 <?php echo esc_attr( implode( ' ', $item_classes ) ); ?>">

													<?php
													get_template_part(
														'template-parts/components/product-card'
													);
													?>

												</div>

											<?php endwhile; ?>

										<?php endif; ?>

								</div>

									<?php wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
				</section>

				<!-- Why Choose AstonBike -->
				<section class="why-choose-astonbike page-section">
					<div class="container">

						<!-- Section Heading -->
						<div class="row justify-content-center text-center mb-5">
							<div class="col-lg-7">

								<span class="text-uppercase font-weight-semibold text-2">
									Why Choose AstonBike?
								</span>

								<h2 class="text-8 font-weight-bold mt-2 mb-3">
									Ride With Confidence
								</h2>

								<p class="text-3 text-muted mb-0">
									From your first ride to your everyday adventures,
									we're here to help you find the right bike and gear.
								</p>

							</div>
						</div>

						<!-- Benefits -->
						<div class="row">

							<!-- Quality -->
							<div class="col-6 col-lg-3 mb-4 mb-lg-0">
								<div class="why-choose-card text-center px-3">

									<div class="why-choose-icon mb-4">
										<i class="fas fa-award"></i>
									</div>

									<h3 class="text-4 font-weight-semibold mb-2">
										Quality Products
									</h3>

									<p class="text-2 text-muted mb-0">
										Quality bikes and cycling products
										selected with you in mind.
									</p>

								</div>
							</div>


							<!-- Range -->
							<div class="col-6 col-lg-3 mb-4 mb-lg-0">
								<div class="why-choose-card text-center px-3">

									<div class="why-choose-icon mb-4">
										<i class="fas fa-bicycle"></i>
									</div>

									<h3 class="text-4 font-weight-semibold mb-2">
										Bikes For Everyone
									</h3>

									<p class="text-2 text-muted mb-0">
										From children's first bikes to
										bikes for teens and adults.
									</p>

								</div>
							</div>


							<!-- Safety -->
							<div class="col-6 col-lg-3 mb-4 mb-lg-0">
								<div class="why-choose-card text-center px-3">

									<div class="why-choose-icon mb-4">
										<i class="fas fa-shield-alt"></i>
									</div>

									<h3 class="text-4 font-weight-semibold mb-2">
										Safety First
									</h3>

									<p class="text-2 text-muted mb-0">
										Find helmets and essential gear
										to help make every ride safer.
									</p>

								</div>
							</div>


							<!-- Support -->
							<div class="col-6 col-lg-3 mb-4 mb-lg-0">
								<div class="why-choose-card text-center px-3">

									<div class="why-choose-icon mb-4">
										<i class="fas fa-headset"></i>
									</div>

									<h3 class="text-4 font-weight-semibold mb-2">
										Helpful Support
									</h3>

									<p class="text-2 text-muted mb-0">
										We're here to help you choose
										the right bike and accessories.
									</p>

								</div>
							</div>

						</div>

					</div>
				</section>

				<!-- Complete Your Ride -->
				<section class="complete-your-ride page-section">
					<div class="container">

						<!-- Section Heading -->
						<div class="row justify-content-center text-center mb-4">
							<div class="col-lg-7">
								<span class="text-uppercase font-weight-semibold text-2">
									Complete Your Ride
								</span>

								<h2 class="text-8 font-weight-bold mt-2 mb-3">
									Everything You Need for the Ride
								</h2>

								<p class="text-3 text-muted mb-0">
									From safety gear to essential accessories, find everything
									you need to make every ride safer and more enjoyable.
								</p>
							</div>
						</div>

						<!-- Accessories Categories -->
						<div class="owl-carousel owl-theme stage-margin" data-plugin-options="{'items': 6, 'margin': 10, 'loop': false, 'nav': true, 'dots': false, 'stagePadding': 40}">

							<!-- Helmets -->
							<div>
								<a href="#" class="text-decoration-none d-block h-100">
									<div class="complete-ride-card text-center">

										<div class="complete-ride-image">
											<img
												src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/products/helmet/helmet.webp"
												alt="Bicycle Helmets"
												
											>
										</div>

										<div class="complete-ride-content pt-3">
											<h3 class="text-4 font-weight-semibold mb-1">
												Helmets
											</h3>

											<p class="text-2 text-muted mb-2">
												Safety first, always.
											</p>

											<span class="text-uppercase font-weight-semibold text-2">
												Shop Helmets <i class="fas fa-arrow-right ml-1"></i>
											</span>
										</div>

									</div>
								</a>
							</div>


							<!-- Lights -->
							<div>
								<a href="#" class="text-decoration-none d-block h-100">
									<div class="complete-ride-card text-center">

										<div class="complete-ride-image">
											<img
												src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/accessories/bike-light.jpg"
												alt="Bike Lights"
												
											>
										</div>

										<div class="complete-ride-content pt-3">
											<h3 class="text-4 font-weight-semibold mb-1">
												Lights
											</h3>

											<p class="text-2 text-muted mb-2">
												See and be seen.
											</p>

											<span class="text-uppercase font-weight-semibold text-2">
												Shop Lights <i class="fas fa-arrow-right ml-1"></i>
											</span>
										</div>

									</div>
								</a>
							</div>


							<!-- Locks -->
							<div>
								<a href="#" class="text-decoration-none d-block h-100">
									<div class="complete-ride-card text-center">

										<div class="complete-ride-image">
											<img
												src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/accessories/bike-locks.jpg"
												alt="Bike Locks"
											>
										</div>

										<div class="complete-ride-content pt-3">
											<h3 class="text-4 font-weight-semibold mb-1">
												Locks
											</h3>

											<p class="text-2 text-muted mb-2">
												Secure every stop.
											</p>

											<span class="text-uppercase font-weight-semibold text-2">
												Shop Locks <i class="fas fa-arrow-right ml-1"></i>
											</span>
										</div>

									</div>
								</a>
							</div>


							<!-- Bottles -->
							<div>
								<a href="#" class="text-decoration-none d-block h-100">
									<div class="complete-ride-card text-center">

										<div class="complete-ride-image">
											<img
												src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/accessories/bike-bottles-and-cages.jpg"
												alt="Bike Bottles and Cages"
												
											>
										</div>

										<div class="complete-ride-content pt-3">
											<h3 class="text-4 font-weight-semibold mb-1">
												Bottles
											</h3>

											<p class="text-2 text-muted mb-2">
												Stay hydrated.
											</p>

											<span class="text-uppercase font-weight-semibold text-2">
												Shop Bottles <i class="fas fa-arrow-right ml-1"></i>
											</span>
										</div>

									</div>
								</a>
							</div>


							<!-- Bags -->
							<div>
								<a href="#" class="text-decoration-none d-block h-100">
									<div class="complete-ride-card text-center">

										<div class="complete-ride-image">
											<img
												src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/accessories/bike-bag.webp"
												alt="Bike Bags and Storage"
												
											>
										</div>

										<div class="complete-ride-content pt-3">
											<h3 class="text-4 font-weight-semibold mb-1">
												Bags
											</h3>

											<p class="text-2 text-muted mb-2">
												Carry more, ride easy.
											</p>

											<span class="text-uppercase font-weight-semibold text-2">
												Shop Bags <i class="fas fa-arrow-right ml-1"></i>
											</span>
										</div>

									</div>
								</a>
							</div>


							<!-- Gloves -->
							<div>
								<a href="#" class="text-decoration-none d-block h-100">
									<div class="complete-ride-card text-center">

										<div class="complete-ride-image">
											<img
												src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/products/categories/cycling-glove.webp"
												alt="Cycling Gloves"
												
											>
										</div>

										<div class="complete-ride-content pt-3">
											<h3 class="text-4 font-weight-semibold mb-1">
												Gloves
											</h3>

											<p class="text-2 text-muted mb-2">
												Better grip, better ride.
											</p>

											<span class="text-uppercase font-weight-semibold text-2">
												Shop Gloves <i class="fas fa-arrow-right ml-1"></i>
											</span>
										</div>

									</div>
								</a>
							</div>

						</div>

						<!-- View All Accessories -->
						<div class="row justify-content-center mt-2">
							<div class="col-auto">
								<a href="#" class="btn btn-primary text-uppercase font-weight-semibold px-4 py-3">
									Shop All Accessories
									<i class="fas fa-arrow-right ml-2"></i>
								</a>
							</div>
						</div>

					</div>
				</section>

				<?php get_template_part("template-parts/section/promo-banner") ?>
				<?php get_template_directory_uri("template-parts/section/instagration-section") ?>

<?php get_footer() ?>
