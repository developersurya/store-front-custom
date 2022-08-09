<?php
/**
 * Storefront-custom engine room
 *
 * @package storefront-custom
 */

/**
 * Assign the Storefront-custom version to a var
 */
$theme              = wp_get_theme( 'storefront-custom' );
$storefront_custom_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront_custom = (object) array(
	'version'    => $storefront_custom_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront-custom.php',
	//'customizer' => require 'inc/customizer/class-storefront-customizer.php', /*** */
);

require 'inc/storefront-custom-functions.php';
require 'inc/storefront-custom-template-hooks.php';
require 'inc/storefront-custom-template-functions.php';

if ( storefront_custom_is_woocommerce_activated() ) {
	$storefront_custom->woocommerce            = require 'inc/woocommerce/class-storefront-custom-woocommerce.php';
	// $storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php'; //*** */

	// require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-custom-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-custom-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-custom-woocommerce-functions.php';
}


//Enable Rest API by force

add_filter( 'woocommerce_rest_check_permissions', 'my_woocommerce_rest_check_permissions', 90, 4 );

function my_woocommerce_rest_check_permissions( $permission, $context, $object_id, $post_type  ){
    
    // if request is from same domain     
  return true;
}




