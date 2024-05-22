<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package NEXIO
 * @since NEXIO 1.0
 */

							do_action( 'nexio_action_page_content_end_text' );
							
							// Widgets area below the content
							nexio_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'nexio_action_page_content_end' );
							?>
						</div>
						<?php
						
						do_action( 'nexio_action_after_page_content' );

						// Show main sidebar
						get_sidebar();

						do_action( 'nexio_action_content_wrap_end' );
						?>
					</div>
					<?php

					do_action( 'nexio_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$nexio_body_style = nexio_get_theme_option( 'body_style' );
					$nexio_widgets_name = nexio_get_theme_option( 'widgets_below_page' );
					$nexio_show_widgets = ! nexio_is_off( $nexio_widgets_name ) && is_active_sidebar( $nexio_widgets_name );
					$nexio_show_related = nexio_is_single() && nexio_get_theme_option( 'related_position' ) == 'below_page';
					if ( $nexio_show_widgets || $nexio_show_related ) {
						if ( 'fullscreen' != $nexio_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $nexio_show_related ) {
							do_action( 'nexio_action_related_posts' );
						}

						// Widgets area below page content
						if ( $nexio_show_widgets ) {
							nexio_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $nexio_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'nexio_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'nexio_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! nexio_is_singular( 'post' ) && ! nexio_is_singular( 'attachment' ) ) || ! in_array ( nexio_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="nexio_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'nexio_action_before_footer' );

				// Footer
				$nexio_footer_type = nexio_get_theme_option( 'footer_type' );
				if ( 'custom' == $nexio_footer_type && ! nexio_is_layouts_available() ) {
					$nexio_footer_type = 'default';
				}
				get_template_part( apply_filters( 'nexio_filter_get_template_part', "templates/footer-" . sanitize_file_name( $nexio_footer_type ) ) );

				do_action( 'nexio_action_after_footer' );

			}
			?>

			<?php do_action( 'nexio_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'nexio_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'nexio_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>