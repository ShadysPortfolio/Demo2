<?php
/**
 * The template to display Admin notices
 *
 * @package NEXIO
 * @since NEXIO 1.98.0
 */

$nexio_skins_url   = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$nexio_active_skin = nexio_skins_get_active_skin_name();
?>
<div class="nexio_admin_notice nexio_skins_notice notice notice-error">
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
		<?php esc_html_e( 'Active skin is missing!', 'nexio' ); ?>
	</h3>
	<div class="nexio_notice_text">
		<p>
			<?php
			// Translators: Add a current skin name to the message
			echo wp_kses_data( sprintf( __( "Your active skin <b>'%s'</b> is missing. Usually this happens when the theme is updated directly through the server or FTP.", 'nexio' ), ucfirst( $nexio_active_skin ) ) );
			?>
		</p>
		<p>
			<?php
			echo wp_kses_data( __( "Please use only <b>'ThemeREX Updater v.1.6.0+'</b> plugin for your future updates.", 'nexio' ) );
			?>
		</p>
		<p>
			<?php
			echo wp_kses_data( __( "But no worries! You can re-download the skin via 'Skins Manager' ( Theme Panel - Theme Dashboard - Skins ).", 'nexio' ) );
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
