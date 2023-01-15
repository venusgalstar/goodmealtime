<?php
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
add_filter('woocommerce_get_image_size_single', function ($size) {
    return array(
        'width' => 400,
        'height' => '',
        'crop' => 0,
    );
});