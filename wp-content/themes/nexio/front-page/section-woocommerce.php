<?php
$nexio_woocommerce_sc = nexio_get_theme_option( 'front_page_woocommerce_products' );
if ( ! empty( $nexio_woocommerce_sc ) ) {
	?><div class="front_page_section front_page_section_woocommerce<?php
		$nexio_scheme = nexio_get_theme_option( 'front_page_woocommerce_scheme' );
		if ( ! empty( $nexio_scheme ) && ! nexio_is_inherit( $nexio_scheme ) ) {
			echo ' scheme_' . esc_attr( $nexio_scheme );
		}
		echo ' front_page_section_paddings_' . esc_attr( nexio_get_theme_option( 'front_page_woocommerce_paddings' ) );
		if ( nexio_get_theme_option( 'front_page_woocommerce_stack' ) ) {
			echo ' sc_stack_section_on';
		}
	?>"
			<?php
			$nexio_css      = '';
			$nexio_bg_image = nexio_get_theme_option( 'front_page_woocommerce_bg_image' );
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
		$nexio_anchor_icon = nexio_get_theme_option( 'front_page_woocommerce_anchor_icon' );
		$nexio_anchor_text = nexio_get_theme_option( 'front_page_woocommerce_anchor_text' );
		if ( ( ! empty( $nexio_anchor_icon ) || ! empty( $nexio_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
			echo do_shortcode(
				'[trx_sc_anchor id="front_page_section_woocommerce"'
											. ( ! empty( $nexio_anchor_icon ) ? ' icon="' . esc_attr( $nexio_anchor_icon ) . '"' : '' )
											. ( ! empty( $nexio_anchor_text ) ? ' title="' . esc_attr( $nexio_anchor_text ) . '"' : '' )
											. ']'
			);
		}
	?>
		<div class="front_page_section_inner front_page_section_woocommerce_inner
			<?php
			if ( nexio_get_theme_option( 'front_page_woocommerce_fullheight' ) ) {
				echo ' nexio-full-height sc_layouts_flex sc_layouts_columns_middle';
			}
			?>
				"
				<?php
				$nexio_css      = '';
				$nexio_bg_mask  = nexio_get_theme_option( 'front_page_woocommerce_bg_mask' );
				$nexio_bg_color_type = nexio_get_theme_option( 'front_page_woocommerce_bg_color_type' );
				if ( 'custom' == $nexio_bg_color_type ) {
					$nexio_bg_color = nexio_get_theme_option( 'front_page_woocommerce_bg_color' );
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
			<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
				<?php
				// Content wrap with title and description
				$nexio_caption     = nexio_get_theme_option( 'front_page_woocommerce_caption' );
				$nexio_description = nexio_get_theme_option( 'front_page_woocommerce_description' );
				if ( ! empty( $nexio_caption ) || ! empty( $nexio_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					// Caption
					if ( ! empty( $nexio_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo ! empty( $nexio_caption ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( $nexio_caption, 'nexio_kses_content' );
						?>
						</h2>
						<?php
					}

					// Description (text)
					if ( ! empty( $nexio_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo ! empty( $nexio_description ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( wpautop( $nexio_description ), 'nexio_kses_content' );
						?>
						</div>
						<?php
					}
				}

				// Content (widgets)
				?>
				<div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs">
					<?php
					if ( 'products' == $nexio_woocommerce_sc ) {
						$nexio_woocommerce_sc_ids      = nexio_get_theme_option( 'front_page_woocommerce_products_per_page' );
						$nexio_woocommerce_sc_per_page = count( explode( ',', $nexio_woocommerce_sc_ids ) );
					} else {
						$nexio_woocommerce_sc_per_page = max( 1, (int) nexio_get_theme_option( 'front_page_woocommerce_products_per_page' ) );
					}
					$nexio_woocommerce_sc_columns = max( 1, min( $nexio_woocommerce_sc_per_page, (int) nexio_get_theme_option( 'front_page_woocommerce_products_columns' ) ) );
					echo do_shortcode(
						"[{$nexio_woocommerce_sc}"
										. ( 'products' == $nexio_woocommerce_sc
												? ' ids="' . esc_attr( $nexio_woocommerce_sc_ids ) . '"'
												: '' )
										. ( 'product_category' == $nexio_woocommerce_sc
												? ' category="' . esc_attr( nexio_get_theme_option( 'front_page_woocommerce_products_categories' ) ) . '"'
												: '' )
										. ( 'best_selling_products' != $nexio_woocommerce_sc
												? ' orderby="' . esc_attr( nexio_get_theme_option( 'front_page_woocommerce_products_orderby' ) ) . '"'
													. ' order="' . esc_attr( nexio_get_theme_option( 'front_page_woocommerce_products_order' ) ) . '"'
												: '' )
										. ' per_page="' . esc_attr( $nexio_woocommerce_sc_per_page ) . '"'
										. ' columns="' . esc_attr( $nexio_woocommerce_sc_columns ) . '"'
						. ']'
					);
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
