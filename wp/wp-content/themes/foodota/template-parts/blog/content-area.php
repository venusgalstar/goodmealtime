<?php
global $foodota_options;
$class="col-xxl-8 col-xl-8 col-md-12 col-lg-12 col-xs-12 col-sm-12";
if (!is_active_sidebar('foodota_blog_sidebar')) {
    $class="col-xxl-12 col-xl-12 col-md-12 col-lg-12 col-xs-12 col-sm-12" ;
}
$active_grid = '';
if (have_posts())
{
	$active_grid = 'grid';
}
?>
<div class="<?php echo esc_attr($class); ?>">
    <div class="content-area">
            <div class="row <?php echo esc_attr($active_grid); ?>">
                <?php get_template_part('template-parts/blog/get-blog', 'posts'); ?>
            </div>
			<?php foodota_pagination(); ?>
    </div>
</div>