<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package NEXIO
 * @since NEXIO 1.0.06
 */

$nexio_header_css   = '';
$nexio_header_image = get_header_image();
$nexio_header_video = nexio_get_header_video();
if ( ! empty( $nexio_header_image ) && nexio_trx_addons_featured_image_override( is_singular() || nexio_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$nexio_header_image = nexio_get_current_mode_image( $nexio_header_image );
}

$nexio_header_id = nexio_get_custom_header_id();
$nexio_header_meta = get_post_meta( $nexio_header_id, 'trx_addons_options', true );
if ( ! empty( $nexio_header_meta['margin'] ) ) {
	nexio_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( nexio_prepare_css_value( $nexio_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $nexio_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $nexio_header_id ) ) ); ?>
				<?php
				echo ! empty( $nexio_header_image ) || ! empty( $nexio_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
				if ( '' != $nexio_header_video ) {
					echo ' with_bg_video';
				}
				if ( '' != $nexio_header_image ) {
					echo ' ' . esc_attr( nexio_add_inline_css_class( 'background-image: url(' . esc_url( $nexio_header_image ) . ');' ) );
				}
				if ( is_single() && has_post_thumbnail() ) {
					echo ' with_featured_image';
				}
				if ( nexio_is_on( nexio_get_theme_option( 'header_fullheight' ) ) ) {
					echo ' header_fullheight nexio-full-height';
				}
				$nexio_header_scheme = nexio_get_theme_option( 'header_scheme' );
				if ( ! empty( $nexio_header_scheme ) && ! nexio_is_inherit( $nexio_header_scheme  ) ) {
					echo ' scheme_' . esc_attr( $nexio_header_scheme );
				}
				?>
">
	<?php

	// Background video
	if ( ! empty( $nexio_header_video ) ) {
		get_template_part( apply_filters( 'nexio_filter_get_template_part', 'templates/header-video' ) );
	}

	// Custom header's layout
	do_action( 'nexio_action_show_layout', $nexio_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'nexio_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
