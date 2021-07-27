<?php 
/**
 * Theme Kidimat
 *
 * WooCommerce functions and definitions
 *
 * @package WordPress
 * @subpackage Kidimat Themes
 * @author WAP <contact@webagenceparis.com>
 *
 */

/**
 * Change Price Filter Widget Increment (from 10 to 1)
 */ 
function change_price_filter_step() {
	return 0.1;
}
add_filter( 'woocommerce_price_filter_widget_step', 'change_price_filter_step', 10, 3 );

/**
 * Change the breadcrumb separator
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = ' &gt; ';
	return $defaults;
}

/**
 * Remove Locations from category widget
 */

add_filter( 'woocommerce_product_categories_widget_args', 'widget_arguments' );
add_filter('widget_categories_args', 'widget_arguments');
function widget_arguments( $args ) {

$args['exclude'] = '47';

return $args;
}

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 40 );
add_action( 'woocommerce_before_shop_loop', 'filter_number_products', 30 );

if ( ! function_exists( 'filter_number_products' ) ) {
	function filter_number_products() {

		global $wp_query;

		$total = $wp_query->found_posts;
		$paged = max( 1, $wp_query->get( 'paged' ) );
		$limit = 9;

		$first = '';
		$second = '';
		$last = '';

		if ( isset( $_GET['show_products'] ) ) {
			if ( $_GET[ 'show_products' ] == 'all' ) {
				$last = 'active';
			} elseif ( $_GET[ 'show_products' ] == $limit * 2 ) {
				$second = 'active';
			} else {
				$first = 'active';
			}
		} else {
			$first = 'active';
		}

		$page_filter = '<div class="products-page-filter" method="get">';
		$page_filter .= '<span>' .  esc_html__('Produits par page : ') . '</span>';

		if ( $total > $limit ) {
			$page_filter .= '<a class="' . $first . '" href="' . esc_url( add_query_arg( 'show_products', $limit ) ) . '">' . $limit . '</a>';
		}
		if ( $total > $limit * 2 && $paged * $limit * 2 < $total ) {
			$page_filter .= '<a class="' . $second . '" href="' . esc_url( add_query_arg( 'show_products', $limit * 2 ) ) . '">' . $limit * 2 . '</a>';
		}
		if ( $total > $limit ) {
			$page_filter .= '<a class="' . $last . '" href="' . esc_url( add_query_arg( 'show_products', 'all' ) ) . '">' . esc_html__( 'All', 'kidimat' ) . '</a>';
		}

		$page_filter .= '</div>';

		if ( $total > $limit ) {

			echo apply_filters( 'kidimat_filter_number_products_filter', $page_filter );

		}
	}
}


if ( isset( $_GET['show_products'] ) ) {
	if ( $_GET[ 'show_products' ] == 'all' ) {
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return -1;' ) );
	} else {
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '. $_GET[ 'show_products' ] . ';' ) );
	}
} else {
	$limit = 9;
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '. $limit . ';' ) );
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_filter('woocommerce_product_data_store_cpt_get_products_query', 'sam_exclude_cat_query', 10, 2);

function sam_exclude_cat_query($query, $query_vars) {
    if (!empty($query_vars['exclude_category'])) {
        $query['tax_query'][] = array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $query_vars['exclude_category'], // Use the value of previous block of code
            'operator' => 'NOT IN',
        );
    }
    return $query;
}