<?php
/**
 * foodota functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package foodota
 */
add_action("after_setup_theme", "foodota_setup");
if (!function_exists("foodota_setup")) {    /* Theme Settings */
    function foodota_setup()
    {
        /* Theme Settings */
        require trailingslashit(get_template_directory()) . "inc/theme_settings.php";
        require trailingslashit(get_template_directory()) . "inc/theme_functions.php";
        /* Custom Navigation Walker */
        require trailingslashit(get_template_directory()) . "inc/nav.php";
        /* Theme localization */
        require trailingslashit(get_template_directory()) . "inc/localization.php";
        /* Theme Utilities */
        require trailingslashit(get_template_directory()) . "inc/theme_utilities.php";
        /* Theme TGM */
        require trailingslashit(get_template_directory()) . "tgm/tgm-init.php";
        /* Load Redux Options */
        require trailingslashit(get_template_directory()) . "inc/options.php";
        /*Load the woocommerce funtion*/
        require trailingslashit(get_template_directory()) . "inc/woo-function.php";
    }
}


/* ------------------------------------------------ */
/* Enqueue Google Fonts. */
/* ------------------------------------------------ */
if (!function_exists('foodota_google_fonts')) {
    function foodota_google_fonts($font_info = '')
    {
        $fonts_url = '';
        $source_sans = _x('on', 'Lato font: on or off', 'foodota');
        if ('off' !== $source_sans) {
            $font_families = array();
            if ('off' !== $source_sans) {
                $font_families[] = $font_info;
            }
            $query_args = array(
                'family' => urlencode(implode($font_families)),
                'subset' => urlencode('latin,latin-ext'),
                'display' => urlencode('swap'),
            );
            $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css2');
        }
        return urldecode($fonts_url);
    }
}
/* ------------------------------------------------ */
/* Enqueue scripts and styles. */
/* ------------------------------------------------ */
add_action("wp_enqueue_scripts", "foodota_scripts");
function foodota_scripts()
{
    global $foodota_options;
    $is_exist = false;
    if( function_exists('is_wcfm_page') ){
        if( is_wcfm_page() ){
            $is_exist = true;
        }
    }
    $maper_key = '';
    if (isset($foodota_options['map-api-key']) and $foodota_options['map-api-key'] != '') {
        $maper_key = $foodota_options['map-api-key'];
    }

    if($is_exist == false && $maper_key != ""){
        wp_enqueue_script("google-map", "//maps.googleapis.com/maps/api/js?v=3&libraries=places&key=" . $maper_key . "", false, false, false);
    }
    wp_enqueue_script("foodota-menu", trailingslashit(get_template_directory_uri()) . "libs/js/sb-menu.js", false, false, true);
    wp_enqueue_script("bootstrap", trailingslashit(get_template_directory_uri()) . "libs/js/bootstrap.bundle.min.js", false, false, true);
    wp_enqueue_script("popper", trailingslashit(get_template_directory_uri()) . "libs/js/popper.js", false, false, true);
    wp_enqueue_script("jquery-custom-scroll", trailingslashit(get_template_directory_uri()) . "libs/js/jquery-custom-scroll.min.js", false, false, true);
    wp_enqueue_script("select2", trailingslashit(get_template_directory_uri()) . "libs/js/select2.min.js", false, false, true);
    wp_enqueue_script("youtube-popup", trailingslashit(get_template_directory_uri()) . "libs/js/YouTubePopUp.jquery.js", false, false, true);
    wp_enqueue_script("owl-carousel", trailingslashit(get_template_directory_uri()) . "libs/js/owl.carousel.min.js", false, false, true);
    wp_enqueue_script("typeahead", trailingslashit(get_template_directory_uri()) . "libs/js/jquery.typeahead.js", false, false, true);
    if (is_singular() && comments_open() && (get_option('thread_comments') == 1)) {
        wp_enqueue_script("comment-reply", "", true);
    }

    wp_enqueue_script("masonry");
    wp_enqueue_script("isotope", trailingslashit(get_template_directory_uri()) . "libs/js/isotope.min.js", false, false, true); // nedd to add js
    wp_enqueue_script("jquery-ui", trailingslashit(get_template_directory_uri()) . "libs/js/jquery-ui.min.js", false, false, true);
    wp_enqueue_script("parsley", trailingslashit(get_template_directory_uri()) . "libs/js/parsley.min.js", false, false, true);
    wp_enqueue_script("notiflix", trailingslashit(get_template_directory_uri()) . "libs/js/notiflix.js", false, false, true);
    wp_enqueue_script("add2-cart", trailingslashit(get_template_directory_uri()) . "libs/js/jquery-add2cart.js", false, false, true);
    wp_enqueue_script("loading-overlay", trailingslashit(get_template_directory_uri()) . "libs/js/loadingoverlay.js", false, false, true);
    wp_enqueue_script("owl-carousel-thumbs", trailingslashit(get_template_directory_uri()) . "libs/js/owl.carousel.thumbs.min.js", false, false, true);
    wp_enqueue_script("foodota-custom", trailingslashit(get_template_directory_uri()) . "libs/js/custom.js", array("jquery"), false, true);


    if (in_array('foodota-framework/foodota-framework.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        wp_localize_script('foodota-custom', 'foodota_strings', food_auth_string());
    }
      wp_enqueue_style("foodota-style", get_stylesheet_uri());
      wp_enqueue_style('google-fonts-montserrat', foodota_google_fonts('Montserrat:wght@400;500;600;700'), array(), true);
      wp_enqueue_style('google-fonts-nunito', foodota_google_fonts('Nunito:wght@400;600;700;800'), array(), true);
      wp_enqueue_style('google-fonts-kaushan-script', foodota_google_fonts('Kaushan+Script&display'), array(), true);
      wp_enqueue_style("bootstrap", trailingslashit(get_template_directory_uri()) . "libs/css/bootstrap.min.css");
      wp_enqueue_style("foodota-theme", trailingslashit(get_template_directory_uri()) . "libs/css/theme.css");
      wp_enqueue_style("animation", trailingslashit(get_template_directory_uri()) . "libs/css/animate.min.css");
      wp_enqueue_style("jquery-custom-scroll", trailingslashit(get_template_directory_uri()) . "libs/css/jquery-custom-scroll-min.css");
      wp_enqueue_style("foodota-module", trailingslashit(get_template_directory_uri()) . "libs/css/module.css");
      wp_enqueue_style("prettycheckbox", trailingslashit(get_template_directory_uri()) . "libs/css/pretty-checkbox.css");
      wp_enqueue_style("foodota-main", trailingslashit(get_template_directory_uri()) . "libs/css/main-style.css");
      wp_enqueue_style("fontawesome", trailingslashit(get_template_directory_uri()) . "libs/css/awesome.css");
      wp_enqueue_style("sb-menu", trailingslashit(get_template_directory_uri()) . "libs/css/sb-menu.css");
      wp_enqueue_style("foodota-blog", trailingslashit(get_template_directory_uri()) . "libs/css/blog.css");
      wp_enqueue_style("foodota-responsive", trailingslashit(get_template_directory_uri()) . "libs/css/responsive.css");
}

if ( ! function_exists( 'foodota_wp_body_open' ) ) {
    function foodota_wp_body_open() {
        do_action( 'wp_body_open' );
    }
}
add_filter('comment_form_fields', 'foodota_comment_field');
if (!function_exists('foodota_comment_field')) {
    function foodota_comment_field($fields)
    {
        $comment_field = $fields['comment'];
        unset($fields['comment']);
        $fields['comment'] = $comment_field;
        return $fields;
    }
}

function foodota_theme_widgets() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'foodota_theme_widgets' );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 99 );
function theme_enqueue_styles() {
    wp_enqueue_style( 'google-map',);
}

