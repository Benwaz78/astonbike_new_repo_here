<?php
/**
 * Product Video Field
 */
add_action('woocommerce_product_options_general_product_data', function () {

    global $post;

    $video_id = get_post_meta($post->ID, '_product_video', true);

    ?>

    <div class="options_group">

        <p class="form-field">

            <label><?php _e('Product Video', 'woovideo'); ?></label>

            <input
                type="hidden"
                id="product_video"
                name="product_video"
                value="<?php echo esc_attr($video_id); ?>">

            <button
                type="button"
                class="button"
                id="upload_product_video">

                Upload Video

            </button>

            <button
                type="button"
                class="button"
                id="remove_product_video">

                Remove

            </button>

            <span id="video_filename" style="margin-left:10px;">

                <?php

                if ($video_id) {

                    echo esc_html(get_the_title($video_id));

                }

                ?>

            </span>

        </p>

    </div>

    <?php
});


add_action('woocommerce_process_product_meta', function ($product_id) {

    if (isset($_POST['product_video'])) {

        update_post_meta(
            $product_id,
            '_product_video',
            absint($_POST['product_video'])
        );

    }

});


add_action('admin_enqueue_scripts', function ($hook) {

    // Only load on Product edit screens
    if (!in_array($hook, ['post.php', 'post-new.php'], true)) {
        return;
    }

    $screen = get_current_screen();

    if (!$screen || $screen->post_type !== 'product') {
        return;
    }

    wp_enqueue_media();

    wp_enqueue_script(
        'woocommerce-product-video',
        get_stylesheet_directory_uri() . '/woocommerce/product-video/assets/js/script.js',
        [],
        '1.0.0',
        true
    );

});