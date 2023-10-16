<?php
/**
 * The template used for displaying promotion headline
 *
 * @package Costello_Dark
 */

$costello_id = get_theme_mod( 'costello_promotion_headline' );
$costello_args['page_id'] = absint( $costello_id );


// If $costello_args is empty return false
if ( empty( $costello_args ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$promotion_headline_query = new WP_Query( $costello_args );
if ( $promotion_headline_query->have_posts() ) :
	while ( $promotion_headline_query->have_posts() ) :
		$promotion_headline_query->the_post();

		$costello_classes[] = 'section';
		$costello_classes[] = 'promotion-section';
		$costello_classes[] = 'content-align-center';
		$costello_classes[] = 'text-align-center';
		$costello_classes[] = 'promotion-headline-one';

		if ( has_post_thumbnail() ) {
			$costello_classes[] = 'has-background-image';
		}
		?>
		<div id="promotion-section" class="<?php echo esc_attr( implode( ' ', $costello_classes ) ); ?>">
			<div class="wrapper">
				<div class="section-content-wrapper">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="hentry-inner">
						<?php costello_post_thumbnail( array( 920, 690 ), 'html-with-bg' ); // costello_post_thumbnail( $image_size, $costello_type = 'html', $echo = true, $no_thumb = false ). ?>

							<div class="entry-container">
								<?php $costello_tagline = get_theme_mod( 'costello_promo_head_tagline' ); ?>

								<header class="entry-header">
									<?php if ( $costello_tagline ) : ?>
										<div class="section-tagline">
											<?php echo wp_kses_post( $costello_tagline ); ?>
										</div><!-- .section-tagline -->
									<?php endif; ?>

									<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
								</header><!-- .entry-header -->

								<span class="more-button">
								<a class="more-link" href="<?php the_permalink(); ?>" target="_blank"><?php echo esc_html( 'View More' ); ?></a>
								</span>
							</div><!-- .entry-container -->
					</div><!-- .hentry-inner -->
				</article><!-- #post-## -->
			</div>
			</div><!-- .wrapper -->
		</div><!-- .section -->
	<?php
	endwhile;
	wp_reset_postdata();
endif;
