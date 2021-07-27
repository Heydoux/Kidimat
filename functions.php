<?php

define('KIDIMAT_URI', get_template_directory_uri());

/**
 * Load up shortcodes  
 */
require_once( get_template_directory() . '/shortcodes/slider.php' );


/**
 * Load up core options 
 */
require_once( get_template_directory() . '/core/core.php' );
/**
 * Load Professionnal discount item
 */
//require_once( get_template_directory() . '/woocommerce/discount_professionnals/discount_pro_install.php' );
//require_once( get_template_directory() . '/woocommerce/discount_professionnals/discount_pro_functions.php' );
require_once( get_template_directory() . '/woocommerce/widgets/class-wc-widget-product-categories-kidimat.php');

function wc_register_widgets_kidimat() {
	register_widget( 'WC_Widget_Product_Categories_Kidimat' );
}
add_action( 'widgets_init', 'wc_register_widgets_kidimat' );

/*** Lancer le setup du thème après le lancement du thème  */
if ( ! function_exists( 'kidimat_setup' ) ) {
	function kidimat_setup() {
    /* Rendre le module "Menus" disponible par défaut dans la console administration wordpress
    register_nav_menus( array('menu-principal' => 'Menu principal') );*/
    // Register the wp 3.0 Menus.
		register_nav_menu( 'menu-principal', esc_html__( 'Menu Principal', 'theme' ) );
    register_nav_menu( 'footer', esc_html__( 'Footer', 'theme' ) );
    
    add_theme_support( 'woocommerce');
    //add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
  }
}
add_action( 'after_setup_theme', 'kidimat_setup' );


/* Charger les différentes feuilles de style du thème */
add_action( 'wp_enqueue_scripts', 'kidimat_enqueue_styles' );
function kidimat_enqueue_styles() {
  wp_enqueue_style('theme-style', KIDIMAT_URI . '/style.css', array(), null);
  wp_enqueue_style('general-style', KIDIMAT_URI . '/css/general.css', array(), null);
  wp_enqueue_style('google-font', 'https://fonts.googleapis.com/css2?family=Roboto&display=swap', array(), null);
  wp_enqueue_style('slick-slider', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), null);
  wp_enqueue_style('slick-slider-theme', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', array(), null);
  
  if( is_admin_bar_showing()){
    wp_enqueue_style('admin-style', KIDIMAT_URI . '/css/admin.css', array(), null);
  }
  
  wp_enqueue_style('shop-style', KIDIMAT_URI . '/css/shop.css', array(), null);
  
}

function admin_style() {
  wp_enqueue_style("admin-style", KIDIMAT_URI . '/css/general.css', array(), null);
  wp_enqueue_style("discount-admin", KIDIMAT_URI . '/css/discount.css', array(), null);
  wp_enqueue_script('discount', KIDIMAT_URI . '/js/discount.js', array( 'jquery' ), '', 1, true );
  $admin_handle = 'admin_css';
	$admin_stylesheet = get_template_directory_uri() . '/css/admin.css';

	wp_enqueue_style($admin_handle, $admin_stylesheet);
}
add_action("admin_enqueue_scripts", "admin_style");

/* Charger les scripts Javascript */
add_action( 'wp_enqueue_scripts', 'kidimat_enqueue_scripts' );
function kidimat_enqueue_scripts() {
  wp_enqueue_script('jquerySlim', 'https://code.jquery.com/jquery-3.4.1.slim.min.js', array('jquery'), '', true);
  wp_enqueue_script('init', KIDIMAT_URI . '/js/init.js', array( 'jquery' ), '', 1 ); 
  if (is_front_page()){
    wp_enqueue_script('slider', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '', true); 
    wp_enqueue_script('front-page', KIDIMAT_URI . '/js/front-page.js', array( 'jquery' ), '', 1 ); 
  } elseif (is_account_page()) {
    wp_enqueue_script('account', KIDIMAT_URI . '/js/account.js', array( 'jquery' ), '', 1 ); 
  }
}

/**
* register fields Validating.
*/

function wc_validate_extra_register_fields( $username, $email, $validation_errors ) {

  if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
    $validation_errors->add( 'billing_first_name_error', __( '<strong>Erreur</strong>: Veuillez renseigner votre prénom !', 'woocommerce' ) );
  }

  if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
    $validation_errors->add( 'billing_last_name_error', __( '<strong>Erreur</strong>: Veuillez renseigner votre nom de famille !.', 'woocommerce' ) );
  }
  /*
  if ( isset( $_POST['billing_company'] ) && empty( $_POST['billing_company'] ) ) {
    $validation_errors->add( 'billing_company_error', __( '<strong>Erreur</strong>: Veuillez renseigner le nom de votre entreprise !.', 'woocommerce' ) );
  }
  */
  return $validation_errors;
}

add_action( 'woocommerce_register_post', 'wc_validate_extra_register_fields', 10, 3 );


/**
* Below code save extra fields.
*/

function wc_save_extra_register_fields( $customer_id ) {
  if ( isset( $_POST['billing_first_name'] ) ) {
    //First name field which is by default
    update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
    // First name field which is used in WooCommerce
    update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
  }
  if ( isset( $_POST['billing_last_name'] ) ) {
    // Last name field which is by default
    update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
    // Last name field which is used in WooCommerce
    update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
  }
  if ( isset( $_POST['billing_company'] ) ) {
    // company input filed which is used in WooCommerce
    update_user_meta( $customer_id, 'billing_company', sanitize_text_field( $_POST['billing_company'] ) );
  }
}
add_action( 'woocommerce_created_customer', 'wc_save_extra_register_fields' );

/**
 * Add extra field to user - Company NAF code for reductions on products category according to NAF code.
 */

add_action( 'show_user_profile', 'crf_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'crf_show_extra_profile_fields' );

function crf_show_extra_profile_fields( $user ) {
  $codeNAF = get_the_author_meta( 'code_NAF', $user->ID );
	?>
	<h3><?php esc_html_e( 'Informations entreprise', 'crf' ); ?></h3>

	<table class="form-table">
		<tr>
			<th><label for="code_NAF"><?php esc_html_e( 'Code NAF', 'crf' ); ?></label></th>
			<td>
        <input
          type="text"
          name="code_NAF"
          id="code_NAF"
          value="<?php echo esc_attr($codeNAF); ?>"
          class="regular-text"
        />
        <?php echo esc_html( get_the_author_meta( 'Code NAF', $user->ID ) ); ?></td>
		</tr>
	</table>
	<?php
}


add_action( 'personal_options_update', 'crf_update_profile_fields' );
add_action( 'edit_user_profile_update', 'crf_update_profile_fields' );

function crf_update_profile_fields( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	if ( isset( $_POST['code_NAF'] ) ) {
    update_user_meta( $user_id, 'code_NAF', sanitize_text_field( $_POST['code_NAF'] ) );
	}
}

/**
 * Créer une colonne Entreprise dans la liste des utilisateurs 
 */
function new_modify_user_table( $column ) {
  $column['billing_company'] = 'Entreprise';
  return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );

/**
 * Remplir la nouvelle colonne entreprise avec les données de l'utilisateur (billing_company)
 */
function new_modify_user_table_row( $val, $column_name, $user_id ) {
  switch ($column_name) {
      case 'billing_company' :
          return get_the_author_meta( 'billing_company', $user_id );
      default:
  }
  return $val;
}
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );

/**
 * Permettre de trier la liste des utilisateurs en fonction de l'entreprise de celui-ci
 */

add_filter( 'manage_users_sortable_columns', 'rudr_make_company_column_sortable' );
function rudr_make_company_column_sortable( $columns ) {
	return wp_parse_args( array( 'billing_company' => 'billing_company' ), $columns );
}


// Limit except length to 87 characters.
// tn limited excerpt length by number of characters
function get_excerpt($excerpt, $count ) {
	$excerpt_m = strip_tags($excerpt);
	if (strlen($excerpt_m) > $count){
		$excerpt_m = substr($excerpt_m, 0, $count);
  }
  $excerpt_m = '<p>'.$excerpt_m.'... </p>';
	return $excerpt_m;
}


/**
 * Remove payment from checkout page when delivery choose
 */

add_filter('woocommerce_available_payment_gateways', 'gateway_disable_shipping');

function gateway_disable_shipping( $available_gateways) {
  //print_r($available_gateways);
  global $woocommerce;

  if( !is_admin() ) {
    $chosen_methods = WC()->session->get('chosen_shipping_methods');

    $chosen_shipping = $chosen_methods[0];
    
    if( 0 === strpos($chosen_shipping, 'flat_rate')) {
      if (isset( $available_gateways['bacs'] ))
        unset( $available_gateways['bacs'] );
      if (isset( $available_gateways['payplug'] ))
        unset( $available_gateways['payplug'] );
    } else {
      if (isset( $available_gateways['cod'] ))
        unset( $available_gateways['cod'] );
    }

  }

  return $available_gateways;
}
