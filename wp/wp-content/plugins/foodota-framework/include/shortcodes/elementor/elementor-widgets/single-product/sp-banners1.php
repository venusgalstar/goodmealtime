<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Spbanners1 extends Widget_Base
{
    public function get_name()
    {
        return 'single-product-banners';
    }

    public function get_title()
    {
        return __('Single Products Banners one', 'foodota-framework');
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
            'sp-banner-one',
            [
                'label' => __('Single Product Banners one', 'foodota-framework'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'sp-banner-img1',
            [
                'label' => __('Single Product Banner images 1', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->add_control(
            'sp-banner-img1-link1',
            [
                'label' => __('Banner Image one url', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('https://marketplace.foodotawp.com/', 'foodota-framework'),
                'placeholder' => __('Give your Banner url here!', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'sp-banner-img2',
            [
                'label' => __('Single Product Banner images 2', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->add_control(
            'sp-banner-img2-link2',
            [
                'label' => __('Banner Image two url', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('https://marketplace.foodotawp.com/', 'foodota-framework'),
                'placeholder' => __('Give your Banner url here!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'sp-banner-img3',
            [
                'label' => __('Single Product Banner images 3', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->add_control(
            'sp-banner-img3-link3',
            [
                'label' => __('Banner Image three url', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('https://marketplace.foodotawp.com/', 'foodota-framework'),
                'placeholder' => __('Give your Banner url here!', 'foodota-framework'),
            ]
        );



        $this->end_controls_section();
    }

    protected function render()
    {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();
        $params['sp-sub-1'] = $settings['sp-banner-img1']['id'] ? $settings['sp-banner-img1']['id'] : '';
        $params['sp-banner-img1-url'] = $settings['sp-banner-img1']['url'] ? $settings['sp-banner-img1']['url'] : '';
        $params['sp-banner-img1-link1'] = $settings['sp-banner-img1-link1'] ? $settings['sp-banner-img1-link1'] : '';
        $params['sp-banner-img2'] = $settings['sp-banner-img2']['id'] ? $settings['sp-banner-img2']['id'] : '';
        $params['sp-banner-img2-url'] = $settings['sp-banner-img2']['url'] ? $settings['sp-banner-img2']['url'] : '';
        $params['sp-banner-img2-link2'] = $settings['sp-banner-img2-link2'] ? $settings['sp-banner-img2-link2'] : '';
        $params['sp-banner-img3'] = $settings['sp-banner-img3']['id'] ? $settings['sp-banner-img3']['id'] : '';
        $params['sp-banner-img3-url'] = $settings['sp-banner-img3']['url'] ? $settings['sp-banner-img3']['url'] : '';
        $params['sp-banner-img3-link3'] = $settings['sp-banner-img3-link3'] ? $settings['sp-banner-img3-link3'] : '';
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
        $sp_banner_image1_id = $params['sp-sub-1'];
        $sp_banner_image1_url =  $params['sp-banner-img1-url'];
        $sp_banner_image1_link1 = $params['sp-banner-img1-link1'];
        $sp_banner_image2_id = $params['sp-banner-img2'];
        $sp_banner_image2_url =  $params['sp-banner-img2-url'];
        $sp_banner_image2_link2 = $params['sp-banner-img2-link2'];
        $sp_banner_image3_id = $params['sp-banner-img3'];
        $sp_banner_image3_url =  $params['sp-banner-img3-url'];
        $sp_banner_image3_link3 = $params['sp-banner-img3-link3'];
        return '    <section class="services-products">
       <div class="container">
          <div class="row">
             <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <div class="row">
                   <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                      <div class="product-img margin-bottom-30">
                       <a href="'.esc_url($sp_banner_image1_link1).'">  <img class="left-img" src="'.esc_url($sp_banner_image1_url). '" alt="'. esc_attr($sp_banner_image1_id) .'"></a>
                      </div>
                   </div>
                   <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                      <div class="product-img margin-bottom-30">
                      <a href="'.esc_url($sp_banner_image2_link2).'"> 
                         <img class="center-img" src="'.esc_url($sp_banner_image2_url). '" alt="'. esc_attr($sp_banner_image2_id) .'">
                      </a>
                      </div>
                   </div>
                   <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                      <div class="product-img margin-bottom-30">
                         <a href="'.esc_url($sp_banner_image3_link3).'"> 
                         <img class="right-img" src="'.esc_url($sp_banner_image3_url). '" alt="'. esc_attr($sp_banner_image3_id) .'">
                         </a>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>
';
    }
}
