<?php
/**
 * The Template for displaying store.
 *
 * @package WCfM Markeplace Views Store
 *
 * For edit coping this to yourtheme/wcfm/store
 *
 */
?>
<?php get_header(); ?>
<?php
wp_enqueue_script("google-map");
if (!defined('ABSPATH')) exit;
$image_alt_id = '';
global $WCFM, $WCFMmp;
$wcfm_store_url = wcfm_get_option('wcfm_store_url', 'store');
$wcfm_store_name = apply_filters('wcfmmp_store_query_var', get_query_var($wcfm_store_url));
if (empty($wcfm_store_name)) return;
$seller_info = get_user_by('slug', $wcfm_store_name);
if (!$seller_info) return;
$store_user = wcfmmp_get_store($seller_info->ID);
$store_info = $store_user->get_shop_info();
$store_lat = isset($store_info['store_lat']) ? esc_attr($store_info['store_lat']) : 0;
$store_lng = isset($store_info['store_lng']) ? esc_attr($store_info['store_lng']) : 0;
$store_description = isset($store_info['shop_description']) ? esc_attr($store_info['shop_description']) : '';
$store_id = $seller_info->ID;
$store_user = wcfmmp_get_store($store_id);
$store_info = $store_user->get_shop_info();
$gravatar = $store_user->get_avatar();
$gravatar_id = $store_info['gravatar'];
$banner_id = $store_info['banner'];
$foodota_stars='';
$banner='';
add_filter('woocommerce_dropdown_variation_attribute_options_html', 'foodota_wc_replace_variation_attribute_options_html', 200, 2);
//$banner_2 = $store_user->get_banner_type();
//$banner_type = $store_user->get_list_banner_type();
$banner_type = $store_user->get_banner_type();
if ($banner_type == 'video') {
    $video_url = $store_user->get_banner_video();
        preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', esc_url( $video_url ), $match );
        if ( isset( $match[ 1 ] ) && $match[ 1 ] != "" ) {
            $video_id = $match[ 1 ];
            $banner='<iframe style="width: 100%;height: 100%;height:470px;" src="https://www.youtube.com/embed/' . esc_attr( $video_id ) . '"  allow="picture-in-picture" allowfullscreen></iframe>';
        }
}elseif ($banner_type == 'slider'){
    $banner = $store_user->get_banner_slider();
}elseif ($banner_type=='single_img'){
    $banner_url = $store_user->get_list_banner();
    $banner = '<img src="'.$banner_url.'" alt="'.get_post_meta($banner_id, '_wp_attachment_image_alt', TRUE).'" class="img-fluid">';
} else {
        $banner = isset($WCFMmp->wcfmmp_marketplace_options['store_list_default_banner']) ? $WCFMmp->wcfmmp_marketplace_options['store_list_default_banner'] : $WCFMmp->plugin_url . 'assets/images/default_banner.jpg';
        $banner = apply_filters('wcfmmp_list_store_default_bannar', $banner);
}
//$banner = foodota_get_attch_url($banner_id, 'full');


$store_name = isset($store_info['store_name']) ? esc_html($store_info['store_name']) : esc_html__('N/A', 'foodota');
$store_name = apply_filters('wcfmmp_store_title', $store_name, $store_id);
$store_url = wcfmmp_get_store_url($store_id);
$store_address = $store_user->get_address_string();
$store_description = $store_user->get_shop_description();
$data = foodota_get_selected_categories($store_id);
$products_list = $WCFM->wcfm_vendor_support->wcfm_get_products_by_vendor($store_id, apply_filters('wcfm_limit_check_status', 'any'), array('suppress_filters' => 1));
$rating = $store_user->get_avg_review_rating();
for ($i = 1; $i < 6; $i++) {
    $star_staus = '';
    if ($rating >= $i) {
        $star_staus = "starts-on";
    }
    $foodota_stars .= '<i class="fa fa-star ' . $star_staus . '"></i>';
}
$allowed_html = foodota_allowed_html_tags();

?>
    <section class="res-banner-height res-srch-hero">
        <?php if(is_array($banner)){ ?>
          <div class="vendor-detail owl-carousel owl-theme">
          <?php
            foreach($banner as $row) {
                if(is_array($row)){
                foreach($row as $k) {
                    $banner = foodota_get_attch_url($k, 'full');
                    if($banner!=''){
                    ?>
                    <img src="<?php echo esc_url($banner) ?>" alt="<?php esc_attr(get_post_meta($k, '_wp_attachment_image_alt', TRUE)); ?>" class="img-fluid">
                        <?php
                    }
                }
                }
            }
            ?>
          </div>
        <?php
        }else{
            echo $banner;
       } ?>
    </section>
    <section class="res-top3-style">
        <div class="container">
            <div class="row">
                <div class="col-xxl-9 col-xl-9 col-sm-12 col-md-12 col-lg-8">
                    <div class="res-top3-product">
                        <div class="res-top3-logo">
                            <img src="<?php echo esc_url($gravatar); ?>"
                                 alt="<?php echo esc_attr(get_post_meta($gravatar_id, '_wp_attachment_image_alt', TRUE)); ?>"
                                 class="img-fluid">
                        </div>
                        <div class="res-top3-content">
                            <?php echo wp_kses($foodota_stars,$allowed_html); ?>
                            <span><?php echo esc_html($rating); ?></span>
                            <h2><?php echo esc_html($store_name); ?></h2>
                            <p>
                            <span class="location-png">
                            <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'libs/images/map.png'); ?>"
                                 alt="<?php echo esc_attr(get_post_meta($image_alt_id, '_wp_attachment_image_alt', TRUE)); ?>"
                                 class="img-fluid">
                            </span>
                                <?php echo esc_html($store_address); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-12 align-self-end">
                    <div class="res-top3-main">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown">
                                <?php if (empty(apply_filters('foodota_store_list_after_store_info', $store_id, $store_info))) {
                                    echo esc_html__("Restaurant Time Not Set Yet", 'foodota');
                                } else {
                                    echo esc_html__('Working Hours', 'foodota');
                                } ?>
                            </button>
                            <ul class="dropdown-menu opening-hours-dropdown">
                                <?php echo apply_filters('foodota_store_list_after_store_info', $store_id, $store_info, 'long-time'); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="wcfm-clearfix"></div>
    <section class="res-fl-details section-padding bg-color">
        <div class="container">
            <div class="row">
                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-12">
                    <div class="res-fl-box">
                        <div class="my-heading-style">
                            <h3><?php echo esc_html__('All Details', 'foodota'); ?></h3>
                            <div class="bottom-dots  clearfix">
                                <span class="dot line-dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            </div>
                        </div>
                        <div class="res-fl-box-content">
                            <ul class="nav nav-tabs" id="tab">
                                <li>
                                    <a class="nav-link active" id="menu-tab" data-bs-toggle="tab" href="#menu">
                                        <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'libs/images/menu-cc.png'); ?>"
                                             alt="<?php echo esc_attr(get_post_meta($image_alt_id, '_wp_attachment_image_alt', TRUE)); ?>"
                                             class="img-fluid">
                                        <span><?php echo esc_html__('Menu', 'foodota'); ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" id="reviewz-tab" data-bs-toggle="tab"
                                       href="#reviews-tabs"><span><?php echo esc_html__('Reviews', 'foodota'); ?></span>
                                        <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'libs/images/common.png'); ?>"
                                             alt="<?php echo esc_attr(get_post_meta($image_alt_id, '_wp_attachment_image_alt', TRUE)); ?>"
                                             class="img-fluid">
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" id="store-information" data-bs-toggle="tab"
                                       href="#store-info"><span><?php echo esc_html__('Restaurant Info', 'foodota'); ?></span>
                                        <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'libs/images/info-x.png'); ?>"
                                             alt="<?php echo esc_attr(get_post_meta($image_alt_id, '_wp_attachment_image_alt', TRUE)); ?>"
                                             class="img-fluid">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php
                    if (is_dynamic_sidebar('rest_search_detail_left')) {
                        dynamic_sidebar('rest_search_detail_left');
                    }
                    ?>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="menu">
                            <div class="res-fl-center-container">
                                <div class="res-fl-cat">
                                    <div class="heading-panel">
                                        <h3><?php echo esc_html__('Categories', 'foodota') ?></h3>
                                        <div class="bottom-dots  clearfix">
                                            <span class="dot line-dot"></span>
                                            <span class="dot"></span>
                                            <span class="dot"></span>
                                            <span class="dot"></span>
                                        </div>
                                    </div>
                                    <div class="nav nav-tabs">
                                    <div class="food-cats owl-carousel owl-theme">
                                        <?php
                                        $count = 0;

                                        $taxonomyName = "product_cat";
                                        foreach ($data as $food_names) {
                                            $countchildren = count (get_term_children( $food_names['term-id'], $taxonomyName ));

                                            ?>
                                            <div class="item">
                                                <a data-child-id="<?php echo esc_attr($countchildren); ?>"  data-term-id="<?php echo esc_attr($food_names['term-id']); ?>" data-store-id="<?php echo esc_attr($store_id); ?>" data-level-id="0"
                                                   data-bs-toggle="tab"
                                                   href="<?php echo esc_attr($food_names['term-id']); ?>"
                                                   class="menu-tabs-list  <?php  if ($count == 0) {
                                                       echo "active";
                                                   } ?>">
                                                    <?php echo esc_html($food_names['term-name']); ?>
                                                </a>
                                            </div>
                                            <?php $count++;


                                        } ?>
                                        </div>
                                    <div class="food-cats-child"></div>
                                </div>
                                </div>


                                <div class="main-tab-content">
                                <?php
                                $count_cat = 0;
                                foreach ($data as $food_names) { ?>
                                    <?php $food_child = foodota_get_selected_categories_posts($food_names['term-id'],$store_id); ?>
                                     <div class="taber-inner">
                                    <div class="food-blocks menu-tabs-content <?php if ($count_cat == 0) { echo "cats-disply-block";}  ?>"
                                         data-tab-content-id="<?php echo esc_attr($food_names['term-id']); ?>">
                                        <div class="res-fl-main-cat-heading">
                                            <div class="heading-panel2">
                                                <h3> <?php echo esc_html($food_child['term']['term-name']); ?>
                                                    (<?php echo esc_html($food_child['term']['product-count']); ?>)</h3>
                                            </div>
                                        </div>
                                        <?php
                                        ?>
                                        <?php foreach ($food_child['products'] as $food_child_more) {
                                            $product_images = wp_get_attachment_image_url($food_child_more['product-image-id'], 'thumbnail');
                                            ?>
                                            <div class="res-fl-main-cat">
                                                <div class="res-fl-main-cat-content">
                                                    <div class="res-fl-cat-img2">
                                                        <img src="<?php echo esc_url($product_images) ?>"
                                                             alt="<?php echo esc_attr(get_post_meta($food_child_more['product-image-id'], '_wp_attachment_image_alt', TRUE)); ?>"
                                                             class="img-fluid">
                                                    </div>
                                                    <div class="res-fl-cat-2-count">
                                                        <p><?php echo esc_html($food_child_more['title']); ?></p>
                                                        <span class="short-des"><?php echo foodota_limitted_character($food_child_more['prod-short-desc'], 25); ?><?php if(strlen($food_child_more['prod-short-desc']) > 25 ) { ?><span class="read_more"><?php echo esc_html__('  ...Read more','foodota') ?></span><?php } ?></span>
                                                        <span class="long-des"><?php echo foodota_limitted_character($food_child_more['prod-short-desc'], 600);  ?><span class="read_less"><?php echo esc_html__('  ...Read less','foodota') ?></span></span>
                                                        <div class="foodota-product-price"><?php echo foodota_return_output($food_child_more['product-html']); ?></div>
                                                    </div>
                                                </div>
                                                <div class="res-fl-main-cat-content-3">
                                                    <?php if ($food_child_more['product_type'] === "variable" || $food_child_more['product_type'] === "grouped") {
                                                        echo foodota_item_cart_model($food_child_more['post-id'], $store_id);
                                                        ?>
                                                    <?php } else { ?>
                                                        <div class="innner-cart-div">
                                                            <input type="number" class="myquantity product-quantity" step="1" min="1" max="500" name="quantity" value="1">
                                                            <button type="button" data-quantity="1"
                                                                    class="order-btn btn btn-theme cart-check-btn button product_type_simple add_to_cart_button ajax_add_to_cart product-quantity-btn openNav"
                                                                    data-product_id="<?php echo esc_html($food_child_more['post-id']) ?> " data-store_id="<?php echo esc_attr($store_id); ?> "
                                                                    aria-label="<?php echo esc_attr__('Add Product to your cart', 'foodota') ?>"
                                                                    rel="nofollow"><?php echo esc_html__('Order Now', 'foodota') ?></button>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php $count_cat++;
                                        } ?>
                                    </div>
                                     </div>
                                    <?php
                                } ?>
                                <div class="tab-child"></div>
                                </div>
                            </div>
                            <input type="hidden" id="store-id" value="<?php echo esc_attr($store_id) ?>">
                        </div>
                        <div class="tab-pane" id="reviews-tabs">
                            <div class="ddt">
                                <div class="row">
                                    <div id="wcfmmp-store" class="wcfmmp-stor-class">
                                        <?php $WCFMmp->template->get_template('store/wcfmmp-view-store-reviews.php', array('store_user' => $store_user, 'store_info' => $store_info)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="store-info">
                            <div class="res-ck-fl-details">
                                <?php if(!empty($store_description)){ ?>
                                <div class="heading-panel">
                                    <h3><?php echo esc_html__('Restaurant Info', 'foodota'); ?></h3>
                                    <div class="bottom-dots  clearfix">
                                        <span class="dot line-dot"></span>
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="res-ck-text">
                                   <?php if(!empty($store_description)){ ?>
                                    <div class="res-ck-info">
										 <?php echo wp_kses($store_description,$allowed_html); ?>
                                    </div>
                                   <?php } ?>
                                    <div class="res-map">
                                        <?php if(!empty($store_lat)){ ?>
                                        <div class="heading-panel">
                                            <h3><?php echo esc_html__('Current Location', 'foodota'); ?></h3>
                                            <div class="bottom-dots  clearfix">
                                                <span class="dot line-dot"></span>
                                                <span class="dot"></span>
                                                <span class="dot"></span>
                                                <span class="dot"></span>
                                            </div>
                                        </div>
                                        <div class="map-show">
                                            <div class="res-map-dash">
                                                <input type="hidden" name="r_lat"
                                                       class="form-control" id="m_lat"
                                                       value="<?php echo esc_attr($store_lat); ?>">
                                                <input type="hidden" name="r_long"
                                                       class="form-control" id="m_long"
                                                       value="<?php echo esc_attr($store_lng); ?>">
                                                <div id="mapshow" class="mapfull">
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-12 col-xs-12">
                    <?php
                    if (is_dynamic_sidebar('rest_search_detail_right')) {
                        dynamic_sidebar('rest_search_detail_right');
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <div class="wcfm-clearfix"></div>
    <div class="res-modal-content modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog order-modal" role="document">
        </div>
    </div>
<?php get_footer(); ?>