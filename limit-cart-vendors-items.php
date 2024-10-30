<?php

/**
 * @link              https://www.trendingfornow.com/Zach
 * @since             1.0.0
 * @package           Limit_Cart_Vendors_Items
 *
 * @wordpress-plugin
 * Plugin Name:       limit-cart-vendors-items
 * Plugin URI:        https://www.trendingfornow.com/Zach/Plugins
 * Description:       This plugin helps you limit the number of vendors/items per order on the cart page/during checkout
 * Version:           1.0.0
 * Author:            Zach
 * Author URI:        https://www.trendingfornow.com/Zach
 * License:           GPL-2.0+
 * Tested upto        5.0.3
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       limit-cart-vendors-items
 * Domain Path:       /languages
 */

//check if woocommerce is active
if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    return;
}
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-limit-cart-vendors-items-activator.php
 */
 
 
 
function activate_limit_cart_vendors_items() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-limit-cart-vendors-items-activator.php';
	Limit_Cart_Vendors_Items_Activator::activate();
}


/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-limit-cart-vendors-items-deactivator.php
 */
function deactivate_limit_cart_vendors_items() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-limit-cart-vendors-items-deactivator.php';
	Limit_Cart_Vendors_Items_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_limit_cart_vendors_items' );
register_deactivation_hook( __FILE__, 'deactivate_limit_cart_vendors_items' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-limit-cart-vendors-items.php';
require plugin_dir_path( __FILE__ ) . 'options.php';


function run_limit_cart_vendors_items() {

	$plugin = new Limit_Cart_Vendors_Items();
	$plugin->run();

}
run_limit_cart_vendors_items();
