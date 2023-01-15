<?php
/**
 * Grouped product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/grouped.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.8.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $post;

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart grouped_form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
	<div class="shopping-cart-items">
			<?php
			$quantites_required      = false;
			$previous_post           = $post;
			$grouped_product_columns = apply_filters(
				'woocommerce_grouped_product_columns',
				array(
					'quantity',
					'label',
					'price',
				),
				$product
			);
			$show_add_to_cart_button = false;

			do_action( 'woocommerce_grouped_product_list_before', $grouped_product_columns, $quantites_required, $product );
			
			foreach ( $grouped_products as $grouped_product_child ) {
				$post_object        = get_post( $grouped_product_child->get_id() );
				$quantites_required = $quantites_required || ( $grouped_product_child->is_purchasable() && ! $grouped_product_child->has_options() );
				$post               = $post_object; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				setup_postdata( $post );
				if ( $grouped_product_child->is_in_stock() ) {
					$show_add_to_cart_button = true;
				}
				?>
					<div class="card clearfix woocommerce-grouped-product-list-item <?php echo esc_attr( implode( ' ', wc_get_product_class( '', $grouped_product_child ) ) ) ?>" id="<?php echo esc_attr( implode( ' ', wc_get_product_class( '', $grouped_product_child ) ) ) . '" id="product-' . esc_attr( $grouped_product_child->get_id() ); ?>">
						<div class="card-body card-item-right">
							<div class="d-flex align-items-top">
								<div class="bg-warning-light rounded">
									<?php echo woocommerce_get_product_thumbnail('thumbnail'); ?>
								</div>
								<div class="style-text">
									<h4 class="mb-2">
										<a href="<?php echo esc_url($grouped_product_child->get_permalink()); ?>">
										<?php echo wp_trim_words(get_the_title( $grouped_product_child->get_id()),7,'...'); ?>
										</a>
									</h4>
									<div class="item-pric">
									<?php echo ''.$grouped_product_child->get_price_html() . wc_get_stock_html( $grouped_product_child ); ?> 
									</div>	 
									
									<?php 
								if ( ! $grouped_product_child->is_purchasable() || $grouped_product_child->has_options() || ! $grouped_product_child->is_in_stock() ) {
								woocommerce_template_loop_add_to_cart();
							} elseif ( $grouped_product_child->is_sold_individually() ) {
								?>	
									<div class="pretty p-svg p-curve">
										<input class="my-cond" type="checkbox" name="<?php echo esc_attr( 'quantity[' . $grouped_product_child->get_id() . ']' ) ; ?>" value="1">
										<div class="state  p-primary">
											<svg class="svg svg-icon" viewBox="0 0 20 20">
													<path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
												</svg>
											<label></label>
										</div>
									</div>
								<?php	
							} else {
								do_action( 'woocommerce_before_add_to_cart_quantity' );
								woocommerce_quantity_input(
									array(
										'input_name'  => 'quantity[' . $grouped_product_child->get_id() . ']',
										'input_value' => isset( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ? wc_stock_amount( wc_clean( wp_unslash( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ) ) : '', // phpcs:ignore WordPress.Security.NonceVerification.Missing
										'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product_child ),
										'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $grouped_product_child->get_max_purchase_quantity(), $grouped_product_child ),
										'placeholder' => '0',
									)
								);
								do_action( 'woocommerce_after_add_to_cart_quantity' );
							}
							?>
								</div>
							</div>
						</div>
					</div>
					<?php
			}
			$post = $previous_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			setup_postdata( $post );
			do_action( 'woocommerce_grouped_product_list_after', $grouped_product_columns, $quantites_required, $product );
			?>
	</div>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

	<?php if ( $quantites_required && $show_add_to_cart_button ) : ?>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
