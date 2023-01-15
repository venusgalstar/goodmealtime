<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class priceplans extends Widget_Base
{
    public function get_name()
    {
        return 'price-plans';
    }

    public function get_title()
    {
        return __('Restaurant Price Plans', 'foodota-framework');
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
            'price-plan',
            [
                'label' => __('Restaurant Price Plan', 'foodota-framework'),
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
                'default' => 'modern',
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


        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'price-plan-title',
            [
                'label' => __('Price Plan Title', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Bacics Plan', 'foodota-framework'),
                'placeholder' => __('Type your Plan heading Here!', 'foodota-framework'),
            ]
        );

        $repeater->add_control(
            'price-plan-description',
            [
                'label' => __('Price Plan Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Various versions have evolved over the years sometimes', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );
        $repeater->add_control(
            'plan-price',
            [
                'label' => __('Plan Price', 'foodota-framework'),
                'default' => __('Plan Price', 'foodota-framework'),
                'placeholder' => __('Type your Plan Price!', 'foodota-framework'),
            ]
        );

        $repeater->add_control(
            'price-plan-currency',
            [
                'label' => __('Price Plan Currency', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('$', 'foodota-framework'),
                'placeholder' => __('Type your Plan currency!', 'foodota-framework'),
            ]
        );
        $repeater->add_control(
            'price-plan-duration',
            [
                'label' => __('Price Plan Duration', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'monthly',
                'options' => [
                    'monthly' => __('monthly', 'foodota-framework'),
                    'yearly' => __('yearly', 'foodota-framework'),
                ],

            ]
        );


        $repeater->add_control(
            'price-plan-lies',
            [
                'label' => __('Price Plan Text', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'monthly',
            ]
        );


        $repeater->add_control(
            'price-btn-title',
            [
                'label' => __('Price Plan Button Title', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('price plan button title', 'foodota-framework'),
                'default' => __('Get Started', 'foodota-framework'),
                'label_block' => true
            ]
        );
        $repeater->add_control(
            'price-btn-link',
            [
                'label' => __('Price Plan Button Link', 'foodota-framework'),
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
            'price-plan-repeater',
            [
                'label' => __('Rrice Plan Repeater', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'price-plan-title' => '',
                        'price-plan-description' => '',
                        'plan-price' => '',
                        'price-plan-currency' => '',
                        'price-plan-duration' => '',
                        'price-plan-lies' => '',
                        'price-btn-title' => '',
                        'price-btn-link' => '',
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
        $params['header-design'] = $settings['header-design'] ? $settings['header-design'] : '';
        $params['restaurant-header-title'] = $settings['restaurant-header-title'] ? $settings['restaurant-header-title'] : '';
        $params['restaurant-header-description'] = $settings['restaurant-header-description'] ? $settings['restaurant-header-description'] : '';
        $params['price-plan-repeater'] = $settings['price-plan-repeater'] ? $settings['price-plan-repeater'] : array();
        echo $this->foodota_price_plans($params);
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


    public function foodota_price_plans($params)
    {
        $foodota_text_color = $params['food-heading-Scheme'];
        $header_design = $params['header-design'];
        $header_heading_title = $params['restaurant-header-title'];
        $header_heading_description = $params['restaurant-header-description'];
        $price_repeater = $params['price-plan-repeater'];
        $button_classic = '';
        if ($header_design != '') {
            $heading_design_type = foodota_elementor_header_design($header_design, $header_heading_title, $header_heading_description, $button_classic);
        }
        $price_btn_html = '';
        $price_plan_html = '';


        if ($price_repeater) {
            $counter = 0;
            foreach ($price_repeater as $item) {

                $active_plan = '';
                if ($counter == 1) {

                    $active_plan = 'res-hs-2';

                }

                $price_title = $item['price-plan-title'];
                $price_description = $item['price-plan-description'];
                $plan_price = $item['plan-price'];
                $plan_currency = $item['price-plan-currency'];
                $plan_duration = $item['price-plan-duration'];
                $plan_lies = $item['price-plan-lies'];
                $button_btn_title = $item['price-btn-title'];
                $price_btn_link = $item['price-btn-link']['url'];
                $target_one = isset($item['target_one']) ? $item['target_one'] : '';
                $nofollow_one = isset($item['nofollow_one']) ? $item['nofollow_one'] : '';

                if ($button_btn_title != '' && $price_btn_link != '') {
                    $price_btn_html = foodota_elementor_button_link($target_one, $nofollow_one, $button_btn_title, $price_btn_link, 'btn btn-theme price-action', '');
                }


                $counter_description = isset($item['counter_description']) ? $item['counter_description'] : '';

                $price_plan_html .= '<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-xs-12 col-sm-12">
                                        <div class="res-hd ' . $active_plan . '">
                                        <div class="res-pric-main">
                                            <div class="res-pric-product">
                                                <h3>' . $price_title . '</h3>
                                                <p>' . $price_description . '</p>
                                            </div>
                                            <div class="res-pric-lg">
                                                <p>' . $plan_price . '<span>' . $plan_currency . '/' . $plan_duration . '</span></p>
                                            </div>
                                            <div class="res-pric-list">
                                              ' . $plan_lies . '
                                            </div>
                                            </div>
                                            ' . $price_btn_html . '
                                        </div>
                                    </div>';
                $counter++;
            }
        }

        return '	<section class="res-pric-tble section-padding-v ' . $foodota_text_color . '">
                        <div class="container">
                            <div class="row">
                                <div class="col-xxl-12 col-xl-12 col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                     ' . $heading_design_type . '
                                </div>
                                ' . $price_plan_html . '
                            </div>
                        </div>
                    </section>';
    }
}