<?php get_header(); ?>

  <section class="o-loop">

  <?php
  $args = array('post_type' => 'exhibition');
  query_posts($args);
  if ( have_posts() ) : while (have_posts()) : the_post(); ?>

  <article <?php post_class("o-loop__item"); ?> role="article" data-random="o-loop__item">

    <header class="o-loop__title">
      <h1 class="t-h1">
        <?php the_title(); ?>
      </h1>
      <span class="t-date"><?php the_date(); ?></span>
    </header>

    <?php if (has_post_thumbnail()) { ?>
      <div class="o-loop__thumbnail">
        <?php the_post_thumbnail("full", array("class" => "o-loop__image")); ?>
      </div>
    <?php } ?>

    <section class="o-loop__content o-color-block" data-random="o-color-block">
      <?php the_content(); ?>
    </section>

    <?php // Render additional photos from Simple Fields ?>
    <?php
    $morePhotos = simple_fields_values("sf_images__item");

    foreach ($morePhotos as $photo) {
      $parsedPhoto = wp_get_attachment_image_src($photo, "full");
      echo "<div class='o-loop__photo' data-random='o-loop__photo'>";
      echo "<img class='o-loop__image' src='$parsedPhoto[0]' alt='Additional Image' />";
      echo "</div>";
    }

    $moreTextarea = simple_fields_value("sf_textarea__item");
    if ($moreTextarea) {
      echo "<div class='o-loop__aside'>";
      echo $moreTextarea;
      echo "</div>";
    }
    ?>

  </article>

  <?php endwhile; ?>
  <?php endif; ?>

  </section>

<?php get_footer(); ?>