<?php
/**
 * Theme Kidimat
 *
 * Template functions and definitions
 *
 * @package WordPress
 * @subpackage Kidimat Themes
 * @author WAP <contact@webagenceparis.com>
 *
 */


?>

<?php global $woocommerce; ?>

<div id="sidebar-cart">
  <div class="sidebar-content">
    <div class="sidebar-links">
      <div id="cart-count-sidebar">
        <span class="cart-count"><?php pll_e('Articles'); ?><span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span></span>
      </div>
      <?php if ( is_user_logged_in() ) : ?>
        <?php $theme_current_user = wp_get_current_user(); ?>
        <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="username"><?php echo $theme_current_user->display_name; ?></a>
        <a href="<?php echo wc_get_endpoint_url( 'customer-logout', '', get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="login-logout"><img src="<?php echo get_template_directory_uri() ?>/images/user.png" class="unhover"><img src="<?php echo get_template_directory_uri() ?>/images/user-orange.png" class="hover"><?php pll_e('Se déconnecter'); ?></a>
      <?php else : ?>
        <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="login-logout"><img src="<?php echo get_template_directory_uri() ?>/images/user.png" class="unhover"><img src="<?php echo get_template_directory_uri() ?>/images/user-orange.png" class="hover"><?php pll_e('Se connecter'); ?></a>
      <?php endif; ?>
    </div>
    <h4><a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>"><?php pll_e('Mon Panier'); ?></a></h4>
    <div id="sidebar-cart-items">
      <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
        <div class="cart-items">
          <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
            $template_directory = get_template_directory_uri();
            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) :
              $product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
              $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
              $product_thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); 
              ?>
              <div class="cart-product">
                <a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>" class="cart-product-thumb"><?php echo $product_thumbnail; ?></a>
                <div class="cart-product-meta">
                  <a class="cart-product-title" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>"><?php echo esc_html( $product_name ); ?></a>
                  <span class="cart-product-price"><span class="label"><?php pll_e('Prix'); ?> : </span><?php echo $product_price; ?></span>
                  <span class="cart-product-quantity"><span class="label"><?php pll_e('Quantité'); ?> : </span><?php echo $cart_item['quantity']; ?></span>
                  <?php
                  echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><img src="%s/images/close.png"></a>',
                    esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                    __( 'Remove this item', 'woocommerce' ),
                    esc_attr( $product_id ),
                    esc_attr( $cart_item_key ),
                    esc_attr( $_product->get_sku() ),
                    esc_attr( $template_directory)
                  ), $cart_item_key ); 
                  ?>
                </div>
              </div>
            <?php endif;
          endforeach; ?>
        </div>
        <div class="cart-subtotal">
          <span><?php pll_e('Sous-total'); ?></span>
          <span class="cart-subtotal-price"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
        </div>
        <div class="checkout-section"><a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="view-checkout"><?php echo apply_filters( 'sidebar_cart_checkoutbtn_filter', pll_e('Finaliser la commande') ); ?></a></div>
      <?php else : ?>
        <div class="no-products">
          <span><?php echo apply_filters( 'sidebar_cart_noproducts_filter', pll_e('Aucun article dans votre panier') ); ?></span>
        </div>
      <?php endif; ?>
    </div>
  </div> 
</div>