<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Egesto Lite
 */

get_header(); ?>

<div id="wrapper">
  <div id="contentwrapper">
  <h1 class="entry-title">
          <span><?php the_title(); ?></span>
        </h1>
        <div class="postcat"><span><?php echo get_the_date(); ?></span>
          <?php the_category( ', ' ); ?>
        </div>
    <div id="content">
      <?php while ( have_posts() ) : the_post(); ?>
      <div <?php post_class(); ?>>
        <div class="entry">
          <?php the_content(); ?>
          <?php wp_link_pages(array('before' => '<p><strong>'. esc_html__( 'Pages:', 'egesto-lite' ) .'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
          <?php edit_post_link(); ?>
          <?php comments_template(); ?>
        </div>
        <?php echo get_the_tag_list('<p class="singletags">',' ','</p>'); ?>
      </div>
      <?php endwhile; // end of the loop. ?>
    </div>
    <?php get_sidebar(); ?>
  </div>
   <?php the_post_navigation(); ?>
</div>
<?php get_footer(); ?>
