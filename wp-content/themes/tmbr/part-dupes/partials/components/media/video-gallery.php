<?php
/* Required vars:

* $rows
* $get_rows
* $source (options: flex_media / )
*
* Used by:
* partials/fields/flex/media/gallery.php

*/

if($get_rows) :
?>
<section class="gallery -video">
  <div class="row">
    <?php
    while(has_sub_field($rows)) :
      if($source == 'flex_media') {
        $image = get_sub_field('fm_vg_image');
        $url = get_sub_field('fm_vg_video_url');
      }
      ?>
    <div class="col-xs-4">
      <?php
        tmbr_load_template( 'partials/components/media/video-obj.php', array(
          'img' => (isset($image)) ? $image : null,
          'size' => 'full_screen',
          'url' => (isset($url)) ? $url : null
        ));
      ?>
    </div><!-- /col -->
    <?php endwhile; ?>
  </div><!-- /row -->
</section><!-- /img-gallery -->
<?php endif; ?>