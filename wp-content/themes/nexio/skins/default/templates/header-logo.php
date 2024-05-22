<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package NEXIO
 * @since NEXIO 1.0
 */

$nexio_args = get_query_var( 'nexio_logo_args' );

// Site logo
$nexio_logo_type   = isset( $nexio_args['type'] ) ? $nexio_args['type'] : '';
$nexio_logo_image  = nexio_get_logo_image( $nexio_logo_type );
$nexio_logo_text   = nexio_is_on( nexio_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$nexio_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $nexio_logo_image['logo'] ) || ! empty( $nexio_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $nexio_logo_image['logo'] ) ) {
			if ( empty( $nexio_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric($nexio_logo_image['logo']) && (int) $nexio_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$nexio_attr = nexio_getimagesize( $nexio_logo_image['logo'] );
				echo '<img src="' . esc_url( $nexio_logo_image['logo'] ) . '"'
						. ( ! empty( $nexio_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $nexio_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $nexio_logo_text ) . '"'
						. ( ! empty( $nexio_attr[3] ) ? ' ' . wp_kses_data( $nexio_attr[3] ) : '' )
						. '>';
			}
		} else {
			nexio_show_layout( nexio_prepare_macros( $nexio_logo_text ), '<span class="logo_text">', '</span>' );
			nexio_show_layout( nexio_prepare_macros( $nexio_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
