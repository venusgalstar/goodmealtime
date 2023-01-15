<?php
// Submit Form Fields
if (!function_exists('foodota_breadcrumb')) {
    function foodota_breadcrumb()
    {
        $page_plugin_url='';
        if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins'))) && in_array('wc-frontend-manager/wc_frontend_manager.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            global $WCFM, $WCFMmp;
            $wcfm_store_url = wcfm_get_option('wcfm_store_url', 'store');
            $wcfm_store_name = apply_filters('wcfmmp_store_query_var', get_query_var($wcfm_store_url));
            $page_plugin_url=is_wcfm_page();
        }
        if (isset($wcfm_store_url) && $wcfm_store_url != "" && $wcfm_store_name != "" || $page_plugin_url==true) {
        } else {
            ?>
            <?php
            $current_template = basename(get_page_template());
            $current_post_singular = is_singular('restaurants');

            $bread_none='';
            if(get_post_meta( get_the_ID(), 'show_page_bread', true )!="" && get_post_meta( get_the_ID(), 'show_page_bread', true )=="1") {
                $bread_none = 'no-bread-crumb';
            }


            if ($current_template != "page-dashboard.php" && $current_post_singular != 1) {
                ?>
                <section class="res-srch-hero res-srch-hero-x txt no-defualt-bg <?php echo esc_attr($bread_none); ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                <div class="res-blog-grid">
                                    <h2><?php echo foodota_breadcrumb_function(); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            }
        }
    }
}
// Breadcrumb
if (!function_exists('foodota_breadcrumb_function')) {
    function foodota_breadcrumb_function()
    {
        $string = '';
        if (is_category()) {
            $string = esc_html__('Category', 'foodota');
        } else if (is_singular('property')) {
            $string = esc_html__('Listing Details', 'foodota');
        } else if (is_single()) {
            $string = esc_html__('Blog Details', 'foodota');
        } elseif (is_page()) {
            $string = esc_html(get_the_title());
        } elseif (is_tag()) {
            $string = esc_html(single_tag_title("", false));
        } elseif (is_search()) {
            $string = esc_html(get_search_query());
        } elseif (is_404()) {
            $string = esc_html__('404', 'foodota');
        } elseif (is_author()) {
            $string .= esc_html__('Author', 'foodota');
        } else if (is_tax()) {
            $string = esc_html(single_cat_title("", false));
        } elseif (is_archive()) {
            $string = esc_html__('Archive', 'foodota');
        } else if (is_home()) {
            $string = esc_html__('Latest News & Trends', 'foodota');
        }
        if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            if (is_singular('product')) {
                $string = esc_html__('Product Details', 'foodota');
            } else if (is_cart()) {
                $string = esc_html__('Cart', 'foodota');
            } 
			else if ( is_checkout() && !empty( is_wc_endpoint_url('order-received') ) ) {
                $string = esc_html__('Thank You', 'foodota');
            }
			else if (is_checkout()) {
                $string = esc_html__('Checkout', 'foodota');
            } 
			else if (is_product_category()) {
                $string = esc_html(single_cat_title("", false));
            } elseif (is_product_tag()) {
                $string = esc_html(single_tag_title("", false));
            } else if (is_shop()) {
                $string = esc_html__('Shop', 'foodota');
            }
        }
        return $string;
    }
}
if (!function_exists('foodota_pagination')) {
    function foodota_pagination($pages = '', $range = 2)
    {
        global $localization;
        $localization = foodota_localization();
        if (is_singular())
            $showitems = '';
        $showitems = ($range * 2) + 1;
        global $paged;
        if (empty($paged))
            $paged = 1;
        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if (!$pages)
                $pages = 1;
        }
        if (1 != $pages) {
            echo '<div class="row">
        	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 margin-bottom-30">
			<nav><ul class="pagination justify-content-start">
			<li class="page-item disabled hidden-md-down d-none d-lg-block"><span class="page-link">' . $localization['page'] . ' ' . esc_html($paged) . ' ' . $localization['off'] . ' ' . esc_html($pages) . '</span></li>';
            if (get_previous_posts_link()) {
                get_previous_posts_link();
            }
            for ($i = 1; $i <= $pages; $i++) {
                if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                    echo esc_html(($paged == $i)) ? '<li class="page-item active"><span class="page-link"><span class="sr-only"> ' . esc_html($localization['page']) . ' </span>' . esc_html($i) . '</span></li>' : '<li class="page-item"><a class="page-link" href="' . esc_url(get_pagenum_link($i)) . '"><span class="sr-only">' . esc_html($localization['page']) . ' </span>' . esc_html($i) . '</a></li>';
                }
            }
            echo '</ul></nav>
			</div>
        </div>';
        }
    }
}
// Pagination
if (!function_exists('foodota_pagination2')) {

    function foodota_pagination2($pages = '', $range = 2)
    {
        global $localization;
        $mypages='';
        $localization = foodota_localization();
        if (is_singular())
            $showitems = '';
        $showitems = ($range * 2) + 1;
        global $paged;
        if (empty($paged))
            $paged = 1;
        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if (!$pages)
                $pages = 1;
        }
        $abc=$datas='';
        if (get_previous_posts_link()) {
            $abc=get_previous_posts_link();
        }
        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                $datas= esc_html(($paged == $i)) ? '<li class="page-item active"><span class="page-link"><span class="sr-only"> ' . esc_html($localization['page']) . ' </span>' . esc_html($i) . '</span></li>' : '<li class="page-item"><a class="page-link" href="' . esc_url(get_pagenum_link($i)) . '"><span class="sr-only">' . esc_html($localization['page']) . ' </span>' . esc_html($i) . '</a></li>';
            }
        }
        if (1 != $pages) {
            $mypages.='<div class="row">
        	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 margin-bottom-30">
			<nav><ul class="pagination justify-content-start">
			<li class="page-item disabled hidden-md-down d-none d-lg-block"><span class="page-link">' . $localization['page'] . ' ' . esc_html($paged) . ' ' . $localization['off'] . ' ' . esc_html($paged) . '</span></li>'.esc_html($abc).esc_html($datas).'
             </ul></nav>
			</div>
        </div>';
        }
        return $mypages;
    }
}
//Blog Post categories
if (!function_exists('foodota_blog_categories')) {
    function foodota_blog_categories($post_id = '')
    {
        $post_categories = wp_get_post_categories($post_id);
        $cats = array();
        foreach ($post_categories as $c) {
            $cat = get_category($c);
            $cats[] = array('name' => $cat->name, 'slug' => $cat->slug, 'cat_link' => get_category_link($cat->term_taxonomy_id));
        }
        return $cats;
    }
}
// Redirect safe URL
if (!function_exists('foodota_redirect_url')) {
    function foodota_redirect_url($url)
    {
        return '<script>window.location = "' . esc_url($url) . '";</script>';
    }
}
if (!function_exists('foodota_blogfeatured_img')) {
    function foodota_blogfeatured_img($post_id, $image_size)
    {
        return wp_get_attachment_image_src(get_post_thumbnail_id(esc_html($post_id)), $image_size);
    }
}
// get feature image
if (!function_exists('foodota_blogcomments_count')) {
    function foodota_blogcomments_count($post_id = '')
    {
        $num_comments = '';
        if (comments_open($post_id)) {
            $num_comments = get_comments_number($post_id);
            if ($num_comments == 0) {
                $comments = esc_html__('No Comments', 'foodota');
            } elseif ($num_comments > 1) {
                $comments = $num_comments . esc_html__(' Comments', 'foodota');
            } else {
                $comments = esc_html__('1 Comment', 'foodota');
            }
            return $comments;
        }
    }

}
add_filter('get_search_form', 'foodota_blog_search_form');
if (!function_exists('foodota_blog_search_form')) {
    function foodota_blog_search_form($text)
    {
        $text = str_replace('<label>', '<div class="realestate-search-blog"><div class="input-group stylish-input-group">', $text);
        $text = str_replace('</label>', '<span class="input-group-append"><button class="blog-search-btn" type="submit">  <i class="fa fa-search"></i> </button></span></div></div>', $text);
        $text = str_replace('<span class="screen-reader-text">' . esc_html__('Search for:', 'foodota') . '</span>', '', $text);
        $text = str_replace('class="search-field"', 'class="form-control"', $text);
        return $text;
    }
}
if (!function_exists('foodota_make_link')) {
    function foodota_make_link($url, $text)
    {
      return ('<a href="'.esc_url($url).'" target="_blank">'.foodota_required_tags().$text.'</a>'.'foodota_required_tags()');
    }
}
if (!function_exists('foodota_timeago')) {
    function foodota_timeago($comment_id = 0)
    {
        return sprintf(
            _x('%s ago', 'Human-readable time', 'foodota'), human_time_diff(
                get_comment_date('U', $comment_id), current_time('timestamp')
            )
        );
    }
}
// get user registration date.
if (!function_exists('foodota_user_timeago')) {
    function foodota_user_timeago($post_author_id)
    {
        return sprintf(
            _x('%s', 'Human-readable time', 'foodota'), human_time_diff(
                strtotime(get_userdata($post_author_id)->user_registered), current_time('timestamp')
            )
        );
    }
}
if (!function_exists('foodota_title_limit')) {
    function foodota_title_limit($length = 30, $title_id = '')
    {
        $string = '';
        $mytitle = get_the_title($title_id);
        $contents = strip_tags(html_entity_decode($mytitle, ENT_QUOTES, "UTF-8"));
        $removeSpaces = str_replace(" ", "", $contents);
        $contents = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $contents);
        if (strlen($removeSpaces) > $length) {
            return mb_substr(str_replace("&nbsp;", "", $contents), 0, $length) . '...';
        } else {
            return str_replace("&nbsp;", "", $contents);
        }
    }
}
if (!function_exists('foodota_pagination_search')) {
    function foodota_pagination_search($wp_query, $page = 0)
    {
        if ($wp_query->found_posts > 1) {
            $limit = $total_pages = '';
            $limit = get_option('posts_per_page');
            $total_pages = $wp_query->found_posts;
            $stages = 3;
            $page = $page;
            if ($page) {
                $start = ($page - 1) * $limit;
            } else {
                $start = 0;
            }
            if ($page == 0) {
                $page = 1;
            }
            $prev = $page - 1;
            $next = $page + 1;
            $lastpage = ceil($total_pages / $limit);
            $LastPagem1 = $lastpage - 1;
            $paginate = '';
            if ($lastpage > 1) {
                $paginate .= ' <ul class="pagination justify-content-start">';
                // Previous
                if ($page > 1) {
                    $paginate .= '<li class="page-item fetch_result" data-page-no="' . esc_attr($prev) . '"><a class="page-link" href="javascript:void(0)">' . esc_html__('Previous', 'foodota') . '</a></li>';
                } else {

                    $paginate .= '<li class="page-item disabled"><a href="javascript:void(0)" class="page-link" aria-label="' . esc_attr__('Previous', 'foodota') . '"><span aria-hidden="true">' . esc_html__('Previous', 'foodota') . '</span></a></li>';
                }
                if ($lastpage < 7 + ($stages * 2)) { // Not enough pages to breaking it up
                    for ($counter = 1; $counter <= $lastpage; $counter++) {
                        if ($counter == $page) {
                            $paginate .= '<li class="page-item fetch_result active" data-page-no=' .esc_attr($counter). '><a href="javascript:void(0)" class="page-link">' . esc_html($counter) . '</a></li>';
                        } else {
                            $paginate .= '<li class="page-item fetch_result" data-page-no=' .esc_attr($counter). '><a href="javascript:void(0)" class="page-link">' . esc_html($counter) . '</a></li>';
                        }
                    }
                } elseif ($lastpage > 5 + ($stages * 2)) { // Enough pages to hide a few?
                    // Beginning only hide later pages
                    if ($page < 1 + ($stages * 2)) {
                        for ($counter = 1; $counter < 4 + ($stages * 2); $counter++) {
                            if ($counter == $page) {
                                $paginate .= '<li class="page-item fetch_result active" data-page-no=' .esc_attr($counter). '><a href="javascript:void(0)" class="page-link">' .esc_html($counter). '</a></li>';
                            } else {
                                $paginate .= '<li class="page-item fetch_result" data-page-no=' .esc_attr($counter). '><a href="javascript:void(0)" class="page-link">' .esc_html($counter). '</a></li>';
                            }
                        }
                        $paginate .= '<li class="page-item disabled"><a href="javascript:void(0)" class="page-link">...</a></li>';
                        $paginate .= '<li class="page-item fetch_result" data-page-no=' . esc_attr($LastPagem1) . '><a href="javascript:void(0)" class="page-link">' . esc_html($LastPagem1). '</a></li>';
                        $paginate .= '<li class="page-item fetch_result" data-page-no=' . esc_attr($lastpage ). '><a href="javascript:void(0)" class="page-link">' . esc_html($lastpage) . '</a></li>';
                    } // Middle hide some front and some back
                    elseif ($lastpage - ($stages * 2) > $page && $page > ($stages * 2)) {
                        $paginate .= '<li class="page-item fetch_result" data-page-no="1"><a href="javascript:void(0)" class="page-link">1</a></li>';
                        $paginate .= '<li class="page-item fetch_result" data-page-no="2"><a href="javascript:void(0)" class="page-link">2</a></li>';
                        $paginate .= '<li class="page-item disabled"><a href="javascript:void(0)" class="page-link">...</a></li>';
                        for ($counter = $page - $stages; $counter <= $page + $stages; $counter++) {
                            if ($counter == $page) {
                                $paginate .= '<li class="page-item fetch_result active" data-page-no=' . esc_attr($counter) . '><a href="javascript:void(0)" class="page-link">' . esc_html($counter) . '</a></li>';
                            } else {
                                $paginate .= '<li class="page-item fetch_result" data-page-no=' . esc_attr($counter) . '><a href="javascript:void(0)" class="page-link">' . esc_html($counter) . '</a></li>';
                            }
                        }
                        $paginate .= '<li class="page-item disabled"><a href="javascript:void(0)" class="page-link">...</a></li>';
                        $paginate .= '<li class="page-item fetch_result" data-page-no=' . esc_attr($LastPagem1). '><a href="javascript:void(0)" class="page-link">' . esc_html($LastPagem1) . '</a></li>';
                        $paginate .= '<li class="page-item fetch_result" data-page-no=' . esc_attr($lastpage ) . '><a href="javascript:void(0)" class="page-link">' .esc_html($lastpage). '</a></li>';
                    }
                    else {
                        $paginate .= '<li class="page-item fetch_result" data-page-no="1"><a href="javascript:void(0)" class="page-link">1</a></li>';
                        $paginate .= '<li class="page-item fetch_result" data-page-no="2"><a href="javascript:void(0)" class="page-link">2</a></li>';
                        $paginate .= '<li class="page-item disabled"><a href="javascript:void(0)" class="page-link">...</a></li>';
                        for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++) {
                            if ($counter == $page) {
                                $paginate .= '<li class="page-item fetch_result active" data-page-no=' . esc_attr($counter) . '><a class="page-link">' . esc_html($counter). '</a></li>';
                            } else {
                                $paginate .= '<li class="page-item fetch_result" data-page-no=' . esc_attr($counter) . '><a class="page-link">' . esc_html($counter). '</a></li>';
                            }
                        }
                    }
                }
                if ($page < $counter - 1) {
                    $paginate .= '<li class="page-item fetch_result" data-page-no="' . esc_attr($next) . '"><a href="javascript:void(0)" class="page-link" aria-label="' . esc_html__('Next', 'foodota') . '"><span aria-hidden="true">' . esc_html__('Next', 'foodota') . ' </span></a></li>';
                } else {
                    $paginate .= '<li class="page-item disabled"><a href="javascript:void(0)" class="page-link" aria-label="' . esc_html__('Next', 'foodota') . '"><span aria-hidden="true">' . esc_html__('Next', 'foodota') . '</span></a></li>';
                }
                $paginate .= "</ul>";
            }
            return $paginate;
        }
    }
}
if (!function_exists('foodota_no_result_found')) {
    function foodota_no_result_found()
    {
        $image_alt_id = '';
        $img_link = trailingslashit(get_template_directory_uri()) . "libs/images/nothing-found.png";
        return '<img src="' . esc_url($img_link) . '" alt="' . esc_attr(get_post_meta($image_alt_id, '_wp_attachment_image_alt', TRUE)) . '" class="img-fluid">';
    }
}
if (!function_exists('foodota_custom_comments')) {
    function foodota_custom_comments($comment, $args, $depth)
    {
        $alt = $default = $comment_id = '';
        $GLOBALS['comment' ] = $comment;
        switch ( $comment->comment_type ) :
            case 'trackback' :
                ?>
                <div class="post pingback">
                    <p><?php esc_html__( 'Pingback:', 'foodota' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'foodota' ), ' ' ); ?></p>
                </div>
                <?php
                break;
            default :
                ?>
                <?php
                if ( $depth > 1 ) {
                    echo '<div class="ml-5">';
                }
                ?>
                <div class="real-comms"  id="li-comment-<?php comment_ID(); ?>">
                    <div class="comment-user">
                        <div class="comm-avatar">
                            <?php
                            if($comment->user_id)
                            {
                                echo get_avatar( $comment, null, $default, $alt, array( 'class' => array( 'd-flex','mx-auto' ) ) );
                            }
                            else
                            {
                                if(empty(get_avatar( $comment, 100 )))
                                {
                                    $space_removal = 'left-sp-removal';
                                }
                                else
                                {
                                    $space_removal = '';
                                    echo get_avatar( $comment, 100 );
                                }
                            }
                            ?>
                        </div>
                        <span class="user-details <?php echo esc_attr($space_removal); ?>"><span class="username"><?php echo get_comment_author_link(); ?> </span>
                            <span><?php echo esc_html__( 'on ', 'foodota' ); ?> </span>
                            <span><?php printf( esc_html( '%1$s', 'foodota' ), get_comment_date(), get_comment_time() );?></span>
                            <span>
                            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ], 'add_below' => 'li-comment', 'reply_text' => '<i class="fa fa-reply"></i>' ) ), $comment_id ); ?>
                            </span>
                    </div>
                    <div class="comment-text">
                        <?php echo comment_text(); ?>
                    </div>
                </div>
                <?php
                if ( $depth > 1 ) {
                    echo '</div>';
                }
                ?>
                <?php
                break;
        endswitch;
        ?>
        <?php
    }
}

if (!function_exists('foodota_params')) {
    function foodota_params($param)
    {
        if (!empty($param)) {
            return $param;
        }
    }
}

if (!function_exists('food_verify_nonce')) {
    function food_verify_nonce($nonce, $key)
    {
        if (!wp_verify_nonce($nonce, $key)) {
            $return = array('message' => esc_html__('Direct access not allowed', 'foodota'));
            wp_send_json_error($return);
        }
    }
}
if (!function_exists('foodota_get_attch_url')) {
    function foodota_get_attch_url($attach_id = "", $size = '')
    {
        $arr = wp_get_attachment_image_src($attach_id, $size);
        $def = "";
        if (isset($arr[0])) {
            return $arr[0];
        } else {
            return $def;
        }
    }
}
if (!function_exists('foodota_count_ids')) {
    function foodota_count_ids($cat_ids = "")
    {
        $myer = wp_get_postcount($cat_ids);
        echo esc_html($myer);
        if (isset($count)) {
            return $count;
        } else {
            return $count = 0;
        }
    }
}
if (!function_exists('foodota_all_restaurant_function')) {
    function foodota_all_restaurant_function($store_id = '', $view_style = '')
    {
        if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins'))) && in_array('wc-frontend-manager/wc_frontend_manager.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            if ($store_id != '') {
                $store_user = wcfmmp_get_store($store_id);
                $store_info = $store_user->get_shop_info();
                $store_user = wcfmmp_get_store($store_id);
                $store = json_encode($store_info);
                $banner_type = $store_user->get_list_banner_type();
                if ($banner_type == 'video') {
                    $banner_video = $store_user->get_list_banner_video();
                } else {
                    $banner = $store_user->get_list_banner();
                    if (!$banner) {
                        $banner = trailingslashit(get_template_directory_uri()) . "libs/images/banner_place.png";
                    }
                }
                $store_address = $store_user->get_address_string();
                $store_description = $store_user->get_shop_description();
                $location_icon = trailingslashit(get_template_directory_uri()) . "libs/images/map.png";
                $store_url = $store_user->get_shop_url();
                $store_name = $store_user->get_shop_name();
                $store_info = $store_user->get_shop_info();
                $gravatar = $store_user->get_avatar();
                $image_alt_id = '';
                $gravatar_id = $store_info['gravatar'];
                $banner_id = $store_info['banner'];
                $data = foodota_get_selected_categories($store_id);
                $rating = $store_user->get_avg_review_rating();
                $store_time = apply_filters('foodota_store_list_after_store_info', $store_id, $store_info);
                $banner = foodota_get_attch_url($banner_id, 'full');
                $gravatar = foodota_get_attch_url($gravatar_id, 'foodota-store-logo');
                $wcfmmp_shipping = get_user_meta( $store_id, '_wcfmmp_shipping', true );
                $foodota_category = '';
                $foodota_category_list = '';
                $foodota_stars = '';
                $shipment_status='';
                if (!$gravatar) {
                    $gravatar = trailingslashit(get_template_directory_uri()) . "libs/images/logo_palce.png";
                }
                foreach ($data as $food_names) {
                    $foodota_category .= '<a href="' . esc_url($store_url) . '" class="badge bg-light" title="' . esc_attr($food_names['term-name']) . '">' . esc_html($food_names['term-name']) . '</a>';
                }
                foreach ($data as $food_names) {
                    $foodota_category_list .= '<li><a href="' . esc_url($store_url) . '" class="badge bg-light" title="' . esc_attr($food_names['term-name']) . '">' . esc_html($food_names['term-name']) . '</a></li>';
                }
                for ($i = 1; $i < 6; $i++) {
                    $star_staus = '';
                    if ($rating >= $i) {
                        $star_staus = "starts-on";
                    }
                    $foodota_stars .= '<i class="fa fa-star ' . esc_attr($star_staus) . '"></i>';
                }
                if(isset($wcfmmp_shipping['_wcfmmp_user_shipping_enable']) && $wcfmmp_shipping['_wcfmmp_user_shipping_enable']=='yes' ) {
                    $shipment_status = '<i class="fas fa-shipping-fast active"></i>';
                }else{
                    $shipment_status = '<i class="fas fa-shipping-fast"></i>';
                }


                if ($view_style == 'grid-view') {
                    return '<div class="res-3-box ">
        <div class="res-2-img parallex-new"><a href="' . esc_url($store_url) . '">
                <img src="' . esc_url($banner) . '" alt="' . esc_attr(get_post_meta($banner_id, '_wp_attachment_image_alt', TRUE)) . '" class="img-fluid"> </a>
            <div class="res-3-icons fav-check">'.$shipment_status.'</div>
            <div class="new-stars-main"><div class="stars">' .$foodota_stars. '</div> <div class="rating-number">' . $rating . '</div> </div>        
           </div>
        <div class="res-2-bg-white">
            <div class="res-2-inner"><div class="res-2-text">
                    <a href="' . esc_url($store_url) . '"><div class="text-s1">' . esc_html($store_name) . '</div></a>
                    <div class="food_cats"><span class="cat_names">' .$foodota_category . '</span></div>
                </div>
                </div>
            <div class="res-2-box">
                <ul>
                    <li>
                     <div class="res-3-logo-img-container">
                     <a href="' . esc_url($store_url) . '">
                     <img src="' . esc_url($gravatar) . '" alt="' . esc_attr(get_post_meta($gravatar_id, '_wp_attachment_image_alt', TRUE)) . '" class="img-fluid"></a></div>
                        <p> ' .$store_time. '</p>
                        <div class="res-2-map-product"><span class="location-png">
                       <img src="' . esc_url($location_icon) . '" alt="' . esc_attr(get_post_meta($image_alt_id, '_wp_attachment_image_alt', TRUE)) . '" class="img-fluid"></span>
                        <span>' . foodota_limitted_character($store_address, 26) . '</span></div>
                        
                    </li>
                </ul></div></div></div>';
                }
                if ($view_style == 'list-view') {
                    return ' <div class="res-featured-box">
          <div class="res-featured-img"> <img src="' . esc_url($banner) . '" alt="' . esc_attr(get_post_meta($banner_id, '_wp_attachment_image_alt', TRUE)) . '" class="img-fluid">
          </div>
          <div class="res-featured-details">
            <div class="res-top-content">
              <div class="res-featured-box-2">' .$foodota_stars . ' <span>' .$rating . '</span> 
              <a href="' . esc_url($store_url) . '">
                <div class="h-style">' . esc_html($store_name) . '</div>
                </a> </div>
              <div class="res-fetured-text2">
                <p><img src="' . esc_url($location_icon) . '" alt="' . esc_attr(get_post_meta($image_alt_id, '_wp_attachment_image_alt', TRUE)) . '" class="img-fluid">' . foodota_limitted_character($store_address, 30) . '</p>
              </div>
              <div class="res-fetured-product res-3-icons fav-check">'.$shipment_status.'</div>
            </div>
            <div class="res-f-detsil">
              <ul>
                <li>
                  <p>' . $store_time. '</p>
                </li>
                <li></li>
              </ul>
              <div class="logo-res"> <a href="' . esc_url($store_url) . '"><img src="" alt="' . esc_attr(get_post_meta($gravatar_id, '_wp_attachment_image_alt', TRUE)) . '" class="img-fluid"></a> </div>
            </div>
          </div>
        </div>';
                }
            }
        }
    }
}
//esc_url($gravatar)
if (!function_exists('foodota_samll_view_restaurant')) {
    function foodota_samll_view_restaurant($store_id = '', $restaurant_view = '')
    {
        if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins'))) && in_array('wc-frontend-manager/wc_frontend_manager.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            if ($store_id != '') {
                $store_user = wcfmmp_get_store($store_id);
                $store_info = $store_user->get_shop_info();
                $store_user = wcfmmp_get_store($store_id);
                $rating = $store_user->get_avg_review_rating();
                $restaurant_fav = get_user_meta(get_current_user_id(), 'restaurant_favorite' . $store_id, true);
                $store = json_encode($store_info);
                $banner_type = $store_user->get_list_banner_type();
                if ($banner_type == 'video') {
                    $banner_video = $store_user->get_list_banner_video();
                } else {
                    $banner = $store_user->get_list_banner();
                    if (!$banner) {
                        $banner = trailingslashit(get_template_directory_uri()) . "libs/images/banner_place.png";
                    }
                }
                $store_address = $store_user->get_address_string();
                $store_description = $store_user->get_shop_description();
                $location_icon = trailingslashit(get_template_directory_uri()) . "libs/images/map.png";
                $store_url = $store_user->get_shop_url();
                $store_name = $store_user->get_shop_name();
                $store_info = $store_user->get_shop_info();
                $gravatar = $store_user->get_avatar();
                $image_alt_id = '';
                $gravatar_id = $store_info['gravatar'];
                $banner_id = $store_info['banner'];
                $data = foodota_get_selected_categories($store_id);
                $rating = $store_user->get_avg_review_rating();
                $store_time = apply_filters('foodota_store_list_after_store_info', $store_id, $store_info);
                $banner = foodota_get_attch_url($banner_id, 'full');
                $gravatar = foodota_get_attch_url($gravatar_id, 'full');
                $foodota_category = '';
                $foodota_stars = '';
                $food_fav = '';
                $hover_html = '';
                if (!$gravatar) {
                    $gravatar = trailingslashit(get_template_directory_uri()) . "libs/images/logo_palce.png";
                }
                if ($restaurant_fav == $store_id) {
                    $food_fav = "favorite";
                }
                foreach ($data as $food_names) {
                    $foodota_category .= '<a href="' . esc_url($store_url) . '" class="badge bg-light" title="' . esc_attr($food_names['term-name']) . '">' . esc_html($food_names['term-name']) . '</a>';
                }
                for ($i = 1; $i < 6; $i++) {
                    $star_staus = '';
                    if ($rating >= $i) {
                        $star_staus = "starts-on";
                    }
                    $foodota_stars .= '<i class="fa fa-star ' . esc_attr($star_staus) . '"></i>';
                }
                $hover_html .= '<div class="fr-logo-details">
               <p>' . esc_html($store_name) . '</p><span>' . $rating . '</span> </div>';
                if ($restaurant_view == 'small-view') {
                    return '<div class="res-f-box4">
                <div class="res-f-box-img"> <img src="' . esc_url($gravatar) . '" alt="' . esc_attr(get_post_meta($gravatar_id, '_wp_attachment_image_alt', TRUE)) . '" class="img-fluid"> </div>
                <div class="res-f-box-content">
                  <p><a href="' . esc_url($store_url) . '">' . esc_html($store_name) . '</a></p>
                  <span>' . $foodota_stars . $rating . '</span> </div>
              </div>';
                }
                if ($restaurant_view == 'hero-search-view') {
                    return '<a href="' . esc_url($store_url) . '"> 
                      <img data-bs-toggle="tooltip" data-bs-html="true" title="<b>' . esc_html($store_name) . '</b>&nbsp;&nbsp;<sup>' . $rating . '</sup>" src="' . esc_attr($gravatar) . '" alt="' . esc_attr(get_post_meta($gravatar_id, '_wp_attachment_image_alt', TRUE)) . '" class="img-fluid">
                       </a>';
                }
                if ($restaurant_view == 'food-cat-view') {
                    return '<div class="res-ct-overlay">
                      <div class="res-img-box-product"> <img src="' . esc_url($banner) . '" alt="' . esc_attr(get_post_meta($banner_id, '_wp_attachment_image_alt', TRUE)) . '" class="img-fluid">
                        <div class="text-res-2"><a href="' . esc_url($store_url) . '"> <i class="fa fa-arrow-right"></i></a>
                          <p><a href="' . esc_url($store_url) . '">' . esc_html($store_name) . '</a></p>
                        </div>
                      </div>
                    </div>';
                }
            }
        }
    }
}

if (!function_exists('foodota_blog_post')) {
    function foodota_blog_post($blog_id = '', $blog_view = 1)
    {
        $obj_post = get_post($blog_id);
        $image_alt_id = '';
        $blog_banner = '';
        $blog_gravatar = '';
        $blog_post_category='';
        $post_on='';
        $post_date='';
        $mrt = '';
        $post_author_id = $obj_post->post_author;
        $author_name = get_the_author_meta( 'display_name' , $post_author_id );
        $get_author_gravatar = get_avatar_url($post_author_id);
        $time_png = trailingslashit(get_template_directory_uri()) . 'libs/images/time.png';
        $comment_png = trailingslashit(get_template_directory_uri()) . 'libs/images/cc.png';
        $categories = get_the_category($blog_id);
        $post_on=esc_html__('Posted on ','foodota');
        $post_date = get_the_date();
        if ( ! empty( $categories ) ) {
            $blog_post_category=( $categories[0]->name );
        }
        if ($get_author_gravatar == '') {
            $get_author_gravatar = trailingslashit(get_template_directory_uri()) . 'libs/images/no-user.png';
        }
        if (has_post_thumbnail($blog_id)) {
            $get_author_gravatar = get_avatar_url($blog_id);
            if (get_the_post_thumbnail($blog_id, 'foodota-blog-thumb') != '') {
                $blog_gravatar .= '<img src="' . esc_url($get_author_gravatar) . '" alt="' . esc_attr(get_post_meta($image_alt_id, '_wp_attachment_image_alt', true)) . '" class="blog-avatar blog-shadow">';
                $blog_banner .= '<div class="blog-card-header p-0 mx-3 mt-3 position-relative z-index-1" >
    ' . get_the_post_thumbnail($blog_id, 'foodota-blog-thumb',['class' => 'img-fluid border-radius-lg']) . '
       </div >';
            }
        }
        return '<div class="blog-card">
    '.$blog_banner.'
    <div class="card-body pt-3">
                    <span class="blog-category text-gradient text-warning text-uppercase text-xs font-weight-bold my-2">
                       '.esc_html($blog_post_category).'
                    </span>
        <a href="'.esc_url(get_the_permalink($blog_id)).'" class="card-title h5 d-block text-darker">
            <h3>'.$obj_post->post_title .'</h3>
        </a>
        <p class="blog-card-description mb-4">
            '.wp_trim_words(get_the_excerpt($blog_id), 30).'
        </p>
        <div class="blog-author align-items-center">
            '.$blog_gravatar.'
            <div class="blog-name ps-3">
                <span>'.esc_html($author_name).'</span>
                <div class="stats">
                    <small>'.esc_html(get_the_date( get_option('date_format') )).'</small>
                </div>
            </div>
        </div>
    </div>
</div>';
    }
}
if (!function_exists('foodota_get_selected_categories_posts')) {
    function foodota_get_selected_categories_posts($term_id, $author_id = '')
    {
        $post_menus = array();
        $postArg = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'order' => 'desc',
            'fields' => 'ids',
            'author' => $author_id,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'include_children' => false,
                    'terms' => $term_id,
                    'operator' => 'IN'
                )
            )
        );

        $getPost = new wp_query($postArg);
        global $post;
        if ($getPost->have_posts()) {
            $term = get_term($term_id, 'product_cat');
            $count = $getPost->found_posts;
            $post_menus['term']['product-count'] = $count;
            $post_menus['term']['term-name'] = $term->name;
            while ($getPost->have_posts()) {
                $getPost->the_post();
                $post_id = get_the_id();
                $product_instance = wc_get_product($post_id);
                $product = wc_get_product($post_id);
                $price_html = $product->get_price_html();
                $product_type = WC_Product_Factory::get_product_type($post_id);
                $post_menus['products'][$post_id]['product-url'] = wp_get_attachment_url(get_post_thumbnail_id($post_id));
                $post_menus['products'][$post_id]['product-image-id'] = get_post_thumbnail_id($post_id);
                $post_menus['products'][$post_id]['post-id'] = get_the_id();
                $post_menus['products'][$post_id]['title'] = get_the_title();
                $post_menus['products'][$post_id]['date'] = get_the_date();
                $post_menus['products'][$post_id]['content'] = get_the_content();
                $post_menus['products'][$post_id]['prod-short-desc'] = $product_instance->get_short_description();
                $post_menus['products'][$post_id]['prod-desc'] = $product_instance->get_description();
                $post_menus['products'][$post_id]['product-regular-price'] = $product->get_regular_price();
                $post_menus['products'][$post_id]['product-sale-price'] = $product->get_sale_price();
                $post_menus['products'][$post_id]['product-price'] = $product->get_price();
                $post_menus['products'][$post_id]['product-html'] = $price_html;
                $post_menus['products'][$post_id]['product_type'] = $product_type;
                $post_menus['products'][$post_id]['product_rating'] = $product->get_average_rating();
            }
        }
        return $post_menus;
    }
}
if (!function_exists('foodota_sale_product')) {
    function foodota_sale_product($author_id = '')
    {
        $post_menus = array();
        $postArg = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'order' => 'desc',
            'fields' => 'ids',
            'author' => $author_id,
            'meta_query' => array(
                'relation' => 'OR',
                array( // Simple products type
                    'key' => '_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric'
                ),
            ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => 'simple',
                ),
            )

        );
        $getPost = new wp_query($postArg);
        global $post;
        if ($getPost->have_posts()) {
            $count = $getPost->found_posts;
            while ($getPost->have_posts()) {
                $getPost->the_post();
                $post_id = get_the_id();
                $product_instance = wc_get_product($post_id);
                $product = wc_get_product($post_id);
                $price_html = $product->get_price_html();
                $product_type = WC_Product_Factory::get_product_type($post_id);
                $post_menus['products'][$post_id]['product-url'] = wp_get_attachment_url(get_post_thumbnail_id($post_id));
                $post_menus['products'][$post_id]['product-image-id'] = get_post_thumbnail_id($post_id);
                $post_menus['products'][$post_id]['post-id'] = get_the_id();
                $post_menus['products'][$post_id]['title'] = get_the_title();
                $post_menus['products'][$post_id]['date'] = get_the_date();
                $post_menus['products'][$post_id]['content'] = get_the_content();
                $post_menus['products'][$post_id]['prod-short-desc'] = $product_instance->get_short_description();
                $post_menus['products'][$post_id]['prod-desc'] = $product_instance->get_description();
                $post_menus['products'][$post_id]['product-regular-price'] = $product->get_regular_price();
                $post_menus['products'][$post_id]['product-sale-price'] = $product->get_sale_price();
                $post_menus['products'][$post_id]['product-price'] = $product->get_price();
                $post_menus['products'][$post_id]['product-html'] = $price_html;
                $post_menus['products'][$post_id]['product_type'] = $product_type;
                $post_menus['products'][$post_id]['product_rating'] = $product->get_average_rating();
            }
            wp_reset_query();
        }
        return $post_menus;
    }
}
if (!function_exists('foodota_top_sale_product')) {
    function foodota_top_sale_product($author_id = '')
    {
        $post_menus = array();
        $postArg = array(
            'post_type' => 'product',
            'meta_key' => 'total_sales',
            'orderby' => 'meta_value_num',
            'posts_per_page' => 5,
            'author' => $author_id,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => 'simple',
                ),
            ),
        );
        $getPost = new wp_query($postArg);
        global $post;
        if ($getPost->have_posts()) {
            $count = $getPost->found_posts;
            while ($getPost->have_posts()) {
                $getPost->the_post();
                $post_id = get_the_id();
                $product_instance = wc_get_product($post_id);
                $product = wc_get_product($post_id);
                $price_html = $product->get_price_html();
                $product_type = WC_Product_Factory::get_product_type($post_id);
                $post_menus['products'][$post_id]['product-url'] = wp_get_attachment_url(get_post_thumbnail_id($post_id));
                $post_menus['products'][$post_id]['product-image-id'] = get_post_thumbnail_id($post_id);
                $post_menus['products'][$post_id]['post-id'] = get_the_id();
                $post_menus['products'][$post_id]['title'] = get_the_title();
                $post_menus['products'][$post_id]['date'] = get_the_date();
                $post_menus['products'][$post_id]['content'] = get_the_content();
                $post_menus['products'][$post_id]['prod-short-desc'] = $product_instance->get_short_description();
                $post_menus['products'][$post_id]['prod-desc'] = $product_instance->get_description();
                $post_menus['products'][$post_id]['product-regular-price'] = $product->get_regular_price();
                $post_menus['products'][$post_id]['product-sale-price'] = $product->get_sale_price();
                $post_menus['products'][$post_id]['product-price'] = $product->get_price();
                $post_menus['products'][$post_id]['product-html'] = $price_html;
                $post_menus['products'][$post_id]['product_type'] = $product_type;
                $post_menus['products'][$post_id]['product_rating'] = $product->get_average_rating();
            }
            wp_reset_query();
        }
        return $post_menus;
    }
}
if (!function_exists('foodota_get_selected_categories')) {
    function foodota_get_selected_categories($vandor_id = '', $show_products = false)
    {
        $posts = get_posts(array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'author' => $vandor_id,
            )
        );
        $author_terms = array();
        foreach ($posts as $p) {
            $terms = wp_get_object_terms($p->ID, 'product_cat');
            foreach ($terms as $t) {
                if ($t->parent == 0) {
                    $author_terms[$t->term_id]['name'] = $t->name;
                    $author_terms[$t->term_id]['term-id'] = $t->term_id;
                    $author_terms[$t->term_id]['term-count'] = $t->count;
                }
            }
        }
        $menus = array();
        foreach ($author_terms as $key => $value) {
            $term_posts = array();
            if ($show_products == true) {
                $term_posts = foodota_get_selected_categories_posts($value['term-id'], $vandor_id);
            }
            $menus[$key]['term-id'] = isset($value['term-id']) ? $value['term-id'] : '';
            $menus[$key]['term-name'] = isset($value['name']) ? $value['name'] : '';
            $menus[$key]['term-slug'] = isset($value['slug']) ? $value['slug'] : '';
            $menus[$key]['term-count'] = isset($value['term-count']) ? $value['term-count'] : '';
            $menus[$key]['term-posts'] = $term_posts;
        }
        return ($menus);
    }
}

if (!function_exists('foodota_limitted_character')) {
    function foodota_limitted_character($content = '', $count = 10)
    {
        $excerpt = $content;
        $excerpt = preg_replace(" ([.*?])", '', $excerpt);
        $excerpt = strip_shortcodes($excerpt);
        $excerpt = strip_tags($excerpt);
        $excerpt = substr($excerpt, 0, $count);
        $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
        return $excerpt;
    }
}
add_filter('foodota_store_list_after_store_info', 'foodota_store_list_after_store_fun', 11, 3);
if (!function_exists('foodota_store_list_after_store_fun')) {
    function foodota_store_list_after_store_fun($store_id, $store_info = '', $time_short = 'short-time')
    {

        global $WCFM, $WCFMmp, $wp, $WCFM_Query;
        $day_number = date('w', time());
        if ($day_number == 0) {
            $day = 6;
        } else {
            $day = $day_number - 1;
        }
        $store_user = wcfmmp_get_store($store_id);
        $wcfm_vendor_store_hours = get_user_meta($store_id, 'wcfm_vendor_store_hours', true);
        if (!$wcfm_vendor_store_hours) {
            return;
        }
        $wcfm_store_hours_enable = isset($wcfm_vendor_store_hours['enable']) ? 'yes' : 'no';
        if ($wcfm_store_hours_enable != 'yes') {
            return '<span class="wcfmfa fa-clock"></span><span class="today-status"></span><span class="today-timing">' . esc_html__('Restaurant Open 24/7', 'foodota') . '</span>';
        }

        $wcfm_store_hours_off_days = isset($wcfm_vendor_store_hours['off_days']) ? $wcfm_vendor_store_hours['off_days'] : array();
        $wcfm_store_hours_day_times = isset($wcfm_vendor_store_hours['day_times']) ? $wcfm_vendor_store_hours['day_times'] : array();
        if (empty($wcfm_store_hours_day_times)) return;
        $weekdays = array(0 => esc_html__('Monday', 'foodota'), 1 => esc_html__('Tuesday', 'foodota'), 2 => esc_html__('Wednesday', 'foodota'), 3 => esc_html__('Thursday', 'foodota'), 4 => esc_html__('Friday', 'foodota'), 5 => esc_html__('Saturday', 'foodota'), 6 => esc_html__('Sunday', 'foodota'));
        ?>
        <?php
        if ($time_short == 'long-time') {
            ?>
            <?php
            foreach ($wcfm_store_hours_day_times[$day] as $wcfm_store_hours_day => $wcfm_store_hours_day_time_slots) {
                if (in_array($wcfm_store_hours_day, $wcfm_store_hours_day_times[$day])) continue;
                if (!isset($wcfm_store_hours_day_time_slots['start'])) return;
                if (empty($wcfm_store_hours_day_time_slots['start']) || empty($wcfm_store_hours_day_time_slots['end'])) continue;
                echo '<li><span class="today-status">' . __('Today ', 'foodota') . '</span><span class="days-timing">' . date_i18n(wc_time_format(), strtotime($wcfm_store_hours_day_time_slots['start'])) . " - " . date_i18n(wc_time_format(), strtotime($wcfm_store_hours_day_time_slots['end'])) . '</span> ';
                echo '<br /></li>';
            }
            foreach ($wcfm_store_hours_day_times as $wcfm_store_hours_day => $wcfm_store_hours_day_time_slots) {
                if (in_array($wcfm_store_hours_day, $wcfm_store_hours_off_days)) continue;
                if (!isset($wcfm_store_hours_day_time_slots[0]) || !isset($wcfm_store_hours_day_time_slots[0]['start'])) return;
                if (empty($wcfm_store_hours_day_time_slots[0]['start']) || empty($wcfm_store_hours_day_time_slots[0]['end'])) continue;
                echo '<li><span class="days-names">' . $weekdays[$wcfm_store_hours_day] . '</span>';
                foreach ($wcfm_store_hours_day_time_slots as $slot => $wcfm_store_hours_day_time_slot) {
                    echo '<span class="days-timing">' . date_i18n(wc_time_format(), strtotime($wcfm_store_hours_day_time_slot['start'])) . " - " . date_i18n(wc_time_format(), strtotime($wcfm_store_hours_day_time_slot['end'])) . '</span>';
                }
                echo '</li>';
            }
            ?>
            <?php
        } else {
            foreach ($wcfm_store_hours_day_times[$day] as $wcfm_store_hours_day => $wcfm_store_hours_day_time_slots) {

                if (in_array($wcfm_store_hours_day, $wcfm_store_hours_day_times[$day])) continue;
                if (!isset($wcfm_store_hours_day_time_slots['start'])) return;
                    if (empty($wcfm_store_hours_day_time_slots['start']) || empty($wcfm_store_hours_day_time_slots['end'])) {
                        return '<span class="wcfmfa fa-clock"></span><span class="today-status"></span><span class="today-timing">' . esc_html__('Restaurant Closed Today ', 'foodota') . '</span>';
                    } else {
                        return '<span class="wcfmfa fa-clock"></span><span class="today-status"></span><span class="today-timing">' . date_i18n(wc_time_format(), strtotime($wcfm_store_hours_day_time_slots['start'])) . " - " . date_i18n(wc_time_format(), strtotime($wcfm_store_hours_day_time_slots['end'])) . '</span>';
                    }

            }


        }



    }
}

add_filter('woocommerce_loop_add_to_cart_link2', 'quantity_inputs_for_woocommerce_loop_add_to_cart_link', 10, 2);
if (!function_exists('quantity_inputs_for_woocommerce_loop_add_to_cart_link')) {
    function quantity_inputs_for_woocommerce_loop_add_to_cart_link($html, $product_id = 0)
    {
        $product = wc_get_product($product_id);
        if (is_shop() && $product && $product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock() && !$product->is_sold_individually()) {
            $html = '<form action="' . esc_url($product->add_to_cart_url()) . '" class="cart" method="post" enctype="multipart/form-data">';
            $html .= woocommerce_quantity_input(array(), $product, false);
            $html .= '<button type="submit" class="order-btn btn btn-theme ">' . esc_html__('Order Now', 'foodota') . '</button>';
            $html .= '</form>';
        }
        echo esc_html($html);
    }
}
if (!function_exists('foodota_determine_minMax_latLong')) {
    function foodota_determine_minMax_latLong($data_arr = array(), $check_db = true)
    {
        $data = array();
        $success = false;
        $search_radius_type = 'km';
        $nearby_data = $data_arr;
        if (isset($nearby_data) && $nearby_data != "") {
            $original_lat = $nearby_data['latitude'];
            $original_long = $nearby_data['longitude'];
            $distance = intval($nearby_data['distance']);
            if ($search_radius_type == 'mile' && $distance > 0) {
                $distance = $distance * 1.609344;
            }
            $lat = $original_lat;
            $lon = $original_long;
            $distance = ($distance);
            $R = 6371;
            $maxLat = $lat + rad2deg($distance / $R);
            $minLat = $lat - rad2deg($distance / $R);
            $maxLon = $lon + rad2deg(asin($distance / $R) / @abs(@cos(deg2rad($lat))));
            $minLon = $lon - rad2deg(asin($distance / $R) / @abs(@cos(deg2rad($lat))));
            $data['radius'] = $R;
            $data['distance'] = $distance;
            $data['lat']['original'] = $original_lat;
            $data['long']['original'] = $original_long;
            $data['lat']['min'] = $minLat;
            $data['lat']['max'] = $maxLat;
            $data['long']['min'] = $minLon;
            $data['long']['max'] = $maxLon;
        }
        return $data;
    }
}

if (!function_exists('foodota_product_item')) {
    function foodota_product_item($product_id = '', $store_id = '')
    {
        global $post, $woocommerce, $product;
        $post = get_post($product_id);
        $product = wc_get_product($product_id);
        $store_user = wcfmmp_get_store($store_id);
        $store_info = $store_user->get_shop_info();
        $gravatar = $store_user->get_avatar();
        $banner_type = $store_user->get_list_banner_type();
        $product_title = get_the_title($product_id);
        $product_instance = wc_get_product($product_id);
        $product_short_description = $product_instance->get_short_description();
        $product = wc_get_product($product_id);
        $image_alt_id = '';
        $gravatar_id = $store_info['gravatar'];
        $banner_id = $store_info['banner'];
        if ($banner_type == 'video') {
            $banner_video = $store_user->get_list_banner_video();
        } else {
            $banner = $store_user->get_list_banner();
            if (!$banner) {
                $banner = isset($WCFMmp->wcfmmp_marketplace_options['store_list_default_banner']) ? $WCFMmp->wcfmmp_marketplace_options['store_list_default_banner'] : $WCFMmp->plugin_url . 'assets/images/default_banner.jpg';
                $banner = apply_filters('wcfmmp_list_store_default_bannar', $banner);
            }
        }
        $html = '';
        $html = '  <div class="modal-dialog order-modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                 <div class="modal-body">
                <div class="foodota-product-data" id="product-data-'.esc_attr(rand(111111,999999999)).'">
                 <div class="res-md-img">
                 <img src="' . esc_url($banner) . '" alt="' . esc_attr(get_post_meta($banner_id, '_wp_attachment_image_alt', TRUE)) . '" class="img-fluid">
                 </div>';
        $html .= '<div class="res-dialog"><div class="res-fl-main-cat-heading"><div class="main-mrgn"><div class="heading-panel-model"><div id="foodota_quick_view_' . get_the_id().rand(1111,9999) . '" class="mfp-hide mfp-with-anim foodota_quick_view_content foodota_clearfix"> <div class="foodota_product_images">';
        if (has_post_thumbnail()) {
            $image_title = esc_attr(get_the_title(get_post_thumbnail_id()));
            $image_link = wp_get_attachment_url(get_post_thumbnail_id());
            $image = get_the_post_thumbnail($post->ID, apply_filters('single_product_large_thumbnail_size', 'thumbnail'), array('title' => $image_title));
            $attachment_count = count($product->get_gallery_image_ids());
            if ($attachment_count > 0) {
                $gallery = '[product-gallery]';
            } else {
                $gallery = '';
            }
            $html .= apply_filters('woocommerce_single_product_image_html', sprintf('<a href="%s" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image), $post->ID);
        } else {
            $html .= apply_filters('woocommerce_single_product_image_html', sprintf('<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__('Placeholder', 'foodota')), $post->ID);
        }
        $html .= '</div>';
        $html .= '<div class="foodota_summary"><div class="product-right"> <h3 class="foodota_product_title">' . get_the_title($product_id) . '</h3><div class="product-detail">';
        ob_start();
        woocommerce_template_single_excerpt($product);
        $html .= ob_get_contents();
        ob_end_clean();
        $html .= '</div></div>';
        if ($price_html = $product->get_price_html()) {
            $html .= '</div><span class="price foodota_product_price">' . $price_html . '</span></div></div></div><div class="cart-detail">';
        }
        $args = '';
        ob_start();
        woocommerce_template_single_add_to_cart($product);
        $html .= ob_get_contents();
        ob_end_clean();
        $html .= '</div></div></div></div></div></div></div></div></div>';
        return $html;
    }
}
if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    if(!function_exists('foodota_item_cart_model')) {
       function foodota_item_cart_model($product_id = '', $store_id = '')
       {
           global $post, $woocommerce, $product;
           $post = get_post($product_id);
           $product = wc_get_product($product_id);
           $woocommerce_template_single_add_to_cart = array();
           $product_img = '';
           $price = '';
           $post = get_post($product_id);
           $product = wc_get_product($product_id);
           $store_user = wcfmmp_get_store($store_id);
           $store_info = $store_user->get_shop_info();
           $gravatar = $store_user->get_avatar();
           // $banner_type = $store_user->get_list_banner_type();
           $banner_type = $store_user->get_banner_type();
           $product_title = get_the_title($product_id);
           $product_instance = wc_get_product($product_id);
           $product_short_description = $product_instance->get_short_description();
           $product = wc_get_product($product_id);
           if ($banner_type == 'video') {
               $banner_video = $store_user->get_list_banner_video();
           } else {
               $banner = $store_user->get_list_banner();
               if (!$banner) {
                   $banner = isset($WCFMmp->wcfmmp_marketplace_options['store_list_default_banner']) ? $WCFMmp->wcfmmp_marketplace_options['store_list_default_banner'] : $WCFMmp->plugin_url . 'assets/images/default_banner.jpg';
                   $banner = apply_filters('wcfmmp_list_store_default_bannar', $banner);
               }
           }
           if (has_post_thumbnail()) {
               $image_title = esc_attr(get_the_title(get_post_thumbnail_id()));
               $image_link = wp_get_attachment_url(get_post_thumbnail_id());
               $image = get_the_post_thumbnail($post->ID, apply_filters('single_product_large_thumbnail_size', 'thumbnail'), array('title' => $image_title));
               $attachment_count = count($product->get_gallery_image_ids());
               if ($attachment_count > 0) {
                   $gallery = '[product-gallery]';
               } else {
                   $gallery = '';
               }
               $product_img .= apply_filters('woocommerce_single_product_image_html', sprintf('<a href="%s" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image), $post->ID);
           } else {
               $product_img .= apply_filters('woocommerce_single_product_image_html', sprintf('<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__('Placeholder', 'foodota')), $post->ID);
           }

           if ($price_html = $product->get_price_html()) {
               $price .= '<span class="price foodota_product_price">' . $price_html . '</span>';
           }
           $store_user = wcfmmp_get_store($store_id);
           $store_info = $store_user->get_shop_info();
           $gravatar = $store_user->get_avatar();
           $image_alt_id = '';
           $gravatar_id = $store_info['gravatar'];
           $banner_id = $store_info['banner'];
           $banner_type = $store_user->get_list_banner_type();
           $product_title = get_the_title($product_id);
           $product_instance = wc_get_product($product_id);
           $product_short_description = $product_instance->get_short_description();
           $product = wc_get_product($product_id);
           $random_number = rand(111111, 99999999);
           $woocommerce_template_single_add_to_cart = '';
           ob_start();
           woocommerce_template_single_excerpt($product);
           $the_content = $woocommerce_template_single_excerpt = ob_get_contents();
           ob_end_clean();
           ob_start();
           woocommerce_template_single_add_to_cart($product);
           $woocommerce_template_single_add_to_cart .= ob_get_contents();
           ob_end_clean();
           $html = '
<button type="button" class="btn btn-theme"  data-bs-toggle="modal" data-bs-target="#exampleModalLong-' . $random_number . '-' . $product_id . '" id="#exampleModalLong-' . $random_number . '-' . $product_id . '" data-store_id="' . $store_id . '">
' . __("Order Now", "foodota") . ' 
</button>
    <div class="res-modal-content modal fde fade" id="exampleModalLong-' . $random_number . '-' . $product_id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
       <div class="modal-dialog order-modal" role="document">
        <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
           </div>
         <div class="modal-body">
         <div class="foodota-product-data" id="product-data-' . esc_attr(rand(111111, 999999999)) . '">
         <div class="res-md-img"><img src="' . esc_url($banner) . '" alt="' . esc_attr(get_post_meta($banner_id, '_wp_attachment_image_alt', TRUE)) . '" class="img-fluid"></div>
         <div class="res-dialog">
         <div class="res-fl-main-cat-heading">
         <div class="main-mrgn">
         <div class="heading-panel-model">
         <div id="foodota_quick_view_' . get_the_id() . rand(1111, 9999) . '" class="mfp-hide mfp-with-anim foodota_quick_view_content foodota_clearfix">
         <div class="foodota_product_images">' . $product_img . '</div>
         <div class="foodota_summary"><div class="product-right"> <h3 class="foodota_product_title">' . get_the_title($product_id) . '</h3>
         <div class="product-detail">' . $the_content . '</div>
         </div></div> </div></div></div>
         <div class="cart-detail">' . $woocommerce_template_single_add_to_cart . '</div>' . $price . '</div></div>
          </div>
          </div>
        </div>
      </div>
    </div>';
           return $html;
       }
   }
    if (!function_exists('foodota_variable_item')):
        function foodota_variable_item($type, $options, $args, $saved_attribute = array())
        {
            $product = $args['product'];
            $attribute = $args['attribute'];
            $data = '';
            if (!empty($options)) {
                if ($product && taxonomy_exists($attribute)) {
                    $terms = wc_get_product_terms($product->get_id(), $attribute, array('fields' => 'all'));
                    $name = uniqid(wc_variation_attribute_name($attribute));
                    foreach ($terms as $term) {
                        if (in_array($term->slug, $options, true)) {
                            $option = esc_html(apply_filters('woocommerce_variation_option_name', $term->name, $term, $attribute, $product));
                            $is_selected = (sanitize_title($args['selected']) == $term->slug);
                            $selected_class = $is_selected ? 'selected' : '';
                            $tooltip = trim(apply_filters('foodota_variable_item_tooltip', $option, $term, $args));
                            $tooltip_html_attr = !empty($tooltip) ? sprintf(' data-wvstooltip="%s"', esc_attr($tooltip)) : '';
                            $screen_reader_html_attr = $is_selected ? ' aria-checked="true"' : ' aria-checked="false"';
                            if (wp_is_mobile()) {
                                $tooltip_html_attr .= !empty($tooltip) ? ' tabindex="2"' : '';
                            }
                            $data .= sprintf('<li %1$s class="variable-item %2$s-variable-item %2$s-variable-item-%3$s %4$s" title="%5$s" data-title="%5$s" data-value="%3$s" role="radio" tabindex="0">', $screen_reader_html_attr . $tooltip_html_attr, esc_attr($type), esc_attr($term->slug), esc_attr($selected_class), $option);
                            switch ($type):
                                case 'button':
                                    $data .= sprintf('<span class="variable-item-span variable-item-span-%s">%s</span>', esc_attr($type), $option);
                                    break;
                                case 'radio':
                                    $id = uniqid($term->slug);
                                    $data .= sprintf('<input name="%1$s" id="%2$s" class="wvs-radio-variable-item" %3$s  type="radio" value="%4$s" data-title="%5$s" data-value="%4$s" /><label for="%2$s">%5$s</label>', $name, $id, checked(sanitize_title($args['selected']), $term->slug, false), esc_attr($term->slug), $option);
                                    break;
                                default:
                                    $data .= apply_filters('wvs_variable_default_item_content', '', $term, $args, $saved_attribute);
                                    break;
                            endswitch;
                            $data .= '</li>';
                        }
                    }
                }
            }
            return apply_filters('foodota_variable_item', $data, $type, $options, $args, $saved_attribute);
        }
    endif;
    if (!function_exists('foodota_variable_default_item')):
        function foodota_variable_default_item($type, $options, $args, $saved_attribute = array())
        {
            $product    = $args['product'];
            $attribute  = $args['attribute'];
            $assigned   = $args['assigned'];
            $is_archive = (isset($args['is_archive']) && $args['is_archive']);
            $show_archive_tooltip = 0;
            $data       = '';
            if (isset($args['fallback_type']) && $args['fallback_type'] === 'select') {
            }
            if (!empty($options)) {
                if ($product && taxonomy_exists($attribute)) {
                    $terms = wc_get_product_terms($product->get_id(), $attribute, array('fields' => 'all'));
                    $name = uniqid(wc_variation_attribute_name($attribute));
                    foreach ($terms as $term) {
                        if (in_array($term->slug, $options, true)) {
                            $option = esc_html(apply_filters('woocommerce_variation_option_name', $term->name, $term, $attribute, $product));
                            $is_selected = (sanitize_title($args['selected']) == $term->slug);
                            $selected_class = $is_selected ? 'selected' : '';
                            $tooltip = trim(apply_filters('foodota_variable_item_tooltip', $option, $term, $args));
                            if ($is_archive && !$show_archive_tooltip) {
                                $tooltip = false;
                            }
                            $tooltip_html_attr = !empty($tooltip) ? sprintf(' data-wvstooltip="%s"', esc_attr($tooltip)) : '';
                            $screen_reader_html_attr = $is_selected ? ' aria-checked="true"' : ' aria-checked="false"';
                            if (wp_is_mobile()) {
                                $tooltip_html_attr .= !empty($tooltip) ? ' tabindex="2"' : '';
                            }
                            $type = isset($assigned[$term->slug]) ? $assigned[$term->slug]['type'] : $type;
                            if (!isset($assigned[$term->slug]) || empty($assigned[$term->slug]['image_id'])) {
                                $type = 'button';
                            }
                            $data .= sprintf('<li %1$s class="variable-item %2$s-variable-item %2$s-variable-item-%3$s %4$s" title="%5$s" data-title="%5$s"  data-value="%3$s" role="radio" tabindex="0">', $screen_reader_html_attr . $tooltip_html_attr, esc_attr($type), esc_attr($term->slug), esc_attr($selected_class), $option);
                            switch ($type):
                                case 'button':
                                    $data .= sprintf('<span class="variable-item-span variable-item-span-%s">%s</span>', esc_attr($type), $option);
                                    break;
                                default:
                                    $data .= apply_filters('wvs_variable_default_item_content', '', $term, $args, $saved_attribute);
                                    break;
                            endswitch;
                            $data .= '</li>';
                        }
                    }
                } else {
                    foreach ($options as $option) {
                        $option = esc_html(apply_filters('woocommerce_variation_option_name', $option, null, $attribute, $product));
                        $is_selected = (sanitize_title($option) == sanitize_title($args['selected']));
                        $selected_class = $is_selected ? 'selected' : '';
                        $tooltip = trim(apply_filters('foodota_variable_item_tooltip', $option, $options, $args));
                        if ($is_archive && !$show_archive_tooltip) {
                            $tooltip = false;
                        }
                        $tooltip_html_attr = !empty($tooltip) ? sprintf(' data-wvstooltip="%s"', esc_attr($tooltip)) : '';
                        $screen_reader_html_attr = $is_selected ? ' aria-checked="true"' : ' aria-checked="false"';
                        if (wp_is_mobile()) {
                            $tooltip_html_attr .= !empty($tooltip) ? ' tabindex="2"' : '';
                        }
                        $type = isset($assigned[$option]) ? $assigned[$option]['type'] : $type;
                        if (!isset($assigned[$option]) || empty($assigned[$option]['image_id'])) {
                            $type = 'button';
                        }
                        $data .= sprintf('<li %1$s class="variable-item %2$s-variable-item %2$s-variable-item-%3$s %4$s" title="%5$s" data-title="%5$s"  data-value="%3$s" role="radio" tabindex="0">', $screen_reader_html_attr . $tooltip_html_attr, esc_attr($type), esc_attr($option), esc_attr($selected_class), esc_html($option));
                        switch ($type):
                            case 'button':
                                $data .= sprintf('<span class="variable-item-span variable-item-span-%s">%s</span>', esc_attr($type), esc_html($option));
                                break;
                            default:
                                $data .= apply_filters('wvs_variable_default_item_content', '', $option, $args, array());
                                break;
                        endswitch;
                        $data .= '</li>';
                    }
                }
            }
            return apply_filters('foodota_variable_default_item', $data, $type, $options, $args, array());
        }
    endif;
    if (!function_exists('foodota_variable_items_wrapper')):
        function foodota_variable_items_wrapper($contents, $type, $args, $saved_attribute = array())
        {
            $attribute  = $args['attribute'];
            $options    = $args['options'];
            $css_classes = apply_filters('foodota_variable_items_wrapper_class', array("{$type}-variable-wrapper"), $type, $args, $saved_attribute);
            $clear_on_reselect = '';
            array_push($css_classes, $clear_on_reselect);
            $data = sprintf('<ul role="radiogroup" aria-label="%1$s"  class="variable-items-wrapper %2$s" data-attribute_name="%3$s" data-attribute_values="%4$s">%5$s</ul>', esc_attr(wc_attribute_label($attribute)), trim(implode(' ', array_unique($css_classes))), esc_attr(wc_variation_attribute_name($attribute)), wc_esc_json(wp_json_encode(array_values($options))), $contents);
            return apply_filters('foodota_variable_items_wrapper', $data, $contents, $type, $args, $saved_attribute);
        }
    endif;
    if (!function_exists('foodota_woo_default_varition_attributes')) :
        function foodota_woo_default_varition_attributes($args = array())
        {
            $args = wp_parse_args(
                $args, array(
                    'options' => false,
                    'attribute' => false,
                    'product' => false,
                    'selected' => false,
                    'name' => '',
                    'id' => '',
                    'class' => '',
                    'type' => '',
                    'assigned' => '',
                    'show_option_none' => esc_html__('Choose an option', 'foodota')
                )
            );
            $type = $args['type'] ? $args['type'] : 'button';
            $options = $args['options'];
            $product = $args['product'];
            $attribute = $args['attribute'];
            $name = $args['name'] ? $args['name'] : wc_variation_attribute_name($attribute);
            $id = $args['id'] ? $args['id'] : sanitize_title($attribute);
            $class = $args['class'];
            $show_option_none = $args['show_option_none'] ? true : false;
            $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : esc_html__('Choose an option', 'foodota'); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options.
            if (empty($options) && !empty($product) && !empty($attribute)) {
                $attributes = $product->get_variation_attributes();
                $options = $attributes[$attribute];
            }
            if ($product) {
                $productID = 'select-'.$id.'-'.rand(11111,9999999);

                echo '<select id="' . esc_attr($productID) . '" class="' . esc_attr($class) . ' hide foodota-variation-product woo-variation-raw-select woo-variation-raw-type-' . $type . '"  name="' . esc_attr($name) . '" data-attribute_name="' . esc_attr(wc_variation_attribute_name($attribute)) . '" data-show_option_none="' . ($show_option_none ? 'yes' : 'no') . '">';
            }
            if ($args['show_option_none']) {
                echo '<option value="">' . esc_html($show_option_none_text) . '</option>';
            }
            if (!empty($options)) {
                if ($product && taxonomy_exists($attribute)) {
                    $terms = wc_get_product_terms($product->get_id(), $attribute, array('fields' => 'all'));
                    foreach ($terms as $term) {
                        if (in_array($term->slug, $options, true)) {
                            echo '<option value="' . esc_attr($term->slug) . '" ' . selected(sanitize_title($args['selected']), $term->slug, false) . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $term->name, $term, $attribute, $product)) . '</option>';
                        }
                    }
                } else {
                    foreach ($options as $option) {
                        $selected = sanitize_title($args['selected']) === $args['selected'] ? selected($args['selected'], sanitize_title($option), false) : selected($args['selected'], $option, false);
                        echo '<option value="' . esc_attr($option) . '" ' . $selected . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $option, null, $attribute, $product)) . '</option>';
                    }
                }
            }
            echo '</select>';
            $content = foodota_variable_default_item($type, $options, $args);
            echo foodota_variable_items_wrapper($content, $type, $args);
        }
    endif;
    if (!function_exists('foodota_default_image_variation_attribute_options')) :
        function foodota_default_image_variation_attribute_options($args = array())
        {
            $args = wp_parse_args(
                $args, array(
                    'options' => false,
                    'attribute' => false,
                    'product' => false,
                    'selected' => false,
                    'name' => '',
                    'id' => '',
                    'class' => '',
                    'type' => '',
                    'assigned' => '',
                    'show_option_none' => esc_html__('Choose an option', 'foodota')
                )
            );
            $type = $args['type'];
            $options = $args['options'];
            $product = $args['product'];
            $attribute = $args['attribute'];
            $name = $args['name'] ? $args['name'] : wc_variation_attribute_name($attribute);
            $id = $args['id'] ? $args['id'] : sanitize_title($attribute);
            $class = $args['class'];
            $show_option_none = $args['show_option_none'] ? true : false;
            $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : esc_html__('Choose an option', 'foodota'); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options.
            if (empty($options) && !empty($product) && !empty($attribute)) {
                $attributes = $product->get_variation_attributes();
                $options = $attributes[$attribute];
            }
            if ($product) {

                $productID = 'select-'.$id.'-'.rand(11111,9999999);
                if ($type === 'select') {
                    echo '<select id="' . esc_attr($productID) . '" class="' . esc_attr($class) . '" name="' . esc_attr($name) . '" data-attribute_name="' . esc_attr(wc_variation_attribute_name($attribute)) . '" data-show_option_none="' . ($show_option_none ? 'yes' : 'no') . '">';
                } else {
                    echo '<select id="' . esc_attr($productID) . '" class="' . esc_attr($class) . ' hide foodota-variation-product2 woo-variation-raw-select woo-variation-raw-type-' . $type . '"' . esc_attr($name) . '" data-attribute_name="' . esc_attr(wc_variation_attribute_name($attribute)) . '" data-show_option_none="' . ($show_option_none ? 'yes' : 'no') . '">';
                }
            }
            if ($args['show_option_none']) {
                echo '<option value="">' . esc_html($show_option_none_text) . '</option>';
            }
            if (!empty($options)) {
                if ($product && taxonomy_exists($attribute)) {
                    $terms = wc_get_product_terms($product->get_id(), $attribute, array('fields' => 'all'));
                    foreach ($terms as $term) {
                        if (in_array($term->slug, $options, true)) {
                            echo '<option value="' . esc_attr($term->slug) . '" ' . selected(sanitize_title($args['selected']), $term->slug, false) . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $term->name, $term, $attribute, $product)) . '</option>';
                        }
                    }
                } else {
                    foreach ($options as $option) {
                        $selected = sanitize_title($args['selected']) === $args['selected'] ? selected($args['selected'], sanitize_title($option), false) : selected($args['selected'], $option, false);
                        echo '<option value="' . esc_attr($option) . '" ' . $selected . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $option, null, $attribute, $product)) . '</option>';
                    }
                }
            }
            echo '</select>';
            if ($type === 'select') {
                return '';
            }
            $content = foodota_variable_default_item($type, $options, $args);
            echo foodota_variable_items_wrapper($content, $type, $args);
        }
    endif;
    if (!function_exists('foodota_attribute_type_for_wc_product')):
        function foodota_attribute_type_for_wc_product($type, $attribute_name)
        {
            $attributes = wc_get_attribute_taxonomies();
            $attribute_name_clean = str_replace('pa_', '', wc_sanitize_taxonomy_name($attribute_name));
            if ('pa_' === substr($attribute_name, 0, 3)) {
                $attribute = array_values(
                    array_filter(
                        $attributes, function ($attribute) use ($type, $attribute_name_clean) {
                        return $attribute_name_clean === $attribute->attribute_name;
                    }
                    )
                );
                if (!empty($attribute)) {
                    $attribute = apply_filters('foodota_wc_attribute_taxonomy_get', $attribute[0], $attribute_name);
                } else {
                    $attribute = foodota_wc_attribute_taxonomy_get($attribute_name);
                }
                return apply_filters('foodota_attribute_type_for_wc_product', (isset($attribute->attribute_type) && ($attribute->attribute_type == $type)), $type, $attribute_name, $attribute);
            } else {
                return apply_filters('foodota_attribute_type_for_wc_product', false, $type, $attribute_name, null);
            }
        }
    endif;
    if (!function_exists('foodota_get_available_attributes_types')) {
        function foodota_get_available_attributes_types($type = false)
        {
            $types = array();
            $types = apply_filters('foodota_get_available_attributes_types', $types);
            if ($type) {
                return isset($types[$type]) ? $types[$type] : array();
            }
            return $types;
        }
    }
    if (!function_exists('foodota_wc_replace_variation_attribute_options_html')):
        function foodota_wc_replace_variation_attribute_options_html($html, $args)
        {
            if (apply_filters('default_foodota_wc_replace_variation_attribute_options_html', false, $args, $html)) {
                return $html;
            }
            if (isset($_POST['action']) && $_POST['action'] === 'woocommerce_configure_bundle_order_item') {
                return $html;
            }
            $product = $args['product'];
            $is_default_to_image = 0;
            $is_default_to_button = 1;
            $default_image_type_attribute = 0;
            $is_default_to_image_button = ($is_default_to_image || $is_default_to_button);
            ob_start();
            if (apply_filters('foodota_is_individual_settings', true, $args, $is_default_to_image, $is_default_to_button)) {
                $attributes = $product->get_variation_attributes();
                $variations = $product->get_available_variations();
                $available_type_keys = array_keys(foodota_get_available_attributes_types());
                $available_types = foodota_get_available_attributes_types();
                $default = true;
                foreach ($available_type_keys as $type) {
                    if (foodota_attribute_type_for_wc_product($type, $args['attribute'])) {
                        $output_callback(
                            apply_filters(
                                'wvs_variation_attribute_options_args', wp_parse_args(
                                    $args, array(
                                        'options' => $args['options'],
                                        'attribute' => $args['attribute'],
                                        'product' => $product,
                                        'selected' => $args['selected'],
                                        'type' => $type,
                                        'is_archive' => (isset($args['is_archive']) && $args['is_archive'])
                                    )
                                )
                            )
                        );
                        $default = false;
                    }
                }
                if ($default && $is_default_to_image_button) {
                    if ($default_image_type_attribute === '__max') {
                        $attribute_counts = array();
                        foreach ($attributes as $attr_key => $attr_values) {
                            $attribute_counts[$attr_key] = count($attr_values);
                        }
                        $max_attribute_count = max($attribute_counts);
                        $attribute_key = array_search($max_attribute_count, $attribute_counts);
                    } elseif ($default_image_type_attribute === '__min') {
                        $attribute_counts = array();
                        foreach ($attributes as $attr_key => $attr_values) {
                            $attribute_counts[$attr_key] = count($attr_values);
                        }
                        $min_attribute_count = min($attribute_counts);
                        $attribute_key = array_search($min_attribute_count, $attribute_counts);

                    } elseif ($default_image_type_attribute === '__first') {
                        $attribute_keys = array_keys($attributes);
                        $attribute_key = current($attribute_keys);
                    } else {
                        $attribute_key = $default_image_type_attribute;
                    }
                    $selected_attribute_name = wc_variation_attribute_name($attribute_key);
                    $default_attribute_keys = array_keys($attributes);
                    $default_attribute_key = current($default_attribute_keys);
                    $default_attribute_name = wc_variation_attribute_name($default_attribute_key);
                    $current_attribute = $args['attribute'];
                    $current_attribute_name = wc_variation_attribute_name($current_attribute);
                    if ($is_default_to_image) {
                        $assigned = array();
                        foreach ($variations as $variation_key => $variation) {
                            $attribute_name = isset($variation['attributes'][$selected_attribute_name]) ? $selected_attribute_name : $default_attribute_name;
                            $attribute_value = esc_html($variation['attributes'][$attribute_name]);
                            $assigned[$attribute_name][$attribute_value] = array(
                                'image_id' => $variation['image_id'],
                                'variation_id' => $variation['variation_id'],
                                'type' => (empty($variation['image_id']) ? 'button' : 'image'),
                            );
                        }
                        $type = (empty($assigned[$current_attribute_name]) ? 'button' : 'image');
                        $assigned = (isset($assigned[$current_attribute_name]) ? $assigned[$current_attribute_name] : array());
                        if ($type === 'button' && !$is_default_to_button) {
                            $type = 'select';
                        }
                        foodota_default_image_variation_attribute_options(
                            apply_filters(
                                'wvs_variation_attribute_options_args', wp_parse_args(
                                    $args, array(
                                        'options' => $args['options'],
                                        'attribute' => $args['attribute'],
                                        'product' => $product,
                                        'selected' => $args['selected'],
                                        'assigned' => $assigned,
                                        'type' => $type,
                                        'is_archive' => (isset($args['is_archive']) && $args['is_archive'])
                                    )
                                )
                            )
                        );
                    } elseif ($is_default_to_button) {

                        foodota_woo_default_varition_attributes(
                            apply_filters(
                                'wvs_variation_attribute_options_args', wp_parse_args(
                                    $args, array(
                                        'options' => $args['options'],
                                        'attribute' => $args['attribute'],
                                        'product' => $product,
                                        'selected' => $args['selected'],
                                        'is_archive' => (isset($args['is_archive']) && $args['is_archive'])
                                    )
                                )
                            )
                        );
                    } else {

                        echo esc_html($html);
                    }
                } elseif ($default && !$is_default_to_image_button) {
                    echo esc_html($html);
                }
            }
            $data = ob_get_clean();
            $html = apply_filters('foodota_wc_replace_variation_attribute_options_html', $data, $args, $is_default_to_image, $is_default_to_button);

            return $html;
        }
    endif;
    if (!function_exists('check_user_login')) {
        function check_user_login()
        {
            return is_user_logged_in();
        }
    }

}
if (!function_exists('foodota_elementor_button_link')) {
    function foodota_elementor_button_link($is_external = '', $nofollow = '', $btn_title = 'Button Link', $url = '', $class_css = '', $i_class = '')
    {
        $i_class_html = '';
        $target = $is_external ? ' target="_blank"' : '';
        $nofollow = $nofollow ? ' rel="nofollow"' : '';
        if ($i_class != '') {
            $i_class_html = '';
        }
        return '<a href="' . esc_url($url) . '" class="' . $class_css . '"' . $target . $nofollow . '>' . $i_class_html . esc_html($btn_title) . '</a>';
    }
}
if (!function_exists('foodota_elementor_header_design')) {
    function foodota_elementor_header_design($header_design = '', $header_heading_title = '', $header_heading_description = '', $button_one = '')
    {
        if ($header_design == 'classic') {
            return '<div class="heading-minimal">
                       <div class="sub-title">'.esc_html($header_heading_description).'</div>
                       <h3 class="head-title">'.  esc_html($header_heading_title).'</h3>
                      <div class="res-view-btn">
                      ' . $button_one . '
                     </div>
                       <div class="bottom-dots  clearfix">
                    <span class="dot line-dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    </div>
                   </div>';
        } else {
            return '<div class="heading-minimal">
                       <div class="sub-title">'.esc_html($header_heading_description).'</div>
                       <h3 class="head-title">'. esc_html($header_heading_title).'</h3>
                <div class="bottom-dots  clearfix">
                    <span class="dot line-dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>';
        }
    }
}
add_action('wp_logout', 'auto_redirect_after_logout');
if (!function_exists('auto_redirect_after_logout')) {
    function auto_redirect_after_logout()
    {
        wp_safe_redirect(home_url('/'));
        exit;
    }
}
if (!function_exists('restaurants_all_location')) {
    function restaurants_all_location($city_or_name = 'city')
    {
        if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            global $WCFM, $WCFMmp;
            $wcfm_store_url = wcfm_get_option('wcfm_store_url', 'store');
            $users = get_users(array('role' => 'wcfm_vendor')); //get all the lists of users
            $args = array(
                'role' => 'wcfm_vendor',
            );
            $query = get_users($args);//query the maximum users that we will be displaying
            $result = array();
            if (is_array($query)) {
                foreach ($query as $agent_data) {
                    $store_user = wcfmmp_get_store($agent_data->ID);
                    $store_name = $store_user->get_shop_name();
                    $address_city = $store_user->get_address();
                    if ($city_or_name == 'res_name') {
                        if ($store_name != '') {
                            $result[$store_name] = $store_name;
                        }
                    } else {
                        if (!empty($address_city) && $address_city['city']) {
                            $result[$address_city['city']] = $address_city['city'];
                        }
                    }
                }
               // print_r(array_unique($a));
                //return $result;
                $data = array_intersect_key($result, array_unique(array_map('strtolower', $result)));
                return $data;
            }
        }
    }
}
if (!function_exists('foodota_clean_strings')) {
    function foodota_clean_strings($string = '')
    {
        $string = preg_replace('/%u([0-9A-F]+)/', '&#x$1;', $string);
        return html_entity_decode($string, ENT_COMPAT, 'UTF-8');
    }
}
if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins'))) && in_array('wc-frontend-manager/wc_frontend_manager.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    global $WCFM, $WCFMmp;
    $wcfm_store_url = wcfm_get_option('wcfm_store_url', 'store');
    $wcfm_store_url = isset($wcfm_store_url) ? $wcfm_store_url : '';
    $wcfm_store_name = apply_filters('wcfmmp_store_query_var', get_query_var($wcfm_store_url));
    if (isset($wcfm_store_url)  && $wcfm_store_name != "") {

        add_filter('woocommerce_dropdown_variation_attribute_options_html', 'foodota_wc_replace_variation_attribute_options_html', 200, 2);
    }
}

/* Function to filter the text and html*/
if (!function_exists('foodota_return_output')) {
    function foodota_return_output($html = '', $kses_args = array())
    {
         return wp_kses($html, foodota_allowed_html_tags());
    }
}

if ( ! function_exists( 'foodota_allowed_html_tags' ) ) {
    function foodota_allowed_html_tags() {
        return array(
            'a' => array(
				'class' => array(),
				'href'  => array(),
				'rel'   => array(),
				'title' => array(),
			),
			
			'abbr' => array(
				'title' => array(),
			),
            
			'b' => array(),
			'blockquote' => array(
				'cite'  => array(),
			),
			'cite' => array(
				'title' => array(),
			),
			
			'code' => array(),
			'del' => array(
				'datetime' => array(),
				'title' => array(),
			),
			'button' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
				'data-bs-toggle' => array(),
				'data-bs-placement' => array(),
				'data-bs-title' => array(),
			),
			'dd' => array(),
			'div' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
				'data-bs-toggle' => array(),
				'data-bs-placement' => array(),
				'data-bs-title' => array(),
				
			),
			'dl' => array(),
			'dt' => array(),
			'em' => array(),
			'h1' => array(),
			'h2' => array(),
			'h3' => array(),
			'h4' => array(),
			'h5' => array(),
			'h6' => array(),
			'i' => array(),
			'img' => array(
				'alt'    => array(),
				'class'  => array(),
				'height' => array(),
				'src'    => array(),
				'width'  => array(),
			),
			'li' => array(
				'class' => array(),
				'href'  => array(),
				'data-url'  => array(),
			),
			'data-*' => array(
				'toggle' => array(),
			),
			'i' => array(
				'class' => array(),
			),
			'ol' => array(
				'class' => array(),
			),
			'p' => array(
				'class' => array(),
			),
			'q' => array(
				'cite' => array(),
				'title' => array(),
			),
			'span' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
				'data-url'  => array(),
			),
			'strike' => array(),
			'strong' => array(),
			'ul' => array(
				'class' => array(),
			),
        );
    }
}


add_action('wp_enqueue_scripts', 'foodota_typo', 999);
if (!function_exists('foodota_typo'))
{
    function foodota_typo()
	{
		if ( ! class_exists( 'Redux' ) ) {
       		 return;
    	 }
		global $foodota_options;
		$breads = isset($foodota_options['bread_back']['url']) ? $foodota_options['bread_back']['url'] : '';
		$dynamic_css="
		.res-srch-hero-x{
		background-image: url('{$breads}');
			}";

		wp_add_inline_style('foodota-module', $dynamic_css);
	}
}
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))))
{
	function foodota_woocommerce_quantity_input_max_callback( $max, $product ) {
		$max = 50;
		return $max;
	}
	add_filter( 'woocommerce_quantity_input_max', 'foodota_woocommerce_quantity_input_max_callback', 10, 2 );
	
}

/*function setting for Typography start*/
if(in_array('redux-framework/redux-framework.php', apply_filters('active_plugins', get_option('active_plugins'))))
{
    function inline_typography()
    {
        $page_id = get_queried_object_id();
        $header_color=get_post_meta($page_id,'primary_color');
        $menu_color=isset($header_color) ? $header_color: '' ;
        if(!empty($menu_color)) {
            $menu_text_color = $menu_color[0];
        }else{
            $menu_text_color='';
        }
        global $foodota_options;
        wp_enqueue_style( 'theme_custom_css', get_template_directory_uri() . '/libs/css/custom_style.css' );
        $common_heading_color=isset($foodota_options['opt-typography-common']['color']) ? $foodota_options['opt-typography-common']['color']:'';
        $common_heading_family=isset($foodota_options['opt-typography-common']['font-family']) ? $foodota_options['opt-typography-common']['font-family']:'';
        $common_heading_weight=isset($foodota_options['opt-typography-common']['font-weight']) ? $foodota_options['opt-typography-common']['font-weight']:'';
        $common_tags_color=isset($foodota_options['opt-typography-tags']['color']) ? $foodota_options['opt-typography-tags']['color']:'';
        $common_tags_family=isset($foodota_options['opt-typography-tags']['font-family']) ? $foodota_options['opt-typography-tags']['font-family']:'';
        $common_tags_weight=isset($foodota_options['opt-typography-tags']['font-weight']) ? $foodota_options['opt-typography-tags']['font-weight']:'';
        $main_btn_color = isset($foodota_options['opt-theme-btn-color']['regular']) ? $foodota_options['opt-theme-btn-color']['regular']:'';
        $main_btn_color_hover = isset($foodota_options['opt-theme-btn-color']['hover']) ? $foodota_options['opt-theme-btn-color']['hover']:'';
        $main_btn_color_shadow = isset($foodota_options['opt-theme-btn-shadow-color']['rgba']) ? $foodota_options['opt-theme-btn-shadow-color']['rgba']:'';
        $main_btn_color_text = isset($foodota_options['opt-theme-btn-text-color']['regular']) ? $foodota_options['opt-theme-btn-text-color']['regular']:'';
        $main_btn_hover_color_text = isset($foodota_options['opt-theme-btn-text-color']['hover']) ? $foodota_options['opt-theme-btn-text-color']['hover']:'';
        $sec_btn_color = isset($foodota_options['second-opt-theme-btn-color']['regular']) ? $foodota_options['second-opt-theme-btn-color']['regular']:'';
        $sec_btn_color_hover = isset($foodota_options['second-opt-theme-btn-color']['hover']) ? $foodota_options['second-opt-theme-btn-color']['hover']:'';
        $sec_btn_color_shadow = isset($foodota_options['second-opt-theme-btn-shadow-color']['rgba']) ? $foodota_options['second-opt-theme-btn-shadow-color']['rgba']:'';
        $sec_btn_color_text = isset($foodota_options['second-opt-theme-btn-text-color']['regular']) ? $foodota_options['second-opt-theme-btn-text-color']['regular']:'';
        $sec_btn_hover_color_text = isset($foodota_options['second-opt-theme-btn-text-color']['hover']) ? $foodota_options['second-opt-theme-btn-text-color']['hover']:'';
        $white_section_heading=isset($foodota_options['section-bg-white']['color']) ? $foodota_options['section-bg-white']['color']:'';
        $dark_section_heading=isset($foodota_options['section-bg-dark']['color']) ? $foodota_options['section-bg-dark']['color']:'';
        $sticky_menu_color=isset($foodota_options['opt-sticky-header']['regular']) ? $foodota_options['opt-sticky-header']['regular']:'';
        $sticky_menu_hover=isset($foodota_options['opt-sticky-header']['hover']) ? $foodota_options['opt-sticky-header']['hover']:'';
        $custom_css = "
                .res-header-3.food-header-transparent .sb-menu.separate-line > ul > li > a,.res-header-3.food-header-transparent .select2-container--default .select2-selection--single .select2-selection__rendered,.res-header-3.food-header-transparent .btn-secondary{color:$menu_text_color;}
                .res-header-3.sticky .sb-menu.separate-line > ul > li > a,.res-header-3.sticky .select2-container--default .select2-selection--single .select2-selection__rendered,.res-header-3.sticky .btn-secondary{color: $sticky_menu_color;}
				
				.sb-menu ul li.current-menu > a, .sb-menu ul li:hover > a, .header-dark .sb-menu ul li.current-menu > a, .header-dark .sb-menu ul li:hover > a,.header-dark.sticky .sb-menu ul li.current-menu > a, .header-dark.sticky .sb-menu ul li:hover > a {color: $sticky_menu_hover !important;}
				
				
				.btn-theme,.post-excerpt .wp-block-button .wp-block-button__link, .post-excerpt .wp-block-search__button, .post-excerpt .wp-block-file .wp-block-file__button, .post-password-form input[type='submit'], .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.cf-off-canvas #main-order,.scroll-top,form .btn-search,.res-ct-content i,.res-pric-lg,.select2-container--default .select2-results__option--highlighted[aria-selected], .foodota-shop-detail .select2-container--default .select2-results__option--highlighted[data-selected],.realestate-search-blog .input-group .input-group-append .blog-search-btn,.res-sidebar-box3 .pretty.p-switch.p-fill input:checked ~ .state::before,.res-top3-main .btn-secondary,.res-header-3 .sb-menu ul li.color-x a.btn-theme,.res-hero-3.new-search .res-hero-content .res-hero-srch .ul-search-3 .location-search button.submit-btn,.res-pric-lg p,.res-pric-lg p span,.page-item.active .page-link{background-color: $main_btn_color; color: $main_btn_color_text;border-color:$main_btn_color; }
				.select2-container--default .select2-results__option--highlighted[aria-selected], .foodota-shop-detail .select2-container--default .select2-results__option--highlighted[data-selected] { background-color: $main_btn_color !important;}
				.res-sidebar-container ul.element .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.cf-canvas-checboxes .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{background-color: $main_btn_color;}
				.res-top3-main .dropdown .opening-hours-dropdown li .today-status{color:$main_btn_color;}
				.res-hd,.res-sidebar-box3 .pretty.p-switch.p-fill input:checked ~ .state::before{border-color:$main_btn_color;}.res-hd .btn-theme{color: $main_btn_color_text;}
				.res-sidebar-box3 .pretty.p-switch.p-fill input:checked ~ .state::before{background-color: $main_btn_color !important;} 
				.btn-theme:hover, .post-excerpt .wp-block-button .wp-block-button__link:hover, .post-excerpt .wp-block-search__button:hover, .post-excerpt .wp-block-file .wp-block-file__button:hover, .post-password-form input[type='submit']:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.res-header-3 .sb-menu ul li.color-x a.btn-theme:hover,.res-header-3.header-dark .sb-menu ul li.color-x:hover a.btn-theme,.scroll-top:hover,form .btn-search:hover,.res-hs-2 .res-pric-lg,.res-hs-2 .btn-theme,.realestate-search-blog .input-group .input-group-append .blog-search-btn:hover,.res-hs-2 .res-pric-lg p {  background-color: $main_btn_color_hover !important; color: $main_btn_hover_color_text !important;}
				.scroll-top:hover{border-color:$main_btn_color_hover !important;}
				.res-hs-2{border-color:$main_btn_color_hover;}.res-hs-2 .btn-theme{border-color:$main_btn_color_hover;}
				.res-hs-2 .res-pric-lg p span{color: $main_btn_hover_color_text !important;}
				.btn-theme-secondary,.btn-select {background-color: $sec_btn_color !important; color: $sec_btn_color_text !important; }
				.btn-theme-secondary:hover,.btn-select:hover { background-color: $sec_btn_color_hover !important;color: $sec_btn_hover_color_text !important; }
				.res-sidebar-container .res-sidebar .res-sidebar-box .res-sidebar-style span,.bottom-dots .dot.line-dot,.res-header-2 .right-space i,.res-header-2 .btn-secondary i,.heading-minimal .sub-title,.delicious .main-box .bottom-box .price-box .woocommerce-Price-amount,.blog-card .card-body .blog-category,.sub-title,.our-team .main-team-box:hover .text-box h3,.header-dark.sticky .right-space i,.res-hero-main .res-hero-tite span,.blog-sidebar .widget ul li a:hover,.footer-area .social-links-two a:hover,.footer-content .links-widget li a:hover,.footer-content .news-widget .news-post a:hover {color:$main_btn_color !important;}
				.bottom-dots .dot,.heading-dots .h-dot{border-right: 3px solid $main_btn_color;}.bottom-dots .dot.line-dot,.heading-dots .h-dot.line-dot {border-right: 40px solid $main_btn_color;}
				 h1,h2,h3,h4,h5,h6{font-family: $common_heading_family;color:$common_heading_color;font-weight:$common_heading_weight}
				.res-2-text .text-s1, .delicious .main-box .uper-box p, .res-exp-text span, .res-exp-text .style-p, .res-logo-d-count span, .res-blog-box .res-blog-content .res-blog-style, .res-blog-box .res-blog-content span.read-more, .res-featured-box .res-featured-details .res-featured-box-2 .h-style{font-family: $common_heading_family;color:$common_heading_color;font-weight:$common_heading_weight}
				.res-hero-main .res-hero-tite span,.heading-minimal .sub-title,.sub-title{font-family: $common_heading_family;}
				.res-hero-main .res-hero-tite span{font-weight:$common_heading_weight}
				.res-hero-3.new-search .res-hero-main .res-hero-tite h1 {color:$dark_section_heading}
				.white-section h1, .white-section h2, .white-section h3, .white-section h4, .white-section h5, .white-section h6 {color: $white_section_heading;}
				.delicious .main-box .bottom-box .price-box del .woocommerce-Price-amount{color:$common_heading_color !important;}
				p{font-family: $common_tags_family;color:$common_tags_color;font-weight:$common_tags_weight}
				.res-3-box .food_cats .cat_names a,.about-us2 .large-paragraph,.about-us2 p{font-family: $common_tags_family;}
                {color:$common_tags_color;}
			    {font-weight:$common_tags_weight}
			   			";
        wp_add_inline_style( 'theme_custom_css', $custom_css );
    }
    add_action('wp_enqueue_scripts', 'inline_typography', 999);
}
/*function setting for Typography close*/


if (!function_exists('food_is_elementor')) {

    function food_is_elementor($page_id) {
        if (class_exists('Elementor\Plugin')) {
            return \Elementor\Plugin::$instance->db->is_built_with_elementor($page_id);
        } else {
            return false;
        }
    }
}
