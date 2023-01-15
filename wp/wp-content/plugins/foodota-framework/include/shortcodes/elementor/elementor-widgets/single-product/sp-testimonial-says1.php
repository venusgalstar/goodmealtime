<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Sptestimonialsays1 extends Widget_Base
{
    public function get_name()
    {
        return 'single-product-testimonial1';
    }

    public function get_title()
    {
        return __('Single-Product-Testimonial1', 'foodota-framework');
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
            'sp-testimonial-saysa',
            [
                'label' => __('Single Product Testimonial1', 'foodota-framework'),
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
                'default' => __('What Our Clients Say', 'foodota-framework'),
                'placeholder' => __('Type you Client Say Heading!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'Why-says-subtitle',
            [
                'label' => __('Client Says Sub Title', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('SATISFIED CLIENTS', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'food-testimonial',
            [
                'label' => __('Foodota Single Product Testimonials', 'foodota-framework'),
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
        $params['Why-says-subtitle'] = $settings['Why-says-subtitle'] ? $settings['Why-says-subtitle'] : '';
        $params['why-says-heading'] = $settings['why-says-heading'] ? $settings['why-says-heading'] : '';
        $params['testimonial-slider'] = $settings['testimonial-slider'] ? $settings['testimonial-slider'] : array();;
        echo $this->testimonial_says($params);
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
        $say_subtitle = $params['Why-says-subtitle'];
        $says_heading = $params['why-says-heading'];
        $slider_data = $params['testimonial-slider'];
        $testimonial_upper_html = '';
        $testimonial_lower_html = '';
        $count = 1;
        $active = '';
        foreach ($slider_data as $item) {

            $client_icon = foodota_get_attch_url($item['testimonial-client-image']['id'], 'foodota-testimonial-client-image');


            $testimonial_upper_html .= '<div class="super-deals-heading">
                     <p class="testimonial-txt">' . $item['testimonial-client-text'] . '</p>
                  </div>';

            $testimonial_lower_html .= '<button class="owl-thumb-item">
                     <div class="profile">
                        <div class="profile-img">
                           <img src="' . $client_icon . '" alt="' . esc_attr__('icon', 'foodota-framework') . '">
                        </div>
                        <div class="profile-meta">
                           <h4>' . $item['testimonial-client-Name'] . '</h4>
                           <p>' . $item['testimonial-client-position'] . '</p>
                        </div>
                     </div>
                  </button>';

        }


        return '<section class="clients-response-testimonial super-deals ' . $foodota_text_color . '">
     <div class="container">
       <div class="row">
         <div class="col-lg-12 col-xxl-12 col-xl-12 col-sm-12">
            <div class="heading-minimal">
              <div class="sub-title">' . $say_subtitle . '</div>
              <h3 class="head-title">' . $says_heading . '</h3>
             <div class="bottom-dots  clearfix">
                <span class="dot line-dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
              </div>
            </div>
         </div>  
         <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
             <div class=" slider1 owl-carousel" data-slider-id="1">
            <!-- Carousel Slides / Quotes -->
               ' . $testimonial_upper_html . '
              </div>
            <!-- Bottom Carousel Indicators -->
            <div class="owl-thumbs slider_thumbs" data-slider-id="1">
            ' . $testimonial_lower_html . '
            </div>
         </div>
     </div>   
    </div>
</section>';
    }
}