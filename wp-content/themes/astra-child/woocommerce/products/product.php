<?php
/**
 * Product  functions.
 *
 * @package BonnySoft
 */

defined( 'ABSPATH' ) || exit;

/**
 * Format a price as plain text using WooCommerce currency settings.
 */
if ( ! function_exists( 'shop_format_product_price' ) ) {
    function shop_format_product_price( $price ) {
        $decimals = wc_get_price_decimals();

        $formatted = number_format(
            (float) $price,
            $decimals,
            wc_get_price_decimal_separator(),
            wc_get_price_thousand_separator()
        );

       $symbol = "₦";

        $position = get_option( 'woocommerce_currency_pos', 'left' );

        switch ( $position ) {
            case 'right':
                return $formatted . $symbol;

            case 'left_space':
                return $symbol . ' ' . $formatted;

            case 'right_space':
                return $formatted . ' ' . $symbol;

            default:
                return $symbol . $formatted;
        }
    }
}





/**
 * Return custom price markup for simple and variable products.
 *
 * Variable products display a price range.
 * Sale prices display the current price before the regular price.
 *
 * @param WC_Product|null $product Product object.
 * @return string
 */
if ( ! function_exists( 'shop_get_single_product_price_html' ) ) {
    function shop_get_single_product_price_html( $product = null ) {

        if ( ! $product ) {
            global $product;
        }

        if ( is_numeric( $product ) ) {
            $product = wc_get_product( $product );
        }

        if ( ! $product instanceof WC_Product ) {
            return '';
        }

        /*
         * Simple product.
         */
        if ( $product->is_type( 'simple' ) ) {

            $current = (float) wc_get_price_to_display( $product );

            $regular_raw = $product->get_regular_price();
            $regular = '' !== $regular_raw
                ? (float) wc_get_price_to_display(
                    $product,
                    array( 'price' => $regular_raw )
                )
                : $current;

            $is_sale = $product->is_on_sale()
                && $current < $regular;

            $html = sprintf(
                '<span data-price-current>%s</span>',
                wp_kses_post( shop_format_product_price( $current ) )
            );

            if ( $is_sale ) {
                $html .= sprintf(
                    ' <del data-price-regular>%s</del>',
                    wp_kses_post( shop_format_product_price( $regular ) )
                );
            }

            return $html;
        }

        /*
         * Variable product: calculate current and regular ranges.
         */
        if ( $product->is_type( 'variable' ) ) {

            $current_prices = array();
            $regular_prices = array();

            foreach ( $product->get_available_variations() as $variation ) {

                if ( ! isset( $variation['display_price'] ) ) {
                    continue;
                }

                $current = (float) $variation['display_price'];
                $regular = (float) $variation['display_regular_price'];

                $current_prices[] = $current;

                if ( $regular > 0 ) {
                    $regular_prices[] = $regular;
                }
            }

            if ( empty( $current_prices ) ) {
                return '';
            }

           $min_current = min( $current_prices );
            $min_regular = ! empty( $regular_prices )
                ? min( $regular_prices )
                : $min_current;

            $has_sale = false;

            foreach ( $product->get_available_variations() as $variation ) {
                if (
                    (float) $variation['display_regular_price']
                    > (float) $variation['display_price']
                ) {
                    $has_sale = true;
                    break;
                }
            }

            $html = sprintf(
                '<span data-price-current>%s</span>',
                wp_kses_post( shop_format_product_price( $min_current ) )
            );

            if ( $has_sale ) {
                $html .= sprintf(
                    ' <del data-price-regular>%s</del>',
                    wp_kses_post( shop_format_product_price( $min_regular ) )
                );
            }

            return $html;
        }

        return '';
    }
}




/**
 * Return custom price markup for product cards.
 *
 * Simple products display their current price and, when on sale,
 * their crossed-out regular price.
 *
 * Variable products display a current price range and, when at
 * least one variation is on sale, a crossed-out regular price range.
 *
 * @param WC_Product|null $product Product object.
 * @return string
 */
if ( ! function_exists( 'shop_get_product_card_price_html' ) ) {
    function shop_get_product_card_price_html( $product = null ) {

        if ( ! $product ) {
            global $product;
        }

        if ( is_numeric( $product ) ) {
            $product = wc_get_product( $product );
        }

        if ( ! $product instanceof WC_Product ) {
            return '';
        }

        /*
         * Simple product.
         */
        if ( $product->is_type( 'simple' ) ) {

            $current = (float) wc_get_price_to_display( $product );

            $regular_raw = $product->get_regular_price();

            $regular = '' !== $regular_raw
                ? (float) wc_get_price_to_display(
                    $product,
                    array( 'price' => $regular_raw )
                )
                : $current;

            $is_sale = $product->is_on_sale()
                && $current < $regular;

            $html = sprintf(
                '<span class="product-card-price-current">%s</span>',
                esc_html( shop_format_product_price( $current ) )
            );

            if ( $is_sale ) {
                $html .= sprintf(
                    ' <del class="product-card-price-regular">%s</del>',
                    esc_html( shop_format_product_price( $regular ) )
                );
            }

            return $html;
        }

        /*
         * Variable product.
         */
        if ( $product->is_type( 'variable' ) ) {

            $current_prices = array();
            $regular_prices = array();
            $has_sale       = false;

            foreach ( $product->get_available_variations() as $variation ) {

                if (
                    ! isset( $variation['display_price'] ) ||
                    ! isset( $variation['display_regular_price'] )
                ) {
                    continue;
                }

                $current = (float) $variation['display_price'];
                $regular = (float) $variation['display_regular_price'];

                $current_prices[] = $current;
                $regular_prices[] = $regular;

                if ( $regular > $current ) {
                    $has_sale = true;
                }
            }

            if ( empty( $current_prices ) ) {
                return '';
            }

            $min_current = min( $current_prices );
            $max_current = max( $current_prices );

            $html = sprintf(
                '<span class="product-card-price-current">%s</span>',
                esc_html( shop_format_product_price( $min_current ) )
            );

            if ( $max_current > $min_current ) {
                $html .= sprintf(
                    ' – <span class="product-card-price-current">%s</span>',
                    esc_html( shop_format_product_price( $max_current ) )
                );
            }

            /*
             * Display the regular-price range if any variation
             * has a genuine discount.
             */
            if ( $has_sale && ! empty( $regular_prices ) ) {

                $min_regular = min( $regular_prices );
                $max_regular = max( $regular_prices );

                $html .= sprintf(
                    ' <del class="product-card-price-regular">%s',
                    esc_html( shop_format_product_price( $min_regular ) )
                );

                if ( $max_regular > $min_regular ) {
                    $html .= sprintf(
                        ' – %s',
                        esc_html( shop_format_product_price( $max_regular ) )
                    );
                }

                $html .= '</del>';
            }

            return $html;
        }

        return '';
    }
}
