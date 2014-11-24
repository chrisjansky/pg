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
        $term_list .= '<li class="o-namelist__item"><a class="o-namelist__link" href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a></li>';
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

<?php get_footer(); ?>