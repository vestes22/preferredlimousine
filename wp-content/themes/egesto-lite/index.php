<?php
/**
 * The main template file.
 *
 *
 * @package Egesto Lite
 */

get_header(); ?>

<div id="wrapper">
  <div id="contentwrapper" class="animatedParent animateOnce">
    <div id="contentfull">
    <?php if( is_home() && get_option('page_for_posts') ) {
			$blog_page_id = get_option('page_for_posts');
			echo '<h1 class="entry-title"><span>'.get_page($blog_page_id)->post_title.'</span></h1>';
		}
	?>
      <?php if (have_posts()) : ?>
      <?php while ( have_posts() ) : the_post();
  				get_template_part( 'content', get_post_format() );
  			endwhile; ?>
      <?php the_posts_pagination(); ?>
      <?php else : ?>
      <p class="center">
        <?php esc_html_e( 'You don&#39;t have any posts yet.', 'egesto-lite' ); ?>
      </p>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
