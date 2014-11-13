<?php get_header(); ?>

  <h1 class="t-subhead">Students</h1>
  <?php
  $args = array('hide_empty' => true);

  $terms = get_terms('student', $args);
  if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
      $count = count($terms);
      $i=0;
      $term_list = '<ul class="o-people">';
      foreach ($terms as $term) {
          $i++;
        $term_list .= '<li class="o-people__item"><a class="o-people__link" href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a></li>';
        if ($count != $i) {
          $term_list .= "";
        }
        else {
          $term_list .= '</ul>';
        }
      }
      echo $term_list;
  }
  ?>

  <hr class="l-divider--small">
  <h1 class="t-subhead">Graduates</h1>
  <?php
  $args = array('hide_empty' => true);

  $terms = get_terms('graduate', $args);
  if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
      $count = count($terms);
      $i=0;
      $term_list = '<ul class="o-people">';
      foreach ($terms as $term) {
          $i++;
        $term_list .= '<li class="o-people__item"><a class="o-people__link" href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a></li>';
        if ($count != $i) {
          $term_list .= "";
        }
        else {
          $term_list .= '</ul>';
        }
      }
      echo $term_list;
  }
  ?>

  <section class="m-person">
    <div class="m-person__name">
      <h1 class="t-h1">
        <?php echo list_custom_taxonomies(); ?>
      </h1>
    </div>

    <?php if (term_description()) { ?>
      <div data-random="o-color-block" class="m-person__bio o-color-block">
        <?php echo term_description(); ?>
      </div>
    <?php } ?>
  </section>

  <section class="o-loop">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article <?php post_class("o-loop__item"); ?> role="article" data-random="o-loop__item">

      <header class="o-loop__title">
        <h2 class="t-h2">
          <?php the_title(); ?>
        </h2>
      </header>

      <?php
      if (has_post_thumbnail()) {
      ?>
        <div class="o-loop__thumbnail">
        <?php the_post_thumbnail("full", array("class" => "o-loop__image")); ?>
        </div>
      <?php
      }
      ?>

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
      ?>

    </article>

    <?php endwhile; ?>

    <?php else : ?>
      <h1 class="t-h1"><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
    <?php endif; ?>

  </section>

<?php get_footer(); ?>