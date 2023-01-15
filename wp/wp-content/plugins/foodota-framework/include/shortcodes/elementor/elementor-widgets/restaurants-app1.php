<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Restaurantapps1 extends Widget_Base
{
    public function get_name()
    {
        return 'foodota-restaurants1-app';
    }

    public function get_title()
    {
        return __('Restaurant App-1', 'foodota-framework');
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
            'restaurant-app1',
            [
                'label' => __('Restaurant App Section', 'foodota-framework'),
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
                'label' => __('Restaurnt Heading Sub Title', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Mobile Apps', 'foodota-framework'),
                'placeholder' => __('App Section sub Heading!', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'restaurant-app-heading',
            [
                'label' => __('Restaurant App Heading', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Restaurant Helps You To Order Food More Easily', 'foodota-framework'),
                'placeholder' => __('App Section Heading!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'restaurant-app-description',
            [
                'label' => __('Restaurant App Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('orem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type ', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'app-store-image',
            [
                'label' => __('App Store Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->add_control(
            'app-store-link',
            [
                'label' => __('App Store Link', 'foodota-framework'),
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
            'google-play-app-image',
            [
                'label' => __('Google Play App Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->add_control(
            'google-play-app-link',
            [
                'label' => __('Google Play App Link', 'foodota-framework'),
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
            'mobile-phone-image',
            [
                'label' => __('Mobile Phone Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );


        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'check-icon',
            [
                'label' => __('Class For Check Status', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('fa fa-check', 'foodota-framework'),
                'placeholder' => __('fa fa-check', 'foodota-framework'),
            ]
        );
        $repeater->add_control(
            'check-description',
            [
                'label' => __('Describe Check Status', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Lorem Ipsum is simply', 'foodota-framework'),
                'placeholder' => __('Type your check status text', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'check-status-repeater',
            [
                'label' => __('Repeater Testimonial Slider', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'check-icon' => '',
                        'check-description' => '',
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
        $params['restaurant-sub-title'] = $settings['restaurant-sub-title'] ? $settings['restaurant-sub-title'] : '';
        $params['restaurant-app-heading'] = $settings['restaurant-app-heading'] ? $settings['restaurant-app-heading'] : '';
        $params['restaurant-app-description'] = $settings['restaurant-app-description'] ? $settings['restaurant-app-description'] : '';
        $params['app-store-image'] = $settings['app-store-image']['id'] ? $settings['app-store-image']['id'] : '';
        $params['app-store-link'] = $settings['app-store-link']['url'] ? $settings['app-store-link']['url'] : '';
        $params['google-play-app-image'] = $settings['google-play-app-image']['id'] ? $settings['google-play-app-image']['id'] : '';
        $params['google-play-app-link'] = $settings['google-play-app-link']['url'] ? $settings['google-play-app-link']['url'] : '';
        $params['mobile-phone-image'] = $settings['mobile-phone-image']['id'] ? $settings['mobile-phone-image']['id'] : '';
        $params['check-status-repeater'] = $settings['check-status-repeater'] ? $settings['check-status-repeater'] : array();
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
        $app_sub_title = $params['restaurant-sub-title'];
        $app_heading = $params['restaurant-app-heading'];
        $app_description = $params['restaurant-app-description'];
        $app_store_image = $params['app-store-image'];
        $app_store_link = $params['app-store-link'];
        $google_play_image = $params['google-play-app-image'];
        $google_play_link = $params['google-play-app-link'];
        $app_mobile_image = $params['mobile-phone-image'];
        $apple_image = foodota_get_attch_url($app_store_image, 'foodota-app-images');
        $google_image = foodota_get_attch_url($google_play_image, 'foodota-app-images');
        $mobile_image = foodota_get_attch_url($app_mobile_image, 'foodota-app-mobile-image');
        $check_repeater = $params['check-status-repeater'];
        $check_html = '';
        $check_phone_img = '';
        if ($check_repeater) {
            foreach ($check_repeater as $item) {
                $check_html .= '<li>
                                    <p><i class="' . $item['check-icon'] . '"></i>' . $item['check-description'] . '</p>
                                    </li>';
            }
        }

        if ($mobile_image) {
            $check_phone_img = '<div class="col-xxl-6 col-xl-6 col-lg-5 col-md-12">
        <div class="res-app-img"> <img src="' . $mobile_image . '" alt="' . esc_attr__('Mobile Phone Image', 'foodota-framework') . '" class="img-fluid"> </div>
      </div>';
        }

        return '<section class="res-app ' . $foodota_text_color . '">
                  <div class="container">
                    <div class="row">
                      <div class="col-xxl-6 col-xl-6 col-lg-7 col-md-12 align-self-center">
                        <div class="res-app-content">
                          <div class="res-app-text">
                          <div class="sub-title">' . $app_sub_title . '</div>
                            <h2>' . $app_heading . '</h2>
                            <div class="bottom-dots  clearfix">
                                <span class="dot line-dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            </div>
                            <p>' . $app_description . '</p>
                          </div>
                          <div class="res-app-details">
                            <ul>
                            ' . $check_html . '
                            </ul>
                          </div>
                          <div class="res-app-logo">
                            <ul>
                              <li> <a href="' . $app_store_link . '"><img src="' . $apple_image . '" alt="' . esc_attr__('App-Store-image', 'foodota-framework') . '" class="img-fluid"></a> </li>
                              <li> <a href="' . $google_play_link . '"><img src="' . $google_image . '" alt="' . esc_attr__('Google-Play-image', 'foodota-framework') . '" class="img-fluid"></a> </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                       ' . $check_phone_img . '      
                    </div>
                  </div>
                </section>';
    }
}