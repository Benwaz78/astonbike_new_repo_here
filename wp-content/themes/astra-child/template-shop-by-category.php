<?php 
/*
Template Name: Shop By Category
*/
get_header() 
?>

	
			<div role="main" class="main shop pt-4">

				<div class="container">
					<?php get_template_part( "template-parts/components/shop-filter-btn" ) ?>
					<div class="row">
						<?php get_sidebar("shop") ?>

						<div class="col-lg-9 order-1 order-lg-2">

							<div class="row products product-thumb-info-list">

								<!-- Category -->
								<div class="col-sm-6 col-lg-4 mb-4">
									<div class="bike-category-card">

										<div class="bike-category-image">
											<img
												src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/products/categories/children.webp"
												alt="Bikes"
												class="img-fluid"
											>

											<div class="bike-category-overlay"></div>

											<div class="bike-category-content">
												<span class="bike-category-label">
													Explore
												</span>

												<h3>Bikes</h3>

												<a href="#" class="bike-category-btn">
													View Category
													<i class="fas fa-arrow-right"></i>
												</a>
											</div>

										</div>

									</div>
								</div>


								<!-- Category -->
								<div class="col-sm-6 col-lg-4 mb-4">
									<div class="bike-category-card">

										<div class="bike-category-image">
											<img
												src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/products/helmet/helmet.webp"
												alt="Helmets"
												class="img-fluid"
											>

											<div class="bike-category-overlay"></div>

											<div class="bike-category-content">
												<span class="bike-category-label">
													Safety
												</span>

												<h3>Helmets</h3>

												<a href="#" class="bike-category-btn">
													View Category
													<i class="fas fa-arrow-right"></i>
												</a>
											</div>

										</div>

									</div>
								</div>


								<!-- Category -->
								<div class="col-sm-6 col-lg-4 mb-4">
									<div class="bike-category-card">

										<div class="bike-category-image">
											<img
												src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/categories/lights.jpg"
												alt="Bike Lights"
												class="img-fluid"
											>

											<div class="bike-category-overlay"></div>

											<div class="bike-category-content">
												<span class="bike-category-label">
													Accessories
												</span>

												<h3>Bike Lights</h3>

												<a href="#" class="bike-category-btn">
													View Category
													<i class="fas fa-arrow-right"></i>
												</a>
											</div>

										</div>

									</div>
								</div>


								<!-- Category -->
								<div class="col-sm-6 col-lg-4 mb-4">
									<div class="bike-category-card">

										<div class="bike-category-image">
											<img
												src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/categories/locks.jpg"
												alt="Bike Locks"
												class="img-fluid"
											>

											<div class="bike-category-overlay"></div>

											<div class="bike-category-content">
												<span class="bike-category-label">
													Security
												</span>

												<h3>Bike Locks</h3>

												<a href="#" class="bike-category-btn">
													View Category
													<i class="fas fa-arrow-right"></i>
												</a>
											</div>

										</div>

									</div>
								</div>


								<!-- Category -->
								<div class="col-sm-6 col-lg-4 mb-4">
									<div class="bike-category-card">

										<div class="bike-category-image">
											<img
												src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/categories/components.jpg"
												alt="Bike Components"
												class="img-fluid"
											>

											<div class="bike-category-overlay"></div>

											<div class="bike-category-content">
												<span class="bike-category-label">
													Components
												</span>

												<h3>Bike Components</h3>

												<a href="#" class="bike-category-btn">
													View Category
													<i class="fas fa-arrow-right"></i>
												</a>
											</div>

										</div>

									</div>
								</div>


								<!-- Category -->
								<div class="col-sm-6 col-lg-4 mb-4">
									<div class="bike-category-card">

										<div class="bike-category-image">
											<img
												src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/products/categories/adult.jpg"
												alt="Accessories"
												class="img-fluid"
											>

											<div class="bike-category-overlay"></div>

											<div class="bike-category-content">
												<span class="bike-category-label">
													Essentials
												</span>

												<h3>Accessories</h3>

												<a href="#" class="bike-category-btn">
													View Category
													<i class="fas fa-arrow-right"></i>
												</a>
											</div>

										</div>

									</div>
								</div>

							</div>

						</div>

					</div>
			</div>
      
						
<?php get_footer() ?>
