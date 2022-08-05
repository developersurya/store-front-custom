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