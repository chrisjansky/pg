<?php get_header(); ?>

	<h1 class="t-subhead">Index</h1>

	<?php
	  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	  $args = array('posts_per_page' => 2, 'paged' => $paged);
	  query_posts($args);
	  if ( have_posts() ) : while (have_posts()) : the_post();
  ?>

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

	</article>

	<?php endwhile; ?>

  <div class="archive">
    <?php previous_posts_link("Newer"); ?>
    <?php next_posts_link("Older"); ?>
  </div>

	<?php else : ?>
		<h1 class="t-h1"><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
	<?php endif; ?>

<?php get_footer(); ?>