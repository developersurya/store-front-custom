<?php
/**
 * Storefront-custom template functions.
 *
 * @package storefront-custom
 */


if ( ! function_exists( 'storefront_custom_custom_get_sidebar' ) ) {
	/**
	 * Display storefront sidebar
	 *
	 * @uses get_sidebar()
	 * @since 1.0.0
	 */
	function storefront_custom_custom_get_sidebar() {
		get_sidebar();
	}
}


if ( ! function_exists( 'storefront_custom_custom_header_widget_region' ) ) {
	/**
	 * Display header widget region
	 *
	 * @since  1.0.0
	 */
	function storefront_custom_custom_header_widget_region() {
		if ( is_active_sidebar( 'header-1' ) ) {
			?>
		<div class="header-widget-region" role="complementary">
			<div class="col-full">
				<?php dynamic_sidebar( 'header-1' ); ?>
			</div>
		</div>
			<?php
		}
	}
}

if ( ! function_exists( 'storefront_custom_custom_homepage_content' ) ) {
	/**
	 * Display homepage content
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @since  1.0.0
	 * @return  void
	 */
	function storefront_custom_custom_homepage_content() {
		while ( have_posts() ) {
			the_post();

			get_template_part( 'content', 'homepage' );

		} // end of the loop.
	}
}


if ( ! function_exists( 'storefront_custom_woocommerce_pagination' ) ) {
	/**
	 * Storefront WooCommerce Pagination
	 * WooCommerce disables the product pagination inside the woocommerce_product_subcategories() function
	 * but since Storefront adds pagination before that function is excuted we need a separate function to
	 * determine whether or not to display the pagination.
	 *
	 * @since 1.4.4
	 */
	function storefront_custom_woocommerce_pagination() {
		if ( woocommerce_products_will_display() ) {
			woocommerce_pagination();
		}
	}
}

if ( ! function_exists( 'storefront_custom_product_categories' ) ) {
	/**
	 * Display Product Categories
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @since  1.0.0
	 * @param array $args the product section args.
	 * @return void
	 */
	function storefront_custom_product_categories( $args ) {
		$args = apply_filters(
			'storefront_custom_product_categories_args',
			array(
				'limit'            => 3,
				'columns'          => 3,
				'child_categories' => 0,
				'orderby'          => 'menu_order',
				'title'            => __( 'Shop by Category', 'storefront' ),
			)
		);

		$shortcode_content = storefront_custom_do_shortcode(
			'product_categories',
			apply_filters(
				'storefront_custom_product_categories_shortcode_args',
				array(
					'number'  => intval( $args['limit'] ),
					'columns' => intval( $args['columns'] ),
					'orderby' => esc_attr( $args['orderby'] ),
					'parent'  => esc_attr( $args['child_categories'] ),
				)
			)
		);

		/**
		 * Only display the section if the shortcode returns product categories
		 */
		if ( false !== strpos( $shortcode_content, 'product-category' ) ) {
			echo '<section class="storefront-product-section storefront-product-categories" aria-label="' . esc_attr__( 'Product Categories', 'storefront' ) . '">';

			do_action( 'storefront_custom_homepage_before_product_categories' );

			echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

			do_action( 'storefront_custom_homepage_after_product_categories_title' );

			echo $shortcode_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			do_action( 'storefront_custom_homepage_after_product_categories' );

			echo '</section>';
		}
	}
}

if ( ! function_exists( 'storefront_custom_recent_products' ) ) {
	/**
	 * Display Recent Products
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @since  1.0.0
	 * @param array $args the product section args.
	 * @return void
	 */
	function storefront_custom_recent_products( $args ) {
		$args = apply_filters(
			'storefront_custom_recent_products_args',
			array(
				'limit'   => 4,
				'columns' => 4,
				'orderby' => 'date',
				'order'   => 'desc',
				'title'   => __( 'New In', 'storefront' ),
			)
		);

		$shortcode_content = storefront_custom_do_shortcode(
			'products',
			apply_filters(
				'storefront_custom_recent_products_shortcode_args',
				array(
					'orderby'  => esc_attr( $args['orderby'] ),
					'order'    => esc_attr( $args['order'] ),
					'per_page' => intval( $args['limit'] ),
					'columns'  => intval( $args['columns'] ),
				)
			)
		);

		/**
		 * Only display the section if the shortcode returns products
		 */
		if ( false !== strpos( $shortcode_content, 'product' ) ) {
			echo '<section class="storefront-product-section storefront-recent-products" aria-label="' . esc_attr__( 'Recent Products', 'storefront' ) . '">';

			do_action( 'storefront_custom_homepage_before_recent_products' );

			echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

			do_action( 'storefront_custom_homepage_after_recent_products_title' );

			echo $shortcode_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			do_action( 'storefront_custom_homepage_after_recent_products' );

			echo '</section>';
		}
	}
}

if ( ! function_exists( 'storefront_custom_featured_products' ) ) {
	/**
	 * Display Featured Products
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @since  1.0.0
	 * @param array $args the product section args.
	 * @return void
	 */
	function storefront_custom_featured_products( $args ) {

		$title= get_field('fp_title', get_the_ID() );
		$subtitle= get_field('fp_subtitle', get_the_ID() );
		$number_of_products= get_field('fb_number_of_products', get_the_ID() );
		$args = apply_filters(
			'storefront_custom_featured_products_args',
			array(
				'limit'      => 4,
				'columns'    => 4,
				'orderby'    => 'date',
				'order'      => 'desc',
				'visibility' => 'featured',
				'title'      => $title,
			)
		);

		$shortcode_content = storefront_custom_do_shortcode(
			'products',
			apply_filters(
				'storefront_custom_featured_products_shortcode_args',
				array(
					'per_page'   => intval( $number_of_products ),
					'columns'    => intval( $args['columns'] ),
					'orderby'    => esc_attr( $args['orderby'] ),
					'order'      => esc_attr( $args['order'] ),
					'visibility' => esc_attr( $args['visibility'] ),
				)
			)
		);

		/**
		 * Only display the section if the shortcode returns products
		 */
		if ( false !== strpos( $shortcode_content, 'product' ) ) {
			echo '<section class="page-section bg-light" aria-label="' . esc_attr__( $subtitle ) . '" id="portfolio">';
			
			echo '<div class="container">';

			do_action( 'storefront_custom_homepage_before_featured_products' );

			echo '<div class="text-center">';

			echo '<h2 class="section-heading text-uppercase">' . wp_kses_post( $args['title'] ) . '</h2>';

			echo '<h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.' . wp_kses_post( $args['title_1'] ) . '</h3>';

			do_action( 'storefront_custom_homepage_after_featured_products_title' );

			echo '</div>';

			

			echo $shortcode_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			do_action( 'storefront_custom_homepage_after_featured_products' );

			echo '</div>';

			echo '</section>';
		}
	}
}

if ( ! function_exists( 'storefront_custom_popular_products' ) ) {
	/**
	 * Display Popular Products
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @since  1.0.0
	 * @param array $args the product section args.
	 * @return void
	 */
	function storefront_custom_popular_products( $args ) {
		$args = apply_filters(
			'storefront_custom_popular_products_args',
			array(
				'limit'   => 4,
				'columns' => 4,
				'orderby' => 'rating',
				'order'   => 'desc',
				'title'   => __( 'Fan Favorites', 'storefront' ),
			)
		);

		$shortcode_content = storefront_custom_do_shortcode(
			'products',
			apply_filters(
				'storefront_custom_popular_products_shortcode_args',
				array(
					'per_page' => intval( $args['limit'] ),
					'columns'  => intval( $args['columns'] ),
					'orderby'  => esc_attr( $args['orderby'] ),
					'order'    => esc_attr( $args['order'] ),
				)
			)
		);

		/**
		 * Only display the section if the shortcode returns products
		 */
		if ( false !== strpos( $shortcode_content, 'product' ) ) {
			echo '<section class="storefront-product-section storefront-popular-products" aria-label="' . esc_attr__( 'Popular Products', 'storefront' ) . '">';

			do_action( 'storefront_custom_homepage_before_popular_products' );

			echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

			do_action( 'storefront_custom_homepage_after_popular_products_title' );

			echo $shortcode_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			do_action( 'storefront_custom_homepage_after_popular_products' );

			echo '</section>';
		}
	}
}

if ( ! function_exists( 'storefront_custom_on_sale_products' ) ) {
	/**
	 * Display On Sale Products
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @param array $args the product section args.
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_custom_on_sale_products( $args ) {
		$args = apply_filters(
			'storefront_custom_on_sale_products_args',
			array(
				'limit'   => 4,
				'columns' => 4,
				'orderby' => 'date',
				'order'   => 'desc',
				'on_sale' => 'true',
				'title'   => __( 'On Sale', 'storefront' ),
			)
		);

		$shortcode_content = storefront_custom_do_shortcode(
			'products',
			apply_filters(
				'storefront_custom_on_sale_products_shortcode_args',
				array(
					'per_page' => intval( $args['limit'] ),
					'columns'  => intval( $args['columns'] ),
					'orderby'  => esc_attr( $args['orderby'] ),
					'order'    => esc_attr( $args['order'] ),
					'on_sale'  => esc_attr( $args['on_sale'] ),
				)
			)
		);

		/**
		 * Only display the section if the shortcode returns products
		 */
		if ( false !== strpos( $shortcode_content, 'product' ) ) {
			echo '<section class="storefront-product-section storefront-on-sale-products" aria-label="' . esc_attr__( 'On Sale Products', 'storefront' ) . '">';

			do_action( 'storefront_custom_homepage_before_on_sale_products' );

			echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

			do_action( 'storefront_custom_homepage_after_on_sale_products_title' );

			echo $shortcode_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			do_action( 'storefront_custom_homepage_after_on_sale_products' );

			echo '</section>';
		}
	}
}

if ( ! function_exists( 'storefront_custom_best_selling_products' ) ) {
	/**
	 * Display Best Selling Products
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @since 2.0.0
	 * @param array $args the product section args.
	 * @return void
	 */
	function storefront_custom_best_selling_products( $args ) {
		$args = apply_filters(
			'storefront_custom_best_selling_products_args',
			array(
				'limit'   => 4,
				'columns' => 4,
				'orderby' => 'popularity',
				'order'   => 'desc',
				'title'   => esc_attr__( 'Best Sellers', 'storefront' ),
			)
		);

		$shortcode_content = storefront_custom_do_shortcode(
			'products',
			apply_filters(
				'storefront_custom_best_selling_products_shortcode_args',
				array(
					'per_page' => intval( $args['limit'] ),
					'columns'  => intval( $args['columns'] ),
					'orderby'  => esc_attr( $args['orderby'] ),
					'order'    => esc_attr( $args['order'] ),
				)
			)
		);

		/**
		 * Only display the section if the shortcode returns products
		 */
		if ( false !== strpos( $shortcode_content, 'product' ) ) {
			echo '<section class="storefront-product-section storefront-best-selling-products" aria-label="' . esc_attr__( 'Best Selling Products', 'storefront' ) . '" id="portfolio">';

			do_action( 'storefront_custom_homepage_before_best_selling_products' );

			echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

			do_action( 'storefront_custom_homepage_after_best_selling_products_title' );

			echo $shortcode_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			do_action( 'storefront_custom_homepage_after_best_selling_products' );

			echo '</section>';
		}
	}
}
	if ( ! function_exists( 'storefront_custom_home_banner' ) ) {
		/**
		 * Display home banner
		 * Hooked into the `homepage` action in the homepage template
		 *
		 * @since 1.0.0
		 * @param array $args the product section args.
		 * @return void
		 */
		function storefront_custom_home_banner(){
			$banner_title = get_field('banner_title');
			$banner_subtitle = get_field('banner_subtitle');
			$banner_image = get_field('banner_image');
			$url = get_template_directory_uri()."/assets/img/header-bg.jpg";
			?>
			
			<header class="masthead" style="background-image:url(<?php echo $banner_image['url'];?>">
				<div class="container">
					<div class="masthead-subheading"><?php echo $banner_title ;?></div>
					<div class="masthead-heading text-uppercase"><?php echo $banner_subtitle ;?></div>
					<a class="btn btn-primary btn-xl text-uppercase" href="#services">Tell Me More</a>
				</div>
			</header>
			<?php
		}
	}


	add_action('woocommerce_before_shop_loop_item','woocommerce_before_shop_loop_item_wrapper_start',1);
	add_action('woocommerce_after_shop_loop_item','woocommerce_before_shop_loop_item_wrapper_end',11);
	add_action('woocommerce_after_shop_loop_item','woocommerce_before_shop_loop_item_wrapper_end',11);
	add_action('woocommerce_before_shop_loop_item_title','woocommerce_before_shop_loop_item_caption_start',11);


	
	function woocommerce_before_shop_loop_item_wrapper_start(){
		echo '<div class="portfolio-item">';
	}
	function woocommerce_before_shop_loop_item_caption_start(){
		echo '<div class="portfolio-caption">';
	}
	
	function woocommerce_before_shop_loop_item_wrapper_end(){
		echo '</div>';
	}


	// Add wrapper button and qty in sigle page 
	add_action('woocommerce_before_add_to_cart_button','add_to_cart_wrapper_start',1);
	function add_to_cart_wrapper_start(){
		echo '<div class="add-to-cart-wrapper">';
	}

	add_action('woocommerce_after_add_to_cart_button','add_to_cart_wrapper_end',1);
	function add_to_cart_wrapper_end(){
		echo '</div>';
	}


	// Change in add to cart button,
	add_filter( 'woocommerce_loop_add_to_cart_link', 'replace_loop_add_to_cart_button', 10, 2 );
	function replace_loop_add_to_cart_button( $button, $product  ) {
		if( has_term( 'cat-1', 'product_cat' ) ){
		// Category 1 Button text here
		$button_text = __( "Add to cart 1", "woocommerce" );
		return '<a class="btn btn-primary " href="' . $product->get_permalink() . '">' . $button_text . '</a>';
		} else {
		// Category 2 Button text here
		$button_text = __( "Add to cart 2", "woocommerce" );
		return '<a class="btn btn-primary " href="' . $product->get_permalink() . '">' . $button_text . '</a>';
		}
	}