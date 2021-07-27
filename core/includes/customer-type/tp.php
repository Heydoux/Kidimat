<?php 
/**
 * Theme Kidimat
 *
 * WooCommerce Travaux Publiques customer functions & definitions.
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
 * Ajouter le role de "client tp"
 */
add_role(
	'travaux publiques',
	_('Travaux publiques'),
	array(
		'read' => true,
	)
);

/**
 *  Ajouter le champs prix tp à la page création de produit
 */ 
add_action('woocommerce_product_options_pricing', 'wc_cost_tp_product_field');

function wc_cost_tp_product_field(){
	woocommerce_wp_text_input( array( 'id' => 'prix_tp', 'class' => 'wc_input_price_short', 'label' => __( 'Prix Travaux Publiques', 'woocommerce' ) . ' (' . get_woocommerce_currency_symbol() . ')' ) );
}

/**
 *  Ajouter le champs prix tp aux variations de produit
 */ 
add_action( 'woocommerce_variation_options_pricing', 'bbloomer_add_prix_tp_to_variations', 10, 3 );
 
function bbloomer_add_prix_tp_to_variations( $loop, $variation_data, $variation ) {
   woocommerce_wp_text_input( array(
		'id' => 'prix_tp[' . $loop . ']',
		'class' => 'short wc_input_price',
		'wrapper_class' => 'custom_field_price form-row',
		'label' => __( 'Prix Travaux Publiques', 'woocommerce' ) . ' (' . get_woocommerce_currency_symbol() . ')',
		'value' => get_post_meta( $variation->ID, 'prix_tp', true )
	));
}
add_action( 'save_post', 'wc_cost_save_tp_product' );
function wc_cost_save_tp_product( $product_id ) {

	// stop the quick edit interferring as this will stop it saving properly, when a user uses quick edit feature
	if (wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce'))
		return;

	// If this is a auto save do nothing, we only save when update button is clicked
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
	if ( isset( $_POST['prix_tp'] ) ) {
		if ( is_numeric( $_POST['prix_tp'] ) )
			update_post_meta( $product_id, 'prix_tp', $_POST['prix_tp'] );
	} else delete_post_meta( $product_id, 'prix_tp' );
}

/**
 * 	Save Professionnal price on product variation save
 */
add_action( 'woocommerce_save_product_variation', 'bbloomer_save_prix_tp_variations', 10, 2 );
 
function bbloomer_save_prix_tp_variations( $variation_id, $i ) {
   $prix_tp = $_POST['prix_tp'][$i];
	 if ( isset( $prix_tp ) ) {
		if ( is_numeric( $prix_tp ) )
			update_post_meta( $variation_id, 'prix_tp', esc_attr( $prix_tp ) );
	} else delete_post_meta( $variation_id, 'prix_tp' );
}

/**
 * 	Store Professionnal prices value into variation data
 */

add_filter( 'woocommerce_available_variation', 'wc_tp_price_add_custom_field_variation_data' );
function wc_tp_price_add_custom_field_variation_data( $variations ) {
   $variations['prix_tp'] = '<div class="woocommerce_custom_field">Prix Travaux Publiques : <span>' . get_post_meta( $variations[ 'variation_id' ], 'prix_tp', true ) . '</span></div>';
   return $variations;
}

/**
 * Sauvegarder champs personnalisé (client travaux publiques) du formulaire d'inscription Woocommerce
 */ 
add_action( 'woocommerce_created_customer', 'wc_save_registration_form_fields_tp' );
function wc_save_registration_form_fields_tp( $customer_id ) {
	if ( isset($_POST['role']) ) {
		if( $_POST['role'] == 'travaux publiques' ){
			$user = new WP_User($customer_id);
			$user->set_role('travaux publiques');
		}
	}
}
