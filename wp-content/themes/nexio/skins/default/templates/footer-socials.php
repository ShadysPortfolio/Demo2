<?php
/**
 * The template to display the socials in the footer
 *
 * @package NEXIO
 * @since NEXIO 1.0.10
 */


// Socials
if ( nexio_is_on( nexio_get_theme_option( 'socials_in_footer' ) ) ) {
	$nexio_output = nexio_get_socials_links();
	if ( '' != $nexio_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php nexio_show_layout( $nexio_output ); ?>
			</div>
		</div>
		<?php
	}
}
