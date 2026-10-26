<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <?php wp_head(); ?>
</head>

<body data-plugin-page-transition <?php body_class(); ?>>

<?php wp_body_open(); ?>
	<div class="body">
			<div class="notice-top-bar bg-primary" data-sticky-start-at="180">
				<button class="hamburguer-btn hamburguer-btn-light notice-top-bar-close m-0 active" data-set-active="false">
					<span class="close">
						<span></span>
						<span></span>
					</span>
				</button>
				<div class="container">
					<div class="row justify-content-center py-2">
						<div class="col-9 col-md-12 text-center">
							<p class="text-color-light font-weight-semibold mb-0">Get Up to <strong>40% OFF</strong> New-Season Styles <a href="#" class="btn btn-dark btn-modern btn-px-2 btn-py-1 ms-2">MEN</a> <a href="#" class="btn btn-dark btn-modern btn-px-2 btn-py-1 ms-1 me-2">WOMAN</a> <span class="opacity-6 text-1">* Limited time only.</span></p>
						</div>
					</div>
				</div>
			</div>
			<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyStartAt': 135, 'stickySetTop': '-135px', 'stickyChangeLogo': true}">
				<div class="header-body header-body-bottom-border-fixed box-shadow-none border-top-0">
					<div class="header-top header-top-small-minheight header-top-simple-border-bottom">
						<div class="container">
							<div class="header-row justify-content-between">
								<div class="header-column col-auto px-0">
									<div class="header-row">
										<p class="font-weight-semibold text-1 mb-0 d-none d-sm-block d-md-none">FREE SHIPPING ORDERS $99+</p>
										<p class="font-weight-semibold text-1 mb-0 d-none d-md-block">FREE RETURNS, STANDARD SHIPPING ORDERS $99+</p>
									</div>
								</div>
								<div class="header-column justify-content-end col-auto px-0">
									<div class="header-row">
										<nav class="header-nav-top">
											<ul class="nav nav-pills font-weight-semibold text-2">
												<li class="nav-item dropdown nav-item-left-border d-lg-none">
													<a class="nav-link text-color-default text-color-hover-primary" href="#" role="button" id="dropdownMobileMore" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														More
														<i class="fas fa-angle-down"></i>
													</a>
													<div class="dropdown-menu" aria-labelledby="dropdownMobileMore">
														<a class="dropdown-item" href="#">About</a>
														<a class="dropdown-item" href="#">Our Stores</a>
														<a class="dropdown-item" href="#">Blog</a>
														<a class="dropdown-item" href="#">Contact</a>
														<a class="dropdown-item" href="#">Help & FAQs</a>
														<a class="dropdown-item" href="#">Track Order</a>
													</div>
												</li>
												<li class="nav-item d-none d-lg-inline-block">
													<a href="<?php echo get_permalink( get_page_by_path("about-us")) ?>" class="text-decoration-none text-color-default text-color-hover-primary">About</a>
												</li>
												<li class="nav-item d-none d-lg-inline-block">
													<a href="#" class="text-decoration-none text-color-default text-color-hover-primary">Our Stores</a>
												</li>
												<li class="nav-item d-none d-lg-inline-block">
													<a href="#" class="text-decoration-none text-color-default text-color-hover-primary">Blog</a>
												</li>
												<li class="nav-item d-none d-lg-inline-block">
													<a href="<?php echo get_permalink( get_page_by_path("contact-us")) ?>" class="text-decoration-none text-color-default text-color-hover-primary">Contact</a>
												</li>
												<li class="nav-item d-none d-xl-inline-block">
													<a href="#" class="text-decoration-none text-color-default text-color-hover-primary">Help & FAQs</a>
												</li>
												<li class="nav-item d-none d-xl-inline-block">
													<a href="#" class="text-decoration-none text-color-default text-color-hover-primary">Track Order</a>
												</li>
												<li class="nav-item dropdown nav-item-left-border">
													<a class="nav-link text-color-default text-color-hover-primary" href="#" role="button" id="dropdownCurrency" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														USD
														<i class="fas fa-angle-down"></i>
													</a>
													<div class="dropdown-menu dropdown-menu-arrow-centered min-width-0" aria-labelledby="dropdownCurrency">
														<a class="dropdown-item" href="#">EUR</a>
														<a class="dropdown-item" href="#">USD</a>
													</div>
												</li>
												<li class="nav-item dropdown nav-item-right-border">
													<a class="nav-link text-color-default text-color-hover-primary" href="#" role="button" id="dropdownLanguage" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														ENG
														<i class="fas fa-angle-down"></i>
													</a>
													<div class="dropdown-menu dropdown-menu-arrow-centered min-width-0" aria-labelledby="dropdownLanguage">
														<a class="dropdown-item" href="#">ESP</a>
														<a class="dropdown-item" href="#">FRA</a>
														<a class="dropdown-item" href="#">ENG</a>
													</div>
												</li>
											</ul>
											<ul class="header-social-icons social-icons social-icons-clean social-icons-icon-gray">
												<li class="social-icons-facebook">
													<a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
												</li>
												<li class="social-icons-x">
													<a href="http://www.x.com/" target="_blank" title="X"><i class="fab fa-x-twitter"></i></a>
												</li>
												<li class="social-icons-linkedin">
													<a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a>
												</li>
											</ul>
										</nav>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="header-container container">
						<div class="header-row py-2">
							<div class="header-column w-100">
								<div class="header-row justify-content-between">
									<div class="header-logo z-index-2 col-lg-2 px-0">
										<a href="<?php echo home_url("/") ?>">
											<img alt="Porto" 
											width="60" height="60" 
											data-sticky-width="52" data-sticky-height="52" 
											data-sticky-top="90" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo.png">
										</a>
									</div>
									<div class="header-nav-features header-nav-features-no-border p-relative z-index-2 col col-lg-5 col-xl-6 px-0 ms-0">
										<div class="header-nav-feature ps-lg-5 pe-2 pe-lg-4 me-4 me-lg-0">
											<form role="search" action="page-search-results.html" method="get">
												<div class="search-with-select">
													<a href="#" class="mobile-search-toggle-btn text-decoration-none" data-toggle-class="open">
														<i class="icons icon-magnifier text-color-dark text-color-hover-primary"></i>
													</a>
													<div class="search-form-wrapper input-group">
														<input class="form-control text-1" id="headerSearch" name="q" type="search" value="" placeholder="Search...">
														<div class="search-form-select-wrapper">
															<div class="custom-select-1 d-none d-lg-block">
																<select name="category" class="form-control form-select">
																	<option value="all" selected>All Categories</option>
																	<option value="fashion">Fashion</option>
																	<option value="electronics">Electronics</option>
																	<option value="homegarden">Home & Garden</option>
																	<option value="motors">Motors</option>
																	<option value="features">Features</option>
																</select>
															</div>
															<button class="btn" type="submit" aria-label="Search">
																<i class="icons icon-magnifier header-nav-top-icon text-color-dark"></i>
															</button>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
									<ul class="header-extra-info col-auto col-lg-3 col-xl-2 ps-2 ps-xl-0 ms-lg-3 d-none d-lg-block">
										<li class="d-none d-sm-inline-flex ms-0">
											<div class="header-extra-info-icon ms-lg-4">
												<i class="icons icon-phone text-3 text-color-dark position-relative top-1"></i>
											</div>
											<div class="header-extra-info-text">
												<label class="text-1 font-weight-semibold text-color-default">CALL US NOW</label>
												<strong class="text-4"><a href="tel:+1234567890" class="text-color-hover-primary text-decoration-none">+123 4567 890</a></strong>
											</div>
										</li>
									</ul>
									<div class="d-flex col-auto col-lg-2 pe-0 ps-0 ps-xl-3">
										<ul class="header-extra-info">
											<li class="ms-0 ms-xl-4">
												<div class="header-extra-info-icon">
													<a href="<?php echo get_permalink( get_page_by_path("login")) ?>" class="text-decoration-none text-color-dark text-color-hover-primary text-2">
														<i class="icons icon-user"></i>
													</a>
												</div>
											</li>
											<li class="me-2 ms-3">
												<div class="header-extra-info-icon">
													<a href="#" class="text-decoration-none text-color-dark text-color-hover-primary text-2">
														<i class="icons icon-heart"></i>
													</a>
												</div>
											</li>
										</ul>
										<div class="header-nav-features ps-0 ms-1">
											<div class="header-nav-feature header-nav-features-cart header-nav-features-cart-big d-inline-flex top-2 ms-2">
												<a 
												href="#shoppingCart" 
												data-bs-toggle="offcanvas"
												aria-controls="shoppingCart"
												aria-label="Open shopping cart"
												class="header-nav-features-toggle shop-cart" 
												aria-label="">
													<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icons/icon-cart-big.svg" height="30" alt="" 
													class="header-nav-top-icon-img">
													<span class="cart-info">
														<span class="cart-qty number-order">0</span>
													</span>
												</a>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="header-column justify-content-end">
								<div class="header-row"></div>
							</div>
						</div>
					</div>
					<div class="header-nav-bar header-nav-bar-top-border bg-light p-relative z-index-1">
						<div class="header-container container">
							<div class="header-row">
								<div class="header-column">
									<div class="header-row justify-content-end">
										<div class="header-nav header-nav-line header-nav-top-line header-nav-top-line-with-border justify-content-start" data-sticky-header-style="{'minResolution': 991}" data-sticky-header-style-active="{'margin-left': '105px'}" data-sticky-header-style-deactive="{'margin-left': '0'}">
											<div class="header-nav-main header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-3 header-nav-main-sub-effect-1 w-100">
												<nav class="collapse w-100">
													<ul class="nav nav-pills w-100" id="mainNav">
														<li>
															<a class="active" href="<?php echo home_url("/") ?>">
																Home
															</a>
														</li>
														<li>
															<a href="<?php echo get_permalink( get_page_by_path("my-shop")) ?>">
																Shop
															</a>
														</li>
														<li>
															<a href="<?php echo esc_url(
																shop_get_product_collection_url( 'best-sellers' )
															); ?>">
																Best Sellers
															</a>
														</li>
														<li>
															<a href="<?php echo esc_url(
																shop_get_product_collection_url( 'new-arrivals' )
															); ?>">
																New Arrivals
															</a>
														</li>
														<li>
															<a href="<?php echo esc_url(
																shop_get_product_collection_url( 'sale' )
															); ?>">
																Sale
															</a>
														</li>
														<li>
															<a href="<?php echo get_permalink( get_page_by_path("shop-by-category")) ?>">
																Collections
															</a>
														</li>
														<li>
															<a href="shop.html">
																On Sale
															</a>
														</li>
														
														
														
													
														
														<li class="dropdown ms-lg-auto">
															<a href="#" class="dropdown-item">
																Outlet
															</a>
														</li>
														<li class="dropdown">
															<a href="#" class="dropdown-item">
																Buy Porto!
															</a>
														</li>
													</ul>
												</nav>
											</div>
											<button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
												<i class="fas fa-bars"></i>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
