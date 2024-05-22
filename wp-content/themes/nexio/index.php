<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package NEXIO
 * @since NEXIO 1.0
 */

$nexio_template = apply_filters( 'nexio_filter_get_template_part', nexio_blog_archive_get_template() );

if ( ! empty( $nexio_template ) && 'index' != $nexio_template ) {

	get_template_part( $nexio_template );

} else {

	nexio_storage_set( 'blog_archive', true );

	get_header();

	if ( have_posts() ) {

		// Query params
		$nexio_stickies   = is_home()
								|| ( in_array( nexio_get_theme_option( 'post_type' ), array( '', 'post' ) )
									&& (int) nexio_get_theme_option( 'parent_cat' ) == 0
									)
										? get_option( 'sticky_posts' )
										: false;
		$nexio_post_type  = nexio_get_theme_option( 'post_type' );
		$nexio_args       = array(
								'blog_style'     => nexio_get_theme_option( 'blog_style' ),
								'post_type'      => $nexio_post_type,
								'taxonomy'       => nexio_get_post_type_taxonomy( $nexio_post_type ),
								'parent_cat'     => nexio_get_theme_option( 'parent_cat' ),
								'posts_per_page' => nexio_get_theme_option( 'posts_per_page' ),
								'sticky'         => nexio_get_theme_option( 'sticky_style' ) == 'columns'
															&& is_array( $nexio_stickies )
															&& count( $nexio_stickies ) > 0
															&& get_query_var( 'paged' ) < 1
								);

		nexio_blog_archive_start();

		do_action( 'nexio_action_blog_archive_start' );

		if ( is_author() ) {
			do_action( 'nexio_action_before_page_author' );
			get_template_part( apply_filters( 'nexio_filter_get_template_part', 'templates/author-page' ) );
			do_action( 'nexio_action_after_page_author' );
		}

		if ( nexio_get_theme_option( 'show_filters' ) ) {
			do_action( 'nexio_action_before_page_filters' );
			nexio_show_filters( $nexio_args );
			do_action( 'nexio_action_after_page_filters' );
		} else {
			do_action( 'nexio_action_before_page_posts' );
			nexio_show_posts( array_merge( $nexio_args, array( 'cat' => $nexio_args['parent_cat'] ) ) );
			do_action( 'nexio_action_after_page_posts' );
		}

		do_action( 'nexio_action_blog_archive_end' );

		nexio_blog_archive_end();

	} else {

		if ( is_search() ) {
			get_template_part( apply_filters( 'nexio_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		} else {
			get_template_part( apply_filters( 'nexio_filter_get_template_part', 'templates/content', 'none-archive' ), 'none-archive' );
		}
	}

	get_footer();
}
