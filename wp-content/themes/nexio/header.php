<?php
/**
 * The Header: Logo and main menu
 *
 * @package NEXIO
 * @since NEXIO 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( nexio_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'nexio_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'nexio_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('nexio_action_body_wrap_attributes'); ?>>

		<?php do_action( 'nexio_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'nexio_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('nexio_action_page_wrap_attributes'); ?>>

			<?php do_action( 'nexio_action_page_wrap_start' ); ?>

			<?php
			$nexio_full_post_loading = ( nexio_is_singular( 'post' ) || nexio_is_singular( 'attachment' ) ) && nexio_get_value_gp( 'action' ) == 'full_post_loading';
			$nexio_prev_post_loading = ( nexio_is_singular( 'post' ) || nexio_is_singular( 'attachment' ) ) && nexio_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $nexio_full_post_loading && ! $nexio_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="nexio_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'nexio_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to content", 'nexio' ); ?></a>
				<?php if ( nexio_sidebar_present() ) { ?>
				<a class="nexio_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'nexio_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to sidebar", 'nexio' ); ?></a>
				<?php } ?>
				<a class="nexio_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'nexio_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to footer", 'nexio' ); ?></a>

				<?php
				do_action( 'nexio_action_before_header' );

				// Header
				$nexio_header_type = nexio_get_theme_option( 'header_type' );
				if ( 'custom' == $nexio_header_type && ! nexio_is_layouts_available() ) {
					$nexio_header_type = 'default';
				}
				get_template_part( apply_filters( 'nexio_filter_get_template_part', "templates/header-" . sanitize_file_name( $nexio_header_type ) ) );

				// Side menu
				if ( in_array( nexio_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'nexio_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'nexio_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'nexio_action_after_header' );

			}
			?>

			<?php do_action( 'nexio_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( nexio_is_off( nexio_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $nexio_header_type ) ) {
						$nexio_header_type = nexio_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $nexio_header_type && nexio_is_layouts_available() ) {
						$nexio_header_id = nexio_get_custom_header_id();
						if ( $nexio_header_id > 0 ) {
							$nexio_header_meta = nexio_get_custom_layout_meta( $nexio_header_id );
							if ( ! empty( $nexio_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$nexio_footer_type = nexio_get_theme_option( 'footer_type' );
					if ( 'custom' == $nexio_footer_type && nexio_is_layouts_available() ) {
						$nexio_footer_id = nexio_get_custom_footer_id();
						if ( $nexio_footer_id ) {
							$nexio_footer_meta = nexio_get_custom_layout_meta( $nexio_footer_id );
							if ( ! empty( $nexio_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'nexio_action_page_content_wrap_class', $nexio_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'nexio_filter_is_prev_post_loading', $nexio_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( nexio_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'nexio_action_page_content_wrap_data', $nexio_prev_post_loading );
			?>>
				<?php
				do_action( 'nexio_action_page_content_wrap', $nexio_full_post_loading || $nexio_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'nexio_filter_single_post_header', nexio_is_singular( 'post' ) || nexio_is_singular( 'attachment' ) ) ) {
					if ( $nexio_prev_post_loading ) {
						if ( nexio_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'nexio_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$nexio_path = apply_filters( 'nexio_filter_get_template_part', 'templates/single-styles/' . nexio_get_theme_option( 'single_style' ) );
					if ( nexio_get_file_dir( $nexio_path . '.php' ) != '' ) {
						get_template_part( $nexio_path );
					}
				}

				// Widgets area above page
				$nexio_body_style   = nexio_get_theme_option( 'body_style' );
				$nexio_widgets_name = nexio_get_theme_option( 'widgets_above_page' );
				$nexio_show_widgets = ! nexio_is_off( $nexio_widgets_name ) && is_active_sidebar( $nexio_widgets_name );
				if ( $nexio_show_widgets ) {
					if ( 'fullscreen' != $nexio_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					nexio_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $nexio_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'nexio_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $nexio_body_style ? '_fullscreen' : ''; ?>">

					<?php do_action( 'nexio_action_content_wrap_start' ); ?>

					<div class="content">
						<?php
						do_action( 'nexio_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="nexio_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( nexio_is_singular( 'post' ) || nexio_is_singular( 'attachment' ) )
							&& $nexio_prev_post_loading 
							&& nexio_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'nexio_action_between_posts' );
						}

						// Widgets area above content
						nexio_create_widgets_area( 'widgets_above_content' );

						do_action( 'nexio_action_page_content_start_text' );
