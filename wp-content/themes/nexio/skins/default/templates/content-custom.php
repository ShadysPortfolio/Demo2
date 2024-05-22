<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package NEXIO
 * @since NEXIO 1.0.50
 */

$nexio_template_args = get_query_var( 'nexio_template_args' );
if ( is_array( $nexio_template_args ) ) {
	$nexio_columns    = empty( $nexio_template_args['columns'] ) ? 2 : max( 1, $nexio_template_args['columns'] );
	$nexio_blog_style = array( $nexio_template_args['type'], $nexio_columns );
} else {
	$nexio_template_args = array();
	$nexio_blog_style = explode( '_', nexio_get_theme_option( 'blog_style' ) );
	$nexio_columns    = empty( $nexio_blog_style[1] ) ? 2 : max( 1, $nexio_blog_style[1] );
}
$nexio_blog_id       = nexio_get_custom_blog_id( join( '_', $nexio_blog_style ) );
$nexio_blog_style[0] = str_replace( 'blog-custom-', '', $nexio_blog_style[0] );
$nexio_expanded      = ! nexio_sidebar_present() && nexio_get_theme_option( 'expand_content' ) == 'expand';
$nexio_components    = ! empty( $nexio_template_args['meta_parts'] )
							? ( is_array( $nexio_template_args['meta_parts'] )
								? join( ',', $nexio_template_args['meta_parts'] )
								: $nexio_template_args['meta_parts']
								)
							: nexio_array_get_keys_by_value( nexio_get_theme_option( 'meta_parts' ) );
$nexio_post_format   = get_post_format();
$nexio_post_format   = empty( $nexio_post_format ) ? 'standard' : str_replace( 'post-format-', '', $nexio_post_format );

$nexio_blog_meta     = nexio_get_custom_layout_meta( $nexio_blog_id );
$nexio_custom_style  = ! empty( $nexio_blog_meta['scripts_required'] ) ? $nexio_blog_meta['scripts_required'] : 'none';

if ( ! empty( $nexio_template_args['slider'] ) || $nexio_columns > 1 || ! nexio_is_off( $nexio_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $nexio_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( ( nexio_is_off( $nexio_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $nexio_custom_style ) ) . "-1_{$nexio_columns}" );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $nexio_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $nexio_columns )
					. ' post_layout_' . esc_attr( $nexio_blog_style[0] )
					. ' post_layout_' . esc_attr( $nexio_blog_style[0] ) . '_' . esc_attr( $nexio_columns )
					. ( ! nexio_is_off( $nexio_custom_style )
						? ' post_layout_' . esc_attr( $nexio_custom_style )
							. ' post_layout_' . esc_attr( $nexio_custom_style ) . '_' . esc_attr( $nexio_columns )
						: ''
						)
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
	// Custom layout
	do_action( 'nexio_action_show_layout', $nexio_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $nexio_template_args['slider'] ) || $nexio_columns > 1 || ! nexio_is_off( $nexio_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
