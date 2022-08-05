<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage
 *
 * @package storefront-custom
 */

get_header(); ?>
    <?php
        /**
         * Functions hooked in to homepage action
         *
         * @hooked storefront_custom_homepage_content      - 10
         * @hooked storefront_custom_product_categories    - 20
         * @hooked storefront_custom_recent_products       - 30
         * @hooked storefront_custom_featured_products     - 40
         * @hooked storefront_custom_popular_products      - 50
         * @hooked storefront_custom_on_sale_products      - 60
         * @hooked storefront_custom_best_selling_products - 70
         */
        do_action( 'homepage_sections' );
        ?>

<?php
get_footer();