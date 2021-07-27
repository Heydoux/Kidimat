<?php 
/**
 * Theme Kidimat
 *
 * WooCommerce Macon customer functions & definitions.
 *
 * @package WordPress
 * @subpackage Kidimat Themes
 * @author WAP <contact@webagenceparis.com>
 *
 */

/**
 * Change Price Filter Widget Increment (from 10 to 1)
 */ 

/**
 * Ajouter le role de "client macon"
 */
add_role(
	'macon',
	_('Macon'),
	array(
		'read' => true,
	)
);

/**
 *  Ajouter le champs prix macon à la page création de produit
 */ 
add_action('woocommerce_product_options_pricing', 'wc_cost_macon_product_field');

function wc_cost_macon_product_field(){
	woocommerce_wp_text_input( array( 'id' => 'prix_macon', 'class' => 'wc_input_price_short', 'label' => __( 'Prix Macon', 'woocommerce' ) . ' (' . get_woocommerce_currency_symbol() . ')' ) );
}

/**
 *  Ajouter le champs prix macon aux variations de produit
 */ 
add_action( 'woocommerce_variation_options_pricing', 'bbloomer_add_prix_macon_to_variations', 10, 3 );
 
function bbloomer_add_prix_macon_to_variations( $loop, $variation_data, $variation ) {
   woocommerce_wp_text_input( array(
		'id' => 'prix_macon[' . $loop . ']',
		'class' => 'short wc_input_price',
		'wrapper_class' => 'custom_field_price form-row',
		'label' => __( 'Prix Macon', 'woocommerce' ) . ' (' . get_woocommerce_currency_symbol() . ')',
		'value' => get_post_meta( $variation->ID, 'prix_macon', true )
	));
}
add_action( 'save_post', 'wc_cost_save_macon_product' );
function wc_cost_save_macon_product( $product_id ) {

	// stop the quick edit interferring as this will stop it saving properly, when a user uses quick edit feature
	if (wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce'))
		return;

	// If this is a auto save do nothing, we only save when update button is clicked
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
	if ( isset( $_POST['prix_macon'] ) ) {
		if ( is_numeric( $_POST['prix_macon'] ) )
			update_post_meta( $product_id, 'prix_macon', $_POST['prix_macon'] );
	} else delete_post_meta( $product_id, 'prix_macon' );
}

/**
 * 	Save Professionnal price on product variation save
 */
add_action( 'woocommerce_save_product_variation', 'bbloomer_save_prix_macon_variations', 10, 2 );
 
function bbloomer_save_prix_macon_variations( $variation_id, $i ) {
   $prix_macon = $_POST['prix_macon'][$i];
	 if ( isset( $prix_macon ) ) {
		if ( is_numeric( $prix_macon ) )
			update_post_meta( $variation_id, 'prix_macon', esc_attr( $prix_macon ) );
	} else delete_post_meta( $variation_id, 'prix_macon' );
}

/**
 * 	Store Professionnal prices value into variation data
 */

add_filter( 'woocommerce_available_variation', 'wc_macon_price_add_custom_field_variation_data' );
function wc_macon_price_add_custom_field_variation_data( $variations ) {
   $variations['prix_macon'] = '<div class="woocommerce_custom_field">Prix Macon : <span>' . get_post_meta( $variations[ 'variation_id' ], 'prix_macon', true ) . '</span></div>';
   return $variations;
}

/**
 * Sauvegarder champs personnalisé (client macon) du formulaire d'inscription Woocommerce
 */ 
add_action( 'woocommerce_created_customer', 'wc_save_registration_form_fields_macon' );
function wc_save_registration_form_fields_macon( $customer_id ) {
	if ( isset($_POST['role']) ) {
		if( $_POST['role'] == 'macon' ){
			$user = new WP_User($customer_id);
			$user->set_role('macon');
		}
	}
}
