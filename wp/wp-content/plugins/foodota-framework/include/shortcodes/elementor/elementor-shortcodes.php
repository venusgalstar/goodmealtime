<?php
namespace ElementorFoodota;
/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin
{
    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /* call constructor */

    public function __construct()
    {
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
        add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);
        /* include custom functions */
        require_once(__DIR__ . '/elementor-functions.php');
        /* include render html file */
        //require_once(__DIR__ . '/shortcodes-html.php');
    }

    /**
     * Include Widgets files
     *
     */
    private function include_widgets_files()
    {
        require_once(__DIR__ . '/elementor-widgets/hero-slider1.php');
        require_once(__DIR__ . '/elementor-widgets/food-category-slider.php');
        require_once(__DIR__ . '/elementor-widgets/restaurants.php');
        require_once(__DIR__ . '/elementor-widgets/papular-restaurants.php');
        require_once(__DIR__ . '/elementor-widgets/newsletter.php');
        require_once(__DIR__ . '/elementor-widgets/hero-search1.php');
        require_once(__DIR__ . '/elementor-widgets/simple-gridstyle.php');
        require_once(__DIR__ . '/elementor-widgets/restaurant-counters.php');
        require_once(__DIR__ . '/elementor-widgets/food-types.php');
        require_once(__DIR__ . '/elementor-widgets/testimonial-says.php');
        require_once(__DIR__ . '/elementor-widgets/restaurants-app1.php');
        require_once(__DIR__ . '/elementor-widgets/hero-search2.php');
        require_once(__DIR__ . '/elementor-widgets/our-categories.php');
        require_once(__DIR__ . '/elementor-widgets/our-categories2.php');
        require_once(__DIR__ . '/elementor-widgets/our-categories3.php');
        require_once(__DIR__ . '/elementor-widgets/simple-liststyle.php');
        require_once(__DIR__ . '/elementor-widgets/restaurant-counters2.php');
        require_once(__DIR__ . '/elementor-widgets/blog-grids.php');
        require_once(__DIR__ . '/elementor-widgets/price-plan.php');
        require_once(__DIR__ . '/elementor-widgets/how-it-work.php');
        require_once(__DIR__ . '/elementor-widgets/product-restaurants.php');
        require_once(__DIR__ . '/elementor-widgets/product-restaurants2.php');
        require_once(__DIR__ . '/elementor-widgets/restaurant-counters3.php');
        require_once(__DIR__ . '/elementor-widgets/how-it-work2.php');
        require_once(__DIR__ . '/elementor-widgets/our-team-members.php');
        require_once(__DIR__ . '/elementor-widgets/testimonial-says2.php');
        require_once(__DIR__ . '/elementor-widgets/experience-senses.php');
        require_once(__DIR__ . '/elementor-widgets/hero-search3.php');
        require_once(__DIR__ . '/elementor-widgets/started-today.php');
        require_once(__DIR__ . '/elementor-widgets/how-it-work3.php');
        require_once(__DIR__ . '/elementor-widgets/experience-senses2.php');
        require_once(__DIR__ . '/elementor-widgets/our-categories4.php');
        require_once(__DIR__ . '/elementor-widgets/testimonial-says3.php');
        require_once(__DIR__ . '/elementor-widgets/single-product/sp-hero1.php');
        require_once(__DIR__ . '/elementor-widgets/single-product/sp-banners1.php');
        require_once(__DIR__ . '/elementor-widgets/single-product/sp-products1.php');
        require_once(__DIR__ . '/elementor-widgets/single-product/sp-special-product.php');
        require_once(__DIR__ . '/elementor-widgets/single-product/sp-banners2.php');
        require_once(__DIR__ . '/elementor-widgets/single-product/sp-category-product.php');
        require_once(__DIR__ . '/elementor-widgets/single-product/sp-testimonial-says1.php');
    }

    //Ad Shortcode Category
    public function add_elementor_widget_categories($category_manager)
    {
        $category_manager->add_category(
            'foodota',
            [
                'title' => __('Foodota Widgets', 'foodota-framework'),
                'icon' => 'fa fa-home',
            ]
        );
    }

    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.2.0
     * @access public
     */
    public function register_widgets()
    {
        // Its is now safe to include Widgets files
        $this->include_widgets_files();
        // Register Widgets
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\HeroSlider1());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Foodcategoryslider1());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Foodrestaurants());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Papularrestaurants());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Foodnewsletters());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\HeroSearch1());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Simplerestaurants());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Restaurantcounters());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Foodtypes());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Testimonialsays());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Restaurantapps1());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\HeroSearch2());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Ourcategories());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Ourcategories2());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Ourcategories3());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Simplelist());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Restaurantcounters2());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Bloggrid());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\priceplans());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Howitwork());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Productrestaurants());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Productrestaurants2());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Restaurantcounters3());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Howitwork2());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Ourteam());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Testimonialsays2());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Experiencesences());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\HeroSearch3());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Startedtoday());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Howitwork3());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Experiencesences2());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Ourcategories4());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Testimonialsays3());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Sphero1());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Spbanners1());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Spproduct1());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Spspecial_product());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Spbanners2());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Spcategory_products());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Sptestimonialsays1());

    }
}
Plugin::instance();