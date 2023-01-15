<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Testimonialsays2 extends Widget_Base
{
    public function get_name()
    {
        return 'restaurant-testimonial2';
    }

    public function get_title()
    {
        return __('Restaurant-Client-Testimonial2', 'foodota-framework');
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
            'food-why-says2',
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
            'Why-says-subtitle',
            [
                'label' => __('Client Says Sub Title', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Client Thoughts', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'decoration-image-1',
            [
                'label' => __('Section side image-1', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->add_control(
            'decoration-image-2',
            [
                'label' => __('Section side image-2', 'foodota-framework'),
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
        $params['Why-says-subtitle'] = $settings['Why-says-subtitle'] ? $settings['Why-says-subtitle'] : '';
        $params['why-says-heading'] = $settings['why-says-heading'] ? $settings['why-says-heading'] : '';
        $params['decoration-image-1_url'] = $settings['decoration-image-1']['url'] ? $settings['decoration-image-1']['url'] : '';
        $params['decoration-image-1_id'] = $settings['decoration-image-1']['id'] ? $settings['decoration-image-1']['id'] : '';
        $params['decoration-image-2_url'] = $settings['decoration-image-2']['url'] ? $settings['decoration-image-2']['url'] : '';
        $params['decoration-image-2_id'] = $settings['decoration-image-2']['id'] ? $settings['decoration-image-2']['id'] : '';
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
        $decoration_img1_id = $params['decoration-image-1_id'];
        $decoration_img1_url = $params['decoration-image-1_url'];
        $decoration_img2_id = $params['decoration-image-2_id'];
        $decoration_img2_url = $params['decoration-image-2_url'];
        $testimonial_upper_html = '';
        $testimonial_lower_html = '';
        $count = 0;
        $active = '';
        foreach ($slider_data as $item) {

            $client_icon = foodota_get_attch_url($item['testimonial-client-image']['id'], 'foodota-testimonial-client-image');
            if ($count == 1) {
                $active = 'active';
            } else {
                $active = '';
            }
            $testimonial_upper_html .= '<div class="carousel-item ' . $active . '">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1">
                            <blockquote>
                                <p>' . $item['testimonial-client-text'] . '</p>
                            </blockquote>
                            <h3>' . $item['testimonial-client-Name'] . '</h3>
                            <p class="title">' . $item['testimonial-client-position'] . '</p>
                        </div>
                    </div>

                </div>';
            $testimonial_lower_html .= ' <li data-bs-target="#quote-carousel" data-bs-slide-to="' . $count . '" class="' . $active . '" ><img class="img-fluid" src="' . $client_icon . '" alt="' . esc_attr__('icon', 'foodota-framework') . '">';
            $count++;
        }


        return '<section class="how-it-work2 testi-2 bg-color cols-padding ' . $foodota_text_color . '">
  <div class="testi-img1">
  <img src="' . $decoration_img1_url . '" alt="' . esc_attr__($decoration_img1_id, 'foodota-framework') . '" class="img-fluid">
  </div>
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
      </div>
    </div>
     <div class="col-xxl-12">
             <div class="carousel slide" data-bs-ride="carousel" id="quote-carousel">
            <!-- Carousel Slides / Quotes -->
            <div class="carousel-inner text-center">
               ' . $testimonial_upper_html . '
            </div>
            <!-- Bottom Carousel Indicators -->
            <ol class="carousel-indicators">
            ' . $testimonial_lower_html . '
            </ol>
        </div>
    </div>
     <div class="testi-img2">
  <img src="' . $decoration_img2_url . '" alt="' . esc_attr__($decoration_img2_id, 'foodota-framework') . '" class="img-fluid">
  </div>
</section>';
    }
}