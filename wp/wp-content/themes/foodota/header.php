<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
if (is_page_template('page-signup.php') && foodota_strings('prop_enable_head_foot') == false || is_page_template('page-vendors.php') || is_page_template('page-signin.php') || is_page_template('page-home.php') || is_page_template('page-restaurant.php') || is_singular(array('post','product')) && foodota_strings('prop_enable_head_foot') == false) {
    echo foodota_site_header();
} else {
    if (function_exists('foodota_site_header')) {
        echo foodota_site_header();
    }
    if (function_exists('foodota_breadcrumb')) {
        echo foodota_breadcrumb();
    }
}