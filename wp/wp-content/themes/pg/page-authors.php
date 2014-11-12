<?php get_header(); ?>

  <?php
  $args = array( 'hide_empty=0' );

  $terms = get_terms('student', $args);
  if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
      $count = count($terms);
      $i=0;
      $term_list = '<ul class="o-people">';
      foreach ($terms as $term) {
          $i++;
        $term_list .= '<li class="o-people__item"><a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a></li>';
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

<?php get_footer(); ?>