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
}

function admin_style() {
  wp_enqueue_style("admin-style", KIDIMAT_URI . '/css/admin.css', array(), null);
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

/** Customize the product category widget */
add_filter('woocommercer_product_categories_widget_args', 'widget_arguments');
add_filter('widget_categories_args', 'widget_arguments');

function widget_arguments( $args ){
  $args['exclude'] = "47";
  return $args;
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
    <tr>
			<th><label for="professional_reductions"><?php esc_html_e( 'Réductions client professionnel', 'crf' ); ?></label></th>
			<td class="row">
        <?php 
        /* Parent => 0 permet d'avoir que les catégories principales sans les sous catégories. 
        $categories = get_categories( array(
            'orderby' => 'name',
            'parent'  => 0
        ) );
        */
        $orderby = 'name';
        $order = 'asc';
        $hide_empty = false ;
        $cat_args = array(
            'orderby'    => $orderby,
            'order'      => $order,
            'hide_empty' => $hide_empty,
            'parent'     => 0
        );
        $product_categories = get_terms( 'product_cat', $cat_args );
        foreach ($product_categories as $category) :
        ?>
        <div class="col-md-3">
          <input type="checkbox" id="'category-'<?php echo esc_attr($category->term_id); ?>" name="<?php echo esc_attr($category->name); ?>" value="<?php echo esc_attr($category->name); ?>">
          <label for="'category-'<?php echo esc_attr($category->term_id); ?>"><?php echo $category->name; ?></label>
        </div>
        <?php endforeach; ?>
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
 * Add menu to manage professionnal reduction 
 */
function add_professional_coupon_menu_redirect() {
  if ( ! $this->should_display_legacy_menu() ) {
    return;
  }

  add_submenu_page(
    'woocommerce',
    __( 'Réductions pro', 'woocommerce' ),
    __( 'Réductions pro', 'woocommerce' ),
    'manage_options',
    'reduc-pro',
    [ $this, 'reduc_pro_menu_moved' ]
  );
}

add_action( 'admin_menu', array( $this, 'add_professional_coupon_menu_redirect' ) );

/**
 * Call back for transition menu item
 */
function reduc_pro_menu_moved() {
  wp_safe_redirect( $this->get_legacy_coupon_url(), 301 );
  exit();
}