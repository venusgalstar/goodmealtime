<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Sphero1 extends Widget_Base
{
    public function get_name()
    {
        return 'single-product-hero1';
    }

    public function get_title()
    {
        return __('Single Product Hero Section 1', 'foodota-framework');
    }

    public function get_icon()
    {
        return 'eicon-site-search';
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
            'sp-hero-one',
            [
                'label' => __('Single Product Hero one', 'foodota-framework'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'main-heading-top',
            [
                'label' => __('Main Heading Top', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Special kombo Pack', 'foodota-framework'),
                'placeholder' => __('Special kombo Pack', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'main-heading-top-color',
            [
                'label' => __( 'Heading Top Color', 'foodota-framework' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                 'selectors' => [
                    '.fodo-top-banner .banner-txt-meta h1' => 'color: {{value}}',
                ],
            ]
        );


        $this->add_control(
            'main-heading-bottom',
            [
                'label' => __('Main Heading bottom', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Today’s Special Pizza Menu', 'foodota-framework'),
                'placeholder' => __('Today’s Special Pizza Menu', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'main-heading-bottom-color',
            [
                'label' => __( 'Main Heading Color', 'foodota-framework' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '.fodo-top-banner .banner-txt-meta h2' => 'color: {{value}}',
                ],
            ]
        );
        $this->add_control(
            'main-heading-description',
            [
                'label' => __('Search Hero Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet sem neque sed ipsum.', 'foodota-framework'),
                'placeholder' => __('Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet sem neque sed ipsum.', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'main-heading-description-color',
            [
                'label' => __( 'Main Heading Description color', 'foodota-framework' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '.fodo-top-banner .banner-txt-meta p' => 'color: {{value}}',
                ],
            ]
        );
        $this->add_control(
            'sp-btn-title-hero1',
            [
                'label' => __('Order Now Button Title', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Button title here', 'foodota-framework'),
                'default' => __('Order Now', 'foodota-framework'),
                'label_block' => true
            ]
        );
        $this->add_control(
            'sp-btn-title-hero1-link',
            [
                'label' => __('Order Now Button Link', 'foodota-framework'),
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
            'real-price',
            [
                'label' => __('real price', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('52.00', 'foodota-framework'),
                'placeholder' => __('Give your Real price', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'sale-price',
            [
                'label' => __('Sale price', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('35.99', 'foodota-framework'),
                'placeholder' => __('Give your Sale price', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'sp-bone-img',
            [
                'label' => __('Main Hero bone side Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->add_control(
            'sp-mint-image',
            [
                'label' => __('Main Hero mint image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->add_control(
            'sp-main-img',
            [
                'label' => __('Main Hero Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->add_control(
            'sp-off-img',
            [
                'label' => __('Main Hero Off Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->add_control(
            'sp-sub-1',
            [
                'label' => __('Main Sub image 1', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->add_control(
            'sp-sub-2',
            [
                'label' => __('Main Sub image 2', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->add_control(
            'sp-sub-3',
            [
                'label' => __('Main Sub image 3', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->add_control(
            'sp-sub-4',
            [
                'label' => __('Main Sub image 4', 'foodota-framework'),
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
        $params['main-heading-top'] = $settings['main-heading-top'] ? $settings['main-heading-top'] : '';
        $params['main-heading-bottom'] = $settings['main-heading-bottom'] ? $settings['main-heading-bottom'] : '';
        $params['main-heading-description'] = $settings['main-heading-description'] ? $settings['main-heading-description'] : '';
        $params['sp-btn-title-hero1'] = $settings['sp-btn-title-hero1'] ? $settings['sp-btn-title-hero1'] : '';
        $params['sp-btn-title-hero1-link'] = $settings['sp-btn-title-hero1-link']['url'] ? $settings['sp-btn-title-hero1-link']['url'] : '';
        $params['target_one'] = $settings['sp-btn-title-hero1-link']['is_external'] ? ' target="_blank"' : '';
        $params['nofollow_one'] = $settings['sp-btn-title-hero1-link']['nofollow'] ? ' rel="nofollow"' : '';
        $params['real-price'] = $settings['real-price'] ? $settings['real-price'] : '';
        $params['sale-price'] = $settings['sale-price'] ? $settings['sale-price'] : '';
        $params['sp-bone-img_id'] = $settings['sp-bone-img']['id'] ? $settings['sp-bone-img']['id'] : '';
        $params['sp-bone-img-url'] = $settings['sp-bone-img']['url'] ? $settings['sp-bone-img']['url'] : '';
        $params['sp-mint-image_id'] = $settings['sp-mint-image']['id'] ? $settings['sp-mint-image']['id'] : '';
        $params['sp-mint-image-url'] = $settings['sp-mint-image']['url'] ? $settings['sp-mint-image']['url'] : '';
        $params['sp-main-img'] = $settings['sp-main-img']['id'] ? $settings['sp-main-img']['id'] : '';
        $params['sp-main-img-url'] = $settings['sp-main-img']['url'] ? $settings['sp-main-img']['url'] : '';
        $params['sp-off-img'] = $settings['sp-off-img']['id'] ? $settings['sp-off-img']['id'] : '';
        $params['sp-off-img-url'] = $settings['sp-off-img']['url'] ? $settings['sp-off-img']['url'] : '';
        $params['sp-sub-1'] = $settings['sp-sub-1']['id'] ? $settings['sp-sub-1']['id'] : '';
        $params['sp-sub-1-url'] = $settings['sp-sub-1']['url'] ? $settings['sp-sub-1']['url'] : '';
        $params['sp-sub-2'] = $settings['sp-sub-2']['id'] ? $settings['sp-sub-2']['id'] : '';
        $params['sp-sub-2-url'] = $settings['sp-sub-2']['url'] ? $settings['sp-sub-2']['url'] : '';
        $params['sp-sub-3'] = $settings['sp-sub-3']['id'] ? $settings['sp-sub-3']['id'] : '';
        $params['sp-sub-3-url'] = $settings['sp-sub-3']['url'] ? $settings['sp-sub-3']['url'] : '';
        $params['sp-sub-4'] = $settings['sp-sub-4']['id'] ? $settings['sp-sub-4']['id'] : '';
        $params['sp-sub-4-url'] = $settings['sp-sub-4']['url'] ? $settings['sp-sub-4']['url'] : '';


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
        $hero_main_heading_top = $params['main-heading-top'];
        $main_heading_bottom = $params['main-heading-bottom'];
        $main_heading_description = $params['main-heading-description'];
        $target_one = $params['target_one'];
        $nofollow_one = $params['nofollow_one'];
        $sp_btn_title = $params['sp-btn-title-hero1'];
        $sp_btn_link = $params['sp-btn-title-hero1-link'];
        $orgnal_price = $params['real-price'];
        $sale_price  =  $params['sale-price'];
        $sp_bone_image_id  = $params['sp-bone-img_id'];
        $sp_bone_image_url =  $params['sp-bone-img-url'];
        $sp_mint_image_id = $params['sp-mint-image_id'];
        $sp_mint_image_url =  $params['sp-mint-image-url'];
        $main_image_id = $params['sp-main-img'];
        $main_image_url=  $params['sp-main-img-url'];
        $sp_off_image_id = $params['sp-off-img'];
        $sp_off_image_url =  $params['sp-off-img-url'];
        $sp_sub_image1_id = $params['sp-sub-1'];
        $sp_sub_image1_url =  $params['sp-sub-1-url'];
        $sp_sub_image2_id = $params['sp-sub-2'];
        $sp_sub_image2_url =  $params['sp-sub-2-url'];
        $sp_sub_image3_id = $params['sp-sub-3'];
        $sp_sub_image3_url =  $params['sp-sub-3-url'];
        $sp_sub_image4_id = $params['sp-sub-4'];
        $sp_sub_image4_url =  $params['sp-sub-4-url'];
        if ($params['sp-btn-title-hero1'] != '' && $params['sp-btn-title-hero1-link'] != '') {
            $button_order_now = foodota_elementor_button_link($target_one, $nofollow_one, $sp_btn_title, $sp_btn_link, '');
        }
        return '<section class="fodo-top-banner">
        <img class="chicken-piece animate__slideInLeft" src="' . esc_url($sp_bone_image_url) . '" alt="'.esc_attr($sp_bone_image_id) .'">
      <div class="container">
         <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
               <div class="row">
                  <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 col-xxl-5">
                     <div class="top-banner-meta">
                        <div class="banner-txt-meta">
                           <h1>' . esc_html($hero_main_heading_top) . '</h1>
                           <h2>' . esc_html($main_heading_bottom) . '</h2>
                           <p>' . esc_html($main_heading_description) . '</p>
                           <div class="botm-meta">
                              '.$button_order_now.'
                              <h3>'.esc_html($sale_price).'<del>'.esc_html($orgnal_price).'</del></h3>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 col-xxl-7">
                     <div class="banner-img">
                        <div class="cloud-img-position">
                         <img src="'.esc_url($sp_off_image_url).'" alt="'.esc_attr($sp_off_image_id).'">
                        </div>
                        <img class="pizza-img" src="' . esc_url($main_image_url) . '" alt="' . esc_attr($main_image_id) . '">
                     </div>
                     <div class="sub-imgs">
                        <img class="half-tomato mouse-move-animate" src="'.esc_url($sp_sub_image1_url). '" alt="'. esc_attr($sp_sub_image1_id) .'">
                        <img class="leaf-1 mouse-move-animate" src="'.esc_url($sp_sub_image2_url) . '" alt="' . esc_attr($sp_sub_image2_id) .'">
                        <img class="chilli mouse-move-animate" src="'.esc_url($sp_sub_image3_url) . '" alt="' . esc_attr($sp_sub_image3_id) .'">
                        <img class="leaf-2 mouse-move-animate" src="'.esc_url($sp_sub_image4_url) . '" alt="' . esc_attr__($sp_sub_image4_id) .'">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <img class="mint-piece" src="'.esc_url($sp_mint_image_url).'" alt="'.esc_attr($sp_mint_image_id).'">
    </section>';
    }
}
