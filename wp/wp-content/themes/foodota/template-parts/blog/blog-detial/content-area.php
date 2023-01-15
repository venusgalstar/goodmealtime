<?php
global $foodota_options;
$image_alt_id = '';
$get_author_id = get_current_user_id() ? get_current_user_id() : '';
$get_author_gravatar = get_avatar_url($get_author_id);
$blog_banner = get_template_directory_uri() . '/libs/images/options/bread.png';
$b_banner = isset($foodota_options['blog_banner_1']['url']) ? $foodota_options['blog_banner_1']['url'] : $blog_banner;
$post_id = get_the_ID();
$post_cats = foodota_blog_categories($post_id);
$count = 0;
?>
<div class="col-xxl-8 col-xl-8 col-md-8 col-lg-8 mx-auto">
    <div class="res-blog2-main-content">
        <div class="res-blog2-main-content post-desc">
            <div class="res-blog2-text-area">
                <?php foreach ($post_cats as $cat_data) { ?>
                    <span><a href="<?php echo esc_url($cat_data['cat_link']); ?>"><?php echo esc_html($cat_data['name']); ?></a></span>
                    <?php $count++;
                    if ($count == 3) {
                        break;
                    }
                } ?>
                <h3><?php the_title(); ?></h3>
            </div>
			<div class="post-detial-commenting-meta">
            <ul class="list-unstyled no-left-pad">
            <li class="list-inline-item blg-pdate">
						<span class="meta-icon ">
							<span class="screen-reader-text"><?php esc_html__( 'Post date', 'foodota' ); ?></span>
							<i class="fa fa-calendar"></i>
						</span>
						<span class="meta-text posted-date">
							<a href="<?php esc_url(the_permalink()); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
						</span>
					</li>
                    
                    <li class="list-inline-item blg-comments">
						<span class="meta-icon">
							<i class="fa fa-comment"></i>
						</span>
						<span class="meta-text">
							<?php comments_popup_link(); ?>
						</span>
					</li>
                    </ul>
            
            </div>
            <div class="res-blog2-img">
                <?php
                $margin_class = '';
                if (has_post_thumbnail()) {
                    $margin_class = 'mb-30';
                    ?>
                    <div class="<?php echo esc_attr($margin_class); ?>">
                        <?php
                        the_post_thumbnail('foodota-blog-thumb-detail');
                        ?>
                    </div>
                    <?php
                }
                the_content();
                ?>
                <?php
                wp_link_pages(array(
                    'before' => '<div class="page_with_pagination"><div class="page-links">', 'after' => '</div></div>', 'next_or_number' => 'number', 'link_before' => '<span class="no">', 'link_after' => '</span>'));
                ?>
            </div>
            <?php comments_template('', true); ?>
        </div>
    </div>
</div>