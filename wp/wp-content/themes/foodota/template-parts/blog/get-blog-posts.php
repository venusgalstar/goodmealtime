<?php
$class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 grid-item";
if (!is_active_sidebar('foodota_blog_sidebar')) {
    $class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 grid-item" ;
}
if (have_posts()) {
    while (have_posts()) {
        the_post();
        $mrt = '';
        $get_author_id = get_current_user_id() ? get_current_user_id() : '';
        $get_author_gravatar = get_avatar_url($get_author_id);
        $image_alt_id = '';
        if ($get_author_gravatar == '') {
            $get_author_gravatar = trailingslashit(get_template_directory_uri()) . 'libs/images/no-user.png';
        }
        $categories = get_the_category();
        ?>
        <div class="<?php echo esc_attr($class); ?>">
            <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <div class="blog-card">
                <?php
                if (has_post_thumbnail()) {
                    $get_author_gravatar = get_avatar_url($get_author_id);
                    ?><div class="blog-card-header p-0 mx-3 mt-3 position-relative z-index-1" >
                    <?php  the_post_thumbnail('large', array('class' => 'img-fluid border-radius-lg')); ?>
                    </div >
                    <?php
                }
                ?>
                <div class="card-body pt-3">
                    <span class="blog-category text-gradient text-warning text-uppercase text-xs font-weight-bold my-2">
                        <?php if ( ! empty( $categories ) ) {
                            echo esc_html( $categories[0]->name );
                        } ?>
                    </span>
                    <a href="<?php the_permalink(); ?>" class="card-title h5 d-block text-darker">
                        <?php
                        if(!empty(get_the_title())) {
                        ?>
                        <h3><?php echo get_the_title(); ?></h3>
                            <?php
                        }
                        else
                        {
                           echo '<h3>' .esc_html__('Read More...','foodota') . '</h3>';
                        }
                            ?>
                    </a>
                    <p class="blog-card-description mb-4">
                        <?php echo wp_trim_words(get_the_excerpt(), 30); ?>
                    </p>
                    <div class="blog-author align-items-center">
                        <img src="<?php echo esc_url($get_author_gravatar); ?>" alt="<?php esc_attr(get_post_meta($image_alt_id, '_wp_attachment_image_alt', true)); ?>" class="blog-avatar blog-shadow">
                        <div class="blog-name ps-3">
                            <span><?php the_author(); ?></span>
                            <div class="stats">
                                <small><?php echo esc_html(get_the_date( get_option('date_format') ) ); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    get_template_part('template-parts/blog/content', 'none');
}
?>