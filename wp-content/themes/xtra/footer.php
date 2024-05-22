<?php 
	$footer = ( is_singular() || is_404() ) ? !Codevz::meta( Codevz::option( '404' ), 0, 'hide_footer' ) : 1;

	if ( $footer ) {
		echo '<footer class="page_footer' . esc_attr( Codevz::option( 'fixed_footer' ) ? ' cz_fixed_footer' : '' ) . '">';

		// Row before footer
		Codevz::row(array(
			'id'		=> 'footer_',
			'nums'		=> array('1'),
			'row'		=> 1,
			'left'		=> '_left',
			'right'		=> '_right',
			'center'	=> '_center'
		));

		// Footer widgets
		$footer_layout = Codevz::option( 'footer_layout' );
		if ( $footer_layout ) {
			$layout = explode( ',', $footer_layout );
			$count = count( $layout );
			echo '<div class="cz_middle_footer"><div class="row clr">';
			foreach ( $layout as $num => $col ) {
				echo '<div class="col ' . esc_attr( $col ) . ' sidebar_footer-' . esc_attr( ++$num ) . ' clr">';
				if ( is_active_sidebar( 'footer-' . $num ) ) {
					dynamic_sidebar( 'footer-' . $num );  
				}
				echo '</div>';
			}
			echo '</div></div>';
		}

		// Row after footer
		Codevz::row(array(
			'id'		=> 'footer_',
			'nums'		=> array('2'),
			'row'		=> 1,
			'left'		=> '_left',
			'right'		=> '_right',
			'center'	=> '_center'
		));

		echo '</footer>';
	}

	echo '</div></div>'; // layout

	// Back to top & contact
	echo Codevz::option( 'backtotop' ) ? '<i class="' . esc_attr( Codevz::option( 'backtotop' ) ) . ' backtotop"></i>' : '';
	$cf7 = Codevz::option( 'cf7_beside_backtotop' );
	if ( $cf7 ) {
		echo '<i class="' . esc_attr( Codevz::option( 'cf7_beside_backtotop_icon', 'fa fa-envelope-o' ) ) . ' fixed_contact"></i>';
		echo '<div class="fixed_contact">' . Codevz::get_page_as_element( esc_html( $cf7 ) ) . '</div>';
	}

	// Popup
	echo Codevz::get_page_as_element( esc_html( Codevz::option( 'popup' ) ) );

	// Ajax music player
	if ( Codevz::option( 'ajax' ) && Codevz::option( 'ajax_mp' ) ) {
		$ajax_tracks = urlencode( json_encode( Codevz::option( 'ajax_mp_tracks', array() ) ) );
		echo do_shortcode( '[cz_music_player id="cz_ajax_mp" fixed="true" dark_text="' . Codevz::option( 'ajax_mp_dark_text' ) . '" flat="' . Codevz::option( 'ajax_mp_flat' ) . '" autoplay="' . Codevz::option( 'ajax_mp_autoplay' ) . '" tracks="' . $ajax_tracks . '"]' );
	}

	// Support Purpose
	if ( isset( $_GET['codevz'] ) && $_GET['codevz'] === '1' ) {
		$theme = wp_get_theme();
		$themev = $theme->Version;
		if ( is_child_theme() ) {
			$theme = wp_get_theme( $theme->Template );
			$themev = $theme->Version;
		}
		$wp_version = get_bloginfo( 'version' );
		$memory_limit = ini_get( 'memory_limit' );
		$memory_get_usage = @number_format_i18n( memory_get_usage() );
		$memory_get_peak_usage = @number_format_i18n( memory_get_peak_usage() );
		$wp_upload_dir = wp_upload_dir();

		$array = array(
			array( 'WordPress', $wp_version ),
			array( 'Theme: ' . $theme->Name, $themev ),
			array( 'Language', get_locale() ),
			array( 'Multisite', is_multisite() ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>' ),
			array( 'WP_DEBUG', WP_DEBUG ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>' ),
			array( 'PHP Version', phpversion() ),
			array( 'Server Software', $_SERVER["SERVER_SOFTWARE"] ),
			array( 'Post Max Size', ini_get( 'post_max_size' ) ),
			array( 'Upload Max Size', ini_get( 'upload_max_filesize' ) ),
			array( 'Max Execution Time', ini_get( 'max_execution_time' ) ),
			array( 'Memory Limit', $memory_limit ),
			array( 'memory_get_usage()', $memory_get_usage . ' bytes' ),
			array( 'memory_get_peak_usage()', $memory_get_peak_usage . ' bytes' ),
			array( 'GZip', is_callable( 'gzopen' ) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>' ),
			array( 'Writable', is_writable( $wp_upload_dir['basedir'] ) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>' ),
		);

		// Server
		echo '<div class="codevz_support">';
		echo '<table class="codevz_info" border="1"><tr><th>Title</th><th>Status</th></tr>';
		foreach ( $array as $key ) {
			echo '<tr>';
			echo '<td>' . $key[0] . '</td>';
			echo '<td>' . $key[1] . '</td>';
			echo '</tr>';
		}
		echo '</table>';

		// Plugins
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		echo '<table class="codevz_plugins" border="1"><tr><th>Plugin</th><th>Version</th></tr>';
		foreach ( (array) get_plugins() as $plugin => $info ) {
			echo '<tr>';
			echo '<td>' . $info['Name'];
			echo is_plugin_active( $plugin ) ? '<td class="good">' . $info['Version'] . '</td>' : '<td>' . $info['Version'] . '</td>';
			echo '</tr>';
		}
		echo '</table>';

		// Options
		$options = Codevz::option();
		if ( ! empty( $options ) ) {
			echo '<table style="margin: 50px 0 50px 4% !important" border="1"><tr><th>Option</th><th>Value</th></tr>';
			foreach ( $options as $k => $v ) {
				if ( ! empty( $v ) ) {
					echo '<tr>';
					echo '<td>' . $k . '</td>';
					echo '<td>' . ( is_array( $v ) ? serialize( $v ) : $v ) . '</td>';
					echo '</tr>';
				}
				
			}
			echo '</table>';
		}

		echo '</div>';
	}
?>
<div class="cz_fixed_top_border"></div>
<div class="cz_fixed_bottom_border"></div>

<?php wp_footer(); ?>
</body>
</html>