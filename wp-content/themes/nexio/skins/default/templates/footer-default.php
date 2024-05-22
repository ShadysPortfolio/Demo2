<?php
/**
 * The template to display default site footer
 *
 * @package NEXIO
 * @since NEXIO 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$nexio_footer_scheme = nexio_get_theme_option( 'footer_scheme' );
if ( ! empty( $nexio_footer_scheme ) && ! nexio_is_inherit( $nexio_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $nexio_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'nexio_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'nexio_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'nexio_filter_get_template_part', 'templates/footer-socials' ) );

	// Copyright area
	get_template_part( apply_filters( 'nexio_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
