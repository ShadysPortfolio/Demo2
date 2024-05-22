<div class="front_page_section front_page_section_googlemap<?php
	$nexio_scheme = nexio_get_theme_option( 'front_page_googlemap_scheme' );
	if ( ! empty( $nexio_scheme ) && ! nexio_is_inherit( $nexio_scheme ) ) {
		echo ' scheme_' . esc_attr( $nexio_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( nexio_get_theme_option( 'front_page_googlemap_paddings' ) );
	if ( nexio_get_theme_option( 'front_page_googlemap_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$nexio_css      = '';
		$nexio_bg_image = nexio_get_theme_option( 'front_page_googlemap_bg_image' );
		if ( ! empty( $nexio_bg_image ) ) {
			$nexio_css .= 'background-image: url(' . esc_url( nexio_get_attachment_url( $nexio_bg_image ) ) . ');';
		}
		if ( ! empty( $nexio_css ) ) {
			echo ' style="' . esc_attr( $nexio_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$nexio_anchor_icon = nexio_get_theme_option( 'front_page_googlemap_anchor_icon' );
	$nexio_anchor_text = nexio_get_theme_option( 'front_page_googlemap_anchor_text' );
if ( ( ! empty( $nexio_anchor_icon ) || ! empty( $nexio_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_googlemap"'
									. ( ! empty( $nexio_anchor_icon ) ? ' icon="' . esc_attr( $nexio_anchor_icon ) . '"' : '' )
									. ( ! empty( $nexio_anchor_text ) ? ' title="' . esc_attr( $nexio_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_googlemap_inner
		<?php
		$nexio_layout = nexio_get_theme_option( 'front_page_googlemap_layout' );
		echo ' front_page_section_layout_' . esc_attr( $nexio_layout );
		if ( nexio_get_theme_option( 'front_page_googlemap_fullheight' ) ) {
			echo ' nexio-full-height sc_layouts_flex sc_layouts_columns_middle';
		}
		?>
		"
			<?php
			$nexio_css      = '';
			$nexio_bg_mask  = nexio_get_theme_option( 'front_page_googlemap_bg_mask' );
			$nexio_bg_color_type = nexio_get_theme_option( 'front_page_googlemap_bg_color_type' );
			if ( 'custom' == $nexio_bg_color_type ) {
				$nexio_bg_color = nexio_get_theme_option( 'front_page_googlemap_bg_color' );
			} elseif ( 'scheme_bg_color' == $nexio_bg_color_type ) {
				$nexio_bg_color = nexio_get_scheme_color( 'bg_color', $nexio_scheme );
			} else {
				$nexio_bg_color = '';
			}
			if ( ! empty( $nexio_bg_color ) && $nexio_bg_mask > 0 ) {
				$nexio_css .= 'background-color: ' . esc_attr(
					1 == $nexio_bg_mask ? $nexio_bg_color : nexio_hex2rgba( $nexio_bg_color, $nexio_bg_mask )
				) . ';';
			}
			if ( ! empty( $nexio_css ) ) {
				echo ' style="' . esc_attr( $nexio_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap
		<?php
		if ( 'fullwidth' != $nexio_layout ) {
			echo ' content_wrap';
		}
		?>
		">
			<?php
			// Content wrap with title and description
			$nexio_caption     = nexio_get_theme_option( 'front_page_googlemap_caption' );
			$nexio_description = nexio_get_theme_option( 'front_page_googlemap_description' );
			if ( ! empty( $nexio_caption ) || ! empty( $nexio_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'fullwidth' == $nexio_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}
					// Caption
				if ( ! empty( $nexio_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo ! empty( $nexio_caption ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $nexio_caption, 'nexio_kses_content' );
					?>
					</h2>
					<?php
				}

					// Description (text)
				if ( ! empty( $nexio_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo ! empty( $nexio_description ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( wpautop( $nexio_description ), 'nexio_kses_content' );
					?>
					</div>
					<?php
				}
				if ( 'fullwidth' == $nexio_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$nexio_content = nexio_get_theme_option( 'front_page_googlemap_content' );
			if ( ! empty( $nexio_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'columns' == $nexio_layout ) {
					?>
					<div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} elseif ( 'fullwidth' == $nexio_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}

				?>
				<div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo ! empty( $nexio_content ) ? 'filled' : 'empty'; ?>">
				<?php
					echo wp_kses( $nexio_content, 'nexio_kses_content' );
				?>
				</div>
				<?php

				if ( 'columns' == $nexio_layout ) {
					?>
					</div><div class="column-2_3">
					<?php
				} elseif ( 'fullwidth' == $nexio_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Widgets output
			?>
			<div class="front_page_section_output front_page_section_googlemap_output">
				<?php
				if ( is_active_sidebar( 'front_page_googlemap_widgets' ) ) {
					dynamic_sidebar( 'front_page_googlemap_widgets' );
				} elseif ( current_user_can( 'edit_theme_options' ) ) {
					if ( ! nexio_exists_trx_addons() ) {
						nexio_customizer_need_trx_addons_message();
					} else {
						nexio_customizer_need_widgets_message( 'front_page_googlemap_caption', 'ThemeREX Addons - Google map' );
					}
				}
				?>
			</div>
			<?php

			if ( 'columns' == $nexio_layout && ( ! empty( $nexio_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>
		</div>
	</div>
</div>
