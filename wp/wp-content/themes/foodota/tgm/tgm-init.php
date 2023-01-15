<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme foodota - Real Estate WordPress Theme for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */
/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/tgm/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'foodota_register_required_plugins');

function foodota_register_required_plugins()
{
    $plugins = array(
        array(
            'name' => esc_html__('Gutenberg Template Library & Redux Framework', 'foodota'),
            'slug' => 'redux-framework',
            'source' => '',
            'required' => true,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => esc_url('https://downloads.wordpress.org/plugin/redux-framework.4.3.14.zip'
            ),
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('WCFM - WooCommerce Multivendor Membership', 'foodota'),
            'slug' => 'wc-multivendor-membership',
            'source' => '',
            'required' => true,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => esc_url('https://downloads.wordpress.org/plugin/wc-multivendor-membership.2.10.4.zip'),
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('Woocommerce', 'foodota'),
            'slug' => 'woocommerce',
            'source' => '',
            'required' => true,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => esc_url('https://downloads.wordpress.org/plugin/woocommerce.6.5.1.zip'),
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('Foodota Framework', 'foodota'),
            'slug' => 'foodota-framework',
            'source' => get_template_directory() . '/required-plugins/foodota-framework.zip',
            'required' => true,
            'version' => '1.0.8',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('WCFM - WooCommerce Multivendor Marketplace', 'foodota'),
            'slug' => 'wc-multivendor-marketplace',
            'source' => '',
            'required' => true,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => esc_url('https://downloads.wordpress.org/plugin/wc-multivendor-marketplace.3.5.5.zip'),
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('WCFM - WooCommerce Frontend Manager', 'foodota'),
            'slug' => 'wc-frontend-manager',
            'source' => '',
            'required' => true,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => esc_url('https://downloads.wordpress.org/plugin/wc-frontend-manager.6.6.4.zip'),
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('Elementor', 'foodota'),
            'slug' => 'elementor',
            'source' => '',
            'required' => true,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => esc_url('https://downloads.wordpress.org/plugin/elementor.3.6.5.zip'),
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('Post Views Counter', 'foodota'),
            'slug' => 'post-views-counter',
            'source' => '',
            'required' => true,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => esc_url('https://downloads.wordpress.org/plugin/post-views-counter.1.3.11.zip'),
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('One Click Demo Import', 'foodota'),
            'slug' => 'one-click-demo-import',
            'source' => '',
            'required' => true,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => esc_url('https://downloads.wordpress.org/plugin/one-click-demo-import.3.1.1.zip'),
            'is_callable' => '',
        ),
    );

    $config = array(
        'id' => 'foodota',
        'default_path' => '',
        'menu' => 'tgmpa-install-plugins',
        'has_notices' => true,
        'dismissable' => false,
        'dismiss_msg' => '',
        'is_automatic' => false,
        'message' => '',
    );
    foodota_tgmpa($plugins, $config);
}