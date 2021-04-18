<?php
/**
 * The template for displaying posts on index view
 *
 * @package Egesto Lite
 */
?>

<div <?php post_class('blogpost animated fadeIn'); ?>>
  <a href="<?php the_permalink(); ?>">
    <h2 class="entry-title" id="post-<?php the_ID(); ?>"> 
      <?php the_title(); ?>
       </h2>
       <?php if ( has_post_thumbnail() ) : ?>
    <?php the_post_thumbnail('egesto-blogthumb'); ?>
	<?php else : ?>
    <div class="postexcerpt"><?php the_excerpt(); ?></div>
	<?php endif; ?>
  </a>
</div>
