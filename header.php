<!DOCTYPE html>
  <html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Kidimat - Votre négociant en matériaux</title>
        
    <?php wp_head(); ?>
  </head>

  <body>
    <?php get_template_part( 'templates/mobile/menu.php' ); ?>
    <div id="header-menu" class="header">
      <div class="container-large">
        <div class="row space-between">
            <a class="logo-icons" href="<?php echo get_site_url(); ?>">
              <img class="" src="<?php echo get_template_directory_uri() ?>/images/logo-kidimat.jpg" alt="Theme logo">
            </a>
            <nav id="navigation-principale" role="navigation" class="">  
              <?php wp_nav_menu( array ("theme_location" => "menu-principal") ); ?>
            </nav>
            
            <div id="icon-cart" class="pt-2">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" class="cart-icon" width="28px" height="32px" viewBox="0 0 28 32" enable-background="new 0 0 28 32" xml:space="preserve"><path class="header-cart-svg" d="M25.996 8.91C25.949 8.4 25.5 8 25 8h-5V6c0-3.309-2.691-6-6-6c-3.309 0-6 2.691-6 6v2H3 C2.482 8 2.1 8.4 2 8.91l-2 22c-0.025 0.3 0.1 0.6 0.3 0.764C0.451 31.9 0.7 32 1 32h26 c0.281 0 0.549-0.118 0.738-0.326c0.188-0.207 0.283-0.484 0.258-0.764L25.996 8.91z M10 6c0-2.206 1.795-4 4-4s4 1.8 4 4v2h-8V6z M24.087 10l1.817 20H2.096l1.817-20"/></svg>
              <div id="cart-count-header">
                <?php $cart_count = WC()->cart->get_cart_contents_count();
                if ( $cart_count > 0 ) : ?> 
                  <span class="cart-count" style="background-color: red"><?php echo $cart_count; ?></span>
                <?php else :?>
                  <span class="cart-count"><?php echo $cart_count; ?></span>
                <?php endif; ?>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div id="MaskLayer"></div>
    <?php get_template_part( 'templates/cart/sidebar-cart.php' ); ?>