<?php
$pages = '';
global $foodota_options;
$copy_right_titl = isset($foodota_options['copy_right']) ? $foodota_options['copy_right'] : esc_html__('Scriptsbundle', 'foodota');
$footer_default_logo = get_template_directory_uri() . '/libs/images/options/sticky.svg';
$footer_logo_options = isset($foodota_options['footer_logo']['url']) ? $foodota_options['footer_logo']['url'] : '';
$footer_logo_ids = isset($foodota_options['footer_logo']['id']) ? $foodota_options['footer_logo']['id'] : '';
$footer_logo = (isset($footer_logo_options) && !empty($footer_logo_options)) ? $footer_logo_options : $footer_default_logo;
$logo_desc = isset($foodota_options['logo_desc']) ? $foodota_options['logo_desc'] : '';
$restaurant_phone = isset($foodota_options['foodota_phone_number']) ? $foodota_options['foodota_phone_number'] : '';
$restaurant_mail = isset($foodota_options['foodota_mail']) ? $foodota_options['foodota_mail'] : '';
$service_heading = isset($foodota_options['our_service_heading']) ? $foodota_options['our_service_heading'] : '';
$latest_news_heading = isset($foodota_options['latest_news_heading']) ? $foodota_options['latest_news_heading'] : '';
$us_links = isset($foodota_options['use_full_heading']) ? $foodota_options['use_full_heading'] : '';
$suport_links = isset($foodota_options['support_heading']) ? $foodota_options['support_heading'] : '';
$news_title = isset($foodota_options['news_letter_heading']) ? $foodota_options['news_letter_heading'] : '';
$news_text = isset($foodota_options['news_text_area']) ? $foodota_options['news_text_area'] : '';
$news_input = isset($foodota_options['news-email-placeholder']) ? $foodota_options['news-email-placeholder'] : '';
$news_button = isset($foodota_options['news-email-button']) ? $foodota_options['news-email-button'] : esc_html__('Subscribe', 'foodota');
$social_text = isset($foodota_options['social-title']) ? $foodota_options['social-title'] : '';
$opening_hour = isset($foodota_options['opening-hour-title']) ? $foodota_options['opening-hour-title'] : '';
$schedule = isset($foodota_options['schedule']) ? $foodota_options['schedule'] : array();
$dinner_title = isset($foodota_options['dinner-services-title']) ? $foodota_options['dinner-services-title'] : '';
$dinner_time = isset($foodota_options['dinner-schedule']) ? $foodota_options['dinner-schedule'] : array();
$image_alt_id = '';
$allowed_html = foodota_allowed_html_tags();

?>
<footer class="footer-area">
    <div class="footer-content">
        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="row clearfix">
                        <div class="col-lg-7 col-sm-6 col-xs-12 column">
                            <div class="footer-widget about-widget">
                                <div class="logo">
                                    <img src="<?php echo esc_url($footer_logo) ?>"
                                         alt="<?php echo esc_attr(get_post_meta($footer_logo_ids, '_wp_attachment_image_alt', TRUE)); ?>">
                                </div>
								<?php if(!empty($restaurant_phone) || !empty($restaurant_mail)) { ?>
                                <ul class="contact-info">
                                    <li><?php echo esc_html($logo_desc); ?></li>
                                    <li>
                                        <span><?php echo esc_html__('Phone:', 'foodota'); ?></span> <?php echo esc_html($restaurant_phone); ?>
                                    </li>
                                    <li>
                                        <span><?php echo esc_html__('Email:', 'foodota'); ?></span> <?php echo esc_html($restaurant_mail); ?>
                                    </li>
                                </ul>
								<?php } ?>
                                <div class="social-links-two clearfix">
                                    <?php
                                    if (isset($foodota_options['social_media']) && $foodota_options['social_media'] != "") {
                                        foreach ($foodota_options['social_media'] as $index => $val) {
                                            ?>
                                            <?php
                                            if ($val != "") {
                                                ?>
                                                <a class="<?php echo esc_attr($index); ?>"
                                                   href="<?php echo esc_url($val); ?>">
                                                    <i class="<?php echo food_social_icons($index); ?>"></i>
                                                </a><span><a href="<?php echo esc_url($val); ?>"></a></span>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-6 col-xs-12 column">
                            <h2><?php echo esc_html($service_heading); ?></h2>
                            <div class="footer-widget links-widget">
                                <ul>
                                    <?php
                                    if (isset($foodota_options['our_services_links']) ? $foodota_options['our_services_links'] : '')
                                        foreach ($foodota_options['our_services_links'] as $singleValue) {
                                            $post_thumbnail_id = get_post_thumbnail_id($singleValue);
                                            $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
                                            ?>
                                            <li>
                                                <a href="<?php echo esc_url(the_permalink($singleValue)); ?>"><?php echo get_the_title($singleValue); ?></a>
                                            </li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="row clearfix">
                        <!--Footer Column-->
                        <div class="col-lg-7 col-sm-6 col-xs-12 column">
                            <div class="footer-widget news-widget">
                                <h2><?php echo esc_html($latest_news_heading); ?></h2>
                                <?php
                                if (isset($foodota_options['latest_news_links']) ? $foodota_options['latest_news_links'] : '')
                                    foreach ($foodota_options['latest_news_links'] as $singleValue) {
                                        $title = get_the_title($singleValue);
                                        $post_thumbnail = get_the_post_thumbnail($singleValue);
                                        $featured_img_url = get_the_post_thumbnail_url($singleValue, 'thumbnail');
                                        ?>
                                        <div class="news-post ">
                                            <div class="icon"></div>
                                            <div class="news-content">
                                                <figure class="image-thumb"><img class="img-fluid" src="<?php echo esc_url($featured_img_url); ?>" alt="<?php echo esc_attr(get_post_meta($image_alt_id, '_wp_attachment_image_alt', TRUE)); ?>"></figure>
                                                <a href="<?php esc_url(the_permalink($singleValue)); ?>"><?php echo esc_html($title); ?> </a>
                                            </div>
                                            <div class="time"><?php echo get_the_date(get_option('date_format'), $singleValue) ?></div>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <!--Footer Column-->
                        <div class="col-lg-5 col-sm-6 col-xs-12 column">
                            <div class="footer-widget links-widget">
                                <h2><?php echo esc_html($us_links); ?></h2>
                                <ul>
                                    <?php
                                    if (isset($foodota_options['use_full_links']) ? $foodota_options['use_full_links'] : '')
                                        foreach ($foodota_options['use_full_links'] as $singleValue) {
                                            $post_thumbnail_id = get_post_thumbnail_id($singleValue);
                                            $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
                                            ?>
                                            <li>
                                                <a href="<?php esc_url(the_permalink($singleValue)); ?>"><?php echo get_the_title($singleValue); ?></a>
                                            </li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container clearfix">
            <div class="copyright text-center">
                <p> <?php echo wp_kses($copy_right_titl,$allowed_html); ?></p>
            </div>
        </div>
    </div>
</footer>