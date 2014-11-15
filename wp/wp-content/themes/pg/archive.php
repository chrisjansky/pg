<?php get_header(); ?>

	<h1 class="t-subhead">
		<?php if (is_category()) {
			single_cat_title();
		} elseif (is_tag()) {
			single_tag_title();
		} ?>
		Archive
	</h1>

	<section class="o-loop">

	<?php
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

		$args = array(
			'posts_per_page' => 5,
			'category_name' => 'news',
			'paged' => $paged,
		);

		$the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) : while ($the_query->have_posts()) : $the_query->the_post();
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
				<?php the_post_thumbnail("medium", array("class" => "o-loop__image")); ?>
			</div>
		<?php } ?>

		<?php if(get_the_content()) { ?>
      <section class="o-loop__content o-color-block" data-random="o-color-block">
        <?php the_content(); ?>
      </section>
    <?php } ?>

	</article>

	<?php endwhile; ?>

	<?php
	$big = 999999999;

	$page_links = paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'type' => 'array',
		'show_all' => false,
		'prev_next' => true,
		'current' => max( 1, get_query_var('paged') ),
		'total' => $the_query->max_num_pages
	) );

	echo "<ul class='o-loop__footer o-pagination'>";
	foreach ( $page_links as $page_link ) {
		echo "<li class='o-pagination__item'>";
		print_r($page_link);
		echo "</li>";
	}
	echo "</ul>";
	?>

	<?php else : ?>
		<h1 class="t-h1"><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
	<?php endif; ?>

  </section>

<?php get_footer(); ?>