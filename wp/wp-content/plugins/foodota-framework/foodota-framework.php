<?php
/**
 * Plugin Name:       Foodota Framework
 * Plugin URI:        https://themeforest.net/user/scriptsbundle/
 * Description:       This plugin is used to addition functionality for foodota theme.
 * Version:           1.0.8
 * Author:            Scripts Bundle
 * Author URI:        https://themeforest.net/user/scriptsbundle/
 * License:           GPL2
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       foodota-framework
 */
define('FOOD_PLUGIN_FRAMEWORK_PATH', plugin_dir_path(__FILE__));
define('FOOD_PLUGIN_URL', plugin_dir_url(__FILE__));
add_action('plugins_loaded', 'foodota_framework_load_plugin_textdomain');
function foodota_framework_load_plugin_textdomain()
{
    load_plugin_textdomain('foodota-framework', FALSE, basename(dirname(__FILE__)) . '/languages/');
}

class RealPage_Meta_Box {

    public function __construct() {

        if ( is_admin() ) {
            add_action( 'load-post.php',     array( $this, 'init_page_metabox' ) );
            add_action( 'load-post-new.php', array( $this, 'init_page_metabox' ) );
        }

    }
    public function init_page_metabox() {

        add_action( 'add_meta_boxes', array( $this, 'add_page_metabox'  )        );
        add_action( 'save_post',      array( $this, 'save_page_metabox' ), 10, 2 );
        add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts_styles')  );
        add_action( 'admin_footer',          array( $this, 'color_field_js' )      );
    }
    public function add_page_metabox() {
        add_meta_box(
            'page_info',
            __( 'Page Settings', 'foodota-framework' ),
            array( $this, 'render_page_metabox' ),
            'page',
            'advanced',
            'default'
        );
    }
    public function render_page_metabox(
        $post ) {
        wp_nonce_field( 'custom_page_nonce_action', 'custom_page_nonce' );
        $show_bread = get_post_meta( $post->ID, 'show_page_bread', true );
        $show_trans = get_post_meta( $post->ID, 'show_trans_header', true );
        $primary_color = get_post_meta( $post->ID, 'primary_color', true );
        if( empty( $show_bread ) ) $show_bread = '';
        if( empty( $show_trans ) ) $show_trans = '';
        if( empty( $primary_color ) ) $primary_color = '#fff';
        echo '<table class="form-table">';
        echo '	<tr>';
        echo '		<th><label for="breadcrumb">' . __( 'Breadcrumb', 'foodota-framework' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="checkbox" id="breadcrumb" name="show_bread" value="1" ' . checked( $show_bread, '1', false ) . '> ';
        echo '			<span class="description">' . __( 'Hide breadcrumb?', 'foodota-framework' ) . '</span>';
        echo '		</td>';
        echo '	</tr>';
        echo '	<tr>';
        echo '		<th><label for="trans_header">' . __( 'Transparent Header', 'foodota-framework' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="checkbox" id="trans_header" name="show_trans" value="1" ' . checked( $show_trans, '1', false ) . '> ';
        echo '			<span class="description">' . __( 'Mark Header As Transparent?', 'foodota-framework' ) . '</span>';
        echo '			<p class="description">' . __( 'Transparent Header will only work on home pages only', 'foodota-framework' ) . '</p>';
        echo '		</td>';
        echo '	</tr>';
        echo '	<tr>';
        echo '		<th><label for="primary_color" >' . __( 'Transparent Menu Color', 'foodota-framework' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="text" id="primary_color" name="primary_color"  value="' . esc_attr__( $primary_color ) . '">';
        echo '			<p class="description">' . __( 'Select primary color', 'foodota-framework' ) . '</p>';
        echo '		</td>';
        echo '	</tr>';

        echo '</table>';

    }
    public function save_page_metabox(
        $post_id, $post ) {
        $show_bread = isset( $_POST[ 'show_bread' ] ) ? '1' : '0';
        $show_trans = isset( $_POST[ 'show_trans' ] ) ? '1' : '0';
        $primary_color = isset( $_POST[ 'primary_color' ] ) ? sanitize_text_field( $_POST[ 'primary_color' ] ) : '#fff';
        update_post_meta( $post_id, 'show_page_bread', $show_bread );
        update_post_meta( $post_id, 'show_trans_header', $show_trans );
        update_post_meta( $post_id, 'primary_color', $primary_color );
    }
    public function load_scripts_styles() {
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_style( 'wp-color-picker' );
    }
    public function color_field_js() {
        if ( did_action( 'RealPage_Meta_Box_color_picker_js' ) >= 1 ) {
            return;
        }
        ?>
        <script>
            jQuery(document).ready(function($){
                $('#primary_color').wpColorPicker();
            });
        </script>
        <?php
        do_action( 'RealPage_Meta_Box_color_picker_js', $this );
    }
}
new RealPage_Meta_Box();
define( 'FOOD_THEMEURL_PLUGIN', get_template_directory_uri () . '/' );
    $plugin_dir_path = plugin_dir_path(__FILE__);
include(FOOD_PLUGIN_FRAMEWORK_PATH. 'include/widgets/restaurant-filters.php');
include(FOOD_PLUGIN_FRAMEWORK_PATH. 'include/widgets/restaurant-categories-filter.php');
include(FOOD_PLUGIN_FRAMEWORK_PATH. 'include/widgets/restaurant-product-sale.php');
include(FOOD_PLUGIN_FRAMEWORK_PATH. 'include/widgets/restaurant-top-sale-product.php');
include(FOOD_PLUGIN_FRAMEWORK_PATH. 'include/ajax/action.php');
include(FOOD_PLUGIN_FRAMEWORK_PATH. 'include/foodota-demo-data.php');
require_once( FOOD_PLUGIN_FRAMEWORK_PATH. 'include/shortcodes/elementor/elementor-shortcodes.php' );
if (!function_exists('food_auth_string')) {
    function food_auth_string()
    {
        global $foodota_options;
        $maper_key = 0;
        if (isset($foodota_options['map-api-key']) and $foodota_options['map-api-key']!='' ){
            $maper_key =1;
        }else{
            $maper_key =0;
        }
        return array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ajax-nonce'),
            'toestor_title_confirm' => __("Confirmation",'foodota-framework'),
            'toestor_confirm_msssage' => __('Are you Sure You want to Delete','foodota-framework'),
            'toestor_yes_confirm_button' => __('Yes', 'foodota-framework'),
            'toestor_no_confirm_button' => __('NO', 'foodota-framework'),
            'toestor_delete' => __('Successfully Deleted', 'foodota-framework'),
            'toestor_update' => __('Successfully updated', 'foodota-framework'),
            'toestor_error' => __('Something went wrong', 'foodota-framework'),
            'toestor_opps' => __('Opps', 'foodota-framework'),
            'toestor_reg_login_success' => __('Registerad and login Successfully', 'foodota-framework'),
            'toestor_reg_success' => __('Registerad Successfully', 'foodota-framework'),
            'toestor_user_already' => __('User already Exist', 'foodota-framework'),
            'toestor_user_confirm_current_location' => __('Permission for Current Location', 'foodota-framework'),
            'toestor_no_restaurant_found' => __('No Restaurant Found Nearby your Location', 'foodota-framework'),
            'toestor_no_restaurant' => __('No Restaurant Found', 'foodota-framework'),
            'toestor_login_success' => __('Login Successfully', 'foodota-framework'),
            'toestor_account_not_verified' => __('Your account is not verified yet', 'foodota-framework'),
            'toestor_user_pwd_wrong' => __('Invalid email or password', 'foodota-framework'),
            'toestor_success_favorite' => __('Successfully Favorite', 'foodota-framework'),
            'toestor_remove_favorite' => __('Remove From Favorite', 'foodota-framework'),
            'toestor_Login_for_favorite' => __('First Login For Favorite', 'foodota-framework'),
            'toestor_token_field_empty' => __('Code text field can not be empty.', 'foodota-framework'),
            'toestor_invalid_code_entered' => __('Invalid code entered. Please try again.', 'foodota-framework'),
            'toestor_token_success_applied' => __('Token Successfully Applied.', 'foodota-framework'),
            'toestor_token_need_login' => __('Need To Login First.', 'foodota-framework'),
            'toestor_demo_on' => __('Sorry you are in demo mode!', 'foodota-framework'),
            'toestor_cart_check' => __('You can add item only one restaurant!', 'foodota-framework'),
            'toestor_cart_add_item' => __('Your cart has been updated', 'foodota-framework'),
            'toestor_permission_denied' => __('Permission denied ', 'foodota-framework'),
            'google_map_key_value' =>$maper_key
        );
    }
}
add_filter('comment_form_default_fields', 'foodota_hide_cookies_consent');
if (!function_exists('foodota_hide_cookies_consent')) {
    function foodota_hide_cookies_consent($fields)
    {
        $fields['cookies'] = "";
        return $fields;
    }
}
add_filter('comment_form_submit_button', 'foodota_comment_form_submit_button', 10, 2);
if (!function_exists('foodota_comment_form_submit_button')) {
    function foodota_comment_form_submit_button($submit_button, $args)
    {
        $submit_before = '<span class="form-btn-res">';
        $submit_after = '</span>';
        return $submit_before . $submit_button . $submit_after;
    }
}
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
        return $data;
    }
    $filetype = wp_check_filetype( $filename, $mimes );
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4 );
function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );
if (!function_exists('fix_svg')) {
    function fix_svg()
    {
        echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
    }
}
add_action( 'admin_head', 'fix_svg' );
if (!function_exists('foodota_myme_types')) {
    function foodota_myme_types($mime_types)
    {
        $mime_types['svg'] = 'image/svg+xml';
        return $mime_types;
    }
    add_filter('upload_mimes', 'foodota_myme_types', 1, 1);
}
