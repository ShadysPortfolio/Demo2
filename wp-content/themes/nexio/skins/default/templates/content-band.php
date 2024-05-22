<?php
/**
 * 'Band' template to display the content
 *
 * Used for index/archive/search.
 *
 * @package NEXIO
 * @since NEXIO 1.71.0
 */

$nexio_template_args = get_query_var( 'nexio_template_args' );
if ( ! is_array( $nexio_template_args ) ) {
	$nexio_template_args = array(
								'type'    => 'band',
								'columns' => 1
								);
}

$nexio_columns       = 1;

$nexio_expanded      = ! nexio_sidebar_present() && nexio_get_theme_option( 'expand_content' ) == 'expand';

$nexio_post_format   = get_post_format();
$nexio_post_format   = empty( $nexio_post_format ) ? 'standard' : str_replace( 'post-format-', '', $nexio_post_format );

if ( is_array( $nexio_template_args ) ) {
	$nexio_columns    = empty( $nexio_template_args['columns'] ) ? 1 : max( 1, $nexio_template_args['columns'] );
	$nexio_blog_style = array( $nexio_template_args['type'], $nexio_columns );
	if ( ! empty( $nexio_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $nexio_columns > 1 ) {
	    $nexio_columns_class = nexio_get_column_class( 1, $nexio_columns, ! empty( $nexio_template_args['columns_tablet']) ? $nexio_template_args['columns_tablet'] : '', ! empty($nexio_template_args['columns_mobile']) ? $nexio_template_args['columns_mobile'] : '' );
				?><div class="<?php echo esc_attr( $nexio_columns_class ); ?>"><?php
	}
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_band post_format_' . esc_attr( $nexio_post_format ) );
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
								: array_map( 'trim', explode( ',', $nexio_template_args['meta_parts'] ) )
								)
							: nexio_array_get_keys_by_value( nexio_get_theme_option( 'meta_parts' ) );
	nexio_show_post_featured( apply_filters( 'nexio_filter_args_featured',
		array(
			'no_links'   => ! empty( $nexio_template_args['no_links'] ),
			'hover'      => $nexio_hover,
			'meta_parts' => $nexio_components,
			'thumb_bg'   => true,
			'thumb_ratio'   => '1:1',
			'thumb_size' => ! empty( $nexio_template_args['thumb_size'] )
								? $nexio_template_args['thumb_size']
								: nexio_get_thumb_size( 
								in_array( $nexio_post_format, array( 'gallery', 'audio', 'video' ) )
									? ( strpos( nexio_get_theme_option( 'body_style' ), 'full' ) !== false
										? 'full'
										: ( $nexio_expanded 
											? 'big' 
											: 'medium-square'
											)
										)
									: 'masonry-big'
								)
		),
		'content-band',
		$nexio_template_args
	) );

	?><div class="post_content_wrap"><?php

		// Title and post meta
		$nexio_show_title = get_the_title() != '';
		$nexio_show_meta  = count( $nexio_components ) > 0 && ! in_array( $nexio_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );
		if ( $nexio_show_title ) {
			?>
			<div class="post_header entry-header">
				<?php
				// Categories
				if ( apply_filters( 'nexio_filter_show_blog_categories', $nexio_show_meta && in_array( 'categories', $nexio_components ), array( 'categories' ), 'band' ) ) {
					do_action( 'nexio_action_before_post_category' );
					?>
					<div class="post_category">
						<?php
						nexio_show_post_meta( apply_filters(
															'nexio_filter_post_meta_args',
															array(
																'components' => 'categories',
																'seo'        => false,
																'echo'       => true,
																'cat_sep'    => false,
																),
															'hover_' . $nexio_hover, 1
															)
											);
						?>
					</div>
					<?php
					$nexio_components = nexio_array_delete_by_value( $nexio_components, 'categories' );
					do_action( 'nexio_action_after_post_category' );
				}
				// Post title
				if ( apply_filters( 'nexio_filter_show_blog_title', true, 'band' ) ) {
					do_action( 'nexio_action_before_post_title' );
					if ( empty( $nexio_template_args['no_links'] ) ) {
						the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
					} else {
						the_title( '<h4 class="post_title entry-title">', '</h4>' );
					}
					do_action( 'nexio_action_after_post_title' );
				}
				?>
			</div><!-- .post_header -->
			<?php
		}

		// Post content
		if ( ! isset( $nexio_template_args['excerpt_length'] ) && ! in_array( $nexio_post_format, array( 'gallery', 'audio', 'video' ) ) ) {
			$nexio_template_args['excerpt_length'] = 13;
		}
		if ( apply_filters( 'nexio_filter_show_blog_excerpt', empty( $nexio_template_args['hide_excerpt'] ) && nexio_get_theme_option( 'excerpt_length' ) > 0, 'band' ) ) {
			?>
			<div class="post_content entry-content">
				<?php
				// Post content area
				nexio_show_post_content( $nexio_template_args, '<div class="post_content_inner">', '</div>' );
				?>
			</div><!-- .entry-content -->
			<?php
		}
		// Post meta
		if ( apply_filters( 'nexio_filter_show_blog_meta', $nexio_show_meta, $nexio_components, 'band' ) ) {
			if ( count( $nexio_components ) > 0 ) {
				do_action( 'nexio_action_before_post_meta' );
				nexio_show_post_meta(
					apply_filters(
						'nexio_filter_post_meta_args', array(
							'components' => join( ',', $nexio_components ),
							'seo'        => false,
							'echo'       => true,
						), 'band', 1
					)
				);
				do_action( 'nexio_action_after_post_meta' );
			}
		}
		// More button
		if ( apply_filters( 'nexio_filter_show_blog_readmore', ! $nexio_show_title || ! empty( $nexio_template_args['more_button'] ), 'band' ) ) {
			if ( empty( $nexio_template_args['no_links'] ) ) {
				do_action( 'nexio_action_before_post_readmore' );
				nexio_show_post_more_link( $nexio_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'nexio_action_after_post_readmore' );
			}
		}
		?>
	</div>
</article>
<?php

if ( is_array( $nexio_template_args ) ) {
	if ( ! empty( $nexio_template_args['slider'] ) || $nexio_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
