<?php
/**
 * The template for displaying testimonial items
 *
 * @package Costello
 */

$number = get_theme_mod( 'costello_testimonial_number', 4 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

$args = array(
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$post_list  = array();// list of valid post/page ids

$args['post_type'] = 'jetpack-testimonial';

for ( $i = 1; $i <= $number; $i++ ) {
	$costello_post_id = '';

	$costello_post_id =  get_theme_mod( 'costello_testimonial_cpt_' . $i );

	if ( $costello_post_id && '' !== $costello_post_id ) {
		// Polylang Support.
		if ( class_exists( 'Polylang' ) ) {
			$costello_post_id = pll_get_post( $costello_post_id, pll_current_language() );
		}

		$post_list = array_merge( $post_list, array( $costello_post_id ) );

	}
}

$args['post__in'] = $post_list;
$args['orderby'] = 'post__in';

$args['posts_per_page'] = $number;
$loop = new WP_Query( $args );

if ( $loop -> have_posts() ) :
	while ( $loop -> have_posts() ) :
		$loop -> the_post();

		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="hentry-inner">
				<div class="entry-container">
					<div class="entry-summary">
						<div class="content-wrap">
							<?php the_excerpt(); ?>
						</div>
					</div>


					<?php
						$counter	= absint( $loop->current_post ) + 1;
    					$position = get_post_meta( $post->ID, 'ect_testimonial_position', true );
					?>

						<div class="author-thumb">
							<?php costello_post_thumbnail( array(100,100), 'html', true ); ?>
							
							<header class="entry-header">
								<?php if ( get_theme_mod( 'costello_testimonial_enable_title', 1 ) ) :?>
									<h2 class="entry-title">
										<a href=<?php the_permalink(); ?>>
											<?php the_title(); ?>
										</a>
									</h2>
								<?php endif;

								if( $position ) : ?>
									<div class="position" >
										<?php echo esc_html( $position ); ?>
									</div>
								<?php endif; ?>
							</header>

					</div><!-- .author-thumb -->
				</div><!-- .entry-container -->
			</div><!-- .hentry-inner -->
		</article>
	<?php
	endwhile;
	wp_reset_postdata();
endif;
