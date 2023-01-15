<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class HeroSlider1 extends Widget_Base
{
    public function get_name()
    {
        return 'foodota-hero-slider1';
    }

    public function get_title()
    {
        return __('Hero Slider 1', 'foodota-framework');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
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
            'hero_slider_one',
            [
                'label' => __('Hero Slider One', 'foodota-framework'),
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


        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'hero1_img',
            [
                'label' => __('Hero Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );

        $this->add_control(
            'hero_slider_images',
            [
                'label' => __('Repeater Images', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'hero1_img' => '',
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
        $params['hero_slider_images'] = $settings['hero_slider_images'] ? $settings['hero_slider_images'] : array();
        echo $this->foodota_elementor_hero_slider1($params);

        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            ?>
            <script>

                jQuery('.banner-slider').owlCarousel({
                    loop: true,
                    margin: 20,
                    autoplay: true,
                    nav: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 1
                        },
                        1000: {
                            items: 1
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


    public function foodota_elementor_hero_slider1($params)
    {
        $foodota_text_color = $params['food-heading-Scheme'];
        $slider_images = $params['hero_slider_images'];

        $slider_html = '';
        if ($slider_images) {
            foreach ($slider_images as $item) {
                $single_image = foodota_get_attch_url($item['hero1_img']['id'], 'foodota-hero-slider-one');
                if ($single_image != '') {
                    $slider_html .= '<div class="item">
                        <div class="banner-image"> 
                        <img src="' . esc_url($single_image) . '" alt="' . esc_attr__('slider-image', 'foodota-framework') . '" class="img-fluid">
                        </div>
                          </div>';
                }
            }
        }


        return '<section class="res-sec-banner   ' . $foodota_text_color . '">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12 col-xxl-12 col-xl-12">
                      <div class="banner-slider owl-carousel owl-theme">
                       ' . $slider_html . '
                          </div>
                      </div>
                    </div>
                  </div>
               </section> ';
    }
}