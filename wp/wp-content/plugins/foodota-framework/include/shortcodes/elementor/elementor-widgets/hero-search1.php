<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class HeroSearch1 extends Widget_Base
{
    public function get_name()
    {
        return 'foodota-hero-search';
    }

    public function get_title()
    {
        return __('Hero Search one', 'foodota-framework');
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
            'hero_search_one',
            [
                'label' => __('Hero Search One', 'foodota-framework'),
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
            'search-heading-top',
            [
                'label' => __('Search Heading Top', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Learn How to Make', 'foodota-framework'),
                'placeholder' => __('Learn How to Make', 'foodota-framework'),
            ]
        );


        $this->add_control(
            'search-heading-bottom',
            [
                'label' => __('Search Heading bottom', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Your Favorite Restaurant Wishes', 'foodota-framework'),
                'placeholder' => __('Your Favorite Restaurant Wishes', 'foodota-framework'),
            ]
        );


        $this->add_control(
            'search-heading-description',
            [
                'label' => __('Search Hero Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown', 'foodota-framework'),
                'placeholder' => __('Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'label-recipe',
            [
                'label' => __('Label Recipe', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Recipe', 'foodota-framework'),
                'placeholder' => __('Your Favorite Restaurant Wishes', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'label-location',
            [
                'label' => __('Label Location', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Location', 'foodota-framework'),
                'placeholder' => __('Your Favorite Restaurant Wishes', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'recipe-placeholder',
            [
                'label' => __('Placeholder Recipe Search', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Location', 'foodota-framework'),
                'placeholder' => __('What are you looking for', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'search-button-text',
            [
                'label' => __('Search Button Text', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Search', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'search-hero-field',
            [
                'label' => __('Search Fields', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'recipes',
                'options' => [
                    'recipes' => __('Search By Recipes', 'foodota-framework'),
                    'locations' => __('Search by Location', 'foodota-framework'),
                    'boths' => __('Both', 'foodota-framework'),
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
        $params['search-heading-top'] = $settings['search-heading-top'] ? $settings['search-heading-top'] : '';
        $params['search-heading-bottom'] = $settings['search-heading-bottom'] ? $settings['search-heading-bottom'] : '';
        $params['search-heading-description'] = $settings['search-heading-description'] ? $settings['search-heading-description'] : '';
        $params['label-recipe'] = $settings['label-recipe'] ? $settings['label-recipe'] : '';
        $params['label-location'] = $settings['label-location'] ? $settings['label-location'] : '';
        $params['recipe-placeholder'] = $settings['recipe-placeholder'] ? $settings['recipe-placeholder'] : '';
        $params['search-button-text'] = $settings['search-button-text'] ? $settings['search-button-text'] : '';
        $params['search-hero-field'] = $settings['search-hero-field'] ? $settings['search-hero-field'] : '';

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
        $foodota_text_color = $params['food-heading-Scheme'];
        $search_data = (isset($foodota_options['food_search_restaurants']) ? $foodota_options['food_search_restaurants'] : '');
        $food_search_url = get_permalink($search_data);
        $hero_search_heading_top = $params['search-heading-top'];
        $hero_search_heading_bottom = $params['search-heading-bottom'];
        $hero_search_description = $params['search-heading-description'];
        $recipe_label = $params['label-recipe'];
        $location_label = $params['label-location'];
        $recipe_placeholder = $params['recipe-placeholder'];
        $button_text = $params['search-button-text'];
        $hero_search_fields = $params['search-hero-field'];
        $fields_html = '';
        $city_html = '';
        $restaurant_html = '';
        $city = restaurants_all_location('city');
        isset($city) ? $city : '';
        if(is_array($city)){
            $city = array_unique($city);
        }

        $res_name = restaurants_all_location('res_name');
        $res_name = array_unique($res_name);
        if(!empty($city)) {
            foreach ($city as $key => $name) {
                $city_html .= '<option value="' . $key . '">' . esc_html__($name, 'foodota-framework') . '</option>';
            }
        }
        foreach ($res_name as $key => $name) {
            $restaurant_html .= '<option value="' . $key . '">' . esc_html__($name, 'foodota-framework') . '</option>';
        }

        if ($hero_search_fields == 'recipes') {
            $fields_html .= '<div class="input-wrap first">
                           <div class="input-field first">
                               <label>' . esc_html__($recipe_label, 'foodota-framework') . '</label>
                               <input id="s" name="recipe" class="" autocomplete="off" placeholder="' . esc_html__($recipe_placeholder, 'foodota-framework') . '" type="search">
                           </div>
                        </div>';
        }

        if ($hero_search_fields == 'locations') {
            $fields_html .=
                '<div class="input-wrap first">
						   <div class="input-field first">
							   <label>' . esc_html__($location_label, 'foodota-framework') . '</label>
							   <div class="form-group">	
								   <select data-placeholder="Select From Location" name="city" class="js-example-basic-single">
								   		<option value="AL">' . esc_html__('Select an Location', 'foodota-framework') . '</option>
										' . $city_html . '
								   </select>
	       						</div>
						   </div>
						</div>';
        }
        if ($hero_search_fields == 'boths') {
            $fields_html .= '<div class="input-wrap first">
                           <div class="input-field first">
                               <label>' . esc_html__($recipe_label, 'foodota-framework') . '</label>
                               <input id="s" name="recipe" class="" autocomplete="off" placeholder="' . esc_html__($recipe_placeholder, 'foodota-framework') . '" value="" type="search">
                           </div>
                        </div>
						<div class="input-wrap second">
						   <div class="input-field second">
							   <label>' . esc_html__($location_label, 'foodota-framework') . '</label>
							   <div class="form-group">	
								   <select data-placeholder="Select From Location" name="city" class="js-example-basic-single">
								   		<option value="AL">' . esc_html__('Select an Location', 'foodota-framework') . '</option>
										' . $city_html . '
								   </select>
	       						</div>
						   </div>
						</div>';
        }
        return '<section class="res-hero-3 ' . $foodota_text_color . '">
  <div class="container">
    <div class="row">
      <div class="col-xxl-7 col-xl-7 col-lg-11 col-md-12 col-sm-12">
        <div class="res-hero-3-main">
          <div class="res-hero-3-content"> <span>' . $hero_search_heading_top . '</span>
            <h1>' . $hero_search_heading_bottom . '</h1>
            <p>' . $hero_search_description . '</p>
          </div>
          <form class="custom-style-search" method="get"  action="' . esc_url($food_search_url) . '">
				<div class="inner-form">
				   <div class="left">
				   	' . $fields_html . '
				   </div>
				   <button class="btn-search" type="submit">' . esc_html__($button_text, 'foodota-framework') . '</button>
			    </div>	   
		  </form>
        </div>
      </div>
    </div>
  </div>
</section>';
    }
}