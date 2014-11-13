<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('m-page'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

		<header class="l-column--primary">
			<h1 class="t-h1" itemprop="headline">
				<?php the_title(); ?>
			</h1>
		</header>

		<section class="m-page__content" itemprop="articleBody">
			<?php the_content(); ?>
		</section>

		<?php if (has_post_thumbnail()) { ?>
			<?php the_post_thumbnail("full", array("class" => "m-page__image")); ?>
		<?php } ?>

	</article>

	<?php endwhile; else : ?>
		<h1 class="t-h1"><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
	<?php endif; ?>

<?php get_footer(); ?>