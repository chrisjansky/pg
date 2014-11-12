<?php get_header(); ?>

  <?php
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $args = array('posts_per_page' => 2, 'paged' => $paged);
  query_posts($args);
  if ( have_posts() ) : while (have_posts()) : the_post(); ?>
  <div class="post">
    <h4><?php the_title(); ?></h4>
    <small><?php the_date(); ?></small>
    <article><?php the_content(); ?></article>
  </div>
  <?php endwhile; ?>

  <div class="archive">
    <?php previous_posts_link("Newer"); ?>
    <?php next_posts_link("Older"); ?>
  </div>
  <?php endif; ?>

<?php get_footer(); ?>