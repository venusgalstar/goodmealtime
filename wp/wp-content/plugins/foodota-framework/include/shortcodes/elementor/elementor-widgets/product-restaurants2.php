<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Productrestaurants2 extends Widget_Base
{
    public function get_name()
    {
        return 'food-product-restaurants2';
    }

    public function get_title()
    {
        return __('Foodota-Product-restaurants2', 'foodota-framework');
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
                'label' => __('Foodota All Product Restaurants2', 'foodota-framework'),
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
                'default' => __('Super Delicious Deal', 'foodota-framework'),
                'placeholder' => __('Type your Product title!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'product-description',
            [
                'label' => __('Product All Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Lorem Ipsum is simply dummy text of the printing', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'cats',
            [
                'label' => __('Chose Categories', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => foodota_elementor_all_category(),
                'default' => ['title', 'description'],
            ]
        );

        $this->add_control(
            'cols-in-row',
            [
                'label' => __('Products Cols in row', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '6' => __('Two Cols in row', 'foodota-framework'),
                    '4' => __('Three Cols in row', 'foodota-framework'),
                    '3' => __('Four Cols in row', 'foodota-framework'),
                ],
            ]
        );

        $this->add_control(
            'product-in-numbers',
            [
                'label' => __('Number of Products', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 200,
                'step' => 1,
                'default' => 6,
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
        $params['cols-in-row'] = $settings['cols-in-row'] ? $settings['cols-in-row'] : '';
        $params['product-in-numbers'] = $settings['product-in-numbers'] ? $settings['product-in-numbers'] : '';
        $params['cats'] = $settings['cats'] ? $settings['cats'] : array();
        echo $this->foodota_all_products2($params);
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


    public function foodota_all_products2($params)
    {
        global $foodota_options;
        $foodota_text_color = $params['food-heading-Scheme'];
        $product_title_here = $params['product-title'];
        $product_description = $params['product-description'];
        $product_numbers = $params['product-in-numbers'];
        $product_in_row = $params['cols-in-row'];

        $recep_category = $params['cats'];
        $res_html = '';
        $product_des = '';
        $product_html = '';
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => $product_numbers,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'terms' => $recep_category,
                    'operator' => 'IN',
                )
            )
        );

        if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins')))) {


            $query = new \WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    global $product;
                    if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins')))) {
                        $store_id = get_the_author_meta('ID');
                        $store_id = isset($store_id) ? $store_id : '';
                        $store_user = wcfmmp_get_store($store_id);
                        $store_info = $store_user->get_shop_info();
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
                        $foodota_category = '';
                        $foodota_category_list = '';
                        $foodota_stars = '';

                        if (!$gravatar) {
                            $gravatar = trailingslashit(get_template_directory_uri()) . "libs/images/logo_palce.png";
                        }
                        foreach ($data as $food_names) {
                            $foodota_category .= '<a href="' . $store_url . '" class="badge bg-light" title="' . esc_attr($food_names['term-name']) . '">' . esc_html($food_names['term-name']) . '</a>';
                        }

                        foreach ($data as $food_names) {
                            $foodota_category_list .= '<li><a href="' . $store_url . '" class="badge bg-light" title="' . esc_attr($food_names['term-name']) . '">' . esc_html($food_names['term-name']) . '</a></li>';
                        }


                        for ($i = 1; $i < 6; $i++) {
                            $star_staus = '';
                            if ($rating >= $i) {
                                $star_staus = "starts-on";
                            }
                            $foodota_stars .= '<i class="fa fa-star ' . $star_staus . '"></i>';
                        }

                        $image_alt_id = '';

                        $post_id = get_the_ID();
                        $product = wc_get_product($post_id);
                        $product_instance = wc_get_product($post_id);
                        $product_html = $product->get_price_html();
                        $product_short_des = $product_instance->get_short_description();
                        $product_des = foodota_limitted_character($product_short_des, 80);

                        // echo $post_id."<br>";

                        $res_html .= '<div class="col-xxl-' . $product_in_row . ' col-xl-' . $product_in_row . ' col-lg-6 col-md-6 col-sm-12 row-col-3 margin-bottom-30">
                <div class="main-box">
                    <div class="image-box">
                        <a href="' . $store_url . '">' . woocommerce_get_product_thumbnail() . '</a>
                    </div>
                    <div class="bottom-box">
                     <div class="uper-box">
                        <p><a href="' . $store_url . '">' . get_the_title() . '</a></p>
                    </div>
                        <p>' . $product_des . '</p>
                         <div class="price-box">
                            ' . $product_html . '
                        </div>
                    </div>
                </div>

            </div>';
                    }

                }

                wp_reset_postdata();
            }


            return '<section class="delicious cols-padding ' . $foodota_text_color . '">
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
                        ' . $res_html . '
                    </div>
                  </div>
              </section>';

        }


    }
}
?>