<?php
global $foodota_options;
global $post;
$foot_black = '';
$google_icon = get_template_directory_uri() . '/libs/images/icon-google.png';
$post_id = isset($post->ID) ? $post->ID : '';
$thumb_id = get_post_thumbnail_id($post_id);
$image_alt_id = $thumb_url = '';
if ($thumb_id != 0) {
    $thumb_url = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', false);
}
$restaurant_cover = get_template_directory_uri() . '/libs/images/options/p1-x.png';
$res_cover = (isset($thumb_url[0]) && ($thumb_url[0] != '')) ? $thumb_url[0] : $restaurant_cover;
if (isset($foodota_options['footer-style']) && $foodota_options['footer-style'] == 2) {
    $foot_black = "res-footer-2";
}
?>
<section class="res-footer <?php echo esc_attr($foot_black); ?>">
    <?php echo foodota_site_footer(); ?>
</section>
<?php
if (function_exists('foodota_site_spinner')) {
    echo foodota_site_spinner();
}
?>
<button class="scroll-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></button>
<?php
if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    ?>
    <div class="cf-off-canvas">
        <div id="mySidenav" class="sidenav"><a href="javascript:void(0)" class="closebtn" id="closeNav">&times;</a>
            <div class="res-cart-image"><img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()).'libs/images/supermarket.png');?>" alt="<?php echo esc_attr(get_post_meta($image_alt_id, '_wp_attachment_image_alt', TRUE)); ?>" class="img-fluid"></div>
            <div class="cf-canvas-content">
                <div class="heading-panel">
                    <h3><?php echo esc_html__('Your Order', 'foodota'); ?></h3>
                    <div class="bottom-dots  clearfix">
                        <span class="dot line-dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                </div>
                <div class="cf-canvas-checboxes mCustomScrollbar">
                    <div class="cf-order-details">
                        <div class="counter cart-count">
                        </div>
                    </div>
                </div>
            </div>
            <a href="javascript:void(0)">
                <div id="main-order" class="openNav">
                    <span class="svg-cart"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em"  preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path d="M16 3.094L7.094 12H2v6h1.25l2.781 9.281l.219.719h19.5l.219-.719L28.75 18H30v-6h-5.094zm0 2.844L22.063 12H9.938zM4 14h24v2h-.75l-.219.719L24.25 26H7.75l-2.781-9.281L4.75 16H4zm7 3v7h2v-7zm4 0v7h2v-7zm4 0v7h2v-7z" fill="#231900"/></svg></span>
                </div>
            </a>
        </div>
    </div>
    <section class="res-order-box">
        <div class="container-fluid">
            <div class="row">
            </div>
        </div>
    </section>
    <?php
}
?>
<?php get_template_part('template-parts/authorization/password', 'reset'); ?>
<?php get_template_part('template-parts/dashboard/role/assign', 'role'); ?>
<?php get_template_part('template-parts/compare/compare', 'listings'); ?>
<?php
$rtl = 0;
if (is_rtl()) {
    $rtl = 1;
}
?>
<input type="hidden" name="is_rtl" value="<?php echo esc_attr($rtl); ?>">
<?php wp_footer(); ?>
</body>
</html>
