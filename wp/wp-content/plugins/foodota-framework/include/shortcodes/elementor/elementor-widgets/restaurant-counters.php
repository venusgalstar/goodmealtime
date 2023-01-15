<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Restaurantcounters extends Widget_Base
{
    public function get_name()
    {
        return 'restaurant-counters';
    }

    public function get_title()
    {
        return __('Restaurant Counters', 'foodota-framework');
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
            'restaurant-counter',
            [
                'label' => __('Restaurant Counter', 'foodota-framework'),
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
            'restaurants-counter-video-link',
            [
                'label' => __('Video Link', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('https://www.youtube.com/watch?v=KP69YPqHquY', 'foodota-framework'),
                'placeholder' => __('https://www.youtube.com', 'foodota-framework'),

            ]
        );
        $this->add_control(
            'restaurants-counter-video-description',
            [
                'label' => __('video Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Click Here To Watch Our Videos', 'foodota-framework'),
                'placeholder' => __('short Description off your Video', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'restaurants-counter-title',
            [
                'label' => __('Restaurant Counter Video Title', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 3,
                'default' => __('Best restaurant in new york city with awesome foods', 'foodota-framework'),
                'placeholder' => __('Type your counter description here', 'foodota-framework'),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'counter_icon',
            [
                'label' => __('Counter Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );


        $repeater->add_control(
            'counter_description',
            [
                'label' => __('Counter Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Restaurant', 'foodota-framework'),
                'placeholder' => __('Type your Counter Title!', 'foodota-framework'),
            ]
        );


        $repeater->add_control(
            'restaurants-in-numbers',
            [
                'label' => __('Number of Restaurants', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5000,
                'step' => 1,
                'default' => 250,
            ]
        );


        $this->add_control(
            'restaurant_counter_repeater',
            [
                'label' => __('Repeater Images', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'counter_icon' => '',
                        'counter_description' => '',
                        'restaurants-in-numbers' => '',
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
        $params['restaurants-counter-video-link'] = $settings['restaurants-counter-video-link'] ? $settings['restaurants-counter-video-link'] : '';
        $params['restaurants-counter-video-description'] = $settings['restaurants-counter-video-description'] ? $settings['restaurants-counter-video-description'] : '';
        $params['restaurants-counter-title'] = $settings['restaurants-counter-title'] ? $settings['restaurants-counter-title'] : '';
        $params['restaurant_counter_repeater'] = $settings['restaurant_counter_repeater'] ? $settings['restaurant_counter_repeater'] : array();
        echo $this->foodota_restaurants_counters($params);
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


    public function foodota_restaurants_counters($params)
    {
        $foodota_text_color = $params['food-heading-Scheme'];
        $restaurant_video_link = $params['restaurants-counter-video-link'];
        $restaurant_video_description = $params['restaurants-counter-video-description'];
        $restaurant_counter_title = $params['restaurants-counter-title'];
        $restaurant_counter_repeater = $params['restaurant_counter_repeater'];
        $counter_html = '';
        if ($restaurant_counter_repeater) {
            foreach ($restaurant_counter_repeater as $item) {
                $counter_icon = foodota_get_attch_url($item['counter_icon']['id'], 'foodota-counter-images-cion');
                $counter_number = $item['restaurants-in-numbers'];
                $counter_description = $item['counter_description'];

                if ($counter_icon != '') {
                    $counter_html .= '<li>
                                      <div class="res-ct-img"> <img src="' . $counter_icon . '" alt="' . esc_attr__('icon', 'foodota-framework') . '" class="img-fluid"> </div>
                                      <div class="res-ct-main"> <span class="doc-stuff">' . $counter_number . '</span>
                                        <p>' . $counter_description . '</p>
                                      </div>
                                    </li>';
                }
            }
        }


        return '<section class="res-city-products section-padding ' . $foodota_text_color . '">
  <div class="container">
    <div class="row">
      <div class="col-xxl-12 col-xl-12 col-lg-12">
        <div class="res-ct-content"><a class="bla-1" href="' . $restaurant_video_link . '"><i class="fa fa-play"></i> </a>
          <p>' . $restaurant_video_description . '</p>
          <h2>' . $restaurant_counter_title . '</h2>
        </div>
        <div class="res-ct-count">
          <ul>
          ' . $counter_html . '
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
';
    }
}