<?php get_header(); ?>

	<h1 class="t-subhead">Archive</h1>

	<?php // Render people ?>
	<?php
	$args = array( 'hide_empty=0' );

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

	<?php if (is_category()) { ?>
		<h1 class="archive-title h2">
			<span><?php _e( 'Posts Categorized:', 'bonestheme' ); ?></span> <?php single_cat_title(); ?>
		</h1>

	<?php } elseif (is_tag()) { ?>
		<h1 class="archive-title h2">
			<span><?php _e( 'Posts Tagged:', 'bonestheme' ); ?></span> <?php single_tag_title(); ?>
		</h1>

	<?php } elseif (is_author()) {
		global $post;
		$author_id = $post->post_author;
	?>

	<h1 class="archive-title h2">
		<span><?php _e( 'Posts By:', 'bonestheme' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>
	</h1>

	<?php } elseif (is_day()) { ?>
		<h1 class="archive-title h2">
			<span><?php _e( 'Daily Archives:', 'bonestheme' ); ?></span> <?php the_time('l, F j, Y'); ?>
		</h1>

	<?php } elseif (is_month()) { ?>
			<h1 class="archive-title h2">
				<span><?php _e( 'Monthly Archives:', 'bonestheme' ); ?></span> <?php the_time('F Y'); ?>
			</h1>

	<?php } elseif (is_year()) { ?>
			<h1 class="archive-title h2">
				<span><?php _e( 'Yearly Archives:', 'bonestheme' ); ?></span> <?php the_time('Y'); ?>
			</h1>
	<?php } ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class("o-loop__item"); ?> role="article" data-random="o-loop__item">

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
		$morePhotos = simple_fields_values("sf_project__image");

		foreach ($morePhotos as $photo) {
			$parsedPhoto = wp_get_attachment_image_src($photo, "full");
			echo "<div class='o-loop__photo' data-random='o-loop__photo'>";
			echo "<img class='o-loop__image' src='$parsedPhoto[0]' alt='Additional Image' />";
			echo "</div>";
		}
		?>


	</article>

	<?php endwhile; ?>

			<?php bones_page_navi(); ?>

	<?php else : ?>

			<article id="post-not-found" class="hentry cf">
				<header class="article-header">
					<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
				</header>
				<section class="entry-content">
					<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
				</section>
				<footer class="article-footer">
						<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
				</footer>
			</article>

	<?php endif; ?>

<?php get_footer(); ?>