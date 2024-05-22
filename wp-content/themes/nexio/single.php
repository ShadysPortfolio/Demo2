<?php
/**
 * The template to display single post
 *
 * @package NEXIO
 * @since NEXIO 1.0
 */

// Full post loading
$full_post_loading          = nexio_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = nexio_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = nexio_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$nexio_related_position   = nexio_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$nexio_posts_navigation   = nexio_get_theme_option( 'posts_navigation' );
$nexio_prev_post          = false;
$nexio_prev_post_same_cat = nexio_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( nexio_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	nexio_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'nexio_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $nexio_posts_navigation ) {
		$nexio_prev_post = get_previous_post( $nexio_prev_post_same_cat );  // Get post from same category
		if ( ! $nexio_prev_post && $nexio_prev_post_same_cat ) {
			$nexio_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $nexio_prev_post ) {
			$nexio_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $nexio_prev_post ) ) {
		nexio_sc_layouts_showed( 'featured', false );
		nexio_sc_layouts_showed( 'title', false );
		nexio_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $nexio_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'nexio_filter_get_template_part', 'templates/content', 'single-' . nexio_get_theme_option( 'single_style' ) ), 'single-' . nexio_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $nexio_related_position, 'inside' ) === 0 ) {
		$nexio_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'nexio_action_related_posts' );
		$nexio_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $nexio_related_content ) ) {
			$nexio_related_position_inside = max( 0, min( 9, nexio_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $nexio_related_position_inside ) {
				$nexio_related_position_inside = mt_rand( 1, 9 );
			}

			$nexio_p_number         = 0;
			$nexio_related_inserted = false;
			$nexio_in_block         = false;
			$nexio_content_start    = strpos( $nexio_content, '<div class="post_content' );
			$nexio_content_end      = strrpos( $nexio_content, '</div>' );

			for ( $i = max( 0, $nexio_content_start ); $i < min( strlen( $nexio_content ) - 3, $nexio_content_end ); $i++ ) {
				if ( $nexio_content[ $i ] != '<' ) {
					continue;
				}
				if ( $nexio_in_block ) {
					if ( strtolower( substr( $nexio_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$nexio_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $nexio_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $nexio_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$nexio_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $nexio_content[ $i + 1 ] && in_array( $nexio_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$nexio_p_number++;
					if ( $nexio_related_position_inside == $nexio_p_number ) {
						$nexio_related_inserted = true;
						$nexio_content = ( $i > 0 ? substr( $nexio_content, 0, $i ) : '' )
											. $nexio_related_content
											. substr( $nexio_content, $i );
					}
				}
			}
			if ( ! $nexio_related_inserted ) {
				if ( $nexio_content_end > 0 ) {
					$nexio_content = substr( $nexio_content, 0, $nexio_content_end ) . $nexio_related_content . substr( $nexio_content, $nexio_content_end );
				} else {
					$nexio_content .= $nexio_related_content;
				}
			}
		}

		nexio_show_layout( $nexio_content );
	}

	// Comments
	do_action( 'nexio_action_before_comments' );
	comments_template();
	do_action( 'nexio_action_after_comments' );

	// Related posts
	if ( 'below_content' == $nexio_related_position
		&& ( 'scroll' != $nexio_posts_navigation || nexio_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || nexio_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'nexio_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $nexio_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $nexio_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $nexio_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $nexio_prev_post ) ); ?>"
			<?php do_action( 'nexio_action_nav_links_single_scroll_data', $nexio_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
