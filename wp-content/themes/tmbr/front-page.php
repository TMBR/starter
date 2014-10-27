<?php get_header(); ?>

<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8">

				<?php
				// large News Item
				get_template_part( 'partials/owl-slider' ); ?>


			<!-- OUT PUT PAGE CONTENT -->
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php
				// large News Item
				get_template_part( 'partials/single-loop' ); ?>

			<?php  endwhile; endif; ?>
			<?php  wp_reset_query(); ?>



			<!-- OUTPUT BLOG POSTS -->
			<?php
			// QUERY 8 recent posts

			$args = array(
				'posts_per_page' => 8,
			);

			/*
			// QUERY most recent post in HERO category
			$args = array(
				'posts_per_page' => 1,
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'terms' => array( 17 ),
					)
				)
			);
			*/

			query_posts($args);
			?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php
				// large News Item
				get_template_part( 'partials/news-loop' ); ?>

			<?php  endwhile; endif; ?>
			<?php  wp_reset_query(); ?>

		</div><!-- /col main content -->

		<?php get_sidebar(); ?>

		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- #page-wrapper -->

<?php get_footer(); ?>
