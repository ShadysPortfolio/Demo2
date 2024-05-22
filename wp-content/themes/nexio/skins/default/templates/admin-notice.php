<?php
/**
 * The template to display Admin notices
 *
 * @package NEXIO
 * @since NEXIO 1.0.1
 */

$nexio_theme_slug = get_option( 'template' );
$nexio_theme_obj  = wp_get_theme( $nexio_theme_slug );
?>
<div class="nexio_admin_notice nexio_welcome_notice notice notice-info is-dismissible" data-notice="admin">
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
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'nexio' ),
				$nexio_theme_obj->get( 'Name' ) . ( NEXIO_THEME_FREE ? ' ' . __( 'Free', 'nexio' ) : '' ),
				$nexio_theme_obj->get( 'Version' )
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="nexio_notice_text">
		<p class="nexio_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $nexio_theme_obj->description ) );
			?>
		</p>
		<p class="nexio_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'nexio' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="nexio_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=nexio_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'nexio' );
			?>
		</a>
	</div>
</div>
