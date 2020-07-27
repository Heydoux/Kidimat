<?php
/**
 * Lapin
 * 
 * The sidebar containing the secondary widget area, displays on shop pages (Woocommerce)
 *
 * @package WordPress
 * @subpackage Lapin Boutique Themes
 * @author WAP <contact@webagenceparis.com>
 *
 */
?>

<!-- BEGIN col-3 -->
<div class="col-md-3">

	<!-- BEGIN #sidebar -->
	<div id="sidebar" role="complementary">
		<?php if ( ! dynamic_sidebar( 'shop-sidebar' ) ) : ?>
			<aside>
				<?php get_product_search_form(); ?>
			</aside>
		<?php endif; ?>
	</div>
	<!-- END #sidebar -->

<!-- END col-3 -->
</div>
