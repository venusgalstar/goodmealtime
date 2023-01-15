<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Ourcategories2 extends Widget_Base
{
    public function get_name()
    {
        return 'food-item-categories2';
    }

    public function get_title()
    {
        return __('Foodota-item-Categories2', 'foodota-framework');
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
            'food-item-categories2',
            [
                'label' => __('Foodota Restaurant Categories 2', 'foodota-framework'),
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
            'category-title',
            [
                'label' => __( 'Footota Categories', 'foodota-framework' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Our Categories', 'foodota-framework' ),
                'placeholder' => __( 'Type your Restaurants Categories!', 'foodota-framework' ),
            ]
        );

        $this->add_control(
            'category-description',
            [
                'label' => __( 'Footota Categories Description', 'foodota-framework' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __( 'Content here content here making it look like readable English ', 'foodota-framework' ),
                'placeholder' => __( 'Type your description here', 'foodota-framework' ),
            ]
        );
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'category-select',
            [
                'label' => __( 'Chose Categories', 'foodota-framework' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => foodota_elementor_all_category(),
                'default' => [ 'title', 'description' ],
            ]
        );
        $repeater->add_control(
            'category_img',
            [
                'label' => __('Category Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );

        $this->add_control(
            'category_slider_repeater',
            [
                'label' => __('Repeater Images', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'category-select' => '',
                        'category_img' => '',
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
        $params['category-title'] = $settings['category-title'] ? $settings['category-title'] : '';
        $params['category-description'] = $settings['category-description'] ? $settings['category-description'] : '';
        $params['category_slider_repeater'] = $settings['category_slider_repeater'] ? $settings['category_slider_repeater'] : array();
        echo $this->foodota_category2_slider($params);

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            ?>
            <script>

                jQuery('.prop-types-carsol').owlCarousel({
                    dots: false,
                    loop: true,
                    margin: 30,
                    nav: true,
                    smartSpeed: 1200,
                    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                    responsive: {
                        0: {
                            items: 1,
                            center: false
                        },
                        480: {
                            items: 1,
                            center: false
                        },
                        520: {
                            items: 2,
                            center: false
                        },
                        600: {
                            items: 2,
                            center: false
                        },
                        768: {
                            items: 2
                        },
                        992: {
                            items: 3
                        },
                        1200: {
                            items: 5
                        }
                    }
                });

            </script>
            <?php

        }

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


    public function foodota_category2_slider($params)
    {
        //$slider_images = $params['hero_slider_images'];
        global $foodota_options;
        $foodota_text_color=$params['food-heading-Scheme'];
        $restaurant_category_title=$params['category-title'];
        $restaurant_category_description=$params['category-description'];
        $category_sliders = $params['category_slider_repeater'];
        $food_all_vendors = (isset($foodota_options['food_search_restaurants']) ? $foodota_options['food_search_restaurants'] : '');
        $food_vendor_url = get_permalink($food_all_vendors);
        $res_html = '';

        foreach ($category_sliders as $item) {

            $cates_image = foodota_get_attch_url($item['category_img']['id']);
            $term_id = $item['category-select'];
           $term_data= get_term_by('id', $term_id, 'product_cat');
                $term_count =  $term_name = '';
                if(!empty($term_data) && ($term_data->count) > 0) {
                    $term_name = $term_data->name;
                    $term_count = $term_data->count;

                    $res_html .= '<div class="item">
                <div class="prop-card">
                    <a class="card bg-img-cover prop-card-min-height" href="' . esc_url($food_vendor_url . '?cat_id=' . $term_id) . '" style="background-image: url(' . $cates_image . ');">
                        <div class="card-body">
                            <span class="d-block font-weight-bold">' . $term_count . ' ' . esc_html__('Restaurants', 'foodota-framework') . '</span>
                            <h3 class="text-white">' . $term_name . '</h3>
                        </div>
                        <div class="card-footer pt-0">
                            <span class="font-weight-bold">' . esc_html__('View Detials', 'foodota-framework') . '</span>
                        </div>
                        <div class="img-overlay-top"></div>
                    </a>
                </div>
            </div>';
                }

        }


        return '<section class="res-cat section-padding '.$foodota_text_color.'">
          <div class="container">
            <div class="row">
              <div class="col-xxl-12 col-xl-12 col-lg-12">
                <div class="heading-minimal">
                       <div class="sub-title">'.$restaurant_category_description.'</div>
                       <h3 class="head-title">'. $restaurant_category_title.'</h3>
                <div class="bottom-dots  clearfix">
                    <span class="dot line-dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
              </div>
              <div class="col-xxl-12 col-xl-12 col-lg-12">
                <div class="prop-types-carsol owl-carousel owl-theme">
                '.$res_html.'
                </div>
              </div>
            </div>
          </div>
        </section>';
    }
}