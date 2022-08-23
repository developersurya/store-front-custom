<?php
/**
 * Layout
 *
 * @see  storefront_custom_before_content()
 * @see  storefront_custom_after_content()
 * @see  woocommerce_breadcrumb()
 * @see  storefront_custom_shop_messages()
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'woocommerce_before_main_content', 'storefront_custom_before_content', 10 );
add_action( 'woocommerce_after_main_content', 'storefront_custom_after_content', 10 );
add_action( 'storefront_custom_content_top', 'storefront_custom_shop_messages', 15 );
add_action( 'storefront_custom_before_content', 'woocommerce_breadcrumb', 10 );

add_action( 'woocommerce_after_shop_loop', 'storefront_custom_sorting_wrapper', 9 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 30 );
add_action( 'woocommerce_after_shop_loop', 'storefront_custom_sorting_wrapper_close', 31 );

add_action( 'woocommerce_before_shop_loop', 'storefront_custom_sorting_wrapper', 9 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_before_shop_loop', 'storefront_custom_woocommerce_pagination', 30 );
add_action( 'woocommerce_before_shop_loop', 'storefront_custom_sorting_wrapper_close', 31 );

add_action( 'storefront_custom_footer', 'storefront_custom_handheld_footer_bar', 999 );



/**
 * Header
 *
 * @see storefront_product_search()
 * @see storefront_header_cart()
 */
add_action( 'storefront_header', 'storefront_product_search', 40 );
add_action( 'storefront_header', 'storefront_header_cart', 60 );