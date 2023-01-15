<?php get_header(); ?>
    <section class="res-blog-hero foo-cols-padding sec-bg">
        <div class="container">
            <div class="row">
                <?php
                global $foodota_options;
                $layout = '';
                $layout = isset($foodota_options['prop_blog_layout']['enabled']) ? $foodota_options['prop_blog_layout']['enabled'] : '';
                if ($layout): foreach ($layout as $key => $value) {
                    switch ($key) {
                        case 'content':
                            get_template_part('template-parts/blog/content', 'area');
                            break;

                        case 'sidebar':
                            get_template_part('template-parts/blog/sidebar', 'blog');
                            break;
                    }
                }
                else:
                    get_template_part('template-parts/blog/content', 'area');
                    get_template_part('template-parts/blog/sidebar', 'blog');
                endif;
                ?>
            </div>
        </div>
    </section>
<?php get_footer(); ?>