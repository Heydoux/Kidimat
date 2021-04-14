<?php

include get_template_directory() . '/woocommerce/discount_professionnals/ajax_discount.php';

/**
 * Add menu to manage professionnal reduction 
 */
function add_professional_discount_menu_redirect() {
  
  add_submenu_page(
    'woocommerce',
    __( 'Réductions pro', 'woocommerce' ),
    __( 'Réductions pro', 'woocommerce' ),
    'manage_options',
    'reduc-pro',
    'reduc_pro_menu_moved'
  );
}

add_action( 'admin_menu', 'add_professional_discount_menu_redirect' );

/**
 * Call back for transition menu item
 */
function reduc_pro_menu_moved() {
  ?>
  <div class="py-3 pl-3 bg-white w-100" style="margin-left: -20px;">
    <h2>Page de réductions pour clients professionnels</h2>
  </div>
  <?php
    $wp_user_search = new WP_User_Query( array( 'role' => 'client professionnel' ) );
    $clients_pro = $wp_user_search->get_results();
    $first_client = $clients_pro[0]->ID;
  ?>
  <div id="discount-manager" class="mt-5 pt-5">
    <div class="row">
      <div class="col-md-3">
        <div class="border company-list">
          <div class="py-4 px-3">
            <h3>Entreprises</h3>
            <div class="d-flex">
              <input type="text" name="" id="search-company">
              <button class="btn">
                Rechercher
              </button>
            </div>
          </div>
          <?php 
            foreach ($clients_pro as $prof):
          ?>
          <div class="border-top border-bottom<?php if ($prof->ID == $first_client): ?> active<?php endif; ?>">
            <button class="company-btn w-100 p-3" name="company_name" id="<?php echo $prof->ID; ?>">
              <?php echo get_user_meta($prof->ID, "billing_company", true); ?>
            </button>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div id="discount-detail" class="offset-1 col-md-8 bg-white">
        <div class="m-4">
          <div id="save-discounts">
            <?php   
              global $wpdb;
              $discount_pro_table_name = $wpdb->prefix . 'discount_pro'; 
              $discount_data = [];

              $discount_data = $wpdb->get_results(
                $wpdb->prepare("SELECT `category_id`, `discount_rate` FROM `{$discount_pro_table_name}` WHERE user_id = %d",
                $first_client
              ));
              
            ?>
            <div class="company-name pb-2 border-bottom">
              <h3 class="text-uppercase" id="<?php echo $first_client;?>"><?php echo get_user_meta($first_client, "billing_company", true); ?></h3>
            </div>
            <div class="percent_discount mb-3">
              <h3>Pourcentage de réduction :</h3>
              <input type="number" name="" id="percent_discount_pro" value="<?php if (sizeof($discount_data) != 0) echo $discount_data[0]->{'discount_rate'}; else { ?>0 <?php } ?>" disabled  step="0.01">
            </div>
            <div class="cat_discount row mb-5">
              <h3 class="col-md-12">Catégorie sur lesquelles s'appliquent la réduction : </h3>
              <?php
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
              <div class="col-md-3 d-flex mb-3">
                <div>
                  <?php 
                    $checked = false;
                    if (sizeof($discount_data) != 0) {
                      foreach ($discount_data as $cat){
                        if($cat->{'category_id'} == $category->term_id){
                          $checked = true;
                        }
                      }
                    }
                  ?>
                  <input class="check-cat" type="checkbox" id="category-<?php echo esc_attr($category->term_id); ?>" name="<?php echo esc_attr($category->slug); ?>" value="<?php echo esc_attr($category->name); ?>" disabled <?php if ($checked): ?> checked <?php endif; ?>>
                </div>
                <div>
                  <label for="category-<?php echo esc_attr($category->term_id); ?>"><?php echo $category->name; ?></label>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="updates-wrapper">
            <a id="modify-discount" name="modify" class="button button-primary">
              Modifier
            </a>
            <input type="submit" id="save-discount" name="save" class="button button-primary d-none" value="Sauvegarder"/>
          </div>
        </div>
      </div>
      <div id="result"></div>
    </div>
  </div>
  <?php
}
