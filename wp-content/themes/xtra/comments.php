<?php if ( post_password_required() ) { return; } ?>
<?php if ( have_comments() ) { ?>
<h3 class="cz_cm_ttl"><i class="fa fa-comments mr8"></i>
	<?php comments_number( esc_html__( 'No Comment', 'xtra' ), esc_html__( '1 Comment', 'xtra' ), esc_html__( '% Comments', 'xtra' ) ); ?>
</h3>
	<div id="commentlist-container">
		<ul class="commentlist"><?php wp_list_comments(array('avatar_size' => 35)); ?></ul>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<ul class="page-numbers">
				<li><?php previous_comments_link(); ?></li>
				<li><?php next_comments_link(); ?></li>
			</ul>
		<?php } ?>
	</div>
<?php } if ( comments_open() ) {comment_form();} ?>