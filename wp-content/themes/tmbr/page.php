<?php get_header(); ?>


<main id="page-main" role="main">

	<!-- PAGE HERO -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
			<?php get_template_part( 'partials/custom-fields/page-hero' ); ?>
			</div><!-- /col -->
		</div><!-- /row -->
	</div><!-- /container -->

	<?php get_template_part( 'partials/custom-fields/flex-content' ); ?>

	<div class="container-fluid stop1440">
		<div class="row">

				<div class="col-sm-8">
					<article role="article">
					<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'partials/loops/page-content' ); ?>
					<?php endwhile; // end of the loop. ?>
					</article>
				</div><!-- /col -->


			<?php get_sidebar(); ?>

		</div><!-- /row -->
	</div><!-- /container -->
</main>
<!-- #page-main -->

<?php get_footer();
