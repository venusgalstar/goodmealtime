<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Papularrestaurants extends Widget_Base
{
    public function get_name()
    {
        return 'foodota-papular-restaurants';
    }

    public function get_title()
    {
        return __('foodota-papular-restaurants', 'foodota-framework');
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
            'food-papular-restaurants',
            [
                'label' => __('Foodota Papular Restaurants', 'foodota-framework'),
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
            'papular-restaurant-title',
            [
                'label' => __('Papular Restaurants Title', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('All Restaurant', 'foodota-framework'),
                'placeholder' => __('Type your Restaurants Title Here!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'papular-restaurant-description',
            [
                'label' => __('Papular Restaurant Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Lorem Ipsum is simply dummy text of the printing', 'foodota-framework'),
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
        $params['papular-restaurant-title'] = $settings['papular-restaurant-title'] ? $settings['papular-restaurant-title'] : '';
        $params['papular-restaurant-description'] = $settings['papular-restaurant-description'] ? $settings['papular-restaurant-description'] : '';
        echo $this->foodota_restaurants($params);
        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            ?>
            <script>

                jQuery('.short-restaurants').owlCarousel({
                    loop: true,
                    margin: 20,
                    autoplay: true,
                    nav: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 3
                        },
                        1000: {
                            items: 4
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
        $restaurant_title_papular = $params['papular-restaurant-title'];
        $restaurant_description_papular = $params['papular-restaurant-description'];


        $args = array(
            'role' => 'wcfm_vendor',
            'fields' => array('ID', 'user_login', 'user_email')
        );
        $query = get_users($args);//query the maximum users that we will be displaying
        $res_html = '';
        if (is_array($query)) {
            foreach ($query as $agent_data) {

                $res_html .= ' <div class="item">' . foodota_samll_view_restaurant($agent_data->ID, 'small-view') . '</div>';

            }
        }

        return '<section class="section-padding-bottom ' . $foodota_text_color . '">
          <div class="container">
            <div class="row">
              <div class="col-xl-12 col-xxl-12 col-lg-12">
                <div class="heading-minimal">
                       <div class="sub-title">' . $restaurant_description_papular . '</div>
                       <h3 class="head-title">' . $restaurant_title_papular . '</h3>
                <div class="bottom-dots  clearfix">
                    <span class="dot line-dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
              </div>
              <div class="col-xxl-12 col-xl-12 col-lg-12">
                <div class="res-slider-container">
                  <div class="short-restaurants owl-carousel owl-theme">
                    ' . $res_html . '
                  </div>
                </div>
                </div>   
            </div>
            </div>    
            </section>';
    }
}