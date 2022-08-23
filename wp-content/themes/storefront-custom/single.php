<?php
/**
 * The template for displaying all single posts.
 *
 * @package custom-storefront
 */

get_header(); ?>
<section class="page-section">
	<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) :
			the_post();

			do_action( 'storefront_single_post_before' );

			get_template_part( 'content', 'single' );

			do_action( 'storefront_single_post_after' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	</div></section>
<?php
//do_action( 'storefront_sidebar' );
get_footer();
