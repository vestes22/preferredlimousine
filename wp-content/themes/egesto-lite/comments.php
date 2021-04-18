<?php
/**
 * The template for displaying Comments.
 *
 *
 * @package Egesto Lite
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
  <?php // You can start editing here -- including this comment! ?>
  <?php if ( have_comments() ) : ?>
   <h2 class="comments-title">
    <?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'egesto-lite' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'egesto-lite'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
  </h2>
  <ol class="commentlist">
    <?php wp_list_comments(); ?>
  </ol>
  <!-- .commentlist -->
  
  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
  <nav id="comment-nav-below" class="navigation" role="navigation">
    <h1 class="assistive-text section-heading">
      <?php esc_html_e( 'Comment navigation', 'egesto-lite'); ?>
    </h1>
    <div class="nav-previous">
      <?php previous_comments_link( esc_html__( '&larr; Older Comments', 'egesto-lite') ); ?>
    </div>
    <div class="nav-next">
      <?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'egesto-lite') ); ?>
    </div>
  </nav>
  <?php endif; // check for comment navigation ?>
  <?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
  <p class="nocomments">
    <?php esc_html_e( 'Comments are closed.', 'egesto-lite'); ?>
  </p>
  <?php endif; ?>
  <?php endif; // have_comments() ?>
  <?php comment_form(); ?>
</div>
