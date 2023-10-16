<?php
/**
 * The template used for displaying projects on index view
 *
 * @package Costello
 */

?>

<article id="portfolio-post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>
	<div class="hentry-inner">
		<?php costello_post_thumbnail( array( 666, 666 ) ); ?>

		<div class="entry-container">
			<div class="inner-wrap">
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

					<div class="entry-meta">
						<?php costello_posted_on(); ?>
					</div>
				</header>
			</div>
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article>
