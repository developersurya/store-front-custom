<?php

/**
 * Cronjob example
 *
 * @param [type] $schedules
 * @return void
 */
function adimex_custom_cron_schedule( $schedules ) {
    $schedules['every_six_hours'] = array(
        'interval' => 100, // Every 100 secs  // 86400 for a day
        'display'  => __( 'Every 24 hours' ),
    );
    return $schedules;
}
add_filter( 'cron_schedules', 'adimex_custom_cron_schedule' );

//Schedule an action if it's not already scheduled
if ( ! wp_next_scheduled( 'adimex_cron_hook' ) ) {
    wp_schedule_event( time(), 'every_six_hours', 'adimex_cron_hook' );
}

///Hook into that action that'll fire every six hours
 add_action( 'adimex_cron_hook', 'adimex_cron_function' );

//create your function, that runs on cron
function adimex_cron_function() {
    	$args = array( 
		'post_type' => 'page',
		'posts_per_page' => 10,
		'orderby' => 'rand',
		'order' => 'ASC',
	);
	$the_query = new WP_Query( $args );
	$id_array =  [];
	
	if ( $the_query->have_posts() ) {
		
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$id_array[] =  get_the_ID();
		}
	
	}	
	serialize( $id_array ) ;  // Wp_option table does not save array directly. It saves serialized data.
	if(get_option('best_seller_' ) === FALSE){
		add_option('best_seller_' , $id_array );
	}else{
		update_option('best_seller_' ,  $id_array );
		
	}

}


/**
 * CURL rest api example.
 *
 * @return void
 */
function best_seller_rest_api() {

	$day = date("d");
	//update_option('best_seller_'.$day,  '' );
	// Save once in a day the best seller products
	 //if( get_option('best_seller_'.$day) != FALSE){
		echo 'asdfadf';
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://store-front-custom.test/wp-json/wc/v3/reports/top_sellers?period=year',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		
		if( $response ){
			$data_id = array();
			$data =  json_decode( $response , true) ;
			if( is_array( $data ) ){
				foreach( $data as $dat ){
					$data_id[] = $dat['product_id'];
				}
			}
			
			if(get_option('best_seller_'.$day) === FALSE){
				add_option('best_seller_'.$day, $data_id );
			}else{
				update_option('best_seller_'.$day,  $data_id );
				
			}
		}else{
			return false;
		}
	//}

}


//best_seller_rest_api();

