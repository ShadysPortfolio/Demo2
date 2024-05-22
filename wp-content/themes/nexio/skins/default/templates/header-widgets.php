<?php
/**
 * The template to display the widgets area in the header
 *
 * @package NEXIO
 * @since NEXIO 1.0
 */

// Header sidebar
$nexio_header_name    = nexio_get_theme_option( 'header_widgets' );
$nexio_header_present = ! nexio_is_off( $nexio_header_name ) && is_active_sidebar( $nexio_header_name );
if ( $nexio_header_present ) {
	nexio_storage_set( 'current_sidebar', 'header' );
	$nexio_header_wide = nexio_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $nexio_header_name ) ) {
		dynamic_sidebar( $nexio_header_name );
	}
	$nexio_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $nexio_widgets_output ) ) {
		$nexio_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $nexio_widgets_output );
		$nexio_need_columns   = strpos( $nexio_widgets_output, 'columns_wrap' ) === false;
		if ( $nexio_need_columns ) {
			$nexio_columns = max( 0, (int) nexio_get_theme_option( 'header_columns' ) );
			if ( 0 == $nexio_columns ) {
				$nexio_columns = min( 6, max( 1, nexio_tags_count( $nexio_widgets_output, 'aside' ) ) );
			}
			if ( $nexio_columns > 1 ) {
				$nexio_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $nexio_columns ) . ' widget', $nexio_widgets_output );
			} else {
				$nexio_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $nexio_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'nexio_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $nexio_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $nexio_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'nexio_action_before_sidebar', 'header' );
				nexio_show_layout( $nexio_widgets_output );
				do_action( 'nexio_action_after_sidebar', 'header' );
				if ( $nexio_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $nexio_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'nexio_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
