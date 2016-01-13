<?php get_header(); ?>

<?php
// Hero Slider
get_template_part( 'partials/slider/home-hero' ); ?>


	<div class="container">

		<div class="row">

				<div class="col-sm-8">

					<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'partials/loops/page-loop' ); ?>
					<?php endwhile; // end of the loop. ?>

					<!-- OUTPUT BLOG POSTS -->
					<?php
					$args = array(
						'posts_per_page' => 8,
					);
					$blogposts = new WP_Query($args);
					?>
					<div class="post-loop">
						<div class="row">
							<?php if ( $blogposts->have_posts() ) : while ( $blogposts->have_posts() ) : $blogposts->the_post(); ?>
								<?php
								// large News Item
								get_template_part( 'partials/loops/news-loop' ); ?>

							<?php  endwhile; endif; ?>
							<?php  wp_reset_postdata(); ?>
						</div>
					</div>

					<h2>ICON FONT TEST <i class="tmbricons tmbricons-xmas"></i></h2>
				</div><!-- /col -->



			<?php get_sidebar(); ?>

		</div><!-- /row -->
	</div><!-- /container -->


<?php get_footer();
