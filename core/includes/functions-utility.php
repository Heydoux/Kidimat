<?php
/**
 * Theme Kidimat
 *
 * Core functions and definitions
 *
 * @package WordPress
 * @subpackage Kidimat Themes
 * @author WAP <contact@webagenceparis.com>
 *
 */


/**
 * Check if WooCommerce is active
 */

if ( ! function_exists( 'check_is_woocommerce' ) ) {
	function check_is_woocommerce() {
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option('active_plugins' ) ) ) ) {
			return true;
		}
	}
}