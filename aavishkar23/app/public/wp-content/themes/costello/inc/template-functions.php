<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Costello
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @since 1.0.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function costello_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Always add a front-page class to the front page.
	if ( is_front_page() && ! is_home() ) {
		$classes[] = 'page-template-front-page';
	}

	// Adds a class of (full-width|box) to blogs.
	$classes[] = 'fluid-layout';
	
	// Adds a class of navigation-(default|classic) to blogs.
	if ('modern' === get_theme_mod('costello_menu_type', 'classic')) {
		$classes[] = 'navigation-default';
	} else {
		$classes[] = 'navigation-classic';
	}

	// Adds a class with respect to layout selected.
	$layout  = costello_get_theme_layout();
	$sidebar = costello_get_sidebar_id();

	$layout_class = "no-sidebar content-width-layout";

	if ( 'no-sidebar-full-width' === $layout ) {
		$layout_class = 'no-sidebar full-width-layout';
	} elseif ( 'left-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$layout_class = 'two-columns-layout content-right';
		}
	} elseif ( 'right-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$layout_class = 'two-columns-layout content-left';
		}
	}

	$classes[] = $layout_class;

	$classes[] = esc_attr( 'excerpt' );

	$classes[] = 'header-media-fluid';

	$enable_sticky_playlist = get_theme_mod( 'costello_sticky_playlist_visibility', 'disabled' );

	if ( costello_check_section( $enable_sticky_playlist ) ) {
		$classes[] = 'sticky-playlist-enabled';
	}

	$enable_slider = costello_check_section( get_theme_mod( 'costello_slider_option', 'disabled' ) );

	$header_image = costello_featured_overall_image();

	if ( 'disable' !== $header_image ) {
		$classes[] = 'has-header-media';
	}

	if ( ! ( costello_has_header_media_text() ) ) {
		$classes[] = 'header-media-text-disabled';
	}

	// Add a class if there is a custom header.
	if ( has_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Added color scheme to body class.
	$classes['color-scheme'] = 'color-scheme-' . esc_attr( get_theme_mod( 'color_scheme', 'default' ) );

	return $classes;
}
add_filter( 'body_class', 'costello_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function costello_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'costello_pingback_header' );

if ( ! function_exists( 'costello_comment_form_fields' ) ) :
	/**
	 * Modify Comment Form Fields
	 *
	 * @uses comment_form_default_fields filter
	 * @since 1.0.0
	 */
	function costello_comment_form_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$label     = $req ? ' *' : ' ' . esc_html__( '(optional)', 'costello' );
		$aria_req  = $req ? "aria-required='true'" : '';

		$fields['author'] =
			'<p class="comment-form-author">
				<input id="author" name="author" type="text" placeholder="' . esc_attr__( "Name", "costello" ) . $label . '" value="' . esc_attr( $commenter['comment_author'] ) .
			'" size="30" ' . $aria_req . ' />
			</p>';

		$fields['email'] =
			'<p class="comment-form-email">
				<input id="email" name="email" type="email" placeholder="' . esc_attr__( "Email", "costello" ) . $label . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
			'" size="30" ' . $aria_req . ' />
			</p>';

		if ( isset( $fields['url'] ) ) {
			unset( $fields['url'] );
		} else {
			$fields['url'] =
			'<p class="comment-form-url">
				<input id="url" name="url" type="url"  placeholder="' . esc_attr__( "Website", "costello" ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
			'" size="30" />
				</p>';
		}

		return $fields;
	}
endif; // costello_comment_form_fields.
add_filter( 'comment_form_default_fields', 'costello_comment_form_fields' );

if ( ! function_exists( 'costello_comment_field' ) ) :
	/**
	 * Modify Comment Textarea Fields
	 *
	 * @uses comment_form_field_comment filter
	 * @since 1.0.0
	 */
	function costello_comment_field( $comment_field ) {
	  $comment_field =
	    '<p class="comment-form-comment">
	            <textarea required id="comment" name="comment" placeholder="' . esc_attr__( "Comment", "costello" ) . ' *' . '" cols="45" rows="8" aria-required="true"></textarea>
	        </p>';

	  return $comment_field;
	}
endif; // costello_comment_field.
add_filter( 'comment_form_field_comment', 'costello_comment_field' );

/**
 * Adds custom overlay for Promotion Headline Background Image
 */
function costello_promo_head_bg_image_overlay_css() {
	$enable   = get_theme_mod( 'costello_promo_head_visibility', 'disabled' );

	if ( ! costello_check_section( $enable ) ) {
		// Bail if promo section is disabled.
		return;
	}

	$content_align = get_theme_mod( 'costello_promo_head_image_position', 'content-align-center' );

	if ( 'content-align-center' !== $content_align ) {
		// Bail if content-align-center is not set.
		return;
	}

	$overlay = get_theme_mod( 'costello_promo_head_background_image_opacity', 0 );

	if ( $overlay ) {
		$overlay_bg = $overlay / 100;

		$css = '.promotion-section .cover-link:before {
			background-color: rgba(0, 0, 0, ' . esc_attr( $overlay_bg ) . ' );
		} '; // Dividing by 100 as the option is shown as % for user

		wp_add_inline_style( 'costello-style', $css );
	}

	
}
add_action( 'wp_enqueue_scripts', 'costello_promo_head_bg_image_overlay_css', 11 );

/**
 * Adds custom overlay for Promotion Contact Background Image
 */
function costello_promo_contact_bg_image_overlay_css() {
	$enable   = get_theme_mod( 'costello_promo_contact_visibility', 'disabled' );

	if ( ! costello_check_section( $enable ) ) {
		// Bail if promo section is disabled.
		return;
	}

	$overlay = get_theme_mod( 'costello_promo_contact_background_image_opacity', 15 );

	if ( $overlay ) {
		$overlay_bg = $overlay / 100;

		$css = '.promotion-contact .post-thumbnail-background:before {
			background-color: rgba(0, 0, 0, ' . esc_attr( $overlay_bg ) . ' );
		} '; // Dividing by 100 as the option is shown as % for user

		wp_add_inline_style( 'costello-style', $css );
	}
}
add_action( 'wp_enqueue_scripts', 'costello_promo_contact_bg_image_overlay_css', 11 );

/**
 * Adds custom overlay for Promotion Contact Background Image
 */
function costello_promotional_video_bg_image_overlay_css() {
	$enable   = get_theme_mod( 'costello_promotional_video_visibility', 'disabled' );

	if ( ! costello_check_section( $enable ) ) {
		// Bail if promo section is disabled.
		return;
	}

	$overlay = get_theme_mod( 'costello_promotional_video_background_image_opacity', 15 );

	if ( $overlay ) {
		$overlay_bg = $overlay / 100;

		$css = '.promotional-video-section:before {
			background-color: rgba(0, 0, 0, ' . esc_attr( $overlay_bg ) . ' );
		} '; // Dividing by 100 as the option is shown as % for user

		wp_add_inline_style( 'costello-style', $css );
	}
}
add_action( 'wp_enqueue_scripts', 'costello_promotional_video_bg_image_overlay_css', 11 );

/**
 * Adds featured video background CSS
 */
function costello_promotional_video_bg_css() {
	$enable   = get_theme_mod( 'costello_promotional_video_option', 'disabled' );

	if ( ! costello_check_section( $enable ) ) {
		// Bail if contact section is disabled.
		return;
	}

	$background = get_theme_mod( 'costello_promotional_video_bg_image' );

	if ( $background ) {
		$css = '#promotional-video-section { background-image: url("' . esc_url( $background ) . '"); }';

		wp_add_inline_style( 'costello-style', $css );
	}

	
}
add_action( 'wp_enqueue_scripts', 'costello_promotional_video_bg_css', 11 );

/**
 * Adds custom overlay for Header Media
 */
function costello_header_media_image_overlay_css() {
	$overlay = get_theme_mod( 'costello_header_media_image_opacity' );

	if ( $overlay ) {
		$overlay_bg = $overlay / 100;

		$css = '.custom-header-overlay {
			background-color: rgba(0, 0, 0, ' . esc_attr( $overlay_bg ) . ' );
		} '; // Dividing by 100 as the option is shown as % for user

		wp_add_inline_style( 'costello-style', $css );
	}

	
}
add_action( 'wp_enqueue_scripts', 'costello_header_media_image_overlay_css', 11 );

/**
 * Remove first post from blog as it is already show via recent post template
 */
function costello_alter_home( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$cats = get_theme_mod( 'costello_front_page_category' );

		if ( is_array( $cats ) && ! in_array( '0', $cats ) ) {
			$query->query_vars['category__in'] = $cats;
		}
	}
}
add_action( 'pre_get_posts', 'costello_alter_home' );

if ( ! function_exists( 'costello_content_nav' ) ) :
	/**
	 * Display navigation/pagination when applicable
	 *
	 * @since 1.0.0
	 */
	function costello_content_nav() {
		global $wp_query;

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$pagination_type = get_theme_mod( 'costello_pagination_type', 'default' );

		if ( ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) || class_exists( 'Catch_Infinite_Scroll' ) ) {
			// Support infinite scroll plugins.
			the_posts_navigation();
		} elseif ( 'numeric' === $pagination_type && function_exists( 'the_posts_pagination' ) ) {
			the_posts_pagination( array(
				'prev_text'          => '<span>' . esc_html__( 'Prev', 'costello' ) . '</span>',
				'next_text'          => '<span>' . esc_html__( 'Next', 'costello' ) . '</span>',
				'screen_reader_text' => '<span class="nav-subtitle screen-reader-text">' . esc_html__( 'Page', 'costello' ) . ' </span>',
			) );
		} else {
			the_posts_navigation();
		}
	}
endif; // costello_content_nav

/**
 * Check if a section is enabled or not based on the $value parameter
 * @param  string $value Value of the section that is to be checked
 * @return boolean return true if section is enabled otherwise false
 */
function costello_check_section( $value ) {
	return ( 'entire-site' == $value  || ( is_front_page() && 'homepage' === $value ) );
}

/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * @since 1.0.0
 */
function costello_get_first_image( $postID, $size, $attr, $src = false ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field('post_content', $postID ) , $matches);

	if ( isset( $matches[1][0] ) ) {
		// Get first image.
		$first_img = $matches[1][0];

		if ( $src ) {
			//Return url of src is true
			return $first_img;
		}

		return '<img class="wp-post-image" src="'. esc_url( $first_img ) .'">';
	}

	return false;
}

function costello_get_theme_layout() {
	$layout = '';

	if ( is_page_template( 'templates/no-sidebar.php' ) ) {
		$layout = 'no-sidebar';
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$layout = 'right-sidebar';
	} else {
		$layout = get_theme_mod( 'costello_default_layout', 'right-sidebar' );

		if ( is_home() || is_archive() ) {
			$layout = get_theme_mod( 'costello_homepage_archive_layout', 'right-sidebar' );
		}
	}

	return $layout;
}

function costello_get_sidebar_id() {
	$sidebar = $id = '';

	$layout = costello_get_theme_layout();

	if ( 'no-sidebar' === $layout ) {
		return $sidebar;
	}

	// Blog Page or Front Page setting in Reading Settings.
	if ( 'page' == get_option('show_on_front') ) {
		$id = get_option('show_on_front');
	} elseif ( is_singular() ) {
		global $post;

		$id = $post->ID;

		if ( is_attachment() ) {
			$id = $post->post_parent;
		}
	}

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$sidebar = 'sidebar-1'; // Primary Sidebar.
	}

	return $sidebar;
}

if ( ! function_exists( 'costello_truncate_phrase' ) ) :
	/**
	 * Return a phrase shortened in length to a maximum number of characters.
	 *
	 * Result will be truncated at the last white space in the original string. In this function the word separator is a
	 * single space. Other white space characters (like newlines and tabs) are ignored.
	 *
	 * If the first `$max_characters` of the string does not contain a space character, an empty string will be returned.
	 *
	 * @since 1.0.0
	 *
	 * @param string $text            A string to be shortened.
	 * @param integer $max_characters The maximum number of characters to return.
	 *
	 * @return string Truncated string
	 */
	function costello_truncate_phrase( $text, $max_characters ) {

		$text = trim( $text );

		if ( mb_strlen( $text ) > $max_characters ) {
			//* Truncate $text to $max_characters + 1
			$text = mb_substr( $text, 0, $max_characters + 1 );

			//* Truncate to the last space in the truncated string
			$text = trim( mb_substr( $text, 0, mb_strrpos( $text, ' ' ) ) );
		}

		return $text;
	}
endif; //costello_truncate_phrase

if ( ! function_exists( 'costello_get_the_content_limit' ) ) :
	/**
	 * Return content stripped down and limited content.
	 *
	 * Strips out tags and shortcodes, limits the output to `$max_char` characters, and appends an ellipsis and more link to the end.
	 *
	 * @since 1.0.0
	 *
	 * @param integer $max_characters The maximum number of characters to return.
	 * @param string  $more_link_text Optional. Text of the more link. Default is "(more...)".
	 * @param bool    $stripteaser    Optional. Strip teaser content before the more text. Default is false.
	 *
	 * @return string Limited content.
	 */
	function costello_get_the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {

		$content = get_the_content( '', $stripteaser );

		// Strip tags and shortcodes so the content truncation count is done correctly.
		$content = strip_tags( strip_shortcodes( $content ), apply_filters( 'get_the_content_limit_allowedtags', '<script>,<style>' ) );

		// Remove inline styles / .
		$content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) );

		// Truncate $content to $max_char
		$content = costello_truncate_phrase( $content, $max_characters );

		// More link?
		if ( $more_link_text ) {
			$link   = apply_filters( 'get_the_content_more_link', sprintf( '<a href="%s" class="more-link">%s</a>', esc_url( get_permalink() ), $more_link_text ), $more_link_text );
			$output = sprintf( '<p>%s %s</p>', $content, $link );
		} else {
			$output = sprintf( '<p>%s</p>', $content );
			$link = '';
		}

		return apply_filters( 'costello_get_the_content_limit', $output, $content, $link, $max_characters );

	}
endif; //costello_get_the_content_limit

if ( ! function_exists( 'costello_content_image' ) ) :
	/**
	 * Template for Featured Image in Archive Content
	 *
	 * To override this in a child theme
	 * simply fabulous-fluid your own costello_content_image(), and that function will be used instead.
	 *
	 * @since 1.0.0
	 */
	function costello_content_image() {
		if ( has_post_thumbnail() && costello_jetpack_featured_image_display() && is_singular() ) {
			global $post, $wp_query;

			// Get Page ID outside Loop.
			$page_id = $wp_query->get_queried_object_id();

			if ( $post ) {
				if ( is_attachment() ) {
					$parent = $post->post_parent;

					$individual_featured_image = get_post_meta( $parent, 'costello-featured-image', true );
				} else {
					$individual_featured_image = get_post_meta( $page_id, 'costello-featured-image', true );
				}
			}

			if ( empty( $individual_featured_image ) ) {
				$individual_featured_image = 'default';
			}

			if ( 'disable' === $individual_featured_image ) {
				echo '<!-- Page/Post Single Image Disabled or No Image set in Post Thumbnail -->';
				return false;
			} else {
				$class = array();

				$image_size = 'post-thumbnail';

				if ( 'default' !== $individual_featured_image ) {
					$image_size = $individual_featured_image;
					$class[]    = 'from-metabox';
				} else {
					$layout = costello_get_theme_layout();

					if ( 'no-sidebar-full-width' === $layout ) {
						$image_size = 'costello-slider';
					}
				}

				$class[] = $individual_featured_image;
				?>
				<div class="post-thumbnail <?php echo esc_attr( implode( ' ', $class ) ); ?>">
					<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( $image_size ); ?>
					</a>
				</div>
			<?php
			}
		} // End if ().
	}
endif; // costello_content_image.

if ( ! function_exists( 'costello_sections' ) ) :
	/**
	 * Display Sections on header and footer with respect to the section option set in costello_sections_sort
	 */
	function costello_sections() {
		get_template_part('template-parts/header/header-media');
		get_template_part('template-parts/slider/display-slider');
		get_template_part('template-parts/portfolio/display-portfolio');
		get_template_part('template-parts/service/display-service');
		get_template_part('template-parts/hero-content/content-hero');
		get_template_part('template-parts/testimonial/display-testimonial');
		get_template_part('template-parts/featured-content/display-featured');

	}
endif;

if ( ! function_exists( 'costello_post_thumbnail' ) ) :
	/**
	 * $image_size post thumbnail size
	 * $type html, html-with-bg, url
	 * $echo echo true/false
	 * $no_thumb display no-thumb image or not
	 */
	function costello_post_thumbnail( $image_size = 'post-thumbnail', $type = 'html', $echo = true, $no_thumb = false ) {
		$image = $image_url = '';

		if ( has_post_thumbnail() ) {
			$image_url = get_the_post_thumbnail_url( get_the_ID(), $image_size );
			$image     = get_the_post_thumbnail( get_the_ID(), $image_size );
		} else {
			if ( is_array( $image_size ) && $no_thumb ) {
				$image_url  = trailingslashit( get_template_directory_uri() ) . 'assets/images/no-thumb-' . $image_size[0] . 'x' . $image_size[1] . '.jpg';
				$image      = '<img src="' . esc_url( $image_url ) . '" alt="" />';
			} elseif ( $no_thumb ) {
				global $_wp_additional_image_sizes;

				$image_url  = trailingslashit( get_template_directory_uri() ) . 'assets/images/no-thumb-1920x1080.jpg';

				if ( array_key_exists( $image_size, $_wp_additional_image_sizes ) ) {
					$image_url  = trailingslashit( get_template_directory_uri() ) . 'assets/images/no-thumb-' . $_wp_additional_image_sizes[ $image_size ]['width'] . 'x' . $_wp_additional_image_sizes[ $image_size ]['height'] . '.jpg';
				}

				$image      = '<img src="' . esc_url( $image_url ) . '" alt="" />';
			}

			// Get the first image in page, returns false if there is no image.
			$first_image_url = costello_get_first_image( get_the_ID(), $image_size, '', true );

			// Set value of image as first image if there is an image present in the page.
			if ( $first_image_url ) {
				$image_url = $first_image_url;
				$image = '<img class="wp-post-image" src="'. esc_url( $image_url ) .'">';
			}
		}

		if ( ! $image_url ) {
			// Bail if there is no image url at this stage.
			return;
		}

		if ( 'url' === $type ) {
			return $image_url;
		}

		$output = '<div';

		if ( 'html-with-bg' === $type ) {
			$output .= ' class="post-thumbnail-background" style="background-image: url( ' . esc_url( $image_url ) . ' )"';
		} else {
			$output .= ' class="post-thumbnail"';
		}

		$output .= '>';

		$output .= '<a class="cover-link" href="' . esc_url( get_the_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '">';

		if ( 'html-with-bg' !== $type ) {
			$output .= $image;
		}

		$output .= '</a></div><!-- .post-thumbnail -->';

		if ( ! $echo ) {
			return $output;
		}

		echo $output;
	}
endif;
