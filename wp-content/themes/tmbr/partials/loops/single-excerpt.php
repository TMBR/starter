<div class="post-item">
	<div class="col-sm-4">
		<a href="<?php the_permalink();?>">
			<?php if ( has_post_thumbnail() ) :?><?php the_post_thumbnail('lg_thumb'); ?>
			<?php else : ?>
				<img src="<?php bloginfo( 'template_url' ); ?>/assets/img/tmbr-logo.png" class="wp-post-image" alt=""/>
			<?php endif; ?>
		</a>
	</div><!-- /col -->

	<div class="col-sm-8">
		<h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		<p class="post-meta"><small>By <?php the_author_posts_link(); ?> on <?php the_time('F j, Y') ?> | Posted in: <?php the_category(', '); ?></small></p>
		<p class="post-copy"><?php echo tmbr_excerpt(55); ?></p>
		<a href="<?php the_permalink();?>" class="read-more">Read More.</a>
	</div>
</div>