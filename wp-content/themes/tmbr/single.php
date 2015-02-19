<?php get_header(); ?>

<div id="page-wrapper">
	<div class="container">
		<div class="row">

			<div class="col-sm-8">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>

				<?php edit_post_link(); ?>
				<?php comments_template(); ?>

				<?php endwhile; endif; ?>

				<?php get_template_part('partials/post/single-nav'); ?>

			</div><!-- /col -->

		<?php get_sidebar(); ?>

		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- #page-wrapper -->

<?php get_footer(); ?>
