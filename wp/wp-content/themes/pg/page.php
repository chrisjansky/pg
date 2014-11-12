<?php get_header(); ?>

	<h1 class="t-subhead">Page</h1>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

		<header class="article-header">

			<h1 class="t-h1" itemprop="headline">
				<?php the_title(); ?>
			</h1>

		</header> <?php // end article header ?>

		<section class="entry-content" itemprop="articleBody">
			<?php
				// the content (pretty self explanatory huh)
				the_content();

				/*
				 * Link Pages is used in case you have posts that are set to break into
				 * multiple pages. You can remove this if you don't plan on doing that.
				 *
				 * Also, breaking content up into multiple pages is a horrible experience,
				 * so don't do it. While there are SOME edge cases where this is useful, it's
				 * mostly used for people to get more ad views. It's up to you but if you want
				 * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
				 *
				 * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
				 *
				*/
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
		</section> <?php // end article section ?>

	</article>

	<?php if (is_page('authors')) {
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
	} else if (is_page('our-gallery')) { ?>
		<strong>GALERIE</strong>
	<?php } ?>

	<?php endwhile; else : ?>

		<article id="post-not-found" class="hentry cf">
			<header class="article-header">
				<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
			</header>
			<section class="entry-content">
				<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
			</section>
			<footer class="article-footer">
					<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
			</footer>
		</article>

	<?php endif; ?>

<?php get_footer(); ?>