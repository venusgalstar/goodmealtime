<?php
global $foodota_options;
$search_data = (isset($foodota_options['food_search_restaurants']) ? $foodota_options['food_search_restaurants'] : '');
$food_search_url = get_permalink($search_data);
$theme_log = get_template_directory_uri() . '/libs/images/options/logo.svg';
$sticky_log = get_template_directory_uri() . '/libs/images/options/sticky.svg';
$logo_options = isset($foodota_options['prop_main_logo']['url']) ? $foodota_options['prop_main_logo']['url'] : $theme_log;
$logo_ids = isset($foodota_options['prop_main_logo']['id']) ? $foodota_options['prop_main_logo']['id'] : '';
$sticky_options = isset($foodota_options['prop_sticky_logo']['url']) ? $foodota_options['prop_sticky_logo']['url'] : '';
$sticky_ids = isset($foodota_options['prop_sticky_logo']['id']) ? $foodota_options['prop_sticky_logo']['id'] : '';
$logo = (isset($logo_options) && !empty($logo_options)) ? $logo_options : $theme_log;
$logo_sticky = (isset($sticky_options) && !empty($sticky_options)) ? $sticky_options : $sticky_log;
$image_alt_id = '';
$city_html='';
$restaurant_html='';
$city = restaurants_all_location('city');
$city= isset($city) ? $city:[];
$city= array_unique($city);
$res_name = restaurants_all_location('res_name');
foreach ($city as $key=>$name){
    $city_html.='<option value="'.$key.'">' .esc_html($name) . '</option>';
}
$my_class='';
$single_product='';
if(get_post_meta( get_the_ID(), 'show_trans_header', true )!="" && get_post_meta( get_the_ID(), 'show_trans_header', true )=="1") {
    $my_class = 'food-header-transparent';
}

if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins')))) {

}else{
    $single_product= 'single-product';
}


?>
<div class="res-header-3 res-header-2 sb-header <?php echo esc_attr($single_product); ?> header-dark  <?php echo esc_attr($my_class); ?>">
    <div class="container-fluid">
        <div class="sb-header-container">
            <div class="logo" data-mobile-logo="<?php echo esc_url($logo_sticky) ?>"
                 data-sticky-logo="<?php echo esc_url($logo_sticky) ?>"><a href="<?php echo esc_url(home_url('/')); ?>"><img
                            src="<?php if($my_class){echo esc_url($logo);}else{echo esc_url($logo_sticky);} ?>"
                            alt="<?php echo esc_attr(get_post_meta($logo_ids, '_wp_attachment_image_alt', TRUE)); ?>"></a>
            </div>
            <div class="burger-menu">
                <div class="line-menu line-half first-line"></div>
                <div class="line-menu"></div>
                <div class="line-menu line-half last-line"></div>
            </div>
            <nav class="sb-menu separate-line submenu-top-border submenu-scale">
                <ul>
                    <?php echo foodota_main_menu('main_theme_menu'); ?>
					<?php if(!empty($city)) { ?>
                    <li class="right-space">
                        <i class="fa fa-crosshairs" aria-hidden="true"></i>
                        <form class="header-form"  method="get"  action="<?php echo esc_url($food_search_url)?>">
                        <div class="form-group">
                            <select data-placeholder="<?php echo esc_attr__('Select From Location', 'foodota') ?>" name="city" class="js-example-basic-single">
                                <option value="AL" selected="selected"><?php echo esc_html__('Select an Location', 'foodota') ?></option>
								<?php
								foreach ($city as $key=>$name)
								{
								?>	
								 <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($name); ?></option>
								<?php	
								}
                                ?>
                            </select>
                        </div>
                        </form>
                    </li>
					<?php } ?>
                    <?php
                    if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins')))) {
                    if (is_user_logged_in()) {
                        $user = wp_get_current_user();
                        global $foodota_options;
                        $user_name = $user->display_name;
                        $user_id = $user->ID;
                        $post_type = 'restaurants';
                        $num_posts = count_user_posts($user_id, $post_type);
                        $food_dashboard_text = (isset($foodota_options['dashboard_button_text']) ? $foodota_options['dashboard_button_text'] : '');
                        $food_profile = (isset($foodota_options['food_vendor-dashboard']) ? $foodota_options['food_vendor-dashboard'] : '');
                        $food_profile_url = get_permalink($food_profile);
                        ?>
                        <li class="list-inline-item   profil-select pro-f head-1">
                            <div class="profile-dropdown">
                                <a href="javascript:void(0)" class="btn btn-secondary" role="button"
                                   id="dropdownMenuLink2" >
                                    <i class="fa fa-user mr-2"></i><span><?php echo esc_html($user_name); ?></span>
                                </a>
                            </div>
                        </li>
                        <li class="color-x"><a href="<?php echo esc_url($food_profile_url); ?>" class="btn btn-theme" >
                                <?php echo esc_html($food_dashboard_text); ?>
                            </a>
                        </li>
                        <?php
                    }else{
                        $food_register_text = (isset($foodota_options['register_button_text']) ? $foodota_options['register_button_text'] : '');
                        $food_register_page = (isset($foodota_options['food_register-page']) ? $foodota_options['food_register-page'] : '');
                        $food_register_url = get_permalink($food_register_page);

                    ?>
                    <li class="color-x"><a href="<?php echo esc_url($food_register_url); ?>" class="btn btn-theme">
                               <?php echo esc_html($food_register_text); ?>
                        </a>
                    </li>
                    <?php
                    }
                    }
                    else{
                        global $woocommerce;
                        $single_order_text = (isset($foodota_options['call_order_text']) ? $foodota_options['call_order_text'] : '');
                        $single_order_number = (isset($foodota_options['call_order_number']) ? $foodota_options['call_order_number'] : '');
                        $single_cart_text = (isset($foodota_options['total_cart_text']) ? $foodota_options['total_cart_text'] : '');
                        $single_cart_page = (isset($foodota_options['single_cart_page']) ? $foodota_options['single_cart_page'] : '');
                        $single_header_button_text = (isset($foodota_options['single_product_button_text']) ? $foodota_options['single_product_button_text'] : '');
                        $single_button_page = (isset($foodota_options['single_product_button_page']) ? $foodota_options['single_product_button_page'] : '');
                        $single_cart_url = get_permalink($single_cart_page);
                        $single_button_url = get_permalink($single_button_page);

                        ?>
                        <li>
                            <div class="for-order">
                                <div class="icon-meta">
                                    <i class="fa fa-truck"></i>
                                </div>
                                <div class="sub-txt">
                                    <p><?php echo esc_html($single_order_text); ?></p>
                                    <h5><?php echo esc_html($single_order_number); ?></h5>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="favourite">
                                <a href="#"><i class="fa fa-heart"></i></a>
                                <span>01</span>
                            </div>
                        </li>
                        <li>
                            <div class="for-shopping">
                                <div class="icon-meta">
                                    <a href="<?php echo esc_url($single_cart_url); ?>"><i class="fa fa-shopping-cart"></i></a>
                                    <span><?php  echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
                                </div>
                                <div class="txt-meta">
                                    <p><?php echo esc_html($single_cart_text); ?></p>
                                    <h5><?php echo $woocommerce->cart->get_cart_total(); ?></h5>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="shopping-btn">
                                <a href="<?php echo esc_url($single_button_url); ?>"> <?php echo esc_html($single_header_button_text); ?></a>
                            </div>
                        </li>

                   <?php }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<div class="clearfix"></div>