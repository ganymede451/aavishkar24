<?php

/**
 * The template used for displaying hero content
 *
 * @package Costello
 */

$costello_id = get_theme_mod('costello_hero_content');
$costello_args['page_id'] = absint($costello_id);


// If $costello_args is empty return false
if (empty($costello_args)) {
	return;
}

// Create a new WP_Query using the argument previously created
$hero_query = new WP_Query($costello_args);
if ($hero_query->have_posts()) :
	while ($hero_query->have_posts()) :
		$hero_query->the_post();
?>
		<div id="hero-section" class="hero-section section content-align-right text-align-left">
			<div class="wrapper">
				<div class="section-content-wrapper hero-content-wrapper">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="hentry-inner">
							<?php
							if (has_post_thumbnail()) :
								costello_post_thumbnail(array(670, 750), 'html', true); 
							?>
								<div class="entry-container">
								<?php else : ?>
									<div class="entry-container full-width">
									<?php endif; 

									$costello_tagline = get_theme_mod('costello_hero_content_tagline'); 
									?>
									<header class="entry-header">
										<?php if ($costello_tagline) : ?>
											<div class="section-tagline">
												<?php echo wp_kses_post($costello_tagline); ?>
											</div><!-- .section-tagline -->
										<?php endif; ?>

										<h2 class="entry-title">
											<?php the_title(); ?>
										</h2>
									</header><!-- .entry-header -->

									<div class="entry-summary">
										<?php the_excerpt();  ?>
									</div><!-- .entry-summary -->


									<?php if (get_edit_post_link()) : ?>
										<footer class="entry-footer">
											<div class="entry-meta">
												<?php
												edit_post_link(
													sprintf(
														/* translators: %s: Name of current post */
														esc_html__('Edit %s', 'costello'),
														the_title('<span class="screen-reader-text">"', '"</span>', false)
													),
													'<span class="edit-link">',
													'</span>'
												);
												?>
											</div> <!-- .entry-meta -->
										</footer><!-- .entry-footer -->
									<?php endif; ?>
									</div><!-- .hentry-inner -->
					</article>
				</div><!-- .section-content-wrapper -->
			</div><!-- .wrapper -->
		</div><!-- .section -->
<?php
	endwhile;

	wp_reset_postdata();
endif;
