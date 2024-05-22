<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package NEXIO
 * @since NEXIO 1.0
 */

$nexio_template_args = get_query_var( 'nexio_template_args' );

if ( is_array( $nexio_template_args ) ) {
	$nexio_columns    = empty( $nexio_template_args['columns'] ) ? 2 : max( 1, $nexio_template_args['columns'] );
	$nexio_blog_style = array( $nexio_template_args['type'], $nexio_columns );
    $nexio_columns_class = nexio_get_column_class( 1, $nexio_columns, ! empty( $nexio_template_args['columns_tablet']) ? $nexio_template_args['columns_tablet'] : '', ! empty($nexio_template_args['columns_mobile']) ? $nexio_template_args['columns_mobile'] : '' );
} else {
	$nexio_template_args = array();
	$nexio_blog_style = explode( '_', nexio_get_theme_option( 'blog_style' ) );
	$nexio_columns    = empty( $nexio_blog_style[1] ) ? 2 : max( 1, $nexio_blog_style[1] );
    $nexio_columns_class = nexio_get_column_class( 1, $nexio_columns );
}
$nexio_expanded   = ! nexio_sidebar_present() && nexio_get_theme_option( 'expand_content' ) == 'expand';

$nexio_post_format = get_post_format();
$nexio_post_format = empty( $nexio_post_format ) ? 'standard' : str_replace( 'post-format-', '', $nexio_post_format );

?><div class="<?php
	if ( ! empty( $nexio_template_args['slider'] ) ) {
		echo ' slider-slide swiper-slide';
	} else {
		echo ( nexio_is_blog_style_use_masonry( $nexio_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $nexio_columns ) : esc_attr( $nexio_columns_class ) );
	}
?>"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $nexio_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $nexio_columns )
				. ' post_layout_' . esc_attr( $nexio_blog_style[0] )
				. ' post_layout_' . esc_attr( $nexio_blog_style[0] ) . '_' . esc_attr( $nexio_columns )
	);
	nexio_add_blog_animation( $nexio_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$nexio_hover      = ! empty( $nexio_template_args['hover'] ) && ! nexio_is_inherit( $nexio_template_args['hover'] )
							? $nexio_template_args['hover']
							: nexio_get_theme_option( 'image_hover' );

	$nexio_components = ! empty( $nexio_template_args['meta_parts'] )
							? ( is_array( $nexio_template_args['meta_parts'] )
								? $nexio_template_args['meta_parts']
								: explode( ',', $nexio_template_args['meta_parts'] )
								)
							: nexio_array_get_keys_by_value( nexio_get_theme_option( 'meta_parts' ) );

	nexio_show_post_featured( apply_filters( 'nexio_filter_args_featured',
		array(
			'thumb_size' => ! empty( $nexio_template_args['thumb_size'] )
				? $nexio_template_args['thumb_size']
				: nexio_get_thumb_size(
					'classic' == $nexio_blog_style[0]
						? ( strpos( nexio_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $nexio_columns > 2 ? 'big' : 'huge' )
								: ( $nexio_columns > 2
									? ( $nexio_expanded ? 'square' : 'square' )
									: ($nexio_columns > 1 ? 'square' : ( $nexio_expanded ? 'huge' : 'big' ))
									)
							)
						: ( strpos( nexio_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $nexio_columns > 2 ? 'masonry-big' : 'full' )
								: ($nexio_columns === 1 ? ( $nexio_expanded ? 'huge' : 'big' ) : ( $nexio_columns <= 2 && $nexio_expanded ? 'masonry-big' : 'masonry' ))
							)
			),
			'hover'      => $nexio_hover,
			'meta_parts' => $nexio_components,
			'no_links'   => ! empty( $nexio_template_args['no_links'] ),
        ),
        'content-classic',
        $nexio_template_args
    ) );

	// Title and post meta
	$nexio_show_title = get_the_title() != '';
	$nexio_show_meta  = count( $nexio_components ) > 0 && ! in_array( $nexio_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $nexio_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php

			// Post meta
			if ( apply_filters( 'nexio_filter_show_blog_meta', $nexio_show_meta, $nexio_components, 'classic' ) ) {
				if ( count( $nexio_components ) > 0 ) {
					do_action( 'nexio_action_before_post_meta' );
					nexio_show_post_meta(
						apply_filters(
							'nexio_filter_post_meta_args', array(
							'components' => join( ',', $nexio_components ),
							'seo'        => false,
							'echo'       => true,
						), $nexio_blog_style[0], $nexio_columns
						)
					);
					do_action( 'nexio_action_after_post_meta' );
				}
			}

			// Post title
			if ( apply_filters( 'nexio_filter_show_blog_title', true, 'classic' ) ) {
				do_action( 'nexio_action_before_post_title' );
				if ( empty( $nexio_template_args['no_links'] ) ) {
					the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
				} else {
					the_title( '<h4 class="post_title entry-title">', '</h4>' );
				}
				do_action( 'nexio_action_after_post_title' );
			}

			if( !in_array( $nexio_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
				// More button
				if ( apply_filters( 'nexio_filter_show_blog_readmore', ! $nexio_show_title || ! empty( $nexio_template_args['more_button'] ), 'classic' ) ) {
					if ( empty( $nexio_template_args['no_links'] ) ) {
						do_action( 'nexio_action_before_post_readmore' );
						nexio_show_post_more_link( $nexio_template_args, '<div class="more-wrap">', '</div>' );
						do_action( 'nexio_action_after_post_readmore' );
					}
				}
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}

	// Post content
	if( in_array( $nexio_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
		ob_start();
		if (apply_filters('nexio_filter_show_blog_excerpt', empty($nexio_template_args['hide_excerpt']) && nexio_get_theme_option('excerpt_length') > 0, 'classic')) {
			nexio_show_post_content($nexio_template_args, '<div class="post_content_inner">', '</div>');
		}
		// More button
		if(! empty( $nexio_template_args['more_button'] )) {
			if ( empty( $nexio_template_args['no_links'] ) ) {
				do_action( 'nexio_action_before_post_readmore' );
				nexio_show_post_more_link( $nexio_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'nexio_action_after_post_readmore' );
			}
		}
		$nexio_content = ob_get_contents();
		ob_end_clean();
		nexio_show_layout($nexio_content, '<div class="post_content entry-content">', '</div><!-- .entry-content -->');
	}
	?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
