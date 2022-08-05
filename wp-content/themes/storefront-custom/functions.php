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

function test(){
	$day = date("d");
	if(  get_option('best_seller_'.$day) == ''  ){
		
		$args = array( 
			'post_type' => 'page',
			'posts_per_page' => 3,
			'orderby' => 'rand',
			'order' => 'ASC',
		);
		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) {
			$id =  [];
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$id[] =  get_the_ID();
			}
		
		}	

	
		if(get_option('best_seller_'.$day) === FALSE){
			add_option('best_seller_'.$day, $id );
		}else{
			update_option('best_seller_'.$day,  $id );
			var_dump( $id );
		}
	}
}

test();


// function best_seller_rest_api() {

// 	$day = date("d");
// 	//update_option('best_seller_'.$day,  '' );
// 	// Save once in a day the best seller products
// 	 //if( get_option('best_seller_'.$day) != FALSE){
// 		echo 'asdfadf';
// 		$curl = curl_init();
		
// 		curl_setopt_array($curl, array(
// 		CURLOPT_URL => 'http://store-front-custom.test/wp-json/wc/v3/reports/top_sellers?period=year',
// 		CURLOPT_RETURNTRANSFER => true,
// 		CURLOPT_ENCODING => '',
// 		CURLOPT_MAXREDIRS => 10,
// 		CURLOPT_TIMEOUT => 0,
// 		CURLOPT_FOLLOWLOCATION => true,
// 		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 		CURLOPT_CUSTOMREQUEST => 'GET',
// 		));
		
// 		$response = curl_exec($curl);
		
// 		curl_close($curl);
		
// 		if( $response ){
// 			$data_id = array();
// 			$data =  json_decode( $response , true) ;
// 			if( is_array( $data ) ){
// 				foreach( $data as $dat ){
// 					$data_id[] = $dat['product_id'];
// 				}
// 			}
			
// 			if(get_option('best_seller_'.$day) === FALSE){
// 				add_option('best_seller_'.$day, $data_id );
// 			}else{
// 				update_option('best_seller_'.$day,  $data_id );
				
// 			}
// 		}else{
// 			return false;
// 		}
// 	//}

// }


//best_seller_rest_api();

