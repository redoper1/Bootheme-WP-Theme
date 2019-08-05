<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area col">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) { ?>
		<h3 class="comments-title">
			<?php
			if ( 1 === get_comments_number() ) {
				printf(
					/* translators: %s: The post title. */
					__( 'One thought on &ldquo;%s&rdquo;', 'bootheme' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf(
					/* translators: %1$s: The number of comments. %2$s: The post title. */
					_n( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'bootheme' ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h3>

		<ol class="commentlist">
			<?php
			wp_list_comments(
				array(
					'style'     => 'ul',
                    'walker'    => new WP_Bootstrap_Navwalker,
				)
			);
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h4 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'bootheme' ); ?></h4>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'bootheme' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'bootheme' ) ); ?></div>
		</nav>
        <?php } ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( !comments_open() && get_comments_number() ) {
			?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'bootheme' ); ?></p>
        <?php } ?>

    <?php } ?>

	<?php comment_form(); ?>
</div>