<?php
/**
 * The "Style 6" template to display the content of the single post or attachment:
 * featured image, title and meta are placed inside the content area
 *
 * @package NEXIO
 * @since NEXIO 1.75.0
 */
?>
<article id="post-<?php the_ID(); ?>"
	<?php
	post_class( 'post_item_single'
		. ' post_type_' . esc_attr( get_post_type() ) 
		. ' post_format_' . esc_attr( str_replace( 'post-format-', '', get_post_format() ) )
	);
	nexio_add_seo_itemprops();
	?>
>
<?php

	do_action( 'nexio_action_before_post_data' );

	nexio_add_seo_snippets();

	// Single post thumbnail and title
	if ( apply_filters( 'nexio_filter_single_post_header', is_singular( 'post' ) || is_singular( 'attachment' ) ) ) {
		// Post title and meta
		ob_start();
		nexio_show_post_title_and_meta( array( 
			'author_avatar' => false,
			'show_labels'   => false,
			'share_type'    => 'list',	// block - icons with bg, list - small icons without background
			'split_meta_by' => 'share',
			'add_spaces'    => true,
		) );
		$nexio_post_header = ob_get_contents();
		ob_end_clean();
		// Featured image
		ob_start();
		nexio_show_post_featured_image( array(
			'thumb_bg' => false,
			'class'    => 'alignwide',
			'popup'    => true,
		) );
		$nexio_post_header .= ob_get_contents();
		ob_end_clean();
		$nexio_with_featured_image = nexio_is_with_featured_image( $nexio_post_header );

		if ( strpos( $nexio_post_header, 'post_featured' ) !== false
			|| strpos( $nexio_post_header, 'post_title' ) !== false
			|| strpos( $nexio_post_header, 'post_meta' ) !== false
		) {
			?>
			<div class="post_header_wrap post_header_wrap_in_content post_header_wrap_style_<?php
				echo esc_attr( nexio_get_theme_option( 'single_style' ) );
				if ( $nexio_with_featured_image ) {
					echo ' with_featured_image';
				}
			?>">
				<?php
				do_action( 'nexio_action_before_post_header' );
				nexio_show_layout( $nexio_post_header );
				do_action( 'nexio_action_after_post_header' );
				?>
			</div>
			<?php
		}
	}

	do_action( 'nexio_action_before_post_content' );

	// Post content
	$nexio_share_position = nexio_array_get_keys_by_value( nexio_get_theme_option( 'share_position' ) );
	?>
	<div class="post_content post_content_single entry-content<?php
		if ( in_array( 'left', $nexio_share_position ) ) {
			echo ' post_info_vertical_present' . ( in_array( 'top', $nexio_share_position ) ? ' post_info_vertical_hide_on_mobile' : '' );
		}
	?>" itemprop="mainEntityOfPage">
		<?php
		if ( in_array( 'left', $nexio_share_position ) ) {
			?><div class="post_info_vertical<?php
				if ( nexio_get_theme_option( 'share_fixed' ) > 0 ) {
					echo ' post_info_vertical_fixed';
				}
			?>"><?php
				nexio_show_post_meta(
					apply_filters(
						'nexio_filter_post_meta_args',
						array(
							'components'      => 'share',
							'class'           => 'post_share_vertical',
							'share_type'      => 'block',
							'share_direction' => 'vertical',
						),
						'single',
						1
					)
				);
			?></div><?php
		}
		the_content();
		?>
	</div><!-- .entry-content -->
	<?php
	do_action( 'nexio_action_after_post_content' );
	
	// Post footer: Tags, likes, share, author, prev/next links and comments
	do_action( 'nexio_action_before_post_footer' );
	?>
	<div class="post_footer post_footer_single entry-footer">
		<?php
		nexio_show_post_pagination();
		if ( is_single() && ! is_attachment() ) {
			nexio_show_post_footer();
		}
		?>
	</div>
	<?php
	do_action( 'nexio_action_after_post_footer' );
	?>
</article>
