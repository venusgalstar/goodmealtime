<?php get_header();
global $foodota_options;
$image_id = '';
$not_page_imag = get_template_directory_uri() . '/libs/images/options/gv.png';
$button_text = isset($foodota_options['not_text_button']) ? $foodota_options['not_text_button'] : esc_html__('Go To Home', 'foodota');
$button_url = isset($foodota_options['not_button_link']) ? $foodota_options['not_button_link'] : esc_url(home_url('/'));
$not_img = isset($foodota_options['not_image']['url']) ? $foodota_options['not_image']['url'] : $not_page_imag;
?>
<section class="res-404 section-padding-v">
	<div class="container">
		<div class="row">
			<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 align-self-center">
				<div class="res-404-content">
					<span>
						<?php 
						if(isset($foodota_options['sub_not_heading']) && $foodota_options['sub_not_heading'] !='')
					    {
							echo esc_html($foodota_options['sub_not_heading']);
					    }
						else
						{
							echo esc_html__('OOPS!!!', 'foodota');
						}
						?>
					</span>
					<h3><?php 
						if(isset($foodota_options['main_not_heading']) && $foodota_options['main_not_heading'] !='')
					    {
							echo esc_html($foodota_options['main_not_heading']);
					    }
						else
						{
							echo esc_html__('Page Not Found', 'foodota');
						}
						?></h3>
					<p>
					<?php 
						if(isset($foodota_options['not_detail']) && $foodota_options['not_detail'] !='')
					    {
							echo esc_html($foodota_options['not_detail']);
					    }
						else
						{
							echo esc_html__("We're sorry, but the page you were looking for doesn't exist.", 'foodota');
						}
						?>
					</p>
					<a href="<?php echo esc_url($button_url); ?>" class="btn btn-theme"><i class="fa fa-home" aria-hidden="true"></i><?php echo esc_html($button_text); ?>
					</a></div>
			</div>
			<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 ">
				<div><img src="<?php echo esc_url(esc_url($not_img)) ?>" alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', TRUE)); ?>" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>