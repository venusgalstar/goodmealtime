<?php
if (!class_exists('Redux')) {
    return;
}
// This is your option name where all the Redux data is stored.
$opt_name = "foodota_options";
$sample_patterns = $sampleHTML = '';
$theme = wp_get_theme(); // For use with some settings. Not necessary.
$currecnies = array();
if (in_array('foodota-framework/index.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    $currecnies = foodota_framework_get_currency();
}
$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => $opt_name,
    'display_name' => $theme->get('Name'),
    'display_version' => $theme->get('Version'),
    'menu_type' => 'submenu',
    'allow_sub_menu' => true,
    'menu_title' => esc_html__('Foodota Options', 'foodota'),
    'page_title' => esc_html__('Foodota Options', 'foodota'),
    'google_api_key' => '',
    'google_update_weekly' => false,
    'async_typography' => true,
    'admin_bar' => true,
    'admin_bar_icon' => 'dashicons-portfolio',
    'admin_bar_priority' => 50,
    'global_variable' => '',
    'dev_mode' => false,
    'update_notice' => false,
    'customizer' => false,
    'page_parent' => 'themes.php',
    'page_permissions' => 'manage_options',
    'menu_icon' => '',
    'last_tab' => '',
    'page_icon' => 'icon-themes',
    'page_slug' => '',
    'save_defaults' => true,
    'default_show' => false,
    'default_mark' => '',
    'show_import_export' => true,
    'transient_time' => 600 * MINUTE_IN_SECONDS,
    'output' => true,
    'output_tag' => true,
    'database' => '',
    'use_cdn' => true,
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'red',
            'shadow' => true,
            'rounded' => false,
            'style' => '',
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'mouseover',
            ),
            'hide' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'click mouseleave',
            ),
        ),
    )
);
Redux::setArgs($opt_name, $args);
Redux::set_Section($opt_name, array(
    'title' => esc_html__('General', 'foodota'),
    'id' => 'general-settings',
    'customizer_width' => '450px',
    'desc' => '',
    'fields' => array(
        array(
            'id' => 'prop_site_spinner',
            'type' => 'switch',
            'title' => esc_html__('Show Site Preloader', 'foodota'),
            'default' => true,
            'desc' => esc_html__('Turn on or off site loader.', 'foodota'),
        ),
        array(
            'id' => 'food_demo',
            'type' => 'switch',
            'title' => esc_html__('Demo Mode', 'foodota'),
            'default' => false,
            'desc' => esc_html__("Only for demo purpose don't enable on your site.", 'foodota'),
        ),
        array(
            'id' => 'prop_site_spinner',
            'type' => 'switch',
            'title' => esc_html__('Show Site Preloader', 'foodota'),
            'default' => true,
            'desc' => esc_html__('Turn on or off site loader.', 'foodota'),
        ),
        array(
            'id' => 'spinner_image',
            'type' => 'media',
            'url' => true,
            'subsection' => true,
            'title' => esc_html__('upload your site spinner GIF', 'foodota'),
            'compiler' => 'true',
            'desc' => esc_html__('Upload your site spinner image size 150px X 150px', 'foodota'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'libs/images/options/loading.gif'),
            'required' => array(
                array('prop_site_spinner', '!=', false),
            )
        ),
    )
));

/*Foodota Typography Setting start*/
Redux::set_Section( $opt_name, array(
    'title'  => __( 'Typography', 'foodota' ),
    'id'     => 'typography',
    'icon'   => 'el el-brush',
    'fields' => array(
        array(
            'id'       => 'opt-theme-btn-color',
            'type'     => 'link_color',
            'title'    => __( 'Theme Button Color', 'foodota' ),
            'desc'     => __( 'Please provide main theme button color', 'foodota' ),
            'active'  => false,
            'default'  => array(
                'regular' => '#FFCC00',
                'hover'   => '#231900',
                'active'  => '#231900',
            )
        ),
        array(
            'id'       => 'opt-theme-btn-shadow-color',
            'type'     => 'color_rgba',
            'title'    => __( 'Theme button shoadow color', 'foodota' ),
            'subtitle' => __( 'Pick a show color for the theme buttons', 'foodota' ),
            'mode'     => 'background',
            'default'  => array(
                'color' => '#7e33dd',
                'alpha' => '.8',
                'rgba' => 'rgba(0,0,0,0.5)'
            ),
        ),

        array(
            'id'       => 'opt-theme-btn-text-color',
            'type'     => 'link_color',
            'title'    => __( 'Theme button Text color', 'foodota' ),
            'subtitle' => __( 'Pick a show color for the theme buttons', 'foodota' ),
            'active'  => false,
            'default'  => array(
                'regular' => '#231900',
                'hover'   => '#FFF',
                'active'  => '#FFF',
            )
        ),
        array(
            'id'       => 'second-opt-theme-btn-color',
            'type'     => 'link_color',
            'title'    => __( 'Secondary Theme Button Color', 'foodota' ),
            'desc'     => __( 'Please provide secondary theme button color', 'foodota' ),
            'active'  => false,
            'default'  => array(
                'regular' => '#231900',
                'hover'   => '#FFCC00',
                'active'  => '#FFCC00',
            )
        ),
        array(
            'id'       => 'second-opt-theme-btn-shadow-color',
            'type'     => 'color_rgba',
            'title'    => __( 'Theme button shoadow color', 'foodota' ),
            'subtitle' => __( 'Pick a show color for the theme buttons', 'foodota' ),
            'default'  => array(
                'color' => '#7e33dd',
                'alpha' => '.8',
                'rgba' => 'rgba(0,0,0,0.5)'
            ),
            'mode'     => 'background',
        ),
        array(
            'id'       => 'second-opt-theme-btn-text-color',
            'type'     => 'link_color',
            'title'    => __( 'Secondary button Text color', 'foodota' ),
            'subtitle' => __( 'Pick a show color for the secondary theme buttons', 'foodota' ),
            'active'  => false,
            'default'  => array(
                'regular' => '#FFF',
                'hover'   => '#231900',
                'active'  => '#231900',
            )
        ),
        array(
            'id'       => 'opt-sticky-header',
            'type'     => 'link_color',
            'active'   => false,
            'title'    => __( 'The Sticky Header Menu color', 'foodota' ),
            'subtitle' => __( 'Pickup Sticky Menu color', 'foodota' ),
            'default'  => array(
                'regular' => '#231900',
                'hover'   => '#231900',
            )
        ),
        array(
            'id'       => 'section-bg-white',
            'type'     => 'link_color',
            'title'    => __( 'Section Background White  Heading Scheme', 'foodota' ),
            'subtitle' => __( 'Pickup the Color Scheme for White Section', 'foodota' ),
            'active'  => false,
            'default'  => array(
                'color' => '#231900',
            )
        ),
        array(
            'id'       => 'section-bg-dark',
            'type'     => 'link_color',
            'title'    => __( 'Section Background Dark  Heading Scheme', 'foodota' ),
            'subtitle' => __( 'Pickup the Color Scheme for Dark Section', 'foodota' ),
            'active'  => false,
            'default'  => array(
                'color' => '#FFF',
            )
        ),



        array(
            'id'       => 'opt-typography-body',
            'type'     => 'typography',
            'title'    => __( 'Body Font and details', 'foodota' ),
            'subtitle' => __( 'Specify the body font properties.', 'foodota' ),
            'google'   => true,
            'subsets'  => false,
            'text-align' => false,
            'font-size' => true,
            'line-height' => false,
            'output' => array('body'),
            'default'  => array(
                'color'       => '#4e4e4e',
                'font-size'   => '16px',
                'font-family' => 'Nunito',
                'font-weight' => '400',
            ),
        ),

        array(
            'id'       => 'opt-typography-common',
            'type'     => 'typography',
            'title'    => __( 'Common Font Heading Settings', 'foodota' ),
            'subtitle' => __( 'Specify the body font properties.', 'foodota' ),
            'google'   => true,
            'subsets'  => false,
            'text-align' => false,
            'line-height' => false,
            'font-weight' => false,
            'font-size' => false,
            'default'  => array(
                'color'       => '#231900',
                'font-family' => 'Montserrat',
                'font-weight' => '600',
            ),
        ),
        array(
            'id'       => 'opt-typography-tags',
            'type'     => 'typography',
            'title'    => __('Common Tag Settings', 'foodota'),
            'subtitle' => __('Specify All Common Tags font properties.', 'foodota'),
            'google'   => true,
            'subsets'  => false,
            'text-align' => false,
            'line-height' => false,
            'font-size'  => false,
            'default'  => array(
                'color'       => '#4e4e4e',
                'font-family' => 'Nunito',
                'font-weight' => '400',
            ),
        ),


    )
) );
/*Foodota Typography Setting close*/
Redux::set_Section($opt_name, array(
    'title' => esc_html__('Profile Settings', 'foodota'),
    'id' => 'profile-settings',
    'desc' => esc_html__('These are really basic fields to setup theme!', 'foodota'),
    'icon' => 'el el-wrench'
));
Redux::set_Section($opt_name, array(
    'title' => esc_html__('Header Profile Pages Settings', 'foodota'),
    'id' => 'pro-settings',
    'subsection' => true,
    'customizer_width' => '450px',
    'desc' => '',
    'fields' => array(
        array(
            'id' => 'register_button_text',
            'type' => 'text',
            'title' => esc_html__('Restaurant Button Text', 'foodota'),
            'desc' => esc_html__('Please give Register Button Text Here', 'foodota'),
            'default' => esc_html__('Restaurant Register', 'foodota'),
        ),
        array(
            'id' => 'food_register-page',
            'type' => 'select',
            'data' => 'pages',
            'title' => esc_html__('Choose Register page', 'foodota'),
            'default' => false,
            'desc' => esc_html__("Only Choose Registerr  Page.", 'foodota'),
        ),
        array(
            'id' => 'dashboard_button_text',
            'type' => 'text',
            'title' => esc_html__('Dashboard Button Text', 'foodota'),
            'desc' => esc_html__('Please give Dashboard Button Text Here', 'foodota'),
            'default' => esc_html__('User Dashboard', 'foodota'),
        ),
        array(
            'id' => 'food_vendor-dashboard',
            'type' => 'select',
            'data' => 'pages',
            'title' => esc_html__('Choose vendor Dashboard page', 'foodota'),
            'default' => false,
            'desc' => esc_html__("Only Choose Dashboard vendor  Page.", 'foodota'),
        ),
    ),
    ));

Redux::set_Section($opt_name, array(
    'title' => esc_html__('Single Product Pages Settings', 'foodota'),
    'id' => 'single-page-settings',
    'subsection' => true,
    'customizer_width' => '450px',
    'desc' => '',
    'fields' => array(
        array(
            'id' => 'call_order_text',
            'type' => 'text',
            'title' => esc_html__('Call an Order Text', 'foodota'),
            'desc' => esc_html__('Please give Call  an order Text Here', 'foodota'),
            'default' => esc_html__('call and Order in', 'foodota'),
        ),
        array(
            'id' => 'call_order_number',
            'type' => 'text',
            'title' => esc_html__('Call an Order Number', 'foodota'),
            'desc' => esc_html__('Please give Call  an order Number Here', 'foodota'),
            'default' => esc_html__('+92-1243-4567', 'foodota'),
        ),
        array(
            'id' => 'total_cart_text',
            'type' => 'text',
            'title' => esc_html__('Total Cart Text', 'foodota'),
            'desc' => esc_html__('Please give Total Cart Text Here', 'foodota'),
            'default' => esc_html__('Shopping Cart', 'foodota'),
        ),
        array(
            'id' => 'single_cart_page',
            'type' => 'select',
            'data' => 'pages',
            'title' => esc_html__('Choose Single Product Cart  Page ', 'foodota'),
            'default' => false,
            'desc' => esc_html__("Only Choose Shop Single Product Page.", 'foodota'),
        ),
        array(
            'id' => 'single_product_button_text',
            'type' => 'text',
            'title' => esc_html__('Single Product Header Button Text', 'foodota'),
            'desc' => esc_html__('Please give Button Text Here', 'foodota'),
            'default' => esc_html__('Search Products', 'foodota'),
        ),
        array(
            'id' => 'single_product_button_page',
            'type' => 'select',
            'data' => 'pages',
            'title' => esc_html__('Choose Single Product  Page ', 'foodota'),
            'default' => false,
            'desc' => esc_html__("Only Choose Shop Single Product Page.", 'foodota'),
        ),
    )
)
);

Redux::set_Section($opt_name, array(
    'title' => esc_html__('Main Header Setting', 'foodota'),
    'id' => 'main-head',
    'icon' => 'el el-cogs'
));
//Top bar portion start Here!
/* ------------------ Header  ----------------------- */
Redux::set_Section($opt_name, array(
    'title' => esc_html__('Header Settings', 'foodota'),
    'id' => 'real-header',
    'subsection' => true,
    'customizer_width' => '450px',
    'desc' => '',
    'icon' => 'el el-tasks',
    'fields' => array(
        array(
            'id' => 'prop_selected_header',
            'type' => 'image_select',
            'title' => esc_html__('Header Layout', 'foodota'),
            'desc' => esc_html__('Select Header Layout you want to show.', 'foodota'),
            'options' => array(
                '1' => array(
                    'alt' => esc_html__('Header Layout 1', 'foodota'),
                    'img' => esc_url(trailingslashit(get_template_directory_uri())) . 'libs/images/options/header1.png'
                ),
                '2' => array(
                    'alt' => esc_html__('Header Layout 2', 'foodota'),
                    'img' => esc_url(trailingslashit(get_template_directory_uri())) . 'libs/images/options/header2.png'
                ),
            ),
            'default' => '1'
        ),
        array(
            'id' => 'topbar-switch',
            'type' => 'switch',
            'title' => __('Topbar Show/Hide', 'foodota'),
            'subtitle' => __('Hide and Show Top bar', 'foodota'),
            'default' => 'true',
            'required' => array(
                array('prop_selected_header', '!=', 1),
            )
        ),
        array(
            'id' => 'opt-multi-select',
            'type' => 'select',
            'multi' => true,
            'title' => __('Topbar Select Pages', 'foodota'),
            'subtitle' => __('Select the number of pages', 'foodota'),
            'desc' => __('Topbar Select Page', 'foodota'),
            'data' => 'pages', // select pages
            'args' => array('posts_per_page' => -1),
            'default' => '',
            'required' => array(
                array('topbar-switch', '!=', false),
            )
        ),
        array(
            'id' => 'opt-text-location',
            'type' => 'text',
            'title' => esc_html__('Top bar Location Field', 'foodota'),
            'desc' => esc_html__('Top bar Location Field', 'foodota'),
            'subtitle' => esc_html__('Please input the Location', 'foodota'),
            'placeholder' => 'input your current location',
            array(
                'validate' => 'not_empty'
            ),
            'required' => array(
                array('topbar-switch', '!=', false),
            ),
        ),
        array(
            'id' => 'opt-text-cell',
            'type' => 'text',
            'title' => esc_html__('Top bar Phone Number Field', 'foodota'),
            'desc' => esc_html__('Phone Number Here!', 'foodota'),
            'subtitle' => esc_html__('Please input the Phone Number', 'foodota'),
            'placeholder' => 'input your phone number!',
            array(
                'validate' => 'not_empty'
            ),
            'required' => array(
                array('topbar-switch', '!=', false),
            ),
        ),
        array(
            'id' => 'prop_main_logo',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Logo Main', 'foodota'),
            'compiler' => 'true',
            'desc' => esc_html__('Upload main logo of your website size should be 180x40 PX.', 'foodota'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'libs/images/options/logo.svg'),
        ),
        array(
            'id' => 'prop_sticky_logo',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Logo Sticky', 'foodota'),
            'compiler' => 'true',
            'desc' => esc_html__('Upload Sticky logo of your website size should be 180x40 PX.', 'foodota'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'libs/images/options/sticky.svg'),
        ),
        array(
            'id' => 'social_media_header',
            'type' => 'sortable',
            'title' => esc_html__('Social Media', 'foodota'),
            'desc' => esc_html__('You can sort it out as you want.', 'foodota'),
            'label' => true,
            'options' => array(
                'Facebook' => '',
                'Twitter' => '',
                'Linkedin' => '',
                'Google' => '',
                'YouTube' => '',
                'Vimeo' => '',
                'Pinterest' => '',
                'Tumblr' => '',
                'Instagram' => '',
                'Reddit' => '',
                'Flickr' => '',
                'StumbleUpon' => '',
                'Delicious' => '',
                'dribble' => '',
                'behance' => '',
                'DeviantART' => '',
            )
        )
    )
));
/* ------------------ Breadcrumbs Fields ----------------------- */
Redux::set_Section($opt_name, array(
    'title' => esc_html__('Breadcrumbs', 'foodota'),
    'id' => 'prop_breads',
    'subsection' => true,
    'customizer_width' => '450px',
    'icon' => 'el el-certificate',
    'fields' => array(
        array(
            'id' => 'prop_selected_bread',
            'type' => 'image_select',
            'title' => esc_html__('Breadcrumb Type', 'foodota'),
            'desc' => esc_html__('Select breadcrumb Layout you want to show.', 'foodota'),
            'options' => array(
                'one' => array(
                    'alt' => esc_html__('Classic', 'foodota'),
                    'img' => esc_url(trailingslashit(get_template_directory_uri())) . 'libs/images/options/bread-style.png'
                ),
            ),
            'default' => 'one'
        ),
        array(
            'id' => 'bread_back',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Breadcrumb Background Image', 'foodota'),
            'compiler' => 'true',
            'desc' => esc_html__('Please give the image size 1583X330 px.', 'foodota'),
        ),
    )
));
/*---------------Restaurants Setting---------------------------*/
Redux::set_Section($opt_name, array(
    'title' => esc_html__('Restaurants Settings', 'foodota'),
    'id' => 'rest-setting',
    'icon' => 'el el-cogs'
));
//Top bar portion start Here!
Redux::set_Section($opt_name, array(
    'title' => esc_html__('Restaurants Pagination Settings', 'foodota'),
    'id' => 'pagenation-set',
    'subsection' => true,
    'icon' => 'el el-arrow-up',
    'fields' => array(
        array(
            'id' => 'number-of-restaurants',
            'type' => 'slider',
            'title' => __('Please Give the Restaurants Show in Pagination', 'foodota'),
            'subtitle' => __('Give the Pagination Indexing.', 'foodota'),
            'desc' => __(' Min: 1, max: 500, step: 1, default value: 9', 'foodota'),
            "default" => 9,
            "min" => 1,
            "step" => 1,
            "max" => 500,
            'display_value' => 'text'
        ),
        array(
            'id' => 'food_search_restaurants',
            'type' => 'select',
            'data' => 'pages',
            'title' => esc_html__('Choose Search Page', 'foodota'),
            'default' => false,
            'desc' => esc_html__("Only Choose Search Page.", 'foodota'),
        ),
        array(
            'id' => 'blog_banner_1',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Please Select the  page Banner', 'foodota'),
            'compiler' => 'true',
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'libs/images/options/banner-x.png'),
            'desc' => esc_html__('Please give the image size 770X100 px.', 'foodota'),
        ),

    )
));
/* ------------------ Blog Page Fields ----------------------- */
Redux::set_Section($opt_name, array(
    'title' => esc_html__('Blog Page Settings', 'foodota'),
    'id' => 'blog',
    'icon' => 'el el-website',
    'fields' => array(
        array(
            'id' => 'social-switch',
            'type' => 'switch',
            'title' => __('Social Media buttons  Show/Hide on Blog Detail page', 'foodota'),
            'subtitle' => __('Social Media Button', 'foodota'),
            'default' => 'true',
        ),
        array(
            'id' => 'social-position',
            'type' => 'button_set',
            'title' => __('Set Social Media buttons Position', 'foodota'),
            'subtitle' => __('You Can choose the Social Media button position', 'foodota'),
            'options' => array(
                '1' => 'Fixed Position',
                '2' => 'Scroll Position',
            ),
            'default' => '1',
            'required' => array(
                array('social-switch', '!=', false),
            ),
        )
    )
));
//Top Footer Setting start Here!
Redux::set_Section($opt_name, array(
    'title' => esc_html__('Footer Settings', 'foodota'),
    'id' => 'main-Footer',
    'icon' => 'el el-cog'
));
//Redux::set_Section($opt_name, array(
//    'title' => esc_html__('Footer Style Settings', 'foodota'),
//    'id' => 'footer-style-menu',
//    'subsection' => true,
//    'icon' => 'el el-bulb',
//    'fields' => array(
//        array(
//            'id' => 'footer-style',
//            'type' => 'image_select',
//            'title' => esc_html__('Chose Footer Style', 'foodota'),
//            'desc' => esc_html__('Select Footer Layout you want to show.', 'foodota'),
//            'options' => array(
//                '1' => array(
//                    'alt' => esc_html__('Footer Layout 1', 'foodota'),
//                    'img' => esc_url(trailingslashit(get_template_directory_uri())) . 'libs/images/options/footer-white.png'
//                ),
//                '2' => array(
//                    'alt' => esc_html__('Footer Layout 2', 'foodota'),
//                    'img' => esc_url(trailingslashit(get_template_directory_uri())) . 'libs/images/options/footer-black.png'
//                ),
//                '3' => array(
//                    'alt' => esc_html__('Footer Layout 3', 'foodota'),
//                    'img' => esc_url(trailingslashit(get_template_directory_uri())) . 'libs/images/options/Footer-3.png'
//                ),
//            ),
//            'default' => '3'
//        ),
//    )
//));
Redux::set_Section($opt_name, array(
    'title' => esc_html__('Footer Links Settings', 'foodota'),
    'id' => 'footer-pages-main',
    'subsection' => true,
    'icon' => 'el el-graph-alt',
    'fields' => array(
        array(
            'id' => 'footer_logo',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Footer Logo', 'foodota'),
            'compiler' => 'true',
            'desc' => esc_html__('Upload main logo of your website size should be 180x40 PX.', 'foodota'),
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'libs/images/options/sticky.svg'),
        ),
        array(
            'id' => 'logo_desc',
            'type' => 'textarea',
            'rows' => '3',
            'title' => esc_html__('Give short description about Restaurants', 'foodota'),
            'default' => esc_html__('One is to focus on the quality of your meat. If you can call out organic beef, sustainable farming.', 'foodota'),

        ),
        array(
            'id' => 'foodota_phone_number',
            'type' => 'text',
            'title' => esc_html__('Restaurant Phone Number', 'foodota'),
            'desc' => esc_html__('Please give Phone number Detail Here', 'foodota'),
            'default' => esc_html__('+92300-400-2333', 'foodota'),

        ),
        array(
            'id' => 'foodota_mail',
            'type' => 'text',
            'title' => esc_html__('Restaurant Email Address', 'foodota'),
            'desc' => esc_html__('Please give Email Address Here', 'foodota'),
            'default' => esc_html__('restaurant@gmail.com', 'foodota'),

        ),
        array(
            'id' => 'our_service_heading',
            'type' => 'text',
            'title' => esc_html__('Our Services Headings', 'foodota'),
            'desc' => esc_html__('Please give our Services headings', 'foodota'),
            'default' => esc_html__('Our Service', 'foodota'),
        ),

        array(
            'id' => 'our_services_links',
            'type' => 'select',
            'multi' => true,
            'title' => esc_html__('Footer Our Services Pages', 'foodota'),
            'subtitle' => __('Select the number of pages', 'foodota'),
            'desc' => esc_html__('Footer Select Pages', 'foodota'),
            'data' => 'pages', // select pages
            'args' => array('posts_per_page' => -1),
        ),
        array(
            'id' => 'latest_news_heading',
            'type' => 'text',
            'title' => esc_html__('Latest News Headings', 'foodota'),
            'desc' => esc_html__('Please give our Latest News headings', 'foodota'),
            'default' => esc_html__('Latest News', 'foodota'),
        ),
        array(
            'id' => 'latest_news_links',
            'type' => 'select',
            'multi' => true,
            'title' => esc_html__('Footer Latest news Post', 'foodota'),
            'subtitle' => esc_html__('Select the number of post', 'foodota'),
            'desc' => esc_html__('Footer Select Latest Post', 'foodota'),
            'data' => 'post', // select pages
            'args' => array('posts_per_page' => -1),
        ),
        array(
            'id' => 'use_full_heading',
            'type' => 'text',
            'title' => esc_html__('Footer Menu Use Full Pages Title', 'foodota'),
            'desc' => esc_html__('Please give the Title of the Pages', 'foodota'),
            'default' => esc_html__('Useful Links', 'foodota'),
        ),
        array(
            'id' => 'use_full_links',
            'type' => 'select',
            'multi' => true,
            'title' => esc_html__('Footer Select Pages', 'foodota'),
            'subtitle' => esc_html__('Select the number of pages', 'foodota'),
            'desc' => esc_html__('Footer Select Pages', 'foodota'),
            'data' => 'pages', // select pages
            'args' => array('posts_per_page' => -1),
        ),

        array(
            'id' => 'copy_right',
            'type' => 'editor',
            'title' => esc_html__('Enter the Copy Rigt Text', 'foodota'),
            'default' => esc_html__('Copyright By Scriptsbundle', 'foodota')
        ),
    )
));
//Social Media start Here!
Redux::set_Section($opt_name, array(
    'title' => esc_html__('Social Fields', 'foodota'),
    'id' => 'social_link',
    'subsection' => true,
    'icon' => 'el el-ok-sign',
    'fields' => array(
        array(
            'id' => 'social-title',
            'type' => 'text',
            'title' => esc_html__('Enter Social Icon Title ', 'foodota'),
            'default' => esc_html__('Social Links', 'foodota')
        ),
        array(
            'id' => 'social_media',
            'type' => 'sortable',
            'title' => esc_html__('Social Media', 'foodota'),
            'desc' => esc_html__('You can sort it out as you want.', 'foodota'),
            'label' => true,
            'options' => array(
                'Facebook' => '',
                'Twitter' => '',
                'Linkedin' => '',
                'Google' => '',
                'YouTube' => '',
                'Vimeo' => '',
                'Pinterest' => '',
                'Tumblr' => '',
                'Instagram' => '',
                'Reddit' => '',
                'Flickr' => '',
                'StumbleUpon' => '',
                'Delicious' => '',
                'dribble' => '',
                'behance' => '',
                'DeviantART' => '',
            ),
            'default' => array(
                'Facebook' => '',
                'Twitter' => '',
                'Linkedin' => '',
                'Google' => '',
                'YouTube' => '',
            ),
        ),
    )
));
//Api Setting
Redux::set_Section($opt_name, array(
    'title' => esc_html__('API Settings', 'foodota'),
    'id' => 'api-main',
    'icon' => 'el el-cog'
));
Redux::set_Section($opt_name, array(
    'title' => esc_html__('Google Map Api Setting', 'foodota'),
    'id' => 'google-map',
    'subsection' => true,
    'icon' => 'el el-bulb',
    'fields' => array(
        array(
            'id' => 'map-switch',
            'type' => 'switch',
            'title' => __('Map Api Show/Hide', 'foodota'),
            'subtitle' => __('Map Api', 'foodota'),
            'default' => false,
        ),
        array(
            'id' => 'map-api-key',
            'type' => 'text',
            'title' => esc_html__('Google Map Api Key', 'foodota'),
            'desc' => esc_html__('Map Key Api', 'foodota'),
            'subtitle' => esc_html__('Please Enter Google Map Api Key', 'foodota'),
            'placeholder' => 'input your Map location api',
            'required' => array('map-switch', '=', true),
        ),
        array(
            'id' => 'radius-search',
            'type' => 'text',
            'title' => esc_html__('Given Distance In KM Search Restaurants', 'foodota'),
            'desc' => esc_html__('Distance KM Search', 'foodota'),
            'subtitle' => esc_html__('Given Distance in Radius Search', 'foodota'),
            'placeholder' => 'input distance For restaurants Search',
            'default' => 10,
            'required' => array('map-switch', '=', true),
        ),
        array(
            'id' => 'map-lati',
            'type' => 'text',
            'title' => esc_html__('Default Latitude', 'foodota'),
            'desc' => esc_html__('Default Latitude', 'foodota'),
            'subtitle' => esc_html__('Set your default map Latitude', 'foodota'),
            'placeholder' => 'input your Map location Latitude',
            'required' => array('map-switch', '=', true),
        ),
        array(
            'id' => 'map-longi',
            'type' => 'text',
            'title' => esc_html__('Default Longitude', 'foodota'),
            'desc' => esc_html__('Default Longitude', 'foodota'),
            'subtitle' => esc_html__('Set your default map Longitude', 'foodota'),
            'placeholder' => 'input your Map location Longitude',
            'required' => array('map-switch', '=', true),
        ),
    )
));
//404 Page Field start Here!
Redux::set_Section($opt_name, array(
    'title' => esc_html__('404 Pages Setting', 'foodota'),
    'id' => 'page_not',
    'icon' => 'el el-remove',
    'fields' => array(
        array(
            'id' => 'sub_not_heading',
            'type' => 'text',
            'title' => esc_html__('Given Page 404 Sub Heading', 'foodota'),
            'default' => esc_html__('OOPS!!!', 'foodota')
        ),
        array(
            'id' => 'main_not_heading',
            'type' => 'text',
            'title' => esc_html__('Given page 404 Main Heading', 'foodota'),
            'default' => esc_html__('Page Not Found', 'foodota')
        ),
        array(
            'id' => 'not_detail',
            'type' => 'textarea',
            'rows' => '3',
            'title' => esc_html__('Given the detail the 404 page', 'foodota'),
            'default' => esc_html__("We're sorry, but the page you were looking for doesn't exist.", 'foodota')
        ),
        array(
            'id' => 'not_text_button',
            'type' => 'text',
            'title' => esc_html__('Given page 404 button Text', 'foodota'),
            'default' => esc_html__('Go To Home', 'foodota')
        ),
        array(
            'id' => 'not_button_link',
            'type' => 'text',
            'title' => esc_html__('Given button Text Link', 'foodota'),
            'default' => esc_url(home_url('/')),
        ),
        array(
            'id' => 'not_image',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Given page 404 Image', 'foodota'),
            'compiler' => 'true',
            'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'libs/images/options/gv.png'),
            'desc' => esc_html__('Please give the image size 750X450 px.', 'foodota'),
        ),
    )
));