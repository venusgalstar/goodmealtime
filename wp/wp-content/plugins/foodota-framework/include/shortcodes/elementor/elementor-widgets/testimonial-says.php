<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Testimonialsays extends Widget_Base
{
    public function get_name()
    {
        return 'restaurant-testimonial';
    }

    public function get_title()
    {
        return __('Restaurant-Client-Testimonial', 'foodota-framework');
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
            'food-why-says',
            [
                'label' => __('Foodota Why Says', 'foodota-framework'),
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
            'why-says-heading',
            [
                'label' => __('Client Says Text', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Why Our Client Say', 'foodota-framework'),
                'placeholder' => __('Type you Client Say Heading!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'why-says-description',
            [
                'label' => __('Client Says Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'why-say-bg',
            [
                'label' => __('Background Why Says Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'food-testimonial',
            [
                'label' => __('Foodota Testimonials', 'foodota-framework'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'testimonial-client-image',
            [
                'label' => __('Testimonial Client Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $repeater->add_control(
            'testimonial-client-text',
            [
                'label' => __('Testimonial Client Text', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua reader will be distracted by the readable content', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );

        $repeater->add_control(
            'testimonial-client-Name',
            [
                'label' => __('Client Says Name', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Alex John Doe', 'foodota-framework'),
                'placeholder' => __('Type your Client Name!', 'foodota-framework'),
            ]
        );
        $repeater->add_control(
            'testimonial-client-position',
            [
                'label' => __('Client Says Position', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Master Chef', 'foodota-framework'),
                'placeholder' => __('Type your Client Position', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'testimonial-slider',
            [
                'label' => __('Repeater Testimonial Slider', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'testimonial-client-image' => '',
                        'testimonial-client-text' => '',
                        'testimonial-client-Name' => '',
                        'testimonial-client-position' => '',
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
        $params['why-says-heading'] = $settings['why-says-heading'] ? $settings['why-says-heading'] : '';
        $params['why-says-description'] = $settings['why-says-description'] ? $settings['why-says-description'] : '';
        $params['why-say-bg'] = $settings['why-say-bg']['id'] ? $settings['why-say-bg']['id'] : '';
        $params['testimonial-slider'] = $settings['testimonial-slider'] ? $settings['testimonial-slider'] : array();;
        echo $this->testimonial_says($params);

        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            ?>
            <script>

                jQuery('.testimonial-slider').owlCarousel({
                    loop: true,
                    autoplay: true,
                    margin: 10,
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


    public function testimonial_says($params)
    {
        $foodota_text_color = $params['food-heading-Scheme'];
        $says_heading = $params['why-says-heading'];
        $says_description = $params['why-says-description'];
        $says_background = $params['why-say-bg'];
        $background_says = foodota_get_attch_url($says_background, 'foodota-why-says-background');
        $slider_data = $params['testimonial-slider'];

        $testimonial_html = '';
        foreach ($slider_data as $item) {
            $client_icon = foodota_get_attch_url($item['testimonial-client-image']['id'], 'foodota-testimonial-client-image');
            $testimonial_html .= '<div class="item">
                <div class="res-swiper-profile">
                 <img src="' . $client_icon . '" alt="' . esc_attr__('slider-image', 'foodota-framework') . '" class="img-fluid"> 
                 </div>
                <div class="res-swiper-text">
                  <p>' . $item['testimonial-client-text'] . '</p>
                  <h3>' . $item['testimonial-client-Name'] . '</h3>
                  <span>' . $item['testimonial-client-position'] . '</span> </div>
			</div>';

        }

        return '<section class="res-2-client section-padding-bottom ' . $foodota_text_color . '">
                  <div class="container">
                    <div class="row">
                      <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 align-self-end">
                        <div class="res-2-client-details">
                          <h3>' . $says_heading . '</h3>
                          <p>' . $says_description . '</p>
                        </div>
                        <div class="res-food-img"> <img src="' . $background_says . '" alt="' . esc_attr__('slider-image', 'foodota-framework') . '" class="img-fluid"> </div>
                      </div>
                      <div class="col-xxl-6 col-xl-6 col-sm-12 col-lg-6 col-md-12">
                        <div class="no-content">
                         <div class="testimonial-slider owl-carousel owl-theme">
                              ' . $testimonial_html . '
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="bg-left-color"> </div>
                </section>';
    }
}