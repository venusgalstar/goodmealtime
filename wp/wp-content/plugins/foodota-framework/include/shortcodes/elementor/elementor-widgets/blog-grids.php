<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Bloggrid extends Widget_Base
{

    public function get_name()
    {
        return 'blog-grids';
    }

    public function get_title()
    {
        return __('Blog-Grid', 'foodota-framework');
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
            'blog-grid',
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
                'label' => __('Blog Post Cols in row', 'foodota-framework'),
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

        $this->end_controls_section();
    }

    protected function render()
    {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();
        $params['food-heading-Scheme'] = $settings['food-heading-Scheme'] ? $settings['food-heading-Scheme'] : '';
        $params['restaurant-header-title'] = $settings['restaurant-header-title'] ? $settings['restaurant-header-title'] : '';
        $params['restaurant-header-description'] = $settings['restaurant-header-description'] ? $settings['restaurant-header-description'] : '';
        $params['restaurants-in-numbers'] = $settings['restaurants-in-numbers'] ? $settings['restaurants-in-numbers'] : '';
        $params['cols-in-row'] = $settings['cols-in-row'] ? $settings['cols-in-row'] : '';
        echo $this->blog_grid($params);
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
    public function blog_grid($params)
    {
        $foodota_text_color = $params['food-heading-Scheme'];
        $header_heading_title = $params['restaurant-header-title'];
        $header_heading_description = $params['restaurant-header-description'];
        $restaurants_in_numbers = $params['restaurants-in-numbers'];
        $post_in_row = $params['cols-in-row'];
        $number = $restaurants_in_numbers;//$food_pagination; //max display per page
        $res_html = '';
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $number
        );
        $query = new \WP_Query($args);


        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $res_html .= ' <div class="eq-height col-xxl-' . $post_in_row . ' col-xl-' . $post_in_row . ' col-lg-6 col-md-6 col-sm-12 row-col-3 margin-bottom-30">' . foodota_blog_post(get_the_ID(), '') . '</div>';

            }
            wp_reset_postdata();
        }

        return '<section class="res-lat-blog ' . $foodota_text_color . '">
            <div class="container">
            <div class="row">
            <div class="col-lg-12 col-xxl-12 col-xl-12 col-sm-12">
                    <div class="heading-minimal">
                       <div class="sub-title">' . $header_heading_description . '</div>
                       <h3 class="head-title">' . $header_heading_title . '</h3>
                <div class="bottom-dots  clearfix">
                    <span class="dot line-dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
            </div>
             '.$res_html.'
            </div>
            </div>
            </section>';
    }
}