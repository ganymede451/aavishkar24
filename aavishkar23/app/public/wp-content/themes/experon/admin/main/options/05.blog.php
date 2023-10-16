<?php
/**
 * Blog functions.
 *
 * @package ThinkUpThemes
 */


 /* ----------------------------------------------------------------------------------
	BLOG STYLE
---------------------------------------------------------------------------------- */

function thinkup_input_blogclass($classes){

	$classes[] = 'blog-style1';
	return $classes;
}
add_action( 'body_class', 'thinkup_input_blogclass');


/* ----------------------------------------------------------------------------------
	BLOG STYLE
---------------------------------------------------------------------------------- */

function thinkup_input_stylelayout() {
	echo ' column-1';
}


/* ----------------------------------------------------------------------------------
	HIDE POST TITLE
---------------------------------------------------------------------------------- */

function thinkup_input_blogtitle() {

	echo	'<h2 class="blog-title">',
			'<a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'experon' ), the_title_attribute( 'echo=0' ) ) ) . '">' . get_the_title() . '</a>',
			'</h2>';
}


/* ----------------------------------------------------------------------------------
	BLOG CONTENT
---------------------------------------------------------------------------------- */

// Input post thumbnail / featured media
function thinkup_input_blogimage() {
global $post;

	$size   = NULL;
	$link   = NULL;
	$media  = NULL;
	$output = NULL;

	$blog_lightbox = NULL;
	$blog_link     = NULL;
	$blog_overlay  = NULL;

	// Set image size for blog thumbnail
	$size = 'column1-1/3';

	$featured_id  = get_post_thumbnail_id( $post->ID );
	$featured_img = wp_get_attachment_image_src($featured_id,'full', true);

	// Determine featured media to input
	$link  = $featured_img[0];
	$media = get_the_post_thumbnail( $post->ID, $size );

	// Determine which links to show on hover
	$blog_lightbox = '<a class="hover-zoom prettyPhoto" href="' . esc_url( $link ) . '"><i class="dashicons dashicons-editor-distractionfree"></i></a>';
	$blog_link     = '<a class="hover-link" href="' . esc_url( get_permalink() ) . '"><i class="dashicons dashicons-arrow-right-alt2"></i></a>';

	$blog_overlay .= '<div class="image-overlay">';
	$blog_overlay .= '<div class="image-overlay-inner"><div class="prettyphoto-wrap">';
	$blog_overlay .= $blog_lightbox;
	$blog_overlay .= $blog_link;
	$blog_overlay .= '</div></div>';
	$blog_overlay .= '</div>';

	// Output media on blog page
	if ( ! empty( $featured_id ) ) {
		$output .= '<div class="blog-thumb">';
		$output .= '<a href="'. esc_url( get_permalink( $post->ID ) ) . '">' . $media . '</a>';
		$output .= $blog_overlay;
		$output .= '</div>';
	}

	return $output;
}

// Input post excerpt / content to blog page
function thinkup_input_blogtext() {
global $post;

// Get theme options values.
$thinkup_blog_postswitch = thinkup_var ( 'thinkup_blog_postswitch' );

	// Output full content - EDD plugin compatibility
	if( function_exists( 'EDD' ) and is_post_type_archive( 'download' ) ) {
		the_content();
		return;
	}

	// Output post content
	if ( is_search() ) {
		the_excerpt();
	} else if ( ! is_search() ) {
		if ( ( empty( $thinkup_blog_postswitch ) or $thinkup_blog_postswitch == 'option1' ) ) {
			if( ! is_numeric( strpos( $post->post_content, '<!--more-->' ) ) ) {
				the_excerpt();
			} else {
				the_content();
				wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'experon' ), 'after'  => '</div>', ) );
			}
		} else if ( $thinkup_blog_postswitch == 'option2' ) {
			the_content();
			wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'experon' ), 'after'  => '</div>', ) );
		}
	}
}


/* ----------------------------------------------------------------------------------
	BLOG META CONTENT & POST META CONTENT
---------------------------------------------------------------------------------- */

// Input sticky post
function thinkup_input_sticky() {
	printf( '<span class="sticky"><i class="fa fa-thumb-tack"></i><a href="%1$s" title="%2$s">' . __( 'Sticky', 'experon' ) . '</a></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_title() )
	);
}

// Input blog date
function thinkup_input_blogdate() {
	printf( __( '<span class="date"><a href="%1$s" title="%2$s"><time datetime="%3$s">%4$s</time></a></span>', 'experon' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_title() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'M j, Y' ) )
	);
}

// Input blog comments
function thinkup_input_blogcomment() {

	if ( '0' != get_comments_number() ) {
		echo	'<span class="comment"><i class="fa fa-comments"></i>';
			if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {;
				comments_popup_link( __( '0 Comments', 'experon' ), __( '1 Comment', 'experon' ), __( '% Comments', 'experon' ) );
			};
		echo	'</span>';
	}
}

// Input blog categories
function thinkup_input_blogcategory() {
$categories_list = get_the_category_list( __( ', ', 'experon' ) );

	if ( $categories_list && thinkup_input_categorizedblog() ) {
		echo	'<span class="category"><i class="fa fa-list"></i>';
		printf( '%1$s', $categories_list );
		echo	'</span>';
	};
}

// Input blog tags
function thinkup_input_blogtag() {
$tags_list = get_the_tag_list( '', __( ', ', 'experon' ) );

	if ( $tags_list ) {
		echo	'<span class="tags"><i class="fa fa-tags"></i>';
		printf( '%1$s', $tags_list );
		echo	'</span>';
	};
}

// Input blog author
function thinkup_input_blogauthor() {
	printf( __( '<span class="author"><a href="%1$s" title="%2$s" rel="author">%3$s</a></span>', 'experon' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'experon' ), get_the_author() ) ),
		get_the_author()
	);
}


//----------------------------------------------------------------------------------
//	CUSTOM READ MORE BUTTON.
//----------------------------------------------------------------------------------

// Input 'Read more' link
function thinkup_input_readmore() {
global $post;

	printf( '<p class="more-link style2"><a href="%1$s" class="themebutton"><span class="more-text">' . __( 'READ MORE', 'experon') . '</span><span class="more-icon"><i class="fa fa-angle-right fa-lg"></i></a></p>', esc_url( get_permalink( $post->ID ) ) );
}

/* ----------------------------------------------------------------------------------
	INPUT BLOG META CONTENT
---------------------------------------------------------------------------------- */

// Blog meta content - Blog style 1
function thinkup_input_blogmeta1() {

	echo '<div class="entry-meta">';
		if ( is_sticky() && is_home() && ! is_paged() ) { thinkup_input_sticky(); }

		thinkup_input_blogdate();
		thinkup_input_blogauthor();
		thinkup_input_blogcomment();
		thinkup_input_blogcategory();
		thinkup_input_blogtag();
	echo '</div>';
}


/* ----------------------------------------------------------------------------------
	INPUT POST META CONTENT
---------------------------------------------------------------------------------- */

function thinkup_input_postmedia() {
global $post;

	// Set output variable to avoid php errors
	$output = NULL;

	if ( get_post_format() == 'image' ) {
		$output .= '<div class="post-thumb">' . get_the_post_thumbnail( $post->ID, 'column1-1/4' ) . '</div>';
	}

	// Output featured items if set
	if ( ! empty( $output ) ) {
		echo $output;
	}
}

function thinkup_input_postmeta() {

		echo '<header class="entry-header">';

		echo '<div class="entry-meta">';
			thinkup_input_blogdate();
			thinkup_input_blogauthor();
			thinkup_input_blogcomment();
			thinkup_input_blogcategory();
			thinkup_input_blogtag();
		echo '</div>';

		echo '<div class="clearboth"></div></header><!-- .entry-header -->';
}


/* ----------------------------------------------------------------------------------
	TEMPLATE FOR COMMENTS AND PINGBACKS (PREVIOUSLY IN TEMPLATE-TAGS).
---------------------------------------------------------------------------------- */

/* Display comments  - Style 1 */
function thinkup_input_allowcomments1() {

// Get theme options values.
$thinkup_post_commentstyle = thinkup_var ( 'thinkup_post_commentstyle' );

	if ( empty( $thinkup_post_commentstyle ) or $thinkup_post_commentstyle == 'option1' ) {
		if ( comments_open() || '0' != get_comments_number() )
			comments_template( '/comments.php', true );
	}
}

/* Display comments  - Style 2 */
function thinkup_input_allowcomments2() {

// Get theme options values.
$thinkup_post_commentstyle = thinkup_var ( 'thinkup_post_commentstyle' );

	// ADD CONDITION TO ONLY SHOW IF COMMENT STYLE 2 IS SELECTED - ALSO ADD OPTION TO BLOG PAGE OPTIONS PANEL
	if ( $thinkup_post_commentstyle == 'option2' ) {
		if ( comments_open() || '0' != get_comments_number() )
			comments_template( '/comments.php', true );
	}
}
/* Display comments class - Style 2 */
function thinkup_input_commentsstyle() {

// Get theme options values.
$thinkup_post_commentstyle = thinkup_var ( 'thinkup_post_commentstyle' );

	if ( $thinkup_post_commentstyle == 'option2' ) {
		echo ' class="style2"';
	}
}


/* ----------------------------------------------------------------------------------
	TEMPLATE FOR COMMENTS AND PINGBACKS (PREVIOUSLY IN TEMPLATE-TAGS).
---------------------------------------------------------------------------------- */

function thinkup_input_commenttemplate( $comment, $args, $depth ) {

	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'experon'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'experon' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
					<?php echo get_avatar( $comment, 70 ); ?>
			<header>

				<div class="comment-author">
					<h4><?php printf( '%s', sprintf( '%s', get_comment_author_link() ) ); ?></h4>
				</div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'experon'); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php esc_attr( comment_time( 'c' ) ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( '%1$s', get_comment_date() ); ?>
					</time></a>
					<?php edit_comment_link( __( 'Edit', 'experon' ), ' ' );
					?>
				</div>

				<span class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</span>

			</header><div class="clearboth"></div>

			<footer>

				<div class="comment-content"><?php comment_text(); ?></div>

			</footer>

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}

// List comments in single page
function thinkup_input_comments() {
	$args = array( 
		'callback' => 'thinkup_input_commenttemplate', 
	);
	wp_list_comments( $args );
}


?>