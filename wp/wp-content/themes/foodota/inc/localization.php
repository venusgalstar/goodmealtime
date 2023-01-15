<?php
// Theme localization Fields
if (!function_exists('foodota_localization')) {
    function foodota_localization()
    {
        global $localization;
        $localization = array
        (
            'page' => esc_html__('Page', 'foodota'),
            'off' => esc_html__('of', 'foodota'),
            'opration_success' => esc_html__('Operation completed!', 'foodota'),
            'eror_email' => esc_html__('Invalid email or password.', 'foodota'),
        );
        return $localization;
    }
}
add_action('after_theme_setup', 'foodota_localization');
if (!function_exists('foodota_localization_msgs')) {
    function foodota_localization_msgs()
    {
        global $messages;
        $messages = array
        (
            'name_error' => esc_html__('Name field is required.', 'foodota'),
        );
        return $messages;
    }
}
add_action('after_theme_setup', 'foodota_localization_msgs');