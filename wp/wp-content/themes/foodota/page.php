<?php get_header();
if (have_posts()) {
    the_post();
    $post = get_post();

    if ($post && food_is_elementor($post->ID)) {
        the_content();
    }
	else if ( class_exists( 'WooCommerce' ) && (is_cart() || is_checkout() ) ) {
		 the_content();
	}
	else {
		$comments = 'food-comments-disbale';
		if (comments_open() )
		{
			$comments = 'food-comments-enable';
		}

        ?>

        <section class="page-cols-padding blog-detial-page blog-detail-section-2 real-static-page <?php echo esc_attr($comments); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                        <?php
                         get_template_part('template-parts/blog/blog-detial/content-page', 'area');
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
?>
<?php
get_footer(); ?>