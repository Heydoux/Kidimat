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
	return 1;
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
 * Ajouter le role de "client professionnel"
 */
add_role(
	'client_professionnel',
	_('Client Professionnel'),
	array(
		'read' => true,
	)
);

add_action('woocommerce_product_options_pricing', 'wc_cost_product_field');
function wc_cost_product_field(){
	woocommerce_wp_text_input( array( 'id' => 'prix_pro', 'class' => 'wc_input_price_short', 'label' => __( 'Prix Pro', 'woocommerce' ) . ' (' . get_woocommerce_currency_symbol() . ')' ) );
}

add_action( 'save_post', 'wc_cost_save_product' );
function wc_cost_save_product( $product_id ) {

     // stop the quick edit interferring as this will stop it saving properly, when a user uses quick edit feature
     if (wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce'))
        return;

    // If this is a auto save do nothing, we only save when update button is clicked
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
	if ( isset( $_POST['prix_pro'] ) ) {
		if ( is_numeric( $_POST['prix_pro'] ) )
			update_post_meta( $product_id, 'prix_pro', $_POST['prix_pro'] );
	} else delete_post_meta( $product_id, 'prix_pro' );
}


add_action( 'woocommerce_single_product_summary', 'wc_rrp_show', 5 );	
function wc_rrp_show() {
	global $product;		// Do not show this on variable products
	$current_user = wp_get_current_user();
	$user_roles = $current_user->roles;

	if (in_array('client_professionnel', $user_roles)){
		if ( $product->product_type <> 'variable' ) {
			$rrp = get_post_meta( $product->id, 'prix_pro', true );
			echo '<div class="pro_price">';
			echo '<span class="woocommerce-rrp-price">' . woocommerce_price( $rrp ) . '</span>';			echo '</div>';
		}	
	}
}	
// Optional: To show on archive pages	
add_action( 'woocommerce_after_shop_loop_item_title', 'wc_rrp_show' );