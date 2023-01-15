<?php
$pages = '';
global $foodota_options;
$copy_right_titl = isset($foodota_options['copy_right']) ? $foodota_options['copy_right'] : esc_html__('Scriptsbundle', 'foodota');
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
<div class="container">
    <div class="row">
        <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-12">
            <div class="res-f-container">
                <div class="heading-panel2">
                    <h3><?php echo esc_html($opening_hour); ?></h3>
                </div>
                <div class="res-f-items">
                    <div class="res-f-icon"><img
                                src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'libs/images/clock-x.png'); ?>"
                                alt="<?php echo esc_attr(get_post_meta($image_alt_id, '_wp_attachment_image_alt', TRUE)); ?>"
                                class="img-fluid"></div>
                    <div class="res-f-detail-2">
                        <?php if (is_array($schedule) && !empty($schedule)) {
                            for ($i = 0; count($schedule) > $i; $i++)
                                echo '<p>' . foodota_color_text($schedule[$i]) . '</p>';
                        } ?>
                    </div>
                </div>
                <div class="res-f-items">
                    <div class="heading-panel2">
                        <h3><?php echo esc_html($dinner_title); ?></h3>
                    </div>
                    <div class="res-f-icon"><img
                                src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'libs/images/clock-x.png'); ?>"
                                alt="<?php echo esc_attr(get_post_meta($image_alt_id, '_wp_attachment_image_alt', TRUE)); ?>"
                                class="img-fluid"></div>
                    <div class="res-f-detail-2">
                        <?php if (is_array($dinner_time) && !empty($dinner_time)) {
                            for ($i = 0; count($dinner_time) > $i; $i++)
                                echo '<p>' . foodota_color_text($dinner_time[$i]) . '</p>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-12">
            <div class="res-f-content2 section-padding">
                <div class="heading-panel2">
                    <h3><?php echo esc_html($news_title); ?></h3>
                    <p><?php echo esc_html($news_text); ?></p>
                </div>
                <div class="res-f-social">
                    <div class="heading-panel2">
                        <h3><?php echo esc_html($social_text); ?></h3>
                    </div>
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
        <div class="col-xxl-2 col-xl-2 col-lg-6 col-md-6 col-sm-12">
            <div class="res-f-main section-padding">
                <div class="heading-panel2">
                    <h3><?php echo esc_html($us_links); ?></h3>
                </div>
                <?php
                if (isset($foodota_options['use_full_links']) ? $foodota_options['use_full_links'] : '')
                    foreach ($foodota_options['use_full_links'] as $singleValue) {
                        $post_thumbnail_id = get_post_thumbnail_id($singleValue);
                        $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
                        ?>
                        <a href="<?php esc_url(the_permalink($singleValue)); ?>"><?php echo get_the_title($singleValue); ?></a>
                        <?php
                    }
                ?>
            </div>
        </div>
        <div class="col-xxl-2 col-xl-2 col-lg-6 col-md-6 col-sm-12">
            <div class="res-f-main section-padding">
                <div class="heading-panel2">
                    <h3><?php echo esc_html($suport_links); ?></h3>
                </div>
                <?php
                if (isset($foodota_options['support_links']) ? $foodota_options['support_links'] : '')
                    foreach ($foodota_options['support_links'] as $singleValue) {
                        $post_thumbnail_id = get_post_thumbnail_id($singleValue);
                        $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
                        ?>
                        <a href="<?php esc_url(the_permalink($singleValue)); ?>"><?php echo get_the_title($singleValue); ?></a>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="res-f-bottom">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="res-bottom-text text-center">
                    <p> <?php echo wp_kses($copy_right_titl,$allowed_html); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>