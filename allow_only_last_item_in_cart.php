<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.virtualheight.com/
 * @since             1.0.0
 * @package           Allow_only_last_item_in_cart
 *
 * @wordpress-plugin
 * Plugin Name:       Allow Only Last Item In Cart
 * Plugin URI:        https://www.virtualheight.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Virtual Height IT Services Ltd
 * Author URI:        https://www.virtualheight.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       allow_only_last_item_in_cart
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
defined('ABSPATH') || exit;
class Allow_Only_Last_Item_In_Cart{
    function __construct() {
     add_action( 'woocommerce_before_calculate_totals', array($this,'wcaopc_keep_only_last_cart_item'), 30, 1 );
    }
  function wcaopc_keep_only_last_cart_item( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;
    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;
    $cart_items = $cart->get_cart();
    if( count($cart_items) > 1 ){
        $cart_item_keys = array_keys( $cart_items );
        $cart->remove_cart_item( reset($cart_item_keys) );
     }
   }
}
$plugin = new Allow_Only_Last_Item_In_Cart();
