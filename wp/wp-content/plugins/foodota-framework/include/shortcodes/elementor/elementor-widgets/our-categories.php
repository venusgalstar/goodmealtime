<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Ourcategories extends Widget_Base
{
    public function get_name()
    {
        return 'food-item-categories';
    }

    public function get_title()
    {
        return __('Foodota-item-Categories', 'foodota-framework');
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
            'food-item-categories',
            [
                'label' => __('Foodota Restaurant Categories', 'foodota-framework'),
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

        $this->add_control(
            'cats-select',
            [
                'label' => __( 'Chose Categories', 'foodota-framework' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => foodota_elementor_all_category(),
                'default' => [ 'title', 'description' ],
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
        $params['cats-select'] = $settings['cats-select'] ? $settings['cats-select'] : array();
        echo $this->foodota_restaurants($params);

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            ?>
            <script>

                jQuery('.cat').owlCarousel({
                    loop: true,
                    margin: 20,
                    autoplay: true,
                    nav: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 3
                        },
                        900: {
                            items: 4
                        },
                        1200: {
                            items: 6
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


    public function foodota_restaurants($params)
    {
        //$slider_images = $params['hero_slider_images'];
        global $foodota_options;
        $foodota_text_color=$params['food-heading-Scheme'];
        $restaurant_category_title=$params['category-title'];
        $restaurant_category_description=$params['category-description'];
        $recep_category =  $params['cats-select'];
        $food_all_vendors = (isset($foodota_options['food_search_restaurants']) ? $foodota_options['food_search_restaurants'] : '');
        $food_vendor_url = get_permalink($food_all_vendors);

        $res_html = '';
        if(is_array( $recep_category )){
            foreach( $recep_category as $term_id) {
                $count=
                $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
                $image = wp_get_attachment_url( $thumbnail_id );
                $single_image = foodota_get_attch_url($thumbnail_id);
                $term_data= get_term_by('id', $term_id, 'product_cat');
                $term_count =  $term_name = '';
                if(!empty($term_data) && ($term_data->count) > 0)
                {
                    $term_name = $term_data->name;
                    $term_count = $term_data->count;

             $res_html .= '<div class="item"><div class="res-cat-box">
              <div class="res-assets"> <img src="'.$single_image.'" alt="'.esc_attr__('category-image','foodota-framework').'" class="img-fluid"><p><a href="'.esc_url($food_vendor_url.'?cat_id='.$term_id).'">'.$term_name.'</a></p>
              <span>'.$term_count.'&nbsp;&nbsp;'.esc_html("Ads","foodota-framework").'</span> </div></div></div>';
                }

            }
        }

        return '<section class="res-cat  '.$foodota_text_color.'">
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
                <div class="cat owl-carousel owl-theme">
                '.$res_html.'
                </div>
              </div>
            </div>
          </div>
        </section>';
    }
}