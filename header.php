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
        <div class="row">
            <a class="logo-icons" href="<?php echo get_site_url(); ?>">
              <img class="" src="<?php echo get_template_directory_uri() ?>/images/logo-kidimat.jpg" alt="Theme logo">
            </a>
            <div class="space-header">
              <div class="d-flex search-and-account space-between">
                <!-- https://www.google.com/maps/search/?api=1&query=kidimat -->
                <?php get_product_search_form() ?>
                <div id="cart-account" class="d-flex">
                  <div id="icon-account" class="icon-header">
                    <a href="<?php echo get_site_url(); ?>/mon-compte">
                      <svg xmlns="http://www.w3.org/2000/svg" width="28px" viewBox="0 0 1000 1000" >
                        <g><path d="M769.5,303.2c0-156.3-126.1-283-281.8-283c-155.6,0-281.8,126.7-281.8,283c0,156.3,126.1,283,281.8,283C643.4,586.1,769.5,459.4,769.5,303.2L769.5,303.2z M255,303.2c0-129.1,104.2-233.7,232.7-233.7c128.5,0,232.8,104.6,232.8,233.7c0,129.1-104.2,233.7-232.8,233.7C359.2,536.9,255,432.3,255,303.2L255,303.2z M10,955.2v24.6h24.5h441h490H990v-24.6c0-220.9-226.7-418.3-490-418.3c-15.8,0-31.6,0.6-47.2,1.9c-13.5,1.1,21.6,13,22.7,26.5c14.3-1.2,10,20.8,24.5,20.8c237.6,0,441,177,441,369.1l24.5-24.6h-490h-441L59,955.2c0-130.7,82.1-250.1,214.4-316.6c12.1-6.1,17-20.9,10.9-33c-6.1-12.2-20.8-17.1-32.9-11C103.4,669,10,804.8,10,955.2L10,955.2z"/></g>
                      </svg>
                    </a>
                  </div>
                  <div id="icon-cart" class="icon-header">
                    <a href="<?php echo get_site_url(); ?>/panier">
                      <svg xmlns="http://www.w3.org/2000/svg" width="32px" viewBox="0 0 48 48">
                        <path d="M39.8,13h-27L11.6,8.5A1.9,1.9,0,0,0,9.7,7H5.6a1.5,1.5,0,0,0,0,3H8.9l5.6,20.5A1.9,1.9,0,0,0,16.4,32H34.7a2.1,2.1,0,0,0,1.9-1.3l5.1-15A2,2,0,0,0,39.8,13ZM34,29H17.2L13.7,16H38.4Z"></path>
                        <path d="M18.9,35a4.5,4.5,0,1,0,0,9,4.5,4.5,0,0,0,0-9Zm0,6a1.5,1.5,0,0,1,0-3,1.5,1.5,0,0,1,0,3Z"></path>
                        <path d="M31.9,35a4.5,4.5,0,0,0,0,9,4.5,4.5,0,1,0,0-9Zm0,6a1.5,1.5,0,0,1,0-3,1.5,1.5,0,1,1,0,3Z"></path>
                      </svg>
                      <div id="cart-count-header" class="d-inline">
                        <?php $cart_count = WC()->cart->get_cart_contents_count();
                        if ( $cart_count > 0 ) : ?> 
                          <span class="cart-count" style="background-color: red"><?php echo $cart_count; ?></span>
                        <?php else :?>
                          <span class="cart-count"><?php echo $cart_count; ?></span>
                        <?php endif; ?>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <nav id="navigation-principale" role="navigation" class="">  
                <?php wp_nav_menu( array ("theme_location" => "menu-principal") ); ?>
              </nav>              
            </div>
        </div>
      </div>
    </div>
    <!--<?php get_template_part( 'templates/cart/sidebar-cart.php' ); ?>-->