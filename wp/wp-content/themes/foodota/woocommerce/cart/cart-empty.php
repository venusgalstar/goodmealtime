<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */
defined( 'ABSPATH' ) || exit; ?>
<?php
$image_id="";
if (in_array('wc-multivendor-marketplace/wc-multivendor-marketplace.php', apply_filters('active_plugins', get_option('active_plugins'))) && in_array('wc-frontend-manager/wc_frontend_manager.php', apply_filters('active_plugins', get_option('active_plugins'))))
{
?>
<div class="nothing-found text-center"><h3 class="text-capitalize"><?php do_action('woocommerce_cart_is_empty'); ?></h3>
					<img src="<?php echo esc_url(trailingslashit( get_template_directory_uri () ) . "libs/images/emptycart.png"); ?>" alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', TRUE)); ?>" class="img-fluid"></div>
</div>
<?php
}
else
{
?>	
<section class="maxwheels-cart-empty section-padding light-bg">
    <div class="container">
		<div class="row  d-flex justify-content-center">
			<div class="col-xl-8 col-lg-12 col-sm-12 col-12">
				<div class="nothing-found text-center"><h3 class="text-capitalize"><?php do_action('woocommerce_cart_is_empty'); ?></h3>
					<img src="<?php echo esc_url(trailingslashit( get_template_directory_uri () ) . "libs/images/emptycart.png"); ?>" alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', TRUE)); ?>" class="img-fluid"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>