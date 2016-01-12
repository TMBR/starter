<?php
// Template Name: Flex Content
?>
<?php get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<div id="primary" class="content-area">
		<div class="container">
			<div class="row">
				<main id="main" class="site-main" role="main">

					<?php
					// Get Flex Template partials
					get_template_part( 'partials/flexiblecontent/flex-templateparts' );
					?>

				</main>
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- #primary -->

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>