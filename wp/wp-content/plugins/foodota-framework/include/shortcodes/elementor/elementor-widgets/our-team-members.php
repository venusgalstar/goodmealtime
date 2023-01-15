<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Ourteam extends Widget_Base
{

    public function get_name()
    {
        return 'foodota-team-members';
    }

    public function get_title()
    {
        return __('Foodota-Team-Members', 'foodota-framework');
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
            'food-team-members',
            [
                'label' => __('Foodota Team Members', 'foodota-framework'),
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
                'default' => __('Meet Our Best Team', 'foodota-framework'),
                'placeholder' => __('Type your Restaurants Title Here!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'restaurant-header-description',
            [
                'label' => __('Restaurant Header Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Content here content here making it look like readable English', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'team-member-imag',
            [
                'label' => __('Team Member Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );

        $repeater->add_control(
            'team-member-title',
            [
                'label' => __('Team Member Title', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Alizeh Anderson', 'foodota-framework'),
                'placeholder' => __('Tema Member Title Here!', 'foodota-framework'),
            ]
        );
        $repeater->add_control(
            'team-member-post',
            [
                'label' => __('Team Member Post', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Alizeh Anderson', 'foodota-framework'),
                'placeholder' => __('Tema Member Post Title Here!', 'foodota-framework'),]
        );

        $this->add_control(
            'team_member_repeater',
            [
                'label' => __('Team Mebers Repeater', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'team-member-imag' => '',
                        'team-member-title' => '',
                        'team-member-post' => '',
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
        $params['restaurant-header-title'] = $settings['restaurant-header-title'] ? $settings['restaurant-header-title'] : '';
        $params['restaurant-header-description'] = $settings['restaurant-header-description'] ? $settings['restaurant-header-description'] : '';
        $params['team_member_repeater'] = $settings['team_member_repeater'] ? $settings['team_member_repeater'] : array();
        echo $this->team_members($params);

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


    public function team_members($params)
    {
        //$slider_images = $params['hero_slider_images'];
        global $foodota_options;
        $foodota_text_color = $params['food-heading-Scheme'];
        $header_heading_title = $params['restaurant-header-title'];
        $header_heading_description = $params['restaurant-header-description'];
        $restaurant_team_repeater = $params['team_member_repeater'];
        $team_html = '';
        if ($restaurant_team_repeater) {
            foreach ($restaurant_team_repeater as $item) {
                $team_image = foodota_get_attch_url($item['team-member-imag']['id'], 'full');
                $team_title = $item['team-member-title'];
                $team_post = $item['team-member-post'];

                if ($team_image != '') {
                    $team_html .= '<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-12 row-col-3 margin-bottom-30">
                <div class="main-team-box">
                    <div class="image-box">
                        <a href="#">
                            <img src="' . $team_image . '" alt="' . esc_attr__('icon', 'foodota-framework') . '" class="img-fluid">
                        </a>
                        <div class="social-box">
                            <div class="res-f-social">
                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="#"> <i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="text-box">
                        <h3>' . $team_title . '</h3>
                        <p>' . $team_post . '</p>
                    </div>
                </div>
            </div>';
                }
            }
        }
        return '<section class="our-team cols-padding ' . $foodota_text_color . '">
          <div class="container">
            <div class="row">
              <div class="col-xxl-12 col-xl-12 col-lg-12">
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
               ' . $team_html . '	
            </div>
          </div>
     </section>';
    }
}