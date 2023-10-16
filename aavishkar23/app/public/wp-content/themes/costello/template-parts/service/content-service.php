<?php
/**
 * The template for displaying service posts on the front page
 *
 * @package Costello
 */

$costello_number     = get_theme_mod( 'costello_service_number', 3 );
$costello_post_list  = array();
$costello_no_of_post = 0;

$costello_args = array(
	'post_type'           => 'post',
	'ignore_sticky_posts' => 1, // ignore sticky posts.
);

// Get valid number of posts.
$costello_args['post_type'] = 'ect-service';

for ( $i = 1; $i <= $costello_number; $i++ ) {
	$costello_post_id = '';

	$costello_post_id = get_theme_mod( 'costello_service_cpt_' . $i );

	if ( $costello_post_id ) {
		$costello_post_list = array_merge( $costello_post_list, array( $costello_post_id ) );

		$costello_no_of_post++;
	}
}

$costello_args['post__in'] = $costello_post_list;
$costello_args['orderby']  = 'post__in';

$costello_args['posts_per_page'] = $costello_no_of_post;

if ( ! $costello_no_of_post ) {
	return;
}

$costello_loop = new WP_Query( $costello_args );

while ( $costello_loop->have_posts() ) :
	
	$costello_loop->the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="hentry-inner">
			<?php costello_post_thumbnail( array( 110, 110 ), 'html', true ); ?>

			<div class="entry-container">
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
				</header>

				<?php
					$excerpt = get_the_excerpt();
					echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->'; 
				?>
			</div><!-- .entry-container -->
		</div> <!-- .hentry-inner -->
	</article> <!-- .article -->
	<?php
endwhile;

wp_reset_postdata();
