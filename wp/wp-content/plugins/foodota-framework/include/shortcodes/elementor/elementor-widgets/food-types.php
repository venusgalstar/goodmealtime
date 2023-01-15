<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Foodtypes extends Widget_Base
{
    public function get_name()
    {
        return 'restaurant-food-types';
    }

    public function get_title()
    {
        return __('Restaurant-Food-Types', 'foodota-framework');
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
            'food-type',
            [
                'label' => __('Foodota Food type Restaurants', 'foodota-framework'),
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
        $foodota_text_color = $params['food-heading-Scheme'];
        $header_design = $params['header-design'];
        $header_heading_title = $params['restaurant-header-title'];
        $header_heading_description = $params['restaurant-header-description'];
        $restaurants_in_numbers = $params['restaurants-in-numbers'];
        $button_modren_html = '';

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
                $res_html .= '<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6">' . foodota_samll_view_restaurant($agent_data->ID, 'food-cat-view') . '</div>';
            }
        }
        if ($header_design != '') {
            $heading_design_type = foodota_elementor_header_design($header_design, $header_heading_title, $header_heading_description, '');
        }
        return '<section class="res-r section-padding-x ' . $foodota_text_color . '">
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