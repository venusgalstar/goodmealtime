<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Spproduct1 extends Widget_Base
{
    public function get_name()
    {
        return 'Single Shop All Products';
    }

    public function get_title()
    {
        return __('Single Shop All Products one', 'foodota-framework');
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
            'product-single',
            [
                'label' => __('Foodota All Single Products', 'foodota-framework'),
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
                'default' => __('SUPER DELICIOUS', 'foodota-framework'),
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
        $this->add_control(
            'restaurants-btn-title',
            [
                'label' => __('All Products Button Title Here!', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Button title here', 'foodota-framework'),
                'default' => __('All Products', 'foodota-framework'),
                'label_block' => true
            ]
        );
        $this->add_control(
            'restaurants-btn-link',
            [
                'label' => __('View All Button Link', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'foodota-framework'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
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
        $params['product-title'] = $settings['product-title'] ? $settings['product-title'] : '';
        $params['product-description'] = $settings['product-description'] ? $settings['product-description'] : '';
        $params['cols-in-row'] = $settings['cols-in-row'] ? $settings['cols-in-row'] : '';
        $params['product-in-numbers'] = $settings['product-in-numbers'] ? $settings['product-in-numbers'] : '';
        $params['cats'] = $settings['cats'] ? $settings['cats'] : array();
        $params['restaurants-btn-title'] = $settings['restaurants-btn-title'] ? $settings['restaurants-btn-title'] : '';
        $params['restaurants-btn-link'] = $settings['restaurants-btn-link']['url'] ? $settings['restaurants-btn-link']['url'] : '';
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
        global $product;
        $foodota_text_color = $params['food-heading-Scheme'];
        $product_title_here = $params['product-title'];
        $product_description = $params['product-description'];
        $product_numbers = $params['product-in-numbers'];
        $product_in_row = $params['cols-in-row'];
        $view_btn_title = $params['restaurants-btn-title'];
        $view_btn_link = $params['restaurants-btn-link'];
        $target_one = isset($params['target_one']) ? $params['target_one'] : '';
        $nofollow_one = isset($params['nofollow_one']) ? $params['nofollow_one'] : '';
        if ($view_btn_title != '' && $view_btn_link != '') {
            $button_modren = foodota_elementor_button_link($target_one, $nofollow_one, $view_btn_title, $view_btn_link, 'btn btn-theme', 'fa fa-cutlery');
        }

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

            $query = new \WP_Query($args);

            if ($query->have_posts()) {
               while ($query->have_posts()) {
                   $query->the_post();
                        $foodota_stars = '';
                        $user_crunt_id='';
                        $post_id = get_the_ID();
                        $product = wc_get_product($post_id);
                        $product_instance = wc_get_product($post_id);
                        $product_html = $product->get_price_html();
                        $product_short_des = $product_instance->get_short_description();
                        $product_des = foodota_limitted_character($product_short_des, 80);
                        $rating  = $product->get_average_rating();
                        $count   = $product->get_rating_count();
                        $user_crunt_id = get_current_user_id();

                    for ($i = 1; $i < 6; $i++) {
                        $star_staus = '';
                        if ($rating >= $i) {
                            $star_staus = "starts-on";
                        }
                        $foodota_stars .= '<i class="fa fa-star ' . $star_staus . '"></i>';
                    }
                    $res_html .= '<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-' . $product_in_row . ' col-xxl-' . $product_in_row . '">
                        <div class="deal-card">
                           <div class="card-img">
                              ' . woocommerce_get_product_thumbnail('foodota-single-product','','') . '
                           </div>
                           <span class="fav-check"><i class="fa fa-heart" data-id="'.$user_crunt_id.'"></i></span>
                           <div class="card-transition"></div>
                           <div class="card-meta">
                              <div class="card-rating">
                              '.$foodota_stars.'
                              </div>
                             <h5> <a href="'.get_permalink().'"> ' . get_the_title() . '</a></h5>
                              <div class="price-box">' . $product_html . '</div>
                           </div>
                        </div>
                     </div>';
              }
               wp_reset_postdata();
            }

            return '<section class="super-deals ' . $foodota_text_color . '">
             <div class="container">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
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
               </div>
          <div class="row">
             <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
               <div class="super-deals-grid">
                  <div class="row">
                  ' . $res_html . '
                  </div>
               </div>
             </div>
          </div>
          <div class="row">
             <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
               <div class="all-product-btn">
                  '.$button_modren.'
               </div>
             </div>
          </div>

          </div>
       </section>';

        }
}
