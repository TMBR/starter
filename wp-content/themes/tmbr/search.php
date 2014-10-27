<?php get_header(); ?>

<div id="page-wrapper">	
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
			
			<?php if ( have_posts() ) : ?>

				<h1><?php printf( __( 'Search Results for: %s'), get_search_query() ); ?></h1>

				<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('partials/single-loop'); ?>
				<?php endwhile; ?>

				<?php get_template_part('partials/loop-nav'); ?>
				
				<?php else : ?>

				<h2><?php _e( 'Nothing Found' ); ?></h2>

				<p><?php _e( 'Sorry, nothing matched your search. Please try again.'); ?></p>
				<?php get_search_form(); ?>

			<?php endif; ?>
			
			</div><!-- /col -->
			
			<?php get_sidebar(); ?>
			
		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- #page-wrapper -->

<?php get_footer(); ?>