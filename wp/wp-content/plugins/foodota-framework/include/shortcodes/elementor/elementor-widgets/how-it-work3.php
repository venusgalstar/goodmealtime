<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Howitwork3 extends Widget_Base
{

    public function get_name()
    {
        return 'foodota-how-work3';
    }

    public function get_title()
    {
        return __('Foodota-how-work3', 'foodota-framework');
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
            'food-how-work3',
            [
                'label' => __('Foodota How It Work', 'foodota-framework'),
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
            'section-bg',
            [
                'label' => __('How its work section Background', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );


        $this->add_control(
            'restaurant-header-title',
            [
                'label' => __('Restaurants Header Title', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Simple Process', 'foodota-framework'),
                'placeholder' => __('Type your Restaurants Title Here!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'restaurant-header-description',
            [
                'label' => __('Restaurant Header Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('How It Works', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'how-work-imag1',
            [
                'label' => __('Its work image-1', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );

        $this->add_control(
            'how-work-title1',
            [
                'label' => __('Its work title-1', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Your Order', 'foodota-framework'),
                'placeholder' => __('Type your Restaurants Title Here!', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'how-work-description1',
            [
                'label' => __('Its work description-1', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Quis ipsum suspeisse ultrices gravida. Risus comabore et dolore ma', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );


        $this->add_control(
            'how-work-imag2',
            [
                'label' => __('Its work image-2', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );

        $this->add_control(
            'how-work-title2',
            [
                'label' => __('Its work title-2', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Cash Delivery / Online Transfer', 'foodota-framework'),
                'placeholder' => __('Type your Restaurants Title Here!', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'how-work-description2',
            [
                'label' => __('Its work description-2', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Quis ipsum suspeisse ultrices gravida. Risus comabore et dolore ma', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );


        $this->add_control(
            'how-work-imag3',
            [
                'label' => __('Its work image-3', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );

        $this->add_control(
            'how-work-title3',
            [
                'label' => __('Its work title-3', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Receive Order', 'foodota-framework'),
                'placeholder' => __('Type your Restaurants Title Here!', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'how-work-description3',
            [
                'label' => __('Its work description-3', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Quis ipsum suspeisse ultrices gravida. Risus comabore et dolore ma', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();
        $params['food-heading-Scheme'] = $settings['food-heading-Scheme'] ? $settings['food-heading-Scheme'] : '';
        $params['section-bg'] = $settings['section-bg']['url'] ? $settings['section-bg']['url'] : '';
        $params['restaurant-header-title'] = $settings['restaurant-header-title'] ? $settings['restaurant-header-title'] : '';
        $params['restaurant-header-description'] = $settings['restaurant-header-description'] ? $settings['restaurant-header-description'] : '';
        $params['how-work-imag1'] = $settings['how-work-imag1']['url'] ? $settings['how-work-imag1']['url'] : '';
        $params['how-work-imag1_id'] = $settings['how-work-imag1']['id'] ? $settings['how-work-imag1']['id'] : '';
        $params['how-work-title1'] = $settings['how-work-title1'] ? $settings['how-work-title1'] : '';
        $params['how-work-description1'] = $settings['how-work-description1'] ? $settings['how-work-description1'] : '';
        $params['how-work-imag2'] = $settings['how-work-imag2']['url'] ? $settings['how-work-imag2']['url'] : '';
        $params['how-work-imag2_id'] = $settings['how-work-imag2']['id'] ? $settings['how-work-imag2']['id'] : '';
        $params['how-work-title2'] = $settings['how-work-title2'] ? $settings['how-work-title2'] : '';
        $params['how-work-description2'] = $settings['how-work-description2'] ? $settings['how-work-description2'] : '';
        $params['how-work-imag3'] = $settings['how-work-imag3']['url'] ? $settings['how-work-imag3']['url'] : '';
        $params['how-work-imag3_id'] = $settings['how-work-imag3']['id'] ? $settings['how-work-imag3']['id'] : '';
        $params['how-work-title3'] = $settings['how-work-title3'] ? $settings['how-work-title3'] : '';
        $params['how-work-description3'] = $settings['how-work-description3'] ? $settings['how-work-description3'] : '';
        echo $this->how_it_works($params);

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


    public function how_it_works($params)
    {
        //$slider_images = $params['hero_slider_images'];
        global $foodota_options;
        $foodota_text_color = $params['food-heading-Scheme'];
        $section_bg = $params['section-bg'];
        $header_heading_title = $params['restaurant-header-title'];
        $header_heading_description = $params['restaurant-header-description'];
        $work_imag_1 = $params['how-work-imag1'];
        $work_imag_id_1 = $params['how-work-imag1_id'];
        $work_title_1 = $params['how-work-title1'];
        $work_des_1 = $params['how-work-description1'];
        $work_imag_2 = $params['how-work-imag2'];
        $work_imag_id_2 = $params['how-work-imag2_id'];
        $work_title_2 = $params['how-work-title2'];
        $work_des_2 = $params['how-work-description2'];
        $work_imag_3 = $params['how-work-imag3'];
        $work_imag_id_3 = $params['how-work-imag3_id'];
        $work_title_3 = $params['how-work-title3'];
        $work_des_3 = $params['how-work-description3'];
        $same_image_id = '';
        return '<section class="how-it-work-section parallex-works  section-padding ' . $foodota_text_color . '" style="background: rgba(0, 0, 0, 0) url(' . $section_bg . ') center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
		  <div class="container">
			<div class="row">
			   <div class="col-md-12 col-sm-12 col-xs-12">
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
			   <div class="clearfix"></div>
			</div>
		  </div>
		</section>
		<div class="extra-points"><div class="container"><div class="hiw-main-box">
		<div class="row gx-0">
					<div class="col-lg-4 col-xs-12 col-md-12 col-sm-12">
					  <div class="hiw-single-box border-right">
							<div class="hiw-img-box">
									      <div class="hiw-count">' . esc_html__('01', 'foodota-framework') . ' </div>
									  <div class="hiw-img-2"> <img src="' . $work_imag_1 . '" class="img-responsive" alt="' . esc_attr__($work_imag_id_1, 'foodota-framework') . '"> </div>
            					  </div>
							<div class="hiw-text-box">
							  <div class="hiw-heading"><h2>' . $work_title_1 . '</h2></div>
							   <div class="hiw-details-text"><p>' . $work_des_1 . '</p></div>
							</div>
						</div>
				</div><div class="col-lg-4 col-xs-12 col-md-12 col-sm-12">
					  <div class="hiw-single-box border-right">
							<div class="hiw-img-box">
									      <div class="hiw-count"> ' . esc_html__('02', 'foodota-framework') . '  </div>
									  <div class="hiw-img-2"> <img src="' . $work_imag_2 . '" class="img-responsive" alt="' . esc_attr__($work_imag_id_2, 'foodota-framework') . '"> </div>
            					  </div>
							<div class="hiw-text-box">
							  <div class="hiw-heading"><h2>' . $work_title_2 . '</h2></div>
							   <div class="hiw-details-text"><p>' . $work_des_2 . '</p></div>
							</div>
						</div>
				</div><div class="col-lg-4 col-xs-12 col-md-12 col-sm-12">
					  <div class="hiw-single-box">
							<div class="hiw-img-box">
									      <div class="hiw-count"> ' . esc_html__('03', 'foodota-framework') . '  </div>
									  <div class="hiw-img-2"> <img src="' . $work_imag_3 . '" class="img-responsive" alt="' . esc_attr__($work_imag_id_3, 'foodota-framework') . '"> </div>
            					  </div>
							<div class="hiw-text-box">
							  <div class="hiw-heading"><h2>' . $work_title_3 . '</h2></div>
							   <div class="hiw-details-text"><p>' . $work_des_3 . '</p></div>
							</div>
						</div>
				</div>
		</div></div></div></div>
		<div class="clearfix"></div>
		';
    }
}