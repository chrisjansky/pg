<?php
/*
Template Name: Contact Page
*/
get_header(); ?>

  <header class="article-header">

    <h1 class="t-h1">
      <?php the_title(); ?>
    </h1>

  </header>

  <section class="entry-content">
    <?php the_excerpt(); ?>
    <?php the_content(); ?>
  </section>

  <?php
  $additionalContact = simple_fields_value("sf_contacts__textarea");

  echo $additionalContact;

  ?>

<?php get_footer(); ?>