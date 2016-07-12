<?php
/**
 * The template for displaying all single posts.
 *
 */

get_header(); ?>

<main id="page-main" role="main">

	<div class="container">
		<div class="row">

				<div class="col-sm-8">
				<article role="article">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'partials/loops/single-content' ); ?>

						<?php the_post_navigation(); ?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>

					<?php endwhile; // end of the loop. ?>
					</article>
				</div><!-- /col -->


			<?php get_sidebar(); ?>

		</div><!-- /row -->
	</div><!-- /container -->
</main>
<!-- #page-main -->

<?php get_footer(); ?>