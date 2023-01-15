<?php
// Site Main Logo
if (!function_exists('foodota_site_logo')) {
    function foodota_site_logo()
    {
        $image_id = '';
        $logo = trailingslashit(get_template_directory_uri()) . 'libs/images/logo.svg';
        $is_sticky = trailingslashit(get_template_directory_uri()) . 'libs/images/sticky-logo.png';
        $is_mobile = trailingslashit(get_template_directory_uri()) . 'libs/images/mobile-logo.png';
        global $foodota_options;
        if (get_post_meta(get_the_ID(), 'show_trans_header', true) != "") {
            $logo = trailingslashit(get_template_directory_uri()) . 'libs/images/logo-white.svg';
            if (isset($foodota_options["prop_trans_logo"]["url"]) && $foodota_options["prop_trans_logo"]["url"] != "") {
                $logo = $foodota_options["prop_trans_logo"]["url"];
            }
        } else {
            if (isset($foodota_options["prop_main_logo"]["url"]) && $foodota_options["prop_main_logo"]["url"] != "") {
                $logo = $foodota_options["prop_main_logo"]["url"];
            }
        }
        $stick_logo = $sticky_logo = '';
        if (isset($foodota_options["prop_sticky_logo"]["url"]) && $foodota_options["prop_sticky_logo"]["url"] != "") {
            $sticky_logo = $foodota_options["prop_sticky_logo"]["url"];
            $stick_logo = 'data-sticky-logo="' . $sticky_logo . '"';
        } else {
            $stick_logo = 'data-sticky-logo="' . $is_sticky . '"';
        }
        $is_mobile_logo = $mobile_logo = '';
        if (isset($foodota_options["prop_mobile_logo"]["url"]) && $foodota_options["prop_mobile_logo"]["url"] != "") {
            $mobile_logo = $foodota_options["prop_mobile_logo"]["url"];
            $is_mobile_logo = 'data-mobile-logo="' . $mobile_logo . '"';
        } else {
            $is_mobile_logo = 'data-mobile-logo="' . $is_mobile . '"';
        }
        return '<div class="logo" ' . $stick_logo . ' ' . $is_mobile_logo . '>
                <a href="' . esc_url(home_url("/")) . '"><img src="' . esc_url($logo) . '" alt="' . esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', TRUE)) . '"/></a>
			</div>';
    }
}
// Submit Form Fields
if (!function_exists('foodota_strings')) {
    function foodota_strings($paramz)
    {
        global $foodota_options;
        if (isset($foodota_options[$paramz]) && $foodota_options[$paramz] != "") {
            return $foodota_options[$paramz];
        } else {
            return '';
        }
    }
}
if (!function_exists('foodota_site_logo_only')) {
    function foodota_site_logo_only()
    {
        $image_id = '';
        $logo = trailingslashit(get_template_directory_uri()) . 'libs/images/logo.png';
        global $foodota_options;
        if (isset($foodota_options["prop_main_logo"]["url"]) && $foodota_options["prop_main_logo"]["url"] != "") {
            $logo = $foodota_options["prop_main_logo"]["url"];
        }
        return '<a href="' . esc_url(home_url("/")) . '"><img class="logo-for-auth img-fluid mb-2 mb-md-2" src="' . esc_url($logo) . '" alt="' . esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', TRUE)) . '"/></a>';
    }
}
// Site Footer Logo
if (!function_exists('foodota_site_footer_logo')) {
    function foodota_site_footer_logo()
    {
        global $foodota_options;
        $image_id = '';
        $logo = trailingslashit(get_template_directory_uri()) . 'libs/images/logo-white.svg';
        if (isset($foodota_options["prop_footer_logo"]["url"]) && $foodota_options["prop_footer_logo"]["url"] != "") {
            $logo = $foodota_options["prop_footer_logo"]["url"];
        }
        return '<img src="' . esc_url($logo) . '" alt="' . esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', TRUE)) . '" class="img-fluid" />';
    }
}
// Site Main Header
if (!function_exists('foodota_site_header')) {
    function foodota_site_header()
    {
        $layout = 1;
        if (foodota_strings('prop_selected_header') != "") {
            $layout = foodota_strings('prop_selected_header');
        }
        return get_template_part('template-parts/header/header', $layout);
    }
}
if (!function_exists('foodota_site_footer')) {
    function foodota_site_footer()
    {
        global $foodota_options;
       // $layout = isset($foodota_options ['footer-style']) ? $foodota_options ['footer-style'] : 3;
        return get_template_part('template-parts/footer/footer-3');
//        if ($layout == 1) {
//            return get_template_part('template-parts/footer/footer-1');
//        } elseif ($layout == 2) {
//            return get_template_part('template-parts/footer/footer-2');
//        }elseif ($layout == 3) {
//            return get_template_part('template-parts/footer/footer-3');
//        }
    }
}
// Site Preloader
if (!function_exists('foodota_site_spinner')) {
    function foodota_site_spinner()
    {
        global $foodota_options;
        $your_loading = trailingslashit(get_template_directory_uri()) . 'libs/images/options/loading.gif';
        $food_spinner = isset($foodota_options['spinner_image']['url']) ? $foodota_options['spinner_image']['url'] : $your_loading;
        $spinner_ids = isset($foodota_options['spinner_image']['id']) ? $foodota_options['spinner_image']['id'] : '';
        if (isset($foodota_options['prop_site_spinner']) && $foodota_options['prop_site_spinner'] == true) {
            return '<div class="preloader-site"><div class="lds-ripple"><img src="' . esc_url($food_spinner) . '" alt="' . esc_attr(get_post_meta($spinner_ids, '_wp_attachment_image_alt', TRUE)) . '"></div></div>';
        }
    }
}
// Background Src
if (!function_exists('foodota_bg_src')) {
    function foodota_bg_src($option_name)
    {
        $defual_img = trailingslashit(get_template_directory_uri()) . 'libs/images/defualt-935x754.png';
        global $foodota_options;
        if (isset($foodota_options['prop_auth_def_img']["url"]) && $foodota_options['prop_auth_def_img']["url"] != "") {
            $defual_img = $foodota_options['prop_auth_def_img']["url"];
        }
        if (isset($foodota_options[$option_name]["url"]) && $foodota_options[$option_name]["url"] != "") {
            $defual_img = $foodota_options[$option_name]["url"];
        }
        return 'style'.'=background-image:url(' . esc_url($defual_img ). ')';
    }
}
// Footer Copyrights
if (!function_exists('foodota_footer_copyrights')) {
    function foodota_footer_copyrights()
    {
        global $foodota_options;
        $site_title = get_bloginfo('name');
        $home_link = home_url("/");
        $copyrights_text = '<p> &copy; ' . esc_html__("Copyright", "foodota") . ' ' . date("Y") . ' | ' . esc_html__("All Rights Reserved", "foodota") . ' ' . '<a href="' . esc_url($home_link) . '"> | ' . esc_html($site_title) . '</a></p>';
        if (isset($foodota_options["prop_footer_copyrights"])) {
            $copyrights_text = $foodota_options["prop_footer_copyrights"];
        }
        return $copyrights_text;
    }
}
//solcial media icon function
if (!function_exists('food_social_icons')) {
    function food_social_icons($social_network)
    {
        $social_icons = array(
            'Facebook' => 'fab fa-facebook-f',
            'Twitter' => 'fab fa-twitter',
            'Linkedin' => 'fab fa-linkedin',
            'Google' => 'fab fa-google-plus-g',
            'YouTube' => 'fab fa-youtube',
            'Vimeo' => 'fab fa-vimeo-v',
            'Pinterest' => 'fab fa-pinterest-p',
            'Tumblr' => 'fab fa-tumblr',
            'Instagram' => 'fab fa-instagram',
            'Reddit' => 'fab fa-reddit-alien',
            'Flickr' => 'fab fa-flickr',
            'StumbleUpon' => 'fab fa-stumbleupon',
            'Delicious' => 'fab fa-delicious',
            'dribble' => 'fab fa-dribbble',
            'behance' => 'fab fa-behance',
            'DeviantART' => 'fab fa-deviantart',
        );

        return $social_icons[$social_network];
    }
}

if (!function_exists('foodota_color_text')) {
    function foodota_color_text($str)
    {
        preg_match_all('~<color>([^<]*)</color>~i', $str, $matches);
        $i = 1;
        $found = array();
        foreach ($matches as $key => $val) {
            if ($i == 2) {
                $found = $val;
            }
            $i++;
        }
        foreach ($found as $k) {
            $search = "<color>" . esc_html($k) . "</color>";
            $replace = '<span class="theme-color">' . esc_html($k) . '</span>';
            $str = str_replace($search, $replace, $str);
        }
        return $str;
    }
}
