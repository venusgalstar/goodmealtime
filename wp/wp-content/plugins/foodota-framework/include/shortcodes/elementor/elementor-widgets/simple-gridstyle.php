<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Simplerestaurants extends Widget_Base
{
    public function get_name()
    {
        return 'simple-grid-restaurants';
    }

    public function get_title()
    {
        return __('Simple-Grid-Restaurants', 'foodota-framework');
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
            'food-simple-grid',
            [
                'label' => __('Foodota simple Grid Restaurants', 'foodota-framework'),
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
                'default' => 'slider',
                'options' => [
                    'classic' => __('Classic Header', 'foodota-framework'),
                    'modern' => __('Modern Header', 'foodota-framework'),
                ],
            ]
        );

        $this->add_control(
            'restaurant-header-title',
            [
                'label' => __('Restaurants Header Title', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('All Restaurant', 'foodota-framework'),
                'placeholder' => __('Type your Restaurants Title Here!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'restaurant-header-description',
            [
                'label' => __('Restaurant Header Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Lorem Ipsum is simply dummy text of the printing', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
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


        $this->end_controls_section();
    }

    protected function render()
    {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();
        $params['food-heading-Scheme'] = $settings['food-heading-Scheme'] ? $settings['food-heading-Scheme'] : '';
        $params['header-design'] = $settings['header-design'] ? $settings['header-design'] : '';
        $params['restaurant-header-title'] = $settings['restaurant-header-title'] ? $settings['restaurant-header-title'] : '';
        $params['restaurant-header-description'] = $settings['restaurant-header-description'] ? $settings['restaurant-header-description'] : '';
        $params['restaurants-in-numbers'] = $settings['restaurants-in-numbers'] ? $settings['restaurants-in-numbers'] : '';
        $params['cols-in-row'] = $settings['cols-in-row'] ? $settings['cols-in-row'] : '';
        $params['restaurants-btn-title'] = $settings['restaurants-btn-title'] ? $settings['restaurants-btn-title'] : '';
        $params['restaurants-btn-link'] = $settings['restaurants-btn-link']['url'] ? $settings['restaurants-btn-link']['url'] : '';
        echo $this->simple_grid_restaurants($params);
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


    public function simple_grid_restaurants($params)
    {
        $foodota_text_color=$params['food-heading-Scheme'];
        $header_design = $params['header-design'];
        $header_heading_title = $params['restaurant-header-title'];
        $header_heading_description = $params['restaurant-header-description'];
        $restaurants_in_numbers = $params['restaurants-in-numbers'];
        $restaurant_in_row = $params['cols-in-row'];
        $view_btn_title = $params['restaurants-btn-title'];
        $view_btn_link = $params['restaurants-btn-link'];
        $target_one = isset($params['target_one']) ? $params['target_one'] : '';
        $nofollow_one = isset($params['nofollow_one']) ? $params['nofollow_one'] : '';
        $button_modren_html = '';


        if ($view_btn_title != '' && $view_btn_link != '') {
            $button_modren = foodota_elementor_button_link($target_one, $nofollow_one, $view_btn_title, $view_btn_link, 'btn btn-theme', 'fa fa-cutlery');
        }

        $number = $restaurants_in_numbers;//$food_pagination; //max display per page
        $args = array(
            'number' => $number,
            'role' => 'wcfm_vendor',
            'fields' => array('ID', 'user_login', 'user_email')
        );
        $query = get_users($args);//query the maximum users that we will be displaying
        $res_html = '';
        if (is_array($query)) {
            foreach ($query as $agent_data) {
                $res_html .= ' <div class="eq-height col-xl-'.$restaurant_in_row.' col-lg-6 col-md-6">' . foodota_all_restaurant_function($agent_data->ID, 'grid-view') . '</div>';
            }
        }
        if ($header_design != '') {
            $heading_design_type = foodota_elementor_header_design($header_design, $header_heading_title, $header_heading_description, '');
        }
        if ($header_design == 'modern') {

            $button_modren_html = '<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12"><div class="res-detail-btn">
             ' . $button_modren . '
                     </div>
                    </div>';
        }
        if ($header_design == 'classic') {
            $button_modren_html = '';
        }

        return '<section class="res-2-featured bg-color cols-padding '.$foodota_text_color.'">
              <div class="container">
                <div class="row">
                  <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
                   ' . $heading_design_type . '
                  </div>
                  
                  <div class="col-xl-12 col-lg-12 col-xxl-12 col-md-12">
                    <div class="row">
                      ' . $res_html . '
                    </div>
                  </div>
                  ' . $button_modren_html . '
                </div>
              </div>
         </section>';
    }
}