<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package storefront
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to custom_storefront_page add_action
	 *
	 * @hooked custom_storefront_page_header          - 10
	 * @hooked custom_storefront_page_content         - 20
	 */
	do_action( 'general_storefront_page' );
	?>
</article><!-- #post-## -->
