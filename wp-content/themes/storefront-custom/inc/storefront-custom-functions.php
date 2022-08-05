<?php
/**
 * Storefront-custom functions.
 *
 * @package storefront-custom
 */

if ( ! function_exists( 'storefront_custom_is_woocommerce_activated' ) ) {
	/**
	 * Query WooCommerce activation
	 */
	function storefront_custom_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}
