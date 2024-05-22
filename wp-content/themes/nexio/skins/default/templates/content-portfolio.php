<?php
/**
 * The Portfolio template to display the content
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

$nexio_post_format = get_post_format();
$nexio_post_format = empty( $nexio_post_format ) ? 'standard' : str_replace( 'post-format-', '', $nexio_post_format );

?><div class="
<?php
if ( ! empty( $nexio_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( nexio_is_blog_style_use_masonry( $nexio_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $nexio_columns ) : esc_attr( $nexio_columns_class ));
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $nexio_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $nexio_columns )
		. ( 'portfolio' != $nexio_blog_style[0] ? ' ' . esc_attr( $nexio_blog_style[0] )  . '_' . esc_attr( $nexio_columns ) : '' )
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

	$nexio_hover   = ! empty( $nexio_template_args['hover'] ) && ! nexio_is_inherit( $nexio_template_args['hover'] )
								? $nexio_template_args['hover']
								: nexio_get_theme_option( 'image_hover' );

	if ( 'dots' == $nexio_hover ) {
		$nexio_post_link = empty( $nexio_template_args['no_links'] )
								? ( ! empty( $nexio_template_args['link'] )
									? $nexio_template_args['link']
									: get_permalink()
									)
								: '';
		$nexio_target    = ! empty( $nexio_post_link ) && false === strpos( $nexio_post_link, home_url() )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$nexio_components = ! empty( $nexio_template_args['meta_parts'] )
							? ( is_array( $nexio_template_args['meta_parts'] )
								? $nexio_template_args['meta_parts']
								: explode( ',', $nexio_template_args['meta_parts'] )
								)
							: nexio_array_get_keys_by_value( nexio_get_theme_option( 'meta_parts' ) );

	// Featured image
	nexio_show_post_featured( apply_filters( 'nexio_filter_args_featured',
        array(
			'hover'         => $nexio_hover,
			'no_links'      => ! empty( $nexio_template_args['no_links'] ),
			'thumb_size'    => ! empty( $nexio_template_args['thumb_size'] )
								? $nexio_template_args['thumb_size']
								: nexio_get_thumb_size(
									nexio_is_blog_style_use_masonry( $nexio_blog_style[0] )
										? (	strpos( nexio_get_theme_option( 'body_style' ), 'full' ) !== false || $nexio_columns < 3
											? 'masonry-big'
											: 'masonry'
											)
										: (	strpos( nexio_get_theme_option( 'body_style' ), 'full' ) !== false || $nexio_columns < 3
											? 'square'
											: 'square'
											)
								),
			'thumb_bg' => nexio_is_blog_style_use_masonry( $nexio_blog_style[0] ) ? false : true,
			'show_no_image' => true,
			'meta_parts'    => $nexio_components,
			'class'         => 'dots' == $nexio_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $nexio_hover
										? '<div class="post_info"><h5 class="post_title">'
											. ( ! empty( $nexio_post_link )
												? '<a href="' . esc_url( $nexio_post_link ) . '"' . ( ! empty( $target ) ? $target : '' ) . '>'
												: ''
												)
												. esc_html( get_the_title() ) 
											. ( ! empty( $nexio_post_link )
												? '</a>'
												: ''
												)
											. '</h5></div>'
										: '',
            'thumb_ratio'   => 'info' == $nexio_hover ?  '100:102' : '',
        ),
        'content-portfolio',
        $nexio_template_args
    ) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!