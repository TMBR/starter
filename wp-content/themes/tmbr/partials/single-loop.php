<div class="row entry">

	<div class="col-sm-3">
		<a href="<?php the_permalink();?>">
			<?php if ( has_post_thumbnail() ) :?><?php the_post_thumbnail(); ?>
			<?php else :?>
				<img src="<?php bloginfo( 'template_url' ); ?>/assets/img/tmbr-logo.png" class="attachment-post-thumbnail wp-post-image" alt=""/>
			<?php endif; ?>
		</a>
	</div><!-- /col -->

	<div class="col-sm-9">
		<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		<p><small>By <?php the_author_posts_link(); ?> on <?php the_time('F j, Y') ?> | Posted in: <?php the_category(', '); ?></small></p>
		<p><?php the_content(); ?></p>
		<p><small><?php the_tags(); ?></small></p>
	</div><!-- /col -->

</div><!-- /row -->