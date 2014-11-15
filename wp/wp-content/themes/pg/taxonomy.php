<?php get_header(); ?>

  <?php
  $args = array('hide_empty' => true);

  $custom_taxonomies = array('student', 'graduate');

  foreach ($custom_taxonomies as $key=>$custom_taxonomy) {
    $terms = get_terms($custom_taxonomy, $args);
    if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
      $count = count($terms);
      $current_term = get_queried_object()->term_id;
      $i = 0;
      $term_list = '<ul class="o-namelist">';
      foreach ($terms as $term) {
        $i++;
        if ($current_term == $term->term_id) {
          $term_list .= '<li class="o-namelist__item"><span class="o-namelist__selected">' . $term->name . '</span></li>';
        } else {
          $term_list .= '<li class="o-namelist__item"><a class="o-namelist__link" href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a></li>';
        }
        if ($count != $i) {
          $term_list .= "";
        }
        else {
          $term_list .= '</ul>';
        }
      }
      echo '<h1 class="t-subhead">' . get_taxonomy($term->taxonomy)->label . '</h1>';
      echo $term_list; 
      if ($key == 0) {
        echo '<hr class="l-divider--small">';
      }
    }
  }
  ?>

  <section class="m-single m-single--person">
    <div class="m-single__name">
      <h1 class="t-h1">
        <?php echo $wp_query->queried_object->name; ?>
      </h1>
    </div>

    <?php if (term_description()) { ?>
      <div data-random="o-color-block" class="m-single__bio o-color-block">
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

      <?php if(get_the_content()) { ?>
        <section class="o-loop__content o-color-block" data-random="o-color-block">
          <?php the_content(); ?>
        </section>
      <?php } ?>

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