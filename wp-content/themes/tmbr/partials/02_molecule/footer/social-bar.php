

<?php if(get_field('social_media','option')) : ?>

  <div class="social-bar mtb2">
  <?php while(has_sub_field('social_media','option')) : ?>

    <a href="<?php the_sub_field('sm_social_link','option'); ?>" target="_blank" class="btn"><i class="fa fa-fw fa-<?php the_sub_field('sm_social_site','option'); ?>"></i></a>

  <?php endwhile; ?>
  </div><!-- /social-bar -->

<?php endif; ?>