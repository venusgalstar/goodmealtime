<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Spspecial_product extends Widget_Base
{
    public function get_name()
    {
        return 'single-special-product';
    }

    public function get_title()
    {
        return __('Single Special Product', 'foodota-framework');
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
            'sp-special-product',
            [
                'label' => __('Single Special Product', 'foodota-framework'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'sp-special-main-img',
            [
                'label' => __('Special main  Image', 'foodota-framework'),
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
                'label' => __('Special Off Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );

        $this->add_control(
            'sp-tomato-image',
            [
                'label' => __('Special Tomato image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );
        $this->add_control(
            'sp-mushroom-img',
            [
                'label' => __('Special Mushroom Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );


        $this->add_control(
            'main-heading-top',
            [
                'label' => __('Special Product Heading Top', 'foodota-framework'),
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
                    '.special-offer-deal .top-banner-meta h1' => 'color: {{value}}',
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
                    '.special-offer-deal .top-banner-meta h2' => 'color: {{value}}',
                ],
            ]
        );
        $this->add_control(
            'main-heading-description',
            [
                'label' => __('Main Heading Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet sem neque sed ipsum..', 'foodota-framework'),
                'placeholder' => __('Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet sem neque sed ipsum.', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'main-heading-description-color',
            [
                'label' => __( 'Main Heading Description color', 'foodota-framework' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '.fodo-top-banner .top-banner-meta p' => 'color: {{value}}',
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

        $this->end_controls_section();
    }

    protected function render()
    {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();

        $params['sp-special-main-img_id'] = $settings['sp-special-main-img']['id'] ? $settings['sp-special-main-img']['id'] : '';
        $params['sp-special-main-img-url'] = $settings['sp-special-main-img']['url'] ? $settings['sp-special-main-img']['url'] : '';
        $params['sp-off-img'] = $settings['sp-off-img']['id'] ? $settings['sp-off-img']['id'] : '';
        $params['sp-off-img-url'] = $settings['sp-off-img']['url'] ? $settings['sp-off-img']['url'] : '';
        $params['sp-tomato-image_id'] = $settings['sp-tomato-image']['id'] ? $settings['sp-tomato-image']['id'] : '';
        $params['sp-tomato-image-url'] = $settings['sp-tomato-image']['url'] ? $settings['sp-tomato-image']['url'] : '';
        $params['sp-mushroom-img'] = $settings['sp-mushroom-img']['id'] ? $settings['sp-mushroom-img']['id'] : '';
        $params['sp-mushroom-img-url'] = $settings['sp-mushroom-img']['url'] ? $settings['sp-mushroom-img']['url'] : '';




        $params['main-heading-top'] = $settings['main-heading-top'] ? $settings['main-heading-top'] : '';
        $params['main-heading-bottom'] = $settings['main-heading-bottom'] ? $settings['main-heading-bottom'] : '';
        $params['main-heading-description'] = $settings['main-heading-description'] ? $settings['main-heading-description'] : '';
        $params['sp-btn-title-hero1'] = $settings['sp-btn-title-hero1'] ? $settings['sp-btn-title-hero1'] : '';
        $params['sp-btn-title-hero1-link'] = $settings['sp-btn-title-hero1-link']['url'] ? $settings['sp-btn-title-hero1-link']['url'] : '';
        $params['target_one'] = $settings['sp-btn-title-hero1-link']['is_external'] ? ' target="_blank"' : '';
        $params['nofollow_one'] = $settings['sp-btn-title-hero1-link']['nofollow'] ? ' rel="nofollow"' : '';
        $params['real-price'] = $settings['real-price'] ? $settings['real-price'] : '';
        $params['sale-price'] = $settings['sale-price'] ? $settings['sale-price'] : '';
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
        $sp_main_image_id  =  $params['sp-special-main-img_id'];
        $sp_main_image_url =  $params['sp-special-main-img-url'];
        $sp_off_image_id = $params['sp-off-img'];
        $sp_off_image_url =  $params['sp-off-img-url'];
        $sp_tomato_image_id = $params['sp-tomato-image_id'];
        $sp_tomato_image_url =  $params['sp-tomato-image-url'];
        $sp_mushroom_image_id = $params['sp-mushroom-img'];
        $sp_mushroom_image_url =  $params['sp-mushroom-img-url'];
        $hero_main_heading_top = $params['main-heading-top'];
        $main_heading_bottom = $params['main-heading-bottom'];
        $main_heading_description = $params['main-heading-description'];
        $target_one = $params['target_one'];
        $nofollow_one = $params['nofollow_one'];
        $sp_btn_title = $params['sp-btn-title-hero1'];
        $sp_btn_link = $params['sp-btn-title-hero1-link'];
        $orgnal_price = $params['real-price'];
        $sale_price  =  $params['sale-price'];
        if ($params['sp-btn-title-hero1'] != '' && $params['sp-btn-title-hero1-link'] != '') {
            $button_order_now = foodota_elementor_button_link($target_one, $nofollow_one, $sp_btn_title, $sp_btn_link, '');
        }
        return '<section class="special-offer-deal fodo-top-banner">
       <div class="container">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
               <div class="row">
                  <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                     <div class="special-offer-img">
                        <img src="' . esc_url($sp_main_image_url) . '" alt="' . esc_attr($sp_main_image_id) . '">
                        <img class="save-upto" src="'.esc_url($sp_off_image_url).'" alt="'.esc_attr($sp_off_image_id).'">
                        <img class="tomato" src="'.esc_url($sp_tomato_image_url).'" alt="'.esc_attr($sp_tomato_image_id).'">
                     </div>
                  </div>
                  <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
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
                        <div class="mashroom">
                           <img class="" src="' . esc_url($sp_mushroom_image_url) . '" alt="'.esc_attr($sp_mushroom_image_id) .'">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
          </div>
       </div>
    </section>';
    }
}
