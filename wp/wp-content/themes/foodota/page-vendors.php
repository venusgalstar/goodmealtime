<?php
/**
 * Template Name: All Vendors
 */
?>
<?php get_header(); ?>
<?php
//wp_enqueue_script("google-map");
$blog_banner = get_template_directory_uri() . '/libs/images/options/bread.png';
$b_banner = isset($foodota_options['blog_banner_1']['url']) ? $foodota_options['blog_banner_1']['url'] : $blog_banner;
$b_banner_ids = isset($foodota_options['blog_banner_1']['id']) ? $foodota_options['blog_banner_1']['id'] : '';
$search_city = isset($_GET['city']) ? strtolower($_GET['city']) : '';
$search_recipe = isset($_GET['recipe']) ? $_GET['recipe'] : '';
$cat_ids = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';
if ($search_city == 'al' || $search_city == 'AL') {
    $search_city = "";
}
$restaurant_html = '';
$pagination_html = '';
$total_res = '';
$total_pages = '';
$number = '';
$found_restaurants = 0;
if ($search_city != '' && $search_recipe == '') {
    $search_data = array();
    if ($search_city) {
        $search_data['wcfmmp_store_city'] = $search_city;
    }
    $food_pagination = (isset($foodota_options['number-of-restaurants']) ? $foodota_options['number-of-restaurants'] : '');
    $number = $food_pagination; //max display per page
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //current number of page
    $offset = ($paged - 1) * $number; //page offset
    global $WCFMmp;
    $mystores = $WCFMmp->wcfmmp_vendor->wcfmmp_search_vendor_list(true, 0, 100, '', '', $search_data);
    $founders = count($mystores);
    $args = array(
        'offset' => $offset,
        'number' => $number,
        'role' => 'wcfm_vendor',
        'meta_query' => array(
            array(
                'key' => '_wcfm_city',
                'value' => $search_city,
                'compare' => '='
            ),
        )
    );
    $user_query = new WP_User_Query($args);
    $stores = $user_query->get_results();
    $found_restaurants = $founders;
    $total_users = $found_restaurants;
    $total_pages = ($total_users / $number); // get the total pages by dividing the total users to the maximum numbers of user to be displayed //Check if the total pages has a decimal we will add + 1 page
    $total_pages = is_float($total_pages) ? intval($total_users / $number) + 1 : intval($total_users / $number);
    if (!empty($stores)) {
        foreach ($stores as $store) {
            $restaurant_html .= '<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-12">'
                . foodota_all_restaurant_function($store->ID, 'grid-view') . '</div>';
        }
        wp_reset_postdata();
    }
} else if ($search_recipe != '' && $search_city == '') {
    $food_pagination = (isset($foodota_options['number-of-restaurants']) ? $foodota_options['number-of-restaurants'] : '');
    $number = $food_pagination; //max display per page
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //current number of page
    $offset = ($paged - 1) * $number; //page offset
    $postArg = array(
        'offset' => $offset,
        'posts_per_page' => $number,
        'title' => $search_recipe,
        'post_type' => 'product',
        'order' => 'desc',
    );
    $query_recipe = new WP_Query($postArg);
    $found_restaurants = $query_recipe->found_posts;
    $total_users = $found_restaurants;//count total users
    $total_pages = ($total_users / $number); // get the total pages by dividing the total users to the maximum numbers of user to be displayed //Check if the total pages has a decimal we will add + 1 page
    $total_pages = is_float($total_pages) ? intval($total_users / $number) + 1 : intval($total_users / $number);
    if ($query_recipe->have_posts()) {
        while ($query_recipe->have_posts()) {
            $query_recipe->the_post();
            $post_id = get_the_ID();
            $author_id = get_post_field('post_author', $post_id);
            $restaurant_html .= '<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-12">'
                . foodota_all_restaurant_function($author_id, 'grid-view') . '</div>';
        }
        wp_reset_postdata();
    }
} else if ($search_recipe != '' && $search_city != '') {
    $search_data = array();
    if ($search_city) {
        $search_data['wcfmmp_store_city'] = $search_city;
    }
    $food_pagination = (isset($foodota_options['number-of-restaurants']) ? $foodota_options['number-of-restaurants'] : '');
    $number = $food_pagination; //max display per page
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //current number of page
    $offset = ($paged - 1) * $number; //page offset
    $args = array(
        'role' => 'wcfm_vendor',
        'posts_per_page' => -1,
        'fields' => 'ids',
        'meta_query' => array(
            array(
                'key' => '_wcfm_city',
                'value' => $search_city,
                'compare' => '=',
            ),
        )
    );
    //$args->ID
    $user_query = new WP_User_Query($args);
    $stores = $user_query->get_results();
    $postArg = array(
        'offset' => $offset,
        'posts_per_page' => $number,
        's' => $search_recipe,
        'post_type' => 'product',
        'order' => 'desc',
        'author__in' => $stores
    );
    $query_combine = new WP_Query($postArg);
    $found_restaurants = $query_combine->found_posts;
    $total_users = $found_restaurants;//count total users
    $total_pages = ($total_users / $number); // get the total pages by dividing the total users to the maximum numbers of user to be displayed //Check if the total pages has a decimal we will add + 1 page
    $total_pages = is_float($total_pages) ? intval($total_users / $number) + 1 : intval($total_users / $number);
    if ($query_combine->have_posts()) {
        while ($query_combine->have_posts()) {
            $query_combine->the_post();
            $post_id = get_the_ID();
            $author_id = get_post_field('post_author', $post_id);
            $city_meta = get_user_meta($author_id, 'wcfmmp_profile_settings', true);
            $city_name = isset($city_meta['address']['city']) ? strtolower($city_meta['address']['city']) : "";
            if ($city_name == $search_city) {
                $restaurant_html .= '<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-12">
				'. foodota_all_restaurant_function($author_id, 'grid-view') . '</div>';
            }
        }
    }
    wp_reset_postdata();
} else if ($cat_ids != '') {
    $food_pagination = (isset($foodota_options['number-of-restaurants']) ? $foodota_options['number-of-restaurants'] : '');
    $number = $food_pagination; //max display per page
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //current number of page
    $offset = ($paged - 1) * $number; //page offset
    function filter_authors($groupby)
    {
        global $wpdb;
        $groupby = " {$wpdb->posts}.post_author";
        return $groupby;
    }
    add_filter('posts_groupby', 'filter_authors');
    $args = array(
        'offset' => $offset,
        'posts_per_page' => $number,
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'product_cat',
                'terms' => $cat_ids
            )
        ),
        'post_type' => 'product',
        'orderby' => 'title,'
    );
    $products = new WP_Query($args);
    $found_restaurants = $products->found_posts;
    $total_users = $found_restaurants;//count total users
    $total_pages = ($total_users / $number); // get the total pages by dividing the total users to the maximum numbers of user to be displayed //Check if the total pages has a decimal we will add + 1 page
    $total_pages = is_float($total_pages) ? intval($total_users / $number) + 1 : intval($total_users / $number);
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
        wp_reset_postdata();

        $found_restaurants=count($store_ids);

        foreach ($store_ids as $store_id) {
            $restaurant_html .= '<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-12">' . foodota_all_restaurant_function($store_id, 'grid-view') . '</div>';
        }
    } else {
        echo esc_html__("No Record Found",'foodota');
    }
} else {
    $food_pagination = (isset($foodota_options['number-of-restaurants']) ? $foodota_options['number-of-restaurants'] : '');
    $number = $food_pagination; //max display per page
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //current number of page
    $offset = ($paged - 1) * $number; //page offset
    $users = get_users(array('role' => 'wcfm_vendor')); //get all the lists of users
    $args = array(
        'offset' => $offset,
        'number' => $number,
        'role' => 'wcfm_vendor',
        'fields' => array('ID', 'user_login', 'user_email'),

    );

    $found_restaurants = count($users);
    $query = get_users($args);//query the maximum users that we will be displaying
    $total_users = count($users);//count total users
    $total_query = count($query);//count the maximum displayed users
    $total_pages = ($total_users / $number); // get the total pages by dividing the total users to the maximum numbers of user to be displayed //Check if the total pages has a decimal we will add + 1 page
    $total_pages = is_float($total_pages) ? intval($total_users / $number) + 1 : intval($total_users / $number);
    if (is_array($query)) {
        foreach ($query as $agent_data) {
            $restaurant_html .= '<div class="eq-height col-xxl-4 col-xl-6 col-lg-12 col-md-12">'
                . foodota_all_restaurant_function($agent_data->ID, 'grid-view') . '</div>';
        }
        wp_reset_postdata();
    }
}
?>
<?php
global $foodota_options;
$total_restaurants = get_users('role=wcfm_vendor');
$total_res = count($total_restaurants);
$image_alt_id = '';
$allowed_html = foodota_allowed_html_tags();
?><section class="bg-color res-container-inline">
    <div class="res-sidebar-container">
        <div class="res-sidebar food_cat_filter">
            <?php
            if (is_dynamic_sidebar('rest_search')) {
                dynamic_sidebar('rest_search');
            }
            ?>
        </div>
    </div>
    <div class="res-main-panel section-padding" id="result">
        <div class="">
            <div class="row">
                <div class="col-xl-12 col-sm-12 col-md-12">
                    <div class="res-theme-banner">
                        <img src="<?php echo esc_url($b_banner); ?>"
                             alt="<?php echo esc_attr(get_post_meta($b_banner_ids, '_wp_attachment_image_alt', TRUE)); ?>"
                             class="img-fluid">
                    </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-lg-12 col-xs-12">
                    <div class="heading-panel-simple">
                        <h3>
                            <span id="number-res"><?php echo esc_html($found_restaurants); ?></span><?php echo esc_html__('  + Restaurants', 'foodota'); ?>
                        </h3>
                        <div class="bottom-dots  clearfix">
                            <span class="dot line-dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-lg-12 col-xs-12">
                    <div class="row" id="restaurant-container">
                        <?php
						echo wp_kses($restaurant_html,$allowed_html);
                        foodota_pagination($total_pages, $number);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
<?php get_footer(); ?>