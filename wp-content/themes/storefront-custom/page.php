<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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

					do_action( 'storefront_page_before' );

					get_template_part( 'content', 'page' );

					/**
					 * Functions hooked in to storefront_page_after action
					 *
					 * @hooked storefront_display_comments - 10
					 */
					do_action( 'storefront_page_after' );

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
</section>

<?php
//do_action( 'storefront_sidebar' );
get_footer();
