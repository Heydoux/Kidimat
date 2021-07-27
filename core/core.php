<?php
/**
 * Theme Kidimat
 * 
 * Core functions and definitions
 *
 * @package WordPress
 * @subpackage Kidimat Theme
 * @author WAP <contact@webagenceparis.com>
 *
 */

define( 'KIDIMAT_PATH', get_template_directory() );
define( 'KIDIMATCORE_PATH', get_template_directory() . '/core/' );

require_once KIDIMATCORE_PATH . 'includes/woocommerce.php';
require_once KIDIMATCORE_PATH . 'includes/register-sidebars.php';
require_once KIDIMATCORE_PATH . 'includes/functions-utility.php';

require_once KIDIMATCORE_PATH . 'includes/customer-type/pro.php';
require_once KIDIMATCORE_PATH . 'includes/customer-type/tp.php';
require_once KIDIMATCORE_PATH . 'includes/customer-type/macon.php';
require_once KIDIMATCORE_PATH . 'includes/customer-type/paysagiste.php';