<?php
/**
 * The template for displaying Archive pages.
 *
 * @package ThinkUpThemes
 */

get_header(); ?>

			<?php if( have_posts() ): ?>

				<div id="container">

				<?php while( have_posts() ): the_post(); ?>

					<div class="blog-grid element<?php echo thinkup_input_stylelayout(); ?>">

					<article id="post-<?php the_ID(); ?>" <?php post_class('blog-article'); ?>>

						<header class="entry-header">

							<?php echo thinkup_input_blogimage(); ?>

						</header>

						<div class="entry-content">

							<?php thinkup_input_blogtitle(); ?>
							<?php thinkup_input_blogmeta1(); ?>
							<?php thinkup_input_blogtext(); ?>
							<?php thinkup_input_readmore(); ?>

						</div>

					</article><!-- #post-<?php get_the_ID(); ?> -->

					</div>

				<?php endwhile; ?>

				</div><div class="clearboth"></div>

				<?php the_posts_pagination( array(
					'mid_size' => 2,
					'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'experon' ),
					'next_text' => __( '<i class="fa fa-angle-right"></i>', 'experon' ),
				) ); ?>

			<?php else: ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>		

			<?php endif; ?>

<?php get_footer() ?>