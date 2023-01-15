<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Foodrestaurants extends Widget_Base
{
    public function get_name()
    {
        return 'foodota-restaurants';
    }

    public function get_title()
    {
        return __('foodota-restaurants', 'foodota-framework');
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
            'food-restaurants',
            [
                'label' => __('Foodota Restaurants', 'foodota-framework'),
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
            'header-design',
            [
                'label' => __('Restaurants Header Design', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'classic',
                'options' => [
                    'classic' => __('Classic Header', 'foodota-framework'),
                    'modern' => __('Modern Header', 'foodota-framework'),
                ],
            ]
        );

        $this->add_control(
            'restaurant-title',
            [
                'label' => __('Restaurants Title', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('All Restaurant', 'foodota-framework'),
                'placeholder' => __('Type your Restaurants Title Here!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'restaurant-description',
            [
                'label' => __('Restaurant Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Lorem Ipsum is simply dummy text of the printing', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'restaurants-btn-title',
            [
                'label' => __('View All', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Button title here', 'foodota-framework'),
                'default' => __('Button Link', 'foodota-framework'),
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
        $this->add_control(
            'restaurants-animation',
            [
                'label' => __('Restaurants Animation', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'slider',
                'options' => [
                    'slider' => __('Slider Animation', 'foodota-framework'),
                    'no_slider' => __('No Animation', 'foodota-framework'),
                ],
            ]
        );
        $this->add_control(
            'cols-in-row',
            [
                'label' => __('Restaurants Cols in row', 'foodota-framework'),
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
            'restaurants-in-numbers',
            [
                'label' => __('Number of Restaurants', 'foodota-framework'),
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
        $params['header-design'] = $settings['header-design'] ? $settings['header-design'] : '';
        $params['restaurant-title'] = $settings['restaurant-title'] ? $settings['restaurant-title'] : '';
        $params['restaurant-description'] = $settings['restaurant-description'] ? $settings['restaurant-description'] : '';
        $params['restaurants-btn-title'] = $settings['restaurants-btn-title'] ? $settings['restaurants-btn-title'] : '';
        $params['restaurants-btn-link'] = $settings['restaurants-btn-link']['url'] ? $settings['restaurants-btn-link']['url'] : '';
        $params['target_one'] = $settings['restaurants-btn-link']['is_external'] ? ' target="_blank"' : '';
        $params['nofollow_one'] = $settings['restaurants-btn-link']['nofollow'] ? ' rel="nofollow"' : '';
        $params['restaurants-animation'] = $settings['restaurants-animation'] ? $settings['restaurants-animation'] : '';
        $params['cols-in-row'] = $settings['cols-in-row'] ? $settings['cols-in-row'] : '';
        $params['restaurants-in-numbers'] = $settings['restaurants-in-numbers'] ? $settings['restaurants-in-numbers'] : '';
        echo $this->foodota_restaurants($params);

        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            ?>
            <script>

                jQuery('.fc-slider').owlCarousel({
                    loop: true,
                    margin: 20,
                    autoplay: false,
                    nav: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        900: {
                            items: 3
                        },
                        1200: {
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


    public function foodota_restaurants($params)
    {
        //$slider_images = $params['hero_slider_images'];
        $animation = '';
        $foodota_text_color = $params['food-heading-Scheme'];
        $header_design = $params['header-design'];
        $header_heading_title = $params['restaurant-title'];
        $header_heading_description = $params['restaurant-description'];
        $target_one = $params['target_one'];
        $nofollow_one = $params['nofollow_one'];
        $btn_title = $params['restaurants-btn-title'];
        $btn_link = $params['restaurants-btn-link'];
        $button_one = '';
        $restaurants_animation = $params['restaurants-animation'];
        $restaurant_in_row = $params['cols-in-row'];
        $show_restaurants = $params['restaurants-in-numbers'];

        if ($params['restaurants-btn-title'] != '' && $params['restaurants-btn-link'] != '') {
            $button_one = foodota_elementor_button_link($target_one, $nofollow_one, $btn_title, $btn_link, '');
        }

        if ($restaurants_animation == 'slider') {
            $animation = 'fc-slider owl-carousel owl-theme';
        } else {
            $animation = 'row';
        }

        $number = $show_restaurants;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'number' => $number,
            'role' => 'wcfm_vendor',
            'fields' => array('ID', 'user_login', 'user_email')
        );
        $query = get_users($args);

        $res_html = '';
        if (is_array($query)) {
            foreach ($query as $agent_data) {
                if ($restaurants_animation == 'slider') {
                    $res_html .= ' <div class="item">' . foodota_all_restaurant_function($agent_data->ID, 'grid-view') . '</div>';
                } else {
                    $res_html .= ' <div class="col-xl-' . $restaurant_in_row . ' col-lg-6 col-md-6"><div class="margin-bottom-30">' . foodota_all_restaurant_function($agent_data->ID, 'grid-view') . '</div></div>';
                }
            }
        }

        if ($header_design != '') {
            $heading_design_type = foodota_elementor_header_design($header_design, $header_heading_title, $header_heading_description, '');
        }


        return '<section class="res-2-featured bg-color section-padding-bottom ' . $foodota_text_color . '">
  <div class="container">
    <div class="row">
      <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
     ' . $heading_design_type . '
      </div>
      <div class="col-xl-12 col-lg-12 col-xxl-12 col-md-12">
        <div class="' . $animation . ' ">
          ' . $res_html . '
        </div>
      </div>
    </div>
  </div>
</section>';
    }
}