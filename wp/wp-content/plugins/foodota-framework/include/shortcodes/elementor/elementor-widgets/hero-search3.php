<?php
namespace ElementorFoodota\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
class HeroSearch3 extends Widget_Base
{
    public function get_name()
    {
        return 'foodota-hero-search3';
    }

    public function get_title()
    {
        return __('Hero Search three', 'foodota-framework');
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
            'hero_search_three',
            [
                'label' => __('Hero Search two', 'foodota-framework'),
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
            'bike-imag',
            [
                'label' => __('Bike Image', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'id' => ''
                ],
            ]
        );

        $this->add_control(
            'search-heading-bottom',
            [
                'label' => __('Search Heading bottom', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Order Healthy and Fresh Food Any Time', 'foodota-framework'),
                'placeholder' => __('Your Favorite Restaurant Wishes', 'foodota-framework'),
            ]
        );


        $this->add_control(
            'search-heading-description',
            [
                'label' => __('Search Hero Description', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula dolor.', 'foodota-framework'),
                'placeholder' => __('Write Description Here', 'foodota-framework'),
            ]
        );

        $this->add_control(
            'search-restaurant-heading',
            [
                'label' => __('Search Heading Restaurants', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Popular Restaurant', 'foodota-framework'),
                'placeholder' => __('Write Your Restaurant Heading', 'foodota-framework'),
            ]
        );
        $this->add_control(
            'recipe-placeholder',
            [
                'label' => __('Placeholder Recipe Search', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Recipe Name Here!', 'foodota-framework'),
                'placeholder' => __('What are you looking for', 'foodota-framework'),
            ]
        );


        $this->add_control(
            'restaurants-in-numbers',
            [
                'label' => __('Number of Restaurants', 'foodota-framework'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 200,
                'step' => 1,
                'default' => 6,
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();
        $params['food-heading-Scheme'] = $settings['food-heading-Scheme'] ? $settings['food-heading-Scheme'] : '';
        $params['bike-imag-url'] = $settings['bike-imag']['url'] ? $settings['bike-imag']['url'] : '';
        $params['bike-imag-id'] = $settings['bike-imag']['id'] ? $settings['bike-imag']['id'] : '';
        $params['search-heading-bottom'] = $settings['search-heading-bottom'] ? $settings['search-heading-bottom'] : '';
        $params['search-heading-description'] = $settings['search-heading-description'] ? $settings['search-heading-description'] : '';
        $params['search-restaurant-heading'] = $settings['search-restaurant-heading'] ? $settings['search-restaurant-heading'] : '';
        $params['restaurants-in-numbers'] = $settings['restaurants-in-numbers'] ? $settings['restaurants-in-numbers'] : '';
        $params['recipe-placeholder'] = $settings['recipe-placeholder'] ? $settings['recipe-placeholder'] : '';
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
        $bike_url = $params['bike-imag-url'];
        $bike_id = $params['bike-imag-id'];
        $search_data = (isset($foodota_options['food_search_restaurants']) ? $foodota_options['food_search_restaurants'] : '');
        $food_search_url = get_permalink($search_data);
        $hero_search_heading_bottom = $params['search-heading-bottom'];
        $hero_search_description = $params['search-heading-description'];
        $hero_restaurant_heading = $params['search-restaurant-heading'];
        $show_restaurants = $params['restaurants-in-numbers'];
        $recipe_placeholder = $params['recipe-placeholder'];
        $bottom_design = get_template_directory_uri() . '/libs/images/wave.svg';
        $number = $show_restaurants;
        $city_html = '';
        $restaurant_html = '';
        $city = restaurants_all_location('city');
        $res_name = restaurants_all_location('res_name');
        if($city) {
            foreach ($city as $key => $name) {
                $city_html .= '<option value="' . $key . '">' . esc_html__($name, 'foodota-framework') . '</option>';
            }
        }
        if($res_name) {
            foreach ($res_name as $key => $name) {
                $restaurant_html .= '<option value="' . $key . '">' . esc_html__($name, 'foodota-framework') . '</option>';
            }
        }
        $args = array(
            'role' => 'wcfm_vendor',
            'number' => $number,
            'fields' => array('ID', 'user_login', 'user_email')
        );
        $query = get_users($args);//query the maximum users that we will be displaying
        $res_html = '';
        if (is_array($query)) {
            foreach ($query as $agent_data) {

                $res_html .= foodota_samll_view_restaurant($agent_data->ID, 'hero-search-view');

            }
        }

        return '<section class="res-hero-3 new-search ' . $foodota_text_color . '">
  <div class="container">
    <div class="row">
      <div class="col-xxl-6 col-xl-7 col-lg-12 col-md-12">
        <div class="res-hero-content">
          <div class="res-hero-main">
           <div class="res-hero-tite"><span><img src="' . $bike_url . '" alt="' . esc_attr__($bike_id, 'foodota-framework') . '"/> </span>
            <div class="res-hero-tite">
              <h1>' . $hero_search_heading_bottom . '</h1>
              <p>' . $hero_search_description . '</p>
            </div>
          </div>
          <div class="res-hero-srch">
            <form action="' . $food_search_url . '" method="get">
              <div class="ul-search-3">
                <div class="location-search">
                <div class="form-group random-search">
                <label>' . esc_html__('Search Keywords', 'foodota-framework') . '</label> 
                <input id="s" name="recipe"  autocomplete="off"  class="recipe-search2 form-control" placeholder="' . esc_html__($recipe_placeholder, 'foodota-framework') . '">
              <button  type="submit" class="submit-btn btn btn-theme"><i class="fa fa-search"></i></button>
              </div>
              </div>
              </div>
            </form>
          </div>
          <div class="res-hero-product">
            <h3>' . $hero_restaurant_heading . '</h3>
            <div class="fr-hero-logo"> 
				' . $res_html . '
            </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <div class="bottom-img">
      <img src="' . $bottom_design . '" alt="wave shape" class="img-fluid">
 </div>
</section>';
    }
}