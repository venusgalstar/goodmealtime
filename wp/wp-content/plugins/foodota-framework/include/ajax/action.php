<?php
add_action('wp_ajax_nopriv_restaurant_favorite', 'restaurant_favorite_function');
add_action('wp_ajax_restaurant_favorite', 'restaurant_favorite_function');
if (!function_exists('restaurant_favorite_function')) {
    function restaurant_favorite_function()
    {
        $store_id = $_POST['store_ids'];
        $restaurant_fav = $_POST['res_fav'];
        $check_fav = '';
        $user_status = check_user_login();

        if ($user_status == true) {
            $user_id = get_current_user_id();
            if ($restaurant_fav == "true") {
                update_user_meta($user_id, 'restaurant_favorite' . $store_id, $store_id);
                $check_fav = get_user_meta($user_id, 'restaurant_favorite' . $store_id, true);
                $return = array('res_fav_status' => $check_fav);
                wp_send_json_success($return);
            } elseif ($restaurant_fav == "false") {
                delete_user_meta($user_id, 'restaurant_favorite' . $store_id, $store_id);
                $check_fav = get_user_meta($user_id, 'restaurant_favorite' . $store_id, true);
                $return = array('res_fav_status' => $check_fav);
                wp_send_json_success($return);
            }
        } else {
            $return = '';
            wp_send_json_error($return);
        }
    }
}
add_action('wp_ajax_nopriv_restaurant_cat_filters', 'restaurant_cat_filter_function');
add_action('wp_ajax_restaurant_cat_filters', 'restaurant_cat_filter_function');
if (!function_exists('restaurant_cat_filter_function')) {
    function restaurant_cat_filter_function()
    {
        global $foodota_options;
        $nonce = isset($_POST['nonce']) ? $_POST['nonce'] : "";
        food_verify_nonce($nonce, 'ajax-nonce');
        $restaurant_cats_ids = $_POST['res_cat_filter'];
        $restaurant_cats_ids = isset($_POST['res_cat_filter']) ? $_POST['res_cat_filter'] : '';
        $restaurant_price_range = isset($_POST['rec_price_range']) ? $_POST['rec_price_range'] : '';
        if (empty($restaurant_cats_ids)) {
            $store_id = '';
            $geo = '';
            $args = array(
                'role' => 'wcfm_vendor',
                'orderby' => 'last_name',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => '_wcfm_state',
                        'value' => $geo,
                        'compare' => 'LIKE',
                    ),
                ),
            );
            $users = get_users($args);
            $found_restaurants = count($users);
            $query = get_users($args);
            $filter_data = '';
            foreach ($users as $user) {
                $store_id = $user->ID;
                $filter_data .= '<div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">' . foodota_all_restaurant_function($store_id, 'grid-view') . '</div>';
            }
            wp_reset_postdata();
            $return = array('res_filter_data' => $filter_data);
            ($return);
        }
        function filter_authors($groupby)
        {
            global $wpdb;
            $groupby = " {$wpdb->posts}.post_author";
            return $groupby;
        }
        add_filter('posts_groupby', 'filter_authors');
        $args = array(
            'posts_per_page' => -1,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'product_cat',
                    'terms' => $restaurant_cats_ids
                )
            ),
            'post_type' => 'product',
            'orderby' => 'title,',

        );
        $products = new WP_Query($args);
        remove_filter('posts_groupby', 'filter_authors');
        if ($products->have_posts()) {
            $store_ids = array();
            while ($products->have_posts()) {
                $products->the_post();
                $post_author_id = get_post_field('post_author', get_the_ID());
                $user_meta = get_userdata($post_author_id);
                $user_roles = $user_meta->roles;
                   if($user_roles[0]=='wcfm_vendor'){
                       $store_ids[] = $post_author_id;
                   }
            }
            $filter_data = '';
            foreach ($store_ids as $store_id) {
                $filter_data .= '<div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">' . foodota_all_restaurant_function($store_id, 'grid-view') . '</div>';
            }
            wp_reset_postdata();
            $return = array('res_filter_data' => $filter_data, 'res_filter_total' => count($store_ids));
            wp_send_json_success($return);
        } else {
            $return = "";
            $filter_data = '';
            $return = array('res_filter_data' => $filter_data, 'res_filter_total' => $products->found_posts);
            wp_send_json_error($return);
        }
    }
}
add_action('wp_ajax_nopriv_restaurant_delete_category', 'delete_cat_function');
add_action('wp_ajax_restaurant_delete_category', 'delete_cat_function');
if (!function_exists('delete_cat_function')) {
    function delete_cat_function()
    {
        $restaurant_cats_ids = $_POST['res_cat_id'];
        $post_id = $_POST['res_post_id'];
        $food_cat_html = '';
        if ($restaurant_cats_ids != '') {
            $query_status = wp_delete_term($restaurant_cats_ids, 'food_category');
            if (is_wp_error($query_status)) {
                $return = array("success" => false, 'message' => esc_html__('Not Deleted', 'foodota-framework'));
                wp_send_json_error($return);
            } else {
                $restaurant_related_cat = wp_get_post_terms($post_id, "food_category", array('fields' => 'all'));
                foreach ($restaurant_related_cat as $food_cats) {
                    if (isset($food_cats) && !empty($food_cats)) {
                        $food_cat_html .= food_category_show($food_cats);
                    }
                }
                $return = array('res_category_data' => $food_cat_html);
                wp_send_json_success($return);
            }
        }
    }
}
add_action('wp_ajax_nopriv_foodota_product_order', 'foodota_product_data');
add_action('wp_ajax_foodota_product_order', 'foodota_product_data');
if (!function_exists('foodota_product_data')) {
    function foodota_product_data()
    {
        $order_product_id = $_POST['product_ids'];
        $store_ids = $_POST['store_id'];
        if ($order_product_id != '') {
            $modalget = foodota_product_item($order_product_id, $store_ids);
            $return = array('message' => esc_html__('Model Show', 'foodota-framework'), 'modaler' => $modalget);
            wp_send_json_success($return);
        } else {
            $return = array('message' => esc_html__('Model not show ', 'foodota-framework'));
        }
    }
}
add_action('wp_ajax_nopriv_restaurant_getby_location', 'foodota_restaurants_bylocation');
add_action('wp_ajax_restaurant_getby_location', 'foodota_restaurants_bylocation');
if (!function_exists('foodota_restaurants_bylocation')) {
    function foodota_restaurants_bylocation()
    {
        global $foodota_options;
        $food_radius_search = (isset($foodota_options['radius-search']) ? $foodota_options['radius-search'] : '');
        $nonce = isset($_POST['nonce']) ? $_POST['nonce'] : "";
        food_verify_nonce($nonce, 'ajax-nonce');
        $filter_status = (isset($_POST['status_loc'])) ? $_POST['status_loc'] : '';
        $latitude = (isset($_POST['user_current_lat'])) ? $_POST['user_current_lat'] : '';
        $longitude = (isset($_POST['user_current_lng'])) ? $_POST['user_current_lng'] : '';
        $distance = (isset($_POST['rd'])) ? $_POST['rd'] : $food_radius_search;
        $lat_lng_meta_query = array();
        $diliver_query = array();
        if ($latitude != "" && $longitude != "") {
            $data_array = array("latitude" => $latitude, "longitude" => $longitude, "distance" => $distance);
            if ($latitude != "" && $longitude != "") {
                $type_lat = "'DECIMAL'";
                $type_lon = "'DECIMAL'";
                $lats_longs = foodota_determine_minMax_latLong($data_array, false);
                if (isset($lats_longs) && count($lats_longs) > 0) {
                    //$lat_lng_meta_query['relation'] = 'AND';
                    $lat_lng_meta_query[] = array('key' => '_wcfm_store_lat', 'value' => array($lats_longs['lat']['min'], $lats_longs['lat']['max']), 'compare' => 'BETWEEN', 'type' => 'DECIMAL',);
                    $lat_lng_meta_query[] = array('key' => '_wcfm_store_lng', 'value' => array($lats_longs['long']['min'], $lats_longs['long']['max']), 'compare' => 'BETWEEN', 'type' => 'DECIMAL',);
                    add_filter('get_meta_sql', 'foodota_cast_decimal_precision');
                    if (!function_exists('foodota_cast_decimal_precision')) {
                        function foodota_cast_decimal_precision($array)
                        {
                            $array['where'] = str_replace('DECIMAL', 'DECIMAL(10,3)', $array['where']);
                            return $array;
                        }
                    }
                }
            }
        }

        $diliver_query =  array('key' => '_wcfmmp_shipping', 'value' => 'yes', 'compare' => 'LIKE');

        //_wcfmmp_user_shipping_enable

        $store_id = '';

        if($filter_status==1){

        }


        $store_id = '';
        $geo = '';
        if($filter_status==1){
        $args = array(
            'role' => 'wcfm_vendor',
            'orderby' => 'last_name',
            'order' => 'ASC',
            'meta_query' => array(
                $lat_lng_meta_query
            )
        );
        }elseif ($filter_status==2){
            $args = array(
                'role' => 'wcfm_vendor',
                'orderby' => 'last_name',
                'order' => 'ASC',
                'meta_query' => array(
                    $diliver_query,
                    $lat_lng_meta_query
                )
            );
        }elseif ($filter_status==3){
            $args = array(
                'role' => 'wcfm_vendor',
                'orderby' => 'last_name',
                'order' => 'ASC',
                'meta_query' => array(
                    $diliver_query,
                )
            );
        }

        $users = get_users($args);
        $return = '';
        $near_by = '';
        $res_number = '';
        if ($users) {
            foreach ($users as $user) {

                $store_id = $user->ID;
                $near_by .= '<div class="col-xl-4 col-lg-6 col-md-6">' . foodota_all_restaurant_function($store_id, 'grid-view') . '</div>';
            }
            $res_number = count($users);
            $return = array('nearby_restaurants' => $near_by, 'total_restaurants' => $res_number);
            wp_send_json_success($return);
            wp_reset_postmeta();
        } else {
            $return = array('message' => "no data found");
            wp_send_json_error($return);
        }
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'refresh_cart_count', 50, 1);
if (!function_exists('refresh_cart_count')) {
    function refresh_cart_count($fragments)
    {
        ob_start();
        ?>
        <div class="counter cart-count">
            <?php
            global $woocommerce;
            ?>
            <?php
            add_filter('woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99);
            echo do_shortcode('[woocommerce_cart]');
            ?>
        </div>
        <?php
        $fragments['.cart-count'] = ob_get_clean();
        return $fragments;
    }
}
add_action('wp_ajax_update_item_from_cart', 'update_item_from_cart');
add_action('wp_ajax_nopriv_update_item_from_cart', 'update_item_from_cart');
if (!function_exists('update_item_from_cart')) {
    function update_item_from_cart()
    {
        $cart_item_key = $_POST['item_key'];
        $threeball_product_values = WC()->cart->get_cart_item($cart_item_key);
        $threeball_product_quantity = apply_filters('woocommerce_stock_amount_cart_item', apply_filters('woocommerce_stock_amount', preg_replace("/[^0-9\.]/", '', filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT))), $cart_item_key);
        $passed_validation = apply_filters('woocommerce_update_cart_validation', true, $cart_item_key, $threeball_product_values, $threeball_product_quantity);
        if ($passed_validation) {
            WC()->cart->set_quantity($cart_item_key, $threeball_product_quantity, true);
        }
        add_filter('woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99);
        $return_data = do_shortcode('[woocommerce_cart]');
        $return = array('res_filter_data' => $return_data);
        wp_send_json_success($return);
        die();
    }
}
add_filter('gettext', 'Behrooz_woo_translations', 20, 3);
add_filter('ngettext', 'Behrooz_woo_translations', 20, 3);
if (!function_exists('Behrooz_woo_translations')) {
    function Behrooz_woo_translations($translation, $text, $domain)
    {
        $custom_text = array(
            'Enter your address to view shipping options.' => '',
        );
        if (array_key_exists($translation, $custom_text)) {
            $translation = $custom_text[$translation];
        }
        return $translation;
    }
}
if (!function_exists('woocommerce_button_proceed_to_checkout')) {
    function woocommerce_button_proceed_to_checkout()
    {
        $new_checkout_url = wc_get_checkout_url();
        ?>
        <a href="<?php echo $new_checkout_url; ?>" class="checkout-button button alt wc-forward">
            <?php _e('Confirm Order', 'foodota-framework'); ?></a>
        <?php
    }
}
add_action('wp_ajax_product_remove', 'product_remove');
add_action('wp_ajax_nopriv_product_remove', 'product_remove');
if (!function_exists('product_remove')) {
    function product_remove()
    {
        global $wpdb, $woocommerce;
        session_start();
        foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
            if ($cart_item['product_id'] == $_POST['product_id']) {
                WC()->cart->remove_cart_item($cart_item_key);
            }
        }
        add_filter('woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99);
        $return_data = do_shortcode('[woocommerce_cart]');
        $return = array('res_filter_data' => $return_data);
        wp_send_json_success($return);
        die();
    }
}

add_action('wp_ajax_spyr_coupon_redeem_handler', 'spyr_coupon_redeem_handler');
add_action('wp_ajax_nopriv_spyr_coupon_redeem_handler', 'spyr_coupon_redeem_handler');
if (!function_exists('spyr_coupon_redeem_handler')) {
    function spyr_coupon_redeem_handler()
    {
        global $wpdb, $woocommerce;
        $code = $_REQUEST['coupon_code'];
        $coupon = new \WC_Coupon($code);
        $discounts = new \WC_Discounts(WC()->cart);
        $valid_response = $discounts->is_coupon_valid($coupon);
        if (empty($code) || !isset($code)) {
            $response = array(
                'result' => 'isempty',
            );
            wp_send_json_error($response);
            exit();
        } elseif (is_wp_error($valid_response)) {
            $response = array(
                'result' => 'isinvalid',
            );
            wp_send_json_error($response);
            exit();
        } else {
            add_filter('woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99);
            $coupon_code = $code;
            $coupon_status = WC()->cart->apply_coupon($coupon_code);
            $return_data = do_shortcode('[woocommerce_cart]');
            $response = array('res_filter_data' => $return_data);
            wp_send_json_success($response);
            exit();
        }
    }
}
if (!function_exists('disable_shipping_calc_on_cart')) {
    function disable_shipping_calc_on_cart($show_shipping)
    {
        return false;
        return $show_shipping;
    }
}
add_action('wp_ajax_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart');
if (!function_exists('ql_woocommerce_ajax_add_to_cart')) {
    function ql_woocommerce_ajax_add_to_cart()
    {
        parse_str($_POST['my_val'], $params);
        $add_cart_id = ($params['add-to-cart']);
        $_product = wc_get_product($add_cart_id);
        if ($_product->is_type('grouped')) {
            $product_inner_array = $params['quantity'];
            $product_cart_id = $params['add-to-cart'];
            foreach ($product_inner_array as $key => $value) {
                $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($key));
                $quantity = empty($value) ? 1 : wc_stock_amount($value);
                $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
                $product_status = get_post_status($product_id);
                if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity) && 'publish' === $product_status) {
                    do_action('woocommerce_ajax_added_to_cart', $product_id);
                    if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
                        wc_add_to_cart_message(array($product_id => $quantity), true);
                    }
                } else {
                    $data = array(
                        'error' => true,
                        'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
                    );
                    echo wp_send_json($data);
                }
            }
        } else {
            $product_id = apply_filters('ql_woocommerce_add_to_cart_product_id', absint($params['product_id']));
            $quantity = empty($params['quantity']) ? 1 : wc_stock_amount($params['quantity']);
            $variation_id = absint($params['variation_id']);
            $passed_validation = apply_filters('ql_woocommerce_add_to_cart_validation', true, $product_id, $quantity);
            $product_status = get_post_status($product_id);
            $variation = array();
            foreach ($params as $key => $value) {
                if (substr($key, 0, 10) == 'attribute_') {
                    $variation[$key] = $value;
                }
            }
            if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation, null) && 'publish' === $product_status) {
                do_action('ql_woocommerce_ajax_added_to_cart', $product_id);
                if ('yes' === get_option('ql_woocommerce_cart_redirect_after_add')) {
                    wc_add_to_cart_message(array($product_id => $quantity), true);

                }
                WC_AJAX:: get_refreshed_fragments();
            } else {
                $data = array(
                    'error' => true,
                    'product_url' => apply_filters('ql_woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
                echo wp_send_json($data);
            }
        }
        wp_die();
    }
}

add_action('woocommerce_add_to_cart_validation', function ($is_allow, $product_id, $quantity) {
    $product = get_post($product_id);
    $product_author = $product->post_author;
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $cart_product_id = $cart_item['product_id'];
        $cart_product = get_post($cart_product_id);
        $cart_product_author = $cart_product->post_author;
        if ($cart_product_author != $product_author) {
            $is_allow = false;
            break;
        }
    }
    if (!$is_allow) {
        wc_clear_notices();
        wc_add_notice(__("Well, you already have some item in your cart. First checkout with those and then purchase other items!", "foodota-framework"), 'error');
    }
    return $is_allow;
}, 50, 3);
add_action('wp_ajax_recipe_suggestions', 'recipe_suggestions_function');
add_action('wp_ajax_nopriv_recipe_suggestions', 'recipe_suggestions_function');
if (!function_exists('recipe_suggestions_function')) {
    function recipe_suggestions_function()
    {
        $return = array();
        $args = array(
            's' => isset($_GET['query']) && !empty($_GET['query']) ? $_GET['query'] : '',
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 25
        );
        $search_results = new WP_Query($args);
        if ($search_results->have_posts()) :
            while ($search_results->have_posts()) : $search_results->the_post();
                // shorten the title a little
                $title = $search_results->post->post_title;
                $return[] = foodota_clean_strings($title);
            endwhile;
            wp_reset_postdata();
        endif;
        echo json_encode($return);
        die;
    }
}
add_action('woocommerce_add_to_cart_validation', function ($is_allow, $product_id, $quantity) {
    global $woocommerce;
    $product = get_post($product_id);
    $product_author = $product->post_author;
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $cart_product_id = $cart_item['product_id'];
            $cart_product = get_post($cart_product_id);
            $cart_product_author = $cart_product->post_author;
            if ($cart_product_author != $product_author) {
                add_filter('woocommerce_cart_redirect_after_error', '__return_false');
                $is_allow = false;
                break;
            }
        }
    if (!$is_allow) {
        wc_clear_notices();
        wc_add_notice(__("Please Checkout or Delete items This Restaurant First!", "foodota-framework"), 'error');
    }
    return $is_allow;
}, 50, 3);
add_action('wp_ajax_cart_checker','cart_checker');
add_action('wp_ajax_nopriv_cart_checker','cart_checker');
if (!function_exists('cart_checker')) {
    function cart_checker()
    {
        //$product_ids = $_POST['product_id'];
        $store_ids = isset($_POST['store_id']) ? $_POST['store_id'] : '';
        $response='';
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $cart_product_id = isset($cart_item['product_id']) ? $cart_item['product_id'] : '';
            $cart_product = get_post($cart_product_id);
            $cart_product_author = $cart_product->post_author;
            if ((int)$store_ids != (int)$cart_product_author) {
                wp_send_json_success($response);
                exit();
            }elseif ((int)$store_ids == (int)$cart_product_author){
                wp_send_json_error($response);
                exit();
            }
        }
    }
}

add_action('wp_ajax_term_child_action','get_all_term');
add_action('wp_ajax_nopriv_term_child_action','get_all_term');
if(!function_exists('get_all_term')){
    function get_all_term(){
        $term_id = isset($_POST['term_ids']) ? $_POST['term_ids'] : '';
        $store_id = isset($_POST['store_ides']) ? $_POST['store_ides'] : '';
        $taxonomyName = "product_cat";
        $termchildren = get_terms( $taxonomyName, array( 'parent' => $term_id ) );
        $active_switch='';
        $child_button_html ='';
        $main_products='';
        $product_inner='';
        $children_class='';
        $read_more='';
        $cat_slider="cat_slider_".$term_id;
        $level=1;
        $count = 0;
        $ancestors = get_ancestors($term_id, $taxonomyName );
        $ancestors_level = is_array($ancestors)  ?  count($ancestors) +1 : "";
        $level_html = '<div class="heading-panel-custom sub_cat_level_'.$ancestors_level.'"><h6>' . esc_html__('Menu Level', 'foodota').'<i class="fa fa-long-arrow-alt-right"></i> '. $ancestors_level . '</h6><div class="bottom-dots  clearfix"><span class="dot line-dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span></div></div>';
        foreach ($termchildren as $child) {
            $countchildren = count (get_term_children( $term_id, $taxonomyName ));
            if ($child->term_id == $term_id ) {
                $active_switch="active";
            };
            $child_button_html .= '<div class="item"><a data-child-id="'.esc_attr($countchildren).'" data-term-id="' . $child->term_id . '" data-store-id="' .$store_id. '" data-level-id="' .$ancestors_level. '" data-bs-toggle="tab" href="' .$child->term_id. '" class="menu-tabs-list '.$active_switch.'  " style="margin-top:15px;">'.$child->name.'</a></div>';
            $count++;
        }
        if($child_button_html != "") {
            $div_total_button = $level_html . '<div class="' . $cat_slider . ' sub_cat_level_'.$ancestors_level.'   owl-carousel owl-theme">' . $child_button_html . '</div>';
        }
        $food_parent = foodota_get_selected_categories_posts($term_id, $store_id);
        $food_product   =    $food_parent['products'];
        foreach ($food_product as $food_child_more ) {
            $term_array=$food_parent['term'];
            if ($count_cat == 0) {
                $display_block="cats-disply-block";
            }
            if ($food_child_more['product_type'] === "variable" || $food_child_more['product_type'] === "grouped") {
                $variable_product_check = foodota_item_cart_model($food_child_more['post-id'], $store_id);
            } else {
                $variable_product_check = '<div class="innner-cart-div"><input type="number" class="myquantity product-quantity" step="1" min="1" max="500" name="quantity" value="1">
                     <button type="button" data-quantity="1" class="order-btn btn btn-theme cart-check-btn button product_type_simple add_to_cart_button ajax_add_to_cart product-quantity-btn openNav"
                                data-product_id="'.esc_html($food_child_more['post-id']).'" data-store_id="'.$store_id.'"
                            aria-label="'.esc_attr__('Add Product to your cart', 'foodota').'" rel="nofollow">'.esc_html__('Order Now', 'foodota').'</button></div>';
            }
            $product_images = wp_get_attachment_image_url($food_child_more['product-image-id'], 'thumbnail');
            if(strlen($food_child_more['prod-short-desc']) > 25 ){
                $read_more ='<span class="read_more ggg">'.esc_html__('  ...Read more','foodota').'</span>';
           }

            $product_inner.='<div class="res-fl-main-cat"><div class="res-fl-main-cat-content"><div class="res-fl-cat-img2">
            <img src="'.$product_images.'" alt="'.esc_attr(get_post_meta($food_child_more['product-image-id'], '_wp_attachment_image_alt', TRUE)).'" class="img-fluid"></div>
            <div class="res-fl-cat-2-count"><p>'.esc_html($food_child_more['title']).'</p><span class="short-des">'.foodota_limitted_character($food_child_more['prod-short-desc'], 25).$read_more.'</span><span class="long-des">'.foodota_limitted_character($food_child_more['prod-short-desc'], 600).'<span class="read_less">'.esc_html__('...Read less','foodota').'</span></span>
             <div class="foodota-product-price">'.foodota_return_output($food_child_more['product-html']).'</div></div></div><div class="res-fl-main-cat-content-3">
                                 '.$variable_product_check.'</div></div>';
        }
        $main_products='<div class="taber-inner"><div class="food-blocks menu-tabs-content '.$display_block.'" data-tab-content-id="'.$term_id.'"><div class="res-fl-main-cat-heading"><div class="heading-panel2"><h3>'.$term_array['term-name']."(".$term_array['product-count'].")".'</h3></div></div>'.$product_inner.'</div></div>';
        if ($main_products != '') {
            $response = array('childbuttom' => $div_total_button,'tabhtml' => $main_products,'childstatus' =>$child->term_id);
            wp_send_json_success($response);
            exit();
        }else{
            $response = array('not-found' => 'Not Child Category Found');
            wp_send_json_error($response);
            exit();
        }
    }
}
if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    add_filter('woocommerce_dropdown_variation_attribute_options_html', 'foodota_wc_replace_variation_attribute_options_html', 200, 2);
}
