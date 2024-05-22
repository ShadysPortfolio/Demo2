<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package NEXIO
 * @since NEXIO 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$nexio_copyright_scheme = nexio_get_theme_option( 'copyright_scheme' );
if ( ! empty( $nexio_copyright_scheme ) && ! nexio_is_inherit( $nexio_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $nexio_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$nexio_copyright = nexio_get_theme_option( 'copyright' );
			if ( ! empty( $nexio_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$nexio_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $nexio_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$nexio_copyright = nexio_prepare_macros( $nexio_copyright );
				// Display copyright
				echo wp_kses( nl2br( $nexio_copyright ), 'nexio_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
