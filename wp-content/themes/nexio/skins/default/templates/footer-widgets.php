<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package NEXIO
 * @since NEXIO 1.0.10
 */

// Footer sidebar
$nexio_footer_name    = nexio_get_theme_option( 'footer_widgets' );
$nexio_footer_present = ! nexio_is_off( $nexio_footer_name ) && is_active_sidebar( $nexio_footer_name );
if ( $nexio_footer_present ) {
	nexio_storage_set( 'current_sidebar', 'footer' );
	$nexio_footer_wide = nexio_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $nexio_footer_name ) ) {
		dynamic_sidebar( $nexio_footer_name );
	}
	$nexio_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $nexio_out ) ) {
		$nexio_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $nexio_out );
		$nexio_need_columns = true;   //or check: strpos($nexio_out, 'columns_wrap')===false;
		if ( $nexio_need_columns ) {
			$nexio_columns = max( 0, (int) nexio_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $nexio_columns ) {
				$nexio_columns = min( 4, max( 1, nexio_tags_count( $nexio_out, 'aside' ) ) );
			}
			if ( $nexio_columns > 1 ) {
				$nexio_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $nexio_columns ) . ' widget', $nexio_out );
			} else {
				$nexio_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $nexio_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'nexio_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $nexio_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $nexio_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'nexio_action_before_sidebar', 'footer' );
				nexio_show_layout( $nexio_out );
				do_action( 'nexio_action_after_sidebar', 'footer' );
				if ( $nexio_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $nexio_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'nexio_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
