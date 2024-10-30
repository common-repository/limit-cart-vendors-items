<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.trendingfornow.com/Zach
 * @since      1.0.0
 *
 * @package    Limit_Cart_Vendors_Items
 * @subpackage Limit_Cart_Vendors_Items/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Limit_Cart_Vendors_Items
 * @subpackage Limit_Cart_Vendors_Items/public
 * @author     Zach <plugins@trendingfornow.com>
 */
class Limit_Cart_Vendors_Items_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

/**
 * This function is used to limit the number number of vendors a customer can buy from at a time. You have to set the number on the wp-admin dashboard.
 * If you set to 1, then a customer can only checkout if their order is only from one vendor, and so on
 * 
 * 
 */
    public function limit_vendor_number_checkout($passed, $product_id, $quantity) { 
	     
	    $has_vendors = array();
	   foreach( WC()->cart->get_cart() as $cart_item ) {
        $product_in_cart = $cart_item['product_id'];
        $post_info = get_post( $product_in_cart );
       $cart_vendor = $post_info->post_author;
       if($cart_vendor) {
           $has_vendors[] = $cart_vendor;
       }
	   }
	   global $vendor_count;
	   $vendor_count =get_option('vendor_number');
	   $items_count = get_option('total_items');
	   $items_total =WC()->cart->get_cart_contents_count();
	   $product_vendor = get_post($product_id);
	   $vendors = array_unique($has_vendors);
	   if (count($vendors) > $vendor_count && !in_array($product_vendor, $vendors)) {
	            $passed = false;
                   wc_add_notice(__("You can only buy from $vendor_count seller(s) per order.", 'woocommerce'), 'error');
                 return $passed; 
	   }
	   elseif($items_total > $items_count) {
	       $passed = false;
                   wc_add_notice(__("You have exceeded the maximum # of items per order: $items_count.", 'woocommerce'), 'error');
                 return $passed; 
	   }
	   return $passed;
        

	

}
}
