<?php get_header(); ?>

<div id="page-wrapper">	
	<div class="container">
		<div class="row">
		
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<div class="col-sm-8">		
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php edit_post_link(); ?>
			</div><!-- /col -->
		
		<?php endwhile; endif; ?>

		<?php get_sidebar(); ?>
		
		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- #page-wrapper -->

<?php get_footer(); ?>
