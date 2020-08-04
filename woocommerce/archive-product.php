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
				<h2><?php woocommerce_page_title(); ?></h2>
			</div>

			<?php do_action( 'woocommerce_archive_description' ); ?>

			<!-- BEGIN row -->
			<div class="row">

				<?php
					/**
					 * woocommerce_sidebar hook
					 *
					 * @hooked woocommerce_get_sidebar - 10
					 */
					do_action( 'woocommerce_sidebar' );
				?>
				
				<!-- BEGIN col-9 -->
				<div class="cont col-md-9">

					<!-- BEGIN #content -->
					<div id="content" class="ml-3" role="main">

						<?php if ( have_posts() ) : ?>

							<!--<?php wc_print_notices(); ?>-->

							<div class="products-filter text-center d-flex">

									<?php
										/**
										 * woocommerce_before_shop_loop hook
										 *
										 * @hooked woocommerce_result_count - 20
										 * @hooked woocommerce_catalog_ordering - 30
										 */
										do_action( 'woocommerce_before_shop_loop' );
									?>

							</div>

							<?php woocommerce_product_loop_start(); ?>

								<?php
								global $woocommerce_loop;
								$count = 0;
								$columns = '3';
								?>

								<?php woocommerce_product_subcategories(); ?>

								<?php echo ($woocommerce_loop['loop']) ? '</div>' : ''; ?>

								<?php while ( have_posts() ) : the_post(); ?>

									<?php
									$open = ! ( $count % $columns ) ? '<div class="row w-100">' : '';
									$close = ! ( $count % $columns ) && $count ? '</div>' : '';
									echo $close . $open;
									?>

									<div class="product-item col-md-4 col-6">

										<?php wc_get_template_part( 'content', 'product' ); ?>

									</div>

									<?php $count++; ?>

								<?php endwhile; // end of the loop. ?>

								<?php echo $count ? '</div>' : ''; ?>

							<?php woocommerce_product_loop_end(); ?>

							<?php
								/**
								 * woocommerce_after_shop_loop hook
								 *
								 * @hooked woocommerce_pagination - 10
								 */
								do_action( 'woocommerce_after_shop_loop' );
							?>

						<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

							<?php wc_get_template( 'loop/no-products-found.php' ); ?>

						<?php endif; ?>

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