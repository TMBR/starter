<div class="post-item">
	<div class="col-sm-4">
		<a href="<?php the_permalink();?>">
			<?php if ( has_post_thumbnail() ) :?><?php the_post_thumbnail(); ?>
			<?php else : ?>
				<img src="<?php echo get_template_directory_uri(); ?>/public/images/tmbr_icon_large.png" class="post-thumbnail" alt=""/>
			<?php endif; ?>
		</a>
	</div><!-- /col -->

	<div class="col-sm-8">
		<h3 class="animation" data-animation="animation-fade-in-down"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		<p class="animation" data-animation="animation-fade-in-up"><small>By <?php the_author_posts_link(); ?> on <?php the_time('F j, Y') ?> | Posted in: <?php the_category(', '); ?></small></p>
		<?php echo tmbr_excerpt(55); ?>
		<p><a href="<?php the_permalink();?>">Read More.</a></p>
	</div>
</div>
