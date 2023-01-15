<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
	<?php
	$col_size = 3;
	if(is_shop() && !is_active_sidebar('mw_shop_sidebar'))
	{
		$col_size = 4;
	}
	if(is_singular(array('product')) && !is_active_sidebar('mw_shop_detialsidebar'))
	{
		$col_size = 4;
	} 
	if ($col_size == 3){$col_size = 'col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12';}
		else if ($col_size == 4){$col_size = 'col-xxl-3 col-xl-4  col-lg-6 col-md-6 col-sm-12 col-12';}
		else if ($col_size == 2){$col_size = 'col-xl-6 col-xxl-6 col-lg-6 col-md-6 col-sm-12 col-12';}
		else if ($col_size == 12){$col_size = 'col-xl-12 col-xxl-12 col-md-12 col-sm-12 col-12';}
		else {$col_size = 'col-xl-6 col-xxl-6 col-lg-6 col-md-6 col-sm-6 col-12';}
		$image_id = $ratings = $featured_img = '';
		$product_id = $product->get_id();
		if (has_post_thumbnail($product_id)) 
		{
			$featured_img = get_the_post_thumbnail($product_id, 'full'); 
		}
        else
		{
			$featured_img = '<img src="'.woocommerce_placeholder_img_src().'" alt="'.esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', TRUE)).'" />';
		}
		
		//categories
		$terms    = get_the_terms($product_id, 'product_cat');
        if ( empty( $terms ) || is_wp_error( $terms ) ) {
            return;
        }
		$timer = $sales_price_to  = $sales_price_from = $on_sale = $product_price = $categories = $link = '';
        $catlinks = array();
        foreach ( $terms as $term )
		{
             $link = get_term_link( $term, 'product_cat' );
             $catlinks[] = sprintf( '<a href="%s">%s</a>',
                esc_url( $link ),
                esc_html( $term->name )
            );
        }
		//categories
		$categories = sprintf( '<div class="category">%s</div>', implode( '<small>,</small> ', $catlinks  ));
		//price
		if($product->get_price_html() )
		{
			$product_price = '<p class="price">
				'.$product->get_price_html().'
			</p>';
		}
		//ratings
		if ( wc_review_ratings_enabled() ) {
			$ratings = wc_get_rating_html( $product->get_average_rating() );
		}
		//on sale
		if ( $product->is_on_sale() )
		{
			$on_sale = apply_filters( 'woocommerce_sale_flash', '<div class="mw-product-onsale">' . esc_html__( 'Sale', 'foodota' ) . '</div>', '', $product );
			$sales_price_from = get_post_meta( $product->get_id(), '_sale_price_dates_from', true );
    	    $sales_price_to  = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
			if(!empty($sales_price_from) && !empty($sales_price_to)) {
			$sales_price_date_to = date("Y/m/d g:i a", $sales_price_to);
			$timer = '<div class="position-absolute single-countdown-mw"><ul class="mw-product-counter" data-countdown-time="'.esc_attr($sales_price_date_to).'"></ul></div>';
			}
		}
		$action_btns = '<div class="details-box-btn">
			<div class="seller-detial">
				'.apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf( '<a class="btn btn-outline-custom btn-block" href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
					esc_url( $product->add_to_cart_url() ),
					esc_attr( $product->get_id() ),
					esc_attr( $product->get_sku() ),
					$product->is_purchasable() ? 'add_to_cart_button' : '',
					esc_attr( $product->get_type() ),
					esc_html( $product->add_to_cart_text() )
				),
				$product).'
			</div>
			<div class="mark-as-fav">
				<a href="'.esc_url(get_the_permalink()).'"> <i class="fas fa-external-link-alt"></i> </a>
			</div>
		</div>';
		//action button
/*		echo '<div class="eq-height '.esc_attr($col_size).' mw-shop-1">
		<div class="mw-product-grid">
			'.$on_sale.'
			<div class="img-contain">
			    '.$timer.'
				<a href="'.esc_url(get_the_permalink($product_id)).'">'.$featured_img.'</a>
			</div>
		<div class="content">
		'.$categories.'
		<h2 class="clr-black">
		  <a href="'.esc_url(get_the_permalink($product_id)).'">'.get_the_title($product_id).'</a>
		</h2>        
		<div class="mw-cont-area d-flex justify-content-between align-items-center">
            	'.$product_price.'
				'.$ratings.'	
		</div>
		'.$action_btns.'
        </div></div></div>';*/


echo '<div class="eq-height '.esc_attr($col_size).' ">
	<div class="food-shop-1">
		<div class="justify-content-end">
			<a href="'.esc_url(get_the_permalink($product_id)).'"><div class="fa fa-shopping-cart like"></div></a>
		</div>
		<div class="product-pic"><a href="'.esc_url(get_the_permalink($product_id)).'">'.$featured_img.' </a></div>
		<div class="item-desz">
		'.$categories.'
		<h5 class="product-name"><a href="'.esc_url(get_the_permalink($product_id)).'">'.get_the_title($product_id).'</a></h5>
		<div class="justify-content-between">
			'.$product_price.'
			'.$ratings.'
		</div>
		</div>
	</div>
	</div>';
?>
