<?php
load_theme_textdomain('foodota', trailingslashit(get_template_directory()) . 'languages/');
// Content width
if (!isset($content_width)) {
    $content_width = 730;
}
add_theme_support('automatic-feed-links');
add_theme_support('title-tag');
add_theme_support('woocommerce');
add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');
add_editor_style('editor.css');
paginate_comments_links();
the_post_thumbnail();
add_theme_support('post-thumbnails');
//Thumbnails
add_image_size('foodota-blog-thumb', 440, 250, true);
add_image_size('foodota-blog-thumb-new', 415, 250, true);
add_image_size('foodota-blog-thumb-detail', 970, 450, true);
add_image_size('foodota-small-thumb', 100, 66, true);
add_image_size('foodota-user-thumb', 120, 120, true);
add_image_size('foodota-primary-banner', 730, 450, true);
add_image_size('foodota-background', 375, 210);
add_image_size('foodota-extra-small', 190, 183, true);
add_image_size('foodota-similar', 275, 234, true);
add_image_size('foodota-woo-images', 370, 240, true);
add_image_size('foodota-hero-slider-one', 1170, 350, true);
add_image_size('foodota-category-slider-images', 40, 40, true);
add_image_size('foodota-recipe-images-cion', 128, 128, true);
add_image_size('foodota-counter-images-cion', 64, 64, true);
add_image_size('foodota-store-logo', 50, 50, true);
add_image_size('foodota-why-says-background', 600, 600, true);
add_image_size('foodota-testimonial-client-image', 300, 300, true);
add_image_size('foodota-app-images', 140, 45, true);
add_image_size('foodota-app-mobile-image', 313, 447, true);
add_image_size('foodota-counter2-tab-bg', 530, 460, true);
add_image_size('foodota-counter2-bg', 723, 251, true);
add_image_size('foodota-widget-product', 258, 200, true);
add_image_size('foodota-single-product', 200, 190, true);

register_nav_menus(array(
    'main_theme_menu' => esc_html__('Foodota Menu', 'foodota'),
));
add_theme_support('html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ));
add_theme_support('customize-selective-refresh-widgets');
the_tags();
add_theme_support('custom-background', apply_filters('foodota_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
)));
add_action('widgets_init', 'foodota_widgets_init');
if (!function_exists('foodota_widgets_init')) {
    function foodota_widgets_init()
    {
        //Blog Sidebar		
        register_sidebar(array(
            'name' => esc_html__('Blog Sidebar', 'foodota'),
            'id' => 'foodota_blog_sidebar',
            'before_widget' => '<div class="widget"><div id="%1$s">',
            'after_widget' => '</div></div>',
            'before_title' => '<div class="widget-heading"><h2>',
            'after_title' => '</h2><div class="heading-dots clearfix">
                                <span class="h-dot line-dot"></span>
                                <span class="h-dot"></span>
                                <span class="h-dot"></span>
                                <span class="h-dot"></span>
                		</div></div>'
        ));
    }
}
//demo mode user check function
//food_demo_check('echo');
if ( ! function_exists( 'food_demo_check' ) )
{
    function food_demo_check($param = '')
    {
        global $foodota_options;
        if($foodota_options['food_demo'] == true)
        {
            if(isset($param) && $param == 'echo' )
            {
                echo '0|' .__( 'Disabled for demo', 'foodota' );
                die;
            }
//            else if(isset($param) && $param == 'json')
//            {
//                $food_profile_url= home_url('/');
//                $return = array('link' => $food_profile_url,'demo_mode' => 'on');
//                wp_send_json_error($return);
//            }
        }
    }
}
//Register the sidebar for foodota theme
if(!function_exists('food_search_widgets_init')) {
    function food_search_widgets_init()
    {
        register_sidebar(array(
            'name' => esc_html__('Restaurant Search', 'foodota'),
            'id' => 'rest_search',
            'description' => esc_html__('Widgets in this area will be shown on all Food Categories.', 'foodota'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="my-heading-style"><h3>',
            'after_title' => '</h3></div>'
        ));
        register_sidebar(array(
            'name' => esc_html__('Restaurant Search Detail Right', 'foodota'),
            'id' => 'rest_search_detail_right',
            'description' => esc_html__('Widgets in this area will be shown on all Food Categories on Search Detail.', 'foodota'),
            'before_widget' => '<div id="%1$s" class="res-fl-deals widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="my-heading-style"><h3>',
            'after_title' => '</h3></div>'
        ));
        register_sidebar(array(
            'name' => esc_html__('Restaurant Search Detail Left', 'foodota'),
            'id' => 'rest_search_detail_left',
            'description' => esc_html__('Widgets of Banner Image will be shown in this Area.', 'foodota'),
            'before_widget' => '<div id="%1$s" class="res-fl-deals widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="my-heading-style"><h3>',
            'after_title' => '</h3></div>',
        ));
    }
}
add_action( 'widgets_init', 'food_search_widgets_init' );



//add_action( 'user_register', 'myplugin_registration_save', 10, 1 );
//
//function myplugin_registration_save( $user_id ) {
//
//    if ( isset( $_POST['first_name'] ) )
//        update_user_meta($user_id, 'first_name', $_POST['first_name']);
//
//}