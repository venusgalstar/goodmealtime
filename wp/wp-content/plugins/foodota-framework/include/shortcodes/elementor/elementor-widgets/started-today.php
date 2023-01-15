<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Startedtoday extends Widget_Base
{
    public function get_name()
    {
        return 'foodota-started-today';
    }

    public function get_title()
    {
        return __('Restaurant Started Today', 'foodota-framework');
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
            'restaurant-startedtoday',
            [
                'label' => __('Restaurant Get Started Today', 'foodota-framework'),
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
            'restaurant-sub-title',
            [
                'label' => __('Heading Sub Title Here', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Today Sub Title Here!', 'foodota-framework'),
                'placeholder' => __('Sub Title!', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'restaurant-main-heading',
            [
                'label' => __('Get Started Main Heading', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Get Started Today!', 'foodota-framework'),
                'placeholder' => __('Main Heading!', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'restaurant-sub-heading',
            [
                'label' => __('Get Started sub Heading', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Sub Heading!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'restaurant-started-description',
            [
                'label' => __('Restaurant App Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'paid-image',
            [
                'label' => __('Get Started Paid  Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->add_control(
            'paid-main-heading',
            [
                'label' => __('Get Started Paid Heading', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Paid Listing', 'foodota-framework'),
                'placeholder' => __('Paid Heading!', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'paid-main-description',
            [
                'label' => __('Get Started Paid Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('We have the right caring, experience and dedicated professional for you.', 'foodota-framework'),
                'rows' => 4,
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'promote-image',
            [
                'label' => __('Get Started Promote Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );

        $this->add_control(
            'promote-main-heading',
            [
                'label' => __('Get Started Promote Heading', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Promote Your Business', 'foodota-framework'),
                'placeholder' => __('Promote Heading!', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'promote-main-description',
            [
                'label' => __('Get Started Promote Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('We have the right caring, experience and dedicated professional for you.', 'foodota-framework'),
                'rows' => 4,
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'food-image',
            [
                'label' => __('Food Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
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
        $params['restaurant-sub-title'] = $settings['restaurant-sub-title'] ? $settings['restaurant-sub-title'] : '';
        $params['restaurant-main-heading'] = $settings['restaurant-main-heading'] ? $settings['restaurant-main-heading'] : '';
        $params['restaurant-sub-heading'] = $settings['restaurant-sub-heading'] ? $settings['restaurant-sub-heading'] : '';
        $params['restaurant-started-description'] = $settings['restaurant-started-description'] ? $settings['restaurant-started-description'] : '';
        $params['paid-image-id'] = $settings['paid-image']['id'] ? $settings['paid-image']['id'] : '';
        $params['paid-image-link'] = $settings['paid-image']['url'] ? $settings['paid-image']['url'] : '';
        $params['paid-main-heading'] = $settings['paid-main-heading'] ? $settings['paid-main-heading'] : '';
        $params['paid-main-description'] = $settings['paid-main-description'] ? $settings['paid-main-description'] : '';
        $params['promote-image-id'] = $settings['promote-image']['id'] ? $settings['promote-image']['id'] : '';
        $params['promote-image-link'] = $settings['promote-image']['url'] ? $settings['promote-image']['url'] : '';
        $params['promote-main-heading'] = $settings['promote-main-heading'] ? $settings['promote-main-heading'] : '';
        $params['promote-main-description'] = $settings['promote-main-description'] ? $settings['promote-main-description'] : '';
        $params['food-image-id'] = $settings['food-image']['id'] ? $settings['food-image']['id'] : '';
        $params['food-image-url'] = $settings['food-image']['url'] ? $settings['food-image']['url'] : '';
        echo $this->foodota_app_section1($params);
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


    public function foodota_app_section1($params)
    {
        $foodota_text_color = $params['food-heading-Scheme'];
        $start_sub_title = $params['restaurant-sub-title'];
        $start_main_heading = $params['restaurant-main-heading'];
        $start_sub_heading = $params['restaurant-sub-heading'];
        $start_description = $params['restaurant-started-description'];
        $paid_img_id = $params['paid-image-id'];
        $paid_img_url = $params['paid-image-link'];
        $paid_heading = $params['paid-main-heading'];
        $paid_description = $params['paid-main-description'];
        $promote_img_id = $params['promote-image-id'];
        $promote_img_url = $params['promote-image-link'];
        $promote_heading = $params['promote-main-heading'];
        $promote_description = $params['promote-main-description'];
        $food_img_id = $params['food-image-id'];
        $food_img_url = $params['food-image-url'];
        return '<section class="about-us2 section-padding ' . $foodota_text_color . '">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                   <div class="row">
               	 	<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
               	 	   <div class="sub-title">' . $start_sub_title . '</div>
               	 		<h2>' . $start_main_heading . '</h2>
               	 		<div class="bottom-dots  clearfix">
                        <span class="dot line-dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                         </div>
						<p class="large-paragraph">' . $start_sub_heading . '</p>
               	 		<p>' . $start_description . '</p>
               	 			<div class="services">
               	 			<div class="row">
               	 			 <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">
                     <!-- services grid -->
                     <div class="services-grid">
                        <div class="icons"><img src="' . $paid_img_url . '" class="img-responsive" alt="' . esc_attr__($paid_img_id, 'foodota-framework') . '"></div>
                        <h4>' . $paid_heading . '</h4>
                       <p>' . $paid_description . '</p>
                     </div>
                  </div>
                             <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">
                     <!-- services grid -->
                     <div class="services-grid">
                        <div class="icons"><img src="' . $promote_img_url . '" class="img-responsive" alt="' . esc_attr__($promote_img_id, 'foodota-framework') . '"></div>
                        <h4>' . $promote_heading . '</h4>
                       <p>' . $promote_description . '</p>
                     </div>
                  </div>
                           </div>
               	 		</div>
               	 	</div>
               	 	<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 align-self-center text-center">
               	 	<img src="' . $food_img_url . '" class="rounded-circle pull-right  center-block img-responsive" alt="' . esc_attr__($food_img_id, 'foodota-framework') . '"></div>
               	   </div>	
               </div>
            </div>
         </div>
      </section>';
    }
}