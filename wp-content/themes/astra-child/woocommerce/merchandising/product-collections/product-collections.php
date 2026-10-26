<?php

defined( 'ABSPATH' ) || exit;



/**
 * Register product collection query variable.
 *
 * @param array $vars Existing query variables.
 * @return array
 */
function shop_register_product_collection_query_var( $vars ) {

	$vars[] = 'collection';

	return $vars;
}

add_filter(
	'query_vars',
	'shop_register_product_collection_query_var'
);


/**
 * Register product collection rewrite rules.
 */
function shop_register_product_collection_rewrite_rules() {

	add_rewrite_rule(
		'^my-shop/([^/]+)/?$',
		'index.php?pagename=my-shop&collection=$matches[1]',
		'top'
	);
}

add_action(
	'init',
	'shop_register_product_collection_rewrite_rules'
);


/**
 * Get the URL for a product collection.
 *
 * @param string $collection Collection slug.
 * @return string
 */
function shop_get_product_collection_url( $collection ) {

	$collection = sanitize_key( $collection );

	$collections = shop_get_product_collections();

	if ( ! isset( $collections[ $collection ] ) ) {
		return '';
	}

	return home_url(
		'/my-shop/' . $collection . '/'
	);
}



/**
 * Get available product collections.
 *
 * @return array
 */
function shop_get_product_collections() {

	return array(

		'new-arrivals' => array(
			'label' => 'New Arrivals',
		),

		'best-sellers' => array(
			'label' => 'Best Sellers',
		),

		'sale' => array(
			'label' => 'Sale',
		),

	);
}


/**
 * Get product IDs belonging to a merchandising collection.
 *
 * Supported collections:
 *
 * - new-arrivals
 * - best-sellers
 * - sale
 *
 * @param string $collection Collection slug.
 * @return array
 */
function shop_get_product_collection_ids( $collection ) {

	$collection = sanitize_key( $collection );

	switch ( $collection ) {

		/*
		 * New Arrivals
		 */
		case 'new-arrivals':

			$days = (int) get_option(
				'shop_new_arrival_days',
				30
			);

			if ( $days <= 0 ) {
				return array();
			}

			$date_after = wp_date(
				'Y-m-d H:i:s',
				current_time( 'timestamp' ) - ( $days * DAY_IN_SECONDS )
			);

			$query = new WP_Query(
				array(
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'fields'         => 'ids',

					'date_query'     => array(
						array(
							'after'     => $date_after,
							'inclusive' => true,
						),
					),
				)
			);

			return array_map(
				'absint',
				$query->posts
			);


    




    
		/*
		 * Best Sellers
		 */
		case 'best-sellers':

			$sales = shop_get_best_seller_sales();

			$minimum_units = (int) get_option(
				'shop_best_seller_minimum_units',
				5
			);

			$product_ids = array();


			/*
			 * 1. Add automatically identified Best Sellers.
			 */
			if ( $minimum_units > 0 && ! empty( $sales ) ) {

				foreach ( $sales as $product_id => $units_sold ) {

					if ( $units_sold < $minimum_units ) {
						continue;
					}

					$product_id = absint( $product_id );

					if ( ! $product_id ) {
						continue;
					}

					$product = wc_get_product( $product_id );

					if ( ! $product ) {
						continue;
					}


					/*
					 * If this is a variation, use its parent.
					 */
					if ( $product->is_type( 'variation' ) ) {

						$parent_id = $product->get_parent_id();

						if ( $parent_id ) {
							$product_ids[] = $parent_id;
						}

						continue;
					}


					/*
					 * Simple or variable parent product.
					 */
					$product_ids[] = $product_id;
				}
			}


			/*
			 * 2. Get manually marked Best Sellers.
			 */
			$manual_query = new WP_Query(
				array(
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'fields'         => 'ids',

					'meta_query'     => array(
						array(
							'key'   => '_shop_manual_best_seller',
							'value' => 'yes',
						),
					),
				)
			);

			$manual_product_ids = array_map(
				'absint',
				$manual_query->posts
			);


			/*
			 * 3. Combine both sources and remove duplicates.
			 */
			$product_ids = array_values(
				array_unique(
					array_merge(
						$product_ids,
						$manual_product_ids
					)
				)
			);


			/*
			 * 4. Sort by sales, highest first.
			 * Manually marked products without sales appear last.
			 */
			usort(
				$product_ids,
				function ( $a, $b ) use ( $sales ) {

					$a_sales = isset( $sales[ $a ] )
						? (int) $sales[ $a ]
						: 0;

					$b_sales = isset( $sales[ $b ] )
						? (int) $sales[ $b ]
						: 0;

					return $b_sales <=> $a_sales;
				}
			);

			return $product_ids;


     /*
        * Sale
        */

    case 'sale':
    

        $product_ids = array();
        /*
        * Get all published simple and variable products.
        */
        $products = wc_get_products(
            array(
                'status' => 'publish',
                'type'   => array(
                    'simple',
                    'variable',
                ),
                'limit'  => -1,
                'return' => 'objects',
            )
        );

        foreach ( $products as $product ) {

            /*
            * Simple product.
            */
            if ( $product->is_type( 'simple' ) ) {

                if ( $product->is_on_sale() ) {
                    $product_ids[] = $product->get_id();
                }

                continue;
            }


            /*
            * Variable product.
            *
            * Check the parent first.
            */
            if ( $product->is_on_sale() ) {

                $product_ids[] = $product->get_id();

                continue;
            }


            /*
            * The parent is not on sale, so check
            * individual variations.
            */
            if ( $product->is_type( 'variable' ) ) {

                $variation_ids = $product->get_children();

                foreach ( $variation_ids as $variation_id ) {

                    $variation = wc_get_product( $variation_id );

                    if ( ! $variation ) {
                        continue;
                    }

                    if ( $variation->is_on_sale() ) {

                        $product_ids[] = $product->get_id();

                        break;
                    }
                }
            }
        }


        return array_values(
            array_unique(
                array_map( 'absint', $product_ids )
            )
        );
    }

	return array();
}
