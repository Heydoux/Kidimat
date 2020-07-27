<?php
/**
 * Theme  
 * 
 * Template functions and definitions
 *
 * @package WordPress
 * @subpackage Name Themes
 * @author WAP <contact@webagenceparis.com>
 *
 */
?>

<div id="mobile-menu" class="header">
  
  <div class="container">  
    <a id="hamburger-menu" class="my-auto mx-2">
      <img src="<?php echo get_template_directory_uri() ?>/images/hamburger-button.png">
    </a>    

    <a class="logo-icons" href="<?php echo get_site_url(); ?>">
      <img class="" src="<?php echo get_template_directory_uri() ?>/images/logo_theme.jpg" alt="Theme logo">
    </a>

    <div id="icon-cart-mobile" class="my-auto py-0 mr-2">
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" class="cart-icon" width="28px" height="32px" viewBox="0 0 28 32" enable-background="new 0 0 28 32" xml:space="preserve"><path class="header-cart-svg" d="M25.996 8.91C25.949 8.4 25.5 8 25 8h-5V6c0-3.309-2.691-6-6-6c-3.309 0-6 2.691-6 6v2H3 C2.482 8 2.1 8.4 2 8.91l-2 22c-0.025 0.3 0.1 0.6 0.3 0.764C0.451 31.9 0.7 32 1 32h26 c0.281 0 0.549-0.118 0.738-0.326c0.188-0.207 0.283-0.484 0.258-0.764L25.996 8.91z M10 6c0-2.206 1.795-4 4-4s4 1.8 4 4v2h-8V6z M24.087 10l1.817 20H2.096l1.817-20"/></svg>
      <div id="cart-count-header">
        <?php $cart_count = WC()->cart->get_cart_contents_count();
        if ( $cart_count > 0 ) : ?> 
          <span class="cart-count" style="background-color: #FF4500"><?php echo $cart_count; ?></span>
        <?php else :?>
          <span class="cart-count"><?php echo $cart_count; ?></span>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <nav id="navigation-principale" role="navigation" class="d-none">  
    <?php wp_nav_menu( array ("theme_location" => "menu-principal") ); ?>
  </nav>

</div>