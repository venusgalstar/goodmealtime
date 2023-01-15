<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Spbanners2 extends Widget_Base
{
    public function get_name()
    {
        return 'single-product-banners2';
    }

    public function get_title()
    {
        return __('Single Products Banners two', 'foodota-framework');
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
            'sp-banner-two',
            [
                'label' => __('Single Product Banners two', 'foodota-framework'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'cols-in-row',
            [
                'label' => __('Banner Cols in row', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '6' => __('Two Cols in row', 'foodota-framework'),
                    '4' => __('Three Cols in row', 'foodota-framework'),
                    '3' => __('Four Cols in row', 'foodota-framework'),
                ],
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'sp-banner-img1',
            [
                'label' => __('Select Product Banner Images', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $repeater->add_control(
            'sp-banner-links',
            [
                'label' => __('Banner Images Link', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('https://marketplace.foodotawp.com/', 'foodota-framework'),
                'placeholder' => __('Give your banner image link', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'sp_banner1_repeater',
            [
                'label' => __('Product Banner Images', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'sp-banner-img1' => '',
                        'sp-banner-links' => '',
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
        $params['cols-in-row'] = $settings['cols-in-row'] ? $settings['cols-in-row'] : '';
        $params['sp_banner1_repeater'] = $settings['sp_banner1_repeater'] ? $settings['sp_banner1_repeater'] : array();
        echo $this->foodota_elementor_hero_search1($params);
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
    public function foodota_elementor_hero_search1($params)
    {
        global $foodota_options;
        $banner_in_row = $params['cols-in-row'];
        $product_banner_repeater = $params['sp_banner1_repeater'];
        $banner_html = '';
        $count = 1;

        if ($product_banner_repeater) {
            foreach ($product_banner_repeater as $item) {
                $banner_image_url = foodota_get_attch_url($item['sp-banner-img1']['id'], 'full');
                $banner_image_id = $item['sp-banner-img1']['id'];
                $banner_image_link = $item['sp-banner-links'];

                if ($banner_image_url != '') {
                    $banner_html .= '<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-'.$banner_in_row.' col-xxl-'. $banner_in_row.'">
                         <div class="menu-card">
                            <a href="'.esc_url($banner_image_link).'">
                            <img class="img-'.$count.'" src="'.esc_url($banner_image_url).'" alt="'.esc_attr($banner_image_id).'">
                            </a>   
                         </div>
                      </div>';
                }

                $count++;
            }
        }




        return '<section class="product-menu">
       <div class="container">
          <div class="row">
             <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <div class="menu-grid">
                   <div class="row">
                   '.$banner_html.'
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>';
    }
}
