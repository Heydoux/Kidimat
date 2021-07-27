<?php
/**
 * Theme Kidimat
 * 
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WAP <contact@webagenceparis.com>
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

<!-- BEGIN #page -->
<div id="shop" class="mb-5">

		<!-- BEGIN #main -->
		<div id="main" class="container">

			<div class="py-5 text-center">
				<h1><?php woocommerce_page_title(); ?></h1>
			</div>

			<?php do_action( 'woocommerce_archive_description' ); ?>

			<!-- BEGIN row -->
			<div class="row">
				<div class="side col-md-3">
				<!-- BEGIN #sidebar -->
					<div id="shop-sidebar" role="complementary">
						<?php if ( ! dynamic_sidebar( 'shop-sidebar' ) ) : ?>
							<aside>
								<?php get_product_search_form(); ?>
							</aside>
						<?php endif; ?>
					</div>
				<!-- END #sidebar -->
				<!-- END col-3 -->
				</div>
				
				<!-- BEGIN col-9 -->
				<div class="cont col-md-9">

					<!-- BEGIN #content -->
					<div id="content" class="ml-3" role="main">
						<?php
							if(!function_exists('wc_get_products')) {
								return;
							}

							$ordering                = WC()->query->get_catalog_ordering_args();
							$ordering['orderby']     = array_shift(explode(' ', $ordering['orderby']));
							$ordering['orderby']     = stristr($ordering['orderby'], 'price') ? 'meta_value_num' : $ordering['orderby'];
							$per_page       				 = apply_filters('loop_shop_per_page', wc_get_default_products_per_row() * wc_get_default_product_rows_per_page());
							$page           				 = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
							$queried_object = get_queried_object();
							$catorder = $queried_object->slug;

							//echo json_encode($per_page);
							
							$products_result = wc_get_products( array(
								'status'               => 'publish',
								'limit'                => $per_page,
								'page'								 => $page,
								'paginate'             => true,
								'orderby'              => $ordering['orderby'],
								'order'                => $ordering['order'],
								'exclude_category'  	 => 'locations',
								'category' 						 => $catorder,  
								'return'							 => 'ids',
							));
							//echo json_encode($products_result);
							wc_set_loop_prop('current_page', $page);
							wc_set_loop_prop('is_paginated', wc_string_to_bool(true));
							wc_set_loop_prop('page_template', get_page_template_slug());
							wc_set_loop_prop('per_page', 9);
							wc_set_loop_prop('total', $products_result->total);
							wc_set_loop_prop('total_pages', $products_result->max_num_pages);
							
							if($products_result->total > 0) {
								?>
								<div class="products-filter text-center">
									<?php do_action( 'woocommerce_before_shop_loop' ); ?>
								</div>
								<?php
								woocommerce_product_loop_start();
									foreach($products_result->products as $product) {
										$post_object = get_post($product);
										setup_postdata($GLOBALS['post'] =& $post_object);
										?>
												<?php 
											$is_location = false;
											$cats = get_the_terms( get_the_ID(), 'product_cat' );
											foreach ($cats as $cat) {
												if ($cat->term_id == 47){
													$is_location = true;
												}
											}
											if (!$is_location):
											?>
										<div class="product-item col-md-4 col-6">
									
										<?php wc_get_template_part( 'content', 'product' ); ?>				
									</div>
									<?php endif; ?>
									<?php
									}
									wp_reset_postdata();
								woocommerce_product_loop_end();
								do_action('woocommerce_after_shop_loop');
							} else {
								do_action('woocommerce_no_products_found'); 
							}

						?>
					</div>
					<!-- END #content -->

				</div>
				<!-- END col-9 -->

			</div>
			<!-- END row -->

		<!-- END #main -->
		</div>

	</div>
	<!-- END #page -->

<?php get_footer(); ?>