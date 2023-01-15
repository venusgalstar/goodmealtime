<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Spcategory_products extends Widget_Base
{
    public function get_name()
    {
        return 'single-category-products';
    }

    public function get_title()
    {
        return __('Single-Category-Products', 'foodota-framework');
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
            'sp-category-products',
            [
                'label' => __('Single Products By Category', 'foodota-framework'),
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
            'category-title',
            [
                'label' => __('Product Tab Tittle', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Our Popular Deal', 'foodota-framework'),
                'placeholder' => __('Type your Tabs Tittle Here!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'category-description',
            [
                'label' => __('Product Tab Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('OUR MENU', 'foodota-framework'),
                'placeholder' => __('Type your menu Description Here', 'foodota-framework'),
            ]
        );
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'category-select',
            [
                'label' => __('Chose Categories', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => foodota_elementor_all_category(),
                'default' => ['title', 'description'],
            ]
        );
        $repeater->add_control(
            'category_img',
            [
                'label' => __('Category Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );

        $this->add_control(
            'category_slider_repeater',
            [
                'label' => __('Repeater Images', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'category-select' => '',
                        'category_img' => '',
                    ],
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();
        $params['food-heading-Scheme'] = $settings['food-heading-Scheme'] ? $settings['food-heading-Scheme'] : '';
        $params['category-title'] = $settings['category-title'] ? $settings['category-title'] : '';
        $params['category-description'] = $settings['category-description'] ? $settings['category-description'] : '';
        $params['category_slider_repeater'] = $settings['category_slider_repeater'] ? $settings['category_slider_repeater'] : array();
        echo $this->foodota_category2_slider($params);

        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            ?>
            <script>

                jQuery('.tab-pill-carousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    dots: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        576: {
                            items: 1
                        },
                        768: {
                            items: 1
                        },
                        992: {
                            items: 2
                        },
                        1200: {
                            items: 3
                        },
                        1400: {
                            items: 3
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


    public function foodota_category2_slider($params)
    {
        //$slider_images = $params['hero_slider_images'];
        global $foodota_options;
        $foodota_text_color = $params['food-heading-Scheme'];
        $restaurant_category_title = $params['category-title'];
        $restaurant_category_description = $params['category-description'];
        $category_sliders = $params['category_slider_repeater'];
        $food_all_vendors = (isset($foodota_options['food_search_restaurants']) ? $foodota_options['food_search_restaurants'] : '');
        $food_vendor_url = get_permalink($food_all_vendors);
        $res_tab_button = '';
        $res_tab_content = '';

        $active_count = 1;

        foreach ($category_sliders as $item) {

            $now_active="";
            if($active_count==1){$now_active="active";}else{
                $now_active="";
            }


            $cates_image = foodota_get_attch_url($item['category_img']['id']);
            $term_id = $item['category-select'];

            $args = array(
                'post_type' => 'product',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'terms' => $term_id,
                        'operator' => 'IN',
                    )
                )
            );



            $term_data = get_term_by('id', $term_id, 'product_cat');
            $term_count = $term_name = '';
            if (!empty($term_data) && ($term_data->count) > 0) {
                $term_name = $term_data->name;
                $term_count = $term_data->count;
                $res_tab_button .= ' <button class="nav-link '.$now_active.'" data-bs-toggle="pill"  data-bs-target="#tab-'.$term_id.'">
                    <img src="'.esc_url($cates_image) . '" alt="">' . $term_name . '
                  </button> ';

                $res_tab_content.= '<div class="tab-pane  '.$now_active.'" id="tab-'.$term_id.'">
                       <h3>' . $term_name . '</h3>
                       <div class="tab-pill-carousel owl-carousel owl-theme">';

                $query = new \WP_Query($args);
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        global $product;
                        $foodota_category = '';
                        $foodota_category_list = '';
                        $foodota_stars = '';
                        $image_alt_id = '';
                        $post_id = get_the_ID();
                        $product = wc_get_product($post_id);
                        $product_instance = wc_get_product($post_id);
                        $product_html = $product->get_price_html();
                        $product_short_des = $product_instance->get_short_description();
                        $product_des = foodota_limitted_character($product_short_des, 80);
                        $rating  = $product->get_average_rating();
                        $count   = $product->get_rating_count();
                        $user_crunt_id = get_current_user_id();
                        $restaurant_fav = get_user_meta(get_current_user_id(), 'restaurant_favorite' . $user_crunt_id, true);
                        $food_fav='';
                        if ($restaurant_fav == $user_crunt_id) {
                            $food_fav = "favorite";
                        }
                        for ($i = 1; $i < 6; $i++) {
                            $star_staus = '';
                            if ($rating >= $i) {
                                $star_staus = "starts-on";
                            }
                            $foodota_stars .= '<i class="fa fa-star ' . $star_staus . '"></i>';
                        }
                        //woocommerce_get_product_thumbnail('foodota-single-product','','');
                        $res_tab_content.= '<div class="deal-card">
                                <div class="card-img">
                                   ' . woocommerce_get_product_thumbnail() . '
                                </div>
                               <span class="fav-check"><i class="fa fa-heart ' . esc_html($food_fav) . ' " data-id="'.$user_crunt_id.'"></i></span>
                                <div class="card-transition">
                                </div>
                                <div class="card-meta">
                                   <div class="card-rating">
                                    '.$foodota_stars.'
                                   </div>
                                  <h5><a href="'.get_permalink().'">' . get_the_title() . '</a></h5>
                              <div class="price-box">' . $product_html . '</div>
                                </div>
                             </div>';
                    }
                    wp_reset_postdata();
                    $res_tab_content.= '</div>
                    </div>';
                }
            }
            $active_count++;
        }


        return  '<section class="popular-deals-tabs super-deals">
      <div class="container">
         <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
              <div class="d-flex align-items-start tab-pill-main">
                <div class="nav flex-column nav-pills me-3 scroller" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <div class="super-deals-heading">
                    <p>' . $restaurant_category_description . '</p>
                    <h3>' . $restaurant_category_title . '</h3>
                   <div class="bottom-dots  clearfix">
                      <span class="dot line-dot"></span>
                      <span class="dot"></span>
                      <span class="dot"></span>
                      <span class="dot"></span>
                     </div>
                  </div>
                    <div class="nav nav-tabs" id="tab">
                    '.$res_tab_button.'
                    </div>
                </div>
                <div class="tab-content super-deals-grid">
                '.$res_tab_content.'
                </div>
              </div>
            </div>
         </div>
      </div>
    </section>';
    }
}