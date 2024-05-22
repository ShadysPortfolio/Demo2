<?php
/**
 * The template to display the background video in the header
 *
 * @package NEXIO
 * @since NEXIO 1.0.14
 */
$nexio_header_video = nexio_get_header_video();
$nexio_embed_video  = '';
if ( ! empty( $nexio_header_video ) && ! nexio_is_from_uploads( $nexio_header_video ) ) {
	if ( nexio_is_youtube_url( $nexio_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $nexio_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php nexio_show_layout( nexio_get_embed_video( $nexio_header_video ) ); ?></div>
		<?php
	}
}
