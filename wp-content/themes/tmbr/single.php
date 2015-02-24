<?php
/**
 * The template for displaying all single posts.
 *
 */

get_header(); ?>

<div id="primary" class="content-area">
	<div class="container">
		<div class="row">
			<main id="main" class="site-main" role="main">
				<div class="col-sm-8">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'partials/loops/single-loop' ); ?>

						<?php the_post_navigation(); ?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>

					<?php endwhile; // end of the loop. ?>

				</div><!-- /col -->
			</main>

			<?php get_sidebar(); ?>

		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- #primary -->

<?php get_footer(); ?>