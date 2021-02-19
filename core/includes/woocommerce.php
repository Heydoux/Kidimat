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


/**
 *  Ajouter le champs prix pro à la page création de produit
 */ 
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

/**
 * Sauvegarder champs personnalisé (client pro) du formulaire d'inscription Woocommerce
 */ 
add_action( 'woocommerce_created_customer', 'wc_save_registration_form_fields' );
function wc_save_registration_form_fields( $customer_id ) {
    if ( isset($_POST['role']) ) {
        if( $_POST['role'] == 'client professionnel' ){
            $user = new WP_User($customer_id);
            $user->set_role('client professionnel');
        }
    }
}


/**
 * Réécrire le prix du produit par le prix Professionnel si le client pro est log
 */
function wap_change_product_price_display( $price ){
	$post_id = get_the_ID();
	$current_product = wc_get_product( $post_id );

	if (is_cart())
		return $price;

	if (!is_professional_user(get_current_user_id()))
		return $price;

	$professional_price = get_professional_price($post_id);
	

	if(empty($professional_price)){
		return $price;
	}
	
	$html = do_action('wwp_before_pricing');
	$html .= '<span class="woocommerce-Price-amount amount">' . $professional_price;
	$html .= '<span class="woocommerce-Price-currencySymbol">€</span></span>';
	$html .= do_action('wwp_after_pricing');

	return $html;
}
add_filter( 'woocommerce_get_price_html', 'wap_change_product_price_display' );
add_filter( 'woocommerce_cart_item_price', 'wap_change_product_price_display' );

/**
 * Checker si un client loggué est un client professionnel ou particulier
 */
function is_professional_user($user_id) {
	if(!empty($user_id)) {
			$user_info = get_userdata($user_id);
			$user_role = implode(', ', $user_info->roles);

			if($user_role == 'client professionnel')
					return true;
	}
	return false;
}

/**
 * Récupérer le prix professionnel 
 */
function get_professional_price($post_id) {
	$professional_price = get_post_meta($post_id,'prix_pro',true);
	return $professional_price;
}

/**
 * Réécrire le prix du produit dans le panier si l'utilisateur est un client professionnel.
 */
function wap_override_product_price_cart( $_cart ){
	if(is_professional_user(get_current_user_id())) {
		// loop through the cart_contents
		foreach ( $_cart->cart_contents as $cart_item_key => $item ) {
			if(!empty(get_professional_price($item['product_id'])))
				$item['data']->set_price(get_professional_price($item['product_id']));
		}
	}
}
add_action( 'woocommerce_before_calculate_totals', 'wap_override_product_price_cart',99 );