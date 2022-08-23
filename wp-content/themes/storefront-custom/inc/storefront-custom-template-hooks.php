<?php
/**
 * Storefront-custom hooks
 *
 * @package storefront-custom
 */

 /**
 * General
 *
 * @see  storefront_custom_header_widget_region()
 * @see  storefront_custom_get_sidebar()
 */
add_action( 'storefront_custom_before_content', 'storefront_custom_header_widget_region', 10 );
add_action( 'storefront_custom_sidebar', 'storefront_custom_get_sidebar', 10 );

/**
 * Homepage
 *
 * @see  storefront_homepage_content()
 */

add_action( 'homepage', 'storefront_custom_homepage_content', 10 );
add_action( 'homepage_sections', 'storefront_custom_home_banner', 10 );
add_action( 'homepage_sections', 'storefront_custom_featured_products', 10 );


/**
 * Default page
 * @see custom_storefront_page()
 */

add_action( 'custom_storefront_page', 'storefront_custom_home_banner', 10 ); // change the priority to re-order the sections
add_action( 'custom_storefront_page', 'storefront_custom_featured_products', 10 );


/**
 * Pages
 *
 * @see  custom_storefront_page_header()
 * @see  custom_storefront_page_content()
 * @see  storefront_display_comments()
 */
add_action( 'general_storefront_page', 'storefront_custom_page_header', 10 );
add_action( 'general_storefront_page', 'storefront_custom_page_content', 20 );
add_action( 'general_storefront_page', 'storefront_custom_edit_post_link', 30 );
add_action( 'general_storefront_page_after', 'storefront_custom_display_comments', 10 );