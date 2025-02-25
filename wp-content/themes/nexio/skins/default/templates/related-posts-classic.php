<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package NEXIO
 * @since NEXIO 1.0
 */

$nexio_link        = get_permalink();
$nexio_post_format = get_post_format();
$nexio_post_format = empty( $nexio_post_format ) ? 'standard' : str_replace( 'post-format-', '', $nexio_post_format );
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item post_format_' . esc_attr( $nexio_post_format ) ); ?> data-post-id="<?php the_ID(); ?>">
	<?php
	nexio_show_post_featured(
		array(
			'thumb_ratio'   => '300:223',
			'thumb_size'    => apply_filters( 'nexio_filter_related_thumb_size', nexio_get_thumb_size( (int) nexio_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'square' ) ),
		)
	);
	?>
	<div class="post_header entry-header">
		<?php
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {

			nexio_show_post_meta(
				array(
					'components' => 'categories',
					'class'      => 'post_meta_categories',
				)
			);

		}
		?>
		<h6 class="post_title entry-title"><a href="<?php echo esc_url( $nexio_link ); ?>"><?php
			if ( '' == get_the_title() ) {
				esc_html_e( '- No title -', 'nexio' );
			} else {
				the_title();
			}
		?></a></h6>
	</div>
</div>
