<?php get_header(); ?>

<div id="page-wrapper">	
	<div class="container">
		<div class="row">
		
			<div class="col-sm-8">
				<h1>
					<?php if ( is_day() ) { printf( __( 'Daily Archives: %s'), get_the_time(get_option('date_format') ) ); } 
					elseif ( is_month() ) { printf( __( 'Monthly Archives: %s'), get_the_time('F Y') ); }
					elseif ( is_year() ) { printf( __( 'Yearly Archives: %s'), get_the_time('Y') ); }
					elseif ( is_category() ) { _e( 'Category Archives: '); single_cat_title(); }
					elseif ( is_author() ) { _e( 'Author Archives: '); the_author_link(); }
					elseif ( is_tag() ) { _e( 'Author Archives: '); single_tag_title(); }
					else { echo ( 'Archives'); } ?>
				</h1>
				
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
					<?php get_template_part( 'partials/single-loop'); ?>
				
				<?php endwhile; endif; ?>
				<?php edit_post_link(); ?>
				<?php get_template_part('partials/loop-nav'); ?>
			</div><!-- /col -->

			<?php get_sidebar(); ?>
		
		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- #page-wrapper -->

<?php get_footer(); ?>


