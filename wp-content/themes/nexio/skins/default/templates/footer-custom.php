<?php
/**
 * The template to display default site footer
 *
 * @package NEXIO
 * @since NEXIO 1.0.10
 */

$nexio_footer_id = nexio_get_custom_footer_id();
$nexio_footer_meta = get_post_meta( $nexio_footer_id, 'trx_addons_options', true );
if ( ! empty( $nexio_footer_meta['margin'] ) ) {
	nexio_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( nexio_prepare_css_value( $nexio_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $nexio_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $nexio_footer_id ) ) ); ?>
						<?php
						$nexio_footer_scheme = nexio_get_theme_option( 'footer_scheme' );
						if ( ! empty( $nexio_footer_scheme ) && ! nexio_is_inherit( $nexio_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $nexio_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'nexio_action_show_layout', $nexio_footer_id );
	?>
</footer><!-- /.footer_wrap -->
