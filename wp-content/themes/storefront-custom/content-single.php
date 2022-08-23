<?php
/**
 * Template used to display post content on single pages.
 *
 * @package storefront
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	do_action( 'storefront_custom_single_post_top' );

	/**
	 * Functions hooked into storefront_custom_single_post add_action
	 *
	 * @hooked storefront_custom_post_header          - 10
	 * @hooked storefront_custom_post_content         - 30
	 */
	do_action( 'storefront_custom_single_post' );

	/**
	 * Functions hooked in to storefront_custom_single_post_bottom action
	 *
	 * @hooked storefront_custom_post_nav         - 10
	 * @hooked storefront_custom_display_comments - 20
	 */
	do_action( 'storefront_custom_single_post_bottom' );
	?>

</article><!-- #post-## -->
