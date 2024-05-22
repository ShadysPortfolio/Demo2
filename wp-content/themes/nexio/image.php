<?php
/**
 * The template to display the attachment
 *
 * @package NEXIO
 * @since NEXIO 1.0
 */


get_header();

while ( have_posts() ) {
	the_post();

	// Display post's content
	get_template_part( apply_filters( 'nexio_filter_get_template_part', 'templates/content', 'single-' . nexio_get_theme_option( 'single_style' ) ), 'single-' . nexio_get_theme_option( 'single_style' ) );

	// Parent post navigation.
	$nexio_posts_navigation = nexio_get_theme_option( 'posts_navigation' );
	if ( 'links' == $nexio_posts_navigation ) {
		?>
		<div class="nav-links-single<?php
			if ( ! nexio_is_off( nexio_get_theme_option( 'posts_navigation_fixed' ) ) ) {
				echo ' nav-links-fixed fixed';
			}
		?>">
			<?php
			the_post_navigation( apply_filters( 'nexio_filter_post_navigation_args', array(
					'prev_text' => '<span class="nav-arrow"></span>'
						. '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Published in', 'nexio' ) . '</span> '
						. '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'nexio' ) . '</span> '
						. '<h5 class="post-title">%title</h5>'
						. '<span class="post_date">%date</span>',
			), 'image' ) );
			?>
		</div>
		<?php
	}

	// Comments
	do_action( 'nexio_action_before_comments' );
	comments_template();
	do_action( 'nexio_action_after_comments' );
}

get_footer();
