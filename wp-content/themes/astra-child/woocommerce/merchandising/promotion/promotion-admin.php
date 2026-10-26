
<?php

defined( 'ABSPATH' ) || exit;



/**
 * Add Store Promotion settings page.
 */
function shop_add_promotion_settings_page() {

    add_submenu_page(
        'woocommerce',
        'Store Promotion',
        'Store Promotion',
        'manage_options',
        'shop-store-promotion',
        'shop_render_promotion_settings_page'
    );
}

add_action(
    'admin_menu',
    'shop_add_promotion_settings_page'
);


/**
 * Register promotion settings.
 */
function shop_register_promotion_settings() {

    register_setting(
        'shop_promotion_settings',
        'shop_promotion_enabled',
        array(
            'type'              => 'boolean',
            'sanitize_callback' => 'rest_sanitize_boolean',
            'default'           => false,
        )
    );

    register_setting(
        'shop_promotion_settings',
        'shop_promotion_discount',
        array(
            'type'              => 'number',
            'sanitize_callback' => function ( $value ) {
                return max( 0, min( 99.99, (float) $value ) );
            },
            'default'           => 0,
        )
    );

    register_setting(
        'shop_promotion_settings',
        'shop_promotion_exclude_sale',
        array(
            'type'              => 'boolean',
            'sanitize_callback' => 'rest_sanitize_boolean',
            'default'           => true,
        )
    );

    register_setting(
        'shop_promotion_settings',
        'shop_promotion_start_date',
        array(
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
        )
    );

    register_setting(
        'shop_promotion_settings',
        'shop_promotion_end_date',
        array(
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
        )
    );
}

add_action(
    'admin_init',
    'shop_register_promotion_settings'
);


/**
 * Render promotion settings page.
 */
function shop_render_promotion_settings_page() {
    ?>

    <div class="wrap">

        <h1>Store Promotion</h1>

        <form method="post" action="options.php">

            <?php settings_fields( 'shop_promotion_settings' ); ?>

            <table class="form-table">

                <tr>

                    <th scope="row">
                        Enable Promotion
                    </th>

                    <td>
                        <input
                            type="hidden"
                            name="shop_promotion_enabled"
                            value="0"
                        >

                        <label>

                            <input
                                type="checkbox"
                                name="shop_promotion_enabled"
                                value="1"
                                <?php checked( get_option( 'shop_promotion_enabled', false ), true ); ?>
                            >

                            Apply global promotion

                        </label>

                    </td>

                </tr>

                <tr>

                    <th scope="row">
                        Discount
                    </th>

                    <td>

                        <input
                            type="number"
                            name="shop_promotion_discount"
                            value="<?php echo esc_attr( get_option( 'shop_promotion_discount', 0 ) ); ?>"
                            min="0"
                            max="99.99"
                            step="0.01"
                            class="small-text"
                        >

                        %

                    </td>

                </tr>

                <tr>

                    <th scope="row">
                        Exclude Sale Products
                    </th>

                    <td>

                        <input
                            type="hidden"
                            name="shop_promotion_exclude_sale"
                            value="0"
                        >

                        <label>

                            <input
                                type="checkbox"
                                name="shop_promotion_exclude_sale"
                                value="1"
                                <?php checked( get_option( 'shop_promotion_exclude_sale', true ), true ); ?>
                            >

                            Do not apply the global promotion to products
                            that already have a Sale Price.

                        </label>

                    </td>

                </tr>

                <tr>

                    <th scope="row">
                        Start Date
                    </th>

                    <td>

                        <input
                            type="date"
                            name="shop_promotion_start_date"
                            value="<?php echo esc_attr( get_option( 'shop_promotion_start_date', '' ) ); ?>"
                        >

                    </td>

                </tr>

                <tr>

                    <th scope="row">
                        End Date
                    </th>

                    <td>

                        <input
                            type="date"
                            name="shop_promotion_end_date"
                            value="<?php echo esc_attr( get_option( 'shop_promotion_end_date', '' ) ); ?>"
                        >

                    </td>

                </tr>

            </table>

            <?php submit_button( 'Save Promotion' ); ?>

        </form>

    </div>

    <?php
}