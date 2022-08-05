<?php
/**
 * Storefront-custom WooCommerce Class
 *
 * @package  storefront-custom
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if( ! class_exists( 'Storefront_Custom_WooCommerce' ) ) :

/**
 * The Storefront_Custom_WooCommerce class.
 */


    class Storefront_Custom_WooCommerce {

        /**
         * Setup class.
         * @since 1.0.0
         */

         public function __construct() {
			
            add_action(  'after_setup_theme' , array( $this , 'setup' ) ) ;

			add_filter( 'body_class', array( $this, 'woocommerce_body_class' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'woocommerce_scripts' ), 20 );
         }


         /**
		 * Sets up theme defaults and registers support for various WooCommerce features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 *
		 * @since 1.0.0
		 * @return void
		 */
         public function setup(){
			
            add_theme_support( 'woocommerce' ,
                apply_filters(
                    'storefront_woocommerce_args',  // ***
                    array(
                        'single_image_width'    => 416,
                        'thumbnail_image_width' => 324,
                        'product_grid'          => array(
                            'default_columns' => 3,
                            'default_rows'    => 4,
                            'min_columns'     => 1,
                            'max_columns'     => 6,
                            'min_rows'        => 1,
                        ),
                    )
                )
            );
            add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );


            /**
			 * Add 'theme_woocommerce_setup' action.
			 *
			 * @since  1.0.0
			 */
			do_action( 'storefront_woocommerce_setup' );

         }

         /**
		 * Add CSS in <head> for styles handled by the theme customizer
		 * If the Customizer is active pull in the raw css. Otherwise pull in the prepared theme_mods if they exist.
		 *
		 * @since 2.1.0
		 * @return void
		 */
		// public function add_customizer_css() {
		// 	wp_add_inline_style( 'storefront-woocommerce-style', $this->get_woocommerce_extension_css() );
		// }

        /**
		 * WooCommerce specific scripts & stylesheets
		 *
		 * @since 1.0.0
		 */
		public function woocommerce_scripts() {
			global $storefront_custom_version;

			//$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			wp_enqueue_style( 'storefront-custom-woocommerce-style', get_template_directory_uri() . '/assets/css/styles.css', array(  ), $storefront_custom_version );
			wp_style_add_data( 'storefront-custom-woocommerce-style', 'rtl', 'replace' );

			wp_register_script( 'storefront-custom-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), $storefront_custom_version, true );
			wp_enqueue_script( 'storefront-custom-scripts' );


			// if ( ! class_exists( 'storefront-custom_Sticky_Add_to_Cart' ) && is_product() ) {
			// 	wp_register_script( 'storefront-custom-sticky-add-to-cart', get_template_directory_uri() . '/assets/js/sticky-add-to-cart' . $suffix . '.js', array(), $storefront_custom_version, true );
			// }
		}

		/**
		 * Add WooCommerce specific classes to the body tag
		 *
		 * @param  array $classes css classes applied to the body tag.
		 * @return array $classes modified to include 'woocommerce-active' class
		 */
		public function woocommerce_body_class( $classes ) {
			$classes[] = 'woocommerce-active';

			// Remove `no-wc-breadcrumb` body class.
			$key = array_search( 'no-wc-breadcrumb', $classes, true );

			if ( false !== $key ) {
				unset( $classes[ $key ] );
			}

			return $classes;
		}


    }


endif;

return new Storefront_Custom_WooCommerce();