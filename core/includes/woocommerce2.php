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
 * Remove woocommerce_cart_totals under collaterals
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 40 );
add_action( 'woocommerce_before_shop_loop', 'filter_number_products', 30 );

if ( ! function_exists( 'filter_number_products' ) ) {
	function filter_number_products() {
		global $wp_query;

		$total = $wp_query->found_posts;
		$paged = max( 1, $wp_query->get( 'paged' ) );
		$limit = 18;

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
		$page_filter .= '<span>' .  pll_e('Produits par page : ') . '</span>';

		if ( $total > $limit ) {
			$page_filter .= '<a class="' . $first . '" href="' . esc_url( add_query_arg( 'show_products', $limit ) ) . '">' . $limit . '</a>';
		}
		if ( $total > $limit * 2 && $paged * $limit * 2 < $total ) {
			$page_filter .= '<a class="' . $second . '" href="' . esc_url( add_query_arg( 'show_products', $limit * 2 ) ) . '">' . $limit * 2 . '</a>';
		}
		if ( $total > $limit ) {
			$page_filter .= '<a class="' . $last . '" href="' . esc_url( add_query_arg( 'show_products', 'all' ) ) . '">' . esc_html__( 'All', 'lapin' ) . '</a>';
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
	$limit = 18;
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '. $limit . ';' ) );
}


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


/**
 * Update header count cart
 */

if ( ! function_exists( 'kidimat_header_icon_cart_fragment' ) ) {
	function kidimat_header_icon_cart_fragment( $fragments ) {
		global $woocommerce;
		ob_start();
		?>
		<div id="cart-count-header">
			<?php $cart_count = WC()->cart->get_cart_contents_count();
			if ( $cart_count > 0 ) : ?> 
				<span class="cart-count" style="background-color: #FF4500"><?php echo $cart_count; ?></span>
			<?php else :?>
				<span class="cart-count"><?php echo $cart_count; ?></span>
			<?php endif; ?>
		</div>
		<?php
		$fragments[ '#cart-count-header' ] = ob_get_clean();
		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'kidimat_header_icon_cart_fragment' );


/**
 * Update sidebar count cart
 */

if ( ! function_exists( 'kidimat_sidebar_icon_cart_fragment' ) ) {
	function kidimat_sidebar_icon_cart_fragment( $fragments ) {
		global $woocommerce;
		ob_start();
		?>
		<div id="cart-count-sidebar">
			<span class="cart-count"><?php pll_e('Articles'); ?><span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span></span>
		</div>
		<?php
		$fragments[ '#cart-count-sidebar' ] = ob_get_clean();
		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'kidimat_sidebar_icon_cart_fragment' );


/**
 * Update sidebar cart
 */

if ( ! function_exists( 'kidimat_sidebar_cart_fragment' ) ) {
	function kidimat_sidebar_cart_fragment( $fragments ) {
		global $woocommerce;
		ob_start();
		?>
    <div id="sidebar-cart-items">
      <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
        <div class="cart-items">
          <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
						$template_directory = get_template_directory_uri();
            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) :
              $product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
              $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
              $product_thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); 
							$template_directory = get_template_directory_uri();
              ?>
              <div class="cart-product">
                <a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>" class="cart-product-thumb"><?php echo $product_thumbnail; ?></a>
                <div class="cart-product-meta">
                  <a class="cart-product-title" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>"><?php echo esc_html( $product_name ); ?></a>
                  <span class="cart-product-price"><span class="label"><?php pll_e('Prix'); ?> : </span><?php echo $product_price; ?></span>
                  <span class="cart-product-quantity"><span class="label"><?php pll_e('Quantité'); ?> : </span><?php echo $cart_item['quantity']; ?></span>
									<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><img src="%s/images/close.png"></a>',
									esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
									__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $cart_item_key ),
									esc_attr( $_product->get_sku() ),
									esc_attr( $template_directory)
								), $cart_item_key ); 
                  ?>
                </div>
              </div>
            <?php endif;
          endforeach; ?>
        </div>
        <div class="cart-subtotal">
          <span><?php pll_e('Sous-total'); ?></span>
          <span class="cart-subtotal-price"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
        </div>
        <div class="checkout-section"><a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="view-checkout"><?php echo apply_filters( 'sidebar_cart_checkoutbtn_filter', pll_e('Finaliser la commande') ); ?></a></div>
      <?php else : ?>
        <div class="no-products">
					<span><?php echo apply_filters( 'sidebar_cart_noproducts_filter', pll_e('Aucun article dans votre panier') ); ?></span>
        </div>
      <?php endif; ?>
    </div>
		<?php
		$fragments[ '#sidebar-cart-items' ] = ob_get_clean();
		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'kidimat_sidebar_cart_fragment' );






/**
 * Afficher "prix professionnel" si le client est enregistré en tant que professionnel 
 */ 
add_action( 'woocommerce_single_product_summary', 'wc_rrp_show', 5 );	
function wc_rrp_show() {
	global $product;		// Do not show this on variable products
	$current_user = wp_get_current_user();
	$user_roles = $current_user->roles;

	if (is_professional_user(get_current_user_id())){
		if ( $product->product_type <> 'variable' ) {
			$rrp = get_post_meta( $product->id, 'prix_pro', true );
			echo '<div class="pro_price">';
			echo '<span class="woocommerce-rrp-price">' . woocommerce_price( $rrp ) . '</span>';			echo '</div>';
		}	
	}
}	
// Optional: To show on archive pages	
add_action( 'woocommerce_after_shop_loop_item_title', 'wc_rrp_show' );