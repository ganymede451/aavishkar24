<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 *
 * @package ThinkUpThemes
 */

get_header(); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php /* Add comments - Style 1 */  thinkup_input_allowcomments1(); ?>

			<?php endwhile; ?>

<?php get_footer(); ?>