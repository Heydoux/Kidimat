<?php
/**
 * Theme Kidimat
 * 
 * Register widgetized area
 *
 * @package WordPress
 * @subpackage Kidimat Themes
 * @author WAP <contact@webagenceparis.com>
 *
 */


function kidimat_widgets_init() {
  register_sidebar( array(
    'name' => esc_html__( 'Main Sidebar', 'kidimat' ),
    'id' => 'main-sidebar',
    'description' => esc_html__( 'This is the main sidebar, used in your blog page (posts, categories, archive and tags)', 'lapin' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<div class="widget-header"><h3 class="widget-title">',
    'after_title' => '</h3></div>',
  ));
  register_sidebar( array(
    'name' => esc_html__( 'Shop Sidebar', 'kidimat' ),
    'id' => 'shop-sidebar',
    'description' => esc_html__( 'The main sidebar used in your shop pages', 'kidimat' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<div class="widget-header"><h3 class="widget-title">',
    'after_title' => '</h3></div>',
  ));
    
}
add_action( 'init', 'kidimat_widgets_init' );

function kidimat_get_template( $template_name, $dir = null ) {
	include( $template_name );
}
