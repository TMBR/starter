<?php get_header(); ?>

<?php
// Hero Slider
get_template_part( 'partials/header/fullscreen_slider' ); ?>

<div id="page-wrapper">
	<div class="container">
		<div class="row">

			<div id="main-content" class="col-sm-8">

			<!-- OUT PUT PAGE CONTENT -->
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php
				// large News Item
				get_template_part( 'partials/page/single-loop' ); ?>

			<?php  endwhile; endif; ?>
			<?php  wp_reset_query(); ?>

			<!-- OUTPUT BLOG POSTS -->
			<?php
			$args = array(
				'posts_per_page' => 8,
			);
			query_posts($args);
			?>
			<div class="post-loop">
				<div class="row">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php
						// large News Item
						get_template_part( 'partials/loops/news-loop' ); ?>

					<?php  endwhile; endif; ?>
					<?php  wp_reset_query(); ?>
				</div>
			</div>

		</div><!-- /col main content -->

		<div id="sidebar-content" class="col-sm-4">
			<?php get_sidebar(); ?>
		</div>

		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- #page-wrapper -->

<?php get_footer(); ?>
