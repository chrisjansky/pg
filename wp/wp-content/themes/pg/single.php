<?php get_header(); ?>

	<h1>Single.php</h1>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php
			/*
			 * Ah, post formats. Nature's greatest mystery (aside from the sloth).
			 *
			 * So this function will bring in the needed template file depending on what the post
			 * format is. The different post formats are located in the post-formats folder.
			 *
			 *
			 * REMEMBER TO ALWAYS HAVE A DEFAULT ONE NAMED "format.php" FOR POSTS THAT AREN'T
			 * A SPECIFIC POST FORMAT.
			 *
			 * If you want to remove post formats, just delete the post-formats folder and
			 * replace the function below with the contents of the "format.php" file.
			*/
			get_template_part( 'post-formats/format', get_post_format() );
		?>

		<?php
			$tags = get_tags();
			$html = '<div class="post_tags">';
			foreach ( $tags as $tag ) {
				$tag_link = get_tag_link( $tag->term_id );
						
				$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
				$html .= "{$tag->name}</a>";
			}
			$html .= '</div>';
			echo $html;
		?>

	<?php endwhile; ?>

	<?php else : ?>

		<article id="post-not-found" class="hentry cf">
				<header class="article-header">
					<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
				</header>
				<section class="entry-content">
					<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
				</section>
				<footer class="article-footer">
						<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
				</footer>
		</article>

	<?php endif; ?>

<?php get_footer(); ?>