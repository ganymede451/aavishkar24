<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Costello
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php if ( is_active_sidebar( 'sidebar-notfound' ) ) :
				dynamic_sidebar( 'sidebar-notfound' );
			else : ?>
			<section class="error-404 not-found">
				<div class="singular-content-wrap">
				<?php
					$header_image = costello_featured_overall_image();

					if ( 'disable' === $header_image ) : ?>

					<header class="page-header">
						<h2 class="page-title section-title"><?php esc_html_e( 'Nothing Found', 'costello' ); ?></h2>

						<div class="section-subtitle">
							<p><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'costello' ); ?></p>
						</div>
					</header><!-- .entry-header -->

				<?php endif; ?>
					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'costello' ); ?></p>

						<?php get_search_form(); ?>
					</div><!-- .page-content -->
				</div>	<!-- .singular-content-wrap -->
			</section><!-- .error-404 -->
			<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
