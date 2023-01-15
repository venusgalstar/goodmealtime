<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Experiencesences extends Widget_Base
{
    public function get_name()
    {
        return 'foodota-experience';
    }

    public function get_title()
    {
        return __('Restaurant-Experience', 'foodota-framework');
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
            'foodota-experience',
            [
                'label' => __('Restaurant Experience Tab', 'foodota-framework'),
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
            'experience-top-heading',
            [
                'label' => __('Experience Top Heading', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Our Best About Us', 'foodota-framework'),
                'placeholder' => __('Type Your Top Heading!', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'experience-bottom-heading',
            [
                'label' => __('Experience bottom Heading', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('An Experience For Your Senses', 'foodota-framework'),
                'placeholder' => __('Type Your bottom Heading!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'experience-heading-description',
            [
                'label' => __('Experience Heading Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 3,
                'default' => __('Over 19 years of proving the very best vegan and plant based food to london', 'foodota-framework'),
                'placeholder' => __('Type your Heading Description here', 'foodota-framework'),
            ]
        );


        $this->add_control(
            'experience-btn1-title',
            [
                'label' => __('Read More', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Button title here', 'foodota-framework'),
                'default' => __('Read More', 'foodota-framework'),
                'label_block' => true
            ]
        );
        $this->add_control(
            'experience-btn1-link',
            [
                'label' => __('Read More button link', 'foodota-framework'),
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
            'experience-btn2-title',
            [
                'label' => __('Search Now', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Button title here', 'foodota-framework'),
                'default' => __('Search Now', 'foodota-framework'),
                'label_block' => true
            ]
        );
        $this->add_control(
            'experience-btn2-link',
            [
                'label' => __('Search Now button link', 'foodota-framework'),
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
            'bike-bg',
            [
                'label' => __('Delivery image', 'foodota-framework'),
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
        $params['experience-top-heading'] = $settings['experience-top-heading'] ? $settings['experience-top-heading'] : '';
        $params['experience-bottom-heading'] = $settings['experience-bottom-heading'] ? $settings['experience-bottom-heading'] : '';
        $params['experience-heading-description'] = $settings['experience-heading-description'] ? $settings['experience-heading-description'] : '';
        $params['read-more-title'] = $settings['experience-btn1-title'] ? $settings['experience-btn1-title'] : '';
        $params['read-more-link'] = $settings['experience-btn1-link']['url'] ? $settings['experience-btn1-link']['url'] : '';
        $params['search-now-title'] = $settings['experience-btn2-title'] ? $settings['experience-btn2-title'] : '';
        $params['search-now-link'] = $settings['experience-btn2-link']['url'] ? $settings['experience-btn2-link']['url'] : '';
        $params['bike-id'] = $settings['bike-bg']['id'] ? $settings['bike-bg']['id'] : '';
        $params['bike-url'] = $settings['bike-bg']['url'] ? $settings['bike-bg']['url'] : '';
        echo $this->foodota_experience($params);
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


    public function foodota_experience($params)
    {
        $foodota_text_color=$params['food-heading-Scheme'];
        $exp_top_heading = $params['experience-top-heading'];
        $exp_bottom_heading = $params['experience-bottom-heading'];
        $exp_heading_des = $params['experience-heading-description'];
        $read_more_title = $params['read-more-title'];
        $read_more_link = $params['read-more-link'];
        $target_one = isset($params['target_one']) ? $params['target_one'] : '';
        $nofollow_one = isset($params['nofollow_one']) ? $params['nofollow_one'] : '';
        $search_now_title = $params['search-now-title'];
        $search_now_link = $params['search-now-link'];
        $target_two = isset($params['target_two']) ? $params['target_two'] : '';
        $nofollow_two = isset($params['nofollow_two']) ? $params['nofollow_two'] : '';
        $bike_id = $params['bike-id'];
        $bike_url = $params['bike-url'];
        if ($read_more_title != '' && $read_more_link != '') {
            $button_read_more = foodota_elementor_button_link($target_one, $nofollow_one, $read_more_title, $read_more_link, 'btn btn-theme');
        }

        if ($search_now_title != '' && $search_now_link != '') {
            $button_search_now = foodota_elementor_button_link($target_two, $nofollow_two, $search_now_title, $search_now_link, 'btn btn-theme');
        }
        return '<section class="experience-section experience2 '.$foodota_text_color.'">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 align-self-center">
                        <div class="main-text-box">
                            <div class="res-exp-text">
                                <div class="sub-title">' . $exp_top_heading . '</div>
                                <h2>' . $exp_bottom_heading . '</h2>
                                <div class="bottom-dots  clearfix">
                                <span class="dot line-dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                                </div>
                                 <p class="style-p">' . $exp_heading_des . '</p>
                                <ul class="buttton-exp">
                                    <li>' . $button_read_more . '</li>
                                    <li class="bg-black">' . $button_search_now . '</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="scotor-img">
                            <img src="' . $bike_url . '" alt="' . esc_attr__($bike_id, 'foodota-framework') . '" class="img-fluid"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>';
    }
}