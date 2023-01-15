<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Productrestaurants extends Widget_Base
{
    public function get_name()
    {
        return 'food-product-restaurants';
    }

    public function get_title()
    {
        return __('Foodota-Product-restaurants', 'foodota-framework');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    public function get_categories()
    {
        return ['foodota'];
    }

    public function get_script_depends()
    {
        return [''];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {
        /* for About Us tab */
        $this->start_controls_section(
            'product-restaurants',
            [
                'label' => __('Foodota All Product Restaurants', 'foodota-framework'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'food-heading-Scheme',
            [
                'label' => __('Foodota Color Heading Scheme', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'white-section',
                'options' => [
                    'white-section' => __('White Section Heading Scheme', 'foodota-framework'),
                    'dark-section' => __('Dark Section Heading Scheme', 'foodota-framework'),
                ],
            ]
        );


        $this->add_control(
            'product-title',
            [
                'label' => __('Product All by Restaurants', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Our Product with Restaurants', 'foodota-framework'),
                'placeholder' => __('Type your Product title!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'product-description',
            [
                'label' => __('Product All Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Content here content here making it look like readable English ', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();
        $params['food-heading-Scheme'] = $settings['food-heading-Scheme'] ? $settings['food-heading-Scheme'] : '';
        $params['product-title'] = $settings['product-title'] ? $settings['product-title'] : '';
        $params['product-description'] = $settings['product-description'] ? $settings['product-description'] : '';
        echo $this->foodota_all_products($params);

        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            ?>
            <script>

                jQuery('.product-res').owlCarousel({
                    loop: true,
                    margin: 10,
                    autoplay: false,
                    nav: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 3
                        },
                        1200: {
                            items: 5
                        }
                    }
                });

            </script>
            <?php

        }

    }

    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function content_template()
    {

    }


    public function foodota_all_products($params)
    {
        //$slider_images = $params['hero_slider_images'];
        global $foodota_options;
        $foodota_text_color = $params['food-heading-Scheme'];
        $product_title_here = $params['product-title'];
        $product_description = $params['product-description'];
        $res_html = '';

        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 12,
        );

        $query = new \WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();


                global $product;
                // echo '<br /><a href="'.get_permalink().'">' . woocommerce_get_product_thumbnail().' '.get_the_title().'</a>';
                $store_id = get_the_author_meta('ID');
                $store_user = wcfmmp_get_store($store_id);
                $store_info = $store_user->get_shop_info();
                $store_user = wcfmmp_get_store($store_id);
                $store_address = $store_user->get_address_string();
                $store_description = $store_user->get_shop_description();
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
                $image_alt_id = '';
                $foodota_stars = '';
                $food_child = foodota_top_sale_product($store_id);
                for ($i = 1; $i < 6; $i++) {
                    $star_staus = '';
                    if ($rating >= $i) {
                        $star_staus = "starts-on";
                    }
                    $foodota_stars .= '<i class="fa fa-star ' . $star_staus . '"></i>';
                }
                foreach ($food_child['products'] as $food_child_more) {
                }
                $res_html .= ' <div class="item">
                 <div class="res-3-box res-fl-product">
                     <div class="res-2-img"> 
                         <a href="' . $store_url . '">
                            ' . woocommerce_get_product_thumbnail() . '
                         </a>
                         <div class="res-3-logo-img"> <a href="' . $store_url . '">
                                 <img src="' . $gravatar . '" alt="' . esc_attr(get_post_meta($gravatar_id, '_wp_attachment_image_alt', TRUE)) . '" class="img-fluid">
                             </a>
                         </div>

                     </div>
                     <div class="res-2-bg-white">
                         <div class="res-2-inner">
                             <div class="res-2-text"> ' . $foodota_stars . '
                                 <a href="' . $store_url . '">
                                     <div class="text-s1">' . get_the_title() . '</div>
                                 </a>
                                 <div class="foodota-product-price">' . $food_child_more['product-html'] . '</div>
                             </div>
                             <div class="res-2-map-product">
                                 <span>' . foodota_limitted_character($food_child_more['prod-short-desc'], 30) . '</span> 
                             </div>
                         </div>
                         <div class="res-2-box">
                         <div class="res-fl-main-cat-content-3 slider-btn">
                                     <button type="button" data-quantity="1"
                                             class="order-btn btn btn-theme cart-check-btn button product_type_simple add_to_cart_button ajax_add_to_cart product-quantity-btn"
                                             data-product_id="' . $food_child_more['post-id'] . '"
                                             data-product_sku="rw-7"
                                             aria-label="Add “Product-3” to your cart"
                                             rel="nofollow">
                                             ' . esc_html('Order Now', 'foodota') . '
                                             </button>
                         </div>
                         </div>
                     </div>
                 </div></div>';


            }

            wp_reset_postdata();
        }


        return '<section class="res-cat section-padding ' . $foodota_text_color . '">
                  <div class="container">
                    <div class="row">
                      <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="heading-minimal">
                               <div class="sub-title">' . $product_description . '</div>
                               <h3 class="head-title">' . $product_title_here . '</h3>
                        <div class="bottom-dots  clearfix">
                            <span class="dot line-dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                            </div>
                        
                      </div>
                      <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="product-res owl-carousel owl-theme">
                        ' . $res_html . '
                        </div>
                      </div>
                    </div>
                  </div>
                  </section>';
    }
}