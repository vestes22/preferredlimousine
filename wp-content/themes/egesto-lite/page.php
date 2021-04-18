<?php
/**
 * The template for displaying all pages.
 *
 * @package Egesto Lite
 */

get_header(); ?>

<div id="wrapper">
  <div id="contentwrapper">
    <h1 class="entry-title">
      <span><?php the_title(); ?></span>
    </h1>
    <div id="content">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="post" id="post-<?php the_ID(); ?>">
        <div class="entry">
          <?php the_content(); ?>
          <?php edit_post_link(); ?>
          <?php wp_link_pages(array('before' => '<p><strong>'. esc_html__( 'Pages:', 'egesto-lite' ) .'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
          <?php comments_template(); ?>
        </div>
      </div>
      <?php endwhile; endif; ?>
    </div>
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>
