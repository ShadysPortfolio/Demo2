<div class="front_page_section front_page_section_about<?php
	$nexio_scheme = nexio_get_theme_option( 'front_page_about_scheme' );
	if ( ! empty( $nexio_scheme ) && ! nexio_is_inherit( $nexio_scheme ) ) {
		echo ' scheme_' . esc_attr( $nexio_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( nexio_get_theme_option( 'front_page_about_paddings' ) );
	if ( nexio_get_theme_option( 'front_page_about_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$nexio_css      = '';
		$nexio_bg_image = nexio_get_theme_option( 'front_page_about_bg_image' );
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
	$nexio_anchor_icon = nexio_get_theme_option( 'front_page_about_anchor_icon' );
	$nexio_anchor_text = nexio_get_theme_option( 'front_page_about_anchor_text' );
if ( ( ! empty( $nexio_anchor_icon ) || ! empty( $nexio_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_about"'
									. ( ! empty( $nexio_anchor_icon ) ? ' icon="' . esc_attr( $nexio_anchor_icon ) . '"' : '' )
									. ( ! empty( $nexio_anchor_text ) ? ' title="' . esc_attr( $nexio_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_about_inner
	<?php
	if ( nexio_get_theme_option( 'front_page_about_fullheight' ) ) {
		echo ' nexio-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$nexio_css           = '';
			$nexio_bg_mask       = nexio_get_theme_option( 'front_page_about_bg_mask' );
			$nexio_bg_color_type = nexio_get_theme_option( 'front_page_about_bg_color_type' );
			if ( 'custom' == $nexio_bg_color_type ) {
				$nexio_bg_color = nexio_get_theme_option( 'front_page_about_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$nexio_caption = nexio_get_theme_option( 'front_page_about_caption' );
			if ( ! empty( $nexio_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo ! empty( $nexio_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $nexio_caption, 'nexio_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$nexio_description = nexio_get_theme_option( 'front_page_about_description' );
			if ( ! empty( $nexio_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo ! empty( $nexio_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $nexio_description ), 'nexio_kses_content' ); ?></div>
				<?php
			}

			// Content
			$nexio_content = nexio_get_theme_option( 'front_page_about_content' );
			if ( ! empty( $nexio_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo ! empty( $nexio_content ) ? 'filled' : 'empty'; ?>">
					<?php
					$nexio_page_content_mask = '%%CONTENT%%';
					if ( strpos( $nexio_content, $nexio_page_content_mask ) !== false ) {
						$nexio_content = preg_replace(
							'/(\<p\>\s*)?' . $nexio_page_content_mask . '(\s*\<\/p\>)/i',
							sprintf(
								'<div class="front_page_section_about_source">%s</div>',
								apply_filters( 'the_content', get_the_content() )
							),
							$nexio_content
						);
					}
					nexio_show_layout( $nexio_content );
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
