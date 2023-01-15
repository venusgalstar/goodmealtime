<?php
/**
 * Adds Foo_Widget widget.
 */
class Food_Sale_Product_Widget extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
        $widget_options = array(
            'classname' => 'res-bg-color',
            'description' => __('A Restaurant Sale Product Widget', 'foodota-framework'),
        );
        parent::__construct('food_sale_product_widget', 'Restaurant:Sale Products', $widget_options);
    }

    /**
     * Front-end display of widget.
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     * @see WP_Widget::widget()
     *
     */
    public function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        global $WCFM, $WCFMmp;
        $image_alt_id = '';
        $wcfm_store_url = wcfm_get_option('wcfm_store_url', 'store');
        $wcfm_store_name = apply_filters('wcfmmp_store_query_var', get_query_var($wcfm_store_url));
        if (empty($wcfm_store_name)) return;
        $seller_info = get_user_by('slug', $wcfm_store_name);
        if (!$seller_info) return;
        $store_user = wcfmmp_get_store($seller_info->ID);
        $store_info = $store_user->get_shop_info();
        $store_id = $seller_info->ID;
        $store_description = isset($store_info['shop_description']) ? esc_attr($store_info['shop_description']) : '';
        $restaurant_fav = get_user_meta(get_current_user_id(), 'restaurant_favorite' . $store_id, true);
        $store_address = $store_user->get_address_string();
        $store_description = $store_user->get_shop_description();
        $location_icon = trailingslashit(get_template_directory_uri()) . "libs/images/map.png";
        $store_url = $store_user->get_shop_url();
        $store_name = $store_user->get_shop_name();
        $store_info = $store_user->get_shop_info();
        $gravatar = $store_user->get_avatar();
        $gravatar_id = $store_info['gravatar'];
        $gravatar = foodota_get_attch_url($gravatar_id, 'foodota-store-logo');
        $data = foodota_get_selected_categories($store_id);
        $rating = $store_user->get_avg_review_rating();
        $store_time = apply_filters('foodota_store_list_after_store_info', $store_id, $store_info);
        $wcfmmp_shipping = get_user_meta( $store_id, '_wcfmmp_shipping', true );
        $shipment_status='';
        $foodota_category = '';
        $foodota_category_list = '';
        $foodota_stars = '';
        $food_fav = '';
        if (!$gravatar) {
            $gravatar = trailingslashit(get_template_directory_uri()) . "libs/images/logo_palce.png";
        }
        for ($i = 1; $i < 6; $i++) {
            $star_staus = '';
            if ($rating >= $i) {
                $star_staus = "starts-on";
            }
            $foodota_stars .= '<i class="fa fa-star ' . $star_staus . '"></i>';
        }
        if(isset($wcfmmp_shipping['_wcfmmp_user_shipping_enable']) && $wcfmmp_shipping['_wcfmmp_user_shipping_enable']=='yes' ) {
            $shipment_status = '<i class="fas fa-shipping-fast active"></i>';
        }else{
            $shipment_status = '<i class="fas fa-shipping-fast"></i>';
        }

        $food_child = foodota_sale_product($store_id);

        echo $before_widget;
        if (!empty($title)) {
            echo '<div class="heading-panel-simple">';
            echo $before_title . $title . $after_title;
            echo '<div class="bottom-dots  clearfix">
                    <span class="dot line-dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    </div> </div>';
        }
        echo __('', 'foodota-framework');
        ?>
        <div class="sale-product owl-carousel owl-theme">
            <?php foreach ($food_child['products'] as $food_child_more) { ?>
                <?php $product_image = wp_get_attachment_image_url($food_child_more['product-image-id'], 'foodota-widget-product') ?>
                <div class="item">
                    <div class="res-3-box res-fl-product">
                        <div class="res-2-img"><a href="<?php echo esc_url($store_url); ?>">
                                <img src="<?php echo esc_url($product_image); ?>"
                                     alt="<?php echo esc_attr(get_post_meta($food_child_more['product-image-id'], '_wp_attachment_image_alt', TRUE)); ?>"
                                     class="img-fluid">
                            </a>
                            <div class="res-3-icons fav-check"><?php echo ($shipment_status); ?></i></div>
                            <div class="res-3-logo-img"><a href="<?php echo esc_url($store_url); ?>">
                                    <img src="<?php echo esc_url($gravatar); ?>"
                                         alt="<?php echo esc_attr(get_post_meta($gravatar_id, '_wp_attachment_image_alt', TRUE)); ?>"
                                         class="img-fluid">
                                </a>
                            </div>
                        </div>
                        <div class="res-2-bg-white">
                            <div class="res-2-inner">
                                <div class="res-2-text"> <?php echo $foodota_stars; ?>
                                    <a href="<?php echo esc_url($store_url); ?>">
                                        <div class="text-s1"><?php echo $food_child_more['title']; ?></div>
                                    </a>
                                    <div class="foodota-product-price"><?php echo $food_child_more['product-html']; ?></div>
                                </div>
                                <div class="res-2-map-product">
                                    <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'libs/images/location.png'); ?>"
                                         alt="<?php echo esc_attr(get_post_meta($image_alt_id, '_wp_attachment_image_alt', TRUE)); ?>"
                                         class="img-fluid">
                                    <span><?php echo foodota_limitted_character($store_address, 30); ?></span></div>
                            </div>
                            <div class="res-2-box">
                                <div class="res-fl-main-cat-content-3 slider-btn">
                                    <?php if ($food_child_more['product_type'] === "variable" || $food_child_more['product_type'] === "grouped") {
                                        echo foodota_item_cart_model($food_child_more['post-id'], $store_id);
                                        ?>
                                    <?php } else { ?>
                                        <button type="button" data-quantity="1"
                                                class="order-btn btn btn-theme cart-check-btn button product_type_simple add_to_cart_button ajax_add_to_cart product-quantity-btn openNav"
                                                data-product_id="<?php echo $food_child_more['post-id'] ?> " data-store_id="<?php echo $store_id ?> "
                                                data-product_sku="rw-7"
                                                aria-label="Add “Product-3” to your cart"
                                                rel="nofollow"><?php echo esc_html('Order Now', 'foodota') ?></button>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>

        <?php
        echo $after_widget;
    }

    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     * @see WP_Widget::form()
     *
     */
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Sale Products', 'foodota-framework');
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     * @see WP_Widget::update()
     *
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
} // class Foo_Widget
if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    add_action('widgets_init', 'register_sale_product_widgets');
}

if (!function_exists('register_sale_product_widgets')) {
    function register_sale_product_widgets()
    {
        register_widget('Food_Sale_Product_Widget');
    }
}