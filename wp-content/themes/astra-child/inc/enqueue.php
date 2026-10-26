<?php
/**
 * Enqueue theme styles and scripts.
 *
 * @package astonbike
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Get asset version based on file modification time.
 *
 * @param string $file Asset path relative to the theme directory.
 * @return int|null
 */
function astonbike_asset_version( $file ) {

	$file_path = get_stylesheet_directory_uri() . $file;

	if ( file_exists( $file_path ) ) {
		return filemtime( $file_path );
	}

	return null;
}

/**
 * Enqueue styles.
 */
function astonbike_enqueue_styles() {

	// Google Fonts.
	wp_enqueue_style(
		'astonbike-google-fonts',
		'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap',
		array(),
		null
	);

	// Vendor CSS.
	wp_enqueue_style(
		'bootstrap',
		get_stylesheet_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css',
		array(),
		'5.0.0'
	);

	wp_enqueue_style(
		'fontawesome',
		get_stylesheet_directory_uri() . '/assets/vendor/fontawesome-free/css/all.min.css',
		array(),
		'6.0.0'
	);

	wp_enqueue_style(
		'animate',
		get_stylesheet_directory_uri() . '/assets/vendor/animate/animate.compat.css',
		array(),
		null
	);

	wp_enqueue_style(
		'simple-line-icons',
		get_stylesheet_directory_uri() . '/assets/vendor/simple-line-icons/css/simple-line-icons.min.css',
		array(),
		null
	);

	wp_enqueue_style(
		'owl-carousel',
		get_stylesheet_directory_uri() . '/assets/vendor/owl.carousel/assets/owl.carousel.min.css',
		array(),
		null
	);

	wp_enqueue_style(
		'owl-theme-default',
		get_stylesheet_directory_uri() . '/assets/vendor/owl.carousel/assets/owl.theme.default.min.css',
		array( 'owl-carousel' ),
		null
	);

	wp_enqueue_style(
		'magnific-popup',
		get_stylesheet_directory_uri() . '/assets/vendor/magnific-popup/magnific-popup.min.css',
		array(),
		null
	);

	// Theme CSS.
	wp_enqueue_style(
		'astonbike-theme',
		get_stylesheet_directory_uri() . '/assets/css/theme.css',
		array( 'bootstrap' ),
		null
	);

	wp_enqueue_style(
		'astonbike-theme-elements',
		get_stylesheet_directory_uri() . '/assets/css/theme-elements.css',
		array( 'astonbike-theme' ),
		null
	);

	wp_enqueue_style(
		'astonbike-theme-blog',
		get_stylesheet_directory_uri() . '/assets/css/theme-blog.css',
		array( 'astonbike-theme' ),
		null
	);

	wp_enqueue_style(
		'astonbike-theme-shop',
		get_stylesheet_directory_uri() . '/assets/css/theme-shop.css',
		array( 'astonbike-theme' ),
		null
	);

	// Current page CSS.
	wp_enqueue_style(
		'astonbike-circle-flip',
		get_stylesheet_directory_uri() . '/assets/vendor/circle-flip-slideshow/css/component.css',
		array( 'astonbike-theme' ),
		null
	);

	// Skin CSS.
	wp_enqueue_style(
		'astonbike-skin',
		get_stylesheet_directory_uri() . '/assets/css/skins/default.css',
		array( 'astonbike-theme' ),
		null
	);

	// Custom CSS.
	wp_enqueue_style(
		'astonbike-custom',
		get_stylesheet_directory_uri() . '/assets/css/custom.css',
		array( 'astonbike-theme' ),
		null
	);

	// Responsive CSS.
	wp_enqueue_style(
		'astonbike-responsive',
		get_stylesheet_directory_uri() . '/assets/css/responsive.css',
		array( 'astonbike-custom' ),
		null
	);
}

add_action( 'wp_enqueue_scripts', 'astonbike_enqueue_styles' );


/**
 * Enqueue theme scripts.
 */
function astonbike_enqueue_scripts() {

	// Vendor.
	wp_enqueue_script(
		'astonbike-plugins',
		get_stylesheet_directory_uri() . '/assets/vendor/plugins/js/plugins.min.js',
		array( 'jquery' ),
		astonbike_asset_version( '/assets/vendor/plugins/js/plugins.min.js' ),
		true
	);

	// Theme Base, Components and Settings.
	wp_enqueue_script(
		'astonbike-theme',
		get_stylesheet_directory_uri() . '/assets/js/theme.js',
		array( 'astonbike-plugins' ),
		astonbike_asset_version( '/assets/js/theme.js' ),
		true
	);

	if ( is_shop() || is_product() || is_product_category() ) {

	wp_enqueue_script(
		'astonbike-view-shop',
		get_stylesheet_directory_uri() . '/assets/js/views/view.shop.js',
		array( 'astonbike-theme' ),
		astonbike_asset_version( '/assets/js/views/view.shop.js' ),
		true
	);
	
}

wp_enqueue_script(
		'astonbike-gallery-shop',
		get_stylesheet_directory_uri() . '/assets/js/examples/examples.gallery.js',
		array( 'astonbike-theme' ),
		astonbike_asset_version( '/assets/js/examples/examples.gallery.js' ),
		true
	);

	// Theme Custom.
	wp_enqueue_script(
		'astonbike-custom',
		get_stylesheet_directory_uri() . '/assets/js/custom.js',
		array( 'astonbike-theme' ),
		astonbike_asset_version( '/assets/js/custom.js' ),
		true
	);

	// Theme Initialization Files.
	wp_enqueue_script(
		'astonbike-theme-init',
		get_stylesheet_directory_uri() . '/assets/js/theme.init.js',
		array( 'astonbike-theme', 'astonbike-custom' ),
		astonbike_asset_version( '/assets/js/theme.init.js' ),
		true
	);
}

add_action( 'wp_enqueue_scripts', 'astonbike_enqueue_scripts' );





