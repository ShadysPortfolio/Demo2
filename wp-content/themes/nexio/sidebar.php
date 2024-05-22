<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package NEXIO
 * @since NEXIO 1.0
 */

if ( nexio_sidebar_present() ) {
	
	$nexio_sidebar_type = nexio_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $nexio_sidebar_type && ! nexio_is_layouts_available() ) {
		$nexio_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $nexio_sidebar_type ) {
		// Default sidebar with widgets
		$nexio_sidebar_name = nexio_get_theme_option( 'sidebar_widgets' );
		nexio_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $nexio_sidebar_name ) ) {
			dynamic_sidebar( $nexio_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$nexio_sidebar_id = nexio_get_custom_sidebar_id();
		do_action( 'nexio_action_show_layout', $nexio_sidebar_id );
	}
	$nexio_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $nexio_out ) ) {
		$nexio_sidebar_position    = nexio_get_theme_option( 'sidebar_position' );
		$nexio_sidebar_position_ss = nexio_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $nexio_sidebar_position );
			echo ' sidebar_' . esc_attr( $nexio_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $nexio_sidebar_type );

			$nexio_sidebar_scheme = apply_filters( 'nexio_filter_sidebar_scheme', nexio_get_theme_option( 'sidebar_scheme' ) );
			if ( ! empty( $nexio_sidebar_scheme ) && ! nexio_is_inherit( $nexio_sidebar_scheme ) && 'custom' != $nexio_sidebar_type ) {
				echo ' scheme_' . esc_attr( $nexio_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="nexio_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'nexio_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $nexio_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$nexio_title = apply_filters( 'nexio_filter_sidebar_control_title', 'float' == $nexio_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'nexio' ) : '' );
				$nexio_text  = apply_filters( 'nexio_filter_sidebar_control_text', 'above' == $nexio_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'nexio' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $nexio_title ); ?>"><?php echo esc_html( $nexio_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'nexio_action_before_sidebar', 'sidebar' );
				nexio_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $nexio_out ) );
				do_action( 'nexio_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'nexio_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
