<?php 
/**
 * Theme Kidimat
 *
 * WooCommerce Paysagiste customer functions & definitions.
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
 * Ajouter le role de "client paysagiste"
 */
add_role(
	'paysagiste',
	_('Paysagiste'),
	array(
		'read' => true,
	)
);

/**
 *  Ajouter le champs prix paysagiste à la page création de produit
 */ 
add_action('woocommerce_product_options_pricing', 'wc_cost_paysagiste_product_field');

function wc_cost_paysagiste_product_field(){
	woocommerce_wp_text_input( array( 'id' => 'prix_paysagiste', 'class' => 'wc_input_price_short', 'label' => __( 'Prix Paysagiste', 'woocommerce' ) . ' (' . get_woocommerce_currency_symbol() . ')' ) );
}

/**
 *  Ajouter le champs prix paysagiste aux variations de produit
 */ 
add_action( 'woocommerce_variation_options_pricing', 'bbloomer_add_prix_paysagiste_to_variations', 10, 3 );
 
function bbloomer_add_prix_paysagiste_to_variations( $loop, $variation_data, $variation ) {
   woocommerce_wp_text_input( array(
		'id' => 'prix_paysagiste[' . $loop . ']',
		'class' => 'short wc_input_price',
		'wrapper_class' => 'custom_field_price form-row',
		'label' => __( 'Prix Paysagiste', 'woocommerce' ) . ' (' . get_woocommerce_currency_symbol() . ')',
		'value' => get_post_meta( $variation->ID, 'prix_paysagiste', true )
	));
}
add_action( 'save_post', 'wc_cost_save_paysagiste_product' );
function wc_cost_save_paysagiste_product( $product_id ) {

	// stop the quick edit interferring as this will stop it saving properly, when a user uses quick edit feature
	if (wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce'))
		return;

	// If this is a auto save do nothing, we only save when update button is clicked
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
	if ( isset( $_POST['prix_paysagiste'] ) ) {
		if ( is_numeric( $_POST['prix_paysagiste'] ) )
			update_post_meta( $product_id, 'prix_paysagiste', $_POST['prix_paysagiste'] );
	} else delete_post_meta( $product_id, 'prix_paysagiste' );
}

/**
 * 	Save Professionnal price on product variation save
 */
add_action( 'woocommerce_save_product_variation', 'bbloomer_save_prix_paysagiste_variations', 10, 2 );
 
function bbloomer_save_prix_paysagiste_variations( $variation_id, $i ) {
   $prix_paysagiste = $_POST['prix_paysagiste'][$i];
	 if ( isset( $prix_paysagiste ) ) {
		if ( is_numeric( $prix_paysagiste ) )
			update_post_meta( $variation_id, 'prix_paysagiste', esc_attr( $prix_paysagiste ) );
	} else delete_post_meta( $variation_id, 'prix_paysagiste' );
}

/**
 * 	Store Professionnal prices value into variation data
 */

add_filter( 'woocommerce_available_variation', 'wc_paysagiste_price_add_custom_field_variation_data' );
function wc_paysagiste_price_add_custom_field_variation_data( $variations ) {
   $variations['prix_paysagiste'] = '<div class="woocommerce_custom_field">Prix Paysagiste : <span>' . get_post_meta( $variations[ 'variation_id' ], 'prix_paysagiste', true ) . '</span></div>';
   return $variations;
}

/**
 * Sauvegarder champs personnalisé (client paysagiste) du formulaire d'inscription Woocommerce
 */ 
add_action( 'woocommerce_created_customer', 'wc_save_registration_form_fields_paysagiste' );
function wc_save_registration_form_fields_paysagiste( $customer_id ) {
	if ( isset($_POST['role']) ) {
		if( $_POST['role'] == 'paysagiste' ){
			$user = new WP_User($customer_id);
			$user->set_role('paysagiste');
		}
	}
}
