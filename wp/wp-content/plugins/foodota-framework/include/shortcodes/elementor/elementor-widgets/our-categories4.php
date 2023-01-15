<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class Ourcategories4 extends Widget_Base
{
    public function get_name()
    {
        return 'food-item-categories4';
    }

    public function get_title()
    {
        return __('Foodota-item-Categories4', 'foodota-framework');
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
            'food-item-categories4',
            [
                'label' => __('Foodota Restaurant Categories 4', 'foodota-framework'),
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
                'label' => __('Footota Categories', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Our Categories', 'foodota-framework'),
                'placeholder' => __('Type your Restaurants Categories!', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'category-description',
            [
                'label' => __('Footota Categories Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Content here content here making it look like readable English ', 'foodota-framework'),
                'placeholder' => __('Type your description here', 'foodota-framework'),
            ]
        );
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'category-select',
            [
                'label' => __('Chose Categories', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => foodota_elementor_all_category(),
                'default' => ['title', 'description'],
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
        $foodota_text_color = $params['food-heading-Scheme'];
        $restaurant_category_title = $params['category-title'];
        $restaurant_category_description = $params['category-description'];
        $category_sliders = $params['category_slider_repeater'];
        $food_all_vendors = (isset($foodota_options['food_search_restaurants']) ? $foodota_options['food_search_restaurants'] : '');
        $food_vendor_url = get_permalink($food_all_vendors);
        $res_html = '';
        foreach ($category_sliders as $item) {
            $cates_image = foodota_get_attch_url($item['category_img']['id']);
            $term_id = $item['category-select'];
            if ($term_id) {
                $term_data = get_term_by('id', $term_id, 'product_cat');

                $term_count = $term_name = '';

                if (!empty($term_data) && ($term_data->count) > 0) {
                    $term_name = isset($term_data->name) ? $term_data->name : '';
                    $term_count = isset($term_data->count) ? $term_data->count : '';
                    $res_html .= '<div  class="col-xl-3 col-lg-6 col-md-6 category-items-new">
            <div class="category-main">
            <a href="' . esc_url($food_vendor_url . '?cat_id=' . $term_id) . '"> <img loading="lazy" alt="" class="cate-images" src="' . $cates_image . '"></a>
            <div class="category-text-box">
            <div class="category-text-inner">
            <a href="' . esc_url($food_vendor_url . '?cat_id=' . $term_id) . '"><h3>' . $term_name . '</h3></a></div>
            <div class="category-text-desc">
             <span class="text-center">' . $term_count . ' ' . esc_html__('Restaurants Products', 'foodota-framework') . '</span>
             </div>
            </div></div>
            </div>';
                }
            }
        }


        return '<section class="res-cat cat-new-design ' . $foodota_text_color . '">
          <div class="container">
            <div class="row">
              <div class="col-xxl-12 col-xl-12 col-lg-12">
                <div class="heading-minimal">
                               <div class="sub-title">' . $restaurant_category_description . '</div>
                               <h3 class="head-title">' . $restaurant_category_title . '</h3>
                        <div class="bottom-dots  clearfix">
                            <span class="dot line-dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
              </div>
                ' . $res_html . '
            </div>
          </div>
     </section>';
    }
}