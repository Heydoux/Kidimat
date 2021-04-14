<?php
add_action('wp_ajax_get_pro_discounts', 'get_pro_discounts_function');
add_action('wp_ajax_nopriv_get_pro_discounts', 'get_pro_discounts_function');

function get_pro_discounts_function(){
  global $wpdb;
  $discount_pro_table_name = $wpdb->prefix . 'discount_pro';
  $user_id = "";  

  if( isset( $_POST['company_id'] ) && $_POST['company_id']){
    $user_id = $_POST['company_id'];
  }
  
  //$wpdb->show_errors(); 
  $discount_data = $wpdb->get_results(
    $wpdb->prepare("SELECT `category_id`, `discount_rate` FROM `{$discount_pro_table_name}` WHERE user_id = %d",
    $user_id
  ));
  //$wpdb->print_error();
  
  echo json_encode($discount_data);
  wp_reset_postdata();

  die();
}


add_action('wp_ajax_save_pro_discounts', 'save_pro_discounts_function');
add_action('wp_ajax_nopriv_save_pro_discounts', 'save_pro_discounts_function');

function save_pro_discounts_function(){
  global $wpdb;
  $discount_pro_table_name = $wpdb->prefix . 'discount_pro';
  $user_id = "";
  $user_name = "";
  $percent = "";
  $cat = [];

  if( isset( $_POST['company_id'] ) && $_POST['company_id']){
    $user_id = $_POST['company_id'];
  }
  if( isset( $_POST['company_name'] ) && $_POST['company_name']){
    $user_name = $_POST['company_name'];
  }
  if( isset( $_POST['percent_value'] ) && $_POST['percent_value']){
    $percent = $_POST['percent_value'];
  }
  if( isset( $_POST['cat_list_id'] ) && $_POST['cat_list_id']){
    $cats = $_POST['cat_list_id'];
  }
  
  $wpdb->query($wpdb->prepare("DELETE FROM `{$discount_pro_table_name}` WHERE user_id = %d", $user_id));
  
  foreach($cats as $cat): 
    $discount_pro_data = $wpdb->query(
      $wpdb->prepare(
        "INSERT INTO `{$discount_pro_table_name}` (`user_id`, `company_name`, `category_id`, `discount_rate`)
        VALUES (%d, %s, %d, %f)",
        $user_id,
        $user_name,
        $cat,
        $percent
      )
    );
  endforeach;

  wp_reset_postdata();

  die();
}
