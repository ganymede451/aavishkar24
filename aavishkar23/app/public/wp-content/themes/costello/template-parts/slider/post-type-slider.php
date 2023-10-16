<?php
/**
 * The template used for displaying slider
 *
 * @package Costello
 */

$costello_quantity    = get_theme_mod( 'costello_slider_number', 4 );
$costello_no_of_post  = 0; // for number of posts
$costello_post_list   = array(); // list of valid post/page ids

$costello_args = array(
	'ignore_sticky_posts' => 1, // ignore sticky posts
);

//Get valid number of posts
$costello_args['post_type'] =  'page';

for ( $i = 1; $i <= $costello_quantity; $i++ ) {
	$costello_id = '';

	$costello_id = get_theme_mod( 'costello_slider_page_' . $i );

	if ( $costello_id && '' !== $costello_id ) {
		$costello_post_list = array_merge( $costello_post_list, array( $costello_id ) );

		$costello_no_of_post++;
	}
}

$costello_args['post__in'] = $costello_post_list;
$costello_args['orderby'] = 'post__in';

if ( ! $costello_no_of_post ) {
	return;
}

$costello_args['posts_per_page'] = $costello_no_of_post;
$costello_loop = new WP_Query( $costello_args );

while ( $costello_loop->have_posts() ) :
	$costello_loop->the_post();

	$costello_classes = 'post post-' . get_the_ID() . ' hentry slides';

	?>
	<article class="<?php echo esc_attr( $costello_classes ); ?>">
		<div class="hentry-inner">
			<?php costello_post_thumbnail( 'costello-slider', 'html', true, true ); ?>

			<div class="entry-container">
				<div class="content-container">
					<header class="entry-header">

						<h2 class="entry-title">
							<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h2>
					</header>

					<?php
						echo '<div class="entry-summary"><p>' . wp_kses_post( get_the_excerpt() ) . '</p></div><!-- .entry-summary -->';
					?>
				</div> <!--  .content-container  -->
			</div><!-- .entry-container -->
		</div><!-- .hentry-inner -->
	</article><!-- .slides -->
<?php
endwhile;

wp_reset_postdata();
