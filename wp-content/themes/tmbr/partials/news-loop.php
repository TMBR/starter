<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

<p><small>By <?php the_author_posts_link(); ?> on <?php the_time('F j, Y') ?> | Posted in: <?php the_category(', '); ?></small></p>

<p><?php echo excerpt(55); ?> <em><a href="<?php the_permalink();?>">Read More.</a></em></p>

<p><small><?php the_tags(); ?></small></p>
<hr />