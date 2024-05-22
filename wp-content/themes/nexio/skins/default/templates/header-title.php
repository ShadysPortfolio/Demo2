<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package NEXIO
 * @since NEXIO 1.0
 */

// Page (category, tag, archive, author) title

if ( nexio_need_page_title() ) {
	nexio_sc_layouts_showed( 'title', true );
	nexio_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								nexio_show_post_meta(
									apply_filters(
										'nexio_filter_post_meta_args', array(
											'components' => join( ',', nexio_array_get_keys_by_value( nexio_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', nexio_array_get_keys_by_value( nexio_get_theme_option( 'counters' ) ) ),
											'seo'        => nexio_is_on( nexio_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$nexio_blog_title           = nexio_get_blog_title();
							$nexio_blog_title_text      = '';
							$nexio_blog_title_class     = '';
							$nexio_blog_title_link      = '';
							$nexio_blog_title_link_text = '';
							if ( is_array( $nexio_blog_title ) ) {
								$nexio_blog_title_text      = $nexio_blog_title['text'];
								$nexio_blog_title_class     = ! empty( $nexio_blog_title['class'] ) ? ' ' . $nexio_blog_title['class'] : '';
								$nexio_blog_title_link      = ! empty( $nexio_blog_title['link'] ) ? $nexio_blog_title['link'] : '';
								$nexio_blog_title_link_text = ! empty( $nexio_blog_title['link_text'] ) ? $nexio_blog_title['link_text'] : '';
							} else {
								$nexio_blog_title_text = $nexio_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $nexio_blog_title_class ); ?>">
								<?php
								$nexio_top_icon = nexio_get_term_image_small();
								if ( ! empty( $nexio_top_icon ) ) {
									$nexio_attr = nexio_getimagesize( $nexio_top_icon );
									?>
									<img src="<?php echo esc_url( $nexio_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'nexio' ); ?>"
										<?php
										if ( ! empty( $nexio_attr[3] ) ) {
											nexio_show_layout( $nexio_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $nexio_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $nexio_blog_title_link ) && ! empty( $nexio_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $nexio_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $nexio_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'nexio_action_breadcrumbs' );
						$nexio_breadcrumbs = ob_get_contents();
						ob_end_clean();
						nexio_show_layout( $nexio_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
