<?php 
/**
 * Template Name: Locations template
 * 
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
*/  

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

  <div id="locations" class="mb-5">
    <div id="main" class="container">

      <div class="py-5 text-center">
        <h1><?php the_title(); ?></h1>
      </div>

      <div class="row">
				<div class="side col-md-3">
				<!-- BEGIN #sidebar -->
					<div id="locations-sidebar" role="complementary">
						
							<aside>
                <h3>Locations sidebar</h3>
							</aside>
						
					</div>
				<!-- END #sidebar -->
				<!-- END col-3 -->
				</div>

        <!-- BEGIN col-9 -->
				<div class="cont col-md-9">

          <!-- BEGIN #content -->
          <div id="content" class="ml-3" role="main">

            <?php 
              $args = array(
                'post_type' 			=> 'product',
                'posts_per_page' 	=> 9,
                'tax_query'				=> array(
                  array(
                    'taxonomy'   	=> 'product_cat',
                    'field'				=> 'slug',
                    'terms'				=> array('locations'),
                    'operator'		=> 'IN'
                  )
                )
              );

              $query = new WP_Query( $args );

            if ( $query->have_posts() ) : ?>

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

                <?php while ( $query->have_posts() ) : $query->the_post(); ?>

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

            <?php endif; 
            wp_reset_postdata();
            ?>

          </div>
          <!-- END #content -->

        </div>
        <!-- END col-9 -->
      </div>
    </div>
  </div>

<?php get_footer(); ?>