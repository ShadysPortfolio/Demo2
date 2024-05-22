<?php
/**
 * The template to display Admin notices
 *
 * @package NEXIO
 * @since NEXIO 1.0.64
 */

$nexio_skins_url  = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$nexio_skins_args = get_query_var( 'nexio_skins_notice_args' );
?>
<div class="nexio_admin_notice nexio_skins_notice notice notice-info is-dismissible" data-notice="skins">
	<?php
	// Theme image
	$nexio_theme_img = nexio_get_file_url( 'screenshot.jpg' );
	if ( '' != $nexio_theme_img ) {
		?>
		<div class="nexio_notice_image"><img src="<?php echo esc_url( $nexio_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'nexio' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="nexio_notice_title">
		<?php esc_html_e( 'New skins available', 'nexio' ); ?>
	</h3>
	<?php

	// Description
	$nexio_total      = $nexio_skins_args['update'];	// Store value to the separate variable to avoid warnings from ThemeCheck plugin!
	$nexio_skins_msg  = $nexio_total > 0
							// Translators: Add new skins number
							? '<strong>' . sprintf( _n( '%d new version', '%d new versions', $nexio_total, 'nexio' ), $nexio_total ) . '</strong>'
							: '';
	$nexio_total      = $nexio_skins_args['free'];
	$nexio_skins_msg .= $nexio_total > 0
							? ( ! empty( $nexio_skins_msg ) ? ' ' . esc_html__( 'and', 'nexio' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d free skin', '%d free skins', $nexio_total, 'nexio' ), $nexio_total ) . '</strong>'
							: '';
	$nexio_total      = $nexio_skins_args['pay'];
	$nexio_skins_msg .= $nexio_skins_args['pay'] > 0
							? ( ! empty( $nexio_skins_msg ) ? ' ' . esc_html__( 'and', 'nexio' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d paid skin', '%d paid skins', $nexio_total, 'nexio' ), $nexio_total ) . '</strong>'
							: '';
	?>
	<div class="nexio_notice_text">
		<p>
			<?php
			// Translators: Add new skins info
			echo wp_kses_data( sprintf( __( "We are pleased to announce that %s are available for your theme", 'nexio' ), $nexio_skins_msg ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="nexio_notice_buttons">
		<?php
		// Link to the theme dashboard page
		?>
		<a href="<?php echo esc_url( $nexio_skins_url ); ?>" class="button button-primary"><i class="dashicons dashicons-update"></i> 
			<?php
			// Translators: Add theme name
			esc_html_e( 'Go to Skins manager', 'nexio' );
			?>
		</a>
	</div>
</div>
