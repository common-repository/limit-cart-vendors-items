<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.trendingfornow.com/Zach
 * @since      1.0.0
 *
 * @package    Limit_Cart_Vendors_Items
 * @subpackage Limit_Cart_Vendors_Items/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Limit_Cart_Vendors_Items
 * @subpackage Limit_Cart_Vendors_Items/includes
 * @author     Zach <plugins@trendingfornow.com>
 */
class Limit_Cart_Vendors_Items_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'limit-cart-vendors-items',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
