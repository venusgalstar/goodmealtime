<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Foodcategoryslider1 extends Widget_Base
{

    public function get_name()
    {
        return 'foodota-cat-slider';
    }

    public function get_title()
    {
        return __('Food Category Slider', 'foodota-framework');
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
            'food-cat-sliders',
            [
                'label' => __('Food Category Slider', 'foodota-framework'),
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
            'cats',
            [
                'label' => __('Chose Categories', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => foodota_elementor_all_category(),
                'default' => ['title', 'description'],
            ]
        );


        $this->add_control(
            'rescep-images',
            [
                'label' => __('Receip Logo Image', 'foodota-framework'),
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
        $params['rescep-images'] = $settings['rescep-images']['id'] ? $settings['rescep-images']['id'] : '';
        $params['cats'] = $settings['cats'] ? $settings['cats'] : array();
        echo $this->foodota_elementor_category_slider1($params);
        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            ?>
            <script>

                jQuery('.food-cat').owlCarousel({
                    loop: true,
                    margin: 0,
                    autoplay: true,
                    nav: true,
                    responsive: {
                        0: {
                            items: 2
                        },
                        600: {
                            items: 3
                        },
                        900: {
                            items: 4
                        },
                        1200: {
                            items: 6
                        },
                        1300: {
                            items: 7
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


    public function foodota_elementor_category_slider1($params)
    {
        global $foodota_options;
        $foodota_text_color = $params['food-heading-Scheme'];
        $recep_icon = $params['rescep-images'];
        $recipe_image = foodota_get_attch_url($recep_icon, 'foodota-recipe-images-cion');
        $recep_category = $params['cats'];
        $food_all_vendors = (isset($foodota_options['food_search_restaurants']) ? $foodota_options['food_search_restaurants'] : '');
        $food_vendor_url = get_permalink($food_all_vendors);
        //foodota-category-slider-images
        $category_html = '';
        if ($recep_category != '') {
            foreach ($recep_category as $term_id) {
                $thumbnail_id = get_term_meta($term_id, 'thumbnail_id', true);
                $image = wp_get_attachment_url($thumbnail_id);
                $single_image = foodota_get_attch_url($thumbnail_id, 'foodota-category-slider-images');
                $term_data = get_term_by('id', $term_id, 'product_cat');
                $term_name = '';
                if (!empty($term_data) && ($term_data->count) > 0) {
                    $term_name = $term_data->name;
                    $category_html .= '<div class="item">
                        <div class="res-food-cat0"> 
                        <img src="' . esc_url($single_image) . '" alt="' . esc_attr__('category-image', 'foodota-framework') . '" class="img-fluid">
                        <span><a href="' . esc_url($food_vendor_url . '?cat_id=' . $term_id) . '">' . $term_name . '</a></span>
                        </div>
                          </div>';
                }
            }
        }
        return '<section class="res-food-products ' . $foodota_text_color . '">
  <div class="container">
    <div class="row">
      <div class="col-xxl-12 col-xl-12 col-lg-12">
        <div class="food-cat owl-carousel owl-theme red-food-item">
        ' . $category_html . '
		</div>
      </div>
    </div>
  </div>
  <div class="res-pro-serv"> <img src="' . $recipe_image . '" alt="' . esc_attr__('recipe-icon', 'foodota-framework') . '" class="img-fluid"> </div>
</section>';
    }
}