<?php get_header(); ?>

<div id="page-wrapper">	
	<div class="container">
		<div class="row">
		
		
			<div class="col-sm-8">
				<h1><?php the_title();?></h1>
				
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
					<?php get_template_part( 'partials/single-loop'); ?>
					<?php comments_template(); ?>
				<?php endwhile; endif; ?>
				<?php edit_post_link(); ?>
				<?php get_template_part('partials/loop-nav'); ?>
			</div><!-- /col -->

			<?php get_sidebar(); ?>
		
		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- #page-wrapper -->

<?php get_footer(); ?>


