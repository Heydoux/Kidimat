<?php
/**
 * The Template for displaying single product.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WAP
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>
<?php
    /**
     * woocommerce_before_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
    */
    do_action( 'woocommerce_before_main_content' );
?>
    
<div id="page" class="single-product">

  <div id="page-title-wrap" class="container"> 
    <h3>
      <?php
      the_title();
      ?>
    </h3>
  </div>


	
  <!-- BEGIN #content -->
  <div id="content" role="main">

    <?php while ( have_posts() ) : the_post(); ?>
    <div class="">
      <div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="row container">
          <div class="col-md-6">
            <div class="product-single-image" id="product-single-image-div">
              <?php
                /**
                 * woocommerce_before_single_product_summary hook
                 *
                 * @hooked woocommerce_show_product_sale_flash - 10
                 * @hooked woocommerce_show_product_images - 20
                 */
                do_action( 'woocommerce_before_single_product_summary' );
              ?>
            </div>
            <p class="text-center zoom-img-text">Cliquer sur l'image pour l'agrandir</p>
          </div>
          <div class="col-md-6">
            <?php 
            $current_user = wp_get_current_user();
            $user_roles = $current_user->roles;
          
            if (in_array('client_professionnel', $user_roles)):
            ?>
              <div class="product-summary pb-5 pl-5 custopro">
            <?php else:?>
              <div class="product-summary pb-5 pl-5">
            <?php endif;?>
              <?php
                /**
                 * woocommerce_single_product_summary hook
                 *
                 * @hooked woocommerce_template_single_title - 5
                 * @hooked woocommerce_template_single_rating - 10
                 * @hooked woocommerce_template_single_price - 10
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 */
                do_action( 'woocommerce_single_product_summary' );
              ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <?php 
            /**
             * woocommerce_after_single_product_summary hook
             * 
             * @hooked woocommerce_output_product_data_tabs - 10
             * @hooked woocommerce_upsell_display - 15
             */
            do_action('woocommerce_after_single_product_summary');
            ?>
          </div>
        </div>
      </div>
      <?php
            /**
             * woocommerce_after_main_content hook.
             *
             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
             */
            do_action( 'woocommerce_after_main_content' );
        ?>

    </div>
    <?php endwhile; // end of the loop. ?>

  </div>
  <!-- END #content -->

</div>


<?php get_footer(); ?>