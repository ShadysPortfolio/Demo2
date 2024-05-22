<?php
/**
 * The template to display the site logo in the footer
 *
 * @package NEXIO
 * @since NEXIO 1.0.10
 */

// Logo
if ( nexio_is_on( nexio_get_theme_option( 'logo_in_footer' ) ) ) {
	$nexio_logo_image = nexio_get_logo_image( 'footer' );
	$nexio_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $nexio_logo_image['logo'] ) || ! empty( $nexio_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $nexio_logo_image['logo'] ) ) {
					$nexio_attr = nexio_getimagesize( $nexio_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $nexio_logo_image['logo'] ) . '"'
								. ( ! empty( $nexio_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $nexio_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'nexio' ) . '"'
								. ( ! empty( $nexio_attr[3] ) ? ' ' . wp_kses_data( $nexio_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $nexio_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $nexio_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
