<?php 

/**
 * Si inexistante, créée la table SQL "discount_professionnals" après l'activation du thème
 */

global $wpdb;

$charset_collate = $wpdb->get_charset_collate();

$discount_professionnals_table_name = $wpdb->prefix . 'discount_pro';

$discount_pro_sql = "CREATE TABLE IF NOT EXISTS $discount_professionnals_table_name (
	id mediumint(9) NOT NULL AUTO_INCREMENT,
	user_id mediumint(9) DEFAULT NULL,
  company_name varchar(50) NOT NULL default '',
	category_id mediumint(9) DEFAULT NULL,
  discount_rate  decimal(10,2) DEFAULT NULL,
	PRIMARY KEY  (id)
) $charset_collate;";

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

dbDelta($discount_pro_sql);