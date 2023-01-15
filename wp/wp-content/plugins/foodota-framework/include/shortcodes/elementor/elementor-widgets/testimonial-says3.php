<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Testimonialsays3 extends Widget_Base
{
    public function get_name()
    {
        return 'restaurant-testimonial3';
    }

    public function get_title()
    {
        return __('Restaurant-Client-Testimonial3', 'foodota-framework');
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
            'food-testimonial',
            [
                'label' => __('Foodota Testimonials', 'foodota-framework'),
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
            'testimonial-heading',
            [
                'label' => __('Testimonial Heading', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('what our clients say', 'foodota-framework'),
                'placeholder' => __('Type Testimonial Heading here!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'testimonial-description',
            [
                'label' => __('Testimonial Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Satisfied Clients', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'testimonial-cols-bg',
            [
                'label' => __('Testimonial Side  Background', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );


        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'top-restaurant',
            [
                'label' => __('Restaurant Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );

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
                        'top-restaurant' => '',
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
        $params['testimonial-heading'] = $settings['testimonial-heading'] ? $settings['testimonial-heading'] : '';
        $params['testimonial-description'] = $settings['testimonial-description'] ? $settings['testimonial-description'] : '';
        $params['testimonial-image-id'] = $settings['testimonial-cols-bg']['id'] ? $settings['testimonial-cols-bg']['id'] : '';
        $params['testimonial-image-url'] = $settings['testimonial-cols-bg']['url'] ? $settings['testimonial-cols-bg']['url'] : '';
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
        $testimonial_heading = $params['testimonial-heading'];
        $testimonial_description = $params['testimonial-description'];
        $testimonial_col_img_id=$params['testimonial-image-id'];
        $testimonial_col_img_url=$params['testimonial-image-url'];
        $slider_data = $params['testimonial-slider'];
        $testimonial_upper_html = '';
        $testimonial_lower_html = '';
        $count = 0;
        $active = '';
        $new_img_id='';
        foreach ($slider_data as $item) {

            $client_icon = foodota_get_attch_url($item['testimonial-client-image']['id'], 'foodota-testimonial-client-image');
            $food_logo = foodota_get_attch_url($item['top-restaurant']['id'], 'foodota-user-thumb');
            if ($count == 1) {
                $active = 'active';
            } else {
                $active = '';
            }


            $testimonial_upper_html .= '<div class="carousel-item  ' . $active . '">
              <img class="mb-4" src="' . $food_logo . '" alt="' . esc_attr__($new_img_id, 'foodota-framework') . '">
              <p class="testi-lead">' . $item['testimonial-client-text'] . '</p>
              <div class="testi-author text-xl-start text-xs-center text-sm-center text-md-center d-md-block d-sm-block">
                <div class="testi-name">
                  <span>' . $item['testimonial-client-Name'] . '</span>
                  <div class="testi-stats">
                    <small class="opacity-6">' . $item['testimonial-client-position'] . '</small>
                  </div>
                </div>
              </div>
      </div>';


            $testimonial_lower_html .= '<a href="javascript:">
        <img src="'. $client_icon .'" alt="' . esc_attr__('icon', 'foodota-framework') . '" class="testi-avatar avatar-sm avatar-scale-up shadow border-radius-lg border-0 ' . $active . '" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $count . '"> <span class="text-white mx-2"></span>
      </a> ';
            $count++;
        }
return '<section class="testimonial-3 bg-gradient-darks position-relative overflow-hidden justify-content-start '.$foodota_text_color.'">
<div class="container">
<div class="row">
<div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="heading-minimal">
                               <div class="sub-title">'.$testimonial_description .'</div>
                               <h3 class="head-title">'.$testimonial_heading.'</h3>
                        <div class="bottom-dots  clearfix">
                            <span class="dot line-dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
              </div>

<div class="col-xl-7 col-lg-12 text-xl-start text-md-center text-sm-center">
  <div id="carouselExampleIndicators" class="carousel slide " data-bs-ride="carousel">
    <div class="carousel-indicators">
    ' . $testimonial_lower_html . '
    </div>
    <div class="carousel-inner">
    ' . $testimonial_upper_html . '
    </div>
  </div>
   </div> 
   <div class="col-lg-5 d-none d-xl-block d-xxl-block">
   <img src="'.$testimonial_col_img_url.'" alt="' . esc_attr__($testimonial_col_img_id, 'foodota-framework') . '">
 </div>
 </div>
 </div>
</section>';


    }
}