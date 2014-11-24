<?php get_header(); ?>
	
	<h1 class="t-subhead">All Exhibitions</h1>
	<ul class="o-namelist">
	<?php
	$args = array(
		'post_type' => 'exhibition',
		'posts_per_page' => -1
	);
	$myposts = get_posts($args);
	foreach ($myposts as $post) : setup_postdata($post);
	?>

		<li class="o-namelist__item"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

	<?php endforeach; wp_reset_postdata(); ?>
	</ul>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<section class="m-single">

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

		    <?php if(get_the_content()) { ?>
		      <section class="o-loop__content o-color-block" data-random="o-color-block">
		        <?php the_content(); ?>
		      </section>
		    <?php } ?>

		    <?php // Render additional photos and textarea from Simple Fields

		    $more_textarea = simple_fields_value("sf_textarea__item");
		    if ($more_textarea) {
		      echo "<div class='o-loop__aside'>";
		      echo $more_textarea;
		      echo "</div>";
		    }

		    $more_photos = simple_fields_values("sf_images__item");
		    foreach ($more_photos as $photo) {
		      $parsed_photo = wp_get_attachment_image_src($photo, "full");
		      echo "<div class='o-loop__photo' data-random='o-loop__photo'>";
		      echo "<img class='o-loop__image' src='$parsed_photo[0]' alt='Additional Image' />";
		      echo "</div>";
		    }
		    ?>

	  	</article>

  	</section>

	<?php endwhile; ?>

	<?php else : ?>
		<h1 class="t-h1"><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
	<?php endif; ?>

<?php get_footer(); ?>