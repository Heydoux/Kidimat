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

/* Charger les scripts Javascript */
add_action( 'wp_enqueue_scripts', 'kidimat_enqueue_scripts' );
function kidimat_enqueue_scripts() {
  wp_enqueue_script('init', KIDIMAT_URI . '/js/init.js', array( 'jquery' ), '', 1 ); 
  if (is_front_page()){
    wp_enqueue_script('slider', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '', true); 
    wp_enqueue_script('front-page', KIDIMAT_URI . '/js/front-page.js', array( 'jquery' ), '', 1 ); 
  }  
}
