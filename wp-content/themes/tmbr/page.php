<?php get_header(); while ( have_posts() ) : the_post(); ?>


<main id="page-main" role="main">

	<div class="container">
		<div class="row">

				<div class="col-sm-12">
					<article role="article">


							<?php get_template_part( 'partials/loops/page-content' ); ?>

					</article>
				</div><!-- /col -->


			<?php get_sidebar(); ?>

		</div><!-- /row -->
	</div><!-- /container -->
	<?php get_template_part( 'partials/03_organism/get-flex-layouts' ); ?>
</main>
<!-- #page-main -->

<?php endwhile; get_footer();
